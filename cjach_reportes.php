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
<meta charset="UTF-8">
<!--Titulo de la pestaña de la pagina-->
<title>Reportes de Caja</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/cajas_vales.js"></script> 
<script type="text/javascript" src="js/ModulosCajaChica.js"></script> 
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
                 <li id="menu_modulo_cajachica">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_cajachica_reportes">
                    
                     <img src="img/paste_24x24.png" border="0" alt="Modulo" align="absmiddle"> CAJA CHICA REPORTES
                    
                 </li>
                
              </ul>  


    
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
 ?>
<!--Cabecera del modulo con su alerta-->
 <div id="menu_lista">
                      <h2> <img src="img/paste_64x64.png" border="0" alt="Modulo" align="absmiddle">CAJA CHICA REPORTES</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Cobro de Creditos
                     </div-->
                     <!--Creacion de los Submodulos-->
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=1"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle de Movimientos
                                </a>
                         </div>
                      <!--   
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=2"> 
                                    <img src="img/fax_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Resumen Movimientos Caja
                                </a>
                         </div>
                          
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=3"> 
                                    <img src="img/basket_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle Ingresos/Egresos
                                </a>
                         </div>
                         
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=7"> 
                                    <img src="img/open_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle Ingresos/Egresos por Cuenta
                                </a>
                         </div>
                          
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=4"> 
                                    <img src="img/officer_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle Movimientos Bancos
                                </a>
                         </div> 
                          -->
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=5"> 
                                    <img src="img/export_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle Asignaciones 
                                </a>
                         </div>
                         <!--   
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=6"> 
                                    <img src="img/add box_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Compra/Venta Divisas
                                </a>
                         </div>
                          -->
                        <div class="menu_item">
                                <a href="cjach_rep_op.php?accion=12"> 
                                    <img src="img/add box_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle Transacciones Revertidas
                                </a>
                         </div>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cjach_rep_op.php?accion=1">Detalle de Movimientos</a></li>
    			<li><a href="cjach_rep_op.php?accion=2">Resumen Movimientos Caja</a></li>
                <li><a href="cjach_rep_op.php?accion=3">Detalle Ingresos/Egresos</a></li>
				<li><a href="cjach_rep_op.php?accion=7">Detalle Ingresos/Egresos por Cuenta</a></li>
				<li><a href="cjach_rep_op.php?accion=4">Detalle Movimientos Bancos</a></li>
				<li><a href="cjach_rep_op.php?accion=5">Detalle Movimientos Vales</a></li>
				<li><a href="cjach_rep_op.php?accion=6">Detalle Compra/Venta Divisas</a></li>
                <li><a href="cjach_rep_op.php?accion=12">Detalle Transacciones Revertidas</a></li>
				
    
		    </ul>
  </div-->   
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