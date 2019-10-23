<?php
namespace dao;
use dao\IDAOGenre as IDAOGenre;
use models\Genre as Genre;

    
class DAOGenre implements IDAOGenre
{
    private $genreList;

    public function __construct(){
        
        if (empty ( file_get_contents($this->getJsonFilePath() ) ) ){
            $genreList = $this-> getGenreListFromJSON();
            
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
    private function getGenreListFromJSON(){
        $genreList = array();
        $jsonContent = $this->getGenreJSON();
        
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

    
    private function getGenreJSON()
    {
        //se podria lograr lo mismo con un file_get_contents ya que es un json lo que viene de la api
        //inicia la session cURL
        $curl = curl_init();

        //setea las variables
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=".API_KEY,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        ));

        //Ejecuta la sesion y guarda en response lo que devuelva
        $response = curl_exec($curl);

        //Se guarda en err el error si es que hubo alguno
        $err = curl_error($curl);

        //se cierra la sesion
        curl_close($curl);

        if ($err) echo "cURL Error #:" . $err;
        else return $response;
        
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