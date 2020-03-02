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
    
    public function index()
    {
        $menus = array();
        $item['title'] = "Dar alta cine";
        $item['link'] = FRONT_ROOT . "/cinema" . "/createCinema";
        array_push($menus,$item);
        $item['title'] = "Ver lista de cines";
        $item['link'] = FRONT_ROOT . "/cinema" . "/showCinemas";
        array_push($menus,$item);
        $item['title'] = "Modificar cine";
        $item['link'] = FRONT_ROOT . "/cinema" . "/selectCinemaToModify";
        array_push($menus,$item);
        $item['title'] = "Cerrar cine";
        $item['link'] = FRONT_ROOT . "/cinema" . "/selectCinemaToClose";
        array_push($menus,$item);
        include VIEWS . "menu.php";
    }

    public function createCinema($arrayOfErrors = array())
    {
        $placeholderName = 'Ingrese el nombre del cine';
        $placeholderAddress = 'Ingresar la direccion del cine';        
        include VIEWS . "cinemaAddForm.php";
        include VIEWS . 'footer.php';   
    }

    public function validateDataAdd($name,$address)
    {
        try {
            if($this->invalidString($name)){
                throw new Exception("Hay caracteres invalidos en el nombre", 1);
            }
            if($this->invalidString($address)){
                throw new Exception("Hay caracteres invalidos en la direccion", 1);            
            }            
            $this->add($name,$address);
        }
        catch(Exception $e){
            array_push($arrayOfErrors,$e->getMessage());
            $this->createCinema($arrayOfErrors);
        }
    }

    public function add($name, $address)
    {
		
        $newCinema = new Cinema($name, $address);
        try {
            $this->daoCinema->add($newCinema);
            $this->showCinemas();
        } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage();
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
			
        }        
    }


    public function selectCinemaToModify()
    {
        try {
            $cinemaList = $this->convertToArray($this->daoCinema->getAll());
            include VIEWS . 'cinemaModifyChooseForm.php';
        } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage();
			include VIEWS.'menuTemporal.php';
		    include VIEWS.'footer.php'; } 
        }
    

    public function selectCinemaToClose()
    {
        try {
            $cinemaList = $this->convertToArray($this->daoCinema->getAllActiveCinemas());
            include VIEWS . 'cinemaToCloseForm.php';
        } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage();
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
        }      
    }


    public function modify($idCinema, $arrayOfErrors= array())
    {
        try {

            $cinemaToModify = $this->daoCinema->getByID($idCinema);
            include VIEWS . 'cinemaModifyForm.php';
			include VIEWS.'footer.php';
            
        }    
        catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage();
			include VIEWS.'menuTemporal.php';
            include VIEWS.'footer.php';
        }
    }

    private function invalidString($string){
        $a = array();
        if(!preg_match('/^[a-z0-9A-Z ]/', $string,$a)){
            return true;
        }
        else{
            return false;
        }
    }

    public function validateDataModify($id,$name,$address,$name_unmodified, $address_unmodified,$status)
    {
        $arrayOfErrors = array();
        if(empty($name)){
            $name = $name_unmodified;    
        }
        if(empty($address)){
            $address = $address_unmodified;    
        }
        try {
            if($this->invalidString($name)){
                throw new Exception("Hay caracteres invalidos en el nombre", 1);            
            }
            if($this->invalidString($address)){
                throw new Exception("Hay caracteres invalidos en la direccion", 1);            
            }
            $this->update($id,$name,$address,$status);
        } 
        catch (Exception $e) {
            array_push($arrayOfErrors, $e->getMessage());
            $this->modify($id,$arrayOfErrors);
        }
    }

   public function update($id,$name, $address,$status)
    {       
        $cinemaModified = new Cinema($name, $address, $status, $id);
        try{
            $this->daoCinema->update($cinemaModified);
            
            $this->showCinemas();
        }
        catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage();
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
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
        catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage();
			include VIEWS.'menuTemporal.php';
            include VIEWS.'footer.php';
        }
    }

    public function showCinemas()
    {
        try {
            $activeCinemas = $this->daoCinema->getAllActiveCinemas();
            
            $cinemaList = is_null($activeCinemas) ? [] : $this->convertToArray($activeCinemas);
            
            include VIEWS . 'cinemasList.php';  
        } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage();
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
        }
    }


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
