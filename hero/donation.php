<?php # donation.php
session_start();
if ( isset( $_COOKIE[session_name()] ) ) {
	setcookie( session_name(), '', time()-3600, '/' );
}
// Clear the session:
$_SESSION = array(); // Destroy the variables.
session_destroy(); // Destroy the session itself.
session_start();
// This page allows a logged-in user to make a donation to egret.tv.

ob_start(); // output stored in internal buffer
include('header_test.php');
require_once ('config.inc.php');
require('./mysql.inc.php');
// Need the form function:
include('./form_functions.inc.php');

// If no first_name session variable exists, redirect the user:
if (isset($_SESSION['first_name'])) {

	//$url = BASE_URL . 'index.php'; // Define the URL.
	//ob_end_clean(); // Delete the buffer.
	
	
	//header("Location: $url");
	//exit(); // Quit the script.
	
}
?>

<main role="main">

    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
		<h1>COMING SOON - Donation form</h1>
		<hr>

<?php 
if (isset($_SESSION['first_name'])) {

	//$url = BASE_URL . 'index.php'; // Define the URL.
	//ob_end_clean(); // Delete the buffer.
	
	
	//header("Location: $url");
	//exit(); // Quit the script.
	
} else {}

// For storing errors:
$shipping_errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					
	
	// Check for Magic Quotes:
	if (get_magic_quotes_gpc()) {
		$_POST['firstName'] = stripslashes($_POST['firstName']);
	}

	// Check for a Stripe token:
	if (isset($_POST['token'])) {
		$token = $_POST['token'];		
	} else {
		$message = 'The order cannot be processed. Please make sure you have JavaScript enabled and try again.';
		$shipping_errors['token'] = true;
	}

	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_POST['firstName'])) {
		$fn = addslashes($_POST['firstName']);
	} else {
		$shipping_errors['firstName'] = 'Please enter your first name!';
	}
	
	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $_POST['lastName'])) {
		$ln  = addslashes($_POST['lastName']);
	} else {
		$shipping_errors['lastName'] = 'Please enter your last name!';
	}
	
	// Check for an email address:
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$e = $_POST['email'];
		$_SESSION['email'] = $_POST['email'];
	} else {
		$shipping_errors['email'] = 'Please enter a valid email address!';
	}

	// Check for a street address:
	if (preg_match ('/^[A-Z0-9 \',.#-]{2,80}$/i', $_POST['address1'])) {
		$a1  = addslashes($_POST['address1']);
	} else {
		$shipping_errors['address1'] = 'Please enter your street address!';
	}

	// Check for a second street address:
	if (empty($_POST['address2'])) {
		$a2 = NULL;
	} elseif (preg_match ('/^[A-Z0-9 \',.#-]{2,80}$/i', $_POST['address2'])) {
		$a2 = addslashes($_POST['address2']);
	} else {
		$shipping_errors['address2'] = 'Please enter your street address!';
	}
	
	
	// Check for a country:
	if (preg_match ('/^[A-Z \'.-]{2,60}$/i', $_POST['country'])) {
		$c = addslashes($_POST['country']);
	} else {
		$shipping_errors['country'] = 'Please enter your country!';
	}
	// Check for a state:
	if (preg_match ('/^[A-Z]{2}$/', $_POST['state'])) {
		$s = $_POST['state'];
	} else {
		$shipping_errors['state'] = 'Please enter your state!';
	}
	
	// Check for a city:
	if (preg_match ('/^[A-Z \'.-]{2,60}$/i', $_POST['city'])) {
		$c = addslashes($_POST['city']);
	} else {
		$shipping_errors['city'] = 'Please enter your city!';
	}
	
	// Check for a zip code:
	if (preg_match ('/^(\d{5}$)|(^\d{5}-\d{4})$/', $_POST['zip'])) {
		$z = $_POST['zip'];
	} else {
		$shipping_errors['zip'] = 'Please enter your zip code!';
	}
	
	// Check for a phone number:
	// Strip out spaces, hyphens, and parentheses:
	$phone = str_replace(array(' ', '-', '(', ')'), '', $_POST['phone']);
	if (preg_match ('/^[0-9]{10}$/', $phone)) {
		$p  = $phone;
	} else {
		$shipping_errors['phone'] = 'Please enter your phone number!';
	}
	
	foreach ($shipping_errors as $value) {
		echo '<div class="alert alert-danger" id="error_span">' . $value . '</div>';
	}
	
	
	if (empty($shipping_errors)) { // If everything's OK...
		$_SESSION['shipping_for_billing'] = true;
		$_SESSION['firstName']  = $_POST['firstName'];
		$_SESSION['lastName']  = $_POST['lastName'];
		$_SESSION['email']  = $_POST['email'];
		$_SESSION['address']  = $_POST['address1'] . ' ' . $a2;
		$_SESSION['country'] = $_POST['country'];
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['state'] = $_POST['state'];
		$_SESSION['zip'] = $_POST['zip'];
		$_SESSION['phone'] = $_POST['phone'];
		
		// check if duplicate customer
		$q = "(SELECT id FROM customers WHERE (email = '" . $e . "') AND (last_name = '" . $ln . "') AND (address1 = '" . $a1 . "') ORDER by id DESC LIMIT 1)";
		$r = mysqli_query($dbc, $q);

		if (!$r) echo mysqli_error($dbc);

		if (mysqli_num_rows($r) == 1) {

			list($_SESSION['customer_id']) = mysqli_fetch_array($r);
			
		} else { 
			// Add the user to the database...
			$q1 = 'INSERT INTO customers (email, first_name, last_name, address1, address2, city, state, zip, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$affected = 0;
			$stmt1 = mysqli_prepare($dbc, $q1);
			mysqli_stmt_bind_param($stmt1, 'sssssssss', $e, $fn, $ln, $a1, $a2, $c, $s, $z, $p);
			mysqli_stmt_execute($stmt1);
			$affected += mysqli_stmt_affected_rows($stmt1);	
			if (!$affected > 0) echo mysqli_error($dbc);
			// Confirm that it worked:
			if ($affected > 0) {
				// Retrieve the customer ID:
				$q = 'SELECT id FROM customers ORDER BY id DESC LIMIT 0, 1';

				$r = mysqli_query($dbc, $q);
			
				if (mysqli_num_rows($r) == 1) {
					list($_SESSION['customer_id']) = mysqli_fetch_array($r);
					//exit();
				}
			} else {
				trigger_error('Your order could not be processed due to a system error 1. We apologize for the inconvenience.');
				exit();
			} // IF customer not on DB
		} // IF customer on DB
		
		if (isset($_SESSION['order_id']) && isset($_SESSION['order_total'])) { // Use existing order info:

			$oid = $_SESSION['order_id'];
			$order_total = $_SESSION['order_total'];
			
		} else { // Create a new order record:
			$cc_last_four = 1234;
			$shipping = 0;
			$customer_id = $_SESSION['customer_id'];
			$order_total = 2500;

			$q1 = 'INSERT INTO orders (customer_id, total, shipping, credit_card_number, order_date) VALUES (?, ?, ?, ?, NOW())';
			$affected = 0;
			$stmt1 = mysqli_prepare($dbc, $q1);
			mysqli_stmt_bind_param($stmt1, 'iiii', $customer_id, $order_total, $shipping, $cc_last_four);
			mysqli_stmt_execute($stmt1);
			$affected += mysqli_stmt_affected_rows($stmt1);	
			if (!$affected > 0) echo mysqli_error($dbc);
		
			// Confirm that it worked:
			if ($affected > 0) {

				$q = 'SELECT LAST_INSERT_ID()';

				$r = mysqli_query($dbc, $q);
				if (mysqli_num_rows($r) == 1) {
					list($oid) = mysqli_fetch_array($r);
				} else { // Could not retrieve the order ID and total.
					unset($_POST['cc_number'], $_POST['cc_cvv']);
					trigger_error('Your order could not be processed due to a system error 2. We apologize for the inconvenience.');
					exit();
				}
			} else { // The add_order() procedure failed.
				trigger_error('Your order could not be processed due to a system error 3. We apologize for the inconvenience.');
				exit();
			}
		}			
		
		
		$_SESSION['order_total'] = $order_total;
		$_SESSION['order_id'] = $oid;
		
		// Process the payment!
		if (isset($oid, $order_total)) {

			try {

				// Include the Stripe library:
				require_once('../vendor/autoload.php');
				$stripe = array(
					'secret_key'      => 'sk_test_GBsb65uAB1MefNcwXKRBmjp6',
					'publishable_key' => 'pk_test_JRGK5txjD4IIgyJU5ztDwSz1'
				);
				\Stripe\Stripe::setApiKey($stripe['secret_key']);
				// set your secret key: remember to change this to your live secret key in production

				// Charge the order:
				$charge = \Stripe\Charge::create(array(
					'amount' => $order_total,
					'currency' => 'usd',
					'card' => $token,
					'description' => $_SESSION['email'],
					'capture' => false
					)
				);


				// Did it work?
				if ($charge->paid == 1) {

					// Add slashes to two text values:
					$full_response = addslashes(serialize($charge));

					// Record the transaction:
					$charge_id = $charge->id;
					
					$q = 'INSERT INTO charges VALUES (NULL, "'. $charge_id .'", '. $oid .', "auth_only", '. $order_total .', "'. $full_response .'", NOW());';
					$r = mysqli_query($dbc, $q);
					// For debugging purposes:
					if (!$r) echo mysqli_error($dbc);

					
					// Add the transaction info to the session:
					$_SESSION['response_code'] = $charge->paid;  // = 1
					
					// Redirect to the next page:
					$location = BASE_URL . 'hero/' . 'final.php?id=' . htmlspecialchars(session_id());
					header("Location: $location");
					exit();
					//$message_paid = "Thank you for your donation to egret.tv!  A confirmation email has been sent to you.";
				} else {
					$message = $charge->response_reason_text;
					echo '<script type="text/javascript">alert("0'.$message.'");</script>';

				}

			} catch (\Stripe\Error\Card $e) { // Stripe declined the charge.
				$e_json = $e->getJsonBody();
				$err = $e_json['error'];
				$bankerror1 = $err['message'];
			
			//} catch (\Stripe\Error\RateLimit $e) { // Stripe declined the charge.
			//	$e_json = $e->getJsonBody();
			//	$err = $e_json['error'];
			//	$bankerror2 = $err['message'];
				
			//} catch (\Stripe\Error\InvalidRequest $e) { // Stripe declined the charge.
			//	$e_json = $e->getJsonBody();
			//	$err = $e_json['error'];
			//	$bankerror3 = $err['message'];
				
			//} catch (\Stripe\Error\Authentication $e) { // Stripe declined the charge.
			//	$e_json = $e->getJsonBody();
			//	$err = $e_json['error'];
			//	$bankerror4 = $err['message'];
			//} catch (\Stripe\Error\ApiConnection $e) { // Stripe declined the charge.
			//	$e_json = $e->getJsonBody();
			//	$err = $e_json['error'];
			//	$bankerror5 = $err['message'];
			//} catch (\Stripe\Error\Base $e) { // Stripe declined the charge.
			//	$e_json = $e->getJsonBody();
			//	$err = $e_json['error'];
			//	$bankerror6 = $err['message'];
			} catch (Exception $e) { // Try block failed somewhere else.
				$bankerror7 = $e->getMessage();
			}

		} // End of isset($order_id, $order_total) IF.
		
		// order processed - could be errors
		

	} // Errors occurred IF.

	
} // End of the main Submit conditional.

// display warning or error messages
if (isset($message)) { // this type of error message is a system error
	echo '<div class="alert alert-danger" id="error_span">$message</div>';	
} elseif (isset($bankerror1))		{ // this type of error message is a Stripe card return error
		echo "<div class=\"alert alert-danger\">1 $bankerror1</div>";
} elseif (isset($bankerror7))		{ // this type of error message is a Stripe card return error
		echo "<div class=\"alert alert-danger\">7 $bankerror7</div>";
} elseif (isset($message_paid))		{ // this type of error message is a Stripe card return error
		echo "<div class=\"alert alert-success\">7 $message_paid</div>";
} elseif (!empty($shipping_errors))		{ // this type of error message is a Stripe card return error
} else {
		echo '<div class="alert alert-info" id="error_span">Please enter all the fields below and click the Contribute button - if there is a card error look here for a message.</div>';
}
	
?>
<!-- page VIEW -->
	<div class="container">
      <div class="row">
        <p class="lead">With your gift, know that you're protecting the Long Island Sound.</p>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">1</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Donation</h6>
                <small class="text-muted">Thank you for your egret.tv contribution.</small>
              </div>
              <span class="text-muted">$25</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$25</strong>
            </li>
          </ul>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" novalidate action="/egrettv/hero/donation.php" method="POST" id="billing_form">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <!--<input type="text" class="form-control" id="firstName" placeholder="" value="" required> -->
				<?php create_form_input('firstName', 'text', $shipping_errors); ?>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <!--<input type="text" class="form-control" id="lastName" placeholder="" value="" required>-->
				<?php create_form_input('lastName', 'text', $shipping_errors); ?>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Required)</span></label>
              <!--<input type="email" class="form-control" id="email" placeholder="you@example.com" required>-->
				<?php create_form_input('email', 'email', $shipping_errors); ?>
              <div class="invalid-feedback">
                Please enter a valid email address for donations.
              </div>
            </div>

            <div class="mb-3">
              <label for="address1">Address</label>
              <!--<input type="text" class="form-control" id="address1" placeholder="1234 Main St" required>-->
				<?php create_form_input('address1', 'text', $shipping_errors); ?>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Apartment or suite"> 
			</div> 
			
			<div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="form-control" name="country" id="country" required>
                  <option value="" >Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="city">City</label>
                <!--<input type="text" class="form-control" id="city" placeholder="" required> -->
				<?php create_form_input('city', 'text', $shipping_errors); ?>
                <div class="invalid-feedback">
                  City required.
                </div>
              </div>
            </div>
			
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="form-control" name="state" id="state" required>
                  <option value="">Choose...</option>
                  <option>CA</option>
                   <option>CT</option>
               </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <!--<input type="text" class="form-control" id="zip" placeholder="" required> -->
				<?php create_form_input('zip', 'text', $shipping_errors); ?>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
               <div class="col-md-3 mb-3">
                <label for="phone">Phone</label>
				<?php create_form_input('phone', 'text', $shipping_errors); ?>
                <div class="invalid-feedback">
                  Phone number required.
                </div>
              </div>
           </div>
			
			
            <hr class="mb-4">
            <!-- <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div> -->
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Protect the Long Island Sound</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
				<div class="alert alert-danger">We are still in TEST mode. 4242424242424242 is a valid VISA number.  Try 4000000000000002 for card decline error.</div>
			</div>
			
           <div class="row">
             <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit Card Payments</label>
              </div>
			  <p>egret.tv does not store your credit card information in any way.  We use Stripe.com, one of the most secure and reputable payment processors available.</p>
              <!-- <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">PayPal</label>
              </div> -->
				</div>
           </div>
			<div class="row">
				<div class="col-lg-12">
					<div class="d-block my-3">
					<img class="img-responsive" style="float:left"; src="/egrettv/images/stripe_logo.jpg" width="20%" height="20%" />
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 mb-3">
                <label for="cc_number">Credit card number</label>
                <input type="text" class="form-control" id="cc_number" value="" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
				</div>
           </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc_exp_month">Expiration Date (MM)</label>
                <input type="text" class="form-control" id="cc_exp_month" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration MM required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc_exp_month">Expiration Date (YYYY)</label>
                <input type="text" class="form-control" id="cc_exp_year" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration YYYY required
                </div>
              </div>
			</div>
			<div class="row">
					<div class="col-md-3 mb-3">
						<label for="cc_cvv">CVV</label>
						<input type="text" class="form-control" id="cc_cvv" placeholder="" required>
						<div class="invalid-feedback">
						Security code required
						</div>
					</div>
			</div>
            <hr class="mb-4">
			<div class="row">
				<p class="lead">egret.tv is a non-profit organization.  Thank you for your generosity!</p>
			</div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Contribute</button>
          </form>
        </div>
	</div> <!-- /row -->
	</div> <!-- /container -->
	</div><!-- /jumbotron -->
</main>

      <footer>
       <?php
		include('footer.php');
		?>
      </footer>
</body>
</html>

<?php
ob_end_flush(); // send output buffer and turn off output buffering

?>
<script>
     // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');

            }, false);
          });
        }, false);
      })();
    </script>
<script type="text/javascript">
Stripe.setPublishableKey('pk_test_JRGK5txjD4IIgyJU5ztDwSz1');
</script> 

<script type="text/javascript" src="/egrettv/js/billing.js"></script>