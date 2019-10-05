<?php

namespace models;

class CreditCardPayment
{
        private $date;
        private $authenticationCode;
        private $total;

        /**
         * Get the value of date
         */
        public function getDate()
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

        /**
         * Get the value of authenticationCode
         */
        public function getAuthenticationCode()
        {
                return $this->authenticationCode;
        }

        /**
         * Set the value of authenticationCode
         *
     
         */
        public function setAuthenticationCode($authenticationCode)
        {
                $this->authenticationCode = $authenticationCode;
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
