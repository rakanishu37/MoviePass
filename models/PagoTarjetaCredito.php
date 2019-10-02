<?php
    namespace models;
    class PagoTarjetaDeCredito
    {
        private $fecha;
        private $cod_Autentificacion;
        private $total;

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
         * Get the value of cod_Autentificacion
         */ 
        public function getCod_Autentificacion()
        {
                return $this->cod_Autentificacion;
        }

        /**
         * Set the value of cod_Autentificacion
         *
     
         */ 
        public function setCod_Autentificacion($cod_Autentificacion)
        {
                $this->cod_Autentificacion = $cod_Autentificacion;

                
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
    }   
?>