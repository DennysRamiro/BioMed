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
<title>Datos Infocred</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosInfoCred.js"></script>
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
                  <li id="menu_modulo_creditos_infocred">
                    
                     <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> DATOS INFOCRED
                    
                 </li>
              </ul>  


 <div id="menu_lista">

                      <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> DATOS INFOCRED</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Registro Ingresos / Egresos
        </div>
                       
                         <div class="menu_item">
                                <a href="cred_dat_op.php?accion=4"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Validacion de Nombres
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cred_dat_op.php?accion=1"> 
                                    <img src="img/refresh_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Datos Infocred Vig-Ven-Eje
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cred_dat_op.php?accion=2"> 
                                    <img src="img/delete user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Datos Infocred Castigados
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cred_dat_op.php?accion=3"> 
                                    <img src="img/import_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Exportar a Excel
                                </a>
                         </div>

            </div>


<!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cred_dat_op.php?accion=4">Validacion de Nombres</a></li>
    			<li><a href="cred_dat_op.php?accion=1">Datos Infocred Vig-Ven-Eje</a></li>
                <li><a href="cred_dat_op.php?accion=2">Datos Infocred Castigados</a></li>
				<li><a href="cred_dat_op.php?accion=3">Exportar a Excel</a></li>
               
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