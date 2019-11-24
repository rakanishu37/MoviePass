<?php
namespace controllers;


use models\Theater as Theater;
// use dao\json\DAOTheater as DAOTheater;
use dao\pdo\PDOTheater as DAOTheater;
use dao\pdo\PDOCinema  as DAOCinema;
use \Exception as Exception;

    class TheaterController {
        private $daoTheater;
        private $daoCinema;


        public function __construct()
        {
            $this->daoTheater = new DAOTheater();
            $this->daoCinema = new DAOCinema();
        }

        public function ShowAddView($idCinema = '')
        {
            //require_once(VIEWS."validate-session.php");
            require_once(VIEWS."theaterAddForm.php");
        }

        public function ShowListView($idCinema){
            //require_once(VIEWS."validate-session.php");
            try{
				
                $theaterList = $this->daoTheater->getByIdCinema($idCinema);
				$theaterList = $this->convertToArray($theaterList);
                include VIEWS.'theaterList.php';
            }
            catch(Exception $e){
                echo $e;
            }
        }

        public function add($idCinema,$name,$seatPrice,$capacity){
            //require_once(VIEWS."validate-session.php");
           
            try {
                $cinema = $this->daoCinema->getByID($idCinema);
           
                $newTheater = new Theater($name,$capacity,$seatPrice,$cinema,$idCinema);
                $this->daoTheater->add($newTheater);
            } 
            catch (Exception $e) {
                echo $e;
            }
           
            $this->showListView($idCinema);
        }

        public function showMainView($theaterList = '')
        {
            $theaterList = $this->convertToArray($theaterList);
            $idCinema = $theaterList[0]->getId();
            $this->ShowListView($idCinema);
        }


        public function removeById($id)
        {
            //require_once(VIEWS."validate-session.php");
            $this->daoTheater->delete($id);
            $this->ShowListView();
        }


        public function modify($id)
        {
            //require_once(VIEWS."validate-session.php");
            try {
                $theater = $this->daoTheater->getByID($id);
                include VIEWS . 'theaterModifyForm.php'; //suponiendo la existencia de este archivo
            } catch (Exception $th) {
                echo $th;
            }
        }


        public function update($id, $capacity, $name, $cinema, $seatPrice, $id_unmodified, $capacity_unmodified, $name_unmodified, $cinema_unmodified, $seatPrice_unmodified)
        {
        
            //require_once(VIEWS."validate-session.php");

            if(empty($id)){
                $id = $id_unmodified;    
            }
            if(empty($capacity)){
                $capacity = $capacity_unmodified;    
            }
            if(empty($name)){
                $name = $name_unmodified;    
            }
            
            if(empty($cinema)){
                $cinema = $cinema_unmodified;    
            }
            if(empty($seatPrice)){
                $seatPrice = $seatPrice_unmodified;    
            }
            
            $theaterModified = new Theater( $name,$capacity,$seatPrice, $cinema,$id);
            try{
                $this->daoTheater->update($theaterModified);
                
                $this->ShowListView();
            }
            catch(Exception $ex){
                echo $ex;
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