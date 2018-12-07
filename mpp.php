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
                             <button type="button" name="add" id="add_button" data-toggle="modal" data-target="#addmp" class="btn btn-success btn-xs">Add</button>   		
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table" id="mptable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Color</th>
                                            <th>Options</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                 </div>
            </div>
        </div>
    </div>
    <div id="addmp" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" action="mpp_create.php" id="creatempform">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title"><i class="fa fa-plus"></i> Add Matiers Premiers</h4></center>
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
    
<script type="text/javascript" src="js/mpp.js"></script>