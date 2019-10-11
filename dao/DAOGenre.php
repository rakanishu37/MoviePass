<?php
namespace dao;
use dao\IDAO as IDAO;
use models\Genre;

//implements IDAO
class DAOGenre 
{
    private $genreList;

    public function getAll()
    {
        //retriveData
        return $this->genreList;   
    } 

    //cambiar las cosas para genero
    private function retrieveData()
    {
        $this->cinemaList = array();

        $jsonPath = $this->getJsonFilePath();

        
        $jsonContent = file_get_contents($jsonPath);

        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

        foreach ($arrayToDecode as $valueArray) {
            $genre= new Genre($valueArray['name'],$valueArray['api_key']);
            
            array_push($this->cinemaList, $genre);
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

    
    private function retriveGenreJSON()
    {
        //se podria lograr lo mismo con un file_get_contents ya que es un json lo que viene de la api
        //inicia la session cURL
        $curl = curl_init();

        //setea las variables
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=783ce81a4a4455d3719eb5ca1f039861",
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

    function getJsonFilePath()
    {
        $jsonFilePath = ROOT."data/genre.json";
        if (!file_exists($jsonFilePath))
            file_put_contents($jsonFilePath,"") ;
        return $jsonFilePath;
    }
}

?>