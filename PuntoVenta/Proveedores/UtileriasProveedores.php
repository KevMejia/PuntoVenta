<?php
function ObtenMaximoProveedor($PDO){
    $sql = 'SELECT count(*) FROM Proveedores';
    $Max = 0;
    foreach ($PDO->query($sql) as $fila) {
        $Max = $fila[0] + 1;        
    }    
    return $Max;
}

function ExisteProveedor($PDO, $user){
    $sql = "SELECT count(*) FROM Proveedores where UPPER(NombreProveedor)='".strtoupper($user)."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}

function ValidaProveedor($PDO, $user, $pass){
    $sql = "SELECT count(*) FROM Proveedores where UPPER(NombreProveedor)='".strtoupper($user)."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}
?>