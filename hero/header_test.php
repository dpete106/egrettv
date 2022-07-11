<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
    include_once('analyticstracking.php'); //analyticstracking.php in both directories
/***************GET PAGE FROM URL***********************/
$uri_array=explode("/", $_SERVER['REQUEST_URI']);
$page = str_replace(".php", "", end($uri_array));

if ($page == "webcam" ){
    
	echo "<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
    	<title>webcam long island sound | egret.tv</title>
		<link rel='icon' href='./favicon.ico' type='image/x-icon'/>    	
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egret.tv'>
	<meta name='description' content='This is a streaming webcam of the Long Island Sound north shore.  On this egret.tv webcam you will see herons and egrets in their natural habitat in the Connecticut Long Island Sound ecosystem.'/> 
	
	<meta name='keywords' content='webcam long island sound'/>";

}else {

    
	echo "<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
    	<title>webcam long island sound | egret.tv</title>
    	<link rel='icon' href='./favicon.ico' type='image/x-icon'/> 
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egret.tv'>
	<meta name='description' content='This is a streaming webcam of the Long Island Sound north shore.  On this egret.tv webcam you will see herons and egrets in their natural habitat in the Connecticut Long Island Sound ecosystem.'/> 
	
	<meta name='keywords' content='webcam long island sound'/>";
}
?>	
	
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="http://localhost/egrettv/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
	<!-- <script src="/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>  -->
	
	<link href="http://localhost/egrettv/css/element_style.css" rel="stylesheet">
	<!-- <link href="../css/element_style.css" rel="stylesheet"> -->
    <!-- Bootstrap core CSS -->
    <link href="http://localhost/egrettv/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="../bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this template  -->
	<link href="http://localhost/egrettv/css/style.css" rel="stylesheet">
	<!-- <link href="../css/style.css" rel="stylesheet">  -->


  </head>
<!-- Modal -->
    <div class="modal fade" id="project1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Roger Tory Peterson</h4>
                </div>
                <div class="modal-body">
				content
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
  <body>
	<header>
	
	<!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> took out bg-dark -->
 	<nav  class="navbar navbar-expand-md navbar-dark "> 
     <a class="navbar-brand" href="#"><img src="/egrettv/images/egret_logo_2.png"  class="img-responsive"  style="position: relative;width: 100%;height: auto;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a  style="font-weight: bold;" class="nav-link" href="/egrettv/index.php">Home <span class="sr-only">(current)</span></a></li>
           <li class="nav-item active">
           <a  style="font-weight: bold;" class="nav-link" href="/egrettv/hero/webcam.php">Sound Cam</a></li>
            <li class="nav-item active">
           <a  style="font-weight: bold;" class="nav-link" href="/egrettv/hero/video.php">Videos</a></li>
          <li class="nav-item active">
            <a  style="font-weight: bold;" class="nav-link" href="/egrettv/hero/connect.php">Contact</a></li>
         <!-- <li class="nav-item active">
            <a  style="font-weight: bold;" class="nav-link" href="/hero/donation.php">Donate</a></li> -->
		  
          <li class="nav-item active dropdown">
		  
            <!--<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>-->
<?php  
			if (isset($_SESSION['user_id'])) {
				$first_name = $_SESSION['first_name'];
				echo '<a  class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'. $first_name . '</a>';
				} else {
				echo '<a  class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MyAccount</a>';
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
	</header>
