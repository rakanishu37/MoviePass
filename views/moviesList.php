<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Movie Pass</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/table-form.css">
</head>

<body>

	<?php require VIEWS . '/appHeader.php' ?>
	
	<div class="form">
		<h2>Peliculas</h2>
		<form action="<?php echo FRONT_ROOT."/show/chooseShow" ?>" method="post">
			<?php echo ($MaterialDataTable([
				"columns" => [
					["content" => "Imagen"],
					["content" => "Nombre"],
					["content" => "Duracion"],
					["content" => "Idioma"],
					["content" => "Genero"],
					["content" => "Entradas"]
				],
				"rows" => array_map(function ($movie) use ($MaterialSubmitButton,$MaterialImage) {
					return [
						"data" => [
							["content" => $MaterialImage([
								"img" => API_IMAGE_URL . POSTER_WIDTH_185 . $movie->getImageURL()  
							])],
							["content" => $movie->getName()],
							["content" => $movie->getRuntime()],
							["content" => $movie->getLanguage()],
							["content" => $movie->getGenres()],
							["content" => $MaterialSubmitButton([
								"title" => "Comprar",
								"name" => "idMovie",
								"value" => $movie->getId(),
								"target" => FRONT_ROOT . "/show/chooseShow"
							])]
						]
					];
				}, $movieList)
			])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
