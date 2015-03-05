<?php # password.php
// This page lets a user change their password.

//$page_title = 'egret bird Change Password';
//$page_desc = 'egretTV is about egret and heron birds in their natural habitat of Connecticut&#39;s Long Island Sound ecosystem, dedicated to protection of the environment';
ob_start();
session_start();
include('header.html');

?>
    <div class="container">

<?php # login.php

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	require_once ('../mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = trim($_POST['email']);
	}
	
	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
//		$p = trim($_POST['pass']);
$p = mysql_real_escape_string(trim($_POST['pass']));
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = trim($_POST['pass1']);
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Check that they've entered the right email address/password combination:
		$q = "SELECT user_id FROM users WHERE (email='$e' AND pass=SHA1('$p') )";
		$r = mysql_query($q);
		$num = mysql_num_rows($r);
		if ($num == 1) { // Match was made.
		
			// Get the user_id:
			$row = mysql_fetch_array($r, MYSQL_NUM);

			// Make the UPDATE query:
			$q = "UPDATE users SET pass=SHA1('$np') WHERE user_id=$row[0]";		
			$r = mysql_query($q);
			
			if (mysql_affected_rows($dbc) == 1) { // If it ran OK.
			
				// Print a message.
				echo '<div class="alert alert-success"><b>Thank you!</b> Your password has been updated.</div>';
			
			} else { // If it did not run OK.
			
				// Public message:
				echo '<h2>System Error</h2>
				<div class="alert alert-danger">Your password could not be changed due to a system error. We apologize for any inconvenience.</div>'; 
				
				// Debugging message:
				echo '<p>' . mysql_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
				
			}

			// Include the footer and quit the script (to not show the form).
			//include ('includes/footer.html'); 
			//exit();
				
		} else { // Invalid email address/password combination.
			echo '<div class="alert alert-danger">The email address and password do not match those on file.</div>';
		}
		
	} else { // Report the errors.
	
		echo '<h2>Error!</h2>
		<div class="alert alert-warning">The following error(s) occurred:</div>';
		foreach ($errors as $msg) { // Print each error.
			echo "<div class='alert alert-warning'>$msg</div>";
		}
		echo '<div class="alert alert-danger">Please try again.</div>';
		
	} // End of if (empty($errors)) IF.

	mysql_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>

    <div class="row">
		<div class="span12">
		<h2>Change your egretTV password without having to login</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>
	

		<form class="form-horizontal" action="password.php" method="post">
		<div class="control-group">
		<label class="control-label" for="inputEmail">Email Address:</label>
		<div class="controls">
		<input type="text" id="inputEmail" placeholder="Email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">Current Password:</label>
		<div class="controls">
		<input type="password" id="inputPassword" placeholder="Password" name="pass">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputnewPassword">New Password:</label>
		<div class="controls">
		<input type="password" id="inputnewPassword" placeholder="NewPassword" name="pass1">
		<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputConPassword">Confirm New Password:</label>
		<div class="controls">
		<input type="password" id="inputConPassword" placeholder="ConPassword" name="pass2">
		</div>
		</div>
		<div class="control-group">
		<div class="controls">
		<label class="checkbox">
			<input type="checkbox"> Remember me
		</label>
		<input type="submit" name="submit" value="Change Password"/>
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

ob_end_flush();

?>
