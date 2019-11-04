<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use dao\IDAOCinema as IDAOCinema;
    use models\Cinema as Cinema;    
    use dao\pdo\Connection as Connection;
    
    class PDOCinema implements IDAOCinema
    {   private $connection;
        private $tableName;
        private $cinemaList;

        public function __construct() {
            $this->tableName = 'cinemas';
        }

        public function add(Cinema $newCinema){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name_cinema, address_cinema, capacity, ticket_price, active) 
                VALUES (:name_cinema, :address_cinema, :capacity, :ticket_price, :active);";
                $parameters['name_cinema'] = $newCinema->getName();
                $parameters['address_cinema'] = $newCinema->getAddress();
                $parameters['capacity'] = $newCinema->getCapacity();
                $parameters['ticket_price'] = $newCinema->getTicketPrice();
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
                $query = "UPDATE ".$this->tableName. " SET name_cinema = :name_cinema, address_cinema = :address_cinema, capacity = :capacity,
                ticket_price = :ticket_price, active = :active WHERE id_cinema = :id_cinema;";
                
                $parameters['id_cinema'] = $modifiedCinema->getId();

                $parameters['name_cinema'] = $modifiedCinema->getName();
                $parameters['address_cinema'] = $modifiedCinema->getAddress();
                $parameters['capacity'] = $modifiedCinema->getCapacity();
                $parameters['ticket_price'] = $modifiedCinema->getTicketPrice();
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
                $parameters['active'] = 1;

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

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $cinema = $this->parseToObject($resultSet);
            $cinema->setId($cinemaId);

            return $cinema;
        }

		protected function parseToObject($value) {
			$value = is_array($value) ? $value : [];
			$resp = array_map(function($p){
				return new Cinema($p['name_cinema'],$p['address_cinema'],$p['capacity'],$p['ticket_price'],$p['active'],$p['id_cinema']);
			}, $value);
               return count($resp) > 1 ? $resp : $resp['0'];
		}
    }
    
?>