<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../utilerias/conexion.php");
include("UtileriasClientes.php");

$usuario = trim($_REQUEST['cliente']);
$mail = $_REQUEST['mail'];

$con = new Conexion();
$PDO = $con-> AbreConexion();

if(ExisteCliente($PDO, $usuario)){ 
    echo "ERROR: Ya existe el cliente ".$usuario;
}
else{
    $idUsuario = ObtenMaximoCliente($PDO);
    $PDO->exec("Insert Into Clientes(IdCliente, NombreCliente, CorreoElectronico) "
        ."VALUES(".$idUsuario.", '".$usuario."', '".$mail."')");
    //$_SESSION["usuario"] = $usuario;
    echo "Se registró el cliente correctamente";
}
?>