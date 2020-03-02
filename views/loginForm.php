<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Iniciar Sesión</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<?php include(VIEWS . '/materialComponents.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/FlorCss/user-form.css">
</head>

<body>
	<?php include(VIEWS . '/appHeader.php'); ?>
	<div class="form">
		<form action="<?php echo FRONT_ROOT ?>/user/tryLogin" method="post">
			<?php echo ($MaterialTextField([
				"name" => "username",
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
				"title" => "Iniciar Sesión"
			])); ?>
			<?php echo ($MaterialButtonLink([
				"link" => FRONT_ROOT . '/user/signup',
				"title" => "Registrarse"
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
