<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<?php include(VIEWS . '/materialHeader.php'); ?>
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
	<link rel="stylesheet" href="<?php echo CSS_PATH; ?>/user-form.css">
</head>

<body>

    <?php include VIEWS.'/appHeader.php'?>
    <?php require VIEWS . '/userFilter.php' ?>
    <div class="form">
        <form action="<?php echo FRONT_ROOT; ?>/show/finalizeForm" method="post">
            <input type="hidden" name="date" value="<?php echo $date ?>">
            <input type="hidden" name="time" value="<?php echo $time ?>">
            <input type="hidden" name="cinemaId" value="<?php echo $cinemaId ?>">

            <label>Sala</label>
            <select name="theaterId" id="">
                <?php foreach ($theaterList as $theater) { ?>
                    <option value="<?php echo $theater->getId() ?>"><?php echo $theater->getName() ?></option>
                <?php } ?>
            </select>
            <br>

			<?php echo ($MaterialSubmitButton([
				"title" => "Continuar"
			])); ?>			
		</form>
	</div>
	<?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
