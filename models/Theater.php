<?php
    namespace models;

    require "models/Cinema.php";

    use models\Cinema as Cinema;


    class Theater{
        private $id;
	    private $capacity;
	    private $name;
	    private $cinema;
	    private $seatPrice;

        public function __construct($id='',$capacity='',$name='',$cinema='',$seatPrice='') {
            $this->setId($id);
            $this->setCapacity($capacity);
            $this->setName($name);
            $this->setCinema($cinema);
            $this->setSeatPrice($seatPrice);
        }
        
        public function getId()
        {
            return $this->id;
        }
    
        public function getCapacity()
        {
            return $this->capacity;
        }
        
        public function getName()
        {
            return $this->name;
        }

        public function getCinema()
        {
            return $this->cinema;
        }

        public function getSeatPrice()
        {
            return $this->seatPrice;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setCapacity($capacity)
        {
            $this->capacity = $capacity;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function setCinema(Cinema $cinema)
        {
            $this->cinema = $cinema;
        }

        public function setSeatPrice($seatPrice)
        {
            $this->seatPrice = $seatPrice;
        }

    } 

?>