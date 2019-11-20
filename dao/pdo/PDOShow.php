<?php

    namespace dao\pdo;
    use models\Show as Show;
    use models\Genre as Genre;
    use models\Movie as Movie;
    use \Exception as Exception;
    use dao\pdo\Connection as Connection;
    use dao\pdo\PDOMovie as PDOMovie;
    use dao\pdo\PDOCinema as PDOCinema;
    use interfaces\CRUD as CRUD;

    class PDOShow implements CRUD
    {
        private $connection;
        private $tableName;
        private $cinemaList;

        public function __construct() {
            $this->tableName = 'shows';
        }
        public function add($newShow){
            $query = "INSERT INTO ".$this->tableName." (projection_time, id_movie, id_cinema,active) VALUES(:projection_time, :id_movie, :id_cinema,:active);";
            $parameters['projection_time'] = $newShow->getProjectionTime();
            $parameters['id_movie'] = $newShow->getMovie()->getId();
            $parameters['id_cinema'] = $newShow->getCinema()->getId();
            $parameters['active'] = 1;
            try{
                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $e){
                throw $e;
            }
        }

                /**
         * Updates the cinema attribute "active" to 0
         */
        public function deleteById($id_show){
            try{
                $query = "Update ".$this->tableName. " SET active = :active WHERE id_show = :id_show;";
            
                $parameters['id_show'] = $id_show;
                $parameters['active'] = 0;

                $this->connection = Connection::GetInstance();
                return $this->connection ->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function getByID($showId){
            $query = 'Select * from '. $this->tableName. ' WHERE id_show = :id_show;';
            
            $parameters['id_show'] = $showId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $show = $this->parseToObject($resultSet);

            return $show;
        }

        public function getAllByDate($date){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE projection_time like '%$date%';";
                //"SELECT * FROM ".$this->tableName." WHERE projection_time like '% 2019-11-08 %';";
               // $a =":projection_time";
                //$query = 'select * from '.$this->tableName.' where projection_time like '.'%'.':projection_time'.'%';
                //$parameters['projection_time'] = $date;


                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
              //  $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAllByGenre($genre){
            try
            {
                
                $query = "SELECT shows.id_show as id_show , shows.projection_time as projection_time, shows.id_movie as id_movie, shows.id_cinema as id_cinema
                from shows inner join movies_by_genres on shows.id_movie = movies_by_genres.id_movie
                inner join genres on genres.id_genre = movies_by_genres.id_genre
                where genres.id_genre = :id_genre;";
                
                $parameters['id_genre'] = $genre;

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

        protected function parseToObject($value) {
			$value = is_array($value) ? $value : [];
			$resp = array_map(function($p){
                $daoMovie = new PDOMovie();
                $daoCinema = new PDOCinema();
                
                $movie = $daoMovie->getById($p['id_movie']);
                $cinema = $daoCinema->getByID($p['id_cinema']);
				return new Show($p['projection_time'],$movie,$cinema,$p['active'],$p['id_show']);
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