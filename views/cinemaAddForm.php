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

  <form class="form" action="<?php echo FRONT_ROOT ?>cinema/validateDataAdd" method="post">

    <label>Nombre del cine</label>
    <input type="text" name="name" placeholder="<?php echo $placeholderName?>" required>
    <br>
    <label>Direccion del cine</label>
    <input type="text" name="address" placeholder="<?php echo $placeholderAddress?>" required>
    
    <br><br>
    <button type="submit" class="boton">  
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Crear cine</button>
      
    </form>


</body>

</html>