<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>showTotalMoney.css">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>header.css">
    <title>Movie Pass</title>
</head>

<body>

    <?php include VIEWS.'headerSelector.php'?>

   
        
        <table >

                <tr>
                   <th>Cantidad total de dinero:</th>
                </tr>

                <tr>
                    <td>$<?php echo $revenue?></td>
                </tr>
        
           
        
        </table>

</body>

</html>