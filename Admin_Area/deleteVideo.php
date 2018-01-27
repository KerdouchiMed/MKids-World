<?php 
include 'db.php';
$deleteImp="<p><strong>Delete this video is impossible</p>";
$videoExist="<p><strong>This video does not exist</strong></p>";
$sqlErrors = "<p><strong>SQL ERRORS</strong>, please contact Admin</p>";
$errors="";
if (isset($_POST['id'])) 
{

	$id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
	$req = "SELECT * FROM `videos` WHERE `videos`.`id` = :id";
	$rep = $bdd->prepare($req);
	$rep->execute(array(':id' => $id));
	$row = $rep->fetchall();
	//var_dump($row);
	if(count($row) == 1)
	{
		$row = $row[0];
		$req ="DELETE FROM `videos` WHERE `videos`.`id` = :id";
		$rep = $bdd->prepare($req);
		if(!$rep->execute(array(':id' => $id)))
		{
			$errors .= $sqlErrors;
		}
		else
		{
			echo '
			<div class="alert alert-success">
	            <p>The video : "'.$row['name'].'" <strong> Is deleted successfully</strong></p>
          	</div>
			';
			exit;
		}
	}
	else
	{
		$errors .= $videoExist;
	}

	echo '
	<div class="alert alert-danger">
	      '.$errors.'
    </div>
	';
	
}
?>