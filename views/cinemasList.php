<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/align-layout.css">
</head>

<body>
	<?php require VIEWS . '/appHeader.php' ?>
	<?php require VIEWS . '/userFilter.php' ?>
	<div class="flexbox">
		<p>Cines disponibles</p>
		<form action = "<?php echo FRONT_ROOT."/theater/ShowListView"?>" method="post">
			<?php echo ($MaterialDataTable([
				"columns" => [
					["content" => "Nombre"],
					["content" => "Dirección"],
					["content" => "Salas"]
				],
				"rows" => array_map(function ($cinema) use ($MaterialSubmitButton) {
					return [
						"data" => [
							["content" => $cinema->getName()],
							["content" => $cinema->getAddress()],
							["content" => $MaterialSubmitButton([
								"title" => "Ver",
								"name" => "idCinema",
								"value" => $cinema->getId(),
								"target" => FRONT_ROOT . "/theater/ShowListView"
							])]
						]
					];
				}, $cinemaList)
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
