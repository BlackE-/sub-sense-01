<?php
	require_once "_subsense.php";
	$set = new Subsense();
	$all = $_POST;
	if(isset($all['email']) && isset($all['password'])){
		$returnValue = $set->loginAdmin($all['email'],$all['password']);
	}

	//JSON RETURN
	header('Content-Type: application/json');
	$json_return['return'] = $returnValue;
	$json_return['message'] = $set->getErrorMessage();
	unset($set);
	echo json_encode($json_return);
?>