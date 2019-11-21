<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use dao\IDAOCinema as IDAOCinema;
    use models\Cinema as Cinema;    
    use dao\pdo\Connection as Connection;
    
    class PDOCinema implements IDAOCinema
    {   
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'cinemas';
        }

        public function add(Cinema $newCinema){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name_cinema, address_cinema, active) 
                VALUES (:name_cinema, :address_cinema, :active);";
                $parameters['name_cinema'] = $newCinema->getName();
                $parameters['address_cinema'] = $newCinema->getAddress();
                $parameters['active'] = $newCinema->getStatus();

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function update(Cinema $modifiedCinema){
            try{
                $query = "UPDATE ".$this->tableName. " SET name_cinema = :name_cinema, address_cinema = :address_cinema, active = :active 
                WHERE id_cinema = :id_cinema;";
                
                $parameters['id_cinema'] = $modifiedCinema->getId();

                $parameters['name_cinema'] = $modifiedCinema->getName();
                $parameters['address_cinema'] = $modifiedCinema->getAddress();
                $parameters['active'] = $modifiedCinema->getStatus();

                $this->connection = Connection::GetInstance(); 
                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        /**
         * Updates the cinema attribute "active" to 0
         */
        public function deleteById($cinemaId){
            try{
                $query = "Update ".$this->tableName. " SET active = :active WHERE id_cinema = :id_cinema;";
            
                $parameters['id_cinema'] = $cinemaId;
                $parameters['active'] = 0;

                $this->connection = Connection::GetInstance();
                return $this->connection ->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex){
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

        public function getAllActiveCinemas(){
            try
            {
                $query = "SELECT * FROM ".$this->tableName. " WHERE active = :active";
                $parameters['active'] = 1;

                $this->connection = Connection::GetInstance();
                
                $resultSet = $this->connection->Execute($query,$parameters);
                $activeCinemas = $this->parseToObject($resultSet);

                return $activeCinemas;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function getByID($cinemaId){
            $query = 'Select * from '. $this->tableName. ' WHERE id_cinema = :id_cinema;';
            
            $parameters['id_cinema'] = $cinemaId;

            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
            $cinema = $this->parseToObject($resultSet);

            return $cinema;
        }
/*
        public function searchForDuplicate($name,$address){
            try {
                $query = 'Select exists(Select * from cinemas where name_cinema = :nombre  and address_cinema = :dir );';
                $parameters['nombre'] = $name;
                $parameters['dir'] = $address;
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                return $resultSet;
            } catch (Exception $th) {
                throw $th;
            }
        }*/

		protected function parseToObject($value) {
			$value = is_array($value) ? $value : [];
			$resp = array_map(function($p){
				return new Cinema($p['name_cinema'],$p['address_cinema'],$p['active'],$p['id_cinema']);
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