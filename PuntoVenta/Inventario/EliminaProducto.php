<?php
include("../utilerias/conexion.php");

$id = $_REQUEST['id'];

$con = new Conexion();
$PDO = $con-> AbreConexion();

$PDO -> exec("Delete from Inventario where IdProducto=".$id);
echo "Se elimin� el producto correctamente";

?>