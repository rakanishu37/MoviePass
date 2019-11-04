<?php
    namespace dao\pdo;

    use dao\IDAOMovie;
    use \Exception as Exception;
    use dao\pdo\Connection as Connection;
    use models\Movie as Movie;
    use models\Genre as Genre;
    use controllers\ApiController as ApiController;

    class PDOMovie implements IDAOMovie
    {
        private $movieList;
        private $connection;
        private $tableNameGenres;
        private $tableNameMovies;

        public function __construct() {
            $this->tableNameGenres = 'movies_by_genres';
            $this->tableNameMovies = 'movies';
        }
/*
        public function getLatestMovies()
        {
            foreach($latestMoviesIDList as $id){
                $movie = ApiController::createMovieFromJSON($id);
            }
        }*/
        public function updateLatestMovies()
        {
            $counter = 0;
            $latestMoviesIDList = ApiController::getLatestMoviesID();

            $movieToBeAdded= array();
            
            foreach($latestMoviesIDList as $movieId){
                if(empty($this->getById($movieId))){
                    $this->add(ApiController::createMovieFromJSON($movieId));
                    $counter++;
                }
            }

            return $counter;
        }
          /*  pregunto por cada id de las ultias peliculas
                sino la tiene la agrega
            
            Comentario: originalmente la bdd va a estar vacia asi que puedo rellenar con esto    
        */

        public function add(Movie $newMovie)
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
                    $query =  "INSERT INTO " . $this->tableNameGenres . " (id_movie, id_genre) VALUES (:id_movie, :id_genre);";
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
			$resp = array_map(function($p){
                $genres = array();
                
                $query = "SELECT * FROM ".$this->tableNameGenres." where id_movie = :id_movie;";
                $parameters['id_movie'] = $p['id_movie'];

                $this->connection = Connection::GetInstance();

                $genresIdList = $this->connection->Execute($query,$parameters);

                echo '<pre>';
                echo $p['id_movie'].'<br>';
                var_dump($genresIdList);
                echo '</pre>';
                
                foreach ($genresIdList as $genreId) {
                    $query = "SELECT * FROM genres where id_genre = :id_genre;";
                    $parameters2['id_genre'] = $genreId;
                    $genreData = $this->connection->Execute($query,$parameters2);
  
                    array_push($genres, new Genre($genreData['name_genre'],$genreData['id_genre']));
                }
                
                return new Movie($p['id_movie'],$p['name_movie'],$p['runtime'],$p['language_movie'],$genres, $p['image_url']);
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