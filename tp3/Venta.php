<?php

class Venta
{
    private $fecha;
    private $referenciaProducto;
    private $objCliente;

    public function __construct($fecha, $referenciaProducto, $objCliente)
    {
        $this->fecha = $fecha;
        $this->referenciaProducto = $referenciaProducto;
        $this->objCliente = $objCliente;
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

    public function getObjCliente()
    {
        return $this->objCliente;
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

    public function setObjCliente($objCliente)
    {
        $this->objCliente = $objCliente;
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
        $msj .= "Cliente: " . $this->getObjCliente() . "\n";
        return $msj;
    }
}
