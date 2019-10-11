<?php 
namespace dao;
use models\Cinema as Cinema

interface IDAO {

    function add(Cinema $value);
    function getAll();
    function deleteById($value);

}
?>