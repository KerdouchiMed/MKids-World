<?php
function name_of_id($table,$id)
{
	global $bdd;
	$req = "SELECT name FROM $table WHERE id = :id";
	$rep = $bdd->prepare($req);
	$rep->execute(array(":id"=>$id));
	while ($row = $rep->fetch()) 
	{
		return $row['name'];
	}
}

function video_tr()
{
	global $bdd;
	$req = "SELECT * FROM videos";
	$rep = $bdd-> prepare($req);
	$rep->execute();
	while ($row = $rep->fetch())
	{
		//var_dump($row);
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
	
}

// for language categories channel 
function class_video_tr($class_video)
{
	global $bdd;
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


// afficher le contenue des element edit Language, channel, categorie de side bar
function VideoClassList($classId)
{ ?>
	<div id="<?=$classId?>" class="tab-pane fade"> <!--  -->
	    	<div class="panel-heading">
		        
		        <div class="pull-left">
		        	<span class="" style="font-size: 24px">
		        		Edit <?=explode('-',$classId)[1]?>
		        	</span>
					<button class="btn btn-primary" 
							data-target="#add-<?=explode('-',$classId)[1]?>" 
							data-toggle="modal">
		        		Add new <?=explode('-',$classId)[1]?>
		        		<span class="glyphicon glyphicon-plus"></span>
		       		</button>
		       		<br><br><br>
				</div>
			</div> 
	        <table class="table table-striped">
	        	<thead>
	        		<tr>
	        			<th>ID</th>
	        			<th>Name</th>
	        			<th>Image link</th>
	        			<th>Delet</th>
	        			<th>Edit</th>
	        		</tr>
	        	</thead>

	        	<tbody>
	        	<?php class_video_tr(strtolower(explode('-',$classId)[1])); ?>
	        	</tbody>
	        </table>       
			         
	    </div> <!-- Edit-Languages -->

<?php }




function add_new_class_modal($id, $formId)
{
	
	?>
	<div class="modal fade" id="<?php echo $id; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h3 class=""><?= $id ?></h3>
            </div>
            <form id="<?php echo $formId; ?>" action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body" >
                    <div id="<?= $formId ?>-rep"></div>
                    <br>
                    <div class="form-group">
                       <input name="name" type="text" class="form-control" required placeholder="Name">
                    </div>

                    <div class="form-group">
                       <div class="input-group input-file" name="image">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-choose" type="button">Choose</button>
                            </span>
                            <input type="text" class="form-control" placeholder='Choose an image...' />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-reset" type="button">Reset</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
	</div>

	<?php
}





function deleteVideoClass_Modal($class,$formId)
{?>
	<!-- Delete video modal -->
	<div class="modal fade delete-<?= $class;?>">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">
	                        &times;
	                </button>
	                <h3>Delete this <?= $class ?> ?</h3>
	            </div>
	            <form id="<?= $formId ;?>" method="post">
	            <div class="modal-body">
	                <div id="<?= $formId; ?>-rep"></div>
	                <p>Are you sure, you want to delete this </p>
	            </div>
	            <div class="modal-footer">
	                <div class="form-group">
	                    <button class="btn btn-primary" type="submit">Delete</button>
	                    <button class="btn btn-default" class="close" data-dismiss="modal">Cancel</button>    
	                </div>
	            </div>
	            </form>
	        </div>
	    </div>
	</div>
<?php }





function editVideoClass_Modal($class,$formId)
{?>
	<!-- Delete video modal -->
	<div class="modal fade edit-<?= $class;?>">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">
	                        &times;
	                </button>
	                <h3>edit this <?= $class ?> ?</h3>
	            </div>
	            <form id="<?php echo $formId; ?>" action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body" >
                    <div id="<?= $formId ?>-rep"></div>
                    <br>
                    <div class="form-group">
                       <input name="name" type="text" class="form-control" required placeholder="Name">
                    </div>

                    <div class="form-group">
                       <div class="input-group input-file" name="image">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-choose" type="button">Choose</button>
                            </span>
                            <input type="text" class="form-control" placeholder='Choose an image...' />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-reset" type="button">Reset</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
	        </div>
	    </div>
	</div>
<?php }




?>