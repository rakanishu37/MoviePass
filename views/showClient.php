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
		<form action="<?php echo FRONT_ROOT; ?>/Purchase/goToTicketQuantitySelection"  method="post">
			<?php echo ($MaterialDataTable([
				"columns" => [
					["content" => "Fecha"],
					["content" => "Hora"],
					["content" => "Lugar"],
					["content" => "Sala"],
					["content" => "Pelicula"],
					["content" => "Entradas"]
				],
				"rows" => array_map(function ($show) use ($MaterialSubmitButton) {
					return [
						"data" => [
							["content" => $show->getDate()],
							["content" => $show->getTime()],
							["content" => $show->getTheater()->getCinema()->getName()],
							["content" => $show->getTheater()->getName()],
							["content" => $show->getMovie()->getName()],
							["content" => $MaterialSubmitButton([
								"title" => "Comprar",
								"name" => "idShow",
								"value" => $show->getId()
							])]
						]
					];
				}, $showList)
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
