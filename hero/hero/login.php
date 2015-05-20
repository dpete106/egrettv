<?php # login.php
// This is the login page for the site.
ob_start();
session_start();



include('header.php');

?>

    <div class="container">
<?php # login.php


require_once ('config.inc.php'); 
include_once( 'class.php' );



if (isset($_POST['submitted'])) {
		
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = stripslashes( strip_tags( $_POST['email'] ) );
		
	} else {
		$e = FALSE;
		echo '<div class="alert alert-warning">You forgot to enter your email address!</div>';
		//echo '<p">You forgot to enter your email address!</p>';
	}
	
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = stripslashes( strip_tags( $_POST['pass'] ) );
	} else {
		$p = FALSE;
		echo '<div class="alert alert-warning">You forgot to enter your password!</div>';
		//echo '<p">You forgot to enter your password!</p>';
	}
	
	if ($e && $p) { // If everything's OK.
		$usr = new Users; 
		$usr->storeFormValues( $_POST );	
//echo "pass1 " . hash("sha1", $usr->pass) . "<br>";
//echo "pass2 " . $usr->pass;
		// Query the database:
		if( $usr->userLogin() ) {
			$url = BASE_URL . 'index.php'; // Define the URL:
               
			//ob_end_clean(); // Delete the buffer.
			
			header("Location: $url");
			
			exit(); // Quit the script.
		} else { // No match was made.
			echo '<div class="alert alert-danger">Either the email address and password entered do not match those on file or you have not yet activated your account.</div>';
			
		}
		
	} else { // If everything wasn't OK.
		echo '<div class="alert alert-danger">Please try again.</div>';
		
	}
} // End of SUBMIT conditional.
?>
	<div class="container">
    <div class="row">
		<div class="col-md-12">
		<h2>Login to egretTV.org</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>
	</div>

      <hr>

      <footer>
        <p>&copy; egretTV.org 2015</p>
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
//echo session_id();
ob_end_flush();

?>
