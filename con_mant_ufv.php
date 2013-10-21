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
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/mante_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. DE UFV'S
                    
                 </li>
              </ul>  
  


<div id="menu_lista">

                      <h2> <img src="img/mante_64x64.png" border="0" alt="Modulo" align="absmiddle"> MANTENIMIENTO DE UFV'S</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
            Registro  Asiento Contable
        </div-->
                        
                         <div class="menu_item">
                                <a href="con_retro.php?accion=30"> 
                                    <img src="img/save_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Actualizaci&oacute;n UFV's
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=31"> 
                                    <img src="img/search_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Consulta de UFV's
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=32"> 
                                    <img src="img/asiento1_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Asiento 1
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="con_retro.php?accion=33"> 
                                    <img src="img/asiento2_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Asiento 2
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=34"> 
                                    <img src="img/asiento3_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Asiento 3
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=35"> 
                                    <img src="img/asiento4_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Asiento 4
                                </a>
                         </div>
                          <!--div class="menu_item">
                                <a href="con_retro.php?accion=4"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Salir
                                </a>
                         </div-->

            </div>
   	

<br><br>
<!--div id="ListaSeleccion">
             <ul>
    			<li><a href="con_retro.php?accion=30">Actualizaci�n UFV's</a></li>
                <li><a href="con_retro.php?accion=31">Consulta de UFV�s</a></li>
				<li><a href="con_retro.php?accion=32">Asiento 1</a></li>
				<li><a href="con_retro.php?accion=33">Asiento 2</a></li>
				<li><a href="con_retro.php?accion=34">Asiento 3</a></li>
				<li><a href="con_retro.php?accion=35">Asiento 4</a></li>
				<li><a href="con_retro.php?accion=4">Salir</a></li>
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