<?php	
	include('../db.php');
	include('../functions.php');
	$req = "SELECT * FROM videos";
	$rep = $bdd-> prepare($req);
	$rep->execute();
	while ($row = $rep->fetch())
	{
		var_dump($row);
		echo'	
		<tr id="'.$row['id'].'" class="video-tr">
			<td class="id">'.$row['id'].'</td>
			<td class="name">'.$row['name'].'</td>
			<td class="language">'.name_of_id('languages',$row['language_id']).'</td>
			<td class="channel">'.name_of_id('channels',$row['channel_id']).'</td>
			<td>
				<button  class="deleteVideo" >
					<span class="glyphicon glyphicon-trash"></span>
				</button>
			</td>
			<td>
				<button class="editVideo">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
			</td>
        </tr>';
	}
?>