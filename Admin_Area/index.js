$(document).ready(function () {
    
    $("#addVideoForm").submit(function (event) {
        event.preventDefault();
        var dataToAdd = $(this).serializeArray();

        $.ajax({
            url: "addNewVideo.php",
            type: "POST",
            data: dataToAdd,
            success: function (rep) {
                $("#addVideoRep").html(rep);
				$('#edit-videos table tbody').load('ajax/reloadVideoList.php'); 
                setTimeout(function() {$('#addVideoRep').empty();}, 4000);
                
            },
            error: function () {
                $("#addVideoRep").html('<div class="alert alert-danger">Ajax Error</div>');
            }

        });
    });




    $("#deleteVideoForm").submit(function (event) {
        event.preventDefault();
        var modal_id = $(this).parents('div.modal.fade.deleteVideo').attr('id');
        $.ajax({
            url: "deleteVideo.php",
            type: "POST",
            data: {
                'id': modal_id.split('-')[1]
            },
            success: function (rep) {
                $("#deleteRep").html(rep);
				$('#edit-videos table tbody').load('ajax/reloadVideoList.php'); 
                setTimeout(function () {
                    $('#' + modal_id).modal('hide');
                    $('tr#' + modal_id.split('-')[1]).remove();
                }, 1000);
            },
            error: function () {
                $("#deleteRep").html('<div class="alert alert-danger">Ajax Error</div>');
            }

        });
    });


    $("#editVideoForm").submit(function (event) {
        event.preventDefault();
        var modal_id = $(this).parents('.editVideo').attr('id');
        var dataToAdd = $(this).serializeArray();
        dataToAdd.push({
            name: 'id',
            value: modal_id.split('-')[1]
        });
        $.ajax({
            url: "editVideo.php",
            type: "POST",
            data: dataToAdd,
            success: function (rep) {
                $("#editVideoRep").html(rep);
               	//$('#edit-videos table tbody').load('ajax/reloadVideoList.php'); 
                setTimeout(function () {
                    $('#' + modal_id).modal('hide');
                    clearEditModal("#" + modal_id);
                }, 1000);
            },
            error: function () {
                $("#editVideoRep").html('<div class="alert alert-danger">Ajax Error</div>');
            }

        });
    });












    // this fonction send data for add video class 
    function sendPostData_Class(formId,className)
    {
     $(formId).submit(function (event) {
         event.preventDefault();
		 
      	var form_data = new FormData(this);
	    form_data.append('class',className);
         $.ajax({
             url : "addNewClass.php",
             type : "POST",
             data  : form_data,
			 processData: false,
      		 contentType: false,
             success : function(rep)
             {
                    $(formId+"-rep").html(rep); 
                    $("#edit-"+className+" table tbody").load('ajax/reloadClassList.php?className='+className);
                    setTimeout(function() {
                        $(formId+"-rep").empty();
                    }, 3000);
             },
             error    : function()
             {
                 $(formId+"-rep").html('<div class="alert alert-danger">Ajax Error</div>');    
             }

         });
     });
    }



    function deleteClassForm(formId,className)
    {
        $(formId).submit(function (event) {
        event.preventDefault();
        var modal_id = $(this).parents('div.modal.fade.delete-'+className).attr('id');

        $.ajax({
            url: "deleteClass.php",
            type: "POST",
            data: {
                'id': modal_id.split('_')[1]
            },
            success: function (rep) {
                $(formId+"-rep").html(rep);
                $("#edit-"+className+" tr#"+modal_id.split('-')[1]).remove();
                 
                setTimeout(function () {
                     $('#' + modal_id).modal('hide');
                     $(formId+"-rep").empty();
                 }, 2000);
            },
            error: function () {
                $(formId+"-rep").html('<div class="alert alert-danger">Ajax Error</div>');
            }

        });
    });
    }




    function editClassForm(formId,className)
    {
        $(formId).submit(function (event) {
        event.preventDefault();
        var modal_id = $(this).parents('div.modal.fade.edit-'+className).attr('id');
        var form_data = new FormData(this);
        form_data.append('id',modal_id.split('_')[1]);
         $.ajax({
             url : "editClass.php",
             type : "POST",
             data  : form_data,
             processData: false,
             contentType: false,
             success : function(rep)
             {
                    $(formId+"-rep").html(rep); 
                    $("#edit-"+className+" table tbody").load('ajax/reloadClassList.php?className='+className);
                    // setTimeout(function() {
                    //     $(formId+"-rep").empty();
                    // }, 3000);
             },
             error    : function()
             {
                 $(formId+"-rep").html('<div class="alert alert-danger">Ajax Error</div>');    
             }

        });
    });
    }
    //send post data for add new language
    sendPostData_Class('#addLanguageForm','languages');
    deleteClassForm('#deleteLanguageForm','languages');
    editClassForm('#editLanguageForm','languages');

    //send post data for add new channel
    sendPostData_Class('#addChannelForm','channels');
    deleteClassForm('#deleteChannelForm','channels');
    editClassForm('#editChannelForm','channels');

    //send post data for add new categorie
    sendPostData_Class('#addCategorieForm','categories');
    deleteClassForm('#deleteCategorieForm','categories');
    editClassForm('#editCategorieForm','categories');



  });

