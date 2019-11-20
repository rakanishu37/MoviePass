<?php

namespace controllers;


use models\Theater as Theater;
// use dao\json\DAOTheater as DAOTheater;
use dao\pdo\PDOTheater as DAOTheater;
// use dao\json\DAOTheater as DAOTheater;
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

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."theaterAddForm.php");
        }

        public function ShowListView(){
            require_once(VIEWS_PATH."validate-session.php");
            try{
                $cinemaList = $this->daoCinema->getAll();
                include VIEWS.'theaterList.php';
            }
            catch(Exception $e){
                echo $e;
            }
        }

        public function add($id,$capacity,$name, $seatPrice){
            require_once(VIEWS_PATH."validate-session.php");
            $cinema = $this->daoCinema->getByID($id);
           
            $newTheater = new Theater();
            $newTheater->setId($id);
            $newTheater->setCapacity($capacity);
            $newTheater->setName($name);
            $newTheater->setCinema($cinema);
            $newTheater->setSeatPrice($seatPrice);
           
            $this->daoTheater->add($newTheater);
            $this->showMainView($this->daoTheater->getAll());
        }

        public function showMainView($teatherList = '')
        {
            $teatherList = $this->convertToArray($teatherList);
            $this->ShowListView();
        }


        public function removeById($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            $this->daoTheater->delete($id);
            $this->ShowListView();
        }


        public function modify($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            try {
                $theater = $this->daoTheater->getByID($id);
                include VIEWS . 'theaterModifyForm.php'; //suponiendo la existencia de este archivo
            } catch (Exception $th) {
                echo $th;
            }
        }


        public function update($id, $capacity, $name, $cinema, $seatPrice, $id_unmodified, $capacity_unmodified, $name_unmodified, $cinema_unmodified, $seatPrice_unmodified)
        {
        
            require_once(VIEWS_PATH."validate-session.php");

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
            
            $theaterModified = new Theater($id, $capacity, $name, $cinema, $seatPrice);
            try{
                $this->daoTheater->update($theaterModified);
                
                $this->ShowListView();
            }
            catch(Exception $ex){
                echo $ex;
            }
        }
    
 }
?>