<?php
    namespace models;
    require "models/Genero.php";

    use models\Genero as Genero;
    class Pelicula
    {
        private $nombre;
        private $duracion;
        private $lenguaje;
        private $imagen;
        private $genero;
        

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Get the value of duracion
         */ 
        public function getDuracion()
        {
                return $this->duracion;
        }

        /**
         * Get the value of lenguaje
         */ 
        public function getLenguaje()
        {
                return $this->lenguaje;
        }

        /**
         * Get the value of imagen
         */ 
        public function getImagen()
        {
                return $this->imagen;
        }

        /**
         * Get the value of genero
         */ 
        public function getGenero()
        {
                return $this->genero;
        }

        

        /**
         * Set the value of nombre

         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;
        }

        /**
         * Set the value of duracion
         *
      
         */ 
        public function setDuracion($duracion)
        {
                $this->duracion = $duracion;

                
        }

        /**
         * Set the value of lenguaje
         *
      
         */ 
        public function setLenguaje($lenguaje)
        {
                $this->lenguaje = $lenguaje;

                
        }

        /**
         * Set the value of imagen
         *
      
         */ 
        public function setImagen($imagen)
        {
                $this->imagen = $imagen;

                
        }

        /**
         * Set the value of genero
         *
      
         */ 
        public function setGenero(Genero $genero)
        {
                $this->genero = $genero;

                
        }
    }   
?>