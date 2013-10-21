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
<!--Titulo de la pestaña de la pagina-->
<title>Mantenimiento Solicitud</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <script type="text/javascript" src="js/ModulosCreditosSolicitud.js"></script>
</head>
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
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
              </ul>  
  
   
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
 ?>



 <div id="menu_lista">

                      <h2> <img src="img/clock_64x64.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
            Alta, Consulta, Modificaci&oacute;n de solicitudes
        </div>
                        <div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=1"> 
                                    <img src="img/add user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Alta
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=2"> 
                                    <img src="img/search_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Modificar
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=3"> 
                                    <img src="img/edit_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Consultar
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=8"> 
                                    <img src="img/directories_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Plan de Pagos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=9"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Boleta de Cobro
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=7"> 
                                    <img src="img/refresh_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Reversion Solicitud
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=6"> 
                                    <img src="img/delete user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Reversion Estado
                                </a>
                         </div>
                         <!--div class="menu_item">
                                <a href="solic_retro_sol_1.php?accion=4"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Salir
                                </a>
                         </div-->

            </div>



<!--div id="ListaSeleccion">
             <ul>
    			<li><a href="solic_retro_sol_1.php?accion=1">Alta</a></li>
                <li><a href="solic_retro_sol_1.php?accion=2">Modificar</a></li>
                <li><a href="solic_retro_sol_1.php?accion=3">Consultar</a></li>
				<li><a href="solic_retro_sol_1.php?accion=8">Plan de Pagos</a></li>
				<li><a href="solic_retro_sol_1.php?accion=9">Boleta de Cobro</a></li>
				<li><a href="solic_retro_sol_1.php?accion=7">Reversion Solicitud</a></li>
				<li><a href="solic_retro_sol_1.php?accion=6">Reversion Estado</a></li>
				<li><a href="solic_retro_sol_1.php?accion=4">Salir</a></li>
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