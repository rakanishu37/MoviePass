<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use interfaces\CRUD as CRUD;
    use dao\pdo\PDOCinema as PDOCinema;
    use models\Theater as Theater;
    use models\Cinema as Cinema;
    use dao\pdo\Connection as Connection;
    
    class PDOTheater implements CRUD
    {   
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'theatres';
        }

        public function add($newTheater){
            try
            {
                $query = "INSERT INTO ".$this->tableName."
                (capacity, theater_name, id_cinema, seat_price) 
                VALUES 
                (:capacity, :theater_name, :id_theater, :seat_price);";
                $parameters['capacity'] = $newTheater->getCapacity();
                $parameters['theater_name'] = $newTheater->getName();
                $parameters['id_cinema'] = $newTheater->getCinema()->getId();
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

        #getbyidcinema


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
                $daoCinema = new PDOCinema();
                $cinema = $daoCinema->getByID($p['id_cinema']);
                return new Theater($p['id_theater'],$p['capacity'],$p['theater_name'],$cinema,$p['seat_price']);
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