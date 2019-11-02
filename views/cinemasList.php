<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ROOT?>views/css/styleShowCinemas.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/header.css">
</head>
<body>

    <?php require 'headerAdmi.php'; ?>
    <p>Cines disponibles</p>   

    <table border="1">
        
        <thead class="thead">
        <tr>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Capacidad</th>
        <th>Precio de la entrada</th>
        </tr>
        </thead>

        <tbody>
           <?php foreach($cinemaList as $cinema){?>
                <tr>
                    <td><?php echo $cinema->getName(); ?> </td>
                    <td><?php echo $cinema->getAddress();?></td>
                    <td><?php echo $cinema->getCapacity();?></td->
                    <td>$<?php echo $cinema->getTicketPrice();?></td>
                </tr>
            <?php } ?> 
        </tbody>
    
    </table>

</body>
</html>