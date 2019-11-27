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
    
    <?php require 'headerUser.php'; ?>

   
    <table border="1">
        <tr>
            <th>Cantidad de entradas</th>
            <th>Precio total</th>
            <th>Pelicula</th>
            <th>Fecha de compra</th>

        </tr>

        <?php foreach ($purchaseList as $purchase) { ?>
            <tr>
                <td><?php echo $purchase->getQuantityOfTickets(); ?></td>
                <td><?php echo $purchase->getTotalAmount(); ?></td>
                <td>Agregar pelicula acaaaa</td>
                <td><?php echo $purchase->getDatePurchase(); ?></td>
            </tr>
        <?php } ?>
        
    </table>

    

</body>

</html>




