<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) 
    $_SESSION['usuario'] = "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Punto de Venta Isima</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/PuntoVenta.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Cambiar Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Punto de Venta Isima</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if(($_SESSION["usuario"]) != ""){ ?>

                    <li><a href="/Inventario">Inventario</a></li>
                    <li><a href="/Proveedores">Proveedores</a></li>
                    <li><a href="/Clientes">Clientes</a></li>
                    <li><a href="/RegistraVenta">Registrar una venta</a></li>
                    <?php } ?>



                </ul>
                <?php if(($_SESSION["usuario"]) != ""){ ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><?php echo $_SESSION["usuario"] ?></a></li>
                    <li><a href="#" onclick="CierraSesion()">Cerrar Sesión</a></li>
                </ul>
                <?php }else{ ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a data-toggle="modal" data-target="#ModalRegistroUsuario" class="LinkRegistra">Registrar Usuario</a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#ModalSesionUsuario" class="LinkRegistra">Iniciar Sesion</a>
                    </li>
                </ul>
                <?php } ?>

            </div>
        </div>
    </nav>
    <div class="container">
