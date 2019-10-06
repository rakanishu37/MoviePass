<?php
namespace controllers;

    class HomeController
    {
        public function index(){
            echo 'adentro del index de HomeController'.'<br>';
        }

        public function metodo($a){
            echo 'vardump de las variables'.'<br>';
            var_dump($a);
        }
    }
    
?>