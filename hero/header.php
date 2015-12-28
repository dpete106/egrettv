<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
/***************GET PAGE FROM URL***********************/
$uri_array=explode("/", $_SERVER['REQUEST_URI']);
$page = str_replace(".php", "", end($uri_array));

if ($page == "webcam" ){
    
	echo "<meta charset='utf-8'>
    	<title>live bird cam web | egret.tv</title>
		<link rel='icon' href='favicon.ico' type='image/x-icon'/>    	
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egret.tv'>
	<meta name='description' content='This is a live video cam of egret birds.  On this egret.tv live video cam birds you will see herons and egrets in their natural habitat in the Connecticut Long Island Sound ecosystem.'/> 
	
	<meta name='keywords' content='live video cam birds egret heron'/>";

}else {

    
	echo "<meta charset='utf-8'>
    	<title>egret heron bird | egret.tv</title>
    	<link rel='icon' href='favicon.ico' type='image/x-icon'/> 
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egrettv.org'>
	<meta name='description' content='This is the egret heron bird website.  On this egret.tv live video cam birds you will see herons and egrets in their natural habitat in the Connecticut Long Island Sound ecosystem.'/> 
	
	<meta name='keywords' content='egret heron bird '/>";
}
?>	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico"> -->

	
    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/jumbotron.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<?php include_once("analyticstracking.php") ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="../blog/index.php">Video blog</a>
        </div><!--/.navbar-header -->  

		<div id="navbar" class="navbar-collapse collapse">          
		<ul class="nav navbar-nav">
            	<li class="active"><a class="navbar-brand"  href="../index.php">Home</a></li>
            	<li><a class="navbar-brand"  href="../hero/connect.php">Connect</a></li>
            	<li><a class="navbar-brand"  href="../hero/webcam.php">Webcam</a></li>
        </ul> <!--/navbar-nav --> 
		<ul class="nav navbar-nav">
            	<li class="dropdown">
            
<?php  
			if (isset($_SESSION['user_id'])) {
				$first_name = $_SESSION['first_name'];
				echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>$first_name <span class='caret'></span></a>";
				} else {
				echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Dropdown <span class='caret'></span></a>";
			}
?>
           		<ul class="dropdown-menu" role="menu">
              
<?php  
			if (isset($_SESSION['user_id'])) {
				$first_name = $_SESSION['first_name'];     
				echo "<li><a href='../hero/logout.php'>Logout</a></li>";       
                echo "<li><a href='../hero/change_password.php'>Change Password</a></li>";
                echo "<li><a href='../hero/delete.php'>Delete Account</a></li>";
            } else {
            	echo "<li><a href='../hero/login.php'>Login</a></li>";
            	echo "<li><a href='../hero/register.php'>Create Free Account</a></li>";
            	echo "<li class='divider'></li>";
            	echo "<li class='dropdown-header'>More cool stuff</li>";
            	echo "<li><a href='../hero/forgot_password.php'>No Login Forgot Password</a></li>";
            	echo "<li><a href='../hero/password.php'>No Login Change Password</a></li>";
            }
?>
 
              </ul><!--/dropdown-menu -->
            </li>
            
          </ul> <!--/navbar-nav --> 
                  
     	<!-- <ul class="nav navbar-nav navbar-right"> -->
 <?php  
			if (isset($_SESSION['user_id'])) {
				$first_name = $_SESSION['first_name']; 

?>        
          <form class="navbar-form navbar-right" action="../hero/logout.php" method="post"> 
			
            <button class="btn btn-success" type="submit">Sign Out</button> 
            <input  type="hidden" name="submitted" value="TRUE" /> 
          </form> 
<?php } else { ?>                     
  
          <form class="navbar-form navbar-right" action="../hero/login.php" method="post"> 
			
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="pass">
            </div>

            <button class="btn btn-success" type="submit">Sign in</button> 
            <input  type="hidden" name="submitted" value="TRUE" /> 
          </form>
<?php } ?>   
		    <!--</ul> -->                  
        </div><!--/.navbar-collapse -->
      </div><!--container -->
    </nav>
