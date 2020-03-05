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

        public function validateData($date,$time,$idShow,$seatsOccupied,$quantityOfTickets){
            $seats= array();
            try {
                $show = $this->daoShow->getByID($idShow);
                $seatsRemaining = $show->getTheater()->getCapacity() - $seatsOccupied;
                if($quantityOfTickets > $seatsRemaining){
                    throw new Exception("La cantidad de asientos a comprar supera los restantes", 1);
                }

                for ($i=1; $i <= $quantityOfTickets ; $i++) { 
                    $seat = $seatsOccupied + $i;
                    $newTicket = new Ticket($seat,"",$show);
                    if(!empty($this->daoTicket->getByData($newTicket->getNumberTicket(),$idShow))){
                        throw new Exception("Esa compra ya fue ingresada", 1);                        
                    }
                    array_push($seats,$newTicket);
                }
                
                $datePurchase = $date." ".$time;
                
                $this->add($datePurchase,$idShow,$quantityOfTickets,$seats);
            } catch (Exception $e) {
                $arrayOfErrors [] = $e->getMessage();
                include VIEWS."showClient.php";
                include VIEWS."footer.php";
            }            
        }
        
        public function add($datePurchase,$idShow,$quantityOfTickets,$seats){
            $arrayOfErrors = array();
            try{
                if(session_status() !== PHP_SESSION_ACTIVE) session_start();

                if(isset($_SESSION['loggedUser'])){
                    $user = $_SESSION['loggedUser'];
                    $show = $this->daoShow->getByID($idShow);
                    $discount = 0;
                    $nameOfTheDay = date("l",strtotime($datePurchase));
                    $totalAmount = $this->daoPurchase->getTotalAmount($quantityOfTickets, $idShow);

                    if($quantityOfTickets >= 2 && (($nameOfTheDay == "Tuesday" || $nameOfTheDay == "Wednesday"))){                        
                        $discount = $totalAmount * 0.25;
                        $totalAmount = $totalAmount - $discount;                        
                    }
                    $data = [
                        "ticketsQuantity"=> $quantityOfTickets,
                        "show"=> $show,
                        "totalAmount"=> $totalAmount,
                        "discount"=> $discount,
                        "date"=> $datePurchase,
                        "user" => $user,
                        "idPurchase" => ""
                    ];
                    $newPurchase = new Purchase($data);

                    $idpurchase = $this->daoPurchase->add($newPurchase);
                    
                    foreach ($seats as $seat) {
                        $seat->setIdPurchase($idpurchase);
                        $this->daoTicket->add($seat);
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
            try{
                $showList = array();      
                
                $show = $this->daoShow->getByID($idShow);
                
                array_push($showList,$show);
                $seatsOccupied = $this->daoTicket->countSeats($idShow);
                $seatsLeft= $show->getTheater()->getCapacity() - $seatsOccupied;
                include VIEWS.'purchaseTicket.php';
                } 
            catch (Exception $ex) {
                $arrayOfErrors [] = $ex->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS.'footer.php';
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

        public function purchaseRecord()
        {
            try {
                if(isset($_SESSION['loggedUser'])){
                    $user = $_SESSION['loggedUser'];
                    $purchaseList = $this->daoPurchase->getPurchasesMade($user->getId());
                    $purchaseList = $this->convertToArray($purchaseList);
                    if(empty($purchaseList)){
                        throw new Exception("No hay ninguna compra realizada", 1);                        
                    }
                    include VIEWS. 'purchasesMade.php';
                }
                else{
                    throw new Exception("No hay usuario logeado", 1);                
                }
            } catch (Exception $e) {
                $arrayOfErrors [] = $e->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS.'footer.php';
            }
        }
    }

?>

