<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Movie Pass</title>
    <?php include(VIEWS . '/materialHeader.php'); ?>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/generalStyles.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/material-customizations.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/align-layout.css">
</head>

<body>

    <?php include VIEWS.'/appHeader.php'?>
    <?php require VIEWS . '/userFilter.php' ?>
    <div class="flexbox">
        <?php echo ($MaterialDataTable([
                    "columns" => [
                        ["content" => "Cantidad total de dinero:"]
                    ],
                    "rows" => array_map(function ($revenue) {
                        return [
                            "data" => [
                                ["content" => '$'.$revenue]
                            ]
                        ];
                    },$a)
                ])); ?>
    </div>
    <?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>
