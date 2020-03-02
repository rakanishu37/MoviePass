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
            require_once(VIEWS."theaterAddForm.php");
        }

        public function ShowListView($idCinema){
            //require_once(VIEWS."validate-session.php");
            try{

                $theaterList = $this->daoTheater->getByIdCinema($idCinema);
				$theaterList = $this->convertToArray($theaterList);
				$cinemaName = $this->daoCinema->getByID($idCinema)->getName();
                include VIEWS.'theaterList.php';
            }
            catch(Exception $e){
                $arrayOfErrors [] = $e->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';
            }
        }

        public function validateData($idCinema,$name,$seatPrice,$capacity)
        {
            $aux = $this->daoTheater->getByData(["idCinema" =>$idCinema, "theaterName" => $name]);
            if (!empty($aux)) {
                array_push($arrayOfErrors,"Esa sala ya fue agregada");
                $this->ShowListView($idCinema,$arrayOfErrors);
            }
            else{
                $this->add($idCinema,$name,$seatPrice,$capacity);
            }
        }

        public function add($idCinema,$name,$seatPrice,$capacity){
            try {
                $cinema = $this->daoCinema->getByID($idCinema);
           
                $newTheater = new Theater($name,$capacity,$seatPrice,$cinema,$idCinema);
                $this->daoTheater->add($newTheater);

                $this->showListView($idCinema);
            } 
            catch (Exception $e) {
                $arrayOfErrors [] = $e->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';
            }                  
        }

        public function showMainView($theaterList = '')
        {
            $theaterList = $this->convertToArray($theaterList);
            $idCinema = $theaterList[0]->getId();
            $this->ShowListView($idCinema);
        }


        public function removeById($id)
        {
            $this->daoTheater->delete($id);
            $this->ShowListView($id);
        }

        //No tiene uso
        public function modify($id)
        {
            //require_once(VIEWS."validate-session.php");
            try {
                $theater = $this->daoTheater->getByID($id);
                include VIEWS . 'theaterModifyForm.php'; //suponiendo la existencia de este archivo
            } catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';
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

                $this->ShowListView($cinema->getId());
            }
            catch(Exception $ex){
                $arrayOfErrors [] = $ex->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';
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
