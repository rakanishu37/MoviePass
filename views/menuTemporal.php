<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="<?php echo CSS_PATH ?>/header.css">
    
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="<?php echo FRONT_ROOT?>/views/js/sweetalert.min.js"></script>
    <title>MoviePass</title>
</head>

<style>
  body {
    background: #000000;
  }
</style>

<body>
 
    <?php 
    if($_SESSION['loggedUser']->getStatus()){
      require VIEWS.'headerAdmi.php';
      echo 'sos admin';
    }
    else{
      require VIEWS.'headerUser.php';
      echo 'sos plebe';
    }
    ?>
    

</body>

</html>