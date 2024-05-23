<?php

class ProductoImportado extends Producto
{
    private $incremento;
    private $impuesto;

    public function __construct($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $referenciaRubro, $incremento, $impuesto)
    {
        parent::__construct($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $referenciaRubro);
        $this->incremento = $incremento ?? 50;
        $this->impuesto = $impuesto ?? 10;
    }

    // getters
    public function getIncremento()
    {
        return $this->incremento;
    }

    public function getImpuesto()
    {
        return $this->impuesto;
    }

    // setters
    public function setIncremento($incremento)
    {
        $this->incremento = $incremento;
    }

    public function setImpuesto($impuesto)
    {
        $this->impuesto = $impuesto;
    }

    public function darPrecioVenta()
    {
        $precioVenta = parent::darPrecioVenta();
        $incremento = $this->getIncremento() / 100;
        $impuesto = $this->getImpuesto() / 100;

        $precioVenta = $precioVenta + ($precioVenta * $incremento) + ($precioVenta * $impuesto);

        return $precioVenta;
    }

    public function __toString()
    {
        $msj = parent::__toString();
        $msj .= "Incremento: " . $this->getIncremento() . "%\n";
        $msj .= "Impuesto: " . $this->getImpuesto() . "%\n";
        return $msj;
    }
}
