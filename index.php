<?php
ob_start();
session_start();
if (isset($_SESSION['user_id'])) {
	echo $_SESSION['user_id'];
}
include('./hero/header_test.php');

?>


    <!-- Main jumbotron for a primary marketing message or call to action -->

    <div class="jumbotron"><div class="module">
	    <div class="col-lg-12">
		<a href="https://twitter.com/storkman" class="twitter-follow-button" data-show-count="false">Follow @storkman</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div><br>
      <img src="/egrettv/images/egret_logo.png"  class="img-responsive"  style="position: relative;width: 100%;height: auto;">
      
        
        <p class="lead"><em>If we don't get to know them, we're gonna lose them</em></p>
		<p class="lead"><em>Support egret.tv - Rent the House</em></p>
        <p><a class="btn btn-primary btn-lg" href="/egrettv/hero/webcam.php" role="button">Learn more &raquo;</a></p>
        

    </div> <!-- /module -->

	</div> <!-- /jumbotron -->
      <!-- Example row of columns -->
      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Mission</h4>
          <p>Birds are sensitive indicators of the environment, a sort of "ecological litmus paper".  The observations of bird populations over time leads to environmental awareness and a signal of possible change. egret.tv is a social media website dedicated to the protection, restoration and preservation of Connecticut's Long Island Sound ecosystem.  Its goal is to be a site for environmental activists advocating public policy and individual behavior sustaining the Long Island Sound ecosystem.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          <img src="/egrettv/images/ltern.gif"  class="img-responsive"  >
        </div>
        <div class="col-lg-6">
          <h4>Advocacy</h4>
          <p>egret.tv participates in the community of environmentalist and environmental organizations in order to help raise awareness of the issues that are detrimental to the health of the Long Island Sound.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          <img src="/egrettv/images/gegret.gif"  class="img-responsive"  >
       </div>
        <div class="col-lg-6">
          <h4>Action</h4>
          <p>In social media egret.tv uses its publishing platform, content distribution, and social networking links as an integral part of the environmentalist community.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          
          <img src="/egrettv/images/snegret.gif"  class="img-responsive"  >
        </div>
      </div>

      <hr>

      <footer>
        <?php
include('./hero/footer.php');
?>
      </footer>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>-->
    
  </body>
</html>
<?php

if (isset($_SESSION['user_id'])) {

	$first_name = $_SESSION['first_name'];
	
} else {

	session_destroy();
}

ob_end_flush();

?>
