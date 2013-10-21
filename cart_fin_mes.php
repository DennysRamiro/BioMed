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
<title>Cierre de Mes</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script>
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
 
                 <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> PROC. FIN DE MES
                    
                 </li>
              </ul>  
    	
          
<div id="menu_lista">

                      <h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle"> PROCESOS FIN DE MES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Reportes de Cartera
        </div>
                        
                        
                         
                         <div class="menu_item">
                                <a href="cart_cal_op.php?accion=1"> 
                                    <img src="img/directories_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Calificacion
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_cal_op.php?accion=2"> 
                                    <img src="img/documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Devengamiento Interes
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cart_cal_op.php?accion=3"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Facturacion Devengado
                                </a>
                         </div>

            </div>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cart_cal_op.php?accion=1">Calificacion</a></li>
				<li><a href="cart_cal_op.php?accion=2">Devengamiento Interes</a></li>
    			<li><a href="cart_cal_op.php?accion=3">Facturacion Devengado</a></li>
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