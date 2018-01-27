<?php 
include 'db.php';
$nameInvalidErr="<p><strong>Invalid Name</strong>, please enter a valide name</p>";
$linkInvalidErr="<p><strong>Invalid Link</strong>, please enter a valide link</p>";
$videoExist="<p><strong>This video is already exist</strong>, please enter a new video</p>";
$sqlErrors = "<p><strong>SQL ERRORS</strong>, please contact Admin</p>";


$errorDetected=0;
$errors="";
$video_id="";
$video_name="";
$image_link="";
$video_link="";
$channel_id="";
$language_id="";
$categorie_id="";
/*var_dump($_POST);*/

if(!isset($_POST['video_name']))
{
    $errors .= $nameInvalidErr;
    $errorDetected=1;
}
else
{
    $video_name = filter_var($_POST['video_name'],FILTER_SANITIZE_STRING);
}


if(!isset($_POST['video_link']))
{
    $errors .= $linkInvalidErr;
    $errorDetected=1;
}
else
{
    $video_link = filter_var($_POST['video_name'],FILTER_SANITIZE_STRING);
    $link_Array=explode ('watch?v=',$_POST['video_link']);

    if(sizeof($link_Array)==2)
    {
        $video_id = $link_Array[1];
        $image_link = "https://img.youtube.com/vi/$video_id/mqdefault.jpg";
        $video_link = "https://www.youtube.com/embed/$video_id";
        
    }
        
    else
    {
        $errorDetected=1;
        $errors .= $linkInvalidErr;
    }
}

$rep = $bdd->prepare('SELECT id FROM channels WHERE name = :video_channel ');
if(!$rep->execute(array(":video_channel" => $_POST['video_channel'])))
{
  print_r($bdd->errorInfo());
  $errors.=$sqlErrors;
  $errorDetected=1;  
} 
while( $row = $rep->fetch())
      $channel_id = $row['id'];


$rep = $bdd->prepare('SELECT id FROM languages WHERE name = :video_language ');
if(!$rep->execute(array(":video_language" => $_POST['video_language'])))
{
    $errorDetected=1;
    $errors.=$sqlErrors;
    print_r($bdd->errorInfo());
}
while( $row = $rep->fetch())
      $language_id = $row['id'];


$rep = $bdd->prepare('SELECT id FROM categories WHERE name = :video_categorie');
if(!$rep->execute(array(":video_categorie" => $_POST['video_categorie'])))
{    
    $errorDetected=1;
    $errors.=$sqlErrors;
    print_r($bdd->errorInfo());
}
while( $row = $rep->fetch())
      $categorie_id = $row['id'];


if($categorie_id == "" || $language_id == "" || $channel_id == "")
{
    $errorDetected=1;
    $errors .= $sqlErrors;
}
else
{
    $rep = $bdd->prepare(  'SELECT id 
                        FROM videos 
                        WHERE image_link = :image_link AND video_link = :video_link'
                    );
    $rep->execute(array(":video_link" => $video_link,":image_link" => $image_link));
    if($row = $rep->fetch())
    {
        $errors .= $videoExist;
        $errorDetected=1;
    }    

}

if(!$errorDetected)
{
    $req = "INSERT INTO videos (name, image_link, video_link, channel_id, categorie_id, language_id)
                VALUES (:name, :image_link, :video_link, :channel_id, :categorie_id, :language_id)";
    $rep = $bdd-> prepare($req);
    $rep->execute(array(
            ":name"=>$video_name,
            ":image_link"=>$image_link,
            ":video_link"=>$video_link,
            ":channel_id"=>$channel_id,
            ":categorie_id"=>$categorie_id,
            ":language_id"=>$language_id));


    echo '<div class="alert alert-success">
            <p><strong>video added successfully</strong></p>
            <p>Name = '.$video_name.'</p>
            <p>Video Link = '.$video_link.'</p>
            <p>Image Link = '.$image_link.'</p>
            <p>Channel = '.$_POST['video_channel'].'</p>
            <p>Language = '.$_POST['video_language'].''.'</p>
            <p>Categorie = '.$_POST['video_categorie'].'</p>

          </div>';
}
else
{
    echo '<div class="alert alert-danger">'.$errors.'</div>';
}

?>
