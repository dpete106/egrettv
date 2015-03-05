<?php # login.php
// This is the login page for the site.
ob_start();
session_start();



include('header.php');

?>

    <div class="container">
<?php # login.php


require_once ('config.inc.php'); 

if (isset($_POST['submitted'])) {
	require_once ('../mysqli_connect.php'); 	
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = mysql_real_escape_string ($_POST['email']);
	} else {
		$e = FALSE;
		echo '<div class="alert alert-warning">You forgot to enter your email address!</div>';
		//echo '<p">You forgot to enter your email address!</p>';
	}
	
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = mysql_real_escape_string ($_POST['pass']);
	} else {
		$p = FALSE;
		echo '<div class="alert alert-warning">You forgot to enter your password!</div>';
		//echo '<p">You forgot to enter your password!</p>';
	}
	
	if ($e && $p) { // If everything's OK.
	
		// Query the database:
		$q = "SELECT user_id, first_name, user_level FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active IS NULL";		
		$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
		
		if (@mysql_num_rows($r) == 1) { // A match was made.

			// Register the values & redirect:
			$_SESSION = mysql_fetch_array ($r, MYSQL_ASSOC); 

			mysql_free_result($r);
			//mysql_close($dbc);
							
			$url = BASE_URL . 'index.php'; // Define the URL:
               // $url = 'http://www.egrettv.org/index.php'; // Define the URL:
			//ob_end_clean(); // Delete the buffer.
			
			//header("Location: $url");
			
			//exit(); // Quit the script.
			
			echo '<div class="alert alert-danger">logged in</div>';
				
		} else { // No match was made.
			echo '<div class="alert alert-danger">Either the email address and password entered do not match those on file or you have not yet activated your account.</div>';
			//echo '<p>Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
		}
		
	} else { // If everything wasn't OK.
		echo '<div class="alert alert-danger">Please try again.</div>';
		//echo '<p>Please try again.</p>';
	}
	
	mysql_close($dbc);

} // End of SUBMIT conditional.
?>

    <div class="row">
		<div class="span12">
		<h2>Login to egretTV.org</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>


	<form class="form-horizontal" action="login.php" method="post">
		<div class="control-group">
		<label class="control-label" for="inputEmail">Email</label>
		<div class="controls">
		<input type="text" id="inputEmail" placeholder="Email" name="email">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
		<input type="password" id="inputPassword" placeholder="Password" name="pass">
		</div>
		</div>
		<div class="control-group">
		<div class="controls">
		<label class="checkbox">
			<input type="checkbox"> Remember me
		</label>
		<input type="submit" name="submit" value="Sign In"/>
		</div>
		<input type="hidden" name="submitted" value="TRUE" />
		</div>
	</form>
      <hr>

      <footer>
        <p>&copy; egretTV.org 2015</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
echo session_id();
ob_end_flush();

?>