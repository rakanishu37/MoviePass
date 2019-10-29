<?php

namespace models;

require "models/Movie.php";
require "models/Cinema.php";

use models\Movie as Movie;
use models\Cinema as Cinema;

/**
 * La funcion en la cual se proyecta una Movie
 */
class Show

{       /*
        private $day;
        private $time;*/
        private $projectionTime;
        private $movie;
        private $cinema;

        public function __construct($projectionTime=NULL,Movie $movie, Cinema $cinema)
        {
                $this->setProjectionTime($projectionTime);
                $this->setMovie($movie);
                $this->setCinema($cinema);
        }
        public function getProjectionTime()
        {
                return $this->projectionTime;
        }
        
        private function setProjectionTime($projectionTime){
                $this->projectionTime= new DateTime($projectionTime);
        }

        public function getMovie()
        {
                return $this->movie;
        }

        public function setMovie(Movie $movie)
        {
                $this->movie = $movie;
        }

        public function getCinema()
        {
                return $this->cinema;
        }

        public function setCinema(Cinema $cinema)
        {
                $this->cinema = $cinema;
        }
}
