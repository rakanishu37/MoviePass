<?php

namespace models;
use models\User as User;
use models\Show as Show;

class Purchase
{
        private $user;
        private $show;
        private $quantityOfTickets;
        private $totalAmount;
        private $datePurchase;
        private $discount;
        private $idPurchase;

        public function __construct($data){
                $this->setUser($data["user"]);
                $this->setShow($data["show"]);
                $this->setQuantityOfTickets($data['ticketsQuantity']);
                $this->setTotalAmount($data['totalAmount']);
                $this->setDatePurchase($data['date']);
                $this->setDiscount($data['discount']);
                $this->setIdPurchase($data['idPurchase']);
        }

        public function getUser(){
                return $this->user;
        }
        public function setUser($user){
                $this->user = $user;
        }
        
        public function getShow(){
                return $this->show;
        }
        public function setShow($show){
                $this->show = $show;
        }

        public function getQuantityOfTickets(){
                return $this->quantityOfTickets;
        }
        public function setQuantityOfTickets($quantityOfTickets){
                $this->quantityOfTickets = $quantityOfTickets;
        }
        
        public function getTotalAmount(){
                return $this->totalAmount;
        }
        public function setTotalAmount($totalAmount){
                $this->totalAmount = $totalAmount;
        }
        
        public function getDatePurchase(){
                return $this->datePurchase;
        }
        public function setDatePurchase($datePurchase){
                $this->datePurchase = $datePurchase;
        }
        
        public function getDiscount(){
                return $this->discount;
        }
        public function setDiscount($discount){
                $this->discount = $discount;
        }
        
        public function getIdPurchase(){
                return $this->idPurchase;
        }
        public function setIdPurchase($idPurchase){
                $this->idPurchase = $idPurchase;
        }
}
?>