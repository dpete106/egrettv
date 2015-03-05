<?php # connect.php
ob_start();
session_start();
include('header.php');

?>
    <div class="container">
    <div class="row">
		<div class="span6">
		<h3>egretTV.org live bird web cam</h3>
		<p>This is the best bird web cam streaming live on planet Earth.  During the long summer season you will see egrets and herons walking about and feeding at this Long Island Sound habitat in Branford, Connecticut.  The best times to view them are low-tides in the early mornings and low-tides in the early evenings.</p>
				<object width="480" height="324"><param name="movie" value="https://www.dropcam.com/e/738a41b1ea8446508cdc9e080302d962?autoplay=false"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="opaque"></param><embed src="https://www.dropcam.com/e/738a41b1ea8446508cdc9e080302d962?autoplay=false" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="324" wmode="opaque"></embed></object>
		</div>
		<div class="span6">
		<h3>tweet when they eat!</h3>
		<p>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.egrettv.org/hero/webcam.php" data-via="storkman" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>		
	</p>
		</div>
	</div>



      <hr>

      <footer>
        <p>&copy; egretTV.org 2015</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../scripts/js/jquery-1.10.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <!-- 
    <script src="../bootstrap/js/bootstrap-transition.js"></script>
    <script src="../bootstrap/js/bootstrap-alert.js"></script>
    <script src="../bootstrap/js/bootstrap-modal.js"></script>
    <script src="../bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../bootstrap/js/bootstrap-tab.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-popover.js"></script>
    <script src="../bootstrap/js/bootstrap-button.js"></script>
    <script src="../bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../bootstrap/js/bootstrap-carousel.js"></script>
    <script src="../bootstrap/js/bootstrap-typeahead.js"></script>
    -->
  </body>
</html>

<?php

ob_end_flush();

?>