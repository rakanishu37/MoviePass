<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>SelectCinema.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>buttomStyle.css">
    
    <title>MoviePass</title>
</head>


<body>

  <?php require 'headerAdmi.php'; ?>

    <form class="form" action="<?php echo FRONT_ROOT ?>cinema/closeCinema" method="post">
        
      <h2> Elija cine a cerrar:</h2>
      <div class="container">
            
            <ul>
                <?php foreach ($cinemaList as $cinema) { ?>
                    <?php if ($cinema->getStatus() == true)  ?>
                    <li class="radio-button">
                        <input type="radio" id="f-option" name="idCinema" value="<?php echo $cinema->getId(); ?>">
                        <label for="f-option"><?php echo $cinema->getName(); ?></label>

                    </li>
                <?php } ?>
            </ul>
        </div>


        <button type="submit" class="boton">  
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Cerrar cine</button>
    </form>
  
</body>

</html>