<?php
include "../utilerias/encabezado.php"; 
include "../utilerias/conexion.php";
include "../utilerias/Utilerias.php";

$con = new Conexion();
$PDO = $con-> AbreConexion();    

$sqlSelectProductos = "SELECT IdProducto, NombreProducto FROM Inventario";
$listaProductos = $PDO->query($sqlSelectProductos);    

$sqlSelectClientes = "SELECT IdCliente, NombreCliente FROM Clientes";
$listaClientes = $PDO->query($sqlSelectClientes);   

?>
<script>
    var numProd = 1;
    var copia;
    $(document).ready(function () {
        CompruebaProd();
        copia = CopiaInicial();
    });
</script>

<h1>Registrar una Venta</h1>
<button type="button" class="btn btn-primary btn-lg" onclick="AgregaProducto();">
    <span class="glyphicon glyphicon-plus"></span> Agregar Producto
</button>

<p></p>
<label id="lblProducto">Seleccionar Producto(s)</label>
<div id="Prods" class="form-inline">
    <div class="form-group" id="Productos">
        <span onclick="EliminaProducto(this);" title="Eliminar este producto" class="iconoElimina glyphicon glyphicon-remove"></span>
        <select class="form-control idProducto">
            <?php
            foreach ($listaProductos as $filaProducto) {
                echo "<option value='".$filaProducto[0]."'>";
                echo Reemplazar($filaProducto[1]);
                echo "</option>";
            }  
            ?>
        </select>
        <p></p>
        <input type="number" placeholder="N&uacute;mero de Productos" class="form-control NumProductos" min="1" />
    </div>
</div>

<p></p>

<div class="form-group">
    <label>Selecciona al Cliente:</label>
    <select class="form-control" id="idCliente">
        <?php
        foreach ($listaClientes as $filaCliente) {
            echo "<option value='".$filaCliente[0]."'>";
            echo Reemplazar($filaCliente[1]);
            echo "</option>";
        }  
        ?>
    </select>
</div>

<button class="btn btn-primary" onclick="RegistraVenta();" id="btnRegistraVenta">
    <span class="glyphicon glyphicon-floppy-disk"></span> Registrar Venta
</button>


<button style="display: none" type="button" class="btn btn-primary btn-lg" data-toggle="modal" id="btnRegistra" data-target="#ModalVenta">
</button>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModalVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button style="display: none" id="CierraVenta" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel">Registrando Venta</h4>
            </div>
            <div class="modal-body">
                <div style="text-align: center">
                    <img src=<?php echo $url; ?>Imgs/Cargando.gif />
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "../utilerias/piedepagina.php"; ?>