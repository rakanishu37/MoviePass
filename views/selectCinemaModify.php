<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Elegir cine</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css?family=Lato');

    body,
    html {
        height: 100%;
        background: #222222;
        font-family: 'Lato', sans-serif;
    }

    .container {
        display: block;
        position: relative;
        margin: 40px auto;
        height: auto;
        width: 500px;
        padding: 20px;
    }

    h2 {
        color: #AAAAAA;
    }

    label {
        color: #AAAAAA;
        display: inline;
    }
</style>
<body>
<form action="<?php echo FRONT_ROOT ?>cinema/modify" method="post">
    <div class="container">

        <h2> Elija cine a modificar:</h2>

        <ul>
            <?php foreach ($cinemaList as $cinema) { ?>
                <li>
                    <input type="radio" id="idCinema" name="idCinema" value="<?php echo $cinema->getId(); ?>">
                    <label for="idCinema"><?php echo $cinema->getName(); ?></label>

                </li>
            <?php } ?>
        </ul>
    </div>
    <button type="submit">Enviar</button>
</form>
<br><br>

<a href="<?php echo FRONT_ROOT ?>">
    <button>Volver al menu princial</button> </a>
</body>
</html>