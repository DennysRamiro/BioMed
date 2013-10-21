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
<title>Saldo Final Cajas</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/cajas_saldo_final.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
</head>
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
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS 
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/notepad_32x32.png" border="0" alt="Modulo" align="absmiddle"> SALDO FINAL CAJAS
                    
                 </li>
              </ul>    
<!--div id="ListaSeleccion">

             <ul>
    			<li><a href="caja_retro.php?accion=1">Saldo final Bolivianos</a></li>
                <li><a href="caja_retro.php?accion=2">Saldo final Dolares</a></li>
				<li><a href="caja_retro.php?accion=3">Salir</a></li>
   		    </ul>
  </div-->
  <!--Cabecera del modulo con su alerta-->
 <div id="menu_lista">
                      <h2> <img src="img/notepad_64x64.png" border="0" alt="Modulo" align="absmiddle">SALDO FINAL CAJAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Saldo Final Cajas
                     </div>
                     <!--Creacion de los Submodulos-->
                        <div class="menu_item">
                                <a href="caja_retro.php?accion=1"> 
                                    <img src="img/shield1_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Saldo Final Bs
                                </a>
                         </div>
    
                        <div class="menu_item">
                                <a href="caja_retro.php?accion=2"> 
                                    <img src="img/shield3_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Saldo Final $us
                                </a>
                         </div>
                          
                        <!--div class="menu_item">
                                <a href="caja_retro.php?accion=3"> 
                                    <img src="img/block_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Salir
                                </a>
                         </div-->
   </div>
<!--div id="FooterTable"> 
<BR><B><FONT SIZE=+1><MARQUEE>Saldo Final Cajas</MARQUEE></FONT></B>
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