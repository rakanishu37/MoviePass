<?php

namespace models;

require "models/Genre.php";

use models\Genre as Genre;

class Movie
{
        private $name;
        private $runningTime;
        private $language;
        private $image;
        private $genre;


        /**
         * Get the value of name
         */
        public function getName()
        {
                return $this->name;
        }

        /**
         * Get the value of runningTime
         */
        public function getRunningTime()
        {
                return $this->runningTime;
        }

        /**
         * Get the value of language
         */
        public function getLanguage()
        {
                return $this->language;
        }

        /**
         * Get the value of image
         */
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Get the value of genre
         */
        public function getGenre()
        {
                return $this->genre;
        }



        /**
         * Set the value of name

         */
        public function setName($name)
        {
                $this->name = $name;
        }

        /**
         * Set the value of runningTime
         *
      
         */
        public function setrunningTime($runningTime)
        {
                $this->runningTime = $runningTime;
        }

        /**
         * Set the value of language
         *
      
         */
        public function setLanguage($language)
        {
                $this->language = $language;
        }

        /**
         * Set the value of image
         *
      
         */
        public function setImage($image)
        {
                $this->image = $image;
        }

        /**
         * Set the value of genre
         *
      
         */
        public function setGenre(Genre $genre)
        {
                $this->genre = $genre;
        }
}
