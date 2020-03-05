<?php
if (!$userIsAdmin){
    header("Location: ". FRONT_ROOT);
}