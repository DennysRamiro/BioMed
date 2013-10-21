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
<title>Administracion de Cuentas</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/MenuManCuenta.js"></script>  
</head>
<body>
    <?php
                include("header.php");
            ?>
<div id="pagina_sistema">
<!--Cabecera del modulo con su alerta-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>

                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/app folder_32x32.png" border="0" alt="Modulo" align="absmiddle">MANT. CUENTA
                    
                 </li>
              </ul>
              <!--Cabecera del modulo con su alerta-->
              <div id="menu_lista">
                      <h2> <img src="img/app folder_64x64.png" border="0" alt="Modulo" align="absmiddle"> MANTENIMIENTO CUENTA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                        Cobro de Creditos
                     
                     </div>
                 





                     <!--Creacion de los Submodulos-->
                        <div class="menu_item">
                                <a href="cobros_op_2.php?accion=10"> 
                                    <img src="img/open_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Apertura de Cuenta
                                </a>
                         </div>

                         <div class="menu_item">
                                <a href="cobros_op_2.php?accion=11"> 
                                    <img src="img/padlock closed_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Cierre de Cuenta Saldos Minimos
                                </a>
                         </div>

                         <div class="menu_item">
                                <a href="cobros_op_2.php?accion=12"> 
                                    <img src="img/credit card_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Relacionar con Credito
                                </a>
                         </div>

<?php

//if ($_SESSION['continuar'] == 0){

 ?>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cobros_op_2.php?accion=10">Apertura de Cuenta</a></li>
    			<li><a href="cobros_op_2.php?accion=11">Cierre de Cuenta Saldos Minimos</a></li>
				<li><a href="cobros_op_2.php?accion=12">Relacionar con Credito</a></li>
               
    
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