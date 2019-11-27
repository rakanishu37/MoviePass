<?php

namespace controllers;

use models\Movie as Movie;
// use dao\json\DAOMovie as DAOMovie;
use dao\pdo\PDOMovie as DAOMovie;
// use dao\json\DAOGenre as DAOGenre;
use dao\pdo\PDOGenre  as DAOGenre;
use \Exception as Exception;

class MovieController
{
    private $daoMovie;
    private $daoGenre;

    public function __construct()
    {
        $this->daoMovie = new DAOMovie();
        $this->daoGenre = new DAOGenre();
    }

    public function showMovies()
    {
        try {
            $this->daoMovie->updateLatestMovies();
            $movieList = $this->daoMovie->getLatestMovies();

            include VIEWS . 'moviesList.php';
        } catch (Exception $ex) {
            $arrayOfErrors[] = $ex->getMessage;
            include VIEWS . 'menuTemporal.php';
            include VIEWS . 'footer.php';
        }
    }

    public function chooseGenreForFilter()
    {
        try {
            $genreList = $this->daoGenre->getAll();
            include VIEWS . 'movieChooseGenreToFilterForm.php';
        } catch (Exception $ex) {
            $arrayOfErrors[] = $ex->getMessage;
            include VIEWS . 'menuTemporal.php';
            include VIEWS . 'footer.php';
        }
    }

    private function movieContainsGenre($movie, $searchedGenre)
    {
        foreach ($movie->getGenre() as $genre) {
            if ($genre->getApiKey() == $searchedGenre) {
                return true;
            }
        }
    }

    public function filterMovies($filteredGenre)
    {
        $filter = $filteredGenre;
        try {
            $movieListToBeFiltered = $this->daoMovie->getLatestMovies();

            $movieList = array();
            foreach ($movieListToBeFiltered as $movie) {
                if ($this->movieContainsGenre($movie, $filter)) {

                    array_push($movieList, $movie);
                }
            }
            include VIEWS . 'moviesList.php';
        } catch (Exception $ex) {
            $arrayOfErrors[] = $ex->getMessage;
            include VIEWS . 'menuTemporal.php';
            include VIEWS . 'footer.php';
        }
    }
}
?>