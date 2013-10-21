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
<title>Reportes de Chequeras</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
<script type="text/javascript" src="js/cjas_depret_depbs.js"></script>  
<script type="text/javascript" src="js/cjas_chequeras.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script>
</head>
<body><?php
                include("header.php");
            ?>
<div id="pagina_sistema">
    <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>


                  <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                   <li id="menu_modulo_cjas_chequera">
                    
                     <img src="img/checkera_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP.CHEQUERA
                    
                 </li>
              </ul>  
    	
         <?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
                ?> 
			
<?php

 ?>
<div id="menu_lista">

                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CHEQUERAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
            Reportes de Recibos
        </div-->
                        
                         <div class="menu_item">
                                <a href="con_retro_cheq.php?accion=3"> 
                                    <img src="img/checkmark_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Cheques Utilizados 
                                </a>
                         </div>
						
                       
                         <div class="menu_item">
                                <a href="con_retro_cheq.php?accion=4"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Cheques NO Utilizados
                                </a>
                         </div>
						   <div class="menu_item">
                                <a href="con_retro_cheq.php?accion=55"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Conciliacion por Cuenta 
                                </a>
                         </div> 

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