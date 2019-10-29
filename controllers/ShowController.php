<?php
    namespace controllers;
    use models\Movie as Movie;
    use models\Cinema as Cinema;
    use dao\DAOShow as DAOShow;
    use dao\DAOMovie as DAOMovie;
    use dao\DAOCinema as DAOCinema;
    
    class ShowContreller
    {
        $daoShow = new DAOShow();
        $daoMovie = new DAOMovie();
        $daoCinema = new DAOCinema();
        

        public function showAddView(Type $var = null)
        {
            
        }

        public function add($date,$time,$movieId,$cinemaId){
            $projectionTime=$date." ".$time;
            $movie = //no hay getbyID de movie $daoMovie->getById($movieId);
            $cinema = $daoCinema->getById($inemaid);

            $newShow = new Show($projectionTime,$movie,$cinema);
            $this->daoShow->add($newShow);

            $this->showShows();
        }
    }
?>