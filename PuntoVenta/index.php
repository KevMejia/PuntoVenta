<?php include "utilerias/encabezado.php"; ?>
<?php include "utilerias/Utilerias.php";

$mensajeBienvenida = "Ésta es la página principal del Punto de Venta, puedes navegar en el sitio utilizando las opciones del menú superior"

?>

<div class="container">
  <div class="jumbotron">
    <h1>Punto de Venta</h1> 
    <p><?php echo Reemplazar($mensajeBienvenida); ?></p> 
  </div>  
</div>


<?php include "utilerias/piedepagina.php"; ?>