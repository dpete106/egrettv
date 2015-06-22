<?php
ob_start();

session_start();

include('hero/header.php');

?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
      <h3><img src="../images/egret_logo.png" class="img-rounded">
      
        </h3>
        <div style="float:right;font-size:24px;"><em>If we don't get to know them, we're gonna lose them</em></div>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
        
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Mission</h2>
          <p>Birds are sensitive indicators of the environment, a sort of "ecological litmus paper".  The observations of bird populations over time leads to environmental awareness and a signal of possible change. egret.tv is a social media website dedicated to the protection, restoration and preservation of Connecticut's Long Island Sound ecosystem.  Its goal is to be a site for environmental activists advocating public policy and individual behavior sustaining the Long Island Sound ecosystem.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          <img src="../images/ltern.gif" class="img-rounded">
        </div>
        <div class="col-md-4">
          <h2>Advocacy</h2>
          <p>egret.tv participates in the community of environmentalist and environmental organizations in order to help raise awareness of the issues that are detrimental to the health of the Long Island Sound.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          <img src="../images/gegret.gif" class="img-rounded">
       </div>
        <div class="col-md-4">
          <h2>Action</h2>
          <p>In social media egret.tv uses its publishing platform, content distribution, and social networking links as an integral part of the environmentalist community.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          
          <img src="../images/snegret.gif" class="img-rounded">
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; egret.tv 2015</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    
  </body>
</html>
<?php
// Display links based upon the login status:
if (isset($_SESSION['user_id'])) {

	$first_name = $_SESSION['first_name'];
	//echo "logged in: " . $first_name;
	
} else {
	session_destroy();
}
//echo session_id();
ob_end_flush();

?>
