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
<title>Mantenimiento Egresos / Ingresos</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/cajas_reg_ing_egr.js"></script> 

</head> 
  <?php
      include("header.php");
  ?>
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/move_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. INGR./EGRE.
                    
                 </li>
              </ul> 
    <?php $log = $_SESSION['login']; ?>
    <?php if ($_SESSION['cargo'] == 4) { ?>
    <div id="menu_lista">
    <h2> <img src="img/move_64x64.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO INGRESOS/EGRESOS</h2>
                      <hr style="border:1px dashed #767676;">
    <?php } elseif ($log == "super") { ?>
    <div id="contenido_modulo">
    <h2> <img src="img/move_64x64.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO INGRESOS/EGRESOS</h2>
                 <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                            <img src="img/checkmark_32x32.png" align="absmiddle">
                                Registro Ingresos / Egresos
                      </div>   
    <?php } ?> 
                    
    <?php
     //$fec = leer_param_gral();
     $logi = $_SESSION['login'];
	 $_SESSION['egre_bs_sus'] = 0; 
	 $fec1 = cambiaf_a_mysql_2($fec);
     ?> 
	 
	 
<form name="form2" method="post" action="grab_retro_clim.php" >
<br>
<center>
<?php
 $_SESSION['continuar'] = 0;
$caj_hab = 0;
$caj_hab = verif_cajero_hab($fec1,$logi);
if ($caj_hab == 0){
     echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
	 $_SESSION['continuar'] = 1;
	 ?> </center>
	 
	

   <center>
   
   </form>
<?php }

if ($_SESSION['continuar'] == 0){
  ?> 


                      
                       
 		  <!--div id="menu_lista"-->
					<!--div id="error_login"> 
					  <img src="img/alert_32x32.png" align="absmiddle">
					   Registro Ingresos / Egresos en Bs/$us
					</div-->
                         <div class="menu_item">
                                <a href="egre_retro.php?accion=1"> 
                                    <img src="img/shield2_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Egresos Bolivianos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="egre_retro.php?accion=2"> 
                                    <img src="img/shield4_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Egresos Dolares
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="egre_retro.php?accion=7"> 
                                    <img src="img/shield1_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Ingresos Bolivianos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="egre_retro.php?accion=8"> 
                                    <img src="img/shield3_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Ingresos Dolares
                                </a>
                         </div> 
 </div> 
 </div> 
 <?php
      include("footer_in.php");
     ?>
</body>
</html>	
<?php
}
}
ob_end_flush();
 ?>