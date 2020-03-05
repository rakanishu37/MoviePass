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
		<form class="form" action="<?php echo FRONT_ROOT; ?>/cinema/validateDataModify" method="post">
			<h2>Edite los campos deseados</h2>
			<input type="hidden" name="id" value="<?php echo $cinemaToModify->getId(); ?>">

			<?php echo ($MaterialTextField([
				"name" => "name",
				"title" => "Nombre del Cine",
				"value" => $cinemaToModify->getName(),
				"type" => "text"
			])); ?>
			<?php echo ($MaterialTextField([
				"name" => "address",
				"title" => "Dirección del Cine",
				"value" => $cinemaToModify->getAddress(),
				"type" => "text"
			])); ?>

			<input type="hidden" name="name_unmodified" value="<?php echo $cinemaToModify->getName(); ?>">
			<input type="hidden" name="address_unmodified" value="<?php echo $cinemaToModify->getAddress(); ?>">

			<?php /*echo($MaterialSelectMenu([
				"label" => "Estado",
				"selectedItem" => [
					"value" => "1",
					"item" => "Activo"
				],
				"items" => [
					[
						"value" => "0",
						"item" => "Inactivo"
					]
				]
			])); */?>
			<label>Estado</label>

			<select name="status" id="">
				<option value="1">Activo</option>
				<option value="0">Inactivo</option>
			</select>
			<?php echo ($MaterialSubmitButton([
				"title" => "Modificar cine"
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
