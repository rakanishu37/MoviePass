<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Choose time and date</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/user-form.css">
</head>

<body>

	<?php require VIEWS . '/appHeader.php' ?>
	<div class="form">
		<h2>Elija la fecha a buscar</h2>
		<form action="<?php echo FRONT_ROOT; ?>/show/getFilteredShowsByDate" method="post">
			<!-- <label>Fecha</label> -->
			<input type="date" name="filteredDate" required min=<?php date("Y-m-d") ?>>
			<br>

			<?php echo ($MaterialSubmitButton([
					"title" => "Continuar"
				])); ?>	
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
