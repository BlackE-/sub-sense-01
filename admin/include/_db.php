<?php
    class DB{
        private $db_host;
        private $username;
        private $pwd;
        private $database;
        private $connection;
        public $error_message = '';


        
        function __construct(){
            $array_ini = parse_ini_file('setup.ini', true);
            $this->InitDB(
                $array_ini['host'],
                $array_ini['username'],
                $array_ini['pwd'],
                $array_ini['database']);
        }

        //-----Initialization -------
        function InitDB($host,$uname,$pwd,$database){
            $this->db_host  = $host;
            $this->username = $uname;
            $this->pwd  = $pwd;
            $this->database  = $database;

        }

        function CloseAll(){
            mysqli_close($this->connection);
        }
        

        //-------   FUNCIONES GLOBALES   ----------------------
        //  UTIL FUNCTIONS
        function DBLogin(){
            $returnValue = true;
            try{
                $this->connection = mysqli_connect($this->db_host,$this->username,$this->pwd,$this->database);
                if(!$this->connection){ 
                    $this->HandleError("Database Login failed!");
                    $returnValue = false;
                }else{
                    if(!mysqli_query($this->connection,"SET NAMES 'UTF8'")){
                        $this->HandleDBError('Error setting utf8 encoding');
                        $returnValue = false;
                    }
                }
            }
            catch(Exception $e){
                 $this->HandleDBError($e->getMessage());
                 $returnValue = false;
            }
            return $returnValue;
        }

        function selectQuery($select){
            $result = mysqli_query($this->connection,$select);
            if(!$result){
                return false;
            }
            return $result;
        }
        function insertQuery($insert){
            $returnValue = true;
            $this->HandleError('Insert Correct');
            $result = mysqli_query($this->connection,$insert);
            if(!$result){
                if (mysqli_errno($this->connection) == 1062) {
                    $this->HandleError('Dato duplicado');
                }
                else{
                    $this->HandleDBError('No insert'.$insert);
                }
                $returnValue = false;
            }
            return $returnValue;
        }
        function updateQuery($update){
            $result = mysqli_query($this->connection,$update);
            if(!$result){
                return false;
            }
            return true;
        }
        function deleteQuery($delete){
            $result = mysqli_query($this->connection,$delete);
            if(!$result){
                return false;
            }
            return true;
        }
        function fetchAssoc($result){
            $return = mysqli_fetch_array($result,MYSQLI_ASSOC);return $return;
        }
        function fetchArray($result){
            $return = mysqli_fetch_array($result);return $return;
        }
        
        function numRows($result){
            if(mysqli_num_rows($result)<=0){return false;}
            else{return true;}
        }
        
        function lastInsertID(){
            return mysqli_insert_id($this->connection); 
        }
        function HandleError($err)   {      $this->error_message = $err."\r\n";}
        function HandleDBError($err) {      $this->HandleError($err."\r\n mysqlerror:".mysqli_error($this->connection));}
        function GetErrorMessage(){
            if(empty($this->error_message)){return '';}
            $errormsg = nl2br(htmlentities($this->error_message));
            return $errormsg;
        }

        function createTables(){
            $returnValue = true;
            try{
                $create = "CREATE TABLE _user(
                            iduser INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            folio MEDIUMINT NOT NULL,
                            firstname VARCHAR(45) NULL,
                            lastname VARCHAR(45) NULL,
                            username VARCHAR(45) NULL UNIQUE,
                            email VARCHAR(45) NULL,
                            _password VARCHAR(255) NOT NULL,
                            type TINYINT(1) NOT NULL COMMENT '1-ADMIN,2-CLIENT,3-MODERADOR,4-Entrevistador,5-PANELISTA',
                            dob DATE,
                            sex VARCHAR(1) COMMENT 'F/M',
                            nse VARCHAR(5),
                            date_created DATETIME DEFAULT CURRENT_TIMESTAMP
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE _usersrelation(
                                iduserrelation INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                moderator INT UNSIGNED NOT NULL,
                                panelist INT UNSIGNED NOT NULL,
                                campain INT UNSIGNED NOT NULL,

                                INDEX (moderator),
                                INDEX (panelist),
                                
                                FOREIGN KEY (moderator)
                                    REFERENCES _user(iduser)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY (panelist)
                                    REFERENCES _user(iduser)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,
                                
                                FOREIGN KEY (campain)
                                    REFERENCES campain(idcampain)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }
                
                $create = "CREATE TABLE media(
                            idmedia INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                url VARCHAR (150) NOT NULL
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE settings(
                                id_settings INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                name VARCHAR(45),
                                value TEXT,
                                type VARCHAR(50)
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables settings');
                }

                $create = "CREATE TABLE campain(
                                idcampain INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                name VARCHAR (45),
                                html TEXT,
                                status TINYINT(1),
                                date_created DATETIME NULL,
                                date_end DATETIME NULL,
                                _user_iduser INT UNSIGNED NOT NULL,
                                media_idmedia INT UNSIGNED NOT NULL,

                                INDEX (_user_iduser),
                                INDEX (media_idmedia),
                                
                                FOREIGN KEY (_user_iduser)
                                    REFERENCES _user(iduser)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY (media_idmedia)
                                    REFERENCES media(idmedia) 
                                    ON DELETE NO ACTION ON UPDATE CASCADE
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }
                
                

                $create = "CREATE TABLE survey(
                                idsurvey INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                name VARCHAR(140) NOT NULL,
                                html TEXT,
                                date_created DATE NOT NULL,
                                date_modified DATE,
                                _order TINYINT,
                                type VARCHAR(15),
                                repetition TINYINT NULL,
                                media_idmedia INT UNSIGNED NOT NULL,
                                campain_idcampain INT UNSIGNED NOT NULL,
                                _user_iduser INT UNSIGNED NOT NULL,
                                
                                INDEX (media_idmedia),
                                INDEX (campain_idcampain),
                                INDEX (_user_iduser),
                                
                                FOREIGN KEY (media_idmedia)
                                    REFERENCES media(idmedia)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY (campain_idcampain)
                                    REFERENCES campain(idcampain)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY (_user_iduser)
                                    REFERENCES _user(iduser)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                    exit();
                }

                $create = "CREATE TABLE question(
                            idquestion INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            html TEXT,
                            _order TINYINT,
                            type VARCHAR(45) NOT NULL,
                            survey_idsurvey INT UNSIGNED,
                            media_idmedia INT UNSIGNED,
                            
                            INDEX(survey_idsurvey),
                            INDEX(media_idmedia),
                            
                            FOREIGN KEY (survey_idsurvey)
                                REFERENCES survey(idsurvey)
                                ON DELETE NO ACTION ON UPDATE CASCADE,
                            FOREIGN KEY (media_idmedia)
                                REFERENCES media(idmedia)
                                ON DELETE NO ACTION ON UPDATE CASCADE   
                        )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE sample(
                            idsample INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(140),
                            codigo SMALLINT,
                            _order TINYINT,
                            survey_idsurvey INT UNSIGNED,
                            campain_idcampain INT UNSIGNED,
                            
                            INDEX(survey_idsurvey),
                            
                            FOREIGN KEY (survey_idsurvey)
                                REFERENCES survey(idsurvey)
                                ON DELETE NO ACTION ON UPDATE CASCADE,

                            FOREIGN KEY (campain_idcampain)
                                REFERENCES campain(idcampain)
                                ON DELETE NO ACTION ON UPDATE CASCADE
                        )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE _usersamplerelation(
                    idusersample INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    _user_iduser INT UNSIGNED NOT NULL,
                    sample_idsample INT UNSIGNED NOT NULL,
                    samplecode SMALLINT,
                    _order SMALLINT,

                    INDEX (_user_iduser),
                    INDEX (sample_idsample),
                    
                    FOREIGN KEY (_user_iduser)
                        REFERENCES _user(iduser)
                        ON DELETE NO ACTION ON UPDATE CASCADE,

                    FOREIGN KEY (sample_idsample)
                        REFERENCES sample(idsample)
                        ON DELETE NO ACTION ON UPDATE CASCADE
                )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE response(
                                idresponse INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                value VARCHAR(140) NOT NULL,
                                label VARCHAR(100),
                                type VARCHAR(10) NOT NULL
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE question_response(
                                idquestion_response INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                _order TINYINT NULL,

                                question_idquestion INT UNSIGNED,
                                response_idresponse INT UNSIGNED,

                                INDEX (question_idquestion),
                                INDEX (response_idresponse),
                                
                                FOREIGN KEY(question_idquestion)
                                    REFERENCES question(idquestion)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,
                                FOREIGN KEY(response_idresponse)
                                    REFERENCES response(idresponse)
                                    ON DELETE NO ACTION ON UPDATE CASCADE
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE answer(
                                idanswer INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                value TEXT NULL,
                                question_response_idquestion_response INT UNSIGNED,
                                question_idquestion INT UNSIGNED,
                                sample_idsample INT UNSIGNED,
                                _user_iduser INT UNSIGNED,

                                INDEX (question_response_idquestion_response),
                                INDEX (question_idquestion),
                                INDEX (sample_idsample),
                                INDEX (_user_iduser),
                                
                                FOREIGN KEY(question_response_idquestion_response)
                                    REFERENCES question_response(idquestion_response)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY(question_idquestion)
                                    REFERENCES question(idquestion)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY(sample_idsample)
                                    REFERENCES sample(idsample)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY(_user_iduser)
                                    REFERENCES _user(iduser)
                                    ON DELETE NO ACTION ON UPDATE CASCADE

                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }



                $create = "CREATE TABLE characteristic(
                                idcharacteristic INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                name VARCHAR(45)
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE characteristic_value(
                                idcharacteristic_value INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                value TEXT NULL,
                                type VARCHAR(45) NULL,
                                characteristic_idcharacteristic INT UNSIGNED,
                                
                                INDEX(characteristic_idcharacteristic),
                                
                                FOREIGN KEY(characteristic_idcharacteristic)
                                    REFERENCES characteristic(idcharacteristic)
                                    ON DELETE NO ACTION ON UPDATE CASCADE 
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                $create = "CREATE TABLE user_characteristics(
                                iduser_characteristics INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                value TEXT NULL,
                                characteristic_idcharacteristic INT UNSIGNED,
                                characteristic_value_idcharacteristic_value INT UNSIGNED,
                                user_iduser INT UNSIGNED,
                                
                                INDEX(characteristic_idcharacteristic),
                                INDEX(characteristic_value_idcharacteristic_value),
                                INDEX(user_iduser),
                                
                                FOREIGN KEY(characteristic_idcharacteristic)
                                    REFERENCES characteristic(idcharacteristic)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY(characteristic_value_idcharacteristic_value)
                                    REFERENCES characteristic_value(idcharacteristic_value)
                                    ON DELETE NO ACTION ON UPDATE CASCADE,

                                FOREIGN KEY(user_iduser)
                                    REFERENCES _user(iduser)
                                    ON DELETE NO ACTION ON UPDATE CASCADE 
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }


                $create = "CREATE TABLE direction(
                                iddirection INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                addressline1 VARCHAR(100),
                                addressline2 VARCHAR(100),
                                betweenstreet1 VARCHAR(100),
                                betweenstreet2 VARCHAR(100),
                                zone VARCHAR(100),
                                city VARCHAR(100),
                                zipcode VARCHAR(6),
                                state VARCHAR(35),
                                country VARCHAR(3) DEFAULT 'MEX' COMMENT 'ISO3 EJ:mxn',
                                notes text,
                                phone VARCHAR(15),
                                name VARCHAR(45),
                                _default TINYINT NULL,
                                user_iduser INT UNSIGNED,
                                
                                INDEX(user_iduser),
                                
                                FOREIGN KEY(user_iduser)
                                    REFERENCES _user(iduser)
                                    ON DELETE NO ACTION ON UPDATE CASCADE 
                            )";
                $result = mysqli_query($this->connection,$create);
                if(!$result){
                    $returnValue = false;
                    $this->HandleDBError('Error creating tables');
                }

                return $returnValue;
            }
            catch(Exception $e){
                 $this->HandleDBError("Catch:" . $e->getMessage());
                 $returnValue = false;
            }
        }
    }
?>