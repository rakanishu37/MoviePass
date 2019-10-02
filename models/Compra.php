<?php

namespace models;
include "models/PagoTarjetaCredito";

use models\PagoTarjetaCredito as PagoTarjetaCredito;

class Compra
{
        private $fecha;
        private $cant_Entradas;
        private $descuento;
        private $total;
        private $idCompra;
        //private $pagoTarjetaCredito;

        /**
         * Get the value of fecha
         */
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         */
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;
        }

        /**
         * Get the value of cant_Entradas
         */
        public function getCant_Entradas()
        {
                return $this->cant_Entradas;
        }

        /**
         * Set the value of cant_Entradas
         *
      
         */
        public function setCant_Entradas($cant_Entradas)
        {
                $this->cant_Entradas = $cant_Entradas;
        }

        /**
         * Get the value of total
         */
        public function getTotal()
        {
                return $this->total;
        }

        /**
         * Set the value of total
         *
      
         */
        public function setTotal($total)
        {
                $this->total = $total;
        }

        /**
         * Get the value of descuento
         */
        public function getDescuento()
        {
                return $this->descuento;
        }

        /**
         * Set the value of descuento
         *
      
         */
        public function setDescuento($descuento)
        {
                $this->descuento = $descuento;
        }
}
