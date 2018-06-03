<?php # change_password.php
// This page allows a logged-in user to change their password.

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
		<h1>Change your current password</h1>
		<hr>

<?php # change_password.php
if (isset($_POST['submitted'])) {
					
	// Check for a new password and match against the confirmed password:
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
		if ($_POST['password1'] == $_POST['password2']) {
			
			$p = stripslashes( strip_tags( $_POST['password1'] ) );
		} else {
			echo '<div class="alert alert-warning">Your password did not match the confirmed password!</div>';
			
		}
	} else {
		echo '<div class="alert alert-warning">Please enter a valid password!</div>';
		
	}
	
	if ($p) { // If everything's OK.

		// Make the query.
		
		$usr = new Users; 
		$usr->storeFormValues( $_POST );	
		$usr->user_id = $_SESSION['user_id'];
		
		if ( $usr->userForgot($p) ) { // If it ran OK.
			
			// Send an email, if desired.
			echo '<div class="alert alert-success">Your password has been changed.</div>';
			
		} else { // If it did not run OK.
		
			echo '<div class="alert alert-danger">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</div>'; 
			

		}

	} else { // Failed the validation test.
		echo '<div class="alert alert-danger">Please try again.</div>';		
		
	}
	
} // End of the main Submit conditional.

?>

	<div class="container">
		<form class="needs-validation" novalidate="" action="../hero/change_password.php" method="post">
			<div class="row">
		
				<div class="col-md-6 mb-3">
				<label for="inputnewPassword">New Password</label>
				<input type="password" class="form-control" name="password1" id="inputnewPassword" placeholder="" value="" required="">
				<div class="invalid-feedback">
				Valid password is required.
				</div>
				<p>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>
				</div>	
		
				<div class="col-md-6 mb-3">
				<label for="inputPassword">Confirm New Password</label>
				<input type="password" class="form-control" name="password2" id="inputPassword" placeholder="" value="" required="">
				<div class="invalid-feedback">
				Valid password is required.
				</div>
				</div>	
			</div> <!-- row -->
			<button class="btn btn-primary btn-lg btn-block" type="submit">Change My Password</button>
			<input type="hidden" name="submitted" value="TRUE" />
		</form>
    </div> <!-- /container -->
	
    </div> <!-- /jumbotron -->
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
<script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
</script>