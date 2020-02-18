<?php
    namespace controllers;

    use models\Ticket as Ticket;
    use dao\pdo\PDOTicket as DAOTicket;
    use dao\pdo\PDOShow  as DAOShow;
    use \Exception as Exception;

    class TicketController{

        private $daoTicket;
        private $daoShow;

        public function __construct(){
            $this->daoTicket = new DAOTicket();
            $this->daoShow = new DAOShow();
        }

        public function add($numberTicket,$idPurchase,$idShow,$qr =''){
            try{
                $show = $this->daoShow->getByID($idShow);
                // faltaria el de purchase
                $newTicket = new Ticket($numberTicket,$idPurchase,$show,$qr);
                $this->daoTicket->add($newTicket);
            } 
            catch (Exception $e) {
                $arrayOfErrors [] = $e->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';
            }
           
            //$this->showListView($idCinema);
        }
    }

?>