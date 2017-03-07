<?php
try{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    session_destroy();
}catch(Exception $e){
    echo "ERROR: ".$e->getMessage();
}

?>