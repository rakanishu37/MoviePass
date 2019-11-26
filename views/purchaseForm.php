<!-- Desactualizado referice a purchaseTicket (siendo este la version final)-->

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

        <?php require 'headerAdmi.php'; ?>

        <?php   
        $date = date("Y-m-d"); 
        $time = date("H:i:s");
        ?>

        <!--La idea es que venga de el showlist-->
        <form action="<?php echo FRONT_ROOT ?>purchase/add" method="post" class="form">
                <input type="hidden" name="date" value="<?php echo $date ?>">
                <input type="hidden" name="time" value="<?php echo $time ?>">
                <input type="hidden" name="idshow" value="<?php echo $idshow ?>">
                <input type="hidden" name="user" value="<?php echo $user ?>">
                <label>tickets</label>
                <input type="number" name="quantityOfTickets" required min="1", max=<?php echo $seatsleft ?>>
                <br>
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