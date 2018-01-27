<?php 
include 'db.php';
$deleteImp="<p><strong>Delete this video is impossible</p>";
$videoExist="<p><strong>This video does not exist</strong></p>";
$sqlErrors = "<p><strong>SQL ERRORS</strong>, please contact Admin</p>";
$errors="";
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
	{
		$row = $row[0];
		$req ="DELETE FROM `$className` WHERE `id` = :id";
		$rep = $bdd->prepare($req);
		if(!$rep->execute(array(':id' => $id)))
		{
			$errors .= $sqlErrors;
		}
		else
		{
			echo '
			<div class="alert alert-success">
	            <p>The '.$className.' : "'.$row['name'].'" <strong> Is deleted successfully</strong></p>
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