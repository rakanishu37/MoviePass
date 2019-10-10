<?php
    define('ROOT', str_replace('\\','/',dirname(__DIR__).'/'));

    $a = explode($_SERVER['DOCUMENT_ROOT'],ROOT);
    define('FRONT_ROOT',$a[1]);

    define('VIEWS', ROOT . 'views/');
    define('ADMIN_VIEWS', ROOT . '/views/admin/');
    define('IMG_UPLOADS', ROOT . '/asset/uploads/img/');
    
    
    //capas nos sirve en algun momento
    /* FRONT 
    define('ADMIN_FRONT_ROOT', FRONT_ROOT . '/admin');
    define('CSS_PATH', FRONT_ROOT . '/asset/css');
    define('IMG_PATH', FRONT_ROOT . '/asset/img');
    define('IMG_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/img');
    define('MOV_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/movies');
    */
?>