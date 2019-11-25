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
            $ticket = countSeats($newTicket->getShow()->getId())
            try{
                $query = "INSERT INTO ".$this->tableName." (ticket_number, id_purchase, id_show) 
                VALUES (:ticket_number, :id_purchase, :id_show);";
                $parameters['id_ticket'] = $ticket;
                $parameters['id_purchase'] = $newTicket->getPurchase();
                $parameters['id_show'] = $newTicket->getShow()->getId();

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){
                throw $ex;
            }             
        }
    
        //me rendi intentando hacer funcionar el stored procedure, meti el select que se que funciona
        public function countSeats($id_show){
            try {
                $query= "select 
                            case
                                when tickets.ticket_number is null then 1
                                when tickets.ticket_number>=theatres.capacity then -1
                                else tickets.ticket_number+1
                            end as resultado
                        from
                            theatres left outer join shows on theatres.id_theater = shows.id_theater
                            left outer join tickets on tickets.id_show = shows.id_show
                        where
                            shows.id_show = :id_show";
                $parameters['id_show'] = $id_show;

                $this->connection = Connection::GetInstance();

                return $this->connection->Execute($query, $parameters);
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