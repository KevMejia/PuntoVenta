<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../utilerias/conexion.php");
include("UtileriasProductos.php");

$proveedor = trim($_REQUEST['Proveedor']);
$producto = $_REQUEST['NombreProducto'];
$costo = $_REQUEST['Costo'];

$con = new Conexion();
$PDO = $con-> AbreConexion();

if(ExisteProducto($PDO, $usuario)){ 
    echo "ERROR: Ya existe el producto ".$usuario;
}
else{
    $idProducto = ObtenMaximoProducto($PDO);
    $PDO->exec("Insert Into Inventario(IdProducto, NombreProducto, IdProveedor, Costo) "
        ."VALUES(".$idProducto.", '".$producto."', ".$proveedor.", ".$costo.")");
    echo "Se registró el producto correctamente";
}
?>