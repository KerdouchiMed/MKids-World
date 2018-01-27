<?php
include('db.php');
/*messages */
$big_image = "Image too big, the size of this image is up to 500000";
$load_err = "Upload image filed";
$type_img = "the file is not recognized <br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

$errors="";



if (isset($_POST)) 
{

	if(!empty($_POST['name']) && !empty($_FILES['image']))
	{	$name= filter_var($_POST['name'],FILTER_SANITIZE_STRING);
		
		// if($_FILES['image']['error']== 4)
		// {
		// 	$req = "INSERT INTO languages () VALUES ()";
		// 	exit;
		// }
				
		$image= $_FILES['image'];
		$target_dir = "images/";
		$imageFileType = pathinfo($image['name'],PATHINFO_EXTENSION);
		$target_file = $target_dir . microtime(true)*10000 .'.'.$imageFileType;
		$uploadOk = 1;
		
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
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo '<div class="alert alert-danger">'.$errors.'</div>';
			
		
		}
		// if everything is ok, try to upload file
		else 
		{
			if (move_uploaded_file($_FILES["image"]["tmp_name"], "../".$target_file)) {
				
				$req ="INSERT INTO ".$_POST['class']." (name, image_link) 
						VALUES ('".$name."', '".$target_file."');";
				$rep = $bdd ->prepare($req);
				if(!$rep ->execute())
					print_r($bdd->errorInfo());
				else
					echo '<div class="alert alert-seccess">
						<p>This '.$_POST['class'].' has been added.</p>
					  </div>';
				
				
			} else {
				echo "<p>Sorry, there was an error uploading your file.</p>";
			}
		}

		
	}
}

?>
