<?php
namespace dao;

use dao\IDAOCinema as IDAOCinema;
use models\Cinema as Cinema;

class DAOCinema implements IDAOCinema
{
    private $cinemaList;
    
    public function add(Cinema $newCinema)
    {
        $this->retrieveData();
        $newCinema->setId(hash("md5",count($this->cinemaList)));
        array_push($this->cinemaList, $newCinema);
        $this->saveData();
    }

    private function findIndex($id){
        $this->retrieveData();
        $foundIndex = '';
        foreach ($this->cinemaList as $index=>$cinema) {
            if($cinema->getId() == $id){
                $foundIndex = $index;
            }
        }
        return $foundIndex;
    }
    public function getByID($id){
        $this->retrieveData();
        $index = $this->findIndex($id);
        //var_dump($this->cinemaList[$index]);
        return $this->cinemaList[$index];
    }

    
    public function update(Cinema $modifiedCinema){
        //Consigo el cine que va a ser modificado
        $this->retrieveData();
        $index = $this->findIndex($modifiedCinema->getId());
        
        //Piso el valor
        $this->cinemaList[$index] = $modifiedCinema;
        
        $this->saveData();
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->cinemaList;
    }

    private function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->cinemaList as $cinema) {
            $valueArray['id'] = $cinema->getId();
            $valueArray['name'] = $cinema->getName();
            $valueArray['address'] = $cinema->getAddress();
            $valueArray['capacity'] = $cinema->getCapacity();
            $valueArray['ticketPrice'] = $cinema->getTicketPrice();
            $valueArray['status'] = $cinema->getStatus();
            
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
                                    $valueArray['capacity'],$valueArray['ticketPrice'],$valueArray['status']);
            $cinema->setId($valueArray['id']);
            
            array_push($this->cinemaList, $cinema);
        }
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
     //modificar para que pueda venir la url por parametro
    private function getJsonFilePath()
    {
        $jsonFilePath = ROOT."data/cinema.json";
        if (!file_exists($jsonFilePath))
            file_put_contents($jsonFilePath,"");
        return $jsonFilePath;
    }
}
