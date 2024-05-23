<?php

class Cliente extends Persona
{

    private $nroCliente;

    public function __construct($nombre, $apellido, $DNI, $nroCliente)
    {
        parent::__construct($nombre, $apellido, $DNI);
        $this->nroCliente = $nroCliente;
    }

    public function getNroCliente()
    {
        return $this->nroCliente;
    }

    public function setNroCliente($nroCliente)
    {
        $this->nroCliente = $nroCliente;
    }

    public function __toString()
    {
        $msj = parent::__toString();
        $msj .= "Numero cta: " . $this->getNroCliente();

        return $msj;
    }
}
