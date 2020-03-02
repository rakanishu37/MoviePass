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
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            if ($_SESSION['loggedUser']->getStatus()){
                $menus = array();
                $item['title'] = "Administrar funciones";
                $item['link'] = FRONT_ROOT . "/show" . "/listShows";
                array_push($menus,$item);
            }

            $item['title'] = "Filtrar por genero";
            $item['link'] = FRONT_ROOT . "/show" . "/filterByGenre";
            array_push($menus,$item);
            $item['title'] = "Filtrar por fecha";
            $item['link'] = FRONT_ROOT . "/show" . "/filterByDate";
            array_push($menus,$item);
            $item['title'] = "Lista de funciones";
            $item['link'] = FRONT_ROOT . "/show" . "/showClient";
            array_push($menus,$item);

            include VIEWS . "menu.php";
        }
        
        public function menu()
        {
            $menus = array();
            $item['title'] = "Lista de funciones";
            $item['link'] = FRONT_ROOT . "/show" . "/showClient";
            array_push($menus,$item);
            $item['title'] = "Filtrar por genero";
            $item['link'] = FRONT_ROOT . "/show" . "/filterByGenre";
            array_push($menus,$item);
            $item['title'] = "Filtrar por fecha";
            $item['link'] = FRONT_ROOT . "/show" . "/filterByDate";
            array_push($menus,$item);

            include VIEWS . "menuClient.php";
        }

        public function listShows($arrayOfErrors=array())
        {
            try {
                $showList = $this->daoShow->getAll();
            
                $this->showMainView($showList);
            }catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include_once VIEWS.'menuTemporal.php';   
                include VIEWS.'footer.php';            
            }
        }

        public function money()
        {
            $menus = array();
            $item['title'] = "Cantidades y Remanentes";
            $item['link'] = FRONT_ROOT . "/show" . "/quantitiesAndRemnants";
            array_push($menus,$item);
            $item['title'] = "Ventas segun cine";
            $item['link'] = FRONT_ROOT . "/show" . "/moneyCollectionCinema";
            array_push($menus,$item);
            $item['title'] = "Ventas segun pelicula";
            $item['link'] = FRONT_ROOT . "/show" . "/moneyCollectionMovie";
            array_push($menus,$item);

            include VIEWS . "menu.php";
        }

        public function add($projectionTime,$theaterId,$movieId){
            try {
                $movie = $this->daoMovie->getById($movieId);
                $theater = $this->daoTheater->getById($theaterId);
        
                $newShow = new Show($projectionTime,$movie,$theater);
                
                $this->daoShow->add($newShow);
                $this->showMainView($this->daoShow->getAll());
            }catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include_once VIEWS.'menuTemporal.php'; 
            }
        }

        public function startForm($arrayOfErrors = array()){
            try{
                $cinemaList = array();
                $cinemas = $this->convertToArray($this->daoCinema->getAllActiveCinemas());
                if(empty($cinemas)){
                    throw new Exception("No hay cines disponibles", 1);
                }
                else{
                    foreach ($cinemas as $cinema) {
                        if(!empty($this->daoTheater->getByIdCinema($cinema->getId()))){
                            array_push($cinemaList,$cinema);
                        }
                    }
                    if(empty($cinemaList)){
                        throw new Exception("No hay salas cargadas", 1);                        
                    }
                    include_once VIEWS."showChooseDateTimeForm.php";
                }
            }
            catch(Exception $e){
                $arrayOfErrors = array();
                array_push($arrayOfErrors,$e->getMessage());
                $this->listShows($arrayOfErrors);
                include VIEWS . 'footer.php';
            }
        }

        public function continueForm($date, $time, $cinemaId,$arrayOfErrors = array()){
            try {
                $theaterList = $this->daoTheater->getByIdCinema($cinemaId);
                $theaterList = $this->convertToArray($theaterList);
                if(empty($theaterList)){
                    throw new Exception("No hay salas cargadas en ese cine", 1);                    
                }
                include_once VIEWS."showChooseTheaterForm.php";
            } catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include_once VIEWS.'menuTemporal.php';
                include_once VIEWS.'footer.php';
            }
        }

        
        public function finalizeForm($date, $time, $cinemaId,$theaterId,$arrayOfErrors=array()){
            
            try {
                $movieList = $this->getMoviesAvailable($date,$theaterId);
                if(empty($movieList)){
                    throw new Exception("No hay peliculas cargadas", 1);                    
                }
                include_once VIEWS."showChooseMovieCinemasForm.php";
            } catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include_once VIEWS.'menuTemporal.php';			 
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
            else{
                if(is_null($time)){
                    array_push($arrayOfErrors,'La hora no puede ser nula');
                    $this->startForm($arrayOfErrors);
                }
                else{
                    if($this->validateDate($date,$time, $theaterId,$movieId)){
                        $cinemaId = $this->daoTheater->getByID($theaterId)->getId();
                        array_push($arrayOfErrors,'En la fecha y hora elegidas la sala ya emite una pelicula');
                        $this->startForm($arrayOfErrors);
                    }
                    else{
                        $projectionTime = $date." ".$time;
                        $aux = $this->daoShow->getByData(["time" => $projectionTime, "idMovie" => $movieId, "idTheater" =>$theaterId]);
                        if (!empty($aux)) {
                            array_push($arrayOfErrors,"Esa funcion ya fue agregada");
                            $this->listShows($arrayOfErrors);
                        }
                        else{
                            $this->add($projectionTime,$theaterId,$movieId);
                        }   
                    }
                }
            }  
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
                if(empty($genreList)){
                    throw new Exception("No hay generos cargados", 1);                    
                }
                include_once VIEWS."showChooseGenreToFilterForm.php";    
            } catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include_once VIEWS.'menuTemporal.php';			 
            }            
        }

        public function getFilteredShowsByDate($filter)
        {
            try {
                $showList = $this->convertToArray($this->daoShow->getAllByDate($filter));
                $this->showClient($showList);
            } catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS.'footer.php';
            }
        }

        public function getFilteredShowsByGenre($filter)
        {
            try {
                $showList = $this->daoShow->getAllByGenre($filter);
                $this->showClient($showList);
            } catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS.'footer.php';
            }            
        }

        public function showMainView($showList = '')
        {
            $showList = $this->convertToArray($showList);
            include_once VIEWS."showAdminMainView.php";
        }

       
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
                $this->listShows();
            } catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS.'footer.php';
            }
            
        }

        public function chooseShow($movieId){
            try {
                $showList = $this->convertToArray($this->daoShow->getAvailableShowsByMovieId($movieId));                
                $movie = $this->daoMovie->getById($movieId);
                if(empty($showList)){        
                    throw new Exception("No hay funciones disponibles para ".$movie->getName(), 1);
                }
                include_once VIEWS."showClient.php";                
            } catch (Exception $e) {
                $arrayOfErrors [] = $e->getMessage();
                include_once VIEWS.'menuTemporal.php';
                include_once VIEWS.'footer.php';             
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

    
        public function showClient($showList= null){            
            try {
                if(is_null($showList)){
                    $showList = $this->daoShow->getAvailableShows();                                    
                }
                if(empty($showList)){        
                    throw new Exception("No hay funciones disponibles", 1);
                }
                include_once VIEWS."showClient.php";
            } catch (Exception $e) {
                $arrayOfErrors [] = $e->getMessage();
                include_once VIEWS.'menuTemporal.php';
                include_once VIEWS. 'footer.php';
            }
        }


        public function quantitiesAndRemnants(){
            try{                
                $showList = $this->daoShow->getShowsWithTickets();
                if (empty($showList)) {
                    throw new Exception("No hay ninguna funcion cargada", 1);                    
                }
                
                include_once VIEWS.'quantitiesAndRemnants.php';
            }
            catch(Exception $e){
                $arrayOfErrors [] = $e->getMessage();
                include_once VIEWS.'menuTemporal.php';
                include_once VIEWS. 'footer.php';
            }
        }

        public function moneyCollectionCinema(){
            try{
                $cinemaList= $this->convertToArray($this->daoCinema->getAll());
                if (empty($cinemaList)) {                    
                    throw new Exception("No hay ninguna cine cargado", 1);                    
                }
                include_once VIEWS.'selectCinemaForTotal.php';
            }
            catch(Exception $ex){
                $arrayOfErrors [] = $ex->getMessage();
                include_once VIEWS.'menuTemporal.php';
                include_once VIEWS. 'footer.php';
            }
        }

        public function totalAmountByCinema($cinemaId,$firstDate,$lastDate){
            try{
                $theaterList = $this->daoTheater->getByIdCinema($cinemaId);
                if(empty($theaterList)){
                    throw new Exception("No hay salas cargadas en ese cine", 1);                    
                }
                $revenue = $this->daoShow->totalAmountByCinema($cinemaId,$firstDate,$lastDate);
                include_once VIEWS.'showTotalMoney.php';
            }
            catch(Exception $e){
                $arrayOfErrors [] = $e->getMessage();
                include_once VIEWS.'menuTemporal.php';
                include_once VIEWS. 'footer.php';
            }
        }

        public function moneyCollectionMovie(){
            try{
                $movieList= $this->convertToArray($this->daoMovie->getAll());
                if(empty($movieList)){
                    throw new Exception("No hay peliculas cargadas", 1);                    
                }
                include_once VIEWS.'selectMoviesForTotal.php';
            }
            catch(Exception $ex){
                $arrayOfErrors [] = $ex->getMessage();
                 include_once VIEWS.'menuTemporal.php';
                 include_once VIEWS. 'footer.php';
            }
        } 
        
        public function totalAmountByMovie($movieId,$firstDate,$lastDate){
            try{
                $revenue = $this->daoShow->totalAmountByMovie($movieId,$firstDate,$lastDate);
                $a = array();
                array_push($a,$revenue);
                include VIEWS.'showTotalMoney.php';
            }
            catch(Exception $e){
                $arrayOfErrors [] = $e->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';
            }
        }
        
    }
?>

