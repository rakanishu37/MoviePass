<?php

namespace models;


use models\Movie as Movie;
use models\Cinema as Cinema;
use \DateTime as DateTime;
/**
 * La funcion en la cual se proyecta una Movie
 */
class Show
{
        private $showId;
        private $projectionTime;
        private $movie;
        private $theater;
        private $active;
        public function __construct($projectionTime=NULL,$movie, $theater,$active = 1, $showId='')
        {
                $this->setId($showId);
                $this->setProjectionTime($projectionTime);
                $this->setMovie($movie);
                $this->setTheater($theater);
                $this->setStatus($active);
        }
        public function setStatus($active)
        {
                $this->active = $active;
        }

        public function getStatus()
        {
                return $this->active;
        }
        

        public function getProjectionTime()
        {
                return $this->projectionTime->format("Y-m-d H:i");
        }
        
        private function setProjectionTime($projectionTime){
                $this->projectionTime= new DateTime($projectionTime);
        }

        public function getDate(){
                return $this->projectionTime->format("Y-m-d");
        }

        public function getTime(){
                return $this->projectionTime->format("H:i");
        }

        public function getMovie()
        {
                return $this->movie;
        }

        public function setMovie($movie)
        {
                $this->movie = $movie;
        }

        public function getTheater()
        {
                return $this->theater;
        }

        public function setTheater($theater)
        {
                $this->theater = $theater;
        }
        
        public function getId()
        {
                return $this->showId;
        }

        public function setId($id)
        {
                $this->showId = $id;
        }

}
