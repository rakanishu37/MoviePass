<?php
    namespace dao;
    
    use models\Movie as Movie;
    
    interface IDAOMovie {

        function add(Movie $value);
        function getAll();
        //function getLatestMovies();

    }
    
?>