<?php

//mp_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO mp (mp_name) 
		VALUES (:mp_name)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':mp_name'	=>	$_POST["mp_name"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Matiers Premiers Name Added';
		}
	}
	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM mp WHERE mp_id = :mp_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':mp_id'	=>	$_POST["mp_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['mp_name'] = $row['mp_name'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE mp set mp_name = :mp_name  
		WHERE mp_id = :mp_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':mp_name'	=>	$_POST["mp_name"],
				':mp_id'		=>	$_POST["mp_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'mp Name Edited';
		}
	}
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['status'] == 'active')
		{
			$status = 'inactive';	
		}
		$query = "
		UPDATE mp 
		SET mp_status = :mp_status 
		WHERE mp_id = :mp_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':mp_status'	=>	$status,
				':mp_id'		=>	$_POST["mp_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'mp status change to ' . $status;
		}
	}
}

?>