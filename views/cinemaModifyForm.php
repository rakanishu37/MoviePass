<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Pass</title>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ROOT?>views/css/generalStyleOfab.css">

</head>

<body>

    Edite los campos deseados
    <form class="form" action="<?php echo FRONT_ROOT ?>cinema/update" method="post">
        <input type="hidden" name="id" value="<?php echo $cinema->getId(); ?>">

        <label>Nombre del cine</label>
        <input type="text" name="name" placeholder="<?php echo $cinema->getName(); ?>">
        <br>
        <label>Direccion del cine</label>
        <input type="text" name="address" placeholder="<?php echo $cinema->getAddress(); ?>">
        <br>
        <label>Capacidad del cine</label>
        <input type="number" name="capacity" min="1" placeholder="<?php echo $cinema->getCapacity(); ?>">
        <br>
        <label>Precio de la entrada</label>
        <input type="number" name="ticketPrice" min="1" placeholder="<?php echo $cinema->getTicketPrice(); ?>">
        <br>
        <input type="hidden" name="name_unmodified" value="<?php echo $cinema->getName(); ?>">

        
        <input type="hidden" name="address_unmodified" value="<?php echo $cinema->getAddress(); ?>">

        <input type="hidden" name="capacity_unmodified" min="1" value="<?php echo $cinema->getCapacity(); ?>">

        <input type="hidden" name="ticketPrice_unmodified" min="1" value="<?php echo $cinema->getTicketPrice(); ?>">
        <label>Estado</label>
        <br>
        <select name="status" id="">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>


        <br><br>
        <button type="submit">Modificar cine</button>

       
    </form>
    <a href="<?php echo FRONT_ROOT ?>">
    <button>Volver al menu princial</button>  </a>
</body>

</html>