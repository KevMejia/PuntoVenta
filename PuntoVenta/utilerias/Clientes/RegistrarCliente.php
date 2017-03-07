<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../conexion.php");
include("UtileriasClientes.php");

$usuario = trim($_REQUEST['cliente']);
$pass = sha1($_REQUEST['pass']);
$mail = $_REQUEST['mail'];

$con = new Conexion();
$PDO = $con-> AbreConexion();

if(ExisteCliente($PDO, $usuario)){ 
    echo "ERROR: Ya existe el cliente ".$usuario;
}
else{
    $idUsuario = ObtenMaximoCliente($PDO);
    $PDO->exec("Insert Into Clientes(IdCliente, NombreCliente, Pass, Correoelectronico) "
        ."VALUES(".$idUsuario.", '".$usuario."', '".$pass."', '".$mail."')");
    //$_SESSION["usuario"] = $usuario;
    echo "Se registró el cliente correctamente";
}

?>