<?php # forgot_password.php
// This page allows a user to reset their password, if forgotten.

ob_start();
session_start();
include('header_test.php');
require_once ('config.inc.php'); 
include_once( 'class.php' );
?>
<main role="main">

    <div style="margin-left: 125px; margin-right: 125px;" class="jumbotron">
		<h1>Reset Your egret.tv Password If Forgotten</h1>
		<hr>

<?php # forgot_password.php
if (isset($_POST['submitted'])) {
	
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
				"Reply-To: storkman " . PHP_EOL .
				"Return-Path: storkman " . PHP_EOL .
				"From: storkman " . PHP_EOL .
				"Organization: egret.tv" . PHP_EOL .
				"Cc: " . PHP_EOL .
				"Bcc: " . PHP_EOL .
				"X-Mailer: PHP-" . phpversion() . PHP_EOL;
				$body = "Your password to log into egret.tv has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
				mail($esc_email, 'From: dpete106@gmail.com', $body, $headers);
			
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
	<div class="container">
		<form class="needs-validation" novalidate="" action="../hero/forgot_password.php" method="post">
			<div class="row">
				<div class="col-md-6 mb-3">
				<label for="inputEmail">Email</label>
				<input type="email" class="form-control" name="email" id="inputEmail" placeholder="" value="" required="">
				<div class="invalid-feedback">
						Valid email is required.
				</div>
				</div>	
			</div> <!-- row -->
		
			<div class="row">
				<button class="btn btn-primary btn-lg btn-block" type="submit">Reset My Password</button>
				<input type="hidden" name="submitted" value="TRUE" />
		
			</div> <!-- row -->
		</form>
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