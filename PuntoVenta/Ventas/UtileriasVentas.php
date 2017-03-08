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

    
    $cuerpoMensaje = ' 
<html> 
<head> 
   <title>Comprobante de Pago - Isima</title> 
</head> 
<body> 
<h4>'.'Estimado(a) '.$nombreCliente.'.</h4> 
<p /> 
<h5>';
    $cuerpoMensaje .= "Se le hace llegar este correo electrónico como confirmación de su compra de "
        .$NumProductos." ".$nombreProducto." con un costo total de $".number_format(($costoProducto * $NumProductos), 2);
    
    $cuerpoMensaje.= '.</h5> 
<br />
</body> 
</html>'; 

    return EnviaMail($correoCliente, $nombreCliente, "Comprobante de pago", $cuerpoMensaje);
}


function EnviaMail($correoCliente, $nombreCliente, $sujeto, $cuerpoMensaje){
    require("../utilerias/phpmailer/PHPMailerAutoload.php");
    $correo = "KevMejia92@gmail.com";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug  = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = $correo;
    $mail->Password = "Abc592466";
    $mail->SetFrom($correo, 'Isima');

    //Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
    //$mail->AddReplyTo('replyto@correoquesea.com','El de la réplica');

    $mail->AddAddress($correoCliente, $nombreCliente);
    $mail->Subject = $sujeto;
    $mail->MsgHTML($cuerpoMensaje);
    //$mail->AltBody = $cuerpoMensaje;

    if(!$resultado=$mail->Send()) 
        $error = $mail->ErrorInfo;
    return $resultado;
}

?>