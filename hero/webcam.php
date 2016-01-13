<?php # webcam.php
ob_start();
session_start();
include('header.php');

?>
	<div class="container">
	<h2>egret.tv live bird web cam</h2>
	</div>
	
    <div class="container">
    <div class="row">
		<div class="col-md-6">
		<h3>egret.tv live bird web cam</h3>
		<p>Welcome to the egret.tv webcam streaming live on the Long Island Sound.</p>
		<p>During the long summer season you will see egrets and herons walking about and feeding at this bird habitat in Branford, Connecticut.</p>
		<p>The best times to view them are low-tides in the early mornings and low-tides in the early evenings.</p>
 <iframe type="text/html" frameborder="0" width="480" height="394" src="//video.nest.com/embedded/live/sPIEVp?autoplay=1"></iframe>
				<!-- <object width="480" height="324"><param name="movie" value="https://www.dropcam.com/e/738a41b1ea8446508cdc9e080302d962?autoplay=false"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="opaque"></param><embed src="https://www.dropcam.com/e/738a41b1ea8446508cdc9e080302d962?autoplay=false" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="324" wmode="opaque"></embed></object> -->



		</div>
		<div class="col-md-6">
		<h3>tweet when they eat!</h3>
		<p>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.egret.tv/hero/webcam.php" data-via="storkman" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>		
	</p>
	<div>
	<form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_JRGK5txjD4IIgyJU5ztDwSz1"
    data-amount="2000"
    data-name="egret.TV"
    data-description="2 widgets ($20.00)"
    data-image="/images/egret_logo.png"
    data-locale="auto">
  </script>
</form>
	</div>
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

ob_end_flush();

?>
