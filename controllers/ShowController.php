<?php
    namespace controllers;

    use models\Movie as Movie;
    use models\Cinema as Cinema;
    use models\Show as Show;
    use dao\pdo\PDOShow as DAOShow;
    use dao\pdo\PDOMovie as DAOMovie;
    use dao\pdo\PDOCinema as DAOCinema;
    use dao\pdo\PDOTheater as DAOTheater;
    use dao\pdo\PDOGenre as DAOGenre;
    use \DateInterval as DateInterval;
    use \DateTime as DateTime;
    use dao\pdo\PDOTicket as DAOTicket;
    use \Exception as Exception;

    class ShowController
    {
        private $daoShow;
        private $daoMovie;
        private $daoCinema;
        private $daoTheater;
        private $daoGenre;
        private $daoTicket;

        public function __construct() {
            $this->daoShow = new DAOShow();
            $this->daoMovie = new DAOMovie();
            $this->daoCinema = new DAOCinema();
            $this->daoTheater = new DAOTheater();
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
        

        public function add($date,$time,$movieId,$theaterId){
            $projectionTime = $date." ".$time;
            try {
                $movie = $this->daoMovie->getById($movieId);
                $theater = $this->daoTheater->getById($theaterId);
                
                $newShow = new Show($projectionTime,$movie,$theater);
                $this->daoShow->add($newShow);
    
                $this->showMainView($this->daoShow->getAll());
            }
            catch(Exception $e){
                echo $e;
            }
        }

        public function startForm(){
            try{
                $cinemaList = $this->convertToArray($this->daoCinema->getAllActiveCinemas());    
            }
            catch(Exception $e){
                array_push($arrayOfErrors,$e->getMessage());
            }   
            finally{
                include VIEWS."showChooseDateTimeForm.php";
            } 
        }

        public function continueForm($date, $time, $cinemaId){
            try {
                $theaterList = $this->daoTheater->getByIdCinema($cinemaId);
                include VIEWS."showChooseTheaterForm.php";
            } catch (Exception $e) {
                echo $e;
            }
        }

        
        public function finalizeForm($date, $time, $cinemaId,$theaterId){
            
            try {
                $movieList = $this->getMoviesAvailable($date,$theaterId);

                include VIEWS."showChooseMovieCinemasForm.php";
            } catch (Exception $e) {
                echo $e;
            }
        }
        private function validateDate($date, $time, $theaterId,$movie){
            $auxDate = $date.' '.$time;
            $dateToInsert = new DateTime($auxDate);
            
            $runTime = $movie->getRuntime() + 15;
            
            $interval = new DateInterval('PT'.$runTime.'M');
            $dateToInsertEnd = new DateTime($auxDate);
            $dateToInsertEnd->add($interval);
            
            $showList = $this->daoShow->getByIdTheaterDate($theaterId,$date);
            
            $flag = 0;
            /**
             * @var Show $show
             */
            foreach ($showList as $show) {
                $initialDate = new DateTime($show->getProjectionTime());
                $endDate = new DateTime($show->getProjectionTime());

                $runTime= $show->getMovie()->getRuntime();
                $interval = new DateInterval('PT'.$runTime.'M');
                $endDate->add($interval);

                $interval = new DateInterval('PT15M');
                //final de la proyeccion
                $endDate->add($interval);
                
                if($dateToInsert>=$initialDate && $dateToInsert<=$endDate){
                    $flag = 1;
                }
                elseif($dateToInsertEnd>=$initialDate && $dateToInsertEnd<=$endDate){
                        $flag = 1;
                    }
                }    
            return $flag;
        }
        
        public function validateData($date,$time, $theaterId,$movieId){
            $message = '';
            $movie = $this->daoMovie->getById($movieId);
            $flag = 0;
            if($date<date("Y-m-d")){
                //esta ingresando una fecha pasada a la actual y solo admite a partir del mañana
            }
            if(is_null($time)){
                //la fecha vino como nula, es imposible
            }
            if($this->validateDate($date,$time, $theaterId,$movieId)){
                $flag = 1;
                $message .= 'En la fecha y hora elegidas la sala ya emite una pelicula';
            }
            if(is_null($movieId) || empty($this->daoMovie->getById($movieId))){
                //valor nulo o valor no existe en la bdd
            }
            if(is_null($theaterId) || empty($this->daoTheater->getById($theaterId))){
                //valor nulo o valor no existe en la bdd
            }

            if($flag){
                //mandarlo para atras
            }
            else{
                $this->add($date,$time,$movieId,$theaterId);
            }
        }


        private function getMoviesAvailable($date,$theaterId){
            $movieListFiltered = array();
            $moviesScreened = array();

            $movieList = $this->daoMovie->getLatestMovies();
            $showList = $this->daoShow->getAllByDate($date);
            /**
             * @var Show $show
             */
            foreach ($showList as $show) {
                if($show->getTheater()->getId() == $theaterId){
                    array_push($movieListFiltered,$show->getMovie());
                }
                else{
                    array_push($moviesScreened,$show->getMovie());
                }
            }
                
            /**
             * @var Movie $movie
             */
            foreach ($movieList as $movie) {
                if($this->movieInArray($movie,$moviesScreened) == false && $this->movieInArray($movie,$movieListFiltered)){
                    array_push($movieListFiltered,$movie);
                }
            }

            
            /*
            hay alguna funcion que tenga esa pelicula y coincide la sala que quiere agregar la funcion
            con la anterior?
            pero solo las disponibles
            eso son quitando las peliculas que ya tengan una funcion para ese dia
            */
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
       
        private function movieInArray($searchedMovie,$movieList){
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

        public function elegirFuncion(){

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

