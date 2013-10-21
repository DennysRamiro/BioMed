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
<!--Titulo de la pesta?a de la pagina-->
<title>Reportes de Facturacion</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
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
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_facturacion">
                    
                     <img src="img/FAX_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION
                    
                 </li>
                   <li id="menu_modulo_reporte">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES
                    
                 </li>
				 <li id="menu_modulo_fecha">
                    
                     <img src="img/compra_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES COMPRA
                    
                 </li>
              </ul>  
    	
         <?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
                ?> 
			
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
 ?>
 <div id="menu_lista">

                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPORTES COMPRA </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
        Reportes / Compra </div-->
                        <div class="menu_item">
                                <a href="fac_rep_op.php?accion=11"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Libro Compras
                                </a>
    </div>
                         <div class="menu_item">
                                <a href="fac_rep_op.php?accion=12"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Libro Compra Por Rangos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="fac_rep_op.php?accion=13"> 
                                    <img src="img/documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Compra (Texto)
                                </a>
                         </div>
                        

  </div>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="fac_rep_op.php?accion=1">Libro Ventas</a></li>
    			<li><a href="fac_rep_op.php?accion=2">Libro Ventas Por Rangos</a></li>
                <li><a href="fac_rep_op.php?accion=3">Ventas (Texto)</a></li>
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