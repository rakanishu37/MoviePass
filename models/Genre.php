<?php
    namespace models;
    class Genre
    {
        private $name;

        public function __construct($name)
        {
            $this->name = $name;
        }
        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name

         */ 
        public function setName($name)
        {
                $this->name = $name;
        }
    }   
?>