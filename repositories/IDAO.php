<?php 
namespace repositories;

interface IRepository {

    function add($value);
    function getAll();
    function deleteById($value);

}