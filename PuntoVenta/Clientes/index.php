<?php

include "../utilerias/encabezado.php"; 
include "../utilerias/conexion.php";
include "../utilerias/Utilerias.php";

$con = new Conexion();
$PDO = $con-> AbreConexion();

$sqlSelectClientes = "SELECT IdCliente, NombreCliente, CorreoElectronico FROM Clientes";
$listaClientes = $PDO->query($sqlSelectClientes);     
?>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalAgrega">
    <span class="glyphicon glyphicon-plus"></span> Agregar Cliente
</button>

<div class="modal fade" id="ModalAgrega" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel">Agregar Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="userCliente" placeholder="Nombre del Cliente" />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="mailCliente" placeholder="Correo Electrónico" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="RegistrarCliente()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Cliente</button>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Lista de Clientes</h1>
<table class="table table-striped" style="width: 100%">
    <thead>
        <tr>
            <td style="width: 10%">
                <h4><strong>Id</strong></h4>
            </td>
            <td style="width: 55%">
                <h4><strong>Nombre</strong></h4>
            </td>
            <td style="width: 30%">
                <h4><strong><?php echo Reemplazar("Correo Electrónico"); ?></strong></h4>
            </td>
            <td style="width: 5%">
                <h4><strong>Eliminar</strong></h4>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listaClientes as $fila) {
            echo "<tr>";
            echo "<td>".$fila[0]."</td>"; 
            echo "<td>".Reemplazar($fila[1])."</td>"; 
            echo "<td>".Reemplazar($fila[2])."</td>"; 
            echo "<td style='text-align:center'><span class='glyphicon glyphicon-trash iconoElimina' style='color:red;'></span></td>"; 
            echo "</tr>";
        }  
        ?>
    </tbody>
</table>


<?php include "../utilerias/piedepagina.php"; ?>