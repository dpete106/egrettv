<?php # password.php
// This page lets a user change their password without logging in.

//$page_title = 'egret bird Change Password';
//$page_desc = 'egretTV is about egret and heron birds in their natural habitat of Connecticut&#39;s Long Island Sound ecosystem, dedicated to protection of the environment';
ob_start();
session_start();
include('header.php');
require_once ('config.inc.php'); 
include_once( 'class.php' );

?>
    <div class="container">

<?php # login.php
// a space line
echo "<br>";
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

    <div class="row">
		<div class="col-md-12">
		<h2>Change your egret.tv password without having to login</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

	

		<form class="form-signin" action="password.php" method="post">
		
		<div class="form-group">
		<label for="inputEmail">Email Address:</label>
		<input type="text" id="inputEmail" placeholder="Email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
		</div>
		
		<div class="form-group">
		<label for="inputPassword">Current Password:</label>
		<input type="password" id="inputPassword" placeholder="Password" name="pass">
		</div>
		
		<div class="form-group">
		<label for="inputnewPassword">New Password:</label>
		<input type="password" id="inputnewPassword" placeholder="NewPassword" name="password1">
		<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
		</div>
		
		<div class="form-group">
		<label for="inputConPassword">Confirm New Password:</label>
		<input type="password" id="inputConPassword" placeholder="ConPassword" name="password2">
		</div>
		
		<div class="checkbox">
		<label>
			<input type="checkbox"> Remember me
		</label>
		</div>
		
		<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Reset My Password</button>
		<!-- <input type="submit" name="submit" value="Change Password"/> -->
		<input type="hidden" name="submitted" value="TRUE" />
		</div>
		
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
