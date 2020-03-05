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
    <div class="flexbox">
        <h2>Menu</h2>
        <?php echo ($MaterialDataTable([
            "columns" => [],
            "rows" => array_map(function ($item) use ($MaterialButtonLink){
                return [
                    "data" => [
                        ["content" => $MaterialButtonLink([
                            "title" => $item['title'],
                            "link" => $item['link']
                            ])
                        ]
                    ]
                ];
            },$menus)
            ])); ?>
    </div>
    <?php include(VIEWS . '/materialFooter.php'); ?>
</body>

</html>