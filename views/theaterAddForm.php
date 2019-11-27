<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movie Pass</title>
  <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>/generalStyleOfab.css">
  <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/header.css">
  <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/buttomStyle.css">
</head>

<body>

  <?php require 'headerSelector.php'; ?>
	    
  <form class="form" action="<?php echo FRONT_ROOT ?>theater/add" method="post">
  
	<input type="hidden" name="idCinema" value="<?php echo $idCinema; ?>">
	
    <label>Nombre de la sala</label>
    <input type="text" name="name" placeholder="Ingrese el nombre de la sala" required>
	
    <br>
	<label>Precio de la butaca</label>
    <input type="number" min="1" name="seatPrice" required>
	<br>
	
    <label>Capacidad</label>
    <input type="number" min="1" name="capacity" required>
    <br>
	
    <br><br>
    <button type="submit" class="boton">  
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Agregar Sala</button>
      
    </form>


</body>

</html>