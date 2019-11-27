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
            }catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
            
        }
        

        public function add($date,$time,$theaterId,$movieId){
            $projectionTime = $date." ".$time;
            try {
                $movie = $this->daoMovie->getById($movieId);
                $theater = $this->daoTheater->getById($theaterId);
                
                $newShow = new Show($projectionTime,$movie,$theater);
                $this->daoShow->add($newShow);
    
                $this->showMainView($this->daoShow->getAll());
            }catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
        }

        public function startForm($arrayOfErrors = array()){
            try{
                $cinemaList = array();
                $cinemas = $this->convertToArray($this->daoCinema->getAllActiveCinemas());
                foreach ($cinemas as $cinema) {
                    if(!empty($this->daoTheater->getByCinemaID($cinema->getId()))){
                        array_push($cinemaList,$cinema);
                    }
                }    
            }
            catch(Exception $e){
                array_push($arrayOfErrors,$e->getMessage());
            }   
            finally{
                include VIEWS."showChooseDateTimeForm.php";
                include VIEWS.'footer.php';    
            } 
        }

        public function continueForm($date, $time, $cinemaId,$arrayOfErrors = array()){
            try {
                $theaterList = $this->daoTheater->getByIdCinema($cinemaId);
                $theaterList = $this->convertToArray($theaterList);
                include VIEWS."showChooseTheaterForm.php";
            } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
            include VIEWS.'footer.php';
        }

        
        public function finalizeForm($date, $time, $cinemaId,$theaterId,$arrayOfErrors=array()){
            
            try {
                $movieList = $this->getMoviesAvailable($date,$theaterId);
               
                include VIEWS."showChooseMovieCinemasForm.php";
            } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
        }
        private function validateDate($date, $time, $theaterId,$movieId){
            $auxDate = $date.' '.$time;
            $dateToInsert = new DateTime($auxDate);
            $movie = $this->daoMovie->getById($movieId);
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
            $arrayOfErrors = array();
            if($date<date("Y-m-d")){
                array_push($arrayOfErrors,'La fecha tiene que ser una futura') ;
                $this->startForm($arrayOfErrors);
            }
            if(is_null($time)){
                array_push($arrayOfErrors,'La hora no puede ser nula');
                $this->startForm($arrayOfErrors);
            }
            if($this->validateDate($date,$time, $theaterId,$movieId)){
                $cinemaId = $this->daoTheater->getByID($theaterId)->getId();
                array_push($arrayOfErrors,'En la fecha y hora elegidas la sala ya emite una pelicula');
                $this->continueForm($date, $time, $cinemaId,$arrayOfErrors);
            }

            
           $this->add($date,$time,$theaterId,$movieId);
            
        }


        private function getMoviesAvailable($date,$theaterId){
            $movieListFiltered = array();
            $moviesScreened = array();

            $movieList = $this->daoMovie->getLatestMovies();

            $showList = $this->daoShow->getAllByDate($date);

            $showList = $this->convertToArray($showList);
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
                if($this->movieInArray($movie,$moviesScreened) == false){
                    if($this->movieInArray($movie,$movieListFiltered) == false){
                        array_push($movieListFiltered,$movie);
                    }    
                }
            }
            return $movieListFiltered;
        }

        public function filterByDate(){
            include VIEWS."showChooseDateToFilterForm.php";
        }

        public function filterByGenre(){
            try {
                $genreList = $this->daoGenre->getAll();
                include VIEWS."showChooseGenreToFilterForm.php";    
            } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
            
        }

        public function getFilteredShowsByDate($filter)
        {
            try {
                $showList = $this->convertToArray($this->daoShow->getAllByDate($filter));
                $this->showMainView($showList);
            } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
        }

        public function getFilteredShowsByGenre($filter)
        {
            try {
                $showList = $this->daoShow->getAllByGenre($filter);
                $this->showMainView($showList);
            } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
            
        }

        public function showMainView($showList = '')
        {
            $showList = $this->convertToArray($showList);
            include_once VIEWS."showAdminMainView.php";
        }


        /*        private function getMoviesNotScreened($date){
            try {
                $showList = $this->daoShow->getAllByDate($date);
            
                //#TODO cambiar a que sean solo las recientes
                $movieList = $this->daoMovie->getAll();
                $moviesScreened = array();
                $moviesNotScreened = array();
    
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
        }*/
       
        private function movieInArray($searchedMovie,$movieList= ''){
            if(empty($movieList)== false){
                foreach ($movieList as $movie) {
                    if($movie->getId() == $searchedMovie->getId()){
                        return true;
                    }
                }
                return false;
            }
            else{
                return false;
            }    
            
        } 

        
        public function deleteById($showId)
        {
            try {
                $this->daoShow->deleteById($showId);
                $this->index();
            } catch (Exception $ex) {
            $arrayOfErrors [] = $ex->getMessage;
			include VIEWS.'menuTemporal.php';
			include VIEWS.'footer.php';
            }
            
        }

        public function chooseShow($movieId){
            try {
                $showList = $this->convertToArray($this->daoShow->getAvailableShowsByMovieId($movieId));
                
                if(empty($showList)){
                    $arrayOfErrors [] = "No hay funciones disponibles";
                    include VIEWS.'menuTemporal.php';
                    include VIEWS.'footer.php';
                }
                else{
                    include_once VIEWS."showClient.php";
                }
            } catch (Exception $e) {
                $arrayOfErrors [] = $e->getMessage;
                include VIEWS.'menuTemporal.php';
                include VIEWS.'footer.php';
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
                $allShows = $this->daoShow->getAvailableShows();

                $showList = is_null($allShows) ? [] : $this->convertToArray($allShows);
            } catch (Exception $e) {
                echo $e;
            }
            include_once VIEWS."showClient.php";
        }

        public function quantitiesAndRemnants(){
            try{
                $showList = $this->daoShow->getShowsWithTickets();
            }
            catch(Exception $e){
                $arrayOfErrors [] = $e->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';
            }
            include VIEWS.'quantitiesAndRemnants.php';
        } 

        public function moneyCollectionCinema(){
            try{
                $cinemaList= $this->convertToArray($this->daoCinema->getAll());
            }
            catch(Exception $ex){
                echo '<pre>';
                echo $ex;
                echo '</pre>';
            }
            include VIEWS.'selectCinemaForTotal.php';
        }

        public function totalAmountByCinema($cinemaId,$firstDate,$lastDate){
            try{
                $revenue = $this->daoShow->totalAmountByCinema($cinemaId,$firstDate,$lastDate);
            }
            catch(Exception $e){
                echo $e;
            }
            include VIEWS.'showTotalMoney.php';
        }

        public function moneyCollectionMovie(){
            try{
                $movieList= $this->convertToArray($this->daoMovie->getAll());
            }
            catch(Exception $ex){
                echo '<pre>';
                echo $ex;
                echo '</pre>';
            }
            include VIEWS.'selectMoviesForTotal.php';
        }      
        public function totalAmountByMovie($movieId,$firstDate,$lastDate){
            try{
                $revenue = $this->daoShow->totalAmountByMovie($movieId,$firstDate,$lastDate);
            }
            catch(Exception $e){
                echo $e;
            }
            include VIEWS.'showTotalMoney.php';
        }
        
    }
?>

