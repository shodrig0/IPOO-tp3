<?php

class Producto
{
    private $codBarra;
    private $descripcion;
    private $stock;
    private $porcentajeIva;
    private $precioCompra;
    private $objRubro;

    public function __construct($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $objRubro)
    {
        $this->codBarra = $codBarra;
        $this->descripcion = $descripcion;
        $this->stock = $stock;
        $this->porcentajeIva = $porcentajeIva;
        $this->precioCompra = $precioCompra;
        $this->objRubro = $objRubro;
    }

    // getters
    public function getCodBarra()
    {
        return $this->codBarra;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getPorcentajeIva()
    {
        return $this->porcentajeIva;
    }

    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    public function getObjRubro()
    {
        return $this->objRubro;
    }

    // setters
    public function setCodBarra($codBarra)
    {
        $this->codBarra = $codBarra;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setPorcentajeIva($porcentajeIva)
    {
        $this->porcentajeIva = $porcentajeIva;
    }

    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;
    }

    public function setObjRubro($objRubro)
    {
        $this->objRubro = $objRubro;
    }

    public function darPrecioVenta()
    {
        $precioBase = $this->getPrecioCompra();
        $IVA = $this->getPorcentajeIva();
        $gananciaRubro = $this->getObjRubro()->getPorcentajeGanancia();
        $precioVenta = $precioBase + ($precioBase * $gananciaRubro / 100) + ($precioBase * $IVA / 100);
        return $precioVenta;
    }

    public function __toString()
    {
        $msj = "Codigo de barra: " . $this->getCodBarra() . "\n";
        $msj .= "Descripcion: " . $this->getDescripcion() . "\n";
        $msj .= "Stock: " . $this->getStock() . "\n";
        $msj .= "Porcentaje de IVA: " . $this->getPorcentajeIva() . "\n";
        $msj .= "Precio de compra: " . $this->getPrecioCompra() . "\n";
        $msj .= "Referencia de rubro: " . $this->getObjRubro() . "\n";
        return $msj;
    }
}
