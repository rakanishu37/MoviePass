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

        
    }

?>