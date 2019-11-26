<?php
    namespace controllers;

    use models\Movie as Movie;
    use models\Cinema as Cinema;
    use models\Show as Show;
    use dao\pdo\PDOShow as DAOShow;
    use dao\pdo\PDOMovie as DAOMovie;
    use dao\pdo\PDOCinema as DAOCinema;
    use dao\pdo\PDOGenre as DAOGenre;
    use dao\pdo\PDOTicket as DAOTicket;
    use \Exception as Exception;

    class ShowController
    {
        private $daoShow;
        private $daoMovie;
        private $daoCinema;
        private $daoGenre;
        private $daoTicket;

        public function __construct() {
            $this->daoShow = new DAOShow();
            $this->daoMovie = new DAOMovie();
            $this->daoCinema = new DAOCinema();
            $this->daoGenre = new DAOGenre();
            $this->daoTicket = new DAOTicket();
        }

        public function index(){
            try {
                $showList = $this->daoShow->getAll();
            
                $this->showMainView($showList);
            } catch (Exception $e) {
                echo $e;
            }
            
        }
        
        public function validateData($date,$time,$movieId,$cinemaId){
            $flag = 0;
            if($date<date("Y-m-d")){
                //esta ingresando una fecha pasada a la actual y solo admite a partir del mañana
            }
            if(is_null($time)){
                //la fecha vino como nula, es imposible
            }
            if(is_null($movieId) || empty($this->daoMovie->getById($movieId))){
                //valor nulo o valor no existe en la bdd
            }
            if(is_null($cinemaId) || empty($this->daoCinema->getById($cinemaId))){
                //valor nulo o valor no existe en la bdd
            }

            if($flag){
                //mandarlo para atras
            }
            else{
                $this->add($date,$time,$movieId,$cinemaId);
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

        /*este no iria, es solo para probar 
        public function showClient($showList = '')
        {
            try {
                $allShows = $this->daoShow->getAll();
            
                $showlist = is_null($allShows) ? [] : $this->convertToArray($allShows);
            } catch (Exception $e) {
                echo $e;
            }
            include_once VIEWS."showClient.php";
        }

        public function showClient($showList = '')
        {
            try {
                $showList = $this->daoShow->getAll();
            
                $this->convertToArray($showList);
            } catch (Exception $e) {
                echo $e;
            }
            include_once VIEWS."showClient.php";
        }
        */

        public function showClient()
        {
            
            try {
                $allShows = $this->daoShow->getAll();

                $showList = is_null($allShows) ? [] : $this->convertToArray($allShows);
            } catch (Exception $e) {
                echo $e;
            }
            include_once VIEWS."showClient.php";
        }

        public function quantitiesAndRemnants(){
            $showList = $this->daoShow->getShowsWithTickets();
        }
        
    }
?>

