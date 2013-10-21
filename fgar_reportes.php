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
<title>Reportes Fondo de Garantia</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/reportes_fondo.js"></script>
</head>
<body>
    <?php
                include("header.php");
            ?>
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
              </ul>
    	<!--Cabecera del modulo con su alerta-->
            <div id="menu_lista">
                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPORTES FONDO GARANTIA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                        Reportes de Cartera
                     
                     </div>
                     <!--Creacion de los Submodulos-->
                        <div class="menu_item">
                                <a href="fgar_rep_op.php?accion=1"> 
                                    <img src="img/my documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Resumen Por Moneda
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="fgar_rep_op.php?accion=2"> 
                                    <img src="img/stuff_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Resumen Por Producto
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="fgar_rep_op.php?accion=3"> 
                                    <img src="img/user office_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Resumen por Oficial de Negocios
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="fgar_rep_op.php?accion=4"> 
                                    <img src="img/copy_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle de Fondo de Garantia
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="fgar_rep_op.php?accion=6"> 
                                    <img src="img/credit card_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle de Fond. Gar. con Creditos Cancelados
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="fgar_rep_op.php?accion=5"> 
                                    <img src="img/edit file_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle de Movimientos
                                </a>
                         </div>

<?php

 ?>

 
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="fgar_rep_op.php?accion=1">Resumen Por Moneda</a></li>
    			<li><a href="fgar_rep_op.php?accion=2">Resumen Por Producto</a></li>
                <li><a href="fgar_rep_op.php?accion=3">Resumen por Oficial de Negocios</a></li>
                <li><a href="fgar_rep_op.php?accion=4">Detalle de Fondo de Garantia</a></li>
				<li><a href="fgar_rep_op.php?accion=6">Detalle de Fond. Gar. con Creditos Cancelados</a></li>
				<li><a href="fgar_rep_op.php?accion=5">Detalle de Movimientos</a></li>
    
		    </ul>
  </div-->
        
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