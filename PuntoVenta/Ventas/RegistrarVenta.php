<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../utilerias/conexion.php");
include("UtileriasVentas.php");

$idProducto = $_REQUEST['idProducto'];
$NumProductos = $_REQUEST['NumProductos'];
$idCliente = $_REQUEST['idCliente'];

$queryInsert = array();

$con = new Conexion();
$PDO = $con-> AbreConexion();

$costoProducto = ObtenCostoProducto($PDO, $idProducto);
$idVenta = ObtenMaximaVenta($PDO);
$hoy = getdate();
$fecha = $hoy["year"]."-".str_pad($hoy["mon"], 2, "0", STR_PAD_LEFT)."-".str_pad($hoy["mday"], 2, "0", STR_PAD_LEFT)." "
    .$hoy["hours"].":".$hoy["minutes"].":".$hoy["seconds"]  ;

for($cont=0; $cont < count($idProducto); $cont++){
    array_push($queryInsert, "Insert Into Ventas(IdVenta, TotalVenta, NumPiezas, IdProduto, IdCliente, Fecha) "
    ."VALUES(".$idVenta.", ".($costoProducto[$cont] * $NumProductos[$cont]).", ".$NumProductos[$cont].", "
    .$idProducto[$cont].", ".$idCliente.", '".$fecha."')");
}

for($cont=0; $cont < count($idProducto); $cont++){
    $PDO->exec($queryInsert[$cont]);
}

if(!EnviaCorreo($PDO, $idCliente, $costoProducto, $NumProductos, $idProducto)){
    echo "ERROR: Ocurrio un error enviando el correo electronico\nSe registro la venta correctamente";
}else{
    echo "Se registro la venta correctamente\nSe ha enviado un correo electronico al usuario";
}
?>