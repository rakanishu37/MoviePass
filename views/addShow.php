<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
</head>
<body>
       <?php $date=date("Y-m-d"); ?>
        <form action="<?php echo FRONT_ROOT?>Show/add" method="post" > 
                <label>Fecha</label>

                <!-- Tengo que sacar esto de aca-->
                <input type="date" name="date" min=<?php date("Y-m-d", strtotime($date. " + 1 days"))?>>
                <br>
                <label>Hora</label>
                <input type="time" name="time">
                <br>
                <!-- Tengo que sacar esto hasta aca-->
                <label>Pelicula</label>
                <select name="movieId" id="">
                <?php foreach($movieList as $movie){?>
                      <option value="<?php echo $movie->getId()?>"><?php echo $movie->getName()?></option>
                <?php }?>
                </select>
                <br>
                <label>Cine</label>
                <select name="cinemaId" id="">
                <?php foreach($cinemaList as $cinema){?>
                      <option value="<?php echo $cinema->getId()?>"><?php echo $cinema->getName()?></option>
                <?php }?>
                </select>
                <br>
                <button type="submit">añadir funcion</button>
        </form> 
</body>
</html>

