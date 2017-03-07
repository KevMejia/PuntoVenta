<?php
include("../utilerias/conexion.php");

$id = $_REQUEST['id'];

$con = new Conexion();
$PDO = $con-> AbreConexion();

$PDO -> exec("Delete from Proveedores where IdProveedor=".$id);
echo "Se eliminó el proveedor correctamente";

?>