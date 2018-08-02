<?php
ob_start();
session_start();
if (isset($_SESSION['user_id'])) {
	//echo $_SESSION['user_id'];
}
include('./hero/header_test.php');

?>


    <!-- Main jumbotron for a primary marketing message or call to action -->
<main role="main">
    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
		<div class="container">
			<h1>egret.tv | Help protect the Long Island Sound</h1>
			<hr class="border-row-heavy">
			<div class="row">
				<div class="col-lg-12">
		
				<div align="center" class="embed-responsive embed-responsive-16by9">
				<video autoplay loop class="embed-responsive-item" controls>
				<source src="/egrettv/images/giphy.mp4" type="video/mp4" >
				</video>
				</div>
				</div>
			</div>      
        
			<p class="lead"><em>If we don't get to know them, we're going to lose them.</em></p>
			<p>
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			Read More
				</button>
			</p>
			
			<div class="collapse" id="collapseExample">
			<div class="card card-body">
             <p>Birds are sensitive indicators of the environment, a sort of "ecological litmus paper".  The observations of bird populations over time leads to environmental awareness and a signal of possible change - Roger Tory Peterson. </p>
			</div>
			</div>
		</div> <!-- /container -->

      <!-- Example row of columns -->
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
				<h4>Mission</h4>
				<p>egret.tv is a non-profit organization.<br>
				The vision of egret.tv is a sustainable healthy Long Island Sound coexisting with a vibrant economy benefiting all people living in the region.<br>
				The mission of egret.tv is to the protect and preserve the Long Island Sound ecosystem.
				<!-- egret.tv is a tax exempt organization under Section 501(c)3 of the Internal Revenue Code (pending status). -->
				</p>
				</p>
				<img src="/egrettv/images/ltern.gif"  class="img-fluid"  >
				</div>
				
				<div class="col-lg-6">
				<h4>Advocacy</h4>
				<p>
				The work of egret.tv supports clean air, water and habitat of the Long Island Sound, slowing climate change, and over-development protection.<br>
				Its goal is promote safe citizen behaviors which lead to the sustainability of the Long Island Sound ecosystem.<br>
				egret.tv participates in the real-world and digital community of environmentalist and environmental organizations in order to help raise awareness of the issues that are detrimental to the health of the Long Island Sound.<br>
				egret.tv supports laws and the political process which protect our natural resources.</p>
				<img src="/egrettv/images/gegret.gif"  class="img-fluid"  >
				</div>
			</div>
		
			<div class="row">
				<div class="col-lg-6">
				<h4>Action</h4>
				<p>
				The output of egret.tv is used to educate and empower citizens to develop environmentally responsible behaviors.
				<ul class="list-group">
				<li class="list-group-item">egret.tv hosts a live streaming webcam of the Long Island Sound.</li>
				<li class="list-group-item">egret.tv produces videos of shoreline birds cohabitataing in the Long Island Sound ecosystem.</li>
				<li class="list-group-item">In social media egret.tv uses its publishing platform, content distribution, and social networking links as an integral part of the environmentalist digital community.</li>
				<li class="list-group-item">The goal of egret.tv is to become an IRS 501(3)c non-profit organization.</li>
				</ul></p>
				<img src="/egrettv/images/snegret.gif"  class="img-fluid"  >
				</div>
				<div class="col-lg-6">
				</div>
			</div>
		
		</div> <!-- /container -->

	</div> <!-- /jumbotron -->

</main>
      <footer>
        <?php
include('./hero/footer.php');
?>
      </footer>



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
