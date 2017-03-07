<?php
session_start();
include("conexion.php");
/*
$active_user=$_SESSION["s_username"];
$comprador=$_SESSION["cliente_compras"];
$tienda_origen=$_SESSION["tienda_origen"];*/
$active_user=$_SESSION["s_username"];
$comprador=$_SESSION["cliente_compras"];
$tienda_origen=$_SESSION['tienda_origen'];
$formato='ST_RUTAS';

$carro=$_SESSION['carro'];
$tipo_usuario=$_SESSION["tipo_usuario"];
$enviar_production=$_POST['enviar_production'];
$guardar_production=$_POST['guardar_production'];
$comentarios=$_POST['comentarios'];
$forma_pago=$_POST['forma_pago'];
$cambio_pago=$_POST['cambio_pago'];
$horario_pref=$_POST['horario_pref'];
$hora_aprox=$_POST['hora_aprox'];
$hora_captura=date("H:i:s");
$fecha_pedido=date("Y-m-d");


$sql_one="select id_status_pedido, name_status from status_parameters_servdom where id_status_pedido='1';";
$query_one=odbc_exec($cid, $sql_one) or die ("No se pudo realizar la consulta de la tienda de envio->file: selecciona_registros1.php");
while(odbc_fetch_array($query_one)){
$estado=odbc_result($query_one, "name_status");
}

if(!empty($enviar_production) and isset($_SESSION['carro'])){
$sql_two="select top 1 id_pedido from pedidos_sdv3 order by id_pedido desc";
$query_two=odbc_exec($cid, $sql_two) or die ("No se pudo realizar la consulta del ultimo pedido->file: selecciona_registros1.php");
while(odbc_fetch_array($query_two)){
$id_pedido=odbc_result($query_two, "id_pedido");
}
$id_pedido=$id_pedido+1;


foreach($carro as $k => $v){ 
$descripcion=$v['descripcion'];
$cantidad=$v['cantidad'];
$id=$cod_almacen=$v['id'];
$unidad_medida=$v['unidad_medida'];


 $precio=$v['precio'];
 $subto=$v['cantidad']*$v['precio']; 
 $suma=$suma+$subto; 
 $suma_productos=number_format($suma,2);


 
if ($cantidad<='0' || empty($cantidad)){
unset($carro[md5($id)]);
}//fin de if 
else{
$nvo_pedido=1;
}//fin de else
}//fin de foreach

}
if($nvo_pedido== 1){
$sql="INSERT INTO pedidos_sdv3 (id_pedido, id_cliente, tda_origen, comentarios, hora_captura, fecha_pedido, usuario_servdom, forma_pago, comentarios_servdom, estados, hora_pref, hora_aprox, who_is_ip, proyect_name, suma_totalsistem, formato) VALUES ('$id_pedido', '$comprador', '$tienda_origen',  '$comentarios', '$hora_captura', '$fecha_pedido', '$active_user', '$forma_pago', '$cambio_pago', '$estado', '$horario_pref', '$hora_aprox', '', '', '$suma_productos', '$formato');";
$sql_query=odbc_exec($cid, $sql) or die ("No se pudieron insertar los datos, contacte al administrador del sistema_pedidosqry"); 
$acceso_nvoped=1;
}//fin de if $nvo_pedido
else{

?>

<script language="javascript" type="text/javascript">
    alert("Error, favor de revisar el pedido esta vacio...");
</script>

<?
echo "<meta http-equiv='refresh' content='1; url=selecciona_registros.php'>";

}//fin de else


if ($acceso_nvoped==1){
foreach($carro as $k => $v){ 
$descripcion=$v['descripcion'];
$cantidad=$v['cantidad'];
$id=$cod_almacen=$v['id'];
$unidad_medida=$v['unidad_medida'];
$precio=$v['precio'];
$tipo=$v['tipo'];
$observ_prod=$v['observ_prod'];


$last_number4="SELECT top 1 id_consecutivo, id_pedido from ventas_sdv3 ORDER BY id_consecutivo DESC";
$sql_query4=odbc_exec($cid, $last_number4) or die("No se pudo consultar el ultimo numero");
  while(odbc_fetch_row($sql_query4))
  {
  $numero4=odbc_result($sql_query4, "id_consecutivo");
   }
$last_number4=$numero4+1;//fin_while

if (empty($cantidad)){

unset($carro[md5($id)]);
}//if vacio
else{
echo $sql_insert2="insert into ventas_sdv3 (id_consecutivo, id_pedido, cod_almacen, cantidad_arts, tipo_medida, descripcion, precio_vta, fecha_vta, depto, obs_produc, total_xproduc, tda) values ('$last_number4', '$id_pedido', '$cod_almacen', '$cantidad', '$unidad_medida', '$descripcion', '$precio', '$fecha_pedido', '$tipo', '$observ_prod', '$precio', '$tienda_origen');";
$sql_query=odbc_exec($cid, $sql_insert2) or die("No se pudieron ingresar los datos a la base_ventas");
$confirma_msg=1;
}
}//fin_foreach

if(!empty($confirma_msg)){
include("correo_envio_pedido.php");
?>
<script language="javascript" type="text/javascript">
    alert("Se a enviado correctamente los artículos del pedido a su tienda preferida,  en un momento algún operador telefónico de servicio a domicilio que este disponible se comunicará con usted para gestionar su envio, gracias por su compra...");
</script>
<?
session_destroy();
session_start();
$_SESSION["s_username"]=$active_user;
$_SESSION["cliente_compras"]=$comprador;
$_SESSION['tienda_origen']=$tienda_origen;
$_SESSION["tipo_usuario"]=$tipo_usuario;
echo "<meta http-equiv='refresh' content='4; url=menu2.php'>";
}//fin de if !empty confirma_msg

}//end if
else
if(!empty($guardar_production)){
$sql_two="select top 1 id_pedido from pedidos_lista_sdv3 order by id_pedido desc";
$query_two=odbc_exec($cid, $sql_two) or die ("No se pudo realizar la consulta del ultimo pedido->file: selecciona_registros1.php");
while(odbc_fetch_array($query_two)){
$id_pedido=odbc_result($query_two, "id_pedido");
}
$id_pedido=$id_pedido+1;
$sql="INSERT INTO pedidos_lista_sdv3 (id_pedido, id_cliente, tda_origen, comentarios, hora_captura, fecha_pedido, usuario_servdom, forma_pago, comentarios_servdom, estados, hora_pref, hora_aprox) VALUES ('$id_pedido', '$comprador', '$tienda_origen',  '$comentarios', '$hora_captura', '$fecha_pedido', '$active_user', '$forma_pago', '$cambio_pago', '$estado', '$horario_pref', '$hora_aprox');";
$sql_query=odbc_exec($cid, $sql) or die ("No se pudieron insertar los datos, contacte al administrador del sistema-query listas-$sql");
foreach($carro as $k => $v){ 
$descripcion=$v['descripcion'];
$cantidad=$v['cantidad'];
$cod_almacen=$v['id'];
$unidad_medida=$v['unidad_medida'];
$precio=$v['precio'];
 $tipo=$v['tipo'];
$last_number4="SELECT top 1 id_consecutivo, id_pedido from ventas_lista_sdv3 ORDER BY id_consecutivo DESC";
$sql_query4=odbc_exec($cid, $last_number4) or die("No se pudo consultar el ultimo numero");
  while(odbc_fetch_row($sql_query4))
  {
  $numero4=odbc_result($sql_query4, "id_consecutivo");
   }
$last_number4=$numero4+1;
if (empty($cantidad)){
//$sql_insert2="insert into ventas_sdv3 (id_consecutivo, id_pedido, cod_almacen, cantidad_arts, tipo_medida, descripcion, precio_vta, fecha_vta, depto) values ('$last_number4', '$id_pedido', '$cod_almacen', '$cantidad', '$unidad_medida', '$descripcion', '$precio', '$fecha_pedido', '$tipo');";
//$sql_query=odbc_exec($cid, $sql_insert2) or die("No se pudieron ingresar los datos a la base");
//
//echo "entro a vacio";
//echo "<br>";
}//if vacio
else{
$sql_insert2="insert into ventas_lista_sdv3 (id_consecutivo, id_pedido, cod_almacen, cantidad_arts, tipo_medida, descripcion, precio_vta, fecha_vta, depto) values ('$last_number4', '$id_pedido', '$cod_almacen', '$cantidad', '$unidad_medida', '$descripcion', '$precio', '$fecha_pedido', '$tipo');";
$sql_query=odbc_exec($cid, $sql_insert2) or die("No se pudieron ingresar los datos a la base");
}//fin de if

}//fin de 


?>

<script language="javascript" type="text/javascript">
    alert("Se ha guardado correctamente su lista de compras, en cuanto la necesite solo tiene que agragarla como pedido, gracias por utilizar este apartado...");
</script>

<?
session_destroy();
session_start();

$_SESSION["s_username"]=$active_user;
$_SESSION["cliente_compras"]=$comprador;
$_SESSION['tienda_origen']=$tienda_origen;
$_SESSION["tipo_usuario"]=$tipo_usuario;
echo "<meta http-equiv='refresh' content='4; url=selecciona_registros.php'>";
}



?>