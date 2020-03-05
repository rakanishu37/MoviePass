<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/user-form.css">
	<title>MoviePass</title>
</head>


<body>

	<?php require VIEWS . '/appHeader.php' ?>
	<?php require VIEWS . '/userFilter.php' ?>
	<div class="form">
		<form class="form" action="<?php echo FRONT_ROOT; ?>/cinema/closeCinema" method="post">
			<h2> Elija cine a modificar:</h2>
				<div class="radio-buttons">
					<?php foreach ($cinemaList as $cinema) { ?>
						<?php if ($cinema->getStatus() == 1) { ?>
							<?php echo ($MaterialRadioButton([
								"label" => $cinema->getName(),
								"value" => $cinema->getId(),
								"name" => "idCinema",
								"id" => "idCinema",
								"required" => true
							])); ?>
						<?php } ?>
					<?php } ?>
				</div>
			<?php echo ($MaterialSubmitButton([
				"title" => "Enviar",
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
