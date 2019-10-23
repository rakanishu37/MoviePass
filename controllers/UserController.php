<?php
    namespace controllers;

    use models\User as User;
    use dao\DAOUser as DAOUser;

    class UserController{
        private $DAOUser;

        public function __construct()
        {
            $this->DAOUser = new DAOUser(); 
        }

        public function login($userEmail, $userPassword){
            

            $user = $this->DAOUser->getEmail($userEmail);

            if($user != null && ($pass == $user->getPassword())){
                session_start();
                $logUser = $user;
                $_SESSION["loggedUser"] = $logUser;

                include VIEWS."menuTempral.php";
            }else{
                echo "<script> if(confirm('Datos incorrectos'))</script>";
                include VIEWS."loginForm.php";
            }
                

    }
?>