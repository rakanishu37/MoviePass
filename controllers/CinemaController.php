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
        public function create()
        {
            include VIEWS."addCinema.php";
        }
        
        public function add()
        {
            if(isset($_POST)){
                $name = $_POST['name'];
                $address = $_POST['address'];
                $capacity = $_POST['capacity'];
                $ticketPrice = $_POST['ticketPrice'];
                $newCinema = new Cinema($name,$address,$capacity,$ticketPrice);
            
                $this->daoCinema->add($newCinema);
            }
            
            $this->showCinemas();
        }

        
        public function selectCinemaToModify()
        {
           
            $cinemaList = $this->daoCinema->getAll();
            include VIEWS.'selectCinemaModify.php';

        }

        public function selectCinemaToClose()
        {
            $activeCinemaList = $this->daoCinema->getAll();
            $cinemaList = array();
            foreach($activeCinemaList as $cinema){
                if($cinema->getStatus() == 1){
                    array_push($cinemaList,$cinema);
                }
            }
           
            include VIEWS.'selectCinemaClose.php';

        }

        
        public function modify(){
            $cinemaID = $_POST['idCinema'];
            $cinema = $this->daoCinema->getByID($cinemaID);

            include VIEWS.'modifyCinemaForm.php';
        }

       public function update(){
            $arrayCheck = array('name','address','capacity','ticketPrice');
            foreach($arrayCheck as $data){
                if(empty($_POST[$data]))
                    $_POST[$data] = $_POST[$data.'_unmodified'];
            }
            $name = $_POST['name'];
            $address = $_POST['address'];
            $capacity = $_POST['capacity'];
            $ticketPrice = $_POST['ticketPrice'];
            $status = $_POST['status'];
            
            $cinemaModified = new Cinema($name,$address,$capacity,$ticketPrice,$status);
            $cinemaModified->setId($_POST['id']);
            
            $this->daoCinema->update($cinemaModified);
            
            $this->showCinemas();
        }
        /**
         * Da de baja logica un cine
         */

        public function closeCinema(){
            $closedCinema = $this->daoCinema->getByID($_POST['idCinema']);

            echo $closedCinema->setStatus(0);
            $this->daoCinema->update($closedCinema);

            $this->showCinemas();
        }


        public function showCinemas()
        {            
            $activeCinemaList = $this->daoCinema->getAll();
            $cinemaList = array();
            foreach($activeCinemaList as $cinema){
                if($cinema->getStatus() == 1){
                    array_push($cinemaList,$cinema);
                }
            }
            include VIEWS.'showCinemas.php';
            
        
        }

        public function showCinemasTest(){
            $cinemaList = $this->daoCinema->getAll();
            include VIEWS.'showCinemas.php';
        }
    }
?>
