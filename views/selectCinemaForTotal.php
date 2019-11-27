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

      
        <form action="<?php echo FRONT_ROOT ?>show/totalAmountByCinema" method="post" class="form">
                <label>Cine</label>
                <select name="cinemaId" id="" class="cinemasAvailable">
                <?php foreach ($cinemaList as $cinema) { ?>
                        <option value="<?php echo $cinema->getId() ?>"><?php echo $cinema->getName() ?></option>
                <?php } ?>
                </select>
                <br>
        
                <label>Total vendido entre fechas</label>
                
                <p>Entre la fecha:</p>
                <input type="date" name="firstDate" class="date" required>

                <p>Y la fecha:</p>
                <input type="date" name="lastDate" class="date" required>
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