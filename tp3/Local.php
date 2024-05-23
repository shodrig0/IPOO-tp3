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

    public function productoMasEconomico($rubro)
    {
        $productoEconomico = null;
        $colProductos = $this->getColProductos();
        $enum = count($colProductos);

        for ($i = 0; $i < $enum; $i++) {
            if ($colProductos->getObjRubro()->getDescripcion() == $rubro) { // segun la descripcion del rubro
                if ($productoEconomico == null) {
                    $productoEconomico = $colProductos[$i];
                } else {
                    if ($productoEconomico->darPrecioVenta() > $colProductos[$i]->darPrecioVenta()) { // segun el precio
                        $productoEconomico = $colProductos[$i];
                    }
                }
            }
        }
        return $productoEconomico;
    }

    public function informarProductosMasVendidos($anio, $n)
    {
        $colProdVendidos = [];
        $colVentas = $this->getColVentas();
        $enum = count($colVentas);

        for ($i = 0; $i < $enum; $i++) {
            $anioVenta = date_format($colVentas[$i]->getFecha(), "Y"); // objeto y fecha
            if ($anioVenta == $anio) {
                for ($j = 0; $j < count($colVentas[$i]->getColProductos()); $j++) {
                    if ($colProdVendidos[$j]->getCodigoBarra() == $colVentas[$j]->getColProductos()[$j]->getCodigoBarra()) {
                        $colProdVendidos[$j]++;
                    } else {
                        $colProdVendidos[$j] = 1;
                    }
                }
            }
        }

        arsort($colProdVendidos);

        $colProdMasVendidos = [];
        for ($k = 0; $k < $n; $k++) {
            $productoX = $this->buscarProducto($colProdVendidos[$k]);
            $colProdMasVendidos[$k] = $productoX;
        }
        return $colProdMasVendidos;
    }

    public function promedioVentasImportados()
    {
        $colVentas = $this->getColVentas();
        $enum = count($colVentas);
        $promedio = 0;
        $sumaProd = 0;
        $sumaVentas = 0;

        for ($i = 0; $i < $enum; $i++) {
            for ($j = 0; $j < count($colVentas[$i]->getColProductos()); $j++) {
                if ($colVentas[$i]->getColProductos()[$j] instanceof ProductoImportado) {
                    $sumaVentas += $colVentas[$i]->getColProductos()[$j]->darPrecioVenta();
                    $sumaProd++;
                }
            }
        }
        $promedio = $sumaVentas / $sumaProd;
        return $promedio;
    }

    public function informarConsumoCliente($tipoDoc, $numDoc)
    {
        $colVentas = $this->getColVentas();
        $colProductosCompradosCliente = [];

        foreach ($colVentas as $venta) {
            $cliente = $venta->getObjCliente();
            if ($cliente->getDNI() == $numDoc) {
                foreach ($venta->getColProductos() as $producto) {
                    $colProductosCompradosCliente[] = $producto;
                }
            }
        }
        return $colProductosCompradosCliente;
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
