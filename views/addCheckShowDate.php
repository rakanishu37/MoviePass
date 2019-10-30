<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT?>Show/getShowsByDate" method="post" > 
                <label>Fecha</label>
                <!-- Asegurar que no cree una funcion el dia de hoy o antes -->
                <input type="date" name="date" min=<?php date("Y-m-d", strtotime($date. " + 1 days"))?>>
                <br>
                <label>Hora</label>
                <input type="time" name="time">
                <button type="submit">añadir funcion</button>
    </form>
</body>
</html>