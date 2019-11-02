<?php 
namespace dao;
use models\Cinema as Cinema;

interface IDAOCinema {

    function add(Cinema $value);
    function update(Cinema $modifiedCinema);
    function getAll();
    function getByID($id);
    function deleteById($value);
    
}
?>