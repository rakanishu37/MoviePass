<?php

namespace models;

require "models/Show.php";

use models\Show as Show;


class Ticket
{
        private $idPurchase; //Para saber de que compra surgio esta entrada
        private $showing;
        private $numberTicket; //Lo usamos para saber la capacidad del cine si la supera o no
        private $qr;


        public function getIdPurchase()
        {
                return $this->idPurchase;
        }

        public function setIdPurchase($idPurchase)
        {
                $this->idPurchase = $idPurchase;
        }

        public function getQr()
        {
                return $this->qr;
        }

        public function setQr($qr)
        {
                $this->qr = $qr;
        }

        public function getNumberTicket()
        {
                return $this->numberTicket;
        }

        public function setNumberTicket($numberTicket)
        {
                $this->numberTicket = $numberTicket;
        }

        public function getShowing()
        {
                return $this->showing;
        }

        public function setShowing(Showing $showing)
        {
                $this->showing = $showing;
        }
}
