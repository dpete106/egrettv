<?php # activate.php
// This page activates the user's account.
ob_start();
session_start();
include('header_test.php');
?>
    <div class="container">
<?php # activate.php
require_once ('config.inc.php'); 
include_once( 'class.php' );

echo '<div class="jumbotron">';
// a space line
echo "<br>";
// Validate $_GET['x'] and $_GET['y']:
$x = $y = FALSE;
if (isset($_GET['x']) && preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_GET['x']) ) {
	$x = $_GET['x'];
}
if (isset($_GET['y']) && (strlen($_GET['y']) == 32 ) ) {
	$y = $_GET['y'];
}

// If $x and $y aren't correct, redirect the user.
if ($x && $y) {

	// Update the database...
	//require_once ('../mysqli_connect.php'); 
	//$q = "UPDATE users SET active=NULL WHERE (email='" . mysql_real_escape_string($x) . "' AND active='" . mysql_real_escape_string($y) . "') LIMIT 1";
	
	
	// Print a customized message:
	//if ( $stmt = mysqli_prepare($dbc, "UPDATE users SET active=NULL WHERE (email=? AND active=?) LIMIT 1") ) {
	//	$esc_x=mysqli_real_escape_string($dbc,$x);
	//	$esc_y=mysqli_real_escape_string($dbc,$y);
	//	mysqli_stmt_bind_param( $stmt, "ss", $esc_x,$esc_y );
	//	mysqli_stmt_execute($stmt);	
	$usr = new Users; 
	
	if (  $usr->userActivate($x, $y)  ) { // If it ran OK.
		echo "<div class='alert alert-success'><h2>Your account is now active. You may now log in.</h2></div>";
	} else {
		echo "<div class='alert alert-danger'><p class='error'>Your account could not be activated. Please re-check the link or contact the system administrator.</font></p></div>"; 
	}

	//mysqli_close($dbc);

} else { // Redirect.

	$url = BASE_URL . 'index.php'; // Define the URL:
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.

} // End of main IF-ELSE.

?>
    <div class="row">
		<div class="col-md-12">
		<h2>Activate Account to egret.tv</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>
	</div>
	<hr>
	
      <footer>
       <?php
		include('footer.php');
		?>
      </footer>

    </div> <!-- /container -->

 
  </body>
</html>

<?php

ob_end_flush();

?>
