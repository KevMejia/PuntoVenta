<?php

function ObtenMaximoUsuario($PDO){
    $sql = 'SELECT count(*) FROM usuarios';
    $Max = 0;
    foreach ($PDO->query($sql) as $fila) {
        $Max = $fila[0] + 1;        
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

function Reemplazar($str){
    $search  = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ñ', 'ñ');
    $replace = array('&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', 
        '&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&Ntilde;', '&ntilde;');
    return str_replace($search, $replace, $str);
}

?>