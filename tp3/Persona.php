<?php

class Persona
{
    private $nombre;
    private $apellido;
    private $DNI;

    public function __construct($nombre, $apellido, $DNI)
    {

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->DNI = $DNI;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getDNI()
    {
        return $this->DNI;
    }

    public function setDNI($DNI)
    {
        $this->DNI = $DNI;
    }

    public function __toString()
    {
        $msj = "\nNombre: " . $this->getNombre() . "\n";
        $msj .= "Apellido: " . $this->getApellido() . "\n";
        $msj .= "DNI: " . $this->getDNI() . "\n";

        return $msj;
    }
}
