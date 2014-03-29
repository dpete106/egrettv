<?php # activate.php
// This page activates the user's account.
ob_start();
session_start();
include('header.html');
?>
    <div class="container">
<?php # activate.php
require_once ('config.inc.php'); 

$x = $y = FALSE;
if (isset($_GET['x']) && preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_GET['x']) ) {
	$x = $_GET['x'];
}
if (isset($_GET['y']) && (strlen($_GET['y']) == 32 ) ) {
	$y = $_GET['y'];
}

if ($x && $y) {

	require_once ('../mysqli_connect.php'); 
	$q = "UPDATE users SET active=NULL WHERE (email='" . mysql_real_escape_string($x) . "' AND active='" . mysql_real_escape_string($y) . "') LIMIT 1";
	$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
	
	if (mysql_affected_rows($dbc) == 1) {
		echo "<h2>Your account is now active. You may now log in.</h2>";
	} else {
		echo '<p class="error">Your account could not be activated. Please re-check the link or contact the system administrator.</font></p>'; 
	}

	mysql_close($dbc);

} else { // Redirect.

	$url = BASE_URL . 'index.php'; // Define the URL:
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.

} 

?>
    <div class="row">
		<div class="span12">
		<h2>Activate Account to egretTV.org</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>
      <footer>
        <p>&copy; egretTV.org 2013</p>
      </footer>

    </div> <!-- /container -->

    <script src="../scripts/js/jquery-1.10.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <!-- 
    <script src="../bootstrap/js/bootstrap-transition.js"></script>
    <script src="../bootstrap/js/bootstrap-alert.js"></script>
    <script src="../bootstrap/js/bootstrap-modal.js"></script>
    <script src="../bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../bootstrap/js/bootstrap-tab.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-popover.js"></script>
    <script src="../bootstrap/js/bootstrap-button.js"></script>
    <script src="../bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../bootstrap/js/bootstrap-carousel.js"></script>
    <script src="../bootstrap/js/bootstrap-typeahead.js"></script>
    -->
  </body>
</html>

<?php

ob_end_flush();

?>
