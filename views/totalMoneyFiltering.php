<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>totalMoneyFilteringStyle.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">
    <title>Movie Pass</title>
</head>
<body>
    <?php require 'headerAdmi.php'; ?>

    <form action="<?php echo FRONT_ROOT ?>show/metodo" method="post" class="form">
                <label>Total vendido entre fechas</label>
                
                <p>Entre la fecha:</p>
                <input type="date" name="firstDate" class="date" required min=<?php date("Y-m-d") ?>>

                <p>Y la fecha:</p>
                <input type="date" name="lastDate" class="date" required>
                <br>

                <button name="idMovie" type="submit" value="<?php echo $movie->getId() ?>" class="boton">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Por pelicula</button>

                        <button name="idCinema" type="submit" value="<?php echo $cinema->getId() ?>" class="boton">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Por cine</button>
        </form>
</body>
</html>