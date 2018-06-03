<?php # delete.php
// This page deletes a logged-in user from the database.

ob_start(); // output stored in internal buffer
session_start();

include('header_test.php');
require_once ('config.inc.php');
include_once( 'class.php' );

// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['first_name'])) {
	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	
	
	header("Location: $url");
	exit(); // Quit the script.
	
}
?>
<main role="main">

    <div style="margin-left: 125px; margin-right: 125px;" class="jumbotron">
		<h1>Delete your egret.tv account</h1>
		<div class="alert alert-danger">Are you sure you want to delete your Account?</div>
		<hr>

<?php # delete.php

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
		<form class="needs-validation" novalidate="" action="../hero/delete.php" method="post">
			<div class="row">
				<button class="btn btn-primary btn-lg btn-block" type="submit">Delete</button>
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

ob_end_flush(); // send output buffer and turn off output buffering

?>
