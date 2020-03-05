<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php include(VIEWS . '/materialHeader.php'); ?>
        <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/align-layout.css">
        <title>Movie Pass</title>
    </head>
    <body>
	    <?php require VIEWS . '/appHeader.php' ?>
        <div class="flexbox">
			<?php echo ($MaterialDataTable([
				"columns" => [
					["content" => "Cantidad de entradas"],
					["content" => "Precio total"],
					["content" => "Pelicula"],
					["content" => "Fecha de compra"]
				],
				"rows" => array_map(function ($purchase) {
					//var_dump($purchase->getShow());
					return [
						"data" => [
							["content" => $purchase->getQuantityOfTickets()],
							["content" => '$'.$purchase->getTotalAmount()],
							["content" => $purchase->getShow()->getMovie()->getName()],
							["content" => $purchase->getDatePurchase()],
						]
					];
				}, $purchaseList)
            ])); ?>
        </div>
        <?php include(VIEWS . '/materialFooter.php'); ?>
    </body>
</html>




