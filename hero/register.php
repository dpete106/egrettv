<?php # register.php
// This is the registration page for the site.

ob_start();
session_start();

include('header.php');
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
	if ($_SESSION['rand_number'] != $trimmed['numbers']) {
		echo '<div class="alert alert-warning">Please enter the 3 displayed numbers!</div>';
		// echo '<p class="error">Please enter the 3 displayed numbers!</p>';
	}

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
			
			
			if (  $usr->userRegister()  ) { // If it ran OK.
			
				$encrypt = SHA1($p);

				// Send the email:
				
				$headers = "MIME-Version: 1.0" . PHP_EOL .
				"Content-type: text/html; charset=iso-8859-1" . PHP_EOL .
				"Envelope-to: $e" . PHP_EOL .
				"Reply-To: davestorkman " . PHP_EOL .
				"Return-Path: davestorkman " . PHP_EOL .
				"From: davestorkman " . PHP_EOL .
				"Organization: egret.tv" . PHP_EOL .
				"Cc: " . PHP_EOL .
				"Bcc: " . PHP_EOL .
				"X-Mailer: PHP-" . phpversion() . PHP_EOL;				
				$body = "Thank you for registering at egret.tv. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'hero/activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'From: davestorkman@egret.tv', $body, $headers);
				
				// Finish the page:
				echo '<div class="alert alert-success">Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</div>';

				
			} else { // If it did not run OK.
				echo '<div class="alert alert-danger">You could not be registered due to a system error. We apologize for any inconvenience.</div>';
				
			}
			
		} else { // The email address is not available.
			echo '<div class="alert alert-warning">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</div>';
			
		}
		
	} else { // If one of the data tests failed.
		echo '<div class="alert alert-danger">Please re-enter your passwords and try again.</div>';
		
	}
        $_SESSION['rand_number'] = slotnumber();
	

} // End of the main Submit conditional.
else {

  $_SESSION['rand_number'] = slotnumber();
  }

?>
<div class="container">

    <div class="row">
		<div class="col-md-12">
		<h2>Join the egret.tv Community</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>


	<form class="form-signin" action="register.php" method="post">
		<div class="form-group">
		<label for="inputFirstName">First Name:</label>
		<input type="text" id="inputFirstName" placeholder="FirstName" name="first_name" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>">
		</div>
		
		<div class="form-group">
		<label for="inputLastName">Last Name:</label>
		<input type="text" id="inputLastName" placeholder="LastName" name="last_name" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>">
		</div>
		
		<div class="form-group">
		<label for="inputEmail">Email Address:</label>
		<input type="text" id="inputEmail" placeholder="Email" name="email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>">
		</div>
		
		<div class="form-group">
		<label for="inputPassword">Password:</label>
		<input type="password" id="inputPassword" placeholder="Password" name="password1">
		<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
		</div>
		
		<div class="form-group">
		<label class="sr-label" for="inputConPassword">Confirm Password:</label>
		<input type="password" id="inputConPassword" placeholder="ConPassword" name="password2">
		</div>
		
		<div class="form-group">
		<?php echo $_SESSION['rand_number']; ?>
		
		<label for="inputNumbers">Enter these numbers </label>
		<input type="text" id="inputNumbers" placeholder="Numbers" name="numbers">
		<p>To prevent spam please enter the 3 numbers displayed above and to the left.</p>
		</div>
		
		<div class="checkbox">
		<label>
			<input type="checkbox"> Remember me
		</label>
		</div>
		
		<div class="form-group">
		<!-- <input type="submit" name="submit" value="Join egretTV"/> -->
		<button class="btn btn-lg btn-primary btn-block" type="submit">Join egret.tv</button>
		<input type="hidden" name="submitted" value="TRUE" />
		</div>
	</form>


	</div>
	</div> <!-- row -->
      <hr>
      <footer>
        <p>&copy; egret.tv 2015</p>
      </footer>

    </div> <!-- container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
 
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
