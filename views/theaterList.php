<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ROOT ?>views/css/theaterListStyle.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/header.css">
</head>

<body>

<?php require 'headerSelector.php'; ?>
    
    <p>Salas</p>

    <form action="<?php echo FRONT_ROOT."theater/ShowAddView"?>" method="post" class="form">
        <table border="1">

            <thead class="thead">
                <tr>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Precio</th>
                    <th>Butacas</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($theaterList as $theater) { ?>
                    <tr>
                        <td><?php echo $theater->getCinema()->getName(); ?> </td>
                        <td><?php echo $theater->getName(); ?> </td>
                        <td><?php echo $theater->getSeatPrice(); ?></td>
                        <td><?php echo $theater->getCapacity(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <button name='idCinema'type="submit" class="boton" value="<?php echo $idCinema?>">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    Agregar Salas</button>
    </form>
                
</body>

</html>