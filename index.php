<?php
include 'db.php';
include 'functions.php';
include 'header.php';

?>
<div class="container-fluid">
    <!-- sidebar -->
    <div class="col-md-3 col-lg-3" id="sidebar">
      <?php include 'sidebar.php'; ?>
    </div>

    <!-- Contenue principale -->
    <div class="col-xs-12 col-sm-12 col-md-9" id="content">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            accueil
            <?php lockButtonHtml("accueil"); ?>
          </div>
        </div>
        <div class="panel-body">
          <?php lockerDivHtml("accueil"); ?>
          <div class="row">
            <!-- <div class="element col-md-4 col-sm-6">
              <div class="">
                <a href="#" class="">
                  <div class="image">
                    <img src="images/tom.jpg" alt="">
                  </div>
                  <p ><h3 class="text-center">Tom And Jerry</h3></p>
                </a>
              </div>
            </div> -->

            <?php DynamicPagePosts('channels'); ?>

          </div>
        </div>
      </div>
    </div>
</div>
<?php
include 'footer.php';
 ?>
