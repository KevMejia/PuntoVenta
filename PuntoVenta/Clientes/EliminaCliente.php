<?php
include("../utilerias/conexion.php");

$id = $_REQUEST['id'];

$con = new Conexion();
$PDO = $con-> AbreConexion();

$PDO -> exec("Delete from Clientes where IdCliente=".$id);
echo "Se elimin� el cliente correctamente";

?>