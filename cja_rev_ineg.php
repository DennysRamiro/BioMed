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
<title>Reversion Ingresos / Egresos</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_rev_ineg.js"></script> 
<script type="text/javascript" src="js/cajas_imp_ineg.js"></script>  
</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar una transacci&oacute;n</font></p>
</div>
	
<?php
				include("header.php");

        $fec1=  $_SESSION['fec_proc'];
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
                 <?php
                      if($_SESSION['menu']==7){?> 
                  <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/basket_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS/EGRESOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/basket_64x64.png" border="0" alt="Modulo" align="absmiddle">INGRESOS/EGRESOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Elija la Transacci&oacute;n de ingresos / egresos
                     </div> 

				<?php }elseif ($_SESSION['menu']==8) { ?> 
                      <li id="menu_modulo_cajas_imp">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/basket_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS/EGRESOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/basket_64x64.png" border="0" alt="Modulo" align="absmiddle">INGRESOS/EGRESOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Elija la Transacci&oacute;n de ingresos / egresos
                     </div>  
                     <?php } ?> 
 <center>
<?php
                 //$fec = leer_param_gral();
        $fec = $_SESSION['fec_proc'];
         $fec1 = cambiaf_a_mysql_2($fec);
         $logi = $_SESSION['login']; 
                ?> 
<?php

 $_SESSION['continuar'] = 0;
/* */
/*
 */
//$cod_es = 7;
/* */
  ?> 
 <?php
/*
	*/
	   
?>
<font size="2">
 <strong>
 <?php
   echo "Trans.".encadenar(4)."Descripci&oacute;n".encadenar(15)."Monto".encadenar(64);
 ?>
 </strong>
 <center>

<form name="form2" method="post" action="grab_retro_cja.php" onSubmit="return ValidarCampoLista(this)">

<?php
 //  echo "Trans.".encadenar(4)."Descripcion ".encadenar(22)."Monto";
 ?>
 </strong></font>
<select name="nro_tra" size="12" style="width:500px; height:300px;">


<?php
 	//Consulta Cart_maestro
			echo $fec1;
			$con_car  = "Select DISTINCT caja_ingegr_fecha,caja_ingegr_corr,caja_ingegr_descrip,
			             caja_ingegr_tipo
			 from  caja_ing_egre
             where caja_ingegr_fecha = '$fec1'
			 and caja_ingegr_contab = 2 
             and caja_ingegr_usr_baja is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['caja_ingegr_descrip'];
					$tipo = $lin_car['caja_ingegr_tipo'];
					$nro_tra = $lin_car['caja_ingegr_corr'];
					
					//$impo = $lin_car['CAJA_DEP_IMPO2'];
					if ($tipo == 1){
					    $desc = "Ing.";
						}
					if ($tipo == 2){
					    $desc = "Egr.";
						}	
						
			
?>

<option value=<?php echo $tipo.$nro_tra;?>>
             <?php echo $desc.encadenar(2); ?> 
             <?php echo $nro_tra.encadenar(2); ?>  
	          <?php echo $ncre.encadenar(2);
			  $_SESSION['tipo'] = $tipo;
			  $_SESSION['nro_tran'] = $nro_tra;
			  
			  
			   ?> 
             
			  
<?php 
}
//}
?>

</select><br><br>
<center>
 <?php
                      if($_SESSION['menu']==7){?> 
   <!--input class="btn_form" type="submit" name="accion" value="Det-IngEgr"-->
   <input class="btn_form" type="submit" name="accion" value="Detalle Ingresos Egresos">
 <?php }elseif ($_SESSION['menu']==8) { ?>
   <input class="btn_form" type="submit" name="accion" value="Reimpresion Ingresos Egresos">
   <!--input class="btn_form" type="submit" name="accion" value="Det-IngEgr2"-->
   <?php } ?> 
   <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
  </form>
</div>
<?php
//}
		 	include("footer_in.php");
		 ?>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>