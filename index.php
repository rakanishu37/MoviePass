<?php
    /*include "config/data.php";
    include "config/Autoload.php";
    use Config\Autoload as Autoload;

    Autoload::start();

    use controllers\GenreController as generoCon;
    echo '<pre>';
    generoCon::getGenreList();
    echo '</pre>';
    */
    
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    require "config/Autoload.php";
    require "config/data.php";

    use Config\Autoload as Autoload;
    use config\Request as Request;
    use config\Router as Router;
    
    Autoload::start();

    session_start();

    //sacarlos y dejar que cada controladora incluya las vistas que sean necesarias
    //require_once(VIEWS.'header.php');
    
    Router::route(new Request());

    //require_once(VIEWS.'footer.php');
    
?>
