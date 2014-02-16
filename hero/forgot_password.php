<?php # forgot_password.php
// This page allows a user to reset their password, if forgotten.

ob_start();
session_start();
include('header.html');
?>
    <div class="container">
<?php # forgot_password.php
require_once ('config.inc.php'); 

if (isset($_POST['submitted'])) {
	require_once ('../mysqli_connect.php'); 

	// Assume nothing:
	$uid = FALSE;

	// Validate the email address...
	if (!empty($_POST['email'])) {
	
		// Check for the existence of that email address...
		$q = 'SELECT user_id FROM users WHERE email="'.  mysql_real_escape_string ($_POST['email']) . '"';
		$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
		
		if (mysql_num_rows($r) == 1) { // Retrieve the user ID:
			list($uid) = mysql_fetch_array ($r, MYSQL_NUM); 
		} else { // No database match made.
			echo '<div class="alert alert-warning">The submitted email address does not match those on file!</div>';
			//echo '<p class="error">The submitted email address does not match those on file!</p>';
		}
		
	} else { // No email!
		echo '<div class="alert alert-warning">You forgot to enter your email address!</div>';
		//echo '<p class="error">You forgot to enter your email address!</p>';
	} // End of empty($_POST['email']) IF.
	
	if ($uid) { // If everything's OK.

		// Create a new, random password:
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);

		// Update the database:
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
		$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
		
		if (mysql_affected_rows($dbc) == 1) { // If it ran OK.
		
			// Send an email:
			$body = "Your password to log into egretTV has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
			mail ($_POST['email'], 'From: david_petersen@egrettv.org', $body);
			
			// Print a message and wrap up:
			echo '<div class="alert alert-success">Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</div>';
			//echo '<h2>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h2>';
                        echo '<br /><br /><br /><br />';
			//mysql_close($dbc);
			//exit(); // Stop the script.
			
		} else { // If it did not run OK.
			echo '<div class="alert alert-danger">Your password could not be changed due to a system error. We apologize for any inconvenience.</div>'; 
			//echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
		}

	} else { // Failed the validation test.
		echo '<div class="alert alert-danger">Please try again.</div>';
		//echo '<p class="error">Please try again.</p>';
	}

	mysql_close($dbc);

} // End of the main Submit conditional.

?>


    <div class="row">
		<div class="span12">
		<h2>Reset Your egretTV Password If Forgotten</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>


	<form class="form-horizontal" action="forgot_password.php" method="post">
		<div class="control-group">
		<label class="control-label" for="inputEmail">Email Address:</label>
		<div class="controls">
		<input type="text" id="inputEmail" placeholder="Email" name="email">
		</div>
		</div>
		<div class="control-group">
		<div class="controls">
		<label class="checkbox">
			<input type="checkbox"> Remember me
		</label>
		<input type="submit" name="submit" value="Reset My Password"/>
		</div>
		<input type="hidden" name="submitted" value="TRUE" />
		</div>
		
	</form>
      <hr>

      <footer>
        <p>&copy; egretTV.org 2014</p>
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
