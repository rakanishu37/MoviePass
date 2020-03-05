<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Movie Pass</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/user-form.css">
</head>

<body>

	<?php require VIEWS . '/appHeader.php' ?>
	<?php require VIEWS . '/userFilter.php' ?>

	<div class="form">
		<form class="form" action="<?php echo FRONT_ROOT; ?>/cinema/validateDataAdd" method="post">
			<?php echo ($MaterialTextField([
				"name" => "name",
				"required" => true,
				"title" => "Nombre del Cine",
				"type" => "text"
			])); ?>
			<?php echo ($MaterialTextField([
				"name" => "address",
				"required" => true,
				"title" => "Dirección del Cine",
				"type" => "text"
			])); ?>
			<?php echo ($MaterialSubmitButton([
				"title" => "Crear Cine"
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
