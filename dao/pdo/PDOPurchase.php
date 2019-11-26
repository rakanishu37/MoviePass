<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use interfaces\CRUD as CRUD;
    use dao\pdo\PDOUser as PDOUser;
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
                $query = "INSERT INTO ".$this->tableName." (id_user,quantity_of_tickets,total_amount,date_purchase,discount)
                VALUES
                (:id_user, :quantity_of_tickets, :total_amount, :date_purchase, :discount);";
                $parameters['id_user'] = $newPurchase->getUser()->getId();
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
                $query = "SELECT theatres.capacity FROM theatres inner join shows on theatres.id_theater = shows.id_theater where shows.id_show = :id_show";

                $parameters['id_show'] = $idshow;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                return ($resultSet[0]['capacity'] * $quantityOfTickets);
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
                    $c = $pdoUser->getByID($p['id_user']);
                    return new Ticket($c,$p['quantity_of_tickets'],$p['total_amount'],$p['date_purchase'],$p['discount']);
                }, $value);
                
                if(empty($resp)){
                    return $resp;
                }
                else {
					
                    return count($resp) > 1 ? $resp : $resp['0'];
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
?>