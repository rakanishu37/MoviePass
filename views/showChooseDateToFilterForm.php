<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showChooseDateToFilterStyle.css">
        <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">
        <title>Choose time and date</title>
</head>

<body>

        <?php require 'headerAdmi.php'; ?>
        
        <form action="<?php echo FRONT_ROOT ?>show/getFilteredShowsByDate" method="post" class="form">
                <label>Fecha</label>
                <!-- Asegurar que no cree una funcion el dia de hoy o antes -->
                <input type="date" name="filteredDate" required min=<?php date("Y-m-d") ?>>
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