<?php
    namespace dao;
    use models\Genre as Genre;
    
    interface IDAOGenre {

        function add(Genre $value);
        function getAll();
        function deleteById($value);

    }
?>