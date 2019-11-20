<?php
    namespace dao\pdo;

    use \Exception as Exception;
    use interfaces\CRUD as CRUD;
    use dao\pdo\PDOShow as PDOShow;
    use models\Theater as Theater;
    use models\Show as Show;
    use dao\pdo\Connection as Connection;
    
    class PDOTheater implements CRUD
    {   
        private $connection;
        private $tableName;

        public function __construct() {
            $this->tableName = 'tickets';
        }


        /*
       CREATE TABLE tickets(
        id_ticket int auto_increment,
        ticket_number int, 
        id_purchase int,
        id_show int,
        constraint pk_id_ticket primary key (id_ticket),
        constraint fk_id_purchase_purchases foreign key (id_purchase) references purchases (id_purchase),
        constraint fk_id_show_shows foreign key (id_show) references shows (id_show)
    );
        */
        public function add($newTicket){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (ticket_number, id_purchase, id_show) 
                VALUES (:ticket_number, :id_purchase, :id_show);";
                $parameters['id_ticket'] = $newCinema->getName();
                $parameters['id_purchase'] = $newCinema->getAddress();
                $parameters['id_show'] = $newCinema->getStatus();

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function countSeats($){

        }
    }
    
?>