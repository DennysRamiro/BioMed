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
<title>Busqueda de Crédito para preparar el cobro</title>
<!--meta charset="UTF-8"-->
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosCobros.js"></script>
<script type="text/javascript" src="js/cajas_cobros_cart_dir.js"></script>
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
<?php if($_GET["menu"]==1){?> 
                 
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. OPERACIONES
                    
                 </li>
              </ul>  
  
              <div id="menu_lista">

                      <h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTA OPERACIONES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                           <img src="img/alert_32x32.png" align="absmiddle">
                                  Cobro de Creditos
                      </div>

                      <div class="menu_item">
                                <a href="cobros_op_2.php?accion=1"> 
                                    <img src="img/users group_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Por Nombre Grupo
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op_2.php?accion=2"> 
                                    <img src="img/user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Nombre Cliente
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cobros_op_2.php?accion=5"> 
                                    <img src="img/phone_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Numero Operacion
                                </a>
                         </div>
<?php } elseif($_GET["menu"]==2){?> 
                        

                <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_creditos_cobros">
                    
                     <img src="img/officer_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/new_32x32.png" border="0" alt="Modulo" align="absmiddle"> HOJA DE COBROS
                    
                 </li>
              </ul>  
  
                <div id="menu_lista">

                      <h2> <img src="img/new_64x64.png" border="0" alt="Modulo" align="absmiddle"> HOJA DE COBROS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                    Cobro de Creditos
                        </div>

                        <div class="menu_item">
                                <a href="cobros_op_2.php?accion=99"> 
                                    <img src="img/users group_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Por Nombre Grupo
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op_2.php?accion=101"> 
                                    <img src="img/user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Nombre Cliente
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cobros_op_2.php?accion=103"> 
                                    <img src="img/phone_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Numero Operacion
                                </a>
                         </div>

<?php } elseif($_GET["menu"]==3){?> 
                        

                <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_cob">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
              </ul>  
  
                <div id="menu_lista">

                      <h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                    Cobro de Creditos
                        </div>

                        <div class="menu_item">
                                <a href="cobros_op_2.php?accion=100"> 
                                    <img src="img/users group_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Por Nombre Grupo
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="cobros_op_2.php?accion=102"> 
                                    <img src="img/user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Nombre Cliente
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="cobros_op_2.php?accion=104"> 
                                    <img src="img/phone_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Por Numero Operacion
                                </a>
                         </div>

<?php } ?>

            </div>

  <!--div id="ListaSeleccion">
             <ul>
			    <li><a href="cobros_op_2.php?accion=1">Por Nombre Grupo</a></li>
    			<li><a href="cobros_op_2.php?accion=2">Por Nombre Cliente</a></li>
				<li><a href="cobros_op_2.php?accion=5">Por Numero Operacion</a></li>
                <li><a href="cobros_op_2.php?accion=4">Salir</a></li>
    
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