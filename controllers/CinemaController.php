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

        public function add($name,$address,$capacity,$ticketPrice)
        {
            $newCinema = new Cinema($name,$address,$capacity,$ticketPrice);
            
            $this->daoCinema->add($newCinema);

            $this->showCinemas();
        }

        public function showCinemas()
        {
            
            echo '<pre>';
            var_dump($this->daoCinema->getAll());
            echo '</pre>';  
            
            //cargo la lista de cines y luego incluyo una vista que recorra esa lista
        }
    }
?>
