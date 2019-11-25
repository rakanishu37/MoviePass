<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Pass</title>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ROOT ?>views/css/styleShowMovies.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/header.css">

</head>

<body>

    <?php require 'headerAdmi.php'; ?>

    <p>Peliculas</p>

    <form action="<?php echo FRONT_ROOT."Movies/función para comprar tickets" ?>" method="post">
    <table border="1">
        <thead class="thead">

        
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Duracion</th>
                    <th>Idioma</th>
                    <th>Genero</th>
                    <th>Entradas</th>
                </tr>
        </thead>
        <tbody>
            <?php foreach ($movieList as $movie) { ?>
                <tr>
                    <td id="imagen"><img src="<?php echo API_IMAGE_URL . POSTER_WIDTH_185 . $movie->getImageURL(); ?>"></td>
                    <td><?php echo $movie->getName(); ?> </td>
                    <td><?php echo $movie->getRuntime(); ?></td>
                    <td><?php echo $movie->getLanguage(); ?></td>
                    <td>
                        <?php foreach ($movie->getGenre() as $genre) {
                                echo $genre->getName() . '<br>';
                            } ?>
                    </td>
                    <td>
                         <button name="idMovie" type="submit" value="<?php echo $movie->getId() ?>" class="boton"> 
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Comprar</a>
                            </button>
                        </td>
                  
                </tr>
            <?php } ?>
        </tbody>

    </table>

      </form>
 

 
</body>

</html>