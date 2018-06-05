<?php # login.php
// This is the login page for the site.
ob_start();
session_start();



include('header_test.php');

?>
<main role="main">

    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
		<h1>Login to egret.tv</h1>
		<hr>

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
			//$localuser = $_SESSION['user_id'];
			//echo "<script type='text/javascript'>";
			//echo "function run(user){
			//if (typeof(Storage) !== 'undefined') {
			//	// Store
			//	alert('hello world');
			//	localStorage.setItem('localuser', user);
			//	// Retrieve
			//	document.getElementById('result').innerHTML = localStorage.getItem('localuser');
			//	} 
			//}";
            //echo "run('$localuser')"; 
			//echo "</script>";
			$url = BASE_URL . 'index.php'; // Define the URL:
			header("Location: $url");
			exit(); // Quit the script.
			//echo '<div class="alert alert-success">You have successfully logged in to egret.tv!</div>';

		} else { // No match was made.
			echo '<div class="alert alert-danger">Either the email address and password entered do not match those on file or you have not yet activated your account.</div>';
			
		}
		
	} else { // If everything wasn't OK.
		echo '<div class="alert alert-danger">Please try again.</div>';
		
	}
} // End of SUBMIT conditional.
?>
	<div class="container">
			<form class="needs-validation" novalidate="" action="../hero/login.php" method="post">
				<div class="row">
					<div class="col-md-6 mb-3">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" id="email" placeholder="" value="" required="">
					<div class="invalid-feedback">
						Valid email is required.
					</div>
					</div>	

					<div class="col-md-6 mb-3">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="pass" id="password" placeholder="" value="" required="">
					<div class="invalid-feedback">
						Valid password is required.
					</div>
					</div>	
				</div>
				<div class="row">
					<button class="btn btn-primary btn-lg btn-block" type="submit">Sign in</button>
					<input  type="hidden" name="submitted" value="TRUE" /> 
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
//echo session_id();
ob_end_flush();

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