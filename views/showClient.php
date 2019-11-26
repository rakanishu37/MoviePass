
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showAdminMainStyle.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">

    <title>Movie Pass</title>

</head>

<body>
    
    <?php require 'headerAdmi.php'; ?>

    <form action="<?php echo FRONT_ROOT."Purchase/goToTicketQuantitySelection" ?>" method="post">
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Lugar</th>
            <th>Sala</th>
            <th>Pelicula</th>
            <th>Entradas</th>
           
            <th></th>
        </tr>

        
        <?php foreach ($showList as $show) { ?>
            <tr>
                <td><?php echo $show->getDate(); ?></td>
                <td><?php echo $show->getTime(); ?></td>
                <td><?php echo $show->getTheater()->getCinema()->getName(); ?></td>
                <td><?php echo $show->getTheater()->getName(); ?></td>
                <td><?php echo $show->getMovie()->getName(); ?></td>
                <td>
                    <button name="idShow" type="submit" value="<?php echo $show->getId() ?>" class="boton"> 
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Comprar
                    </button>
                </td>
               
            </tr>
        <?php } ?>
    </table>

    </form>

</body>

</html>




