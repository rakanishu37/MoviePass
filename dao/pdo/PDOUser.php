<?php
    namespace dao\pdo;
    use \Exception as Exception;
    use interfaces\CRUD as CRUD;
    use models\User as User;
    class PDOUser implements CRUD
    {
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'users';
        }

        public function add($newUser){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email,password_user,administrador)
                values(:email, :password, :status);";
                $parameters['email'] = $newUser->getEmail();
                $parameters['password'] = $newUser->getPassword();
                $parameters['status'] = $newUser->getStatus();

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function getAll(){
            try
            {
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByEmail($email)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." where email = :email";
                $parameters['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        protected function parseToObject($value) {
			$value = is_array($value) ? $value : [];
			$resp = array_map(function($p){
				return new User($p['email'],$p['password_user'],$p['administrador'],$p['id_user']);
            }, $value);
            
            if(empty($resp)){
                return $resp;
            }
            else {
                return count($resp) > 1 ? $resp : $resp['0'];
            }
		}
    }
    
?>