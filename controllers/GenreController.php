<?php
namespace controllers;

use dao\DAOGenre as DAOGenre;

    class GenreController
    {   

        
        public function getGenreList(){
            return $this->retriveGenreList();
        }

        

?>