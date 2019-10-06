<?php 
namespace dao;

interface IDAO {

    function add($value);
    function getAll();
    function deleteById($value);

}