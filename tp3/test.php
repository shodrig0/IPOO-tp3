<?php

include_once 'Producto.php';
include_once 'ProductoImportado.php';
include_once 'ProductoRegional.php';
include_once 'Venta.php';
include_once 'Local.php';
include_once 'Rubro.php';
include_once '../tp3/Persona.php';
include_once '../tp3/Cliente.php';


$objRubroConservas = new Rubro("Conservas", "Conservas", 35);
$objRubroRegalos = new Rubro("Regalos", "Regalos", 55);

$objProducto1 = new ProductoRegional(1, 1, 21, 50, $objRubroConservas, "", "");
$objProducto2 = new ProductoRegional(2, 1, 21, 30, $objRubroRegalos, "", "");
$objProducto3 = new ProductoImportado(3, 1, 21, 80, $objRubroConservas, "", "", "");
$objProducto4 = new ProductoImportado(4, 1, 21, 90, $objRubroRegalos, "", "", "");

$objLocal = new Local([], [], [], []);

$objLocal->incorporarProductoLocal($objProducto1);
$objLocal->incorporarProductoLocal($objProducto2);
$objLocal->incorporarProductoLocal($objProducto3);
$objLocal->incorporarProductoLocal($objProducto4);
$objLocal->incorporarProductoLocal($objProducto4);

echo $objLocal;
