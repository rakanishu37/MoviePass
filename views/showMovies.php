<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Pass</title>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ROOT ?>views/css/styleShowMovies.css">

</head>

<body>

    <p>Peliculas</p>

    <table border="1">
        <thead class="thead">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Duración</th>
                <th>Idioma</th>
                <th>Genero</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movieList as $movie) { ?>
                <tr>
                    <td><img src="<?php echo API_IMAGE_URL.POSTER_WIDTH_185.$movie->getImageURL(); ?>"></td>
                    <td><?php echo $movie->getName(); ?> </td>
                    <td><?php echo $movie->getRuntime(); ?></td>
                    <td><?php echo $movie->getLanguage(); ?></td->
                    <td>
                        <?php foreach ($movie->getGenre() as $genre) {
                                echo $genre->getName() . '<br>';
                            } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo FRONT_ROOT ?>">
        <button>Volver al menu princial</button> </a>

</body>

</html>