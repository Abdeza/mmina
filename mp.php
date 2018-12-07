<?php
//category.php

include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

if($_SESSION['type'] != 'master')
{
	header("location:index.php");
}

include('header.php');

?>

	<span id="alert_action"></span>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                        <div class="row">
                            <h3 class="panel-title">Matiers Premiers List</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <div class="row" align="right">
                             <button type="button" name="add" id="add_button" data-toggle="modal" data-target="#mpModal" class="btn btn-success btn-xs">Add</button>   		
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                    		<table id="mp_data" class="table table-bordered table-striped">
                    			<thead><tr>
									<th>ID</th>
									<th>Matiers Premiers Name</th>
									<th>Status</th>
									<th>Color</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr></thead>
                    		</table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mpModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="mp_form">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Matiers Premiers</h4>
    				</div>
    				<div class="modal-body">
    					<label>Enter M.P Name</label>
						<input type="text" name="mp_name" id="mp_name" class="form-control" required />
						<label>Enter M.P Color</label>
						<input type="text" name="mp_color" id="mp_color" class="form-control" required />
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="mp_id" id="mp_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script>
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#mp_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Matiers Premiers");
		$('#action').val('Add');
		$('#btn_action').val('Add');
	});

	$(document).on('submit','#mp_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"mp_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#mp_form')[0].reset();
				$('#mpModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				mpdataTable.ajax.reload();
			}
		})
	});

	$(document).on('click', '.update', function(){
		var mp_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"mp_action.php",
			method:"POST",
			data:{mp_id:mp_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#mpModal').modal('show');
				$('#mp_name').val(data.mp_name);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Matiers Premiers");
				$('#mp_id').val(mp_id);
				$('#action').val('Edit');
				$('#btn_action').val("Edit");
			}
		})
	});

	var mpdataTable = $('#mp_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"mp_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[4, 5],
				"orderable":false,
			},
		],
		"pageLength": 25
	});
	$(document).on('click', '.delete', function(){
		var mp_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("Are you sure you want to change status?"))
		{
			$.ajax({
				url:"mp_action.php",
				method:"POST",
				data:{mp_id:mp_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					mpdataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});
});
</script>

<?php
include('footer.php');
?>


				