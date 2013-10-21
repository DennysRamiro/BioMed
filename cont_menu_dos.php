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
<!--Titulo de la pesta�a de la pagina-->
<title><?php echo $_SESSION['COD_EMPRESA']; ?></title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
</head>
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
				  </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> DOSIFICACION
                    
                 </li>
              </ul>  
  


<div id="menu_lista">

                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle"> DOSIFICACION</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
            Registro / Dosificaci&oacute;n
        </div-->
                        <div class="menu_item">
                                <a href="con_retro.php?accion=21"> 
                                    <img src="img/computer_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Computarizado
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=21i"> 
                                    <img src="img/edit user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Manual
                                </a>
                         </div>
                       
                         <!--div class="menu_item">
                                <a href="con_retro.php?accion=24"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Salir
                                </a>
                         </div-->

  </div>
<br><br>
<!--div id="ListaSeleccion">
             <ul>
    			<li><a href="con_retro.php?accion=21">Dosificacion</a></li>
                <li><a href="con_retro.php?accion=22">Consulta de Factura</a></li>
				<li><a href="con_retro.php?accion=23">Reportes </a></li>
				<li><a href="con_retro.php?accion=25">Verifica Codigo </a></li>

				<li><a href="con_retro.php?accion=24">Salir</a></li>
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