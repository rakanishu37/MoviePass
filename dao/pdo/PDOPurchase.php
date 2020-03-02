<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use interfaces\CRUD as CRUD;
    use dao\pdo\PDOUser as PDOUser;
    use dao\pdo\PDOShow as PDOShow;
    use models\Purchase as Purchase;
    use models\User as User;
    use dao\pdo\Connection as Connection;
    
    class PDOPurchase implements CRUD
    {   
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'purchases';
        }

        public function add($newPurchase){
            try{
                $query = "INSERT INTO ".$this->tableName." (id_user,id_show,quantity_of_tickets,total_amount,date_purchase,discount)
                VALUES
                (:id_user,:id_show, :quantity_of_tickets, :total_amount, :date_purchase, :discount);";
                $parameters['id_user'] = $newPurchase->getUser()->getId();
                $parameters['id_show'] = $newPurchase->getShow()->getId();
                $parameters['quantity_of_tickets'] = $newPurchase->getQuantityOfTickets();
                $parameters['total_amount'] = $newPurchase->getTotalAmount();
                $parameters['date_purchase'] = $newPurchase->getDatePurchase();
                $parameters['discount'] = $newPurchase->getDiscount();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
                return $this->connection->getLastId();
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getTotalAmount($quantityOfTickets, $idshow){
            try
            {
                $query = "SELECT theatres.seat_price FROM theatres inner join shows on theatres.id_theater = shows.id_theater where shows.id_show = :id_show";

                $parameters['id_show'] = $idshow;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                return ($resultSet[0]['seat_price'] * $quantityOfTickets);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getPurchasesMade($idUser)
        {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_user = :id_user";
            $parameters['id_user'] = $idUser;
            try {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        protected function parseToObject($value) {
            $value = is_array($value) ? $value : [];
            try {
                $resp = array_map(function($p){
                    $pdoUser = new PDOUser();
                    $pdoShow = new PDOShow();
                    $c = $pdoUser->getByID($p['id_user']);
                    $s = $pdoShow->getByID($p['id_show']);
                    return new Purchase([
                        "user" => $c,
                        "show" => $s,
                        "ticketsQuantity" => $p['quantity_of_tickets'],
                        "totalAmount" => $p['total_amount'],
                        "date" => $p['date_purchase'],
                        "discount" =>$p['discount'] ,
                        "idPurchase" => $p['id_purchase'],
                    ]);
                }, $value);
                
                return $resp;

            } catch (Exception $e) {
                throw $e;
            }
        }
    }
?>