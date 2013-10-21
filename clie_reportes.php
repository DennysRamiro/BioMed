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
                <title>Reportes de Clientes</title>
                <link href="css/estilo.css" rel="stylesheet" type="text/css">
                <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
                <script type="text/javascript" src="js/ClienteManteDetalle.js"></script> 
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
                 <li id="menu_modulo_clientes">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CLIENTES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CLIENTES
                    
                 </li>
              </ul>  
        <?php
        // Se realiza una consulta SQL a tabla gral_param_propios
        //$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
        //$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
         ?>
<div id="menu_lista">

                      <h2> <img src="img/tools_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CLIENTES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
              Reportes de Cartera
        </div>
                        <div class="menu_item">
                                <a href="alta_con_mod_c.php?accion=1"> 
                                    <img src="img/paste_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle de Clientes
                                </a>
                         </div>
            </div>



          <!--div id="ListaSeleccion">
                     <ul>
        			    <li><a href="clie_rep_op.php?accion=1">Detalle de Clientes</a></li>
            			
        		    </ul>
          </div-->
        <!--div id="FooterTable"> 
        Reportes de Cartera
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