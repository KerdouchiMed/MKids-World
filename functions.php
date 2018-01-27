<?php

//add html code for lock button 
function lockButtonHtml($id)
  {
    ?>
    <button type="button" class="pull-right lock-button" id="lock-<?php echo $id ?>">
      <i class="fa fa-unlock" aria-hidden="true"></i>
    </button>
    <?php
  }

  //
  function lockerDivHtml($id)
  {
    ?>
    <div class="locker-div" id="lock-<?php echo $id ?>">
    </div>
    <?php
  }




function dynamicSidebar($table_title){
  global $bdd;
  $req = "SELECT id, name FROM $table_title ";
  $rep = $bdd->prepare($req);
  $rep->execute();
  echo'
    <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
        '.$table_title;
        lockButtonHtml('sidebar'.$table_title);
        echo '
      </div>
    </div>
    <div class="panel-body">
      <ul class="nav nav-pills nav-stacked">';
      lockerDivHtml('sidebar'.$table_title);
        while($row = $rep->fetch())
        {
          echo '<li class="';
          if(basename($_SERVER['PHP_SELF']) == $table_title.'.php' && $_GET['id'] == $row['id']) echo"active";
          echo'"><a href="'.$table_title.'.php?id='.$row['id'].'">'.$row['name'].'</a></li>';
        }
      echo'</ul>
    </div>
    </div>
  ';
}



function dynamicSidebarWithImage($table_title){
  global $bdd;
  $req = "SELECT * FROM $table_title ";
  $rep = $bdd->prepare($req);
  $rep->execute();
  echo'
    <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
        '.$table_title;
        lockButtonHtml('sidebar'.$table_title);
        echo '
      </div>
    </div>
    <div class="panel-body">
      <div class="nav nav-pills nav-stacked">';
      lockerDivHtml('sidebar'.$table_title);
        while($row = $rep->fetch())
        {
          dynamicThumbnailWithoutTitle($row['name'],$row['image_link'],$table_title.'.php?id='.$row['id']);
        }
      echo'</div>
    </div>
    </div>
  ';
}


function contentRequest($title,$req,$md=3,$sm=6,$xs=6,$withVideosTitle=true)
{
  global $bdd;
  $rep = $bdd->prepare($req);
  $rep->execute();
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
       <div class="panel-title">
        
            <span><?php echo $title; ?></span> 
             <?php lockButtonHtml("suggestion"); ?>
         
       </div>
    </div> 
    <div class="panel-body">
       <?php //lockerDivHtml("suggestion"); ?>
        <div class="row">
            <?php
            while($row = $rep->fetch())
            {
                dynamicThumbnailWithoutTitle($row['name'],$row['image_link'],'videos.php?id='.$row['id'],$md,$sm,$xs);
            }
            ?>
        </div>
    </div>
</div>
<?php
}


function dynamicThumbnailWithoutTitle($title,$image_link,$page_link,$col_md=6,$col_sm=6,$col_xs=6)
{
  echo '
  <div class="thumbnail col-md-'.$col_md.' col-sm-'.$col_sm.' col-xs-'.$col_xs.'">
    <div class="without-title">
      <a href="'.$page_link.'" class="">
        <div class="image">
          <img src="'.$image_link.'" alt="'.$title.'">
        </div>
      </a>
    </div>
  </div>
  ';
}


//formater la form des tables en thumbnail
function dynamicThumbnail($title,$image_link,$page_link,$col_md=3,$col_sm=4,$col_xs=6)
{
  echo '
  <div class="thumbnail col-md-'.$col_md.' col-sm-'.$col_sm.' col-xs-'.$col_xs.'">
    <div class="with-title">
      <a href="'.$page_link.'" class="">
        <div class="image">
          <img src="'.$image_link.'" alt="'.$title.'">
        </div>
        <div class="video_title" ><h5 class="text-center">'.$title.'</h5></div>
      </a>
    </div>
  </div>
  ';
}


// cette fonction insert dynamiquement les colones d'une table
//sous forme d'un thumbnail
function DynamicPagePosts($table_name)
{
  global $bdd;
  $req = "SELECT * FROM $table_name ";
  $rep = $bdd->prepare($req);
  $rep->execute();
  while($row = $rep->fetch())
  {
    dynamicThumbnail($row['name'],$row['image_link'],$table_name.'.php?id='.$row['id'],3,4,6);
  }
}

/*

//formater la form des videos en thumbnail
function dynamicThumbnail($title,$image_link,$page_link)
{
  echo '
  <div class="thumbnail col-md-2 col-sm-4 col-xs-6">
    <div class="video">
      <a href="'.$page_link.'" class="">
        <div class="image">
          <img src="'.$image_link.'" alt="'.$title.'">
        </div>
        <div class="video_title">
          <h5 class="text-center">'.$title.'</h5>
        </div>
      </a>
    </div>
  </div>
  ';
}
*/

//genere une liste des video selon des filtre
function DynamicVideoList($filter,$filter_value)
{
  global $bdd;
  $req = "SELECT id, name, image_link FROM videos WHERE $filter = :filter_value";
  $rep = $bdd->prepare($req);
  $rep->execute(array(":filter_value" => $filter_value));

  while($row = $rep->fetch())
  {
      dynamicThumbnail($row['name'],$row['image_link'],'videos.php?id='.$row['id'],3,4,6);
  }
}

//formater la page video (visualisation du video)
function PresentVideo($video_id)
{
  global $bdd;
  $req = "SELECT name, video_link FROM videos WHERE id = :video_id";
  $rep = $bdd->prepare($req);
  $rep->execute(array(":video_id" => $video_id));
  $row = $rep->fetch();
  if($row['video_link'] != 'NULL')
    echo $row['video_link'];
  //echo '<iframe width=95% class="iframe" src="https://www.youtube.com/embed/BuimtozBAfM?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
}

  ?>