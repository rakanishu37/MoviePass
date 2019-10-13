<?php
namespace controllers;

    class HomeController
    {
        public function index(){
            
            include VIEWS.'menuTemporal.php';
        }

        public function metodo($a){
            echo 'vardump de las variables'.'<br>';
            var_dump($a);
        }
    }
    
?>