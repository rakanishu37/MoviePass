<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css?family=Lato');

    body,
    html {
        height: 100%;
        background: #222222;
        font-family: 'Lato', sans-serif;
    }

    
    h2 {
        color: #AAAAAA;
    }

</style>

<body>



    <form action="<?php echo FRONT_ROOT ?>movie/filterMovies" method="post">
        <h2>Elija el genero que quiera filtrar</h2>
        
        
            <select name='filteredGenre'>
                <?php
                foreach ($genreList as $genre) {  ?>
                    <option value="<?php echo $genre->getName() ?>"> <?php echo $genre->getName() ?></option>
                <?php } ?>
            </select>

        <button type="submit">Filtrar</button>
    </form>
    <br><br>
    <a href="<?php echo FRONT_ROOT ?>">
        <button>Volver al menu princial</button> </a>
</body>

</html>