<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showChooseMovieCinemasFormStyle.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">
    <title>Movie Pass</title>
</head>

<body>

    <?php include VIEWS . 'headerAdmi.php' ?>

    <form action="<?php echo FRONT_ROOT ?>show/totalAmountByMovie" method="post" class="form">


        <label>Pelicula</label>
        <select name="movieId" id="">
            <?php foreach ($movieList as $movie) { ?>
                <option value="<?php echo $movie->getId() ?>"><?php echo $movie->getName() ?></option>
            <?php } ?>
        </select>
        <br>

        <label>Total vendido entre fechas</label>

        <p>Entre la fecha:</p>
        <input type="date" name="firstDate" class="date" required>

        <p>Y la fecha:</p>
        <input type="date" name="lastDate" class="date" required>
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