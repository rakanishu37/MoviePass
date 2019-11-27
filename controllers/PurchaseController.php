<?php
    namespace controllers;

    use models\Purchase as Purchase;
    use models\Ticket as Ticket;
    use dao\pdo\PDOTicket as DAOTicket;
    use dao\pdo\PDOPurchase  as DAOPurchase;
    use dao\pdo\PDOUser  as DAOUser;
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

        public function add($date,$time,$idShow,$quantityOfTickets){
            $arrayOfErrors = array();
            try{
                if(session_status() !== PHP_SESSION_ACTIVE) session_start();

                if(isset($_SESSION['loggedUser'])){
                    $user = $_SESSION['loggedUser'];
                 
                    $datePurchase = $date." ".$time;
                    $discount = 0;
                    $totalamount = $this->daoPurchase->getTotalAmount($quantityOfTickets, $idShow);
                    $newPurchase = new Purchase($quantityOfTickets, $totalamount, $datePurchase, $discount,$user);
                    $idpurchase = $this->daoPurchase->add($newPurchase);
                    
                    $show = $this->daoShow->getByID($idShow);
                    $j = $this->daoTicket->countSeats($idShow);
                    
                    for ($i=1; $i <= $quantityOfTickets ; $i++) { 
                        $seat = $j+$i;
                        $newTicket = new Ticket($seat,$idpurchase,$show);
                        $this->daoTicket->add($newTicket);
                    }

                    array_push($arrayOfErrors,'Compra realizad con exito');
                }else{
                    array_push($arrayOfErrors,'ERROR: No se pudo realizar la compra');

                }
            }catch (Exception $e){

                array_push($arrayOfErrors,$e->getMessage());
            }
            finally{
                include VIEWS.'menuTemporal.php';
                include VIEWS.'footer.php';
            }
        }

        
        public function goToTicketQuantitySelection($idShow){
            $show = $this->daoShow->getByID($idShow);
            
            try{
                $seatsOccupied = $this->daoTicket->countSeats($idShow);
                $seatsLeft= $show->getTheater()->getCapacity() - $seatsOccupied;
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