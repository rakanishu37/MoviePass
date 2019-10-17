<?php 
namespace Config;
class Autoload {
     public static function start() {
          spl_autoload_register(function($classNotFound)
          {
			  //echo ROOT.str_replace("\\", "/", $classNotFound)  . ".php";
               // Armo la url de la clase a partir del namespace y la instancia.
               $url = ROOT.str_replace("\\", "/", $classNotFound)  . ".php";

               // Incluyo la url que, si todo esta bien, deberia contener la clase que intento instanciar.
               include_once($url);
          });
     }
}