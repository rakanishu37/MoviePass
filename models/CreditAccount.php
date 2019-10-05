<?php

namespace models;

class CreditAccount
{
    //Enum con lso nombres de las companys
    private $company;

    /**
     * Get the value of company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }
}
