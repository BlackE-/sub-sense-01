<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');

	$content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true); /* $decoded can be used the same as you would use $_POST in $.ajax */

	$status = true;
	$myfile = fopen("setup.ini", "w") or die("Unable to open file!");
	$txt = 'host="'.$decoded['host'].'";'.PHP_EOL;
	$txt .= 'database="'.$decoded['database'].'";'.PHP_EOL;
	$txt .= 'username="'.$decoded['username'].'";'.PHP_EOL;
	$txt .= 'pwd="'.$decoded['password'].'";';

	fwrite($myfile, $txt);
	fclose($myfile);

	//JSON RETURN
	$json_return = array(
		"return" => $status,
		'data' => $txt
	);
	echo json_encode($json_return);
?>