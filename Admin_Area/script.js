$(document).ready(function () {

	//l'evenement qui suit onclick trash button in edit video list
	$("#edit-videos").on('click','.deleteVideo',function (event) {
        $('#deleteRep').empty();
        var id = $(event.target).parents('tr.video-tr').attr('id');
        $('div.modal.fade.deleteVideo').attr('id', 'deleteVideo-' + id);
        $('#deleteVideo-' + id).modal('show');
        //$('#delete-video-1').modal('toggle');
        //$('#delete-video-1').modal('show');
        //$('#myModal').modal('hide');
    });



	//l'action de l'evenement de onclick pain button in edit video list 
    $("#edit-videos").on('click','.editVideo',function (event) {
		var row = $(event.target).parents('tr.video-tr');
        $('#editVideoRep').empty();
        var row = $(this).parents(".video-tr");
        var id = row.attr('id');
        var name = row.children('td.name').text();
        var channel = row.children('td.channel').text();
        var language = row.children('td.language').text();
        
        $('div.modal.fade.editVideo').attr('id', 'editVideo-' + id);

        $("#editVideo-" + id + " input[name='video_name']").val(name);
        $("#editVideo-" + id + " select#channels option[name='" + channel + "']").attr('selected', '');
        $("#editVideo-" + id + " select#languages option[name='" + language + "']").attr('selected', '');
        $('#editVideo-' + id).modal('show');

    });

    
    function clearEditModal(id) {
        $(id + ' #editVideoRep').empty();
        $(id + " input[name='video_name']").val('');
        $(id + " select#languages option").removeAttr('selected');
        $(id + " select#channels option").removeAttr('selected');
    }
	
	

    //delete video class element
    function show_delete_class_modal(class_id)
    {
    	var purClassName = class_id.split('-')[1];
		//purClassName = purClassName.toLowerCase();

		$("#edit-"+purClassName).on('click','.delete-'+purClassName,function (event) {
	        //$('#Rep').empty();
	        var id = $(event.target).parents('tr.class-tr').attr('id');
	        //alert(id);
	        $('div.modal.fade.delete-'+purClassName).attr('id', 'delete_'+purClassName+'-' + id);
	        $('#delete_'+purClassName+'-' + id).modal('show');
	    });
	}


	function show_edit_class_modal(class_id)
    {
    	var purClassName = class_id.split('-')[1];

		$("#edit-"+purClassName).on('click','.edit-'+purClassName,function (event) {
	        //$('#Rep').empty();
	        var id = $(event.target).parents('tr.class-tr').attr('id');
	        //alert(id);
	        $('div.modal.fade.edit-'+purClassName).attr('id', 'edit_'+purClassName+'-' + id);
	        $('#edit_'+purClassName+'-' + id).modal('show');
	    });
	}

	show_delete_class_modal('edit-languages');
	show_edit_class_modal('edit-languages');

	show_delete_class_modal('edit-channels');
	show_edit_class_modal('edit-channels');

	show_delete_class_modal('edit-categories');
	show_edit_class_modal('edit-categories');


	function bs_input_file() {
		$(".input-file").before(
			function() {
				if ( ! $(this).prev().hasClass('input-ghost') ) {
					var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
					element.attr("name",$(this).attr("name"));
					element.change(function(){
						element.next().find('input').val((element.val()).split('\\').pop());
					});
					$(this).find("button.btn-choose").click(function(){
						element.click();
					});
					$(this).find("button.btn-reset").click(function(){
						element.val(null);
						$(this).parents(".input-file").find('input').val('');
					});
					$(this).find('input').css("cursor","pointer");
					$(this).find('input').mousedown(function() {
						$(this).parents('.input-file').prev().click();
						return false;
					});
					return element;
				}
			}
		);
	}

	$(function() {
		bs_input_file();
	});


	




});
