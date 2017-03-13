<?php
include "../utilerias/encabezado.php"; 
include "../utilerias/conexion.php";
include "../utilerias/Utilerias.php";
 
$con = new Conexion();
$PDO = $con-> AbreConexion();

$sqlSelectClientes = "SELECT IdProveedor, NombreProveedor FROM Proveedores";
$listaClientes = $PDO->query($sqlSelectClientes);     
?>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalAgrega">
    <span class="glyphicon glyphicon-plus"></span> Agregar Proveedor
</button>

<div class="modal fade" id="ModalAgrega" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel"> Agregar Proveedor</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="userProveedor" placeholder="Nombre del Proveedor" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="RegistrarProveedor()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Proveedor</button>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Lista de Proveedores</h1>
<table class="table table-striped" style="width: 100%">
    <thead>
        <tr>
            <td style="width: 10%">
                <h4><strong>Id</strong></h4>
            </td>
            <td style="width: 85%">
                <h4><strong>Nombre</strong></h4>
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
            echo "<td style='text-align:center'><span class='glyphicon glyphicon-trash iconoEliminaProveedor' style='color:red;'></span></td>"; 
            echo "</tr>";
        }  
        ?>
    </tbody>
</table>


<?php include "../utilerias/piedepagina.php"; ?>