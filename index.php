<?php
    include "autoload.php";

    use models\carpeta1\Genero;


    $var;
    $varVacia = array();
    $num = 5;
    
   $genero = array( new Genero('Horror'),
                    new Genero('Accion'),
                    new Genero('Comedia')
                );
 
   
    
    var_dump(!isset($noExiste) && empty($noExiste));

   
?>