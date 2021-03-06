<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/header.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/movieChooseGenreToFilterFormStyle.css">
    <title>Movie Pass</title>
</head>

<body>

    <?php require 'headerSelector.php'; ?>

    <form action="<?php echo FRONT_ROOT ?>movie/filterMovies" method="post">
        <h2>Elija el genero que quiera filtrar</h2>
        
        
            <select name='filteredGenre' class="filteredGenre">
                <?php
                foreach ($genreList as $genre) {  ?>
                    <option value="<?php echo $genre->getApiKey() ?>"> <?php echo $genre->getName() ?></option>
                <?php } ?>
            </select>
                <br>
        <button type="submit" class="boton">
        <span></span> 
        <span></span>   
        <span></span>
        <span></span>
        Filtrar</button>
    </form>
 
   
</body>

</html>