<?php

namespace models;

use models\Show as Show;


class Ticket
{
        private $numberTicket; //Lo usamos para saber la capacidad del cine si la supera o no
        private $idPurchase; //Para saber de que compra surgio esta entrada¿
        private $show;
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

        public function getShow()
        {
                return $this->showing;
        }

        public function setShow(Showing $showing)
        {
                $this->showing = $showing;
        }
}
