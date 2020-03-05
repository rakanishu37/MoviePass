<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Registrarse</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/user-form.css">
</head>

<body>
	<?php include(VIEWS . '/appHeader.php'); ?>

	<div class="form">
		<form action="<?php echo FRONT_ROOT ?>/user/validateUser" method="post">
			<?php echo ($MaterialTextField([
				"name" => "userEmail",
				"required" => true,
				"title" => "Correo Electrónico",
				"type" => "email"
			])); ?>
			<?php echo ($MaterialTextField([
				"name" => "userPassword",
				"required" => true,
				"title" => "Contraseña",
				"type" => "password"
			])); ?>
			<?php echo ($MaterialSubmitButton([
				"title" => "Registrarse"
			])); ?>
			<?php echo ($MaterialButtonLink([
				"title" => "Iniciar Sesión",
				"link" => FRONT_ROOT . '/'
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
