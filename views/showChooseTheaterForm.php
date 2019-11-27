<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showChooseMovieCinemasFormStyle.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">
    <title>Document</title>
</head>

<body>

    <?php include VIEWS.'headerSelector.php'?>
    <form action="<?php echo FRONT_ROOT ?>show/finalizeForm" method="post" class="form">
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
        
        <button type="submit" class="boton">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Continuar</button>
    </form>
</body>

</html>