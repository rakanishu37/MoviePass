<?php

namespace models;

require "models/Pelicula.php";
require "models/Cine.php";
use models\Pelicula as Pelicula;
use models\Cine as Cine;


class Funcion

{
        private $dia;
        private $hora;
        private $pelicula;
        private $cine;
        
        /**
         * Get the value of dia
         */
        public function getDia()
        {
                return $this->dia;
        }

        /**
         * Set the value of dia

         */
        public function setDia($dia)
        {
                $this->dia = $dia;
        }

        /**
         * Get the value of hora
         */
        public function getHora()
        {
                return $this->hora;
        }

        /**
         * Set the value of hora

         */
        public function setHora($hora)
        {
                $this->hora = $hora;
        }

        /**
         * Get the value of pelicula
         */
        public function getPelicula()
        {
                return $this->pelicula;
        }

        /**
         * Set the value of pelicula

         */
        public function setPelicula(Pelicula $pelicula)
        {
                $this->pelicula = $pelicula;
        }

        /**
         * Get the value of cine
         */ 
        public function getCine()
        {
                return $this->cine;
        }

        /**
         * Set the value of cine
         */ 
        public function setCine(Cine $cine)
        {
                $this->cine = $cine;
        }
}
