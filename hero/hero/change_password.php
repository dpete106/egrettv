<?php # change_password.php
// This page allows a logged-in user to change their password.

ob_start(); // output stored in internal buffer
session_start();

include('header.php');
require_once ('config.inc.php');
include_once( 'class.php' );

// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['first_name'])) {
	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	
	
	header("Location: $url");
	exit(); // Quit the script.
	
}
// a space line
echo "<br>";

if (isset($_POST['submitted'])) {
					
	// Check for a new password and match against the confirmed password:
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
		if ($_POST['password1'] == $_POST['password2']) {
			
			$p = stripslashes( strip_tags( $_POST['password1'] ) );
		} else {
			echo '<div class="alert alert-warning">Your password did not match the confirmed password!</div>';
			
		}
	} else {
		echo '<div class="alert alert-warning">Please enter a valid password!</div>';
		
	}
	
	if ($p) { // If everything's OK.

		// Make the query.
		
		$usr = new Users; 
		$usr->storeFormValues( $_POST );	
		$usr->user_id = $_SESSION['user_id'];
		
		if ( $usr->userForgot($p) ) { // If it ran OK.
			
			// Send an email, if desired.
			echo '<div class="alert alert-success">Your password has been changed.</div>';
			
		} else { // If it did not run OK.
		
			echo '<div class="alert alert-danger">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</div>'; 
			

		}

	} else { // Failed the validation test.
		echo '<div class="alert alert-danger">Please try again.</div>';		
		
	}
	
} // End of the main Submit conditional.

?>
    <div class="container">

    <div class="row">
		<div class="col-md-12">
		<h2>Change your password</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

		<form class="form-signin" action="change_password.php" method="post">
		
		<div class="form-group">
		<label for="inputnewPassword">New Password:</label>
		<input type="password" id="inputnewPassword" placeholder="NewPassword" name="password1" required autofocus>
		<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
		</div>
		
		<div class="form-group">
		<label for="inputPassword">Password:</label>
		<input type="password" id="inputPassword" placeholder="Password" name="password2" required autofocus>
		</div>
		
		<div class="checkbox">
		<label class="checkbox">
			<input type="checkbox"> Remember me
		</label>
		</div>
		
		<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Change My Password</button>
		<!--<input type="submit" name="submit" value="Change My Password"/> -->
		
		<input type="hidden" name="submitted" value="TRUE" />
		</div>
	</form>
      <hr>

	</div>
	</div>

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

ob_end_flush(); // send output buffer and turn off output buffering

?>
