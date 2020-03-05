<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use interfaces\CRUD as CRUD;
    use dao\pdo\PDOShow as PDOShow;
    use models\Ticket as Ticket;
    use models\Show as Show;
    use dao\pdo\Connection as Connection;
    
    class PDOTicket implements CRUD
    {   
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'tickets';
        }

        public function add($newTicket){
            //$ticket = countSeats($newTicket->getShow()->getId());
            $query = "INSERT INTO ".$this->tableName." (ticket_number, id_purchase, id_show) 
            VALUES (:ticket_number, :id_purchase, :id_show);";
            $parameters['ticket_number'] = $newTicket->getNumberTicket();
            $parameters['id_purchase'] = $newTicket->getIdPurchase();
            $parameters['id_show'] = $newTicket->getShow()->getId();
            
            try{
                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){
                throw $ex;
            }             
        }
    
        public function getByData($ticket_number,$id_show){
            $query = 'Select * from '. $this->tableName. ' where ticket_number = :ticket_number and id_show = :id_show';

            $parameters['ticket_number'] = $ticket_number;
            $parameters['id_show'] = $id_show;
            
            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $ticket = $this->parseToObject($resultSet);

                return $ticket;
            }
            catch(Exception $e){
                throw $e;
            }
        }
        
        public function countSeats($id_show){
            try {
                $query="SELECT 
                            shows.id_show, 
                            ifnull(count(tickets.ticket_number),1)as resultado
                        FROM
                            shows left outer join tickets on tickets.id_show = shows.id_show
                        WHERE
                            shows.id_show = :id_show;";
                            
                $parameters['id_show'] = $id_show;

                $this->connection = Connection::GetInstance();
                $resultSet=$this->connection->Execute($query, $parameters);
                
                return $resultSet[0]['resultado'];
            }catch(Exception $ex){
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

        protected function parseToObject($value) {
            $value = is_array($value) ? $value : [];
            try {
                $resp = array_map(function($p){
                    $pdoShow = new PDOShow();
                    $c = $pdoShow->getByID($p['id_show']);
                    return new Ticket($p['ticket_number'],$p['id_purchase'],$c,$p['id_ticket']);
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