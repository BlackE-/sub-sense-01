<?php
	require_once "_subsense.php";
	$set = new Subsense();
	$all = $_POST;
	if(isset($all['username']) && isset($all['password'])){
		$returnValue = $set->login($all['username'],$all['password']);
	}

	//JSON RETURN
	header('Content-Type: application/json');
	$json_return['return'] = $returnValue;
	$json_return['message'] = $set->getErrorMessage();
	unset($set);
	echo json_encode($json_return);
?>