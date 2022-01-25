<?php
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true); /* $decoded can be used the same as you would use $_POST in $.ajax */
    $request = $decoded['request'];

    $response['return'] = $request;
    $response['message'] = "Mensaje de error";

    require('./_subsense.php');
    $set = new Subsense();
    

    switch($request){
        case 'getCampainsCount':
            $response['return'] = $set->getCampainsCount();
            $response['message'] = $set->getErrorMessage();
        break;
        case 'getPanelistCount':
            session_start();
            $response['return'] = $set->getPanelistCount($_SESSION[$set->GetLoginSessionVar()] , 5);
            $response['message'] = $set->getErrorMessage();
        break;

        case "getUsersModerator":
            $type = $decoded['type'];
            session_start();
            $response['return'] = $set->getUsersModerator($_SESSION[$set->GetLoginSessionVar()] , $type);
            $response['message'] = $set->getErrorMessage();
        break;
        case "getCampains":
            $response['return'] = $set->getCampains();
            $response['message'] = $set->getErrorMessage();
        break;
        case "getCampain":
            $idcampain = $decoded['idcampain'];
            $response['return'] = $set->getCampain($idcampain); //return campain data and links to surveys
            
            // $campain = $campain = $set->getCampain($idcampain); //return campain data and links to surveys
            // if(!$campain){

            // }else{
                // $surveysFromCampain = $set->getSurveysFromCampain($idcampain);
            // }
            // $response['return'] = array('campain'=>$campain,'surveys'=>$surveysFromCampain);
            
            $response['message'] = $set->getErrorMessage();
        break;
        case "getSurveys":
            $response['return'] = $set->getSurveys();
            $response['message'] = $set->getErrorMessage();
        break;
        case "getAnswer":
            $idpanelist = $decoded['idpanelist'];
            $idquestion = $decoded['idquestion'];
            $_typeSurvey = $decoded['_typeSurvey'];
            $_typeQuestion = $decoded['_typeQuestion'];
            $idsample = '';
            if(isset($decoded['idsample'])){$idsample = $decoded['idsample'];}
            $answer = $set->getAnswer($idquestion,$idsample,$idpanelist);   //[idanswer,value]
            if(!$answer){$response['return'] = false;}
            else{$response['return'] = $answer;}
            $response['message'] = $set->getErrorMessage();
        break;

        case "getSurveysFromCampain":
            $idcampain = $decoded['idcampain'];
            $response['return'] = $set->getSurveys($idcampain);
            $response['message'] = $set->getErrorMessage();
        break;

        case "getReport":
            $idcampain = $decoded['idcampain'];
            $idsurvey = $decoded['idsurvey'];
            $surveyType = $decoded['surveyType'];
            $idpanelist = $decoded['idpanelist'];


            $questions = $set->getSurveyQuestions( $idsurvey );
            $totalQuestions = count( $questions );
            $totalAnswers = 0;
            $samples = NULL;
            $arrayData = [];
            switch($surveyType){
                case 'samples':
                    $samples = $set->getSurveySamples($idsurvey);
                    $totalQuestions = $totalQuestions * count($samples);
                    for($x = 0; $x < count($samples); $x++){
                        $arrayDataQA = [];
                        for($y = 0; $y < count($questions); $y++){
                            $respuesta = $set->getAnswer($questions[$y]['idquestion'],$samples[$x]['idsample'],$idpanelist);
                            if(!$respuesta){}
                            else{$totalAnswers++;}
                            array_push($arrayDataQA,['question'=>$questions[$y]['html'],'answer'=>$respuesta]);
                        }
                        array_push($arrayData,['sample'=>$samples[$x],'faq'=>$arrayDataQA]);
                    }
                break;
                default:
                    for($y = 0; $y < count($questions); $y++){
                        $respuesta = $set->getAnswer($questions[$y]['idquestion'],0,$idpanelist);
                        if(!$respuesta){}
                        else{$totalAnswers++;}
                        array_push($arrayData,['question'=>$questions[$y]['html'],'answer'=>$respuesta]);
                    }
                break;
            }

            $response['return'] = ['totalQuestions'=>$totalQuestions,'totalAnswers'=>$totalAnswers,'QA'=>$arrayData];
            $response['message'] = $set->getErrorMessage();
        break;





        case "insertUser":
            $folio =        $decoded['folio'];
            $firstname =    $decoded['firstname'];
            $lastname =     $decoded['lastname'];
            $username =     '';
            $email =        $decoded['email'];
            $password =     '';
            $type =         $decoded['type'];
            $dob =          $decoded['dob'];
            $sex =          $decoded['sex'];
            $nse =          $decoded['nse'];
            $iduser = $set->insertUser($folio, $firstname, $lastname, $username, $email, $password, $type , $dob, $sex, $nse);
            if( !$iduser ){
                $response['return'] = $iduser;
                $response['message'] = $set->getErrorMessage();
            }else{
                $addressline1 =   $decoded['addressline1'];
                $addressline2 =   '';
                $betweenstreet1 =   $decoded['betweenstreet1'];
                $betweenstreet2 =   $decoded['betweenstreet2'];
                $zone =             $decoded['zone'];
                $city =             $decoded['city'];
                $zipcode =         $decoded['zipcode'];
                $state =            $decoded['state'];
                $country =          $decoded['country'];
                $notes =            '';
                $phone =            $decoded['phone'];
                $name =             '';
                $_default =         true;
                $direction = $set->insertDirection( $addressline1, $addressline1,  $betweenstreet1 , $betweenstreet2, $zone, $city, $zipcode, $state, $country, $notes, $phone, $name,$_default, $iduser);
                if(!$direction){$response['return'] = $direction;}
                session_start();
                $relation = $set->insertuserrelation( $_SESSION[$set->GetLoginSessionVar()] , $iduser);
                $response['message'] = $set->getErrorMessage();
            }
        break;
        case "insertCampain":   //alreasy insert surveys
            session_start();
            $iduser = $_SESSION[$set->GetLoginSessionVar()];

            $name =  $decoded['name'];
            $description =  $decoded['description'];
            $numberSurveys =  $decoded['numberSurveys'];

            //insert campain
            $idcampain = $set->insertCampain($name, $description, true, $iduser ,'');
            if( !$idcampain ){
                $response['return'] = $iduser;
                $response['message'] = $set->getErrorMessage();
            }else{
                //insert surveys // so i can have the ID and then just edit the information
                $idSurveys = array();
                for( $i = 1 ;$i <= $numberSurveys ; $i++){
                                       //$name, $html, $_order, $type, $repetition, $idmedia , $idcampain, $iduser
                    $set->insertSurvey('','', $i , '', '', '',$idcampain , $iduser );
                }
                $response['return'] = $idcampain;
                $response['message'] = $set->getErrorMessage();

            }
        break;
        case "insertQuestion":
            $html =  $decoded['html'];
            $_order =  $decoded['_order'];
            $type =  $decoded['type'];
            $idmedia =  $decoded['idmedia'];
            $idsurvey =  $decoded['idsurvey'];

            //insert question
            $idquestion = $set->insertQuestion($html, $_order, $type, $idsurvey , $idmedia);
            $response['return'] = $idquestion;
            $response['message'] = $set->getErrorMessage();
        break;
        case "updateSurvey":
            $name =  $decoded['name'];
            $description =  $decoded['description'];
            $type =  $decoded['type'];
            $idsurvey =  $decoded['idsurvey'];

            $sample = $set->updateSurvey( $name, $description, $type, $idsurvey );
            $response['return'] = $sample;
            $response['message'] = $set->getErrorMessage();
        break;
        case "insertSample":
            $name =  $decoded['name'];
            $_order =  $decoded['_order'];
            $idsurvey =  $decoded['idsurvey'];

            $sample = $set->insertSample( $name,$_order,$idsurvey );
            $response['return'] = $sample;
            $response['message'] = $set->getErrorMessage();
        break;
        case "insertResponse":
            $value  =  $decoded['value'];
            $label =  $decoded['label'];
            $type =  $decoded['type'];
            $_order =  $decoded['_order'];
            $idquestion =  $decoded['idquestion'];

            $idresponse = $set->insertResponse( $value,$label,$type );
            if(!$idresponse){
                $returnValue['return'] = false;
            }else{
                $returnValue['return'] = $idresponse;
                $idquestion_response = $set->insertquestionresponse($_order,$idquestion,$idresponse);
                if(!$idquestion_response){
                    $returnValue['return'] = false;
                }
            }
            $response['message'] = $set->getErrorMessage();
        break; 

        case "saveAnswer":
            $value = $decoded['value'];
            $idpanelist = $decoded['idpanelist'];
            $idquestion = $decoded['idquestion'];
            $idquestion_response = $decoded['idquestion_response'];
            $idanswer = $decoded['idanswer'];
            $idsample = $decoded['idsample'];
            if($idanswer == "null"){
                 //insertar answer
                $answer = $set->saveAnswer($value,$idquestion_response,$idquestion,$idsample,$idpanelist); 
            }
            else{
                //acutalizar answer
                $idanswer = $decoded['idanswer']; //[idanswer,value,idquestion_response]
                $_typeInput = $decoded['_typeInput'];
                if($_typeInput == 'checkbox'){
                    $array_idanswer = explode(",",$idanswer);
                    $answer = $set->updateAnswerMultiple($array_idanswer,$value,$idquestion_response,$idquestion,$idsample,$idpanelist);
                }else{
                    $answer = $set->updateAnswer($idanswer,$value,$idquestion_response); 
                }
            }
            $response['return'] = $answer;
            $response['message'] = $set->getErrorMessage();
        break;
    }

    
    header('Content-Type: application/json; charset=utf-8');
    unset($set);
    echo json_encode($response);
?>