<?php
function ObtenMaximoProducto($PDO){
    $sql = 'SELECT count(*) FROM Inventario';
    $Max = 0;
    foreach ($PDO->query($sql) as $fila) {
        $Max = $fila[0] + 1;        
    }    
    return $Max;
}

function ExisteProducto($PDO, $producto){
    $sql = "SELECT count(*) FROM Inventario where UPPER(NombreProducto)='".strtoupper($producto)."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}

function ValidaProducto($PDO, $user, $pass){
    $sql = "SELECT count(*) FROM Inventario where UPPER(NombreCliente)='".strtoupper($user)."' AND PASS='".$pass."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}
?>