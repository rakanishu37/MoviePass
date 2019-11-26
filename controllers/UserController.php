<?php
    namespace controllers;

    use models\User as User;
    use dao\pdo\PDOUser as DAOUser;
    use \Exception as Exception;
    class UserController{
        private $daoUser;

        public function __construct()
        {
            $this->daoUser = new DAOUser(); 
        }
        public function signin($arrayOfErrors = array())
        {
            include VIEWS.'signIn.php';
            include_once VIEWS.'footer.php';
        }

        public function validateUser($email,$password){
			try{
                if(!empty($this->daoUser->getByEmail($email)))	{
                    throw new Exception("Ese email ya esta siendo usado, ingrese otro");    
                }
                $this->tryLogin($email,$password);
			} 
			catch (Exception $e) {
                array_push($arrayOfErrors,$e->getMessage());
                $this->signin($arrayOfErrors);
			}
             
        }
		
        public function login($arrayOfErrors = array()){
            include VIEWS. 'loginForm.php';
            include VIEWS. 'footer.php';
        }

        public function tryLogin($userEmail, $userPassword){
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            try{
                $user = $this->daoUser->getByEmail($userEmail);

                if($user != null && ($userPassword == $user->getPassword())){
                    $_SESSION["loggedUser"] = $user;

                    include VIEWS."menuTemporal.php";
                }
                else{
                    $arrayOfErrors[] = "Datos incorrectos de logueo";
                    $this->login($arrayOfErrors);
                }
            }
            catch(Exception $e){
                array_push($arrayOfErrors,$e->getMessage());
            }
        }

        public function logout()
        {
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            if(isset($_SESSION['loggedUser'])){
                unset($_SESSION['loggedUser']);
                $arrayOfErrors[] = "Se ha deslogueado con exito!";
                $this->login($arrayOfErrors);
            }
            else{
                $arrayOfErrors[] = "El usuario ya se habia deslogueado";
                $this->login($arrayOfErrors);
            }
        }
	}
?>