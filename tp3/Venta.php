<?php

class Venta
{
    private $fecha;
    private $referenciaProducto;
    private $cliente;

    public function __construct($fecha, $referenciaProducto, $cliente)
    {
        $this->fecha = $fecha;
        $this->referenciaProducto = $referenciaProducto;
        $this->cliente = $cliente;
    }

    // getters
    public function getFecha()
    {
        return $this->fecha;
    }

    public function getReferenciaProducto()
    {
        return $this->referenciaProducto;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    // setters
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setReferenciaProducto($referenciaProducto)
    {
        $this->referenciaProducto = $referenciaProducto;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function darImporteVenta()
    {
        $importe = 0;
        $colProductos = $this->getReferenciaProducto();
        $enum = count($colProductos);

        for ($i = 0; $i < $enum; $i++) {
            $importe += $colProductos[$i]->darPrecioVenta();
        }
        return $importe;
    }

    public function __toString()
    {
        $msj = "Fecha: " . $this->getFecha() . "\n";
        $msj .= "Referencia Producto: " . $this->getReferenciaProducto() . "\n";
        $msj .= "Cliente: " . $this->getCliente() . "\n";
        return $msj;
    }
}
