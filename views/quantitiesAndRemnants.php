
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/generalStyles.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/user-form.css">
    <title>Movie Pass</title>

</head>

<body>

    <?php require VIEWS . '/appHeader.php' ?>
	<?php require VIEWS . '/userFilter.php' ?>
    <div class="form">
		<h2>Recuento de Ventas</h2>		
		<?php echo ($MaterialDataTable([
			"columns" => [
				["content" => "Fecha"],
				["content" => "Hora"],
				["content" => "Lugar"],
				["content" => "Sala"],
				["content" => "Capacidad"],
				["content" => "Precio"],
				["content" => "Pelicula"],
				["content" => "Cantidades"],
				["content" => "Remanentes"]
			],
			"rows" => array_map(function ($show) {
				return [
					"data" => [
						["content" => $show['show']->getDate()],
						["content" => $show['show']->getTime()],
						["content" => $show['show']->getTheater()->getCinema()->getName()],
						["content" => $show['show']->getTheater()->getName()],
						["content" => $show['show']->getTheater()->getCapacity()],
						["content" => '$'.$show['show']->getTheater()->getSeatPrice()],
						["content" => $show['show']->getMovie()->getName()],
						["content" => $show['boughttickets']],
						["content" => ($show['show']->getTheater()->getCapacity() - $show['boughttickets'])],
					]
				];
			}, $showList)
		])); ?>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>



