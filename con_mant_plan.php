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
<script type="text/javascript" src="js/contabilidad_mant_plan.js"></script> 
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
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                    
                 </li>
              </ul>  
  


<div id="menu_lista">

                      <h2> <img src="img/my documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> MANTENIMIENTO PLAN DE CUENTAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
            Registro / Consulta Asiento Contable
        </div-->
                        
                         <div class="menu_item">
                                <a href="con_retro.php?accion=10"> 
                                    <img src="img/find_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Consulta Plan de Cuentas
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=11"> 
                                    <img src="img/edit user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Alta de Cuentas
                                </a>
                         </div>
                          <div class="menu_item">
                                <a href="con_retro.php?accion=12"> 
                                    <img src="img/edit_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                   Modificacion de Glosa
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=14"> 
                                    <img src="img/delete user_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Elimina Cuenta
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="con_retro.php?accion=13"> 
                                    <img src="img/documents_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Reporte Plan de Cuentas
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
    			<li><a href="con_retro.php?accion=10">Consulta Plan de Cuentas</a></li>
                <li><a href="con_retro.php?accion=11">Alta de Cuentas</a></li>
				<li><a href="con_retro.php?accion=12">Modificacion de Glosa</a></li>
				<li><a href="con_retro.php?accion=14">Elimina Cuenta</a></li>
				<li><a href="con_retro.php?accion=13">Reporte Plan de Cuentas</a></li>
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