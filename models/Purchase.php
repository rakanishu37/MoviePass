<?php

namespace models;
use models\User as User;

class Purchase
{
        private $user;
        private $quantityOfTickets;
        private $totalAmount;
        private $datePurchase;
        private $discount;
        private $idPurchase;

        public function __construct($quantityOfTickets='', $totalAmount='',$datePurchase='',$discount='',$user='',$idPurchase=''){
                $this->setUser($user);
                $this->setQuantityOfTickets($quantityOfTickets);
                $this->setTotalAmount($totalAmount);
                $this->setDatePurchase($datePurchase);
                $this->setDiscount($discount);
                $this->setIdPurchase($idPurchase);
        }

        public function getUser(){
                return $this->user;
        }
        public function setUser($user){
                $this->user = $user;
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