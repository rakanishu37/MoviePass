<?php
    namespace controllers;

    use models\User as User;
    use dao\DAOUser as DAOUser;

    class UserController{

        public function login(){
            if($_POST){
                if(isset($_POST["email"]) && isset($_POST["password"])){
                    $email = $_POST["email"];
                    $pass = $_POST["password"];

                    $DAOUser = new DAOUser();
                    $user = $DAOUser->getEmail(email);

                    if($user != null && ($pass == $user->getPassword())){
                        session_start();
                        $logUser = $user;
                        $_SESSION["loggedUser"] = $logUser;

                        include VIEWS."menuTempral.php";
                    }else{
                        echo "<script> if(confirm('Datos incorrectos'))</script>";
                        include VIEWS."loginForm.php";
                    }
                }else{
                    echo "<script> if(confirm('ubo un problema al procesar los datos'))</script>";
                    include VIEWS."loginForm.php";
                }
            }else{
                echo "<script> if(confirm('Error en el Method'))</script>";
                include VIEWS."loginForm.php";
            }
        }        

    }
?>