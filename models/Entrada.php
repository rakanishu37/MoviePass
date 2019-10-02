<?php

namespace models;

require "models/Funcion.php";
use models\Funcion as Funcion;


class Entrada
{
        private $idCompra;//Para saber de que compra surgio esta entrada
        private $funcion;
        private $nro_entrada;//Lo usamos para saber la capacidad del cine si la supera o no
        private $qr;


        /**
         * Get the value of qr
         */
        public function getQr()
        {
                return $this->qr;
        }

        /**

         */
        public function setQr($qr)
        {
                $this->qr = $qr;
        }

        /**
         * Get the value of nro_entrada
         */
        public function getNro_entrada()
        {
                return $this->nro_entrada;
        }

        /**
         * Set the value of nro_entrada

         */
        public function setNro_entrada($nro_entrada)
        {
                $this->nro_entrada = $nro_entrada;
        }

        /**
         * Get the value of funcion
         */
        public function getFuncion()
        {
                return $this->funcion;
        }

        /**
         * Set the value of funcion
         */
        public function setFuncion(Funcion $funcion)
        {
                $this->funcion = $funcion;
        }
}
