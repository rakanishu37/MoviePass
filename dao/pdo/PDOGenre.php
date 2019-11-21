<?php
    namespace dao\pdo;
    use \Exception as Exception;
    use models\Genre as Genre;
    use interfaces\CRUD as CRUD;  
    use dao\pdo\Connection as Connection;
    use controllers\ApiController as ApiController;
    
    class PDOGenre implements CRUD
    {
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'genres';
           
            if(empty($this->getAll())){
                $this->getGenresFromApi();
            }
        }

        public function add($genre){
            $query = "INSERT INTO ".$this->tableName." (id_genre,name_genre) VALUES (:id_genre,:name_genre);";
            $parameters['name_genre'] = $genre->getName();
            $parameters['id_genre'] = $genre->getApiKey();
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        }

        public function getById($genreId)
        {
            try
            {
                $query = 'SELECT * FROM '.$this->tableName.' WHERE id_genre = :id_genre';
                $parameters['id_genre'] = $genreId;
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
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

        private function getGenresFromApi(){
            try {
                $genres = $this->getGenreListFromAPI();
                    foreach ($genres as $genre) {
                        $this->add($genre);
                    }
                } catch (Exception $e) {
                    throw $e;
                }
        }
        private function getGenreListFromAPI(){
            $genreList = array();

            $jsonContent =  ApiController::getGenreJSON();
            
            $arrayToDecode = array();     
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
            
            foreach ($arrayToDecode['genres'] as $value) {
                $genre= new Genre($value['name'],$value['id']);
                
                array_push($genreList, $genre);
            }
            return $genreList;
        }

        protected function parseToObject($value) {
            $value = is_array($value) ? $value : [];
            
			$resp = array_map(function($p){
				return new Genre($p['name_genre'],$p['id_genre']);
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