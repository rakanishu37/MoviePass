<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/table-form.css">
    <title>Movie Pass</title>

</head>

<body>
    
    <?php require VIEWS . '/appHeader.php' ?>
    
    <?php
        $date = date("Y-m-d");
        $time = date("H:i:s");
    ?>

<div class="form">
    <form action="<?php echo FRONT_ROOT; ?>/purchase/validateData" method="post">
        <?php echo ($MaterialDataTable([
            "columns" => [
                ["content" => "Fecha"],
                ["content" => "Hora"],
                ["content" => "Lugar"],
                ["content" => "Sala"],
                ["content" => "Pelicula"],
                ["content" => "Precio Individual"]
            ],
            "rows" => array_map(function ($show){
                return [
                    "data" => [
                        ["content" => $show->getDate()],
                        ["content" => $show->getTime()],
                        ["content" => $show->getTheater()->getCinema()->getName()],
                        ["content" => $show->getTheater()->getName()],
                        ["content" => $show->getMovie()->getName()],
                        ["content" => '$' . $show->getTheater()->getSeatPrice()]
                        ]
                    ];
                }, $showList)
                ])); 
        ?>
        <input type="hidden" name="date" value="<?php echo $date ?>">
        <input type="hidden" name="time" value="<?php echo $time ?>">
        <input type="hidden" name="idshow" value="<?php echo $idShow ?>">
        <input type="hidden" name="seatsOccupied" value="<?php echo $seatsOccupied?>">
        <h3>¿Cantidad de entradas?</h3>
        <input type="number" name="quantityOfTickets" min="1" max="<?php echo $seatsLeft ?>" required>
        <br><br>

        <?php echo ($MaterialSubmitButton([
            "title" => "Comprar",
            ])); ?>
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
