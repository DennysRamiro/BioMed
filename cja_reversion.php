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
<title>Reversion de Transacciones </title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/cajas_rev_trans.js"></script> 
</head>
<body>
<?php
                include("header.php");
            ?>
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
              </ul>    
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
 ?>

 <!--Cabecera del modulo con su alerta-->
 <div id="menu_lista">
                      <h2> <img src="img/import_64x64.png" border="0" alt="Modulo" align="absmiddle">REVERSION DE TRANSACCIONES</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Bancos / Compra Venta de Divisas / Vales / Ingresos/Egresos
                     </div-->
                     <!--Creacion de los Submodulos-->
                        <!--div class="menu_item">
                                <a href="cja_rev_op.php?accion=1"> 
                                    <img src="img/down_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Desembolsos
                                </a>
                         </div>
                          
                        <div class="menu_item">
                                <a href="cja_rev_op.php?accion=2"> 
                                    <img src="img/calculator_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Cobros
                                </a>
                         </div-->
                          
                        <div class="menu_item">
                                <a href="cja_rev_op.php?accion=3"> 
                                    <img src="img/bancos_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Bancos
                                </a>
                         </div>
                          
                        <!--div class="menu_item">
                                <a href="cja_rev_op.php?accion=4"> 
                                    <img src="img/clock_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Fondos de Garantia
                                </a>
                         </div-->
                          
                        <div class="menu_item">
                                <a href="cja_rev_op.php?accion=5"> 
                                    <img src="img/add box_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Compra Venta de Divisas
                                </a>
                         </div>
                          
                        <div class="menu_item">
                                <a href="cja_rev_op.php?accion=6"> 
                                    <img src="img/label_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Vales
                                </a>
                         </div>
                          
                        <div class="menu_item">
                                <a href="cja_rev_op.php?accion=7"> 
                                    <img src="img/basket_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Ingresos/Egresos
                                </a>
                         </div>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cja_rev_op.php?accion=1">Desembolsos</a></li>
    			<li><a href="cja_rev_op.php?accion=2">Cobros</a></li>
                <li><a href="cja_rev_op.php?accion=3">Bancos</a></li>
                <li><a href="cja_rev_op.php?accion=4">Fondos de Garantia</a></li>
				<li><a href="cja_rev_op.php?accion=5">Compra Venta de Divisas</a></li>
				<li><a href="cja_rev_op.php?accion=6">Vales</a></li>
				<li><a href="cja_rev_op.php?accion=7">Ingresos/Egresos</a></li>
    
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