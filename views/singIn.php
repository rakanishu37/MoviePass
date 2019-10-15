<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse</title>
    <link rel="stylesheet" type="text/css" href="css/generalStyle.css">
    <link rel="stylesheet" media="screen" href="css/header.css">
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
                  <li><a href="login.php">| Iniciar sesión |</a></li>
                  <li><a href="">| Inicio |</a></li>
                </ul>
          </nav>
        </div>
  </header>
  
     <div class="form">
          <form action="Process/singInController.php" method="post" >
               
                    <label for="userName">Email</label>
                    <br>
                    <input type="email" name="userEmail"  placeholder="Ingresar email" required>
                    <br><br><br>
                    <label for="userPassword">Contraseña</label>
                    <br>
                    <input type="password" name="userPassword"  placeholder="Ingresar constraseña" required>
                    <br><br><br><br>
               <button type="submit">Registrarse!</button>
               <br>
          </form>
     </div>

</body>
</html>