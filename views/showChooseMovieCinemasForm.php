<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showChooseMovieCinemasFormStyle.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">
    <title>Document</title>
</head>

<body>

    <?php include VIEWS.'headerSelector.php'?>
    <form action="<?php echo FRONT_ROOT ?>show/validateData" method="post" class="form">
        <input type="hidden" name="date" value="<?php echo $date ?>">
        <input type="hidden" name="time" value="<?php echo $time ?>">
        <input type="hidden" name="theaterId" value="<?php echo $theaterId ?>">
        
        <label>Pelicula</label>
        <select name="movieId" id="">
            <?php foreach ($movieList as $movie) { ?>
                <option value="<?php echo $movie->getId() ?>"><?php echo $movie->getName() ?></option>
            <?php } ?>
        </select>
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