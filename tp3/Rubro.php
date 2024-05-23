<?php

class Rubro
{
    private $descripcion;
    private $porcentajeGanancia;

    public function __construct($descripcion, $porcentajeGanancia)
    {
        $this->descripcion = $descripcion;
        $this->porcentajeGanancia = $porcentajeGanancia;
    }

    // getters
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPorcentajeGanancia()
    {
        return $this->porcentajeGanancia;
    }

    // setters
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setPorcentajeGanancia($porcentajeGanancia)
    {
        $this->porcentajeGanancia = $porcentajeGanancia;
    }

    public function __toString()
    {
        $msj = "Rubro: " . $this->descripcion . "\n";
        $msj .= "Porcentaje de ganancia: " . $this->porcentajeGanancia . "\n";
        return $msj;
    }
}
