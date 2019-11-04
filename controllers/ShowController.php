<?php
    namespace controllers;
    use models\Movie as Movie;
    use models\Cinema as Cinema;
    use models\Show as Show;
    use dao\DAOShow as DAOShow;
    use dao\json\DAOMovie as DAOMovie;
    use dao\json\DAOCinema as DAOCinema;
    
    class ShowContreller
    {
        private $daoShow;
        private $daoMovie;
        private $daoCinema;
        
        public function __construct() {
            $this->daoShow = new DAOShow();
            $this->daoMovie = new DAOMovie();
            $this->daoCinema = new DAOCinema();
        }

        public function showAddView()
        {
            
        }

        public function add($date,$time,$movieId,$cinemaId){
            $projectionTime = $date." ".$time;
            $movie = //no hay getbyID de movie $daoMovie->getById($movieId);
            $cinema = $this->daoCinema->getById($cinemaId);
            
            $newShow = new Show($projectionTime,$movie,$cinema);
            $this->daoShow->add($newShow);

        }

        /*Funcion de control*/
        private function getShowsByDate($dateToFilter){
            $showListToReturn = array();
            $showList = $this->daoShow->getAll();
            foreach ($showList as $show) {
                if($dateToFilter == $show->getDate()){
                    array_push($showListToReturn, $show);
                }    
            }
            return $showListToReturn;
        }

        private function getMoviesNotShowed($date){
            
        }

        vistaDeSelects ($date,$time){
            $showList = getShowsBydate($date);

            
        }
    }
?>