<?php   
    namespace controllers;

    use models\Movie as Movie;
    use dao\DAOMovie as DAOMovie;
    use dao\DAOGenre as DAOGenre;
    class MovieController
    {
        private $daoMovie;
        private $daoGenre;

        public function __construct()
        {
            $this->daoMovie = new DAOMovie();
            $this->daoGenre = new DAOGenre();
        }

        public function showMovies(){
            
            $movieList = $this->daoMovie->getAll();
            
            echo '<pre>';
            foreach($movieList as $movie){
               
                print_r($movie);
                
            }
            echo '</pre>';  
            
            include VIEWS.'footer.php';
        }

        public function chooseGenreForFilter()
        {
            include VIEWS.'cuerpoBasico.html';
            $genreList = $this->daoGenre->getAll();
            include VIEWS.'chooseGenre.php';
            include VIEWS.'footer.php';
        }

        public function filterMovies(){
            echo 'aca esta lo filtrado';
            $filter = $_POST['filteredGenre'];

            /*
            buscar en las pelis lsa que tengan ese genero meterlos en una lista
             con el mismo nombre que use la vista showMovie

            */
        }
    }
?>