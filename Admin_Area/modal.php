
<!-- Add videos modal -->
<div class="modal fade" id="Add-Video">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h3 class="">Add Video</h3>
            </div>
            <form id="addVideoForm" action="#" method="post">
                <div class="modal-body" >
                    <div id="addVideoRep"></div>
                    <br>
                    <div class="form-group">
                       <input name="video_name" type="text" class="form-control" required placeholder="Name">
                    </div>

                    <div class="form-group">
                        <input name="video_link" type="text" class="form-control" required placeholder="video link">
                    </div>

                    <div class="form-group">
                        <label for="channel"> Select channels</label>
                        <select name="video_channel" class="form-control" id="channel">
                
                        <?php
                        $rep = $bdd->prepare("SELECT name FROM channels");
                        $rep->execute();
                        while($row = $rep->fetch())
                        {
                            echo'<option name="'.$row["name"].'">'.$row["name"].'</option>';
                        }
                        ?>
                        </select>

                    </div>
            
                    <div class="form-group">
                        <label for="languages"> Select languages</label>
                        <select name="video_language" class="form-control" id="languages">
                        <?php
                            $rep = $bdd->prepare("SELECT name FROM languages");
                            $rep->execute();
                            while($row = $rep->fetch())
                            {
                                echo'<option name="'.$row["name"].'">'.$row["name"].'</option>';
                            }
                        ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="categorie"> Select categories</label>
                        <select name="video_categorie" class="form-control" id="categorie">
                        <?php
                            $rep = $bdd->prepare("SELECT name FROM categories");
                            $rep->execute();
                            while($row = $rep->fetch())
                            {
                                echo'<option name="'.$row["name"].'">'.$row["name"].'</option>';
                            }
                        ?>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete video modal -->
<div class="modal fade deleteVideo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                        &times;
                </button>
                <h3>Delete this video ?</h3>
            </div>
            <form id="deleteVideoForm" method="post">
            <div class="modal-body">
                <div id="deleteRep"></div>
                <p>Are you sure, you want to delete this video</p>
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




<!-- Edit video modal -->
<div class="modal fade editVideo" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h3 class="">Edit Video</h3>
            </div>
            <form id="editVideoForm" action="" method="post">
                <div class="modal-body" >
                    <div id="editVideoRep"></div>
                    <br>
                    <div class="form-group">
                        <label>Name : </label>
                       <input name="video_name"  type="text" class="form-control" required >
                    </div>

                    <div class="form-group">
                        <label for="channels"> Select channels</label>
                        <select name="video_channel" class="form-control" id="channels">
                
                        <?php
                        $rep = $bdd->prepare("SELECT name FROM channels");
                        $rep->execute();
                        while($row = $rep->fetch())
                        {
                            echo'<option name="'.$row["name"].'">'.$row["name"].'</option>';
                        }
                        ?>
                        </select>

                    </div>
            
                    <div class="form-group">
                        <label for="languages"> Select languages</label>
                        <select name="video_language" class="form-control" id="languages">
                        <?php
                            $rep = $bdd->prepare("SELECT name FROM languages");
                            $rep->execute();
                            while($row = $rep->fetch())
                            {
                                echo'<option name="'.$row["name"].'">'.$row["name"].'</option>';
                            }
                        ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="categories"> Select categories</label>
                        <select name="video_categorie" class="form-control" id="categories">
                        <?php
                            $rep = $bdd->prepare("SELECT name FROM categories");
                            $rep->execute();
                            while($row = $rep->fetch())
                            {
                                echo'<option name="'.$row["name"].'">'.$row["name"].'</option>';
                            }
                        ?>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>










<!-- Add Language modal -->
<?php add_new_class_modal("add-languages","addLanguageForm"); ?>
<?php deleteVideoClass_Modal('languages',"deleteLanguageForm"); ?>
<?php editVideoClass_Modal('languages',"editLanguageForm"); ?>

<!-- Add Channel modal -->
<?php add_new_class_modal("add-channels","addChannelForm"); ?>
<?php deleteVideoClass_Modal('channels','deleteChannelForm'); ?>
<?php editVideoClass_Modal('channels','editChannelForm'); ?>


<!-- Add Categories modal -->
<?php add_new_class_modal("add-categories","addCategorieForm"); ?>
<?php deleteVideoClass_Modal('categories','deleteCategorieForm'); ?>
<?php editVideoClass_Modal('categories','editCategorieForm'); ?>