<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Movie Pass</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/generalStyles.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/material-customizations.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/user-form.css">
</head>

<body>

    <?php require VIEWS . '/appHeader.php' ?>

    <div class="form">
        <h2>Elija el genero buscado</h2>
        <form action="<?php echo FRONT_ROOT; ?>/show/getFilteredShowsByGenre" method="post">
            <!-- <label>Generos</label> -->
            <select name='filteredGenre' class="filteredGenre">
                <?php
                foreach ($genreList as $genre) {  ?>
                    <option value="<?php echo $genre->getApiKey() ?>"> <?php echo $genre->getName() ?></option>
                <?php } ?>
            </select>
            <br>

            <?php echo ($MaterialSubmitButton([
                    "title" => "Continuar"
                ])); ?>	
        </form>
    </div>
    <?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
