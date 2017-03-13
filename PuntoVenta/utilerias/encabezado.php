<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['usuario'])) 
    $_SESSION['usuario'] = "";

if(!isset($_SESSION["root"])){
    $url = dirname("../")."/"; 
    $_SESSION["root"] = $url;
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Punto de Venta Isima</title>
    <link href=<?php echo $url; ?>css/bootstrap.min.css rel="stylesheet">
    <link href=<?php echo $url; ?>css/PuntoVenta.css rel="stylesheet">
    <script>
        var root = "<?php echo $url; ?>";
    </script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Cambiar Navegaci&oacute;n</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=<?php echo $url; ?>>Punto de Venta Isima</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if(($_SESSION["usuario"]) != ""){ ?>

                    <li>
                        <a href=<?php echo $url; ?>Inventario>
                        <span class="glyphicon glyphicon-list"></span> Inventario
                        </a>
                    </li>
                    <li>
                        <a href=<?php echo $url; ?>Proveedores>
                            <span class="glyphicon glyphicon-list"></span> Proveedores
                        </a>
                    </li>
                    <li>
                        <a href=<?php echo $url; ?>Clientes>
                            <span class="glyphicon glyphicon-list"></span> Clientes
                        </a>
                    </li>
                    <li>
                        <a href=<?php echo $url; ?>Ventas>
                            <span class="glyphicon glyphicon-shopping-cart"></span> Registrar una Venta
                        </a>
                    </li>
                    <?php } ?>



                </ul>
                <?php if(($_SESSION["usuario"]) != ""){ ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["usuario"] ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="CierraSesion()">
                            <span class="glyphicon glyphicon-remove"></span> Cerrar Sesi&oacute;n
                        </a>
                    </li>
                </ul>
                <?php }else{ ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a data-toggle="modal" data-target="#ModalRegistroUsuario" class="LinkRegistra">
                            <span class="glyphicon glyphicon-pencil"></span> Registrar Usuario
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#ModalSesionUsuario" class="LinkRegistra">
                            <span class="glyphicon glyphicon-user"></span> Iniciar Sesi&oacute;n
                        </a>
                    </li>
                </ul>
                <?php } ?>

            </div>
        </div>
    </nav>
    <div class="container">
