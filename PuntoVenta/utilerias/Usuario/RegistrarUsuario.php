<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../conexion.php");
include("../Utilerias.php");
$usuario = trim($_REQUEST['usuario']);
$pass = sha1($_REQUEST['pass']);

$con = new Conexion();
$PDO = $con-> AbreConexion();

//$PDO->exec("DELETE from usuarios");


if(ExisteUsuario($PDO, $usuario)){ 
    echo "ERROR: Ya existe el usuario ".$usuario;
}
else{
    $idUsuario = ObtenMaximoUsuario($PDO);
    $PDO->exec("Insert Into Usuarios(IdUsuario, NombreUsuario, Pass) VALUES(".$idUsuario.", '".$usuario."', '".$pass."')");
    $_SESSION["usuario"] = $usuario;
    echo "Se registró el usuario correctamente";
}

?>