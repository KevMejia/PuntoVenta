<img src="img_page/anim1.gif"
<?php 
$mail = "kevin_me_ga@hotmail.com";
$name_completo = "Kevin Mejia";
$t_asignada = "0000";

$destinatario = "$mail, correo.angelm@gmail.com, proy2000_2@hotmail.com"; 

$asunto = "BIENVENIDA(O) A LA TIENDA EN LINEA DE SUPER KOMPRAS 'LAS TIENDAS DE CASA'"; 
$cuerpo = "

Mensaje de bienvenida(o)


Estimada(o)$name_completo, 
<br><br>
A nuestra tienda en linea de Super kompras 'Las tiendas de casa',  en esta Tda $t_asignada, podrás encontrar desde productos básicos, de primera necesidad, hasta electrónica y muebles<br> *Aplican restricciones<br> pregunte por la disposicion en tiendas


<br><br>
<img src='http://wwww.superkompras.com.mx:8008/spadweb/img_page/anim1.gif' />
<br>
<img src='img_page/anim1.gif'>
<br><br>
Contamos con servicio a domicilio llamenos 01 800 2025907<br>
*Aplican restricciones<br>
*cobro de tarifa por zonas<br> 

<br><br>
<a href='.'>Accesa a la tienda </a>
<br><br>

<br><br>
Mje automático enviado desde:<br>
SPADWEB MODULE SKCOMMERCE v1.0, FAVOR DE NO RESPONDER A ESTE E-MAIL,<BR>PLEASE DO NOT RESPOND TO THIS E-MAIL<br><br>
SITE DESIGN FOR SOLTECN,<BR>COPYRIGHT 2009-2012 AJMV<BR>WEB MASTER ANGEL MEDINA VILLA,<BR><BR>EMAIL<BR> PROY2000_2@HOTMAIL.COM
";

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: TIENDA VIRTUAL DE SUPER KOMPRAS 'LAS TIENDAS DE CASA'<correo.angelm@gmail.com>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
$headers .= "Reply-To: angel.medina@tiendasgarces.com\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: angel.medina@tiendasgarces.com\r\n"; 

/*
if ($puesto=='MERCADEADOR_CURSO' || $puesto=='MANDOS_CURSO' || $puesto=='ADMIN_CURSO'){
//direcciones que recibián copia 
$headers .= "Cc: monica.soto@tiendasgarces.com\r\n"; 
}*/
//direcciones que recibirán copia oculta 
$headers .= "Bcc: correo.angelm@gmail.com,angel.medina@tiendasgarces.com\r\n"; 

try{
	mail($destinatario,$asunto,$cuerpo,$headers);
}
catch(Exception $e){
    echo $e->getMessage();
}


?> 