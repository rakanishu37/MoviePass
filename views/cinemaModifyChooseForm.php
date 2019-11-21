<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>/SelectCinemaModify.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/header.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/buttomStyleSelectModify.css">

    <title>MoviePass</title>
</head>

<body>

    <?php require 'headerAdmi.php'; ?>

    <form class="form" action="<?php echo FRONT_ROOT ?>cinema/modify" method="post">
        

            <h2> Elija cine a modificar:</h2>

            <ul>
                <?php foreach ($cinemaList as $cinema) { ?>
                    <li>
                        <input type="radio" id="idCinema" name="idCinema" required value="<?php echo $cinema->getId(); ?>">
                        <label for="idCinema"><?php echo $cinema->getName(); ?></label>
                    </li>
                <?php } ?>
            </ul>
        
        <button type="submit" class="boton">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Enviar</button>
    </form>



</html>