<?php
    namespace controllers;

    use dao\DAOGenre as DAOGenre;

    class GenreController
    {   
        private $daoGenre;

        public function __construct()
        {
            $this->daoGenre = new DAOGenre();
        }
        
        public function showGenres(){
            
            echo '<pre>';            
            $this->daoGenre->getAll();
            echo '</pre>';  
            include VIEWS.'footer.php';
        }
    }
?>