<?php 

include('../db.php');
include('../functions.php');
var_dump($_GET);
if(!empty($_GET['className']))
{
	$class_video=$_GET['className'];
	$bdd;
	$req = "SELECT * FROM $class_video";
	$rep = $bdd-> prepare($req);
	$rep->execute();
	while ($row = $rep->fetch())
	{
		//var_dump($row);
		echo'	
		<tr id="'.$row['id'].'" class="class-tr">
			<td>'.$row['id'].'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['image_link'].'</td>
			<td>
				<button class="delete-'.$class_video.'">
					<span class="text-center glyphicon glyphicon-trash"></span>
				</button>
			</td>
			<td>
				<button class="edit-'.$class_video.'">
					<span class=" glyphicon glyphicon-pencil"></span>
				</button>
			</td>
	    </tr>';
	}	
}
else
	echo "ERRORS";

 ?>