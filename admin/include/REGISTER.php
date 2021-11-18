<?php
	/*
		CREATE tables in DB
		&
		FIRST TIME REGISTER user
	*/
	require_once "_subsense.php";
	$set = new Subsense();
	$set->checkDBLogin();
	$all = $_POST;
	$returnValue = true;

	$email = $_POST['email'];
	$password = $_POST['password'];
	$_type = $_POST['type'];

	$returnValue = $set->registerUser($email,$password,$_type);
	$json_return['return'] = $returnValue;
	$json_return['message'] = $set->getErrorMessage();

	//JSON RETURN
	header('Content-Type: application/json');
	unset($set);
	echo json_encode($json_return);
?>