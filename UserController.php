<?php
    namespace Controllers;

    use Models\Agency as Agency;
    use Daos\DAOAgency as DAOAgency;
    use \Exception as Exception;

    class AgencyController{
        private $DAOAgency;

        public function __construct()
        {
            $this->DAOAgency = new DAOAgency(); 
        }

        public function login($agencyLicency, $agencyPassword){
            

            $agency = $this->DAOAgency->getLicency($agencyLicency);

            if($agency != null && ($agencyPassword == $agency->getPassword())){
                session_start();
                $logAgency = $agency;
                $_SESSION["loggedAgency"] = $logAgency;

                include VIEWS."main.php";
            }else{
                //echo "<script> if(confirm('Datos incorrectos'))</script>";
                include VIEWS."main.php";
            }  
        }

        public function registerAgency($name, $licency, $password, $adress, $telephone){
            $newAgency = new Agency;
            $newAgency->setName($name);
            $newAgency->setLicency($licency);
            $newAgency->setPassword($password);
            $newAgency->setAdress($adress);
            $newAgency->setTelephone($telephone);
            try{
                $this->DAOAgency->add($newAgency);
                include VIEWS."flightList.php"
            }catch (Exception $ex){
                echo $ex;
            }    
        }
    }
?>