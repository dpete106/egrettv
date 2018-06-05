<?php # donation.php
// This page allows a logged-in user to make a donation to egret.tv.

ob_start(); // output stored in internal buffer
session_start();

include('header_test.php');
require_once ('config.inc.php');
include_once( 'class.php' );

// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['first_name'])) {
	
	//$url = BASE_URL . 'index.php'; // Define the URL.
	//ob_end_clean(); // Delete the buffer.
	
	
	//header("Location: $url");
	//exit(); // Quit the script.
	
}
?>
<main role="main">

    <div style="background-color:rgba(192,192,192,0.1);" class="jumbotron">
        <div class="container">
          <h1 class="jumbotron-heading">Popular egret.tv Videos on <a target="_blank" href="https://www.youtube.com/channel/UC6BqMHGjvexrX0aTu_M4f9A" >YouTube</a></h1>
		  <hr>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
            <a href="/egrettv/hero/donation.php" class="btn btn-primary my-2">Support egret.tv</a>
          </p>
        </div>
      </section>

<?php # please join
if (!isset($_SESSION['first_name'])) {
?>	
      <section style="margin-left: 125px; margin-right: 125px;" class="jumbotron">
        <div class="container">
          <div class="alert alert-danger">Please take a moment and sign in (or create a free member account) in order to view the YouTube egret.tv videos.</div>
        </div>
      </section>
	
<?php # display videos
} else {

?>
    <section style="margin-left: 125px; margin-right: 125px;" class="jumbotron">
	<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="/egrettv/images/greategret_20110610.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Great Egret Catches and Swallows Whole a Very Big Fish</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <!--<button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
						<a target="_blank" href="https://youtu.be/JqiBp0oVE5w" class="btn btn-primary my-2">View</a>
                    </div>
                    <small class="text-muted">700 views</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="/egrettv/images/greategret_20090611.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">These large white herons with yellow bills catch fish walking along the low-tide mudflat.  This one literally has a mouthful struggling to get down the neck a large eel.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
						<a target="_blank" href="https://youtu.be/B1WiR8O33SA" class="btn btn-primary my-2">View</a>
                    </div>
                    <small class="text-muted">3300 views</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="/egrettv/images/greategret_20080605.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">In the space of a minute this Great Egret spears 2 fish with his slender and long dagger-like yellow bill.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
						<a target="_blank" href="https://youtu.be/F1xald0cLgU" class="btn btn-primary my-2">View</a>
                    </div>
                    <small class="text-muted">1300 views</small>
                  </div>
                </div>
              </div>
            </div>

            </div>
        </div>
    </div>
	</section>
<?php
}
?>
</main>

      <footer>
       <?php
		include('footer.php');
		?>
      </footer>
</body>
</html>

<?php

ob_end_flush(); // send output buffer and turn off output buffering

?>
