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
	<?php require VIEWS . '/userFilter.php' ?>
	<div class="form">
		<form class="form" action="<?php echo FRONT_ROOT; ?>/theater/validateData" method="post">
			<input type="hidden" name="idCinema" value="<?php echo $idCinema; ?>">
			<?php echo ($MaterialTextField([
				"name" => "name",
				"required" => true,
				"title" => "Nombre de la Sala",
				"type" => "text"
			])); ?>
			<?php echo ($MaterialTextField([
				"name" => "seatPrice",
				"min" => "1",
				"required" => true,
				"title" => "Precio por butaca",
				"type" => "number"
			])); ?>
			<?php echo ($MaterialTextField([
				"name" => "capacity",
				"min" => "1",
				"required" => true,
				"title" => "Capacidad",
				"type" => "number"
			])); ?>
			<?php echo ($MaterialSubmitButton([
				"title" => "Agregar Sala",
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
