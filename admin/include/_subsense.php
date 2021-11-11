<?php
	require_once '_db.php';
	class Subsense{
		private $db;
		private $rand_key = '8{wfYw&U8~`va6(Ia*6QRRSn{#->d8p}WoK[t{(;Wk4Yk{$$33?Df|HS$dXy>:Y';

		// your construct method here will ONLY except a `DB` class instance/object as $db. 
	    function __construct(){$this->db = new DB();}

	    function checkDBLogin(){
	    	if(!$this->db->DBLogin()){
	    		$returnValue['return'] = false;
	    		$returnValue['message'] = $this->db->error_message;
	    	}else{
	    		$returnValue['return'] = true;
	    		$returnValue['message'] = $this->db->error_message;
	    	}
	    	return $returnValue;
	    }

	    function getErrorMessage(){return $this->db->error_message;}

	    /*
			LOGIN
	    */
	    function loginAdmin($email,$password){
	    	$returnValue = true;
	    	$formvars = array();
	    	$this->checkDBLogin();
			$formvars['email'] = $this->Sanitize($email);	
			$qry = "SELECT iduser,_password FROM _user WHERE email='".$formvars['email']."'";
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleDBError("1.No tenemos registro de: ".$email);
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError("2.No tenemos registro de: ".$email);
		            $returnValue = false;
		        }else{
		        	$row = $this->db->fetchArray($result);
		        	$hash = $row['_password'];
		        	$auth = password_verify($password,$hash);
		        	if(!$auth){
		        		$this->db->HandleError("Contraseña incorrecta");
		            	$returnValue = false;
		        	}else{
		        		if(!isset($_SESSION)){ session_start(); }
				        $_SESSION[$this->GetLoginSessionVar()] = $row['iduser'];
				        $_SESSION['timeout'] = time() + (1 * 24 * 60 * 60);
				        						// 1 day; 24 hours; 60 mins; 60 secs
		        		$returnValue = $row['iduser'];
		        	}
		        } 
			}
		    $this->db->closeAll();
		    return $returnValue;
	    }

	    function logout(){
	    	session_start();
		    $sessionvar = $this->GetLoginSessionVar();
		    $_SESSION[$sessionvar]=NULL;
		    unset($_SESSION[$sessionvar]);
		    return true;
	    }


		/*
			users
		*/

		function getUsers($type){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT iduser,firstname,lastname,type from _user WHERE type='.$type;
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin usuarios');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin usuarios');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}

		function getUsersModerator( $moderator, $type ){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT 	_user.folio,_user.firstname,_user.lastname,_user.nse,_user.dob,_user.sex,_user.iduser,_user.type,
							_usersrelation.moderator, _usersrelation.panelist 
					from _user,_usersrelation
					WHERE _user.iduser = _usersrelation.panelist
					AND _usersrelation.moderator='.$moderator 
					.' AND _user.type='.$type;
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleDBError('Sin usuarios');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin usuarios');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}

		function insertUser( $folio, $firstname, $lastname, $username, $email, $password, $type , $dob, $sex, $nse ){
			$this->checkDBLogin();

			$formvars = array();
			$formvars['folio'] = $this->Sanitize($folio);
			$formvars['firstname'] = $this->Sanitize($firstname);
			$formvars['lastname'] = $this->Sanitize($lastname);
			$formvars['email'] = $this->Sanitize($email);
			$formvars['username'] = $this->Sanitize($username);
			$formvars['password'] = password_hash($this->Sanitize($password), PASSWORD_DEFAULT);
			$formvars['type'] = $this->Sanitize( $type );		
			$formvars['dob'] = $this->Sanitize($dob);
			$formvars['sex'] = $this->Sanitize($sex);
			$formvars['nse'] = $this->Sanitize($nse);

			$qry = "INSERT into _user (folio, firstname, lastname, email, _password, type, dob, sex, nse, date_created) values ('"
					.$formvars['folio'] . "','"
					.$formvars['firstname'] . "','"
					.$formvars['lastname'] . "','"
					.$formvars['email'] . "','"
					.$formvars['password']."','"
					.$formvars['type'] . "','"
					.$formvars['dob'] . "','"
					.$formvars['sex'] . "','"
					.$formvars['nse'] . "',NOW())";
			$result = $this->db->insertQuery($qry);
			if(!$result){
				$this->db->HandleDBError('No INSERT');
				$returnValue = false;
			}else{
				$iduser = $this->db->lastInsertID();
				$returnValue = $iduser;
			}

			$this->db->closeAll();
		    return $returnValue;
		}

		function insertDirection( $addressline1, $addressline2,  $betweenstreet1 , $betweenstreet2, $zone, $city, $zipcode, $state, $country, $notes, $phone, $name,$_default, $iduser ){
			$this->checkDBLogin();

			$returnValue = true;
			$formvars = array();
			$formvars['addressline1'] = $this->Sanitize($addressline1);
			$formvars['addressline2'] = $this->Sanitize($addressline2);
			$formvars['betweenstreet1'] = $this->Sanitize($betweenstreet1);
			$formvars['betweenstreet2'] = $this->Sanitize($betweenstreet2);
			$formvars['zone'] = $this->Sanitize($zone);
			$formvars['city'] = $this->Sanitize($city);		
			$formvars['zipcode'] = $this->Sanitize($zipcode);
			$formvars['state'] = $this->Sanitize($state);
			$formvars['country'] = $this->Sanitize($country);
			$formvars['notes'] = $this->Sanitize($notes);
			$formvars['phone'] = $this->Sanitize($phone);
			$formvars['name'] = $this->Sanitize($name);
			$formvars['_default'] = $this->Sanitize($_default);
			$formvars['iduser'] = $iduser;

			$qry = "INSERT into direction (addressline1, addressline2, betweenstreet1, betweenstreet2, zone, city, zipcode, state, country, notes, phone, name, _default, user_iduser) values ('"
					.$formvars['addressline1'] . "','"
					.$formvars['addressline2'] . "','"
					.$formvars['betweenstreet1'] . "','"
					.$formvars['betweenstreet2'] . "','"
					.$formvars['city']."','"
					.$formvars['zone']."','"
					.$formvars['zipcode'] . "','"
					.$formvars['state'] . "','"
					.$formvars['country'] . "','"
					.$formvars['notes'] . "','"
					.$formvars['phone'] . "','"
					.$formvars['name'] . "','"
					.$formvars['_default'] . "',"
					.$formvars['iduser'] . ")";
			if(!$this->db->insertQuery($qry)){
				$returnValue = false;
			}
		    $this->db->closeAll();
		    return $returnValue;
		}

		function insertuserrelation($moderator,$panelist){
			$this->checkDBLogin();

			$returnValue = true;
			$formvars = array();

			$qry = "INSERT into _usersrelation (moderator , panelist) values (".$moderator.", ".$panelist.")";
			if(!$this->db->insertQuery($qry)){
				$returnValue = false;
			}
		    $this->db->closeAll();
		    return $returnValue;
		}


		/*
			CAMPAINS
		*/
		function insertCampain( $name, $html , $status, $iduser, $idmedia ){
			$this->checkDBLogin();

			$formvars = array();
			$formvars['name'] = $this->Sanitize($name);
			$formvars['html'] = $this->Sanitize($html);
			$formvars['iduser'] = $this->Sanitize($iduser);
			$formvars['status'] = $this->Sanitize($status);
			
			$formvars['html'] = $this->Sanitize($html);
			if(!$idmedia){$formvars['idmedia'] = 1;}
			else{$formvars['idmedia'] = $this->Sanitize($email);}

			$qry = "INSERT into campain (name, html, status,user_iduser,media_idmedia,date_created) values ('"
					.$formvars['name'] . "','"
					.$formvars['html'] . "','"
					.$formvars['status'] . "','"
					.$formvars['iduser'] . "','"
					.$formvars['idmedia']."',NOW())";
			$result = $this->db->insertQuery($qry);
			if(!$result){
				$this->db->HandleDBError('No INSERT' . $qry);
				$returnValue = false;
			}else{
				$idcampain = $this->db->lastInsertID();
				$returnValue = $idcampain;
			}

			$this->db->closeAll();
		    return $returnValue;
		}

		function insertSurvey( $name, $html, $_order, $type, $repetition, $idmedia , $idcampain, $iduser ){
			$this->checkDBLogin();

			$formvars = array();
			$formvars['_order'] = $this->Sanitize($_order);
			$formvars['idcampain'] = $this->Sanitize($idcampain);
			$formvars['iduser'] = $this->Sanitize($iduser);

			if($name == ""){		$formvars['name'] = NULL;}
			else{					$formvars['name'] = $this->Sanitize($name);}
			if($html == ""){		$formvars['html'] = NULL;}
			else{					$formvars['html'] = $this->Sanitize($html);}

			if($type == ""){		$formvars['type'] = NULL;}
			else{					$formvars['type'] = $this->Sanitize($email);}
			if($repetition == ""){ 	$formvars['repetition'] = NULL;}
			else{					$formvars['repetition'] = $this->Sanitize($repetition);}
			if($idmedia == ""){		$formvars['media'] = 1;}
			else{					$formvars['media'] = $this->Sanitize($idmedia);}


			$qry = "INSERT into survey (name, html, _order, type, repetition, media_idmedia , campain_idcampain, user_iduser,date_created) values ('"
					.$formvars['name'] . "','"
					.$formvars['html'] . "','"
					.$formvars['_order'] . "','"
					.$formvars['type'] . "','"
					.$formvars['repetition']."','"
					.$formvars['media'] . "','"
					.$formvars['idcampain'] . "','"
					.$formvars['iduser'] . "', NOW())";
			$result = $this->db->insertQuery($qry);
			if(!$result){
				$this->db->HandleDBError('No INSERT');
				$returnValue = false;
			}else{
				$idsurvey = $this->db->lastInsertID();
				$returnValue = $iduser;
			}

			$this->db->closeAll();
		    return $returnValue;
		}

		function getCampains(){
			$returnValue = true;
			$this->checkDBLogin();

			$qry = 'SELECT name,status,date_created,idcampain from campain';
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin Campañas');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin Campañas');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}

		function getCampain( $idcampain ){
			$returnValue = true;
			$this->checkDBLogin();

			$qry = 'SELECT * from campain WHERE idcampain = ' . $idcampain;
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin Campañas');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin Campañas');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}

		function getSurveys(){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT * from survey ORDER BY idsurvey DESC';
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin CUESTIONARIOS');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin CUESTIONARIOS');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}

		function getSurveysFromCampain( $idcampain ){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT * from survey WHERE campain_idcampain = '.$idcampain;
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin CUESTIONARIOS');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin CUESTIONARIOS');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}

		function getSurveyFromCampain( $idcampain , $_order ){
			//return only one
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT * from survey WHERE campain_idcampain = '.$idcampain . ' AND _order='.$_order;
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin CUESTIONARIOS');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin CUESTIONARIOS');
					$returnValue = false;
				}else{
					$returnValue = $this->db->fetchAssoc($result);
				}
			}
			return $returnValue; 
		}

		function getTotalSurveysFromCampain( $idcampain ){
			//return only one
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT COUNT(idsurvey) as NUMBER from survey WHERE campain_idcampain = '.$idcampain;
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin CUESTIONARIOS');
				$returnValue = false;
			}else{
				$row = $this->db->fetchAssoc($result);
				$returnValue = $row['NUMBER'];
			}
			return $returnValue; 
		}

		function getSurveyQuestions($idsurvey){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT * from question WHERE survey_idsurvey = '.$idsurvey . ' ORDER BY _order';
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin preguntas');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin preguntas');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}


		function updateSurvey( $name, $description, $type, $idsurvey ){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'UPDATE survey SET name="'.$name.'", html="'.$description.'", type="'.$type.'", date_modified=NOW() WHERE idsurvey='.$idsurvey;
			$result = $this->db->updateQuery($qry);
			if(!$result){
				$this->db->HandleError('No update');
				$returnValue = false;
			}
			return $returnValue;
		}


		/*		QUESTIONS		*/
		function insertQuestion( $html, $_order, $type,  $idsurvey, $idmedia  ){
			$this->checkDBLogin();

			$formvars = array();
			$formvars['_order'] = $this->Sanitize($_order);
			$formvars['html'] = $this->Sanitize($html);
			$formvars['type'] = $this->Sanitize($type);
			$formvars['idsurvey'] = $this->Sanitize($idsurvey);

			if($idmedia == ""){		$formvars['media'] = 1;}
			else{					$formvars['media'] = $this->Sanitize($idmedia);}


			$qry = "INSERT into question (html, _order, type, survey_idsurvey,media_idmedia) values ('"
					.$formvars['html'] . "','"
					.$formvars['_order'] . "','"
					.$formvars['type'] . "','"
					.$formvars['idsurvey'] . "','"
					.$formvars['media'] . "')";
			$result = $this->db->insertQuery($qry);
			if(!$result){
				$this->db->HandleDBError('No INSERT');
				$returnValue = false;
			}else{
				$idquestion = $this->db->lastInsertID();
				$returnValue = $idquestion;
			}

			$this->db->closeAll();
		    return $returnValue;
		}


		function insertSample($name,$_order,$idsurvey){
			$returnValue = true;
			$this->checkDBLogin();

			$formvars = array();
			$formvars['_order'] = $this->Sanitize($_order);
			$formvars['name'] = $this->Sanitize($name);
			$formvars['idsurvey'] = $this->Sanitize($idsurvey);


			$qry = "INSERT into sample (name, _order, survey_idsurvey) values ('"
					.$formvars['name'] . "','"
					.$formvars['_order'] . "','"
					.$formvars['idsurvey'] . "')";
			$result = $this->db->insertQuery($qry);
			if(!$result){
				$this->db->HandleDBError('No INSERT' . $qry);
				$returnValue = false;
			}

			$this->db->closeAll();
		    return $returnValue;
		}

		function insertResponse($value,$label,$type){
			$returnValue = true;
			$this->checkDBLogin();

			$formvars = array();
			$formvars['value'] = $this->Sanitize($value);
			$formvars['label'] = $this->Sanitize($label);
			$formvars['type'] = $this->Sanitize($type);


			$qry = "INSERT into response (value, label, type) values ('"
					.$formvars['value'] . "','"
					.$formvars['label'] . "','"
					.$formvars['type'] . "')";
			$result = $this->db->insertQuery($qry);
			if(!$result){
				$this->db->HandleDBError('No INSERT' . $qry);
				$returnValue = false;
			}else{
				$idresponse = $this->db->lastInsertID();
				$returnValue = $idresponse;
			}
			$this->db->closeAll();
		    return $returnValue;
		}


		function insertquestionresponse($_order,$idquestion,$idresponse){
			$returnValue = true;
			$this->checkDBLogin();

			$formvars = array();
			$formvars['_order'] = $this->Sanitize($_order);
			$formvars['idquestion'] = $this->Sanitize($idquestion);
			$formvars['idresponse'] = $this->Sanitize($idresponse);
			$qry = "INSERT into question_response (_order, question_idquestion, response_idresponse) values ('"
					.$formvars['_order'] . "','"
					.$formvars['idquestion'] . "','"
					.$formvars['idresponse'] . "')";
			$result = $this->db->insertQuery($qry);
			if(!$result){
				$this->db->HandleDBError('No INSERT' . $qry);
				$returnValue = false;
			}

			$this->db->closeAll();
		    return $returnValue;
		}


		function getSurveySamples( $idsurvey ){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT * from sample WHERE survey_idsurvey = '.$idsurvey . ' ORDER BY _order';
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin muestras');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin muestras');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue; 
		}


		function getQuestionResponses( $idquestion ){
			$returnValue = true;
			$this->checkDBLogin();
			$qry = 'SELECT 	question_response._order, question_response.question_idquestion,question_response.response_idresponse,
							response.idresponse,response.label,response.value
					FROM 	question_response,response
					WHERE  	question_response.response_idresponse = response.idresponse
					AND 	question_response.question_idquestion = '.$idquestion . ' 
					ORDER BY question_response._order';
			$result = $this->db->selectQuery($qry);
			if(!$result){
				$this->db->HandleError('Sin muestras');
				$returnValue = false;
			}else{
				if(!$this->db->numRows($result)){
					$this->db->HandleError('Sin muestras');
					$returnValue = false;
				}else{
					$algo = array();
					while($row = $this->db->fetchAssoc($result)){
						array_push($algo, $row);
					}
					$returnValue = $algo;
				}
			}
			return $returnValue;
		}




		/*
			CONFIG FUNCTIONS
	    */
	    function createTablesAndRegisterAdmin($email,$password){
	    	$returnValue = true;
	    	if(!$this->db->createTables()){
	    		$returnValue = false;
	    	}else{
		    	$formvars = array();
				$formvars['email'] = $this->Sanitize($email);
				$formvars['password'] = password_hash($this->Sanitize($password), PASSWORD_DEFAULT);
				$formvars['type'] = $this->Sanitize('admin');		
				$qry = "INSERT into _user (email,type,_password,date_created) values ('"
						.$formvars['email'] . "','"
						.$formvars['type'] . "','"
						.$formvars['password']."',NOW())";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				
				
				//website_settings
				$qry = "INSERT into media (url) values 
											('img/150x150')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}

				$qry = "INSERT into settings (name,value,type) values 
											('website_url','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('website_title','SUB Sense','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('website_logo','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('description','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('keywords','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('favicon_url','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('tracking_code','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('from_email','".$formvars['email'] . "','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('contacto_email','".$formvars['email'] . "','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('mailchimp_id_list','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('mailchimp_key','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
				$qry = "INSERT into settings (name,value,type) values 
											('facebook_app_id','','website_settings')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}



				//social media
				$qry = "INSERT into settings (name,value,type) values 
											('instagram','','socialmedia_website')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}$qry = "INSERT into settings (name,value,type) values 
											('facebook','','socialmedia_website')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}$qry = "INSERT into settings (name,value,type) values 
											('twitter','','socialmedia_website')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}$qry = "INSERT into settings (name,value,type) values 
											('whatsapp','','socialmedia_website')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}$qry = "INSERT into settings (name,value,type) values 
											('social_media_logo','','socialmedia_website')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}$qry = "INSERT into settings (name,value,type) values 
											('logo_email','','socialmedia_website')";
				if(!$this->db->insertQuery($qry)){
					$returnValue = false;
				}
		    }
		    $this->db->closeAll();
		    return $returnValue;
		}
		

		/*
		UTIL FUNCTIONS
		*/
		function CheckLogin(){
			$returnValue = true;
	        if(!isset($_SESSION)){ session_start(); }
	        $sessionvar = $this->GetLoginSessionVar();
	        if(empty($_SESSION[$sessionvar])){
	            $this->db->HandleError("Session expiro!");
	            return false;
	        }
	        if($_SESSION['timeout'] < time()){
	            $this->db->HandleError("Session time expiro!" . $_SESSION['timeout'] . time());
	            $returnValue = false;
	        }
	        return $returnValue;
	    }
		function GetLoginSessionVar(){
	        $retvar = md5($this->rand_key);
	        $retvar = 'user_'.substr($retvar,0,10);
	        return $retvar;
	    }
	    function GetAbsoluteURLFolder(){return $_SERVER['SERVER_NAME'];}	
	    function RedirectToURL($url){header("Location: $url");exit;}

		/*	

			FUNCTIONS TO WORK WITH MYSQL


		*/
		function removeWhitespaces($str){
			$str = str_replace(' ', '', $str);
			return $str;
		}
	    function Sanitize($str,$remove_nl=true){
	        $str = $this->StripSlashes($str);
	        if($remove_nl){
	            $injections = array('/(\n+)/i','/(\r+)/i', '/(\t+)/i','/(%0A+)/i','/(%0D+)/i','/(%08+)/i','/(%09+)/i');
	            $str = preg_replace($injections,'',$str);
	        }
	        return $str; 
	    }
	    function SanitizeForSQL($str){
	        if( function_exists( "mysql_real_escape_string" ) ){$ret_str = mysql_real_escape_string( $str );}
	        else{$ret_str = addslashes( $str );}
	        return $ret_str;
	    } 
	    function StripSlashes($str){
	        if(get_magic_quotes_gpc()){ $str = stripslashes($str);}
	        return $str;
	    }
	}
?>