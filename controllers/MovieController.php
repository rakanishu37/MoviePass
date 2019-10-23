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
            
            include VIEWS.'showMovies.php';
            
            
        }

        public function chooseGenreForFilter()
        {
           
            $genreList = $this->daoGenre->getAll();
            include VIEWS.'chooseGenre.php';
        }

        private function movieContainsGenre(Movie $movie,$searchedGenre){
            foreach ($movie->getGenre() as $genre) {
                if($genre->getName() == $searchedGenre){
                    return true;
                }
            }
        } 

        public function filterMovies($filteredGenre){
            
            $filter = $filteredGenre;
            $movieListToBeFiltered = $this->daoMovie->getAll();
            
            $movieList = array();
            foreach ($movieListToBeFiltered as $movie) {
                if($this->movieContainsGenre($movie,$filter)){
                    array_push($movieList,$movie);
                }
            }
            include VIEWS.'showMovies.php';
        }
    }
?>