<?php
    namespace models;
    class Genre
    {
        private $name;
        private $api_key;

        public function __construct($name,$api_key)
        {
            setName($name);
            $this->api_key = $api_key;
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

        public function getApiKey()
        {
            return $this->api_key;
        }
    }   
?>