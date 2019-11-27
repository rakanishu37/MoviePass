<?php
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    if($_SESSION['loggedUser']->getStatus()){
       require VIEWS.'headerAdmi.php';
    }
    else{
       require VIEWS.'headerUser.php';
    }

?>