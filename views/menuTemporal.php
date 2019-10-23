<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ROOT?>views/css/menu.css">
    
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="<?php echo FRONT_ROOT?>/views/js/sweetalert.min.js"></script>
    <title>Menu de testeo</title>
</head>

<body>
<script>
         swal("Good job!", "You clicked the button!", "success");
</script>
    <ul>
        <li>
            <a role="button" href='<?php echo FRONT_ROOT ?>cinema/create'>Dar alta un cine</a>
        </li>
        <li>
            <a role="button" href='<?php echo FRONT_ROOT ?>cinema/showCinemas'>Mostrar Cines</a>
        </li>
        <li>
            <a role="button" href='<?php echo FRONT_ROOT ?>cinema/showCinemasTest'>Ver archivo de cines</a>
        </li>
        <li>
            <a role="button" href='<?php echo FRONT_ROOT ?>cinema/selectCinemaToModify'>Modifcar datos de un cine</a>
        </li>
        <li>
            <a role="button" href='<?php echo FRONT_ROOT ?>cinema/selectCinemaToClose'>Cerrar un cine</a>
        </li>

        <li>
            <a role="button" href='<?php echo FRONT_ROOT ?>movie/showMovies'>Ver peliculas</a>
        </li>
        <li>
            <a role="button" href='<?php echo FRONT_ROOT ?>movie/chooseGenreForFilter'>Filtrar peliculas</a>
        </li>
    </ul>
</body>

</html>