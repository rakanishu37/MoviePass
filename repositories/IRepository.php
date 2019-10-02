<?php 
namespace repositories;

interface IRepository {

    function agregar($value);
    function getAll();
    function borrarPorId($value);

}