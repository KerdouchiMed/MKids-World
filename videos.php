<?php
include 'db.php';
include 'functions.php';
include 'header.php';

$parent_page="videos";
$content = "";
$channel_id;
if(isset($_GET['id']))
{
  $req="SELECT name, channel_id FROM videos WHERE id = :id";
  $rep=$bdd->prepare($req);
  $rep->execute(array(":id"=>$_GET['id']));
  $row = $rep->fetch();
  $content = $row['name'];
  $channel_id = $row['channel_id'];

}
?>
<div class="container-fluid">
    <!-- sidebar -->
    <div class="col-md-3 col-lg-3" id="sidebar">
      <?php include 'sidebar.php'; ?>
    </div>

    <!-- Contenue principale -->
    <div class="col-xs-12 col-sm-12 col-md-6" id="content">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
           <div class="btn-group btn-group-justified">
            <button type="button" class="pull-left hidden-sm hidden-xs" id="max-width-button">
               <i class="fa fa-window-maximize" aria-hidden="true"></i>
            </button>
            <?php if($content =="") echo substr($parent_page,0,40); 
                    else echo substr($content,0,40); ?>
            <?php lockButtonHtml($parent_page); ?>
           </div>
          </div>
        </div>
        <div class="panel-body">

          <div class="locker-video"></div>
          <!-- Locker -->
          <?php lockerDivHtml($parent_page); ?>
          <div class="row">
            <?php
            if(isset($_GET['id']))
            {
                echo '<iframe id="iframe" allowFullScreen width=100% src="';
                echo PresentVideo($_GET['id']);
                echo '?&autoplay=1&controls=1&showinfo=0&rel=0" frameborder="0" >
                      </iframe>';             
            }
            else
              DynamicVideoList("1","1"); //pour afficher tous les videos
             ?>
          </div>
        </div>
      </div>
      <div>
          <?php
          if(isset($_GET['id']) && $channel_id != "")
          {
            
            contentRequest("play list",'SELECT * FROM videos WHERE channel_id = '.$channel_id.' ORDER BY name LIMIT 12',2,3,6,false); 
          }
          ?>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 " id="suggestion">
        <?php 
        if(isset($_GET['id']) && $channel_id !="")
        {
            contentRequest("suggestion",'SELECT * FROM videos WHERE channel_id <> '.$channel_id.' ORDER BY name LIMIT 12',6,3,6,false);   
        }
        ?>
    </div>
</div>
<?php
include 'footer.php';
?>