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
<title>Registro Vales</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/cajas_vales.js"></script> 
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
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO VALES 
                    
                 </li>
              </ul>  
<?php $log = $_SESSION['login']; ?>
<?php if ($_SESSION['cargo'] == 4) { ?>
 <div id="menu_lista">
 <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO DE VALES </h2>
                      <hr style="border:1px dashed #767676;">
<?php } elseif ($log == "super") { ?>
<div id="contenido_modulo">
<h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO DE VALES </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                            <img src="img/checkmark_32x32.png" align="absmiddle">
                                Registro Vales
                      </div>   
<?php } ?>

                                    
                     <?php
                          // $fec = leer_param_gral();
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
   <br>
   <center>
 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>
<?php }

if ($_SESSION['continuar'] == 0){
  ?> 

      <div class="menu_item">
                                <a href="egre_retro.php?accion=14"> 
                                    <img src="img/shield2_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Vales Bolivianos
                                </a>
                         </div>
                         <div class="menu_item">
                                <a href="egre_retro.php?accion=15"> 
                                    <img src="img/shield3_64x64.png">
                                    <hr style="border:1px dashed #767676;">
                                    Vales Dolares
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