<?php # webcam.php
ob_start();
session_start();
include('header.php');

?>
	<div class="container">
	<h2>Rent the House on the Water</h2>
	</div>
	
    <div class="container">
    <div class="row">
		<div class="col-md-6">
		
		<p>Welcome to the egret.tv webcam streaming live on the Long Island Sound.</p>
		<p>During the long summer season you will see egrets and herons walking about and feeding at this bird habitat in Branford, Connecticut.</p>
		<p>The best times to view them are low-tides in the early mornings and low-tides in the early evenings.</p>
<iframe type="text/html" frameborder="0" width="480" height="394" src="//video.nest.com/embedded/live/sPIEVp?autoplay=1" allowfullscreen></iframe>



		</div>
		<div class="col-md-6">
<h2>It's what living on the beach is all about</h2>
<h3>There's a natural progression from inside the living room, into the 3 season porch, step outside to the patio, over the seawall and down to the rocks and sand, and then back again.</h3>
<p>Connect to the Sound and your Work.  Academic Year, start August/September. Unique waterfront location on the Long Island Sound with spectacular views of the Thimble Islands. Connect to the environment in this authentic classic cottage with seamless indoor-outdoor living. 10 miles to Yale University. 2 miles to new brewery and train station with Shoreline East service to New Haven. Steps to swim. Short walk to private sandy beach. Quiet safe beach neighborhood.</p>
		<h3>tweet when they eat!</h3>
		<p>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.egret.tv/hero/webcam.php" data-via="storkman" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
<!--
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>		
	</p>
	<div>
	<form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_JRGK5txjD4IIgyJU5ztDwSz1"
    data-amount="2000"
    data-name="egret.TV"
    data-zip-code="true"
    data-description="2 widgets ($20.00)"
    data-image="/images/egret_logo.png"
    data-locale="auto">
  </script>
-->
</form>
	</div>
		</div>
	</div>



      <hr>

      <footer>

<?php
include('footer.php');
?>
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