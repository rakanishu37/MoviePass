<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Moviepass</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/user-form.css">
</head>

<body>

    <?php include VIEWS.'/appHeader.php'?>
    <?php require VIEWS . '/userFilter.php' ?>
    <div class="form">
        <form action="<?php echo FRONT_ROOT; ?>/show/validateData" method="post">
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

			<?php echo ($MaterialSubmitButton([
				"title" => "Continuar"
			])); ?>			
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
