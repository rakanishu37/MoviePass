<?php

    namespace dao\pdo;
    use models\Show as Show;
    use models\Genre as Genre;
    use models\Movie as Movie;
    use \Exception as Exception;
    use dao\pdo\Connection as Connection;
    use dao\pdo\PDOMovie as PDOMovie;
    use dao\pdo\PDOTheater as PDOTheater;
	use dao\pdo\PDOCinema as PDOCinema;
    use interfaces\CRUD as CRUD;

    class PDOShow implements CRUD
    {
        private $connection;
        private $tableName;
        private $cinemaList;

        public function __construct() {
            $this->tableName = 'shows';
        }
        public function add($newShow){
            $query = "INSERT INTO ".$this->tableName." (projection_time, id_movie, id_theater,active) VALUES(:projection_time, :id_movie, :id_theater,:active);";
            $parameters['projection_time'] = $newShow->getProjectionTime();
            $parameters['id_movie'] = $newShow->getMovie()->getId();
            $parameters['id_theater'] = $newShow->getTheater()->getId();
            $parameters['active'] = 1;
            try{
                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $e){
                throw $e;
            }
        }

        /**
         * Updates the cinema attribute "active" to 0
         */
        public function deleteById($id_show){
            try{
                $query = "Update ".$this->tableName. " SET active = :active WHERE id_show = :id_show;";
            
                $parameters['id_show'] = $id_show;
                $parameters['active'] = 0;

                $this->connection = Connection::GetInstance();
                return $this->connection ->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function getByData($data){
            
            $query = 'Select * from '. $this->tableName. ' where projection_time like :projection_time and id_movie = :id_movie and id_theater = :id_theater and active = 1';
            
            /*$parameters['projection_time'] = $data->time . '%';
            $parameters['id_movie'] = $data->idMovie;
            $parameters['id_theater'] = $data->idTheater;*/
            
            
            $parameters['projection_time'] = $data['time'] . '%';
            $parameters['id_movie'] = $data['idMovie'];
            $parameters['id_theater'] = $data['idTheater'];
            
            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $show = $this->parseToObject($resultSet);

                return $show;
            }
            catch(Exception $e){
                throw $e;
            }
        }

        public function getByID($showId){
            $query = 'Select * from '. $this->tableName. ' WHERE id_show = :id_show;';
            
            $parameters['id_show'] = $showId;
            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
    
                $show = $this->parseToObject($resultSet);
    
                return $show;
            }
            catch(Exception $e){
                throw $e;
            }
        }
        
        public function getByIdMovie($idMovie){
            $query = 'Select * from '. $this->tableName. ' WHERE id_movie = :id_movie;';
            
            $parameters['id_movie'] = $idMovie;
            try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
    
                $showList = $this->parseToObject($resultSet);
    
                return $showList;
            }
            catch(Exception $e){
                throw $e;
            }
        }
        public function getAvailableShowsByMovieId($movieId){
            try{
                $query="SELECT
                            shows.id_show as id_show,
                            shows.projection_time as projection_time,
                            shows.id_movie as id_movie,
                            shows.id_theater as id_theater,
                            shows.active as active,
                            sum(theatres.capacity - ticketsdados.bought_tickets) as remanente
                        from
                            shows inner join theatres on shows.id_theater = theatres.id_theater left outer join
                            (SELECT 
                                shows.id_show as id_show,
                                ifnull(count(tickets.id_show),0) as bought_tickets
                            from
                                shows left outer join tickets on shows.id_show = tickets.id_show
                            group by
                                shows.id_show) as ticketsdados on shows.id_show = ticketsdados.id_show
                        where 
                            shows.active = 1 and shows.id_movie = :movieId
                        group by
                            shows.id_show
                        having
                        sum(theatres.capacity - ticketsdados.bought_tickets) > 0
                        order by
                            shows.projection_time asc;";

                $parameters['movieId'] = $movieId;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
            
                return $this->parseToObject($resultSet);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        /*
                $query="SELECT
                            shows.id_show as id_show,
                            shows.projection_time as projection_time,
                            shows.id_movie as id_movie,
                            shows.id_theater as id_theater,
                            shows.active as active,
                            sum(theatres.capacity - ticketsdados.bought_tickets) as remanente
                        from
                            shows inner join theatres on shows.id_theater = theatres.id_theater left outer join
                            (SELECT 
                                shows.id_show as id_show,
                                ifnull(count(tickets.id_show),0) as bought_tickets
                            from
                                shows left outer join tickets on shows.id_show = tickets.id_show
                            group by
                                shows.id_show) as ticketsdados on shows.id_show = ticketsdados.id_show
                        where 
                            shows.active = 1 and projection_time like :projectionTime
                        group by
                            shows.id_show
                        having
                            sum(theatres.capacity - ticketsdados.bought_tickets) > 0
                        order by
                            shows.projection_time asc;";
        */
        public function getAllByDate($date){
            try
            {
                $query="SELECT
                shows.id_show as id_show,
                shows.projection_time as projection_time,
                shows.id_movie as id_movie,
                shows.id_theater as id_theater,
                shows.active as active,
                sum(theatres.capacity - ticketsdados.bought_tickets) as remanente
            from
                shows inner join theatres on shows.id_theater = theatres.id_theater left outer join
                (SELECT 
                    shows.id_show as id_show,
                    ifnull(count(tickets.id_show),0) as bought_tickets
                from
                    shows left outer join tickets on shows.id_show = tickets.id_show
                group by
                    shows.id_show) as ticketsdados on shows.id_show = ticketsdados.id_show
            where 
                shows.active = 1 and shows.projection_time like :projectionTime
            group by
                shows.id_show
            having
                sum(theatres.capacity - ticketsdados.bought_tickets) > 0
            order by
                shows.projection_time asc;";
                $parameters['projectionTime'] = $date.'%';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByIdTheaterDate($idTheater,$date){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id_theater = :id_theater and projection_time like :projectionTime order by projection_time asc;";
                $parameters['projectionTime'] = $date.'%';
                $parameters['id_theater'] = $idTheater;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        

        public function getAllByGenre($genre){
            try
            {
                
                $query = "SELECT shows.id_show as id_show , shows.projection_time as projection_time, shows.id_movie as id_movie, shows.id_theater as id_theater, shows.active as active
                from shows inner join movies_by_genres on shows.id_movie = movies_by_genres.id_movie
                inner join genres on genres.id_genre = movies_by_genres.id_genre
                where genres.id_genre = :id_genre;";
                
                $parameters['id_genre'] = $genre;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                return $this->parseToObject($resultSet);
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

        protected function parseToObject($value) {
			$value = is_array($value) ? $value : [];
            try{
                $resp = array_map(function($p){
                    $daoMovie = new PDOMovie();
                    $daoTheater = new PDOTheater();

                    $movie = $daoMovie->getById($p['id_movie']);
                    $theater = $daoTheater->getByID($p['id_theater']);

                    return new Show($p['projection_time'],$movie,$theater,$p['active'],$p['id_show']);
                }, $value);
                
                return $resp;

            }
            catch(Exception $e){
                throw $e;
            }
        }

        public function getShowsWithTickets(){
            try{
                $query="SELECT 
                            shows.id_show as id_show,
                            shows.projection_time as projection_time,
                            shows.id_movie as id_movie,
                            shows.id_theater as id_theater,
                            shows.active as active,
                            ifnull(count(tickets.id_show),0) as bought_tickets
                        from
                            shows left outer join tickets on shows.id_show = tickets.id_show
                        group by
                            shows.id_show
                        having
                            count(tickets.id_show) >0";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            
                return $this->parseToObjectSpecial($resultSet);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        protected function parseToObjectSpecial($value) {
            $array = array();
            $value = is_array($value) ? $value : [];
            try{
                $resp = array_map(function($p){
                    $daoMovie = new PDOMovie();
                    $daoTheater = new PDOTheater();

                    $movie = $daoMovie->getById($p['id_movie']);
                    $theater = $daoTheater->getByID($p['id_theater']);
                    
                    new Show($p['projection_time'],$movie,$theater,$p['active'],$p['id_show']);
                    $boughttickets=($p['bought_tickets']);
                    
                    $array['show']= new Show($p['projection_time'],$movie,$theater,$p['active'],$p['id_show']);
                    $array['boughttickets'] = $boughttickets;

                    return $array;
                }, $value);
                
                
                return $resp;
            }
            catch(Exception $e){
                throw $e;
            }
        }

        public function getAvailableShows(){
            try{
                $query="SELECT
                            shows.id_show as id_show,
                            shows.projection_time as projection_time,
                            shows.id_movie as id_movie,
                            shows.id_theater as id_theater,
                            shows.active as active,
                            sum(theatres.capacity - ticketsdados.bought_tickets) as remanente
                        from
                            shows inner join theatres on shows.id_theater = theatres.id_theater left outer join
                            (SELECT 
                                shows.id_show as id_show,
                                ifnull(count(tickets.id_show),0) as bought_tickets
                            from
                                shows left outer join tickets on shows.id_show = tickets.id_show
                            group by
                                shows.id_show) as ticketsdados on shows.id_show = ticketsdados.id_show
                        where 
                            shows.active = 1
                        group by
                            shows.id_show
                        having
                            sum(theatres.capacity - ticketsdados.bought_tickets) > 0
                        order by
                            shows.projection_time asc;";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            
                return $this->parseToObject($resultSet);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function totalAmountByCinema($cinemaId,$firstDate,$lastDate)
        {
            $query = 'SELECT
                        A.id_cinema,
                        ifnull(sum(A.theaterRevenue),0) as money
                    from
                        (select 
                            t.id_cinema,t.id_theater, (count(s.id_show) * t.seat_price) as theaterRevenue
                        from 
                            theatres as t inner join shows as s on t.id_theater = s.id_theater
                            left outer join tickets on s.id_show = tickets.id_show
                        where
                             id_cinema = :cinemaId and
                                s.projection_time between :firstDate and :lastDate 
                        group by
                            t.id_theater) A
                    group by
                        A.id_cinema;';
                        
                $parameters['cinemaId'] = $cinemaId;
                $parameters['firstDate'] = $firstDate;
                $parameters['lastDate'] = $lastDate;
            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);

                return $resultSet[0]['money'];
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function totalAmountByMovie($movieId,$firstDate,$lastDate)
        {
            $query = 'SELECT
                            A.id_movie,
                            ifnull(sum(A.money),0) as money
                    from
                            (SELECT 
                                shows.id_show as id_show,
                                shows.projection_time as projection_time,
                                shows.id_movie as id_movie,
                                shows.id_theater as id_theater,
                                ifnull(count(tickets.id_show),0) as bought_tickets,
                                ( ifnull(  count(tickets.id_show)   *    theatres.seat_price,0)) as money
                            from
                                 shows inner join theatres on shows.id_theater = theatres.id_theater
                                left outer join tickets on shows.id_show = tickets.id_show
                                left outer join purchases on tickets.id_purchase = purchases.id_purchase
                            where 
                                shows.id_movie = :movieId  and
                                shows.projection_time between :firstDate and :lastDate
                            group by
                                shows.id_theater) A
                    group by
                            A.id_movie;';
            $parameters['movieId'] = $movieId;
            $parameters['firstDate'] = $firstDate;
            $parameters['lastDate'] = $lastDate;
        
            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
                if(empty($resultSet)){
                    $monto = 0;
                }
                else {
                    $monto = $resultSet[0]['money'];
                }
                return $monto;
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
?>