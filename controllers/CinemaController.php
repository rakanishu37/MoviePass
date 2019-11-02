<?php

namespace controllers;

use models\Cinema as Cinema;
use dao\DAOCinema as DAOCinema;

class CinemaController
{
    private $daoCinema;

    public function __construct()
    {
        $this->daoCinema = new DAOCinema();
    }
    
    public function showCreateCinema($cinema = null, $mensaje= '')
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

        $this->daoCinema->add($newCinema);

        $this->showCinemas();
    }


    public function selectCinemaToModify()
    {
        $cinemaList = $this->daoCinema->getAll();
        include VIEWS . 'cinemaModify.php';
    }

    public function selectCinemaToClose()
    {
        $activeCinemaList = $this->daoCinema->getAll();
        $cinemaList = array();
        foreach ($activeCinemaList as $cinema) {
            if ($cinema->getStatus() == 1) {
                array_push($cinemaList, $cinema);
            }
        }

        include VIEWS . 'cinemaToCloseForm.php';
    }


    public function modify($idCinema)
    {
        $cinema = $this->daoCinema->getByID($idCinema);

        include VIEWS . 'cinemaModifyChooseForm.php';
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
        
        $cinemaModified = new Cinema($name, $address, $capacity, $ticketPrice, $status);
        $cinemaModified->setId($id);

        $this->daoCinema->update($cinemaModified);

        $this->showCinemas();
    }
    /**
     * Da de baja logica un cine
     */

    public function closeCinema($idCinema)
    {
        $closedCinema = $this->daoCinema->getByID($idCinema);

        echo $closedCinema->setStatus(0);
        $this->daoCinema->update($closedCinema);

        $this->showCinemas();
    }


    public function showCinemas()
    {
        $activeCinemaList = $this->daoCinema->getAll();
        $cinemaList = array();
        foreach ($activeCinemaList as $cinema) {
            if ($cinema->getStatus() == 1) {
                array_push($cinemaList, $cinema);
            }
        }
        include VIEWS . 'cinemasList.php';
    }

    public function showCinemasTest()
    {
        $cinemaList = $this->daoCinema->getAll();
        include VIEWS . 'cinemasList.php';
    }
}
?>
