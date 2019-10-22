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
//programacion defensiva (validaciones en todos lados practicamente)
//validaciones en capa de negocio controller y model para el tp
    //modulariza los llamados a la api
//exceptions con try catch
//controlar que no se repitan los nombres
//variab de mensaje de error elevarlo a la lvista
    //hacer dao con pdo
//funciones fecha movie
    Router::route(new Request());    
?>
