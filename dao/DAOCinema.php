<?php
namespace dao;

use dao\IDAO as IDAO;
use models\Cinema as Cinema;

class DAOCinema implements IDAO
{
    private $cinemaList;
    
    public function add($newCinema)
    {
        $this->retrieveData();
        array_push($this->cinemaList, $newCinema);
        $this->saveData();
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->cinemaList;
    }

    public function deleteById($id)
    {
        $this->retrieveData();
        $newList = array();
        foreach ($this->cinemaList as $cinema) {
            if ($cinema->getId() != $id) {
                array_push($newList, $cinema);
            }
        }
        $this->cinemaList = $newList;
        $this->saveData();
    }

    private function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->cinemaList as $cinema) {
            $valueArray['id'] = hash("md5",count($this->cinemaList));
            $valueArray['name'] = $cinema->getName();
            $valueArray['address'] = $cinema->getAddress();
            $valueArray['capacity'] = $cinema->getCapacity();
            $valueArray['ticketPrice'] = $cinema->getTicketPrice();

            array_push($arrayToEncode, $valueArray);
        }
        $jsonPath = $this->getJsonFilePath();
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($jsonPath , $jsonContent);
    }

    private function retrieveData()
    {
        $this->cinemaList = array();

        $jsonPath = $this->getJsonFilePath();

        // $jsonContent = file_get_contents('../Data/cinema.json');
        $jsonContent = file_get_contents($jsonPath);

        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

        foreach ($arrayToDecode as $valueArray) {
            $cinema = new Cinema($valueArray['name'],$valueArray['address'],
                                    $valueArray['capacity'],$valueArray['ticketPrice']);
            $cinema->setId($valueArray['id']);
            
            array_push($this->cinemaList, $cinema);
        }
    }

     //modificar para que pueda venir la url por parametro
    function getJsonFilePath()
    {
        $jsonFilePath = ROOT."data/cinema.json";
        if (!file_exists($jsonFilePath))
            file_put_contents($jsonFilePath,"");
        return $jsonFilePath;
    }
}
