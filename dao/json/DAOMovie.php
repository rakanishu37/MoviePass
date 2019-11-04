<?php
namespace dao\json;
use dao\IDAOMovie as IDAOMovie;
use models\Movie as Movie;
use models\Genre as Genre;
use controllers\ApiController as ApiController;

class DAOMovie implements IDAOMovie
{
    private $movieList;
    //asegurar que siempre se carguen las peliculas del now playing
    
    public function __construct(){
        if (empty ( file_get_contents($this->getJsonFilePath() ) ) ){
            $latestMovieList = $this->createLatestMovies();
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

    /*prototipo de conseguir solo las recientes
    public function getlatestMoviesList(){
        $latestMoviesId = ApiController::getLatestMoviesID();
        $latestMoviesList = array();
        $this->retrieveData();
        
        foreach ($latestMoviesId as $movieId) {
            if 
        }
        foreach ($this->cinemaList as $index=>$cinema) {
            if($cinema->getId() == $id){
                $foundIndex = $index;
            }
        }
    }*/

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
            
            //php usa la barra \ para escapar el caracter /
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
     * Returns an array of objects Movie  
     */
    private function createLatestMovies(){
        $latestMoviesIDList = ApiController::getLatestMoviesID();

        $moviesList = array();

        foreach($latestMoviesIDList as $id){
            $movie = ApiController::createMovieFromJSON($id);
            
            array_push($moviesList,$movie);
        }
        return $moviesList;
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