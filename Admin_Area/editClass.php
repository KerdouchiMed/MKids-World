<?php 
include 'db.php';
$big_image = "Image too big, the size of this image is up to 500000";
$load_err = "Upload image filed";
$type_img = "the file is not recognized <br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";


$errors="";
// var_dump($_POST);
// var_dump($_FILES);
// exit();
if (isset($_POST['id'])) 
{
	
	$tmpArray = explode('-',$_POST['id']);
	//var_dump($tmpArray);
	$id = filter_var($tmpArray[1],FILTER_SANITIZE_NUMBER_INT);
	$className = filter_var($tmpArray[0],FILTER_SANITIZE_STRING);
	//echo $id.'and'.$className;
	$req = "SELECT * FROM `$className` WHERE `id` = :id";
	$rep = $bdd->prepare($req);
	$rep->execute(array(':id' => $id));
	$row = $rep->fetchall();
	//var_dump($row);
	if(count($row) == 1)
	{	//var_dump($_POST);
		if(!empty($_POST['name']) && !empty($_FILES['image']))
		{	$name= filter_var($_POST['name'],FILTER_SANITIZE_STRING);
			
					
			$image= $_FILES['image'];
			$target_dir = "images/";
			$imageFileType = pathinfo($image['name'],PATHINFO_EXTENSION);
			$target_file = $target_dir . microtime(true)*10000 .'.'.$imageFileType;
			$uploadOk = 1;
			$noImage = 0;
			if($_FILES['image']['error']== 4)
			{
				//this condition march
				$noImage=1;
			 	$uploadOk = 0;

			}
			else
			{
				// Check if image file is a actual image or fake image
				$check = getimagesize($image["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} 
				else {
					$errors.=$type_img;
					$uploadOk = 0;
				}

				
				// Check file size
				if ($image["size"] > 500000) {
					$errors .= $big_image;
					$uploadOk = 0;
				}
				
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					$errors .= $type_img;
					$uploadOk = 0;
				}
			}
			// Check if $uploadOk is set to 0 by an error
			if ($noImage==1) 
			{
				$req ="UPDATE ".$className." SET name = '".$_POST['name']."' WHERE id = ".$id.";";
				//echo $req;
				$rep = $bdd ->prepare($req);
				if(!$rep ->execute())
					print_r($bdd->errorInfo());
				else
					echo '<div class="alert alert-warning">No Image Uploaded</div>';
				exit();
				
			}
			// if everything is ok, try to upload file
			else if($uploadOk==1)
			{
				if (move_uploaded_file($_FILES["image"]["tmp_name"], "../".$target_file)) {
					echo '
					<div class="alert alert-success">
					<p>This image has been uploaded.</p>
					</div>';
					$req ="UPDATE ".$className." SET name = '".$_POST['name']."', image_link =  '".$target_file."' WHERE id = ".$id.";";
					//echo $req;
					$rep = $bdd ->prepare($req);
					if(!$rep ->execute())
						print_r($bdd->errorInfo());
					else
						echo 
					'<div class="alert alert-success">
						<p>This '.$className.' has been updated.</p>
					</div>';;
					exit();
					
				} else {
					echo "<p>Sorry, there was an error uploading your file.</p>";
				}
			}
			else
			{
				echo '<div class="alert alert-danger">'.$errors.'</div>';
			}

			
		}
	}
	else
	{
		$errors .= "<p>Video not exit</p>";
	}

	echo '
	<div class="alert alert-danger">med
	      '.$errors.'
    </div>
	';
	
}
?>