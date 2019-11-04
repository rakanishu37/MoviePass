<?php

namespace controllers;

use models\Cinema as Cinema;
//use dao\json\DAOCinema as DAOCinema;
use dao\pdo\PDOCinema as DAOCinema;
use \Exception as Exception;

class CinemaController
{
    private $daoCinema;

    public function __construct()
    {
        $this->daoCinema = new DAOCinema;
    }
    
    public function createCinema($cinema = null, $mensaje= '')
    {/*
        if !empty($mensaje)
        
        echo '<script>
            swa
        </script>'*/
        include VIEWS . "cinemaAddForm.php";
    }

    public function add($name, $address, $capacity, $ticketPrice)
    {
        $newCinema = new Cinema($name, $address, $capacity, $ticketPrice);
        try {
            $this->daoCinema->add($newCinema);
            $this->showCinemas();
        } catch (Exception $ex) {
            echo $ex;
        }        
    }


    public function selectCinemaToModify()
    {
        try {
            $cinemaList = $this->convertToArray($this->daoCinema->getAll());
            include VIEWS . 'cinemaModifyChooseForm.php';
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function selectCinemaToClose()
    {
        /*$activeCinemaList = $this->daoCinema->getAll();
        $cinemaList = array();
        foreach ($activeCinemaList as $cinema) {
            if ($cinema->getStatus() == 1) {
                array_push($cinemaList, $cinema);
            }
        }*/
        try {
            $cinemaList = $this->convertToArray($this->daoCinema->getAllActiveCinemas());
            include VIEWS . 'cinemaToCloseForm.php';
        } catch (Exception $th) {
            echo $th;
        }      
    }


    public function modify($idCinema)
    {
        try {
            $cinema = $this->daoCinema->getByID($idCinema);
            include VIEWS . 'cinemaModifyForm.php';
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function update($id,$name, $address, $capacity, $ticketPrice, $name_unmodified, $address_unmodified, $capacity_unmodified, $ticketPrice_unmodified,$status)
    {
        if(empty($name)){
            $name = $name_unmodified;    
        }
        if(empty($address)){
            $address = $address_unmodified;    
        }
        
        if(empty($capacity)){
            $capacity = $capacity_unmodified;    
        }
        
        if(empty($ticketPrice)){
            $ticketPrice = $ticketPrice_unmodified;    
        }
        
        $cinemaModified = new Cinema($name, $address, $capacity, $ticketPrice, $status, $id);
        try{
            $this->daoCinema->update($cinemaModified);
            
            $this->showCinemas();
        }
        catch(Exception $ex){
            echo $ex;
        }
    }
    /**
     * Da de baja logica un cine
     */

    public function closeCinema($idCinema)
    {
        $closedCinema = $this->daoCinema->getByID($idCinema);

        $closedCinema->setStatus(0);
        try{
            $this->daoCinema->update($closedCinema);

            $this->showCinemas();
        }
        catch(Exception $ex){
            echo $ex;
        }
    }


    public function showCinemas()
    {
        /*$activeCinemaList = $this->daoCinema->getAll();
        $cinemaList = array();
        foreach ($activeCinemaList as $cinema) {
            if ($cinema->getStatus() == 1) {
                array_push($cinemaList, $cinema);
            }
        }*/
        try {
            $activeCinemas = $this->daoCinema->getAllActiveCinemas();
            
            $cinemaList = is_null($activeCinemas) ? [] : $this->convertToArray($activeCinemas);
            
            include VIEWS . 'cinemasList.php';  
        } catch (Exception $th) {
            echo $th;
        }
    }

    
/*
    public function showCinemasTest()
    {
        try{
            $cinemas = $this->daoCinema->getAll();
            
            $cinemaList = is_null($cinemas) ? [] : $this->convertToArray($cinemas);
            
            include VIEWS . 'cinemasList.php';    
        }
        catch (Exception $th) {
            echo $th;
        }
    }*/

    private function convertToArray($value){
        $arrayToReturn = array();
        if(is_array($value)){
            $arrayToReturn = $value;    
        }
        else {
            $arrayToReturn [] = $value;
        }
        return $arrayToReturn;
    }
}
?>
