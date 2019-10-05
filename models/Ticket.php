<?php

namespace models;

require "models/Showing.php";

use models\Showing as Showing;


class Ticket
{
        private $idPurchase; //Para saber de que compra surgio esta entrada
        private $showing;
        private $numberTicket; //Lo usamos para saber la capacidad del cine si la supera o no
        private $qr;


        /**
         * Getter for IdPurchase         
         */
        public function getIdPurchase()
        {
                return $this->idPurchase;
        }

        /**
         * Setter for IdPurchase
         */
        public function setIdPurchase($idPurchase)
        {
                $this->idPurchase = $idPurchase;
        }

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
         * Get the value of numberTicket
         */
        public function getNumberTicket()
        {
                return $this->numberTicket;
        }

        /**
         * Set the value of numberTicket

         */
        public function setNumberTicket($numberTicket)
        {
                $this->numberTicket = $numberTicket;
        }

        /**
         * Get the value of Showing
         */
        public function getShowing()
        {
                return $this->showing;
        }

        /**
         * Set the value of Showing
         */
        public function setShowing(Showing $showing)
        {
                $this->showing = $showing;
        }
}
