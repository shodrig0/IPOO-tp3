<?php

class ProductoRegional extends Producto
{
    private $porcentajeDescuento;

    public function __construct($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $referenciaRubro, $porcentajeDescuento)
    {
        parent::__construct($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $referenciaRubro);
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    // getters
    public function getPorcentajeDescuento()
    {
        return $this->porcentajeDescuento;
    }

    // setters
    public function setPorcentajeDescuento($porcentajeDescuento)
    {
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function darPrecioVenta()
    {
        $precioVenta = parent::darPrecioVenta();
        $descuento = $this->getPorcentajeDescuento() / 100;

        $precioVenta = $precioVenta - ($precioVenta * $descuento);

        return $precioVenta;
    }

    public function __toString()
    {
        $msj = parent::__toString();
        $msj .= "Porcentaje de descuento: " . $this->getPorcentajeDescuento() . "%\n";
        return $msj;
    }
}
