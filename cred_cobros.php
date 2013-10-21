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
<title>Cobro Creditos</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosCobros.js"></script>
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
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> COBROS
                    
                 </li>
              </ul>  


 <div id="menu_lista">

                      <h2> <img src="img/officer_64x64.png" border="0" alt="Modulo" align="absmiddle"> COBROS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Cobro de Creditos
        </div>
                       
                         <div class="menu_item">
                                <a href="cobros_op.php?accion=11"> 
                                    <img src="img/new_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Hoja de Cobro
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op.php?accion=3"> 
                                    <img src="img/directories_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Proximos Vencimientos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op.php?accion=8"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Vencimiento Final
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op.php?accion=6"> 
                                    <img src="img/refresh_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle Mora
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op.php?accion=7"> 
                                    <img src="img/delete user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Detalle Mora por Asesor
                                </a>
                         </div>
                         <!--div class="menu_item">
                                <a href="cobros_op.php?accion=4"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Salir
                                </a>
                         </div-->

            </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
 ?>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cobros_op.php?accion=1">Hoja de Cobro</a></li>
    			<li><a href="cobros_op.php?accion=3">Proximos Vencimientos</a></li>
				<li><a href="cobros_op.php?accion=8">Vencimiento Final</a></li>
				<li><a href="cobros_op.php?accion=6">Detalle Mora</a></li>
				<li><a href="cobros_op.php?accion=7">Detalle Mora por Asesor</a></li>
                <li><a href="cobros_op.php?accion=4">Salir</a></li>
    
		    </ul>
  </div-->

       
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