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
    {
        $placeholderName = 'Ingrese el nombre del cine';
        $placeholderAddress = 'Ingresar la direccion del cine';
        if(!is_null($cinema)){
            /**
             * @var Cinema $cinema
             */
            if(!empty($cinema->getName())){
                $placeholderName = $cinema->getName();
            }
            if(!empty($cinema->getAddress())){
                $placeholderAddress = $cinema->getAddress();
            }
        }
        include VIEWS . "cinemaAddForm.php";

        /* meter de alguna forma el source para que funcione
        entra aca cuando llega con un mensaje cargado y el objeto distinto de nulo*/
        if(!empty($mensaje)){
            echo '<script>
            swal({
                title: "Cuidado",
                text: "El nombre o direccion contiene caracteres no validos",
                icon: "warning"
            });
            </script>';
        }
    }

    public function validateDataAdd($name,$address)
    {
        
        $tempName = '';
        $tempAddress = '';
        $flag = 0;
        $message = 0;
        if(!preg_match('/^[a-z0-9A-Z ]/', $name)){
            $flag = 1;
            $message = 1;
            $tempName = $name;
        }

        if(!preg_match('/^[a-z0-9A-Z ]/', $address)){
            $flag = 1;
            $message= 1;
            $tempAddress = $address;
        }
        $tempCinema = new Cinema($tempName,$tempAddress); 

        if($flag == 1){
            $this->createCinema($tempCinema,$message);
        }
        else{
            $this->add($name,$address);
        }
    }

    public function add($name, $address)
    {
        $newCinema = new Cinema($name, $address);
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


    public function modify($idCinema, $mensaje= '')
    {
        try {

            $cinemaToModify = $this->daoCinema->getByID($idCinema);
            include VIEWS . 'cinemaModifyForm.php';


            if(!empty($mensaje)){
                echo '<script>
                swal({
                    title: "Cuidado",
                    text: "El nombre o direccion contiene caracteres no validos",
                    icon: "warning"
                });
                </script>';
            }
        }    
        catch (Exception $th) {
            echo $th;
        }
    }

    public function validateDataModify($id,$name,$address,$name_unmodified, $address_unmodified,$status)
    {
        $flag = 0;
        $message = 0;
        if(!preg_match('/^[a-z0-9A-Z ]/', $name) or !preg_match('/^[a-z0-9A-Z ]/', $address)){
            $flag = 1;
            $message = 1;     
        }
        
        if($flag == 1){
            $this->modify($id,$message);
        }
        else{
            $this->update($id,$name,$address,$name_unmodified, $address_unmodified,$status);
        }
    }

    public function update($id,$name, $address, $name_unmodified, $address_unmodified,$status)
    {
        if(empty($name)){
            $name = $name_unmodified;    
        }
        if(empty($address)){
            $address = $address_unmodified;    
        }
       
        $cinemaModified = new Cinema($name, $address, $status, $id);
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
        try{
            $closedCinema = $this->daoCinema->getByID($idCinema);

            $closedCinema->setStatus(0);
      
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
