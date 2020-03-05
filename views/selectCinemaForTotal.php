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
	<title>Movie Pass</title>
</head>

<body>

	<?php require VIEWS . '/appHeader.php' ?>
	<?php require VIEWS . '/userFilter.php' ?>
	<div class="form">
		<form action="<?php echo FRONT_ROOT; ?>/show/totalAmountByCinema" method="post">
			<h3>Cine</h3>
			<select name="cinemaId" id="" class="cinemasAvailable">
				<?php foreach ($cinemaList as $cinema) { ?>
					<option value="<?php echo $cinema->getId() ?>"><?php echo $cinema->getName() ?></option>
				<?php } ?>
			</select>
			<br>

			<h3>Total vendido entre fechas</h3>

			<p>Entre la fecha:</p>
			<input type="date" name="firstDate" class="date" required>

			<p>Y la fecha:</p>
			<input type="date" name="lastDate" class="date" required>
			<br>

			<?php echo ($MaterialSubmitButton([
				"title" => "Continuar"
			])); ?>			
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
