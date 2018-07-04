<?php # donation.php
// This page allows a logged-in user to make a donation to egret.tv.

ob_start(); // output stored in internal buffer
session_start();
echo '1 = ' . session_id();
include('header_test.php');
require_once ('config.inc.php');
include_once( 'class.php' );
// Need the form function:
include('./form_functions.inc.php');

// If no first_name session variable exists, redirect the user:
if (isset($_SESSION['first_name'])) {
	echo '1 = ' . $_SESSION['firstName'];

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
	echo '2 = ' . $_SESSION['firstName'];

	//$url = BASE_URL . 'index.php'; // Define the URL.
	//ob_end_clean(); // Delete the buffer.
	
	
	//header("Location: $url");
	//exit(); // Quit the script.
	
} else {echo '3 = ' . session_id();}

// For storing errors:
$shipping_errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					
	
	// Check for Magic Quotes:
	if (get_magic_quotes_gpc()) {
		$_POST['firstName'] = stripslashes($_POST['firstName']);
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
	foreach ($shipping_errors as $value) {
		echo '<div class="alert alert-warning" id="error_span">' . $value . 'Thank you for your donation!</div>';
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
		echo '<div class="alert alert-warning" id="error_span">Thank you for your donation!</div>';
	} // Errors occurred IF.

	
} // End of the main Submit conditional.

?>
<!-- page VIEW -->
	<div class="container">
      <div class="row">
        <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Product name</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$12</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$8</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Third item</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$20</strong>
            </li>
          </ul>

          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" novalidate action="/egrettv/hero/donation.php" method="POST" id="donation_form">
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
            </div>
			
			
            <hr class="mb-4">
            <!-- <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div> -->
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <!-- <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">PayPal</label>
              </div> -->
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-cvv">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
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
if (isset($_SESSION['first_name'])) {
echo '4 = ' . $_SESSION['firstName'];
}
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