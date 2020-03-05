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
	<?php $date = date("Y-m-d"); ?>
	<div class="form">
		<form action="<?php echo FRONT_ROOT; ?>/show/continueForm" method="post" class="form">
			<label>Fecha</label>
			<input type="date" name="date" required min=<?php echo date("Y-m-d", strtotime($date . " + 1 days")) ?>>
			<br>
			<label>Hora</label>
			<input type="time" required name="time">
			<br>

			<label>Cine</label>
			<select name="cinemaId" id="" class="cinemasAvailable">
				<?php foreach ($cinemaList as $cinema) { ?>
					<option value="<?php echo $cinema->getId() ?>"><?php echo $cinema->getName() ?></option>
				<?php } ?>
			</select>
			<br>

			<?php echo ($MaterialSubmitButton([
					"title" => "Continuar"
				])); ?>	
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
