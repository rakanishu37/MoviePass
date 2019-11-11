<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use dao\IDAOTheater as IDAOTheater;
    use models\Theater as Theater;
    use models\Cinema as Cinema;
    use dao\pdo\Connection as Connection;
    
    class PDOTheater implements IDAOTheater
    {   
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'theatres';
        }
        id_theater int auto_increment,
        capacity int,
        theater_name varchar(20),
        id_theater int,
        seat_price float(2),
        public function add(Theater $newTheater){
            try
            {
                $query = "INSERT INTO ".$this->tableName."
                (capacity, theater_name, id_theater, seat_price) 
                VALUES 
                (:capacity, :theater_name, :id_theater, :seat_price);";
                $parameters['capacity'] = $newTheater->getCapacity();
                $parameters['theater_name'] = $newTheater->getName();
                $parameters['id_theater'] = $newTheater->getCinema();//ESTA MAL PLATEAR LUEGO
                $parameters['seat_price'] = $newTheater->getSeatPrice();

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

        
        public function getByID($theaterId){
            $query = 'Select * from '. $this->tableName. ' WHERE id_theater = :id_theater;';
            
            $parameters['id_theater'] = $theaterId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $theater = $this->parseToObject($resultSet);

            return $theater;
        }

		protected function parseToObject($value) {
			$value = is_array($value) ? $value : [];
			$resp = array_map(function($p){
				return new Cinema($p['name_cinema'],$p['address_cinema'],$p['capacity'],$p['ticket_price'],$p['active'],$p['id_theater']);
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