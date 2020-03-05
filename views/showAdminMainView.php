<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/align-layout.css">
	<title>Movie Pass</title>

</head>

<body>
	<?php require VIEWS . '/appHeader.php' ?>
	<?php require VIEWS . '/userFilter.php' ?>
	<div class="flexbox">
		<?php echo ($MaterialDataTable([
			"columns" => [
				["content" => "Fecha"],
				["content" => "Hora"],
				["content" => "Lugar"],
				["content" => "Sala"],
				["content" => "Pelicula"],
				["content" => "Status"],
				["content" => "Acciones"]
			],
			"rows" => array_map(function ($show) use ($MaterialIconButton) {
				return [
					"data" => [
						["content" => $show->getDate()],
						["content" => $show->getTime()],
						["content" => $show->getTheater()->getCinema()->getName()],
						["content" => $show->getTheater()->getName()],
						["content" => $show->getMovie()->getName()],
						["content" => ($show->getStatus() == 1) ? 'Activa' : 'Cerrada'],
						["content" => ($show->getStatus() == 1) ? $MaterialIconButton([
							"label" => "Borrar",
							"icon" => "delete",
							"target" => FRONT_ROOT . "/show/deleteById/" . $show->getId()
						]) : '']
					]
				];
			}, $showList)
		])); ?>

		<?php echo ($MaterialButtonLink([
			"link" => FRONT_ROOT . '/show/startForm',
			"title" => "Agregar Función",
			"raised" => true
		])); ?>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
