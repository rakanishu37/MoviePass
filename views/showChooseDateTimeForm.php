<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showChooseDateTimeFormStyle.css">
        <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">

        <title>Movie Pass</title>
</head>

<body>

        <?php require 'headerSelector.php'; ?>

        <?php $date = date("Y-m-d"); ?>
        <form action="<?php echo FRONT_ROOT ?>show/continueForm" method="post" class="form">
                <label>Fecha</label>
                <!-- Asegurar que no cree una funcion el dia de hoy o antes -->
                <input type="date" name="date" required min=<?php echo date("Y-m-d", strtotime($date . " + 1 days")) ?>>
                <br>
                <label>Hora</label>
                <input type="time" required name="time">
                <br>
				

                <label>Cine</label>
                <select name="cinemaId" id="" class="cinemasAvailable">
                <?php foreach ($cinemaList as $cinema) { ?>
                        <option value="<?php echo $cinema->getId() ?>"><?php echo $cinema->getName() ?></option>
                <?php } ?>
                </select>
                <br>
				
                <button type="submit" class="boton">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Continuar</button>
        </form>
</body>

</html>