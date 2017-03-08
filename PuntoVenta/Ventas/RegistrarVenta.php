<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../utilerias/conexion.php");
include("UtileriasVentas.php");

$idProducto = $_REQUEST['idProducto'];
$NumProductos = $_REQUEST['NumProductos'];
$idCliente = $_REQUEST['idCliente'];

$con = new Conexion();
$PDO = $con-> AbreConexion();

$costoProducto = ObtenCostoProducto($PDO, $idProducto);
$idVenta = ObtenMaximaVenta($PDO);
$hoy = getdate();
$fecha = $hoy["year"]."-".str_pad($hoy["mon"], 2, "0", STR_PAD_LEFT)."-".str_pad($hoy["mday"], 2, "0", STR_PAD_LEFT)." "
    .$hoy["hours"].":".$hoy["minutes"].":".$hoy["seconds"]  ;

$PDO->exec("Insert Into Ventas(IdVenta, TotalVenta, NumPiezas, IdProduto, IdCliente, Fecha) "
    ."VALUES(".$idVenta.", ".($costoProducto * $NumProductos).", ".$NumProductos.", "
    .$idProducto.", ".$idCliente.", '".$fecha."')");

if(!EnviaCorreo($PDO, $idCliente, $costoProducto, $NumProductos, $idProducto)){
    echo "ERROR: Ocurrió un error enviando el correo electrónico\nSe registró la venta correctamente";
}else{
    echo "Se registró la venta correctamente\nSe ha enviado un correo electrónico al usuario";
}


?>