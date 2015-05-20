<?php # delete.php
// This page deletes a logged-in user from the database.

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
		
	$p = TRUE;

	
	if ($p) { // If everything's OK.

		// Make the query.
		
		
		$usr = new Users; 
		$usr->storeFormValues( $_POST );	
		$usr->user_id = $_SESSION['user_id'];
		
		if ( $usr->userDelete() ) { // If it ran OK.
			
			$_SESSION = array(); // Destroy the variables.
			session_destroy(); // Destroy the session itself.
			ob_end_clean(); // Delete the buffer.
			setcookie (session_name(), '', time()-300); // Destroy the cookie.
			$url = BASE_URL . 'index.php'; // Define the URL.
			header("Location: $url");
			exit();
			
		} else { // If it did not run OK.
			
			echo '<div class="alert alert-danger">Your account was not deleted. Please email davestorkman@egret.tv that an error occurred on  the website. Thank you.</div>'; 
			

		}

	} else { // Failed the validation test.
		echo '<div class="alert alert-danger">Please try again.</div>';		
				
	}
	
	

} // End of the main Submit conditional.

?>
    <div class="container">

    <div class="row">
		<div class="col-md-12">
		<div class="alert alert-danger">Are you sure you want to delete your Account?</div>
		<h2>Delete your account</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

		<form class="form-signin" action="delete.php" method="post">
		
		
		
		<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Delete My Account</button>
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
