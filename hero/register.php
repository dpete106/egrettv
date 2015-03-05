<?php # register.php
// This is the registration page for the site.

ob_start();
session_start();
include('header.html');
require_once ('config.inc.php'); 

function slotnumber()
{
  srand(time());
    for ($i=0; $i < 3; $i++)
    {
      $random = (rand()%9);
      $slot[] = $random;
    }
$number = $slot[0] . $slot[1] . $slot[2];
// echo $number;
return $number;
}

if (isset($_POST['submitted'])) { // Handle the form.

	// require_once (MYSQL);
require_once ('../mysqli_connect.php'); 
	
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	
	// Assume invalid values:
	$fn = $ln = $rn = $e = $p = FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysql_real_escape_string ($trimmed['first_name']);
	} else {
		echo '<div class="alert alert-warning">Please enter your first name!</div>';
		// echo '<p class="error">Please enter your first name!</p>';
	}
	
	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysql_real_escape_string ($trimmed['last_name']);
	} else {
		echo '<div class="alert alert-warning">Please enter your last name!</div>';
		// echo '<p class="error">Please enter your last name!</p>';
	}

	// Check for random number equal to entered number:
	if ($_SESSION['rand_number'] != $trimmed['numbers']) {
		echo '<div class="alert alert-warning">Please enter the 3 displayed numbers!</div>';
		// echo '<p class="error">Please enter the 3 displayed numbers!</p>';
	}

	// Check for an email address:
	if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])) {
		$e = mysql_real_escape_string ($trimmed['email']);
	} else {
		echo '<div class="alert alert-warning">Please enter a valid email address!</div>';
		// echo '<p class="error">Please enter a valid email address!</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysql_real_escape_string ($trimmed['password1']);
		} else {
			echo '<div class="alert alert-warning">Your password did not match the confirmed password!</div>';
			// echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<div class="alert alert-warning">Please enter a valid password!</div>';
		// echo '<p class="error">Please enter a valid password!</p>';
	}
	
	if ($fn && $ln && $e && $p) { // If everything's OK...

		// Make sure the email address is available:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
		
		if (mysql_num_rows($r) == 0) { // Available.
		
			// Create the activation code:
			$a = md5(uniqid(rand(), true));
		
			// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW() )";
			$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));

			if (mysql_affected_rows($dbc) == 1) { // If it ran OK.
			
				// Send the email:
				$body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'hero/activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'From: david_petersen@egrettv.org', $body);
				
				// Finish the page:
				echo '<p>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</p>';
				//include ('includes/footer.html'); // Include the HTML footer.
				//exit(); // Stop the page.
				
			} else { // If it did not run OK.
				echo '<div class="alert alert-danger">You could not be registered due to a system error. We apologize for any inconvenience.</div>';
				//echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
			
		} else { // The email address is not available.
			echo '<div class="alert alert-warning">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</div>';
			//echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}
		
	} else { // If one of the data tests failed.
		echo '<div class="alert alert-danger">Please re-enter your passwords and try again.</div>';
		// echo '<p class="error">Please re-enter your passwords and try again.</p>';
	}
        $_SESSION['rand_number'] = slotnumber();
	mysql_close($dbc);

} // End of the main Submit conditional.
else {

  $_SESSION['rand_number'] = slotnumber();
  }

?>
<div class="container">

    <div class="row">
		<div class="span12">
		<h2>Join the egretTV Community</h2>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		</div>
	</div>

	<form class="form-horizontal" action="register.php" method="post">
		<div class="control-group">
		<label class="control-label" for="inputFirstName">First Name:</label>
		<div class="controls">
		<input type="text" id="inputFirstName" placeholder="FirstName" name="first_name" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputLastName">Last Name:</label>
		<div class="controls">
		<input type="text" id="inputLastName" placeholder="LastName" name="last_name" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputEmail">Email Address:</label>
		<div class="controls">
		<input type="text" id="inputEmail" placeholder="Email" name="email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
		<input type="password" id="inputPassword" placeholder="Password" name="password1">
		<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputConPassword">Confirm Password:</label>
		<div class="controls">
		<input type="password" id="inputConPassword" placeholder="ConPassword" name="password2">
		</div>
		</div>
		<?php echo $_SESSION['rand_number']; ?>
		<div class="control-group">
		<label class="control-label" for="inputNumbers">: Enter these numbers </label>
		<div class="controls">
		<input type="text" id="inputNumbers" placeholder="Numbers" name="numbers">
		<p>To prevent spam please enter the 3 numbers displayed to the left.</p>
		</div>
		</div>
		<div class="control-group">
		<div class="controls">
		<label class="checkbox">
			<input type="checkbox"> Remember me
		</label>
		<input type="submit" name="submit" value="Join egretTV"/>
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