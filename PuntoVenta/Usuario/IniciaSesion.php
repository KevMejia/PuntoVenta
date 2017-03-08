<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../utilerias/conexion.php");
include("../utilerias/Utilerias.php");
$usuario = trim($_REQUEST['usuario']);
$pass = sha1($_REQUEST['pass']);

$con = new Conexion();
$PDO = $con-> AbreConexion();



if(!ValidaUsuario($PDO, $usuario, $pass)){ 
    echo "ERROR: El usuario o la contraseña son incorrectos";
}
else{
    $_SESSION["usuario"] = $usuario;
}
?>