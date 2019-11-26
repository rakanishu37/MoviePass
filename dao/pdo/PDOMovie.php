<?php
    namespace dao\pdo;

    use interfaces\CRUD as CRUD;
    use \Exception as Exception;
    use dao\pdo\Connection as Connection;
    use models\Movie as Movie;
    use models\Genre as Genre;
    use controllers\ApiController as ApiController;
    use dao\pdo\PDOGenre as PDOGenre;

    class PDOMovie implements CRUD
    {
        private $movieList;
        private $connection;
        private $tableNameMoviesGenres;
        private $tableNameMovies;

        public function __construct() {
            $this->tableNameMoviesGenres = 'movies_by_genres';
            $this->tableNameGenres = 'genres';
            $this->tableNameMovies = 'movies';
        }
        /*  pregunto por cada id de las ultias peliculas
                sino la tiene la agrega
            
            Comentario: originalmente la bdd va a estar vacia asi que puedo rellenar con esto    
        */

        public function updateLatestMovies()
        {
            $counter = 0;
            $latestMoviesIDList = ApiController::getLatestMoviesID();

            $movieToBeAdded= array();
            try {
                foreach($latestMoviesIDList as $movieId){
                    if(empty($this->getById($movieId))){
                        $this->add(ApiController::createMovieFromJSON($movieId));
                        $counter++;
                    }
                }
                return $counter;
            } catch (Exception $e) {
                throw $e;
            }
        }

        public function getLatestMovies()
        {
            try{
                $latestMoviesIDList = ApiController::getLatestMoviesID();
                $query= "SELECT * FROM ".$this->tableNameMovies."
                where id_movie in (:movie1,:movie2,:movie3,:movie4,:movie5,:movie6,:movie7,:movie8,:movie9,:movie10,:movie11,:movie12,:movie13,:movie14,:movie15,:movie16,:movie17,:movie18,:movie19,:movie20);";       
                $parameters['movie1'] = $latestMoviesIDList[0]; 
                $parameters['movie2'] = $latestMoviesIDList[1]; 
                $parameters['movie3'] = $latestMoviesIDList[2]; 
                $parameters['movie4'] = $latestMoviesIDList[3]; 
                $parameters['movie5'] = $latestMoviesIDList[4]; 
                $parameters['movie6'] = $latestMoviesIDList[5]; 
                $parameters['movie7'] = $latestMoviesIDList[6]; 
                $parameters['movie8'] = $latestMoviesIDList[7]; 
                $parameters['movie9'] = $latestMoviesIDList[8]; 
                $parameters['movie10'] = $latestMoviesIDList[9]; 
                $parameters['movie11'] = $latestMoviesIDList[10]; 
                $parameters['movie12'] = $latestMoviesIDList[11]; 
                $parameters['movie13'] = $latestMoviesIDList[12]; 
                $parameters['movie14'] = $latestMoviesIDList[13]; 
                $parameters['movie15'] = $latestMoviesIDList[14]; 
                $parameters['movie16'] = $latestMoviesIDList[15]; 
                $parameters['movie17'] = $latestMoviesIDList[16]; 
                $parameters['movie18'] = $latestMoviesIDList[17]; 
                $parameters['movie19'] = $latestMoviesIDList[18]; 
                $parameters['movie20'] = $latestMoviesIDList[19]; 
                                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function add($newMovie)
        {
            try {
                $query = "INSERT INTO " . $this->tableNameMovies .
                 " (id_movie, name_movie, runtime, language_movie, image_url)
                    VALUES (:id_movie, :name_movie, :runtime, :language_movie, :image_url);";
                $parameters['id_movie'] = $newMovie->getId();
                $parameters['name_movie'] = $newMovie->getName();
                $parameters['runtime'] = $newMovie->getRuntime();
                $parameters['language_movie'] = $newMovie->getLanguage();
                $parameters['image_url'] = $newMovie->getImageURL();

                $this->connection = Connection::GetInstance();

                $counter = $this->connection->ExecuteNonQuery($query, $parameters);
                $parameters = array();
                $genreList = $newMovie->getGenre();
                /**
                 * @var Genre $genre
                 */
                foreach ($genreList as $genre) {
                    $query =  "INSERT INTO " . $this->tableNameMoviesGenres . " (id_movie, id_genre) VALUES (:id_movie, :id_genre);";
                    $parameters['id_movie'] = $newMovie->getId();
                    $parameters['id_genre'] = $genre->getApiKey();

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
                return $counter;
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function getAll()
        {  
            try{
                $query= "SELECT * FROM ".$this->tableNameMovies.";";
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getById($id){
            try{
                $query= "SELECT * FROM ".$this->tableNameMovies." WHERE id_movie = :id_movie;";
                $parameters['id_movie'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

   
        private function parseToObject($value){
			$value = is_array($value) ? $value : [];
            try {
                $resp = array_map(function($p){
                    $genres = array();
                    
                    $query = "SELECT * FROM ".$this->tableNameMoviesGenres." where id_movie = :id_movie;";
                    $parameters['id_movie'] = $p['id_movie'];
    
                    $this->connection = Connection::GetInstance();
    
                    $genresIdList = $this->connection->Execute($query,$parameters);
             
                    $pdoGenre = new PDOGenre();
                    
                    foreach ($genresIdList as $genreId) {
    
                        $genre = $pdoGenre->getById($genreId['id_genre']);
                        
                        array_push($genres, $genre);
                    }
                    
                    return new Movie($p['id_movie'],$p['name_movie'],$p['runtime'],$p['language_movie'],$genres, $p['image_url']);
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
    }
    
?>