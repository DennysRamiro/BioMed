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
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
              </ul> 

<!--Cabecera del modulo con su alerta-->
 <div id="menu_lista">

                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO ASIENTO CONTABLE</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
            Registro/Consulta Asiento Contable, Asiento de Revalorizacion, Reserva de Asientos, Utilizar Reservados
        </div-->
                        <div class="menu_item">
                                <a href="con_retro.php?accion=1"> 
                                    <img src="img/add user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Registro Asiento Contable
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=2"> 
                                    <img src="img/search_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Consulta de Asiento Contable
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=3"> 
                                    <img src="img/edit_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Asiento de Revalorizacion
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=8"> 
                                    <img src="img/games_64X64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Reserva de Asientos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=9"> 
                                    <img src="img/import_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Utilizar Reservados
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

<!--div id="ListaSeleccion">
             <ul>
    			<li><a href="con_retro.php?accion=1">Registro Asiento Contable</a></li>
                <li><a href="con_retro.php?accion=2">Consulta de Asiento Contable</a></li>
				<li><a href="con_retro.php?accion=3">Asiento de Revalorizacion</a></li>
				<li><a href="con_retro.php?accion=8">Reserva de Asientos</a></li>
				<li><a href="con_retro.php?accion=9">Utilizar Reservados</a></li>
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