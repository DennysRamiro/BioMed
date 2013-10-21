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
<title>Deposito - Retiro Bancos</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/cajas_bancos.js"></script> 


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/calendario.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script src="script/jquery-ui.js"></script>


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
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/bancos_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEP./RET. BANCOS
                    
                 </li>
                </ul> 
               
                <?php if ($_SESSION['cargo'] == 4) { ?>
                <div id="menu_lista">
                  <h2> <img src="img/bancos_64x64.png" border="0" alt="Modulo" align="absmiddle">DEPOSITOS / RETIROS BANCOS</h2>
                      <hr style="border:1px dashed #767676;">
                <?php } elseif ($_SESSION['login'] == "super") { ?>
                <div id="contenido_modulo">
                  <h2> <img src="img/bancos_64x64.png" border="0" alt="Modulo" align="absmiddle">DEPOSITOS / RETIROS BANCOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                         <img src="img/checkmark_32x32.png" align="absmiddle">
                          Registro Depositos / Retiros Bancos
                     </div>
                <?php } ?>
                
                 
                      
<!--Cabecera del modulo con su alerta-->
     <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
               <?php
               $fec = $_SESSION['fec_proc']; //leer_param_gral();
               $logi = $_SESSION['login'];
          	 $_SESSION['egre_bs_sus'] = 0; 
          	 $fec1 = cambiaf_a_mysql_2($fec);
               ?> 


<!--form name="form2" method="post" action="grab_retro_clim.php" -->
<br>
<center>
<?php
 $_SESSION['continuar'] = 0;
$caj_hab = 0;

//echo $fec1."---".$logi;
$caj_hab = verif_cajero_hab($fec1,$logi);


if ($caj_hab == 0){
  //echo "entrando aqui";
     echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
	 $_SESSION['continuar'] = 1;

	 ?> </center>

<br>
<!--/form-->
<?php }
if ($_SESSION['continuar'] == 0){
  ?> 
           
                      <!--div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Deposito Bolivianos / Deposito Dolares / Retiro Bolivianos /Retiro Dolares
                     </div-->  
					 
					                       <div class="menu_item">
                                          <a href="egre_retro.php?accion=10"> 
                                              <img src="img/shield4_64x64.png">
                                              <hr style="border:1px dashed #767676;">
                                              Deposito Bolivianos
                                          </a>
                                </div>
                                   <div class="menu_item">
                                          <a href="egre_retro.php?accion=11"> 
                                              <img src="img/shield1_64x64.png">
                                              <hr style="border:1px dashed #767676;">
                                              Deposito Dolares
                                          </a>
                                   </div>
                                    <div class="menu_item">
                                          <a href="egre_retro.php?accion=12"> 
                                              <img src="img/shield2_64x64.png">
                                              <hr style="border:1px dashed #767676;">
                                             Retiro Bolivianos                                          
										                       </a>
			                              </div>
                                   <div class="menu_item">
                                          <a href="egre_retro.php?accion=13"> 
                                              <img src="img/shield3_64x64.png">
                                              <hr style="border:1px dashed #767676;">
                                            Retiro Dolares
                                          </a>
                                   </div>
                               
           
</div>
</div>
  <?php
 }
      include("footer_in.php");
     ?>


</body>
</html>	
<?php
}
ob_end_flush();
 ?>