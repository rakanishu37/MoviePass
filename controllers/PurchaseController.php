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
        //private $daoUser;
        private $daoShow;

        public function __construct(){
            $this->daoPurchase = new DAOPurchase();
            $this->daoTicket = new DAOTicket();
            //$this->daoUser = new DAOUser();
            $this->daoShow = new DAOShow();
        }

        public function add($date,$time,$idshow/*,$user*/,$quantityOfTickets){
            try{
                $datePurchase = $date." ".$time;
                $discount = 0;
                $totalamount = $this->daoPurchase->getTotalAmount($quantityOfTickets, $idshow);

                $newPurchase = new Purchase($quantityOfTickets, $totalamount, $datePurchase, $discount);
                $idpurchase = $this->daoPurchase->add($newPurchase);
                $show = $this->daoShow->getByID($idshow);
                $newTicket = new Ticket("",$idpurchase,$show);
                for ($i=0; $i < $quantityOfTickets ; $i++) { 
                    $this->daoTicket->add($newTicket);
                }
            }catch (Exception $e){
                echo $e;
            }
        }
public function getTotalAmount(Type $var = null)
{
    # code...
}
        public function goToTicketQuantitySelection($idShow/*, $user*/){
            $show = $this->daoShow->getByID($idShow);
            try{
                $seatsOccupied = $this->daoTicket->countSeats($idShow);
                $seatsLeft= $show->getTheater()->getCapacity();
                include VIEWS.'purchaseTicket.php';
                } 
            catch (Exception $e) {
                    echo $e;
            }
        }

        private function convertToArray($value){
            $arrayToReturn = array();
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