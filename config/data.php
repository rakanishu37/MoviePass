<?php
    define('ROOT', str_replace('\\','/',dirname(__DIR__).'/'));

    $a = explode($_SERVER['DOCUMENT_ROOT'],ROOT);
    define('FRONT_ROOT',$a[1]);

    define('VIEWS', ROOT . 'views/');
    define('ADMIN_VIEWS', ROOT . '/views/admin/');
    define('IMG_UPLOADS', ROOT . '/asset/uploads/img/');
    
    define('API_KEY','783ce81a4a4455d3719eb5ca1f039861');

    define('API_IMAGE_URL','https://image.tmdb.org/t/p/');
    define('POSTER_WIDTH_92', "w92");
    define('POSTER_WIDTH_154', "w154");
    define('POSTER_WIDTH_185', "w185");
    define('POSTER_WIDTH_342', "w342");
    define('POSTER_WIDTH_500', "w500");
    define('POSTER_WIDTH_780', "w780");
    define('POSTER_WIDTH_ORIGINAL', "original");
    
      
      
     
      
     

    //capas nos sirve en algun momento
    /* FRONT 
    define('ADMIN_FRONT_ROOT', FRONT_ROOT . '/admin');
    define('CSS_PATH', FRONT_ROOT . '/asset/css');
    define('IMG_PATH', FRONT_ROOT . '/asset/img');
    define('IMG_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/img');
    define('MOV_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/movies');
    */
?>