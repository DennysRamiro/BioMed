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
<title>Registro de Vales</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarFormulrio.js" type="text/javascript"> </script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<!--script type="text/javascript" src="js/cjas_depret_depbs.js"></script-->
<script type="text/javascript" src="js/reg_com_ven.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script> 
<script type="text/javascript" src="js/cja_vales.js"></script> 
</head>
<body>

<div id="dialog-confirm3" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Monto no puede estar vacio.</font></p>
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
                  <li id="menu_modulo_vale_moneda">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO DE VALES
                    
                 </li>

		 <?php if ($_SESSION['menu'] == 1) {?>

                     <li id="menu_modulo_fecha">
                    
                     <img src="img/shield2_24x24.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO VALES BS
                    
               		</li>
              </ul>  


 			<div id="contenido_modulo">

                      <h2> <img src="img/shield2_64x64.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO DE VALES BOLIVIANOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                            <img src="img/checkmark_32x32.png" align="absmiddle">
                                Registro Vales Bolivianos
                      </div>

             <?php }elseif ($_SESSION['menu'] == 2) {?>

                       <li id="menu_modulo_fecha">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO VALES $US
                    
               		</li>
              </ul>  

 			<div id="contenido_modulo">

                      <h2> <img src="img/shield3_64x64.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO DE VALES DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                            <img src="img/checkmark_32x32.png" align="absmiddle">
                                Registro Vales Dolares
                      </div>
			<?php } ?>



				<?php
					 //$fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $_SESSION['fec1'] = $fec1;
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>



<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <form name="form2" method="post" action="egre_retro_1.php" onSubmit="return ValidaCamposBanco_Dep_Sus(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


//if ($_SESSION['detalle'] == 1){
   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   $cod_mon = $_SESSION['val_bs_sus'];
   $des_mon = "";
if (isset($_SESSION['val_bs_sus'])){
       if ($_SESSION['val_bs_sus'] == 1){
          $cod_mon = 1;
	      $des_mon = "Bolivianos";
		  $mon_des = "Monto en Bolivianos:";
        }	
       if ($_SESSION['val_bs_sus'] == 2){
          $cod_mon = 2;
	      $des_mon = "Dolares";
		  $mon_des = "Monto en Dolares:";
       }
	   $_SESSION['des_mon'] = $des_mon;	
   }
$con_usr  = "Select * From gral_usuario where GRAL_USR_ESTADO < 3 and GRAL_USR_USR_BAJA is null order by 5";
$res_usr = mysql_query($con_usr);
//echo "Vale"."  ".$des_mon;
//$datos = $_SESSION['form_buffer'];
 ?>
  <table align="center">
  <tr>
        <th align="center" style="font-size:18px"><?php echo encadenar(2);?></th>
	    <th align="center" style="font-size:18px"><?php echo "Vale".
		        encadenar(2).$des_mon; ?>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr>
        <th align="left">Agencia: </th>
	    <td> <select name="cod_agencia" size="1"  >
	    	<!--option>Seleccione una Agencia......</option-->
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
			              <?php echo utf8_encode($linea['GRAL_AGENCIA_NOMBRE']); ?></option>
            <?php } ?>
		    </select></td>
       </tr>
        
        <th align="left">Funcionario:</th>
	    <td> <select name="cod_cta" size="1"  >
	    	<!--option>Seleccione un Funcionario......</option-->
	        <?php while ($lin_usr = mysql_fetch_array($res_usr)) { ?>
            <option value=<?php echo $lin_usr['GRAL_USR_LOGIN']; ?>>
			              <?php echo utf8_encode($lin_usr['GRAL_USR_NOMBRES'].encadenar(1).
						             $lin_usr['GRAL_USR_AP_PATERNO'].encadenar(1).
									 $lin_usr['GRAL_USR_AP_MATERNO']);?></option>
            <?php } ?>
		    </select></td>
       </tr>
      
    <tr> 
         <th align="left" >Monto:</th>
		 <td><input class="txt_campo" type="text" name="egr_monto" id="monto" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
		 <div id="error_monto"></div></td>
       </tr>
         <tr>
	         <th align="left">Descripci&oacute;n:</th>
			 <td><input class="txt_campo" type="text" name="descrip" id="descrip" size="50" maxlength="70"  >          
			 <div id="error_descrip"></div>   </td>
		 </tr>
		 
		 
        </table>
	 <center>
	  <br> 
	
     <?php if ($_SESSION['menu'] == 1) {?>
			
			 <input class="btn_form" type="submit" name="accion" value="Registrar Vale Bs">

             <?php }elseif ($_SESSION['menu'] == 2) {?>
				
				<input class="btn_form" type="submit" name="accion" value="Registrar Vale Sus">
        
			<?php } ?>
	 
	 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
	 

</form>
    <?php //} ?>
<?php
/*if ($_SESSION['detalle'] == 2){  //1a?>

<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$_SESSION['monto_p'] = 0;
$_SESSION['monto_i'] = 0;
$_SESSION['monto_125'] = 0;
$_SESSION['monto_3'] = 0;
$_SESSION['t_fac_fis'] = 0;
$tc_ctb = $_SESSION['TC_CONTAB'];
$c_agen = $_POST['cod_agencia'];
$_SESSION['c_agen'] = $c_agen;
 $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
 
if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['descrip'] = $descrip;
	}

 if ($_POST['egr_monto'] > 0){  
    if ($_SESSION['egre_bs_sus'] == 2){
	   $_SESSION['monto_eq'] = $_POST['egr_monto'];
         $monto_t = (($_POST['egr_monto'] * $_SESSION['TC_CONTAB'])* -1);
      }else{
	            $monto_t = ($_POST['egr_monto']* -1);
	  }			
				$_SESSION['monto_t'] =  $monto_t;
	}
$cta_ctbg = $_POST['cod_cta'];
$_SESSION['cta_ctbg'] =  $cta_ctbg;
//Factura
if(isset($_POST['cre_fac'])){
  $_SESSION['t_fac_fis'] = 2;
  
  $_SESSION['monto_i'] = $monto_t * .13 ;
  
  $_SESSION['monto_p'] = $monto_t - $_SESSION['monto_i'];
  $cta_f13 = 14306101;
  $_SESSION['cta_f13'] = $cta_f13;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
		 }	 
 }
 //Factura excenta
 if(isset($_POST['cre_fex'])){
  $_SESSION['t_fac_fis'] = 3;
  ?>
 <center>
   <tr> 
         <th align="left" >Importe Sujeto a Crédito Fiscal :</th>
		 <td><input  type="text" name="imp_exe"> </td>
       </tr>
<br><br>	   
 <input type="submit" name="accion" value="Recalcular">
 <input type="submit" name="accion" value="Salir">	
<br><br>	    
 <?php 
 
 }
 //Pago Servicios
 if(isset($_POST['cre_ser'])){
    $_SESSION['t_fac_fis'] = 4;
    $monto_imp = $monto_t * .1550;
    $monto_neto = $monto_t - $monto_imp;
	$monto_fis = ($monto_t * $monto_t) / $monto_neto;
	$cta_iue = 24203105; //
	$cta_it = 24203104;  // 
  $_SESSION['cta_iue'] = $cta_iue;
   $_SESSION['cta_it'] = $cta_it;
  $_SESSION['monto_fis'] = $monto_fis;
  $_SESSION['monto_125'] = $monto_fis * 0.125;
  $_SESSION['monto_3'] = $monto_fis * 0.03;
 // $cta_f13 = 14306101;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
			     }	 				 
 }
  if(isset($_POST['cre_bie'])){
    $_SESSION['t_fac_fis'] = 5;
    $monto_imp = $monto_t * .08;
    $monto_neto = $monto_t - $monto_imp;
	$monto_fis = ($monto_t * $monto_t) / $monto_neto;
	$cta_iue = 24203105; //
	$cta_it = 24203104;  // 
  $_SESSION['cta_iue'] = $cta_iue;
   $_SESSION['cta_it'] = $cta_it;
  $_SESSION['monto_fis'] = $monto_fis;
  $_SESSION['monto_125'] = $monto_fis * 0.05;
  $_SESSION['monto_3'] = $monto_fis * 0.03;
 // $cta_f13 = 14306101;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
			     }	 				 
 }

 
 
if ($_SESSION['t_fac_fis'] <> 3){ 
 
echo "Detalle Contable";

?>

 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
	
	
	
	
		           

<?php	
if ($_SESSION['egre_bs_sus'] == 1){
		      $imp_or = $_POST['egr_monto'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $monto_t;
			  $cta_ctb = 11101101;
			  $_SESSION['cta_ctb'] = $cta_ctb;
			  $importe_e =0;
			  $deb_hab = 2;
	 } else {
	         $imp_or = $_POST['egr_monto'] * $_SESSION['TC_CONTAB'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $monto_t;
			  $cta_ctb = 11101201;
			  $_SESSION['cta_ctb'] = $cta_ctb;
			  $importe_e =$_SESSION['monto_eq'];
			  $deb_hab = 2;
	 }		  
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
			     }
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
	?>
	 
		<?php if(empty($_POST['cre_fac'])){
		       if(empty($_POST['cre_ser'])){ 
			     if(empty($_POST['cre_bie'])){ ?>
			      
        <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(($imp_or + $_SESSION['monto_i']), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
		 <?php } ?>
		 <?php } ?>
		 <?php } ?>
		<?php if(isset($_POST['cre_fac'])){ ?>
		
		<tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(($imp_or + $_SESSION['monto_i']), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_f13; ?></td> 
		 <td align="left" ><?php echo $des_ctaf13; ?></td> 
		 <td align="right" ><?php echo number_format( ($_SESSION['monto_i'] * -1), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
         <?php } ?>
		 <?php if(isset($_POST['cre_ser'])){ ?>
		 <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis']* -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_iue; ?></td> 
		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>	
		<tr>
		 <td align="left" ><?php echo $cta_it; ?></td> 
		 <td align="left" ><?php echo $des_ctait; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
			
         <?php } ?>
	<?php if(isset($_POST['cre_bie'])){ ?>
		 <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis']* -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_iue; ?></td> 
		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>	
		<tr>
		 <td align="left" ><?php echo $cta_it; ?></td> 
		 <td align="left" ><?php echo $des_ctait; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3'] * -1),2), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
			
         <?php } ?>	 
 </table> 
 	
<center>
 <input type="submit" name="accion" value="Imprimir">
     <input type="submit" name="accion" value="Salir">



 <?php } ?>
 <?php } ?>
 
 <?php 
 if ($_SESSION['detalle'] == 4){
    $imp_or = $_SESSION['monto_t'] * -1;
	//	      $importe = $monto_t;
	 $cta_ctb = 11101101;
	 $_SESSION['cta_ctb'] = $cta_ctb;
	// $importe_e =$monto_t;
	 $deb_hab = 2;
			  
	 $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
     $res_ctable = mysql_query($con_ctable);
	  while ($lin_ctable = mysql_fetch_array($res_ctable)) {
	        $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
	     }
$cta_ctbg = $_SESSION['cta_ctbg'];
$con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }	 		 
$_SESSION['t_fac_fis'] = 3;
 if(isset($_POST['imp_exe'])){
		    //echo "entra aqui?";
            $_SESSION['imp_exe'] = $_POST['imp_exe'];
			}
 if(isset($_SESSION['imp_exe'])){ 
  
  $monto_t = $_SESSION['imp_exe'];
  $_SESSION['monto_i'] = $monto_t * .13 ;
  
  $_SESSION['monto_p'] = $imp_or - $_SESSION['monto_i'];
  $cta_f13 = 14306101;
  $_SESSION['cta_f13'] = $cta_f13;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
		 }	 
     }
	 ?>
 	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr> 
	<tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format($_SESSION['monto_p'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_f13; ?></td> 
		 <td align="left" ><?php echo $des_ctaf13; ?></td> 
		 <td align="right" ><?php echo number_format( ($_SESSION['monto_i'] ), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
	</table> 	
<center>	
     <input type="submit" name="accion" value="Imprimir">
     <input type="submit" name="accion" value="Salir">
 </form>
	<?php  
	 
	 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
  
 }
 
 
 
 
 
 
 
if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $monto_t = $_SESSION['monto_t'] * -1;
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $cta_ctb = 
   $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
   
    echo "aqui".$c_agen.$nro_tr_caj,$descrip,$monto_t,$cta_ctbg ;
  
	header('Location: egre_mante.php');
	?>
  <?php } ?>
	 
</div>
  <?php
  */
		 	include("footer_in.php");
		 ?>
</div>
</center>
</body>
</html>
<?php
}
ob_end_flush();
 ?>