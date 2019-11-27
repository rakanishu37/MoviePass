
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>quiantitiesAndRemnants.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">

    <title>Movie Pass</title>

</head>

<body>

    <?php require 'headerSelector.php'; ?>

    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Lugar</th>
            <th>Sala</th>
            <th>Capacidad</th>
            <th>Precio</th>
            <th>Pelicula</th>
            <th>Cantidades</th>
            <th>Remanentes</th>
           
            <th></th>
        </tr>

        <?php foreach ($showList as $show) { ?>
            <tr>
                <td><?php echo $show['show']->getDate(); ?></td>
                <td><?php echo $show['show']->getTime(); ?></td>
                <td><?php echo $show['show']->getTheater()->getCinema()->getName(); ?></td>
                <td><?php echo $show['show']->getTheater()->getName(); ?></td>
                <td><?php echo $show['show']->getTheater()->getCapacity(); ?></td>
                <td>$<?php echo $show['show']->getTheater()->getSeatPrice(); ?></td>
                <td><?php echo $show['show']->getMovie()->getName(); ?></td>
                <td><?php echo $show['boughttickets']; ?></td>
                <td><?php echo ($show['show']->getTheater()->getCapacity() - $show['boughttickets']); ?></td>
            </tr>
        <?php } ?>
    
    </table>

  

</body>

</html>



