<?php
include 'db.php';
include 'functions.php';
include 'header.php';

$parent_page="categories";
$content = "";

if(isset($_GET['id']))
{
  $req="SELECT name FROM categories WHERE id= :id";
  $rep=$bdd->prepare($req);
  $rep->execute(array(":id"=>$_GET['id']));
  $row = $rep->fetch();
  $categories = $row['name'];
}
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
            <?php if($content =="") echo $parent_page; else echo $content; ?>
            <?php lockButtonHtml($parent_page); ?>
          </div>
        </div>
        <div class="panel-body">
          <?php lockerDivHtml($parent_page); ?>
          <div class="row">
            <?php
            if(isset($_GET['id']))
              DynamicVideoList("categorie_id",$_GET['id']);
            else
              DynamicPagePosts($parent_page);
             ?>
          </div>
        </div>
      </div>
    </div>
</div>
<?php
include 'footer.php';
 ?>
