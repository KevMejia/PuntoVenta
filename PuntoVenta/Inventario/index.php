<?php
include "../utilerias/encabezado.php"; 
include "../utilerias/conexion.php";
include "../utilerias/Utilerias.php";

$con = new Conexion();
$PDO = $con-> AbreConexion();

$sqlSelectProductos = "select inventario.IdProducto, inventario.NombreProducto, proveedores.NombreProveedor, inventario.Costo "
."from inventario, proveedores where inventario.IdProveedor = proveedores.IdProveedor";
$listaProductos = $PDO->query($sqlSelectProductos);     

$sqlSelectProveedores = "select IdProveedor, NombreProveedor from Proveedores";
$listaProveedores = $PDO->query($sqlSelectProveedores);    
?>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalAgrega">
    <span class="glyphicon glyphicon-plus"></span>Agregar Producto
</button>

<div class="modal fade" id="ModalAgrega" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel"> Agregar Producto</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nombreProducto" placeholder="Nombre del Producto" />
                    </div>
                    <div class="form-group">
                        <input type="number" min="1" class="form-control" id="CostoProducto" placeholder="Costo del Producto" />
                    </div>
                    <div class="form-group">
                        <span>Proveedor: </span>
                        <select class="form-control" id="ProveedorProducto">
                            <?php
                            foreach ($listaProveedores as $filaProveedor) {
                                echo "<option value='".$filaProveedor[0]."'>";
                                echo Reemplazar($filaProveedor[1]);
                                echo "</option>";
                            }  
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="RegistrarProducto()">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Guardar Producto
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Lista de Productos</h1>
<table class="table table-striped" style="width: 100%">
    <thead>
        <tr>
            <td style="width: 10%">
                <h4><strong>Id</strong></h4>
            </td>
            <td style="width: 35%">
                <h4><strong>Nombre del Producto</strong></h4>
            </td>
            <td style="width: 30%">
                <h4><strong>Proveedor</strong></h4>
            </td>
            <td style="width: 20%">
                <h4><strong>Costo</strong></h4>
            </td>
            <td style="width: 5%">
                <h4><strong>Eliminar</strong></h4>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listaProductos as $fila) {
            echo "<tr>";
            echo "<td>".$fila[0]."</td>"; 
            echo "<td>".Reemplazar($fila[1])."</td>"; 
            echo "<td>".Reemplazar($fila[2])."</td>"; 
            echo "<td>".$fila[3]."</td>"; 
            echo "<td style='text-align:center'><span class='glyphicon glyphicon-trash iconoEliminaProducto' style='color:red;'></span></td>"; 
            echo "</tr>";
        }  
        ?>
    </tbody>
</table>


<?php include "../utilerias/piedepagina.php"; ?>