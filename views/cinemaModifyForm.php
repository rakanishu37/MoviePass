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
    <form class="form" action="<?php echo FRONT_ROOT ?>cinema/validateDataModify" method="post">
        <input type="hidden" name="id" value="<?php echo $cinemaToModify->getId(); ?>">

        <label>Nombre del cine</label>
        <input type="text" name="name" placeholder="<?php echo $cinemaToModify->getName(); ?>">
        <br>
        <label>Direccion del cine</label>
        <input type="text" name="address" placeholder="<?php echo $cinemaToModify->getAddress(); ?>">
        <br>
        <input type="hidden" name="name_unmodified" value="<?php echo $cinemaToModify->getName(); ?>">

        <input type="hidden" name="address_unmodified" value="<?php echo $cinemaToModify->getAddress(); ?>">

        <label>Estado</label>
        <br>
        <select name="status" id="">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <br><br>
        <button type="submit">Modificar cine</button>

       
    </form>
</body>

</html>