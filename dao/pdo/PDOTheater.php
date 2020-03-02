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
                $query = "INSERT INTO ".$this->tableName." (capacity,theater_name,id_cinema,seat_price) VALUES (:capacity, :theater_name, :id_cinema, :seat_price);";
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
            try {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
    
                $theater = $this->parseToObject($resultSet);
    
                return $theater;
            } catch (Exception $e) {
                throw $e;
            }
           
        }

		public function getByIdCinema($cinemaId){
			$query = 'Select * from '. $this->tableName. ' WHERE id_cinema = :id_cinema;';
            
            $parameters['id_cinema'] = $cinemaId;
            try {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
    
                $theater = $this->parseToObject($resultSet);
    
                return $theater;
            } catch (Exception $e) {
                throw $e;
            }		
        }
        
        public function getByData($data){
            
            $query = 'Select * from '. $this->tableName. ' where id_cinema = :id_cinema and theater_name = :theater_name';
            
            $parameters['id_cinema'] = $data['idCinema'];
            $parameters['theater_name'] = $data['theaterName'];
            
            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $theater = $this->parseToObject($resultSet);

                return $theater;
            }
            catch(Exception $e){
                throw $e;
            }
        }

		protected function parseToObject($value) {
            $value = is_array($value) ? $value : [];
            try {
                $resp = array_map(function($p){
                    $daoCinema = new PDOCinema();
                    $c = $daoCinema->getByID($p['id_cinema']);
                    return new Theater($p['theater_name'],$p['capacity'],$p['seat_price'],$c,$p['id_theater']);
                }, $value);
                
                if(empty($resp)){
                    return $resp;
                }
                else {
					
                    return count($resp) > 1 ? $resp : $resp['0'];
                }
            } catch (Exception $e) {
                throw $e;
            }

        }

        public function delete($id)
        {            
            try {
                $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";
                $parameters["id"] =  $id;
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }     
        
        public function update($theater){
            try{
                $query = "UPDATE ".$this->tableName. " SET id = :id, capacity = :capacity, name = :name, cinema = :cinema, seatPrice = :seatPrice;";
                
                $parameters['id'] = $theater->getId();
                $parameters['capacity'] = $theater->getCapacity();
                $parameters['name'] = $theater->getName();
                $parameters['cinema'] = $theater->getCinema()->getName();
                $parameters['seatPrice'] = $theater->getSeatPrice();
               
                $this->connection = Connection::GetInstance(); 
                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }    
?>