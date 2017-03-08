<?php
function ObtenMaximaVenta($PDO){
    $sql = 'SELECT count(*) FROM Ventas';
    $Max = 0;
    foreach ($PDO->query($sql) as $fila) {
        $Max = $fila[0] + 1;        
    }    
    return $Max;
}

function ObtenCostoProducto($PDO, $idProducto){
    $sql = 'SELECT Costo FROM Inventario where idProducto='.$idProducto;
    $costo = 0;
    foreach ($PDO->query($sql) as $fila) {
        $costo = $fila[0];        
    }    
    return $costo;
}

function EnviaCorreo($PDO, $idCliente, $costoProducto, $NumProductos, $idProducto){
    $sqlNombreCliente = 'SELECT Nombrecliente, CorreoElectronico FROM Clientes where idCliente='.$idCliente;
    $nombreCliente ="";
    $correoCliente="";
    foreach ($PDO->query($sqlNombreCliente) as $filaNombre) {
        $nombreCliente = $filaNombre[0];  
        $correoCliente = $filaNombre[1]; 
    }    

    $sqlNombreProducto = 'SELECT NombreProducto FROM Inventario where idProducto='.$idProducto;
    $nombreProducto ="";
    foreach ($PDO->query($sqlNombreProducto) as $filaProducto) {
        $nombreProducto = $filaProducto[0];        
    } 

    $cuerpoMensaje = "Estimado(a) ". $nombreCliente."\n\n";
    $cuerpoMensaje .= "Se le hace llegar este correo electrónico como confirmación de su compra de "
        .$NumProductos." ".$nombreProducto." con un costo total de $".($costoProducto * $NumProductos);

    return mail($correoCliente,"Comprobante de pago", $cuerpoMensaje);
}

?>