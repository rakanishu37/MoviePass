<?php

namespace models;

class CuentaDeCredito
{
    //Enum con lso nombres de las empresas
    private $empresa;

    /**
     * Get the value of empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set the value of empresa
     *
     
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }
}
