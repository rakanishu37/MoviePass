<?php
    namespace controllers;

    use models\Movie as Movie;
    use models\Cinema as Cinema;
    use models\Show as Show;
    use dao\pdo\PDOShow as DAOShow;
    use dao\pdo\PDOMovie as DAOMovie;
    use dao\pdo\PDOCinema as DAOCinema;
    use dao\pdo\PDOGenre as DAOGenre;
    use \Exception as Exception;

    class ShowController
    {
        private $daoShow;
        private $daoMovie;
        private $daoCinema;
        private $daoGenre;

        public function __construct() {
            $this->daoShow = new DAOShow();
            $this->daoMovie = new DAOMovie();
            $this->daoCinema = new DAOCinema();
            $this->daoGenre = new DAOGenre();
        }

        public function index(){
            $showList = $this->daoShow->getAll();
            
            $this->showMainView($showList);
        }
        

        public function add($date,$time,$movieId,$cinemaId){
            $projectionTime = $date." ".$time;
            $movie = $this->daoMovie->getById($movieId);
            $cinema = $this->daoCinema->getById($cinemaId);
            
            $newShow = new Show($projectionTime,$movie,$cinema);
            $this->daoShow->add($newShow);

            $this->showMainView($this->daoShow->getAll());
        }

        public function startForm(){
            include VIEWS."showChooseDateTimeForm.php";
        }

        public function continueForm($date, $time){
            $movieList = $this->getMoviesNotScreened($date);
            
            $cinemaList = $this->convertToArray($this->daoCinema->getAllActiveCinemas());
            
            include VIEWS."showChooseMovieCinemasForm.php";
        }

        public function filterByDate(){
            include VIEWS."showChooseDateToFilterForm.php";
        }

        public function filterByGenre(){
            $genreList = $this->daoGenre->getAll();
            include VIEWS."showChooseGenreToFilterForm.php";
        }

        public function getFilteredShowsByDate($filter)
        {
            $showList = $this->convertToArray($this->daoShow->getAllByDate($filter));
            $this->showMainView($showList);
        }

        public function getFilteredShowsByGenre($filter)
        {
            $showList = $this->daoShow->getAllByGenre($filter);
            $this->showMainView($showList);
        }

        public function showMainView($showList = '')
        {
            $showList = $this->convertToArray($showList);
            include_once VIEWS."showAdminMainView.php";
        }


        private function getMoviesNotScreened($date){

            $showList = $this->daoShow->getAllByDate($date);
            
            //#TODO cambiar a que sean solo las recientes
            $movieList = $this->daoMovie->getAll();
            $moviesScreened = array();
            $moviesNotScreened = array();

            /**
             * @var Show $show
             */
            foreach($showList as $show){
                array_push($moviesScreened,$show->getMovie());
            }
             foreach($movieList as $movie){
                if(!$this->movieInArray($movie,$moviesScreened)){
                    array_push($moviesNotScreened,$movie);
                }
            }

           return $moviesNotScreened;
        }
       
        private function movieInArray(Movie $searchedMovie,$movieList){
            foreach ($movieList as $movie) {
                if($movie->getId() == $searchedMovie->getId()){
                    return true;
                }
            }
            return false;
        } 

        
        public function deleteById($showId)
        {
            $this->daoShow->deleteById($showId);
            $this->index();
        }

        private function convertToArray($value){
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

