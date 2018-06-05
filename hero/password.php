<?php # password.php
// This page lets a user change their password without logging in.

//$page_title = 'egret bird Change Password';
//$page_desc = 'egretTV is about egret and heron birds in their natural habitat of Connecticut&#39;s Long Island Sound ecosystem, dedicated to protection of the environment';
ob_start();
session_start();
include('header_test.php');
require_once ('config.inc.php'); 
include_once( 'class.php' );

?>
<main role="main">

    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
		<h1>Change your egret.tv password without having to login</h1>
		<hr>

<?php # login.php
// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		
		$esc_email = stripslashes( strip_tags( $_POST['email'] ) );
	}
	
	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {

		
		$p = stripslashes( strip_tags( $_POST['pass'] ) );
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['password1'])) {
		if ($_POST['password1'] != $_POST['password2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
				if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
			
					$np = stripslashes( strip_tags( $_POST['password1'] ) );
				} else {
					$errors[] = 'Please enter a valid password!';
				}
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
	
		$usr = new Users; 
		$usr->storeFormValues( $_POST );	
		
		if( $usr->userEmail() ) { // user found
		
			$p = $usr->password1;
			if (  $usr->userForgot($p)  ) { // If it ran OK.
			
				// Print a message.
				echo '<div class="alert alert-success"><b>Thank you!</b> Your password has been updated.</div>';
			
			} else { // If it did not run OK.
			
				// Public message:
				echo '<h2>System Error</h2>
				<div class="alert alert-danger">Your password could not be changed due to a system error. We apologize for any inconvenience.</div>'; 
				
			
			}

		
		} else { // Invalid email address/password combination.
			echo '<div class="alert alert-danger">The email address and password do not match those on file.</div>';
		}
		
	} else { // Report the errors.
	
		echo '<div class="alert alert-warning">The following error(s) occurred:</div>';
		foreach ($errors as $msg) { // Print each error.
			echo "<div class='alert alert-warning'>$msg</div>";
		}
		echo '<div class="alert alert-danger">Please try again.</div>';
		
	} // End of if (empty($errors)) IF.

} // End of the main Submit conditional.
?>
	<div class="container">
		<form class="needs-validation" novalidate="" action="../hero/password.php" method="post">
			<div class="row">
		
				<div class="col-md-6 mb-3">
				<label for="inputEmail">Email</label>
				<input type="email" class="form-control" name="email" id="inputEmail" placeholder="" value="" required="">
				<div class="invalid-feedback">
						Valid email is required.
				</div>
				</div>	
		
				<div class="col-md-6 mb-3">
				<label for="inputPassword">Current Password</label>
				<input type="password" class="form-control" name="pass" id="inputPassword" placeholder="" value="" required="">
				<div class="invalid-feedback">
						Valid password is required.
				</div>
				</div>
			</div>
					
			<div class="row">
				<div class="col-md-6 mb-3">
				<label for="inputnewPassword">New Password</label>
				<input type="password" class="form-control" name="password1" id="inputnewPassword" placeholder="" value="" required="">
				<div class="invalid-feedback">
						Valid password is required.
				</div>
				<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
				</div>	
		
				<div class="col-md-6 mb-3">
				<label for="inputConPassword">Confirm New Password</label>
				<input type="password" class="form-control" name="password2" id="inputConPassword" placeholder="" value="" required="">
				<div class="invalid-feedback">
						Valid password is required.
				</div>
				</div>
			</div>
		
			<div class="row">
				<button class="btn btn-primary btn-lg btn-block" type="submit">Reset My Password</button>
				<input type="hidden" name="submitted" value="TRUE" />
			</div>
		
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