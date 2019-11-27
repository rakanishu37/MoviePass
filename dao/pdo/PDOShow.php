<?php

    namespace dao\pdo;
    use models\Show as Show;
    use models\Genre as Genre;
    use models\Movie as Movie;
    use \Exception as Exception;
    use dao\pdo\Connection as Connection;
    use dao\pdo\PDOMovie as PDOMovie;
    use dao\pdo\PDOTheater as PDOTheater;
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
            $query = "INSERT INTO ".$this->tableName." (projection_time, id_movie, id_theater,active) VALUES(:projection_time, :id_movie, :id_theater,:active);";
            $parameters['projection_time'] = $newShow->getProjectionTime();
            $parameters['id_movie'] = $newShow->getMovie()->getId();
            $parameters['id_theater'] = $newShow->getTheater()->getId();
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
            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
    
                $show = $this->parseToObject($resultSet);
    
                return $show;
            }
            catch(Exception $e){
                throw $e;
            }
        }
        public function getByIdMovie($idMovie){
            $query = 'Select * from '. $this->tableName. ' WHERE idMovie = :idMovie;';
            
            $parameters['id_show'] = $idMovie;
            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
    
                $showList = $this->parseToObject($resultSet);
    
                return $showList;
            }
            catch(Exception $e){
                throw $e;
            }
        }
        
        public function getAllByDate($date){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE projection_time like :projectionTime order by projection_time asc;";
                $parameters['projectionTime'] = $date.'%';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByIdTheaterDate($idTheater,$date){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id_theater = :id_theater and projection_time like :projectionTime order by projection_time asc;";
                $parameters['projectionTime'] = $date.'%';
                $parameters['id_theater'] = $idTheater;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
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
                
                $query = "SELECT shows.id_show as id_show , shows.projection_time as projection_time, shows.id_movie as id_movie, shows.id_theater as id_theater, shows.active as active
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
            try{
                $resp = array_map(function($p){
                    $daoMovie = new PDOMovie();
                    $daoTheater = new PDOTheater();

                    $movie = $daoMovie->getById($p['id_movie']);
                    $theater = $daoTheater->getByID($p['id_theater']);

                    return new Show($p['projection_time'],$movie,$theater,$p['active'],$p['id_show']);
                }, $value);
                
                if(empty($resp)){
                    return $resp;
                }
                else {
                    return count($resp) > 1 ? $resp : $resp['0'];
                }
            }
            catch(Exception $e){
                throw $e;
            }
        }

        public function getShowsWithTickets(){
            try{
                $query="SELECT 
                            shows.id_show as id_show,
                            shows.projection_time as projection_time,
                            shows.id_movie as id_movie,
                            shows.id_theater as id_theater,
                            shows.active as active,
                            ifnull(count(tickets.id_show),0) as bought_tickets
                        from
                            shows left outer join tickets on shows.id_show = tickets.id_show
                        group by
                            shows.id_show";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            
                return $this->parseToObjectSpecial($resultSet);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        protected function parseToObjectSpecial($value) {
            $array = array();
            $value = is_array($value) ? $value : [];
            try{
                $resp = array_map(function($p){
                    $daoMovie = new PDOMovie();
                    $daoTheater = new PDOTheater();

                    $movie = $daoMovie->getById($p['id_movie']);
                    $theater = $daoTheater->getByID($p['id_theater']);
                    
                    new Show($p['projection_time'],$movie,$theater,$p['active'],$p['id_show']);
                    $boughttickets=($p['bought_tickets']);
                    
                    $array['show']= new Show($p['projection_time'],$movie,$theater,$p['active'],$p['id_show']);
                    $array['boughttickets'] = $boughttickets;

                    return $array;
                }, $value);
                
                if(empty($resp)){
                    return $resp;
                }
                else {
                    return count($resp) > 1 ? $resp : $resp['0'];
                }
            }
            catch(Exception $e){
                throw $e;
            }
        }
    }
?>