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

    <?php require 'headerAdmi.php'; ?>
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Lugar</th>
            <th>Sala</th>
            <th>Pelicula</th>
            <th>Status</th>
            <th></th>
        </tr>


        <?php foreach ($showList as $show) { ?>
            <tr>
                <td><?php echo $show->getDate(); ?></td>
                <td><?php echo $show->getTime(); ?></td>
                <td><?php echo $show->getTheater()->getCinema()->getName(); ?></td>
                <td><?php echo $show->getTheater()->getName(); ?></td>
                <td><?php echo $show->getMovie()->getName(); ?></td>
                <td><?php echo ($show->getStatus() == 1)? 'Activa' : 'Cerrada'; ?></td>
                <?php if($show->getStatus() == 1){?>
                    <td><a class="image" href="<?php echo FRONT_ROOT;?>show/deleteById/<?php echo $show->getId(); ?>"> <img src="/Trabajo-Final-Tesis/views/img/tachoDeBasura.jpg"></a></td>
                <?php } ?>
                <!-- Alternativa por si la imagen sigue sin funcionar -->
                <td><a href="<?php echo FRONT_ROOT;?>show/deleteById/<?php echo $show->getId(); ?>">Quitar</a></td>
            </tr>
        <?php } ?>
    </table>



    <a href="<?php echo FRONT_ROOT?>show/startForm" class="add">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Agregar Funcion</a>




</body>

</html>