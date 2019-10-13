<?php 
namespace dao;
use models\Cinema as Cinema;

interface IDAOCinema {

    function add(Cinema $value);
    function getAll();
    function deleteById($value);

}
?>