<?php
namespace controllers;

    class HomeController
    {
        public function index(){
            echo 'se va a incluir el formulario de agregar cines'.'<br>';
            echo ROOT.'<br>';
            echo FRONT_ROOT.'<br>';
            include VIEWS.'addCinema.php';
        }

        public function metodo($a){
            echo 'vardump de las variables'.'<br>';
            var_dump($a);
        }
    }
    
?>