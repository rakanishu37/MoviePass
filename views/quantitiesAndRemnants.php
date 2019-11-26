
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

    <?php require 'headerAdmi.php'; ?>

    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Lugar</th>
            <th>Sala</th>
            <th>Capacidad</th>
            <th>Pelicula</th>
            <th>Cantidades</th>
            <th>Remanentes</th>
           
            <th></th>
        </tr>

        <?php foreach ($showList as $show) { ?>
            <tr>
                <td><?php echo $show->getDate(); ?></td>
                <td><?php echo $show->getTime(); ?></td>
                <td><?php echo $show->getTheater()->getCinema()->getName(); ?></td>
                <td><?php echo $show->getTheater()->getName(); ?></td>
                <td><?php echo  $show->getTheater()->getCapacity(); ?></td>
                <td><?php echo $show->getMovie()->getName(); ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
       
    </table>

  

</body>

</html>



