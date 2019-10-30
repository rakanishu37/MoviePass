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

    <table>
       
       
        <div class="conteiner">
            <tr>
                <?php foreach ($movieList as $movie) { ?>

                        <td><img src="<?php echo API_IMAGE_URL.POSTER_WIDTH_342.$movie->getImageURL(); ?>"></td>
                        <!-- <td><?php echo $movie->getName(); ?> </td>
                        <td><?php echo $movie->getRuntime(); ?></td>
                        <td><?php echo $movie->getLanguage(); ?></td->
                        <td>
                            <?php foreach ($movie->getGenre() as $genre) {
                                    echo $genre->getName() . '<br>';
                                } ?> -->
                        </td>
             
                   
            <?php } ?>
             </tr>
        </div>
       
    </table>
 


</body>

</html>