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
<title>Reversion Vales</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_rev_vales.js"></script> 
<script type="text/javascript" src="js/cajas_imp_vales.js"></script>  
</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar una transacci&oacute;n</font></p>
</div>
	
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
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>

                 <?php
                      if($_SESSION['menu']==5){?> 
                  <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/label_24x24.png" border="0" alt="Modulo" align="absmiddle"> VALES
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/label_64x64.png" border="0" alt="Modulo" align="absmiddle">VALES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Elija la Transacci&oacute;n de vales
                     </div> 
                <?php }elseif ($_SESSION['menu']==6) { ?> 
                    <li id="menu_modulo_cajas_imp">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/label_24x24.png" border="0" alt="Modulo" align="absmiddle"> VALES
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/label_64x64.png" border="0" alt="Modulo" align="absmiddle">VALES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Elija la Transacci&oacute;n de vales
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
<select name="nro_tra" size="12" style="width:500px; height:300px;" >


<?php
 	//Consulta Cart_maestro
//$fec1=$_SESSION['fec_proc'];
	//		echo $fec1;
			$con_car  = "Select DISTINCT CAJA_VAL_FECHA,CAJA_VAL_NRO,CAJA_VAL_FUNC,
			             CAJA_VAL_DESCRIP,CAJA_VAL_IMPO
			 from  caja_vale
             where CAJA_VAL_FECHA = '$fec1' 
             and CAJA_VAL_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['CAJA_VAL_DESCRIP'];
					$tipo = $lin_car['CAJA_VAL_FUNC'];
					$nro_tra = $lin_car['CAJA_VAL_NRO'];
					$monto = $lin_car['CAJA_VAL_IMPO'];
					//$impo = $lin_car['CAJA_DEP_IMPO2'];
					//if ($tipo == 1){
					//    $desc = "Dep.";
				//		}
				//	if ($tipo == 2){
				//	    $desc = "Ret.";
				//		}	
						
		/*	  */
		// maestro
		/*
		
				
			
		//	
	
			*/	
			
?>

<option value=<?php echo $nro_tra;?>>
              <?php echo $nro_tra.encadenar(2); ?>  
	          <?php echo $tipo.encadenar(2); ?> 
              <?php echo $ncre.encadenar(2); ?>
			  <?php echo number_format($monto, 2, '.',','); ?>
			  
<?php 
}
//}
?>

</select><br><br>
<center>
 <?php
                      if($_SESSION['menu']==5){?> 
   <input class="btn_form" type="submit" name="accion" value="Detalle Vales">
   <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
<?php }elseif ($_SESSION['menu']==6) { ?> 
   <input class="btn_form" type="submit" name="accion" value="Reimpresion Vales">
<?php } ?> 
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