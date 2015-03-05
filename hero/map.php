<?php # map.php

ob_start();
session_start();
include('header.html');

?>

    <div class="container">

        <div style="width:731px;height:451px;overflow:auto;"><!--$begin html$--><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAGEGq1LMDNkwsvGQVOpdyBRQFW7m8ueuy-NKtNGhUzI6RaOJdCxTo7i7FWpSmyfP1183lGelBCQPMLw"
      type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(41.26513, -72.781162), 14);
map.setMapType(G_HYBRID_MAP);
map.addControl(new GSmallMapControl());
map.addControl(new GMapTypeControl());
var marker = new GMarker(new GLatLng(41.26513, -72.781162));
map.addOverlay(marker);
var html="<img src='http://www.egrettv.org/images/greategret_042609_0001.jpg'" + "width='120' height='40'/> <br/>" +
         "egretTV ecosystem<br/>" +
         "Thimble Islands - pan lower right";
marker.openInfoWindowHtml(html);
      }
    }
    //]]>
    </script>
  </head>
  <body onload="load()" onunload="GUnload()">
    <div id="map" style="width: 700px; height: 400px"></div>
  </body>
</html><!--$end html$--></div>
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
