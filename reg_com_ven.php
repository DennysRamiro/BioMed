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
<title>Registro de Compra / Venta Divisas</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<!--script language="javascript" src="script/validarFormulario.js" type="text/javascript"> </script--> 
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery.numeric.js"></script>
<script type="text/javascript" src="js/cjas_depret_depbs.js"></script>
<script type="text/javascript" src="js/reg_com_ven.js"></script> 
<script type="text/javascript" src="js/ValidarNumero.js"></script>  



</head>
<body>

<div id="dialog-confirm3" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Monto en Dolares no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm4" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Descripci&oacute;n no puede estar vacio.</font></p>
</div>


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
                  <li id="menu_modulo_divisas">
                    
                     <img src="img/credit card_24x24.png" border="0" alt="Modulo" align="absmiddle"> COMPRA VENTA DIV.
                    
                 </li>
                
				 
					  
			<?php if ($_SESSION['menu'] == 1) {?>

                       <li id="menu_modulo_fecha">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> COMPRA DOLARES
                    
                 </li>
              </ul>  
 			<div id="contenido_modulo">

                      <h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle"> COMPRA DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                        <img src="img/checkmark_32x32.png" align="absmiddle">
                         Registro Compras Divisas
                      </div>
					  

                      <?php }elseif ($_SESSION['menu'] == 2) {?>

                      <li id="menu_modulo_fecha">
                    
                     <img src="img/shield4_24x24.png" border="0" alt="Modulo" align="absmiddle"> VENTA DOLARES
                    
                 </li>
              </ul>  
 			<div id="contenido_modulo">

                      <h2> <img src="img/shield4_64x64.png" border="0" alt="Modulo" align="absmiddle"> VENTA DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                        <img src="img/checkmark_32x32.png" align="absmiddle">
                         Registro Venta Divisas
                      </div>

                        <?php }elseif ($_SESSION['menu'] == 3) {?>

                      <li id="menu_modulo_divisas_com_dol">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> COMPRA DOLARES
                    
                 </li>

                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> COMPRA REALIZADA $US
                    
                 </li>
              </ul>  
 			<div id="contenido_modulo">

                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle"> COMPRA REALIZADA DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                        <img src="img/checkmark_32x32.png" align="absmiddle">
                         Registro Venta Divisas
                      </div-->

                      <?php }elseif ($_SESSION['menu'] == 4) {?>
                       <li id="menu_modulo_divisas_ven_dol">
                    
                     <img src="img/shield4_24x24.png" border="0" alt="Modulo" align="absmiddle"> VENTA DOLARES
                    
                 </li>

                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> VENTA REALIZADA $US
                    
                 </li>
              </ul>  
 			<div id="contenido_modulo">

                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle"> VENTA REALIZADA DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                        <img src="img/checkmark_32x32.png" align="absmiddle">
                         Registro Venta Divisas
                      </div-->
<?php } ?>

	
          
				<?php
					 $fec = $_SESSION['fec_proc'];  //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
      
          

<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <form name="form2" method="post" action="egre_retro_1.php"  onSubmit="return ValidaCamposBanco_Dep_Sus(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   $cod_mon = 0;
   $des_mon = "";
   if (isset($_SESSION['c_com_ven'])){
       if ($_SESSION['c_com_ven'] == 1){
          $cod_tran = 1;
	      $des_tran = "Compra de divisas";
		  
		  
        }	
       if ($_SESSION['c_com_ven'] == 2){
           $cod_tran = 2;
	      $des_tran = "Venta de divisas";
       }
	   
	   $_SESSION['des_tran'] = $des_tran;	
   }

//$datos = $_SESSION['form_buffer'];
 ?>
 
 
 
 
 <table width="45%"  align="center">
    <tr>
        <th align="left">Transacci&oacute;n:</th>
		<td><?php echo $des_tran; ?></td>
     </tr>
     <tr>
        
        <th align="left">Tipo de Cambio Contable:</th>
	    <td align="left"> <?php echo number_format($_SESSION['TC_CONTAB'], 2, '.',',') ; ?></td>
	   </tr>
	   
	   <?php if ($_SESSION['c_com_ven'] == 1){  ?>
	    </tr>
        <th align="left">Tipo de Cambio Compra:</th>
	    <td align="left"> <?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?></td>
	   </tr>
	   <tr> 
         <th align="left" >Tipo de Cambio Especial:</th>
		 <td align="left" ><input class="txt_campo"  type="text" name="egr_tcesp" id="egr_tcesp" 
		     value = <?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?>>
		  <div id="error_tc_esp"></div></td>
       </tr>
	   
       <tr> 
         <th align="left" >Monto en Dolares :</th>
		 <td><input class="txt_campo" type="text" name="egr_monto" id="monto" onKeyPress="return soloNum(event)" onBlur="limpia()">
		  <div id="error_monto"></div></td>
       </tr>
        <?php } ?>
		 <?php if ($_SESSION['c_com_ven'] == 2){  ?>
	    </tr>
        <th align="left">Tipo de Cambio Venta:</th>
	    <td align="left"> <?php echo number_format($_SESSION['TC_VENTA'], 2, '.',','); ?></td>
	   </tr>
	   <tr> 
         <th align="left" >Tipo de Cambio Especial:</th>
		 <td><input class="txt_campo" type="text" name="egr_tcesp" id="tc_esp"
		      value = <?php echo number_format($_SESSION['TC_VENTA'], 2, '.',','); ?>> 
			  <div id="error_tc_esp"></div></td>
       </tr>
	   
       <tr> 
         <th align="left" >Monto en Dolares:</th>
		 <td><input class="txt_campo" type="text" name="egr_monto" id="egr_monto" onKeyPress="return soloNum(event)" onBlur="limpia()">
		 <div id="error_egr_monto"></div> </td>
       </tr>
        <?php } ?>
         <tr>
	         <th align="left">Descripci&oacute;n :</th>
			 <td><input class="txt_campo" type= type="text" name="descrip" id="descrip" size="50" maxlength="70"  > 
			 <div id="error_descrip"></div></td>
		 </tr>
		
		 
        </table>
	 <center>
	 	<br>
	   <?php if ($_SESSION['menu'] == 1) {?>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Compra Sus.">
	  <?php }elseif ($_SESSION['menu'] == 2) {?>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Venta Sus.">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
     <?php } ?>
</form>
    <?php } ?>
<?php

 
 if ($_SESSION['detalle'] == 4){
    if (isset($_POST['egr_tcesp'])){
        $tc_com = $_POST['egr_tcesp'];
		$_SESSION['tc_com'] = $tc_com;
	}
	if (isset($_POST['descrip'])){
        $des_quien = $_POST['descrip'];
		$_SESSION['des_quien'] = $des_quien;
	}
	if (isset($_POST['egr_monto'])){
	   if ($_SESSION['c_com_ven'] == 1){
           $imp_sus = $_POST['egr_monto'];
		   $_SESSION['imp_sus'] = $imp_sus;
		   $descrip = "Compra";
		}
		if ($_SESSION['c_com_ven'] == 2){
           $imp_bs = $_POST['egr_monto'];
		   $_SESSION['imp_bs'] = $imp_bs;
		   $descrip = "Venta";
		}   
	}
	    $cta_ctbs = 1111010010001;
		$cta_ctus = 1111010020002;
		$des_ctabs = leer_cta_des($cta_ctbs);
		$des_ctaus = leer_cta_des($cta_ctus);
	    $_SESSION['cta_ctbs'] = $cta_ctbs;
		$_SESSION['cta_ctus'] = $cta_ctus;
		$_SESSION['des_ctabs'] = $des_ctabs;
	    $_SESSION['des_ctaus'] = $des_ctaus;	
	
	if ($_SESSION['c_com_ven'] == 1){
	   
	    $monto_com = round(($imp_sus * $tc_com),2);
		$monto_ctb = round(($imp_sus * $_SESSION['TC_CONTAB']),2);
		$_SESSION['monto_com'] = $monto_com;
		$_SESSION['monto_ctb'] = $monto_ctb;
		$_SESSION['dif_tc'] = $monto_ctb - $monto_com;
		$_SESSION['imp_equiv'] = $monto_ctb;
		$_SESSION['imp_sus'] = $imp_sus;
		// echo $_SESSION['c_com_ven']."**".$_SESSION['monto_com']."**".$_SESSION['monto_ctb']."**".$_SESSION['dif_tc']."**".
		// $_SESSION['imp_equiv']."**".$_SESSION['imp_sus'];
	  }
	if ($_SESSION['c_com_ven'] == 2){
	  // echo $_SESSION['c_com_ven']."2";
	    $monto_ven = $imp_bs * $tc_com;
	    $monto_ctb = $imp_bs * $_SESSION['TC_CONTAB'];
		$_SESSION['monto_ven'] = $monto_ven;
		$_SESSION['monto_ctb'] = $monto_ctb;
		$_SESSION['dif_tc'] = $monto_ven - $monto_ctb;
		$_SESSION['imp_sus'] = $imp_bs;
			
	 }
	//echo $_SESSION['dif_tc'];
if ($_SESSION['dif_tc'] <> 0){
   if ($_SESSION['dif_tc'] < 0){
      $cta_dtc = "6131020010001";
      $des_ctadi = leer_cta_des($cta_dtc);
	  $deb_hab = 1; 
	  $importe = ($_SESSION['dif_tc'] * -1);
	  $_SESSION['cta_dtc'] = $cta_dtc;
      $importe_e = $importe;	 
       }
   	 if ($_SESSION['dif_tc'] > 0){
	//  echo $_SESSION['c_com_ven']."**".$_SESSION['monto_com']."**".$_SESSION['monto_ctb']."**".$_SESSION['dif_tc'];
	    $cta_dtc = "4221030010001";
		$des_ctadi = leer_cta_des($cta_dtc);
        $deb_hab = 2; 
	    $importe = $_SESSION['dif_tc'];
		$importe_e = $importe;
		//if ($mon == 2) {
		  // $importe_e = 0;
		// }
       } 
	   $_SESSION['des_ctadi'] = $des_ctadi;
	   $_SESSION['cta_dtc'] = $cta_dtc;
	}

    	
	
//	$imp_equiv = $tc_com * $imp_sus;
  //  
	 ?>
	 <strong><font size="+3">
	 <?php echo encadenar(40).$descrip; ?>
	  </font></strong>
 	<table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
	<tr>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="35%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
      <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />IMP. DOLARES</th>
	</tr> 
	
   <?php if ($_SESSION['c_com_ven'] == 1){  ?> 
	
	<tr>
	  <td align="center" ><?php echo $cta_ctus; ?></td>
	  <td align="left" ><?php echo $des_ctaus; ?></td>
	  <td align="right" ><?php echo number_format($monto_ctb, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['imp_sus'], 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" ><?php echo $cta_ctbs; ?></td>
	  <td align="left" ><?php echo $des_ctabs; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($monto_com, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>
	<tr>
	<?php if ($_SESSION['dif_tc'] <> 0){  ?>
	  <td align="center" ><?php echo $cta_dtc; ?></td>
	  <td align="left" ><?php echo $des_ctadi; ?></td> 
	  <?php if (substr($cta_dtc,0,1) == 6){?>
	  <td align="right" ><?php echo number_format($_SESSION['dif_tc'] * -1, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	 <?php } ?> 
	  <?php if (substr($cta_dtc,0,1) == 4){?>
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['dif_tc'], 2, '.',','); ?></td>
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	 <?php } ?> 
	</tr>
	<?php } ?>
	<?php } ?>
	 <?php if ($_SESSION['c_com_ven'] == 2){  ?> 
	<tr>
	  <td align="center" ><?php echo $cta_ctus; ?></td>
	  <td align="left" ><?php echo $des_ctaus; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($monto_ctb, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['imp_sus'], 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" ><?php echo $cta_ctbs; ?></td>
	  <td align="left" ><?php echo $des_ctabs; ?></td>
	   <td align="right" ><?php echo number_format($monto_ven, 2, '.',','); ?></td> 
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>
	<tr>
	<?php if ($_SESSION['dif_tc'] <> 0){?>
	  <td align="center" ><?php echo $cta_dtc; ?></td>
	  <td align="left" ><?php echo $des_ctadi; ?></td>
	  <?php if (substr($cta_dtc,0,1) == 4){?>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['dif_tc'] , 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	   <?php } ?> 
	  <?php if (substr($cta_dtc,0,1) == 6){?>
	   <td align="right" ><?php echo number_format($_SESSION['dif_tc']*-1 , 2, '.',','); ?></td>
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	   <?php } ?> 
	</tr>
	<?php } ?>
	<?php } ?>
	
	
	
</table> 	
<center>	

     
	 
	 <br>
	 <?php if ($_SESSION['menu'] == 3) {?>

			<input class="btn_form" type="submit" name="accion" value="Recibo Compra">
     <?php }elseif ($_SESSION['menu'] == 4) {?>

    		 <input class="btn_form" type="submit" name="accion" value="Recibo Venta">
	 
	<?php } ?>
	 
	 
	 
	 
	 
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
 </form>
	<?php  
	 
	 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
  
 }
?>

 
	 
</div>
  <?php
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>