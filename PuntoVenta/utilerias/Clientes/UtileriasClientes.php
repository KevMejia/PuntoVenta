<?php
function ObtenMaximoCliente($PDO){
    $sql = 'SELECT count(*) FROM clientes';
    $Max = 0;
    foreach ($PDO->query($sql) as $fila) {
        $Max = $fila[0];        
    }    
    return $Max;
}

function ExisteCliente($PDO, $user){
    $sql = "SELECT count(*) FROM clientes where UPPER(NombreCliente)='".strtoupper($user)."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}

function ValidaCliente($PDO, $user, $pass){
    $sql = "SELECT count(*) FROM clientes where UPPER(NombreCliente)='".strtoupper($user)."' AND PASS='".$pass."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}
?>