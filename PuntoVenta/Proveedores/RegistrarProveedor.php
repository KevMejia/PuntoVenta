<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../utilerias/conexion.php");
include("UtileriasProveedores.php");

$usuario = trim($_REQUEST['Proveedor']);

$con = new Conexion();
$PDO = $con-> AbreConexion();

if(ExisteProveedor($PDO, $usuario)){ 
    echo "ERROR: Ya existe el proveedor ".$usuario;
}
else{
    $idUsuario = ObtenMaximoProveedor($PDO);
    $PDO->exec("Insert Into Proveedores(IdProveedor, NombreProveedor) "
        ."VALUES(".$idUsuario.", '".$usuario."')");
    echo "Se registró el proveedor correctamente";
}
?>