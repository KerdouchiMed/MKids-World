<?php 
session_start();

if (!isset($_SESSION["name"]) || !isset($_SESSION["email"])) 
{
	header('location: login.php');
}
else
{ 
?>
<?php $page_name="index"; ?>
<?php include 'db.php'; ?>
<?php include 'header.php'; ?>

<div class="col-md-2" id="sidebar">
    <?php include 'sidebar.php' ?>
</div>
<div class="container-fluid" id="content">
	<div class="tab-content col-md-10">
	     
	    <div id="edit-videos" class="tab-pane fade"> <!-- Edit-Videos -->
	    	<div class="panel-heading">
		        
		        <div class="pull-left">
		        	<span class="" style="font-size: 24px">Edit Videos</span>
					<button class="btn btn-primary" data-target="#Add-Video" data-toggle="modal">
		        		Add new video <span class="glyphicon glyphicon-plus"></span>
		       		</button>
		       		<br><br><br>
				</div>
			</div> 
	        <table class="table table-striped">
	        	<thead>
	        		<tr>
	        			<th>ID</th>
	        			<th>Name</th>
	        			<th>Language</th>
	        			<th>Channel</th>
	        			<th>Delete</th>
	        			<th>Edit</th>
	        		</tr>
	        	</thead>

	        	<tbody>
	        		<?php video_tr(); ?>
	        	</tbody>
	        </table>       
			         
	    </div> 									<!-- Edit-Videos -->

	    <?php VideoClassList("edit-languages") ?> <!-- Edit-Languages -->
	    <?php VideoClassList("edit-channels") ?> <!-- Edit-Channels -->
	    <?php VideoClassList("edit-categories") ?> <!-- Edit-Categories -->

	    <div id="modals">
	    	<?php include 'modal.php'; ?>
	    </div>
	    

	</div>
</div>
<?php include 'footer.php'; ?>
<?php } ?>