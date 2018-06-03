<?php # webcam.php
ob_start();
session_start();
include('./header_test.php');

?>
<main role="main">

    <div style="margin-left: 125px; margin-right: 125px;" class="jumbotron">
	
		<h1>Long Island Sound Webcam</h1>
		<hr>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
		
			<p>Welcome to the egret.tv webcam streaming live on the Long Island Sound.</p>
			<p>During the long summer season you will see egrets and herons walking about and feeding at this bird habitat in Branford, Connecticut.</p>
			<p>The best times to view them are low-tides in the early mornings and low-tides in the early evenings.</p>
			<div class="video-container">
			<iframe type="text/html" frameborder="0" width="480" height="394" src="//video.nest.com/embedded/live/sPIEVp?autoplay=1" allowfullscreen></iframe>
			</div>


			</div>
		
			<div class="col-lg-12">
			<h3>It's what living on the beach is all about</h3>
			<h4>There's a natural progression from inside the living room, into the 3 season porch, step outside to the patio, over the seawall and down to the rocks and sand, and then back again.</h4>
			<h5>tweet when they eat!</h5>
			<p>
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.egret.tv/hero/webcam.php" data-via="storkman" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
			</p>
			</div>
		
		</div>
		
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

ob_end_flush();

?>