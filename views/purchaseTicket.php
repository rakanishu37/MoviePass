<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showAdminMainStyle.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">

    <title>Movie Pass</title>

</head>

<body>

    <?php require 'headerSelector.php'; ?>

    <?php   
        $date = date("Y-m-d"); 
        $time = date("H:i:s");
    ?>

    <form action="<?php echo FRONT_ROOT."purchase/add" ?>" method="post">
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Lugar</th>
            <th>Sala</th>
            <th>Pelicula</th>
            <th>Precio Individual</th>
            <th>¿Cantidad de entradas?</th>
           
            <th></th>
        </tr>
        <tr>
            <td><?php echo $show->getDate(); ?></td>
            <td><?php echo $show->getTime(); ?></td>
            <td><?php echo $show->getTheater()->getCinema()->getName(); ?></td>
            <td><?php echo $show->getTheater()->getName(); ?></td>
            <td><?php echo $show->getMovie()->getName(); ?></td>
            <td>$<?php echo $show->getTheater()->getSeatPrice(); ?></td>
            <input type="hidden" name="date" value="<?php echo $date ?>">
            <input type="hidden" name="time" value="<?php echo $time ?>">
            <input type="hidden" name="idshow" value="<?php echo $idShow ?>">
            <td><input type="number" name="quantityOfTickets" min="1" max="<?php echo $seatsLeft ?>" required></td>
            <td>
            <button type="submit" class="boton"> 
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Comprar</a>
                    </button>
                </td>
               
            </tr>
    </table>

    </form>

</body>

</html>