<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
    include_once('./analyticstracking.php'); //analyticstracking.php in both directories
/***************GET PAGE FROM URL***********************/
$uri_array=explode("/", $_SERVER['REQUEST_URI']);
$page = str_replace(".php", "", end($uri_array));

if ($page == "webcam" ){
    
	echo "<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
    	<title>live bird cam web | egret.tv</title>
		<link rel='icon' href='./favicon.ico' type='image/x-icon'/>    	
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egret.tv'>
	<meta name='description' content='This is a live video cam of egret birds.  On this egret.tv live video cam birds you will see herons and egrets in their natural habitat in the Connecticut Long Island Sound ecosystem.'/> 
	
	<meta name='keywords' content='live video cam birds egret heron'/>";

}else {

    
	echo "<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
    	<title>egret heron bird | egret.tv</title>
    	<link rel='icon' href='./favicon.ico' type='image/x-icon'/> 
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egrettv.org'>
	<meta name='description' content='This is the egret heron bird website.  On this egret.tv live video cam birds you will see herons and egrets in their natural habitat in the Connecticut Long Island Sound ecosystem.'/> 
	
	<meta name='keywords' content='egret heron bird '/>";
}
?>	
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico"> -->

	
    <!-- <title>Jumbotron Template for Bootstrap</title> -->
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="http://localhost/egrettv/bootstrap-4-dist/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="http://localhost/egrettv/bootstrap-4-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://localhost/egrettv/css/narrow-jumbotron.css" rel="stylesheet">
    <link href="http://localhost/egrettv/css/style.css" rel="stylesheet">


  </head>

  <body>
	<div class="container">

	<!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> -->
 	<nav class="navbar navbar-expand-md navbar-dark bg-dark"> 
     <a class="navbar-brand" href="#">egret.tv</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="http://localhost/egrettv/index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/egrettv/hero/connect.php">Contact</a></li>
            <a class="nav-link" href="/egrettv/hero/webcam.php">Long Island Sound Cam</a></li>
         </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
		  
          <li class="nav-item dropdown">
		  
            <!--<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>-->
<?php  
			if (isset($_SESSION['user_id'])) {
				$first_name = $_SESSION['first_name'];
				echo '<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'. $first_name . '</a>';
				} else {
				echo '<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MyAccount</a>';
			}
?>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
			
<?php  
			if (isset($_SESSION['user_id'])) {
?>
              <a class="dropdown-item" href='/egrettv/hero/logout.php'>Logout</a>
              <a class="dropdown-item" href='/egrettv/hero/change_password.php'>Change Password</a>
              <a class="dropdown-item" href='/egrettv/hero/delete.php'>Delete Account</a>
<?php  
			} else {
?>
			  
              <a class="dropdown-item" href='/egrettv/hero/login.php'>Login</a>
              <a class="dropdown-item" href='/egrettv/hero/register.php'>Create Free Account</a>
              <a class="dropdown-item" href='/egrettv/hero/forgot_password.php'>No Login Forgot Password</a>
              <a class="dropdown-item" href='/egrettv/hero/password.php'>No Login Change Password</a>
<?php  
			} 
?>
			  
           </div>
		   
          </li>
		  
        </ul>
      </div>
    </nav>