<?php
    const SUCCESS_CODE = 200;
    const ERROR_CODE = 400;
    require('./_subsense.php');
    $set = new Subsense();
	$request = $_POST['request'];
	
	switch($request){
		case 'importUsers':
            if($_FILES['file']['error'] == 0){
                $name = $_FILES['file']['name'];
                $tmp = explode('.', $name);
                $ext = end($tmp);

                $type = $_FILES['file']['type'];
                $tmpName = $_FILES['file']['tmp_name'];
            
                // check the file is a csv
                if($ext === 'csv'){
                    $tmpName = $_FILES['file']['tmp_name'];
                    $csvAsArray = array_map('str_getcsv', file($tmpName));

                    // ya que tengo la data recorrerla para guardar cada registro
                    for($index = 1;$index<count($csvAsArray);$index++){
                        $user = $csvAsArray[$index];
                        $folio = $user[0];
                        $firstname = $user[1];
                        $lastname = $user[2];
                        $username = '';
                        $email = $user[3];
                        $password = '';
                        $type = '5';
                        $dob = $user[6] . "-" . $user[5] . "-" . $user[4];
                        $sex = $user[7];
                        $nse = $user[8];

                        $addressline1 = $user[9];
                        $addressline2 = '';
                        $betweenstreet1 = $user[10];
                        $betweenstreet2 = $user[11];
                        $zone = $user[12];
                        $city = $user[13];
                        $zipcode = $user[14];
                        $state = $user[15];
                        $country = $user[16];
                        $notes = '';
                        $phone = $user[17];
                        $name = '';
                        $_default = true;

                        $iduser = $set->insertUser($folio, $firstname, $lastname, $username, $email, $password, $type , $dob, $sex, $nse);
                        $direction = $set->insertDirection($addressline1, $addressline2,  $betweenstreet1 , $betweenstreet2, $zone, $city, $zipcode, $state, $country, $notes, $phone, $name, $_default, $iduser);
                        if(!isset($_SESSION))session_start();
                        $relation = $set->insertuserrelation( $_SESSION[$set->GetLoginSessionVar()] , $iduser);
                        $response['return'] = $iduser;
                        $response['message'] = $set->getErrorMessage();
                    }

                    $json = json_encode($response);
                    http_response_code(SUCCESS_CODE);
                }else{
                    $success =  $request;
                    $json = json_encode($success);
                    http_response_code(ERROR_CODE);
                }
		        die($json);
	        }else{
	        	$success =  $_POST;
		        $json = json_encode($success);
		        http_response_code(ERROR_CODE);
		        die($json);
	        }
		break;
    }
?>

