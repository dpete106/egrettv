<?php # connect.php
ob_start();
session_start();
include('./header_test.php');
require_once ('config.inc.php'); 
include_once( 'class.php' );

include_once("./analyticstracking.php");
?>

	<div class="jumbotron"><div class="module">
	    <div class="col-lg-12">
		<a href="https://twitter.com/storkman" class="twitter-follow-button" data-show-count="false">Follow @storkman</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>

		<h2>Contact egret.tv</h2>

<?php
if (isset($_POST['submitted'])) { // Handle the form.
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	
	// Assume invalid values:
	$fn = $ln = $ms = $e = FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		
		$fn = stripslashes( strip_tags( $trimmed['first_name'] ) );
	} else {
		echo '<div class="alert alert-warning">Please enter your first name!</div>';
		
	}
	
	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = stripslashes( strip_tags( $trimmed['last_name'] ) );
	} else {
		echo '<div class="alert alert-warning">Please enter your last name!</div>';
		
	}
	// Check for a message:
	if ($trimmed['message']) {
		$ms = stripslashes( strip_tags( $trimmed['message'] ) );
	} else {
		echo '<div class="alert alert-warning">Please enter your message!</div>';
		
	}

	// Check for random number equal to entered number:
	if ($_SESSION['rand_number'] != $trimmed['numbers']) {
		echo '<div class="alert alert-warning">Please enter the 3 displayed numbers!</div>';
		$fn = $ln = $ms = $e = FALSE;
	}

	// Check for an email address:
	if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])) {
		
		$emailcheck = stripslashes( strip_tags( $trimmed['email'] ) );
		if (email_check($emailcheck) ) {
			$e = $emailcheck;
		} else {
			echo '<div class="alert alert-warning">Please enter a valid email address!!</div>';		
		}
	} else {
		echo '<div class="alert alert-warning">Please enter a valid email address!</div>';
	}

	if ($fn && $ln && $ms && $e) { // If everything's OK...
				$ef = $e;
				$et = 'davestorkman@egret.tv';
				
				$headers = "MIME-Version: 1.0" . PHP_EOL .
				"Content-type: text/html; charset=iso-8859-1" . PHP_EOL .
				"Envelope-to: $et" . PHP_EOL .
				"Reply-To: $ef " . PHP_EOL .
				"Return-Path: $ef " . PHP_EOL .
				"From: $ef " . PHP_EOL .
				"Organization: egret.tv" . PHP_EOL .
				"Cc: " . PHP_EOL .
				"Bcc: " . PHP_EOL .
				"X-Mailer: PHP-" . phpversion() . PHP_EOL;				
				$body = $ms;
				mail($et, 'Contact message', $body, $headers);
				echo '<div class="alert alert-success">Thank you for sending a message to the Storkman.</div>';

	} else { // If one of the data tests failed.
		echo '<div class="alert alert-danger">Please re-enter your message and try again.</div>';
		
	}
    $_SESSION['rand_number'] = slotnumber();

}
else {
  $_SESSION['rand_number'] = slotnumber();
}

?>	
    <div class="row marketing">
	
        <div class="col-lg-12">
		<form class="form-signin" action="../hero/connect.php" method="post">
			<div class="form-group">
			<!--<label for="inputFirstName">First Name</label>-->
			<input type="text" class="form-control" id="inputFirstName" placeholder="FirstName" name="first_name" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>">
			</div>
		
			<div class="form-group">
			<!--<label for="inputLastName">Last Name</label>-->
			<input type="text" class="form-control" id="inputLastName" placeholder="LastName" name="last_name" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>">
			</div>
		
			<div class="form-group">
			<label for="inputLastName">Message</label>
			<textarea rows=5 cols=50 class="form-control" id="inputMessage" name="message"><?php if (isset($trimmed['message'])) echo $trimmed['message']; ?></textarea>
			</div>
		
			<div class="form-group">
			<!--<label for="inputEmail">Email Address</label>-->
			<input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>">
			</div>
		
			<div class="form-group">
			<?php echo $_SESSION['rand_number']; ?>
		
			<label for="inputNumbers">Enter these numbers </label>
			<input type="text" class="form-control" id="inputNumbers" placeholder="Numbers" name="numbers">
			<p>To prevent spam please enter the 3 numbers displayed above and to the left.</p>
			</div>
		
			<div class="form-group">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Send Email</button>
			<input type="hidden" name="submitted" value="TRUE" />
			</div>
		</form>
		</div>
		
        <div class="col-lg-12">
		<a class="twitter-timeline" href="https://twitter.com/storkman" data-widget-id="330692432947724288">Tweets by @storkman</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		
		

	</div>
      <hr>


    </div> <!-- /module -->
    </div> <!-- /jumbotron -->
	
	<footer>
       <?php
		include('footer.php');
		?>
    </footer>

    </div> <!-- /container -->

  </body>
</html>

<?php
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
function email_check($email){
	$pattern = "/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD";
	if (preg_match("/[\\000-\\037]/",$email)) { //check for all the non-printable codes in the standard ASCII set
		return false;
	}
	if(!preg_match($pattern, $email)){ // pattern match the email
		return false;
	}
	list($users,$domain) = explode('@',$email); // Validate the domain exists
	if( function_exists('checkdnsrr') ) {
		if( !checkdnsrr($domain,"MX") ) {
			return false;
		}
	} elseif( function_exists("getmxrr") ) {
		if ( !getmxrr($domain, $mxhosts) ) {
			return false;
		}
	}
	return true;
}

ob_end_flush();

?>
