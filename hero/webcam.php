<?php # webcam.php
ob_start();
session_start();
include('./header_test.php');

?>
<main role="main">

    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
	
		<h1>Long Island Sound Webcam</h1>
		<hr>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
		
			<h5>Welcome to the egret.tv webcam streaming live on the Long Island Sound.</h5>
			<p>During the long summer season you will see egrets and herons walking about and feeding at this bird habitat in Branford, Connecticut.</p>
			<p>The best times to view them are at low-tides in the early mornings and early evenings.</p>
			<div class="video-container"> 
	<iframe type="text/html" frameborder="0" width="480" height="394" src="//video.nest.com/embedded/live/UcHq3XIUr2?autoplay=1" allowfullscreen></iframe>			</div> 
			</div>
			
			<div class="col-lg-12"> 
			<p>Birds are sensitive indicators of the environment, a sort of "ecological litmus paper". The observations of bird populations over time leads to environmental awareness and a signal of possible change - Roger Tory Peterson. </p>
			<!-- <h4>There's a natural progression from inside the living room, into the 3 season porch, step outside to the patio, over the seawall and down to the rocks and sand, and then back again.</h4> -->
			<h5>tweet when they eat!</h5>
			<p>
			<a href="https://twitter.com/intent/tweet?screen_name=storkman&ref_src=twsrc%5Etfw" class="twitter-mention-button" data-show-count="false">Tweet to @storkman</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		
		</div> <!-- /row -->
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