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

{
        private $day;
        private $time;
        private $movie;
        private $cinema;

        /**
         * Get the value of day
         */
        public function getDay()
        {
                return $this->day;
        }

        /**
         * Set the value of day

         */
        public function setDay($day)
        {
                $this->day = $day;
        }

        /**
         * Get the value of time
         */
        public function getTime()
        {
                return $this->time;
        }

        /**
         * Set the value of time

         */
        public function setTime($time)
        {
                $this->time = $time;
        }

        /**
         * Get the value of Movie
         */
        public function getMovie()
        {
                return $this->movie;
        }

        /**
         * Set the value of Movie

         */
        public function setMovie(Movie $movie)
        {
                $this->movie = $movie;
        }

        /**
         * Get the value of Cinema
         */ 
        public function getCinema()
        {
                return $this->cinema;
        }

        /**
         * Set the value of Cinema
         */ 
        public function setCinema(Cinema $cinema)
        {
                $this->cinema = $cinema;
        }
}
