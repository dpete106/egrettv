<?php # register.php
// This is the registration page for the site.

ob_start();
session_start();

include('header_test.php');
require_once ('config.inc.php'); 
include_once( 'class.php' );

function slotnumber()
{
  srand(time());
    for ($i=0; $i < 3; $i++)
    {
      $random = (rand()%9);
      $slot[] = $random;
    }
$number = $slot[0] . $slot[1] . $slot[2];
// echo $number;
return $number;
}
?>
<main role="main">

    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
		<h1>Join the egret.tv Community</h1>

      <hr>
<?php # register.php

if (isset($_POST['submitted'])) { // Handle the form.

	// a space line
	echo "<br>";	
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	
	// Assume invalid values:
	$fn = $ln = $rn = $e = $p = FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		
		$fn = stripslashes( strip_tags( $trimmed['first_name'] ) );
	} else {
		echo '<div class="alert alert-warning">Please enter your first name!</div>';
		
	}
	
	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = stripslashes( strip_tags( $trimmed['last_name'] ) );
	} else {
		echo '<div class="alert alert-warning">Please enter your last name!</div>';
		
	}

	// Check for random number equal to entered number:
	//echo "1 " . $trimmed['numbers'];
	//if ($_SESSION['rand_number'] != $trimmed['numbers']) {
	//	echo '<div class="alert alert-warning">Please enter the 3 displayed numbers!</div>';
		// echo '<p class="error">Please enter the 3 displayed numbers!</p>';
	//}

	// Check for an email address:
	if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])) {
		
		$emailcheck = stripslashes( strip_tags( $trimmed['email'] ) );
		if (email_check($emailcheck) ) {
			$e = $emailcheck;
		} else {
			echo '<div class="alert alert-warning">Please enter a valid email address!!</div>';		
		}
	} else {
		echo '<div class="alert alert-warning">Please enter a valid email address!</div>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = stripslashes( strip_tags( $trimmed['password1'] ) );
		} else {
			echo '<div class="alert alert-warning">Your password did not match the confirmed password!</div>';
			}
	} else {
		echo '<div class="alert alert-warning">Please enter a valid password!</div>';
		
	}
	
	if ($fn && $ln && $e && $p) { // If everything's OK...

		// Make sure the email address is available:
		$usr = new Users; 
		$usr->storeFormValues( $_POST );	
		
		if ( !$usr->userEmail() ) { // Available.
			
			// Create the activation code:
			$a = md5(uniqid(rand(), true));
		
			// Add the user to the database:
			
			
			if (  $usr->userRegister($a)  ) { // If it ran OK.
			
				$encrypt = SHA1($p);

				// Send the email:
				
				$headers = "MIME-Version: 1.0" . PHP_EOL .
				"Content-type: text/html; charset=iso-8859-1" . PHP_EOL .
				"Envelope-to: $e" . PHP_EOL .
				"Reply-To: storkman " . PHP_EOL .
				"Return-Path: storkman " . PHP_EOL .
				"From: storkman " . PHP_EOL .
				"Organization: egret.tv" . PHP_EOL .
				"Cc: " . PHP_EOL .
				"Bcc: " . PHP_EOL .
				"X-Mailer: PHP-" . phpversion() . PHP_EOL;				
				$body = "Thank you for registering at egret.tv. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'hero/activate.php?x=' . urlencode($e) . "&y=$a";
				//test
				//mail($trimmed['email'], 'From: davestorkman@egret.tv', $body, $headers);
				
				// Finish the page:
				echo '<div class="alert alert-success">Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</div>';

				
			} else { // If it did not run OK.
				echo '<div class="alert alert-danger">You could not be registered due to a system error. We apologize for any inconvenience.</div>';
				
			}
			
		} else { // The email address is not available.
			echo '<div class="alert alert-warning">That email address has already been registered. If you have forgotten your password, use the link above to have your password sent to you.</div>';
			
		}
		
	} else { // If one of the data tests failed.
		echo '<div class="alert alert-danger">Please re-enter your passwords and try again.</div>';
		
	}
	//antispam code
    //$_SESSION['rand_number'] = slotnumber();
	

} // End of the main Submit conditional.
else {

  //$_SESSION['rand_number'] = slotnumber();
  }

?>

	<div class="container">

	<!-- <form class="needs-validation" novalidate="" action="../hero/register.php" method="post" onsubmit="return validateRecaptcha();"> -->
	<form class="needs-validation" novalidate="" action="../hero/register.php" method="post">
		<div class="row">
			<div class="col-md-6 mb-3">
				<label for="inputFirstName">First Name</label>
				<input type="text" class="form-control" name="first_name" id="inputFirstName" placeholder="" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" required="">
				<div class="invalid-feedback">
				Valid First Name is required.
				</div>
			</div>
			
			<div class="col-md-6 mb-3">
				<label for="inputLastName">Last Name</label>
				<input type="text" class="form-control" name="last_name" id="inputLastName" placeholder="" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" required="">
				<div class="invalid-feedback">
					Valid Last Name is required.
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12 mb-3">
				<label for="email">Email</label>
				<input type="email" class="form-control" name="email" id="inputEmail" placeholder="" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" required="">
				<div class="invalid-feedback">
				Valid Email is required.
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-6 mb-3">
				<label for="inputPassword">Password</label>
				<input type="password" class="form-control" name="password1" id="inputPassword" placeholder="" value="" required="">
				<div class="invalid-feedback">
					Valid Password is required.
				</div>
			</div>
			
			<div class="col-md-6 mb-3">
				<label for="inputConPassword">Confirm Password</label>
				<input type="password" class="form-control" name="password2" id="inputConPassword" placeholder="" value="" required="">
				<div class="invalid-feedback">
					Valid Confirm Password is required.
				</div>
			</div>
		</div>
		
		
		<!-- <div class="row">
			<div class="col-md-8 mb-3">
				<?php echo $_SESSION['rand_number']; ?>
				<label for="inputNumbers">Enter these numbers</label>
				<input type="text" class="form-control" name="numbers" id="inputNumbers" placeholder="" value="" required="">
				<div class="invalid-feedback">
				Valid numbers are required.
				</div>
				<p>To prevent spam please enter the 3 numbers displayed above and to the left.</p>
			</div>
		
		
			<div class="col-md-4 mb-3">
				<div class="checkbox">
				<label>
				<input type="checkbox"> Remember me
				</label>
				</div>
			</div>
		
		</div> -->
		
		<div class="row">
			<div class="col-md-12 mb-3">
				<div class="g-recaptcha" data-sitekey="6LdPeXQaAAAAANQOapaNryRPnFTo7QzkHJiEQZ8R"></div>
			</div>
		</div>
		
		<button class="btn btn-primary btn-lg btn-block" type="submit">Join egret.tv</button>
		
		<input type="hidden" name="submitted" value="TRUE" />
		
	</form>


    </div> <!-- /container -->
	</div><!-- /jumbotron -->
</main>

      <footer>
       <?php
		include('footer.php');
		?>
      </footer>

	<script type="text/javascript">
  var onloadCallback = function() {
  };
  function validateRecaptcha() {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
            alert("click not a robot");
            return false;
        } else {
           // alert("validated");
            return true;
        }
    }
	</script>

	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
	</script>
 
  </body>
</html>
<?php
function email_check($email){
	$pattern = "/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD";
	if (preg_match("/[\\000-\\037]/",$email)) { //check for all the non-printable codes in the standard ASCII set
		return false;
	}
	if(!preg_match($pattern, $email)){ // pattern match the email
		return false;
	}
	list($users,$domain) = explode('@',$email); // Validate the domain exists
	if( function_exists('checkdnsrr') ) {
		if( !checkdnsrr($domain,"MX") ) {
			return false;
		}
	} elseif( function_exists("getmxrr") ) {
		if ( !getmxrr($domain, $mxhosts) ) {
			return false;
		}
	}
	return true;
}
ob_end_flush();

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
