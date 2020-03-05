<?php

namespace models;

class Movie
{
        private $id;
        private $name;
        private $runtime;
        private $language;
        private $genre;
        private $imageURL;

        public function __construct($id = '', $name = '', $runtime = '', $language = '', $genre = '', $imageURL = '') {
                $this->setId($id);
                $this->setName($name);
                $this->setRuntime($runtime);
                $this->setLanguage($language);
                $this->setGenre($genre);
                $this->setImageURL($imageURL);
        }

        public function getGenres()
        {
                $genres = array();
                foreach ($this->getGenre() as $genre) {
                        array_push($genres,$genre->getName().'<br>');
                }
                return join($genres);
        }
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }
        /**
         * Get the value of name
         */
        public function getName()
        {
                return $this->name;
        }

        /**
         * Get the value of runtime
         */
        public function getRuntime()
        {
                return $this->runtime;
        }

        /**
         * Get the value of language
         */
        public function getLanguage()
        {
                return $this->language;
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
         * Set the value of runtime
         */
        public function setRuntime($runtime)
        {
                $this->runtime = $runtime;
        }

        /**
         * Set the value of language
         */
        public function setLanguage($language)
        {
                $this->language = $language;
        }

        /**
         * Set the value of genre
         */
        public function setGenre($genre)
        {
                $this->genre = $genre;
        }

        public function getImageURL()
        {
                return $this->imageURL;
        }
        public function setImageURL($imageURL)
        {
                $this->imageURL = $imageURL;
        }
}
