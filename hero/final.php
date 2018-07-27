<?php
$id = $_GET['id'];
session_id($id);
session_start();
// Require the configuration before any PHP code:
ob_start(); // output stored in internal buffer
include('header_test.php');
require_once ('config.inc.php');

// The session ID is the user's cart ID:
$uid = session_id();

// Check that this is valid:
if (!isset($_SESSION['customer_id'])) { // Redirect the user.
	$location = BASE_URL . 'hero/' . 'donation.php';
	header("Location: $location");
	exit();
} elseif (!isset($_SESSION['response_code']) || ($_SESSION['response_code'] != 1)) {
	//$location = '/' . BASE_URL . 'billing.php';
	$location = BASE_URL . 'hero/' . 'donation.php';
	header("Location: $location");
	exit();
}
// Clear out the shopping cart:

//$q = 'DELETE FROM carts WHERE user_session_id="'. $uid .'"';
//$r = mysqli_query($dbc, $q);
			
// For debugging purposes:
//if (!$r) echo mysqli_error($dbc);

// Send the email:
//include('./email_receipt.php');
?>
<main role="main">

    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
	
		<h1>Your Contribution Order is Complete</h1>
		<hr>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<p>Thank you for your generous contribution to egret.tv.  Your order number is (#<?php echo $_SESSION['order_id']; ?>). Please use this order number in any correspondence with us.</p>
			<p>A charge of $<?php echo number_format($_SESSION['order_total']/100, 2); ?> will appear on your credit card. </p>
			<p>An email confirmation has been sent to your email address.</p>
			<p><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?></p>
			<p><?php echo $_SESSION['address']; ?></p>
			<p><?php echo $_SESSION['city'] . ', ' . $_SESSION['state'] . ' ' . $_SESSION['zip']; ?></p>
			<p><?php echo $_SESSION['email']; ?></p>
			</div>
		
		</div> <!-- /row -->
    </div> <!-- /container -->
	</div> <!-- /jumbotron -->
</main> 
      <footer>

<?php
include('./footer.php');
?>
      </footer>


  </body>
</html>

<?php
// Clear the session:
$_SESSION = array(); // Destroy the variables.
session_destroy(); // Destroy the session itself.
ob_end_flush();
?>