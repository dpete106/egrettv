<?php # forgot_password.php
// This page allows a user to reset their password, if forgotten.

ob_start();
session_start();
include('header.php');
?>
    <div class="container">
<?php # forgot_password.php
require_once ('config.inc.php'); 
include_once( 'class.php' );

if (isset($_POST['submitted'])) {
	
	// a space line
	echo "<br>";
	// Assume nothing:
	$uid = FALSE;

	// Validate the email address...
	if (!empty($_POST['email'])) {
		$esc_email = stripslashes( strip_tags( $_POST['email'] ) );
	
		$usr = new Users; 
		$usr->storeFormValues( $_POST );	
		
		if( $usr->userEmail() ) {
			
			$uid=TRUE;
			
		} else { // No database match made.
			echo '<div class="alert alert-warning">The submitted email address does not match those on file!</div>';
			
		}
		
	} else { // No email!
		echo '<div class="alert alert-warning">You forgot to enter your email address!</div>';
	} // End of empty($_POST['email']) IF.
	
	if ($uid) { // If everything's OK.
	// Create a new, random password:
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);
		if (  $usr->userForgot($p)  ) { // If it ran OK.
		
			// Send an email:
				$headers = "MIME-Version: 1.0" . PHP_EOL .
				"Content-type: text/html; charset=iso-8859-1" . PHP_EOL .
				"Envelope-to: $esc_email" . PHP_EOL .
				"Reply-To: davestorkman " . PHP_EOL .
				"Return-Path: davestorkman " . PHP_EOL .
				"From: davestorkman " . PHP_EOL .
				"Organization: egret.tv" . PHP_EOL .
				"Cc: " . PHP_EOL .
				"Bcc: " . PHP_EOL .
				"X-Mailer: PHP-" . phpversion() . PHP_EOL;
				$body = "Your password to log into egret.tv has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
				mail($esc_email, 'From: davestorkman@egret.tv', $body, $headers);
			
			// Print a message and wrap up:
			echo '<div class="alert alert-success">Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</div>';
			
                        echo '<br /><br /><br /><br />';
			
			
		} else { // If it did not run OK.
			echo '<div class="alert alert-danger">Your password could not be changed due to a system error. We apologize for any inconvenience.</div>'; 
			
		}

	} else { // Failed the validation test.
		echo '<div class="alert alert-danger">Please try again.</div>';
		
	}

} // End of the main Submit conditional.

?>

	
    <div class="row">
		<div class="col-md-12">
		<h2>Reset Your egret.tv Password If Forgotten</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>



	<form class="form-signin" action="forgot_password.php" method="post">
		<div class="form-group">
		<label for="inputEmail">Email Address:</label>
		<input type="text" id="inputEmail" placeholder="Email" name="email">
		</div>
		
		<div class="checkbox">
		<label>
			<input type="checkbox"> Remember me
		</label>
		</div>
		
		<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Reset My Password</button>
		<!--<input type="submit" name="submit" value="Reset My Password"/> -->
		</div>
		<input type="hidden" name="submitted" value="TRUE" />
		
		
	</form>
	
    </div>  
	</div>
	<hr>
      <footer>
        <p>&copy; egret.tv 2015</p>
      </footer>
		
	
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>

  </body>
</html>

<?php

ob_end_flush();

?>
