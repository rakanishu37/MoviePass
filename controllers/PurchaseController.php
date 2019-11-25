<?php
    namespace controllers;

    use models\Purchase as Purchase;
    use dao\pdo\PDOTicket as DAOTicket;
    use dao\pdo\PDOPurchase  as DAOPurchase;
    //use dao\pdo\PDOUser  as DAOUser;
    use dao\pdo\PDOShow  as DAOShow;
    use \Exception as Exception;

    class PurchaseController{

        private $daoTicket;
        private $daoPurchase;
        private $daoUser;
        private $daoShow;

        public function __construct(){
            $this->daoPurchase = new DAOPurchase();
            $this->daoTicket = new DAOTicket();
            $this->daoUser = new DAOUser();
            $this->daoShow = new DAOShow();
        }

        public function add($date,$time,$idshow,$user,$quantityOfTickets){
            try{
                $datePurchase = $date." ".$time;
                $discount = 0;
                $totalamount = getTotalAmount($quantityOfTickets, $idshow)

                $newPurchase = new Purchase($user, $quantityOfTickets, $totalamount, $datePurchase, $discount);
                $idpurchase = $this->daoPurchase->add($newPurchase);
                $show = $this->daoShow->getByID($idshow);
                $newTicket = new Ticket("",$idpurchase,$show,)
                for ($i=0; $i < $quantityOfTickets ; $i++) { 
                    $this->daoTicket->add($newTicket);
                }
            }catch (Exception $e){
                echo $e;
            }
        }

        public function goToTicketQuantitySelection($idShow, $user){
            try{
                $seatsleft = $this->daoTicket->countSeats($idShow)
                include VIEWS.'purchaseForm.php'
                } 
            catch (Exception $e) {
                    echo $e;
            }
        }
    }

?>