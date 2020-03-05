<?php
    namespace controllers;
    use models\Genre as Genre;
    //use dao\json\DAOGenre as DAOGenre;
    use dao\pdo\PDOGenre as DAOGenre;
    use \Exception as Exception;
    class GenreController
    {
        private $daoGenre;

        public function __construct()
        {
            $this->daoGenre = new DAOGenre();
        }

        public function showGenres(){
            include VIEWS . '/appHeader.php';
            try {
                $genreList = $this->daoGenre->getAll();
            } catch (Exception $e) {
                $arrayOfErrors [] = $ex->getMessage();
                include VIEWS.'menuTemporal.php';
                include VIEWS. 'footer.php';;
            }

            echo '<pre>';
            print_r($genreList);
            echo '</pre>';

        }
    }
?>
