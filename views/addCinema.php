<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movie Pass</title>
  <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ROOT?>views/css/generalStyleOfab.css"> 
  <link rel="stylesheet" media="screen" href="<?php echo FRONT_ROOT?>views/css/header.css">
</head>

<body>

  <header>
    <div class="contenedor">
      <div class="logo">
        <p>MoviePass</p>
      </div>
      <nav class="menu-fixed">
        <ul>
          <p>MoviePass</p>
          <!--<li><a href="">| Peliculas |</a></li>
                  <li><a href="">| Cines |</a></li>-->
        </ul>
      </nav>
    </div>
  </header>
  
  <form class="form" action="<?php echo FRONT_ROOT ?>cinema/add" method="post">

    <label>Nombre del cine</label>
    <input type="text" name="name" placeholder="Ingresar nombre" required>
    <br>
    <label>Direccion del cine</label>
    <input type="text" name="address" placeholder="Ingresar direccion" required>
    <br>
    <label>Capacidad del cine</label>
    <input type="text" name="capacity" placeholder="Ingresar capacidad" required>
    <br>
    <label>Precio de la entrada</label>
    <input type="text" name="ticketPrice" placeholder="Ingresar precio de entrada" required>
    <br><br>
    <button type="submit">Crear cine</button>
    <br><br>
   
  </form>
    <a href="<?php echo FRONT_ROOT ?>">
    <button>Volver al menu princial</button>  </a>
</body>

</html>