<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/align-layout.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/user-form.css">
</head>

<body>
	<?php require VIEWS . '/appHeader.php' ?>
	<?php require VIEWS . '/userFilter.php' ?>
	<div class="form">
		<form action="<?php echo FRONT_ROOT; ?>/theater/ShowAddView" method="post" class="form">
			<p>Salas del cine <?php echo $cinemaName; ?></p>
			<?php echo ($MaterialDataTable([
				"columns" => [
					["content" => "Sala"],
					["content" => "Precio por butaca"],
					["content" => "Cantidad de butacas"]
				],
				"rows" => array_map(function ($theater) {
					return [
						"data" => [
							["content" => $theater->getName()],
							["content" => $theater->getSeatPrice()],
							["content" => $theater->getCapacity()]
						]
					];
				}, $theaterList)
			])); ?>
			<?php echo ($MaterialSubmitButton([
				"title" => "Agregar Salas",
				"name" => "idCinema",
				"value" => $idCinema
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
