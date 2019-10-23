<?php
namespace dao;
use dao\IDAOMovie as IDAOMovie;
use models\Movie as Movie;
use models\Genre as Genre;

class DAOMovie implements IDAOMovie
{
    private $movieList;
    //asegurar que siempre se carguen las peliculas del now playing
    
    public function __construct(){
        if (empty ( file_get_contents($this->getJsonFilePath() ) ) ){
            $latestMovieList = $this-> getLatestMovies();
            
            foreach($latestMovieList as $movie){
                $this->add($movie);
            }
        }
    }

    public function add(Movie $movie)
    {
        $this->retrieveData();
        array_push($this->movieList, $movie);
        $this->saveData();
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->movieList;   
    } 

    private function retrieveData()
    {
        $this->movieList = array();

        $jsonPath = $this->getJsonFilePath();

        $jsonContent = file_get_contents($jsonPath);

        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
        foreach ($arrayToDecode as $valueArray) {
            $genreList = array();
            
            foreach($valueArray['genre'] as $value){
                $genre = new Genre($value['name'],$value['id']);
                array_push($genreList,$genre);
            }
            
            //php interpreta la barra
            //$urlFixed = trim($valueArray['imageURL'],"\\");

            $movie = new Movie($valueArray['id'],$valueArray['name'],$valueArray['runtime'],
                        $valueArray['language'],$genreList,$valueArray['imageURL'] );

            array_push($this->movieList, $movie);
        }
    }

    private function saveData()
    {
        $arrayToEncode = array();
        foreach ($this->movieList as $movie) {
            
            $valueArray['id'] = $movie->getId();
            $valueArray['name'] = $movie->getName();
            $valueArray['runtime'] = $movie->getRuntime();
            $valueArray['language'] = $movie->getLanguage();  
            $valueArray['imageURL'] = $movie->getImageURL();
            
            $genreList = $movie->getGenre();
            $genreArrayToEncode = array();
            
            foreach($genreList as $genre){
                $genreArrayValue['name'] = $genre->getName();
                $genreArrayValue['id'] = $genre->getApiKey();

                array_push($genreArrayToEncode,$genreArrayValue);
            }
            $valueArray['genre'] = $genreArrayToEncode;
            
            
            array_push($arrayToEncode, $valueArray);
        }
        
        $jsonPath = $this->getJsonFilePath();
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($jsonPath , $jsonContent);
    }

    /**
     * Retorna un array con las 20 peliculas mas recientes, sus elementos son de tipo Movie 
     */
    public function getLatestMovies(){
        $latestMoviesIDList = $this->getLatestMoviesID();

        $moviesList = array();

        foreach($latestMoviesIDList as $id){
            $movie = $this->createMovieFromJSON($id);
            
            array_push($moviesList,$movie);
        }
        
        return $moviesList;
    }

    private function getLatestMoviesID()
    {
        $idMoviesList = array();
        $jsonContent = $this->getLatestMoviesJSON();

        $arrayToDecode = array();     
        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

        //puedo acceder directamente a ese conjunto
        foreach($arrayToDecode['results'] as $valueArray){
            array_push($idMoviesList,$valueArray['id']);
        }

        return $idMoviesList;
    }

    private function createMovieFromJSON($movieID){
        $movieJSON = $this->getMovieDataJSON($movieID);
            
        $arrayToDecode = array();     
        $arrayToDecode = ($movieJSON) ? json_decode($movieJSON, true) : array();
        
        $movieGenreList = array();
        
        foreach($arrayToDecode['genres'] as $genre){
            $genre= new Genre($genre['name'],$genre['id']);

            array_push($movieGenreList,$genre);   
        }
        
        $id = $arrayToDecode['id'];
        $name = $arrayToDecode['title'];
        $runtime = $arrayToDecode['runtime'];
        $language = $arrayToDecode['original_language'];
        $imageURL = $arrayToDecode['poster_path'];

        $movie = new Movie($id,$name,$runtime,$language,$movieGenreList,$imageURL);
    
        return $movie;
    }
    
  
    public function getLatestMoviesJSON(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/now_playing?page=1&language=en-US&api_key=".API_KEY,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 200,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }

    private function getMovieDataJSON($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$id."?language=en-US&api_key=".API_KEY,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 200,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }

    private function getJsonFilePath()
    {
        $jsonFilePath = ROOT."data/movies.json";
        if (!file_exists($jsonFilePath))
            file_put_contents($jsonFilePath,"");
        return $jsonFilePath;
    }
}
?>