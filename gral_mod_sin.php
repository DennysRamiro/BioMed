<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
	require('configuracion.php');
    require('funciones.php');
?>
<html>
  <head>
        <title>Que Modulos no cerraron</title>
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/CambiarFecha.js"></script>
  </head>
<body>
	
		 <?php
				include("header.php");
			?>
          <div id="pagina_sistema">
     
        <ul id="lista_menu">
         <li id="menu_modulo">
            <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
         </li>
         <li id="menu_modulo_general">
            <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
        </li>
        <li id="menu_modulo_fecha_cambio">
            <img src="img/calendar_24x24.png" border="0" alt="Modulo" align="absmiddle"> CAMBIO DE FECHA
        </li>
        <li id="menu_modulo_fecha_cambio2">
            <img src="img/options_24x24.png" border="0" alt="Modulo" align="absmiddle"> VERIFICAR MÓDULOS
        </li>
       </ul>  
		<div id="contenido_modulo">
       <h2> <img src="img/options_64x64.png" border="0" alt="Modulo" align="absmiddle"> VERIFICAR MÓDULOS
    </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Verifique los Módulos no cerrados
 </div>
        <!--strong> <center>       Verifique los Módulos no cerrádos: </center></strong--> 

        <!--form name="form2" method="post" action="menu_s.php"-->        
          <table ALIGN="center">
              <?php
			  $cart = $_SESSION['cart'];
		      $cart_tras = $_SESSION['cart_tras'];
		      $caja = $_SESSION['caja'];
		      $fgar = $_SESSION['fgar'];
		      $comven = $_SESSION['comven'];
		      $ingegre = $_SESSION['ingegre'];
		      $bancos = $_SESSION['bancos'];
		      $factura = $_SESSION['factura'];
		      $almacen = $_SESSION['almacen'];
		      $ventas = $_SESSION['ventas'];
		      $caja_ch = $_SESSION['caja_ch'];
			  
			  
               if ($cart == 1) {
             ?> <tr><td><?php msgError2("No cerró CARTERA!!!");?></td> </tr> <?php
              } 
              if ($comven == 1) {
             ?> <tr><td><?php msgError2("No cerró COMPRA VENTA DIVISAS!!!"); ?></td></tr> <?php
              } 
              if ($ingegre == 1) {
             ?> <tr><td><?php  msgError2("No cerró INGRESOS Y EGRESOS!!!");  ?></td></tr> <?php
              } 
			        if ($bancos == 1) {
             ?> <tr><td><?php   msgError2("No cerró BANCOS!!!"); ?></td></tr> <?php
              } 
			        if ($factura == 1) {
             ?> <tr><td><?php   msgError2("No cerró FACTURACION!!!"); ?></td></tr> <?php 
              } 
			        if ($almacen == 1) {
             ?> <tr><td><?php   msgError2("No cerró ALMACEN!!!"); ?></td></tr> <?php 
              }
			        if ($ventas == 1) {
             ?> <tr><td><?php   msgError2("No cerró VENTAS!!!"); ?></td></tr> <?php 
              }
			        if ($caja_ch == 1) {
             ?> <tr><td><?php   msgError2("No cerró CAJA CHICA!!!"); ?></td></tr> <?php 
              }
          ?>  
        
        </table>
        
        </div>
        </div>
         <?php
		 	include("footer_in.php");
		 ?>

</body>
</html>
 <?php
}
 ob_end_flush();
?> 