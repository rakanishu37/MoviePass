<?php
    namespace Daos;

    use Models\Agency as Agency;
    use \Exception as Exception;
    use Daos\Connection as Connection;

    class DAOAgency implements IDAOAgency{

        private $connection;
        private $tableName;

        public function __construct(){
            $this->tableName = 'agencies';
        }
        //dar de alta
        public function add(Agency $newAgency){
            try{
                $query = "INSERT INTO ".$this->tableName."
                (agency_name, licency, agency_password, adress, telephone) 
                    VALUES
                (:agency_name, :licency, :agency_password, :adress, :telephone);";
                $parameters['agency_name'] = $newAgency->getName();
                $parameters['licency'] = $newAgency->getLicency();
                $parameters['agency_password'] = $newAgency->getPassword();
                $parameters['adress'] = $newAgency->getAdress();
                $parameters['telephone'] = $newAgency->getTelephone()

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $e){
                throw $e;
            }
        }

        //Para traer la agencia por la licencia
        public function getByLicency($licency){
            try{
                $query = 'SELECT * FROM '. $this->tableName. ' WHERE licency = :licency;'

                $parameters['licency'] = $licency;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $Agency = $this->parseToObject($resultSet);

                return $Agency;

            }catch(Exception $ex){
                throw $ex;
            }
        }
    }
?>