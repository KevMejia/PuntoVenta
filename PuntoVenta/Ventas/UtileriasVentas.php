<?php
include "../utilerias/Utilerias.php";

function ObtenMaximaVenta($PDO){
    $sql = 'SELECT count(*) FROM Ventas';
    $Max = 0;
    foreach ($PDO->query($sql) as $fila) {
        $Max = $fila[0] + 1;        
    }    
    return $Max;
}

function ObtenCostoProducto($PDO, $idProducto){
    $costos= array();
    for($cont=0; $cont < count($idProducto); $cont++){
        $sql = 'SELECT Costo FROM Inventario where idProducto='.$idProducto[$cont];
        $costo = 0;
        foreach ($PDO->query($sql) as $fila) {
            $costo = $fila[0];   
            array_push($costos, $costo);
        }    
    }
    
    return $costos;
}

function EnviaCorreo($PDO, $idCliente, $costoProducto, $NumProductos, $idProducto){
    $sqlNombreCliente = 'SELECT Nombrecliente, CorreoElectronico FROM Clientes where idCliente='.$idCliente;
    $nombreCliente ="";
    $correoCliente="";
    foreach ($PDO->query($sqlNombreCliente) as $filaNombre) {
        $nombreCliente = $filaNombre[0];  
        $correoCliente = $filaNombre[1]; 
    }    

    $nombreProducto =array();
    for($cont=0; $cont < count($idProducto); $cont++){
        $sqlNombreProducto = 'SELECT NombreProducto FROM Inventario where idProducto='.$idProducto[$cont];
        
        foreach ($PDO->query($sqlNombreProducto) as $filaProducto) {
            array_push($nombreProducto, $filaProducto[0]);        
        } 
    }
    $costoTotal=0;

    
    $cuerpoMensaje = ' 
<html> 
<head> 
   <title>Comprobante de Pago - Isima</title> 
</head> 
<body> 
<style>
tbody tr:nth-child(odd) {
   background-color: #ccc;
}
thead > tr > td{
font-weight:900;
}

</style>
<h4>'.'Estimado(a) '.$nombreCliente.'.</h4> 
<p /> 
<h5>';
    $cuerpoMensaje .= "Se le hace llegar este correo electrónico como confirmación de su compra </h5> ";

    $cuerpoMensaje .= "<table style='width:90%; margin:auto'><thead><tr>"
        ."<td style='width:10%'>Número Productos</td>"
        ."<td style='width:70%'>Nombre del Producto</td>"
        ."<td style='width:20%'>Costo</td></tr></thead><tbody>";

    for($cont=0; $cont < count($idProducto); $cont++){
        $cuerpoMensaje.="<tr>";
        $cuerpoMensaje.="<td>".$NumProductos[$cont]."</td>";
        $cuerpoMensaje.="<td>".$nombreProducto[$cont]."</td>";
        $cuerpoMensaje.="<td>$".number_format(($costoProducto[$cont]), 2)."</td>";
        $cuerpoMensaje.="</tr>";

        $costoTotal += $costoProducto[$cont];
    }

    $cuerpoMensaje .= "<td></td><td style='font-weight:600;'>Costo Total</td>"
        ."<td  style='font-weight:600;'>$".number_format(($costoTotal), 2)."</td>";

    $cuerpoMensaje .= "</tbody></table>";


    $cuerpoMensaje .='<br />
</body> 
</html>'; 

    return EnviaMail($correoCliente, $nombreCliente, "Comprobante de pago", Reemplazar($cuerpoMensaje));
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