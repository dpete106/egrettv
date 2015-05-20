<?php # logout.php
// This is the logout page for the site.
ob_start();
session_start();
echo session_id();
require_once ('config.inc.php'); 

// If no first_name session variable exists, redirect the user:
// echo $_SESSION['first_name'];
if (!isset($_SESSION['first_name'])) {
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	//header("Location: $url");
	exit('do not access this page directly'); // Quit the script.
	
} else { // Log out the user.
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	ob_end_clean(); // Delete the buffer.
	setcookie (session_name(), '', time()-300); // Destroy the cookie.
	$url = BASE_URL . 'index.php'; // Define the URL.
	header("Location: $url");
}

// Print a customized message:
echo '<h3>You are now logged out of egretTV.</h3>';


ob_end_flush();

?>

