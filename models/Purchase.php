<?php

namespace models;

/*include "models/CreditCardPayment";

use models\CreditCardPayment as CreditCardPayment;
*/
class Purchase
{
        private $date;
        private $ticketQuantity;
        private $discount;
        private $total;
        private $idPurchase;
        //private $CreditCardPayment;
        
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
         * Get the value of date
         */
        public function getdate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         */
        public function setDate($date)
        {
                $this->date = $date;
        }

        /*
         Get the value of ticketQuantity
         */
        public function getTicketQuantity()
        {
                return $this->ticketQuantity;
        }

        /*
         Set the value of ticketQuantity      
         */
        public function setTicketQuantity($ticketQuantity)
        {
                $this->ticketQuantity = $ticketQuantity;
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
         * Get the value of discount
         */
        public function getDiscount()
        {
                return $this->discount;
        }

        /**
         * Set the value of discount
         *
      
         */
        public function setDiscount($discount)
        {
                $this->discount = $discount;
        }
}
