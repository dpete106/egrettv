<?php # connect.php
ob_start();
session_start();
include('header.php');

?>

    <div class="container">
	<div class="row">
	<div class="span6">
		<h3><a href="mailto:davestorkman@egret.tv?Subject=Storkman%20Connect%20Message" target="_top">
		Send Mail to Storkman</a></h3>
		<p>I run egret.tv, a social media website dedicated to the protection, restoration and preservation of Connecticut’s Long Island Sound ecosystem. egret.tv uses its publishing platform, content distribution, and social networking links in being an integral part of the environmentalist community.</p>
		

		<p><a href="https://twitter.com/storkman" class="twitter-follow-button" data-show-count="false">Follow @storkman</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</p>
		<p><a href="http://www.linkedin.com/in/davepetersen" ><img style="border-width:thin" src="http://www.linkedin.com/img/webpromo/btn_viewmy_160x25.gif" width="160" height="25"  alt="View David Petersen's profile on LinkedIn"/></a>
		</p>
	</div>
	<div class="span6">


<a class="twitter-timeline" href="https://twitter.com/storkman" data-widget-id="330692432947724288">Tweets by @storkman</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </body>
</html>

<?php

ob_end_flush();

?>
