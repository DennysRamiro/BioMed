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
<title>Reportes de Cartera</title>
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
                    
                     <img src="img/notepad_32x32.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CARTERA
                    
                 </li>
              </ul>  
  

<div id="menu_lista">

                      <h2> <img src="img/notepad_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CARTERA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Reportes de Cartera
        </div>
                        
                        <div class="menu_item">
                                <a href="cart_rep_op.php?accion=1"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Resumen Por Moneda
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=2"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Resumen Por Producto
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=3"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Resumen por Oficial de Negocios
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=9"> 
                                    <img src="img/edit user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Calificacion Cartera
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cart_rep_op.php?accion=4"> 
                                    <img src="img/edit_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Detalle de Cartera
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=8"> 
                                    <img src="img/delete user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Detalle de Cartera por Asesor
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=14"> 
                                    <img src="img/documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Det. Cartera Plazo (Mes Cerrado)
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cart_rep_op.php?accion=5"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Detalle de Recuperaciones
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=6"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Detalle de Desembolsos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=7"> 
                                    <img src="img/edit user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Detalle de Condonaciones
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cart_rep_op.php?accion=10"> 
                                    <img src="img/edit_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                  Detalle de Ingresos Facturables
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=11"> 
                                    <img src="img/delete user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Detalle Creditos Historico
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cart_rep_op.php?accion=12"> 
                                    <img src="img/documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Detalle Creditos Cancelados
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cart_rep_op.php?accion=13"> 
                                    <img src="img/close_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Detalle Interes Devegando
                                </a>
                         </div>

            </div>	
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
//$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla')  ;
 ?>
  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cart_rep_op.php?accion=1">Resumen Por Moneda</a></li>
    			<li><a href="cart_rep_op.php?accion=2">Resumen Por Producto</a></li>
                <li><a href="cart_rep_op.php?accion=3">Resumen por Oficial de Negocios</a></li>
				<li><a href="cart_rep_op.php?accion=9">Calificacion Cartera</a></li>
                <li><a href="cart_rep_op.php?accion=4">Detalle de Cartera</a></li>
				<li><a href="cart_rep_op.php?accion=8">Detalle de Cartera por Asesor</a></li>
				<li><a href="cart_rep_op.php?accion=14">Det. Cartera Plazo (Mes Cerrado)</a></li>
				<li><a href="cart_rep_op.php?accion=5">Detalle de Recuperaciones</a></li>
				<li><a href="cart_rep_op.php?accion=6">Detalle de Desembolsos</a></li>
				<li><a href="cart_rep_op.php?accion=7">Detalle de Condonaciones</a></li>
				<li><a href="cart_rep_op.php?accion=10">Detalle de Ingresos Facturables</a></li>
                <li><a href="cart_rep_op.php?accion=11">Detalle Creditos Historico</a></li>
				<li><a href="cart_rep_op.php?accion=12">Detalle Creditos Cancelados</a></li>
				<li><a href="cart_rep_op.php?accion=13">Detalle Interes Devegando</a></li>
				
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