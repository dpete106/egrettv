<?php # change_password.php
// This page allows a logged-in user to change their password.

ob_start();
session_start();
include('header.html');

// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['first_name'])) {
	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
	
}

if (isset($_POST['submitted'])) {
	require_once ('../mysqli_connect.php'); 			
	// Check for a new password and match against the confirmed password:
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
		if ($_POST['password1'] == $_POST['password2']) {
			$p = mysql_real_escape_string ($_POST['password1']);
		} else {
			echo '<div class="alert alert-warning">Your password did not match the confirmed password!</div>';
			//echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<div class="alert alert-warning">Please enter a valid password!</div>';
		//echo '<p class="error">Please enter a valid password!</p>';
	}
	
	if ($p) { // If everything's OK.

		// Make the query.
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";	
		$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
		if (mysql_affected_rows($dbc) == 1) { // If it ran OK.
		
			// Send an email, if desired.
			echo '<div class="alert alert-success">Your password has been changed.</div>';
			mysql_close($dbc); // Close the database connection.
			//include ('includes/footer.html'); // Include the HTML footer.
			//exit();
			
		} else { // If it did not run OK.
		
			echo '<div class="alert alert-danger">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</div>'; 
			//echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</p>'; 

		}

	} else { // Failed the validation test.
		echo '<div class="alert alert-danger">Please try again.</div>';		
		//echo '<p class="error">Please try again.</p>';		
	}
	
	mysql_close($dbc); // Close the database connection.

} // End of the main Submit conditional.

?>
    <div class="container">

    <div class="row">
		<div class="span12">
		<h2>Change your password</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>
		<form class="form-horizontal" action="change_password.php" method="post">
		<div class="control-group">
		<label class="control-label" for="inputnewPassword">New Password:</label>
		<div class="controls">
		<input type="password" id="inputnewPassword" placeholder="NewPassword" name="password1">
		<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
		<input type="password" id="inputPassword" placeholder="Password" name="password2">
		</div>
		</div>
		<div class="control-group">
		<div class="controls">
		<label class="checkbox">
			<input type="checkbox"> Remember me
		</label>
		<input type="submit" name="submit" value="Change My Password"/>
		</div>
		<input type="hidden" name="submitted" value="TRUE" />
		</div>
	</form>
      <hr>

<!--<form action="change_password.php" method="post">
	<fieldset><div align=center>
	<p><b><font color=#FF8C00>New Password:</font></b> <input type="password" name="password1" size="20" maxlength="20" /> <font color=#FF8C00><small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></font></p>
	<p><b><font color=#FF8C00>Confirm New Password:</font></b> <input type="password" name="password2" size="20" maxlength="20" /></p>
	</div></fieldset>
	<div align="center"><input type="submit" name="submit" value="Change My Password" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
</form><br /><br /><br /><br /><br /><br />-->

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

ob_end_flush();

?>
