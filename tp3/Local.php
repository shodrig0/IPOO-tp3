<?php

class Local
{
    private $nombre;
    private $direccion;
    private $colProductos =  [];
    private $colVentas = [];

    public function __construct($nombre, $direccion, $colProductos, $colVentas)
    {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->colProductos = $colProductos;
        $this->colVentas = $colVentas;
    }

    // getters
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getColProductos()
    {
        return $this->colProductos;
    }

    public function getColVentas()
    {
        return $this->colVentas;
    }

    // setters
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setColProductos($colProductos)
    {
        $this->colProductos = $colProductos;
    }

    public function setColVentas($colVentas)
    {
        $this->colVentas = $colVentas;
    }

    public function incorporarProductoLocal($objProducto)
    {
        $prodExistente = false;
        $arrayProducto = [];

        $objEncontrado = $this->buscarProducto($objProducto->getCodBarra());
        if ($objEncontrado != null) {
            $arrayProducto[] = $objProducto;
            $this->setColProductos($arrayProducto);
            $prodExistente = true;
        }
        return $prodExistente;
    }

    public function retornarImporteProducto($codProducto)
    {
        $precioVenta = null;
        $objProducto = $this->buscarProducto($codProducto);
        if ($objProducto != null) {
            $precioVenta = $objProducto->darPrecioVenta();
        }
        return $precioVenta;
    }

    public function retornarCostoProductoLocal()
    {
        $costoFinal = 0;
        $colProductos = $this->getColProductos();
        $enum = count($colProductos);

        for ($i = 0; $i < $enum; $i++) {
            $stockProductos = $colProductos[$i]->getStock();
            $precioUnitario = $colProductos[$i]->getPrecioCompra();
            $costoFinal += $stockProductos * $precioUnitario;
        }

        return $costoFinal;
    }

    private function buscarProducto($codigoBarra)
    {
        $banderaCorte = false;
        $objProducto = null;
        $colProducto = $this->getColProductos();
        $enum = count($colProducto);
        $i = 0;

        while ($i < $enum && !$banderaCorte) {
            if ($colProducto[$i]->getCodBarra() == $codigoBarra->getCodBarra()) {
                $banderaCorte = true;
                $objProducto = $colProducto[$i];
            }
            $i++;
        }

        return $objProducto;
    }

    public function arrToStr($arr)
    {
        $listado = "";
        $enum = count($arr);
        for ($i = 0; $i < $enum; $i++) {
            $listado .= $arr[$i];
        }
        return $listado;
    }

    public function __toString()
    {
        $msj = "Local: " . $this->nombre . "\n";
        $msj .= "Direccion: " . $this->direccion . "\n";
        $msj .= "Productos: " . $this->arrToStr($this->getColProductos()) . "\n";
        $msj .= "Ventas: " . $this->arrToStr($this->getColVentas()) . "\n";
        return $msj;
    }
}
