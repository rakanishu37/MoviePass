<?php
namespace dao\json;
use dao\IDAOGenre as IDAOGenre;
use models\Genre as Genre;
use controllers\ApiController as ApiController;
    
class DAOGenre implements IDAOGenre
{
    private $genreList;

    public function __construct(){
        
        if (empty ( file_get_contents($this->getJsonFilePath() ) ) ){
            $genreList = $this-> getGenreListFromAPI();
            
            //Nos aseguramos de tener el archivo con los generos que provee la api
            foreach($genreList as $genre){
                $this->add($genre);
            }
        }
    }
    public function add(Genre $newGenre){
        $this->retrieveData();
        array_push($this->genreList, $newGenre);
        $this->saveData(); 
    }

    public function getAll()
    {
        $this->retrieveData();

        return $this->genreList;   
    } 


    /**
     * Consigue el json de la api de los generos y lo retorna como array de objetos de tipo genre
     */
    private function getGenreListFromAPI(){
        $genreList = array();
        // $this->getGenreJSON();
        $jsonContent =  ApiController::getGenreJSON();
        
        $arrayToDecode = array();     
        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
        
        foreach ($arrayToDecode['genres'] as $value) {
            $genre= new Genre($value['name'],$value['id']);
            
            array_push($genreList, $genre);
        }
        
        return $genreList;
    }
    


    private function retrieveData()
    {
        $this->genreList = array();

        $jsonPath = $this->getJsonFilePath();

        
        $jsonContent = file_get_contents($jsonPath);

        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

        foreach ($arrayToDecode as $valueArray) {
            $genre= new Genre($valueArray['name'],$valueArray['api_key']);
            
            array_push($this->genreList, $genre);
        }
    }
    private function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->genreList as $genre) {
            $valueArray['api_key'] = $genre->getApiKey();
            $valueArray['name'] = $genre->getName();
        
            array_push($arrayToEncode, $valueArray);
        }
        $jsonPath = $this->getJsonFilePath();
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($jsonPath, $jsonContent);
    }

    


    //modificar para que pueda venir la url por parametro
    private function getJsonFilePath()
    {
        $jsonFilePath = ROOT."data/genre.json";
        if (!file_exists($jsonFilePath))
            file_put_contents($jsonFilePath,"") ;
        return $jsonFilePath;
    }
}

?>