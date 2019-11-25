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

    Router::route(new Request());    
?>
<!-- para preguntar si la session ya esta iniciada
if(session_status() !== PHP_SESSION_ACTIVE) session_start(); -->
<!--
    try{
        logica
    }
    catch{
        lo agrega a un array
    }
    finally{        
        incluye la vista
    }
---
---
--- -->