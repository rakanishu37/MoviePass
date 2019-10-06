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

        public function add(Cinema $newCinema)
        {
            $this->daoCinema->add($newCinema);

            echo '<pre>';
            print_r($this->daoCinema->getAll());
            echo '</pre>';
        }
    }
?>
