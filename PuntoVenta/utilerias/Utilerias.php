<?php

function ObtenMaximoUsuario($PDO){
    $sql = 'SELECT count(*) FROM usuarios';
    $Max = 0;
    foreach ($PDO->query($sql) as $fila) {
        $Max = $fila[0];        
    }    
    return $Max;
}

function ExisteUsuario($PDO, $user){
    $sql = "SELECT count(*) FROM usuarios where UPPER(NombreUsuario)='".strtoupper($user)."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}

function ValidaUsuario($PDO, $user, $pass){
    $sql = "SELECT count(*) FROM usuarios where UPPER(NombreUsuario)='".strtoupper($user)."' AND PASS='".$pass."'";
    $existe = false;
    foreach ($PDO->query($sql) as $fila) {
        $existe = $fila[0] > 0;        
    }    
    return $existe;
}

?>