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
<!--Titulo de la pesta�a de la pagina-->
<title>Reposicion Caja Chica</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script type="text/javascript" src="js/ModulosCajaChica.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script>
</head>
<body>

<div id="dialog-confirmCierre" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Esta seguro de solicitar LA REPOSICION?</font></p>
</div>

	<?php
				include("header.php");
			?>

<div id="pagina_sistema">
      <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_cajachica">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_cajachica_liquidacion">
                    
                     <img src="img/export_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPOSIC. CAJA CHICA
                    
                 </li>
                
              </ul>  



 <div id="contenido_modulo">

                      <h2> <img src="img/export_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPOSICION CAJA CHICA </h2>
                      <hr style="border:1px dashed #767676;">
                  
<?php
					// $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
<form name="form2" method="post" action="con_retro_1_cjach.php" onSubmit="return ValidaCamposEgresos(this)">
  
<?php
// $_SESSION['continuar'] = 0;
// if ($_SESSION['cargo'] == 2){ 
 //     echo "Usuario no Habilitado para este proceso ".encadenar(2)." !!!!!";
 //     $_SESSION['continuar'] = 1;
	  
?>
<br>
<center>
  <!--input class="btn_form" type="submit" name="accion" value="Salir_Opc"-->
     
</form>	
<?php
	  
?>
<br>
<center>
  <!--input class="btn_form" type="submit" name="accion" value="Salir_Opc"-->
     
</form>	
<?php
if ($_SESSION['continuar'] == 0){
if (isset($_POST["cod_sol"])){
$quecom = $_POST['cod_sol'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_sol = $quecom[$i];
	      $_SESSION['nro_caja'] = $cod_sol;
		 // echo $_SESSION['nro_caja'];
        } 
   }
   }else{
	   header('location: cjach_selec_3.php');
	}   
 ?>
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
	
	<tr>
	    <th align="center">Nro.</th>
	    <th align="center">Responsable </th>  
	   	<th align="center">Descripci&oacute;n</th> 
		<th align="center">Cta. Contab.</th>           
	    <th align="center">Desc. Cta.Contab.</th>
		
   </tr>	
	
	<?php

   $con_rec = "Select * From cjach_cntrl where CJCH_CTRL_NRO = $cod_sol and CJCH_CTRL_ESTADO = 2
               and CJCH_CTRL_USR_BAJA is null order by CJCH_CTRL_ID ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	   $fec_ent = cambiaf_a_normal($lin_res['CJCH_CTRL_FEC_H']);
	   $_SESSION['ctble_cja'] = $lin_res['CJCH_CTRL_CTA'];
	   $_SESSION['cod_cja'] = $cod_sol;
	   $_SESSION['mon_asig'] = $lin_res['CJCH_CTRL_ASIG'];
	    $_SESSION['nom_cja'] = utf8_encode($lin_res['CJCH_CTRL_NOMB']);
		 $_SESSION['nro_cjch'] = $lin_res['CJCH_CTRL_NRO'];
	   $nro_cjch = $lin_res['CJCH_CTRL_NRO'];
	   $nro_asig = $lin_res['CJCH_CTRL_NRO_ASIG'];
	   $cta_ctble = $lin_res['CJCH_CTRL_CTA'];
	  ?>
	     <tr>
		  <td align="left" ><?php echo $lin_res['CJCH_CTRL_NRO']; ?></td>
		  <td align="left" ><?php echo $lin_res['CJCH_CTRL_FUNC']; ?></td> 
		  <td align="left" ><?php echo utf8_encode($lin_res['CJCH_CTRL_NOMB']); ?></td> 
		  <td align="left" ><?php echo $lin_res['CJCH_CTRL_CTA'];?></td>
		  <td align="left" ><?php $des_cta = leer_cta_des($lin_res['CJCH_CTRL_CTA']);
		  echo utf8_encode($des_cta); ?></td>
		  
	    
		
		 </tr>
	<?php
	  }
	 

 ?>

</table>
<br>

  <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th width="20%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FECHA ASIGNACION</th>
	  <th width="20%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />MONTO ASIGNADO</th>
	  <th width="20%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />MONTO EJECUTADO</th>
	  <th width="20%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />SALDO</th>
	  
	</tr>
<?php
    $_SESSION['diferencia'] = 0;
    
    $_SESSION['cuantos'] = 0;
	$saldo = $_SESSION['mon_asig'];
   $con_bco  = "Select * From gral_cta_banco where GRAL_CTA_BAN_MON = 1 
	              and GRAL_CTA_BAN_COD <> 0 and GRAL_CTA_BAN_USR_BAJA is null order by GRAL_CTA_BAN_CTA_CTE";
    $res_bco = mysql_query($con_bco);
if ($_SESSION['detalle'] == 1){
    // cobros y desembolsos
	
	$consulta  = "SELECT CJCH_TRAN_FECHA, CJCH_TRAN_IMPORTE, CJCH_TRAN_NRO_ASIG FROM cjach_transac 
	              WHERE CJCH_TRAN_TIPO_OPE = 1 and CJCH_TRAN_NRO_CJA = $nro_cjch
				  and CJCH_TRAN_USR_BAJA is null
                ORDER BY CJCH_TRAN_FECHA DESC LIMIT 0,1";
    $resultado = mysql_query($consulta);
	while ($linea = mysql_fetch_array($resultado)) {
	       $fec_asi = $linea['CJCH_TRAN_FECHA'];
		   $mon_asi = $linea['CJCH_TRAN_IMPORTE'];
	       $nro_asig = $linea['CJCH_TRAN_NRO_ASIG'];
		   $fec_a = cambiaf_a_normal($fec_asi);
	}
//	echo $fec_asi."--".$nro_cjch."**";
      $con_dtra  = "Select sum(CJCH_TRAN_IMPORTE) From cjach_transac 
	                where CJCH_TRAN_NRO_CJA = $nro_cjch and CJCH_TRAN_FECHA >= '$fec_asi'
					and  CJCH_TRAN_CTA_CONT = '$cta_ctble' and CJCH_TRAN_NRO_ASIG = $nro_asig and
               CJCH_TRAN_TIPO_OPE = 2 and CJCH_TRAN_USR_BAJA is null ";
			// }
				 
     $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CJCH_TRAN_IMPORTE)'];
			   //
			$monto = $monto * -1;
		     $_SESSION['monto']	= $monto;
	    
	           ?>
			  <tr>
		      <td align="center"><?php echo $fec_a; ?></td>
	 	      <td align="right"><?php echo number_format($mon_asi, 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($monto, 2, '.',','); ?></td>
		     <td align="right"><?php echo number_format($mon_asi - $monto, 2, '.',','); ?></td>
			  
	     </tr>
          </table>

	<?php }   ?>
	 <?php 
	 $con_asig  = "Select * From cjach_asignacion 
	                where CJCH_ASIN_CAJA = $nro_cjch  and
					CJCH_ASIN_ESTADO = 1 and
					 CJCH_ASIN_USR_BAJA is null ";
			// }
				 
     $res_asig = mysql_query($con_asig);
   	        while ($lin_asig = mysql_fetch_array($res_asig)) {
	              $monto_s = $lin_asig['CJCH_ASIN_SOLIC'];
				  $nro_as_sol = $lin_asig['CJCH_ASIN_NRO'];
			   
			$_SESSION['nro_as_sol']	= $nro_as_sol;
		     $_SESSION['monto_s']	= $monto_s;
	    
	           ?>
     
	  <br>
   <table width="70%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
        <th align="left">Cuenta Banco:</th>
	    <td> <select name="cod_bco" id="cod_bco" size="1"  style="width:500px;">
	    	
	        <?php while ($lin_bco = mysql_fetch_array($res_bco)) { ?>
            <option value=<?php echo $lin_bco['GRAL_CTA_BAN_CTA_CTE']; ?>>
			              <?php echo $lin_bco['GRAL_CTA_BAN_CTA_CTE'].encadenar(2); ?>
			              <?php echo $lin_bco['GRAL_CTA_BAN_DESC']; ?></option>
            <?php }
			
			 ?>
		    </select></td>
       </tr>
    <tr>
	    <th align="left">Monto Solicitado:</th>
	   <td><input class="txt_campo" type="text" name="mon_sol" id="des" size="12" maxlength="12"  value="<?= $_SESSION['monto_s'];?>" >
	
	  
	</tr>
   
   </table>
	 <center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Confirmar Reposicion"  onClick="return confirmar_reponer_cajachica()">
     </center>
</form>	

 

<?php }   ?>
<?php } }} ?>


<?php
if ($_SESSION['detalle'] == 2){

//echo "Confirmar Reposicion";
$_SESSION['monto_t'] = 0;
     $_SESSION['monto_p'] = 0;
     $_SESSION['monto_125'] = 0;
     $_SESSION['monto_3'] = 0;
     $tc_ctb = $_SESSION['TC_CONTAB'];
  if (isset($_POST['mon_sol'])){
	        $importe = $_POST['mon_sol'];
			$monto_t = $importe;
			$_SESSION['monto_t'] = $monto_t;
	    }
$cta_otra = $_SESSION['ctble_cja'];		
  if (isset($_POST['cod_bco'])){	 
	    $cta_bco = $_POST['cod_bco'];
        $_SESSION['cta_bco'] =$cta_bco;
		 $consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE = '$cta_bco' and
	                  GRAL_CTA_BAN_USR_BAJA is null ";
        $resultado = mysql_query($consulta);
	    while ($linea = mysql_fetch_array($resultado)) {
	           $cta_banco = $linea['GRAL_CTA_BAN_CTBL'];
		       $_SESSION['cod_bco'] =  $linea['GRAL_CTA_BAN_COD']; 
	           $_SESSION['cta_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	           $_SESSION['nom_cta'] =  $linea['GRAL_CTA_BAN_DESC']; 
		}
		//$des_banco = leer_cta_des($cta_banco);
		$des_banco = leer_cta_des($cta_banco);
		$des_otra = leer_cta_des($cta_otra);
		$mon_bco = leer_cta_mon($cta_banco);
		$mon_otra = leer_cta_mon($cta_otra);
	    $_SESSION['cta_otra'] = $cta_otra;
		$_SESSION['cta_banco'] = $cta_banco;
		$_SESSION['des_otra'] = $des_otra;
	    $_SESSION['des_banco'] = $des_banco;
 }
 //}
   $impo_bs1 = $importe ;
	        $impo_eqv1 = round(($importe / $_SESSION['TC_CONTAB']),2);
		    $_SESSION['impo_bs1'] = $impo_bs1;
		    $_SESSION['impo_eqv1'] = $impo_eqv1;
			 $impo_bs2 = $importe ;
	           $impo_eqv2 = round(($importe / $_SESSION['TC_CONTAB']),2);
		       $_SESSION['impo_bs2'] = $impo_bs2;
		       $_SESSION['impo_eqv2'] = $impo_eqv2;
 $_SESSION['des_tran'] = "Reposicion Caja Chica";
 $_SESSION['descrip'] = $_SESSION['des_tran'];
 ?>
		
	  <b>
<table width="90%"  border="0" cellspacing="1" cellpadding="1" align="center" >
	<tr>
	<td><?php echo $_SESSION['des_tran'].encadenar(2).$_SESSION['nom_cja']; ?></td>
    </tr>
	<tr> 
	<td><?php echo "De la Cuenta ".encadenar(2).$_SESSION['nom_cta']; ?></td>
	 </tr>
 </table>
	 </b>
	
	 <table width="90%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
	<tr>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="35%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
      <th width="13%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="12%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="12%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="13%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr> 
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_otra']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_otra']; ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	</tr>
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_banco'] ; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_banco']; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs2'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv2'], 2, '.',','); ?></td>
	</tr>
	 
</table> 
<input class="btn_form" type="submit" name="accion" value="Recibo">
</form>
  <?php
  
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>