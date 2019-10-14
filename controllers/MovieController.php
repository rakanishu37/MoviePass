<?php   
    namespace controllers;

    use models\Movie as Movie;
    use dao\DAOMovie as DAOMovie;

    class MovieController
    {
        private $daoMovie;

        public function __construct()
        {
            $this->daoMovie = new DAOMovie();
        }

        public function mostrar(){
            
            $movieList = $this->daoMovie->getAll();
            /*echo '<pre>';
            foreach($movieList as $movie){
               
                print_r($movie);
                
            }
            echo '</pre>';  
            */
            include VIEWS.'footer.php';
        }
    }
?>