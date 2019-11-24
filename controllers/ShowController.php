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
            try {
                $showList = $this->daoShow->getAll();
            
                $this->showMainView($showList);
            } catch (Exception $e) {
                echo $e;
            }
            
        }
        

        public function add($date,$time,$movieId,$cinemaId){
            $projectionTime = $date." ".$time;
            try {
                $movie = $this->daoMovie->getById($movieId);
                $cinema = $this->daoCinema->getById($cinemaId);
                
                $newShow = new Show($projectionTime,$movie,$cinema);
                $this->daoShow->add($newShow);
    
                $this->showMainView($this->daoShow->getAll());
            }
            catch(Exception $e){
                echo $e;
            }
        }

        public function startForm(){
            include VIEWS."showChooseDateTimeForm.php";
        }

        public function continueForm($date, $time){
            try {
                $movieList = $this->getMoviesNotScreened($date);
            
                $cinemaList = $this->convertToArray($this->daoCinema->getAllActiveCinemas());
                
                include VIEWS."showChooseMovieCinemasForm.php";
            } catch (Exception $e) {
                echo $e;
            }
            
        }

        public function filterByDate(){
            include VIEWS."showChooseDateToFilterForm.php";
        }

        public function filterByGenre(){
            try {
                $genreList = $this->daoGenre->getAll();
                include VIEWS."showChooseGenreToFilterForm.php";    
            } catch (Exception $e) {
                echo $e;
            }
            
        }

        public function getFilteredShowsByDate($filter)
        {
            try {
                $showList = $this->convertToArray($this->daoShow->getAllByDate($filter));
                $this->showMainView($showList);
            } catch (Exception $e) {
                echo $e;
            }
        }

        public function getFilteredShowsByGenre($filter)
        {
            try {
                $showList = $this->daoShow->getAllByGenre($filter);
                $this->showMainView($showList);
            } catch (Exception $e) {
                echo $e;
            }
            
        }

        public function showMainView($showList = '')
        {
            $showList = $this->convertToArray($showList);
            include_once VIEWS."showAdminMainView.php";
        }


        private function getMoviesNotScreened($date){
            try {
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
    
               return $moviesNotScreened; }
            catch (Exception $e) {
                echo $e;
            }
            
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
            try {
                $this->daoShow->deleteById($showId);
                $this->index();
            } catch (Exception $e) {
                echo $e;
            }
            
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

