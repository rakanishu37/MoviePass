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
            include VIEWS."cuerpoBasico.html";
            include VIEWS."addCinemaForm.php";

            include VIEWS."footer.php";
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

      
            /*$a=$this->daoCinema->findIndex("c4ca4238a0b923820dcc509a6f75849b");
            echo $a;
            $arreglo = ($this->daoCinema->getAll());
            var_dump($arreglo[$a]);
            */
            //vistas seleccionar y luego ejecutar con un boton?
            //$this->daoCinema->update($cinemaId);

        
        public function selectCinemaToModify()
        {
            include VIEWS."cuerpoBasico.html";
            $cinemaList = $this->daoCinema->getAll();
            include VIEWS.'selectCinemaModify.php';
            include VIEWS."footer.php";
        }

        public function selectCinemaToClose()
        {
            include VIEWS."cuerpoBasico.html";
            $cinemaList = $this->daoCinema->getAll();
            include VIEWS.'selectCinemaClose.php';
            include VIEWS."footer.php";
        }

        
        public function modify(){
            $cinemaID = $_POST['idCinema'];
            $cinema = $this->daoCinema->getByID($cinemaID);
            include VIEWS."cuerpoBasico.html";
            include VIEWS.'modifyCinemaForm.php';
            include VIEWS.'footer.php';
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
            echo '<pre>';
            print_r($cinemaModified);
            echo '</pre>';
            
            $this->daoCinema->update($cinemaModified);
            
            echo '<pre>';
            print_r($this->daoCinema->getByID($_POST['id']));
            echo '</pre>';
            //$this->showCinemas();
        }
        /**
         * Da de baja un cine
         */

        public function closeCinema(){
            $closedCinema = $this->daoCinema->getByID($_POST['idCinema']);

            echo $closedCinema->setStatus(0);
            $this->daoCinema->update($closedCinema);

            $this->showCinemas();
        }


        public function showCinemas()
        {            
            $cinemaList = $this->daoCinema->getAll();
            echo '<pre>';
            foreach($cinemaList as $cinema){
                if($cinema->getStatus() == true){
                    print_r($cinema);
                }
            }
            echo '</pre>';  
            include VIEWS.'footer.php';
            //cargo la lista de cines y luego incluyo una vista que recorra esa lista
        }

        public function showCinemasTest(){
            echo '<pre>';
            var_dump($this->daoCinema->getAll());
            echo '</pre>';  
            include VIEWS.'footer.php';
        }
    }
?>
