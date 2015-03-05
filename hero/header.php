<!DOCTYPE html>
<html lang="en">
  <head>
    
<?php
/***************GET PAGE FROM URL***********************/
$uri_array=explode("/", $_SERVER['REQUEST_URI']);
$page = str_replace(".php", "", end($uri_array));

if ($page == "webcam" ){
    
	echo "<meta charset='utf-8'>
    	<title>live bird cam web | egretTV</title>
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egrettv.org'>
	<meta name='description' content='This is the best bird cam streaming live on the web.  On this egrettv.org live bird cam you will see herons and egrets in their natural habitat in the Connecticut Long Island Sound ecosystem.'/> 
	
	<meta name='keywords' content='live bird cam web egrettv egret heron'/>";

}else {

    
	echo "<meta charset='utf-8'>
    	<title>bird egret heron connecticut | egretTV</title>
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<meta name='author' content='egrettv.org'>
	<meta name='description' content='egretTV is about viewing live web cam streamming and recorded videos of egret and heron birds in their natural habitat of Connecticut\'s Long Island Sound ecosystem. egretTV.org is dedicated to protection of the environment.'/> 
	
	<meta name='keywords' content='bird egret heron cam web environment connecticut long island sound'/>";
}
?>	
<meta name="google-site-verification" content="qA-eDfaTxaHnmbIwu9ChKYC_toGWOLyKj1Syv_c-GEI" />
    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20010340-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-48659104-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="../blog/">Video Blog</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="../hero/webcam.php">Live Webcam</a></li>
              <li><a href="../hero/connect.php">Connect</a></li>
              <li><a href="../hero/map.php">Map</a></li>
              <li><a href="../hero/demo.php">Demo</a></li>
              <li class="active"><a href="../index.php">Home</a></li>
              
<?php 
// Display links based upon the login status:
if (isset($_SESSION['user_id'])) {
	$first_name = $_SESSION['first_name'];
		
        echo	"<li class='dropdown'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>$first_name <b class='caret'></b></a>
                <ul class='dropdown-menu'>
					<li><a href='../hero/change_password.php'>Change Password</a></li>
                  <li><a href='../hero/logout.php'>Logout</a></li>
                  <li><a href='#'>Something</a></li>
                  <li class='divider'></li>
                  <li class='nav-header'>Nav header</li>
                  <li><a href='#'>Separated link</a></li>
                  <li><a href='#'>One more separated link</a></li>
                </ul>
              </li>";
				  
} else {
        echo	"<li class='dropdown'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Login <b class='caret'></b></a>
                <ul class='dropdown-menu'>
					<li><a href='../hero/login.php'>Login</a></li>
                  <li><a href='../hero/forgot_password.php'>Forgot Password</a></li>
                  <li><a href='../hero/register.php'>Register an Account</a></li>
                  <li class='divider'></li>
                  <li class='nav-header'>Nav header</li>
                  <li><a href='../hero/password.php'>Change Password - No Login</a></li>
                  <li><a href='#'>One more separated link</a></li>
                </ul>
              </li>";
}
?>				  
			  
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>