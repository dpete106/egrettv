<?php # webcam.php
ob_start();
session_start();
include('./header_test.php');

?>

	<div class="jumbotron"><div class="module">

	<h2>Rent the House on the Water</h2>
	
    <div class="row marketing">
        <div class="col-lg-12">
		
		<p>Welcome to the egret.tv webcam streaming live on the Long Island Sound.</p>
		<p>During the long summer season you will see egrets and herons walking about and feeding at this bird habitat in Branford, Connecticut.</p>
		<p>The best times to view them are low-tides in the early mornings and low-tides in the early evenings.</p>
		<div class="video-container">
<iframe type="text/html" frameborder="0" width="480" height="394" src="//video.nest.com/embedded/live/sPIEVp?autoplay=1" allowfullscreen></iframe>
		</div>


		</div>
        <div class="col-lg-12">
		<h2>It's what living on the beach is all about</h2>
		<h3>There's a natural progression from inside the living room, into the 3 season porch, step outside to the patio, over the seawall and down to the rocks and sand, and then back again.</h3>
		<p>Connect to the Sound and your Work.  Academic Year, start August/September. Unique waterfront location on the Long Island Sound with spectacular views of the Thimble Islands. Connect to the environment in this authentic classic cottage with seamless indoor-outdoor living. 10 miles to Yale University. 2 miles to new brewery and train station with Shoreline East service to New Haven. Steps to swim. Short walk to private sandy beach. Quiet safe beach neighborhood.</p>
		<h3>tweet when they eat!</h3>
		<p>
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.egret.tv/hero/webcam.php" data-via="storkman" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
		</div>
	</div>



      <hr>

      <footer>

<?php
include('./footer.php');
?>
      </footer>

    </div> <!-- /module -->
    </div> <!-- /jumbotron -->
    </div> <!-- /container -->

  </body>
</html>

<?php

ob_end_flush();

?>