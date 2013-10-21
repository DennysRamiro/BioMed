<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
    include("header_2.php");
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = $_SESSION['fec_proc'];  //leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cjach_selec_1.php?menu=1'>Salir</a>
  </div>
<br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";

if ($_SESSION['detalle'] <> 3) {	
    if(isset($_SESSION['nro_caja'])){
      $nro_caja = $_SESSION['nro_caja'];
    }
 } 
	if(isset($_SESSION['nro_caja'])){
      $nro_caja = $_SESSION['nro_caja'];
  }

	  ?>
	  <table border="1" width="750" align="center" class="table_usuario">
	
	<tr>
	    <th align="center">Nro.</th>
	    <th align="center">Responsable </th>  
	   	<th align="center">Descripci&oacute;n</th> 
		<th align="center">Cta. Contab.</th>           
	    <th align="center">Desc. Cta.Contab.</th>
		<th align="center">Monto Asignado</th>
		<th align="center">Saldo</th>
		<th align="center">Vigencia</th>
   </tr>	
	
	<?php

   $con_rec = "Select * From cjach_cntrl where CJCH_CTRL_NRO = $nro_caja and CJCH_CTRL_ESTADO = 1
               and CJCH_CTRL_USR_BAJA is null order by CJCH_CTRL_ID ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	   $fec_ent = cambiaf_a_normal($lin_res['CJCH_CTRL_FEC_H']);
	   $_SESSION['ctble_cja'] = $lin_res['CJCH_CTRL_CTA'];
	   $_SESSION['cod_cja'] = $nro_caja;
	   $_SESSION['mon_asig'] = $lin_res['CJCH_CTRL_ASIG'];
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
		  <td align="right" ><?php echo number_format($lin_res['CJCH_CTRL_ASIG'], 2, '.',','); ?></td>
		  <td align="right" ><?php echo number_format($lin_res['CJCH_CTRL_SALDO'], 2, '.',','); ?></td>
		  <td align="left" ><?php echo $fec_ent; ?></td> 
	    
		
		 </tr>
	<?php
	  }
	 

?>

</table>
<br>

  <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th width="10%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="10%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />Nro.TRAN.</th>
	  <th width="35%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />CONCEPTO</th>
	   <th width="10%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FACTURA Nro.</th> 
	   <th width="10%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />RECIBO Nro.</th> 
	  <th width="12%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE Bs.</th>
	  <th width="13%" style="font-size:11px"scope="col"><border="0" alt="" align="absmiddle" />SALDO Bs.</th>
	</tr>

<font size="+1"  style="" >
                   LIQUIDACION CAJA CHICA
</font>
<?php
    $_SESSION['diferencia'] = 0;
    $_SESSION['detalle'] = 1;
    $_SESSION['cuantos'] = 0;
	$saldo = $_SESSION['mon_asig'];
  //  $borr_cob  = "Delete From temp_ctable"; 
  //  $cob_borr = mysql_query($borr_cob);
 //   }
if ($_SESSION['detalle'] == 1){
    // cobros y desembolsos
	
    $con_tpa = "Select DISTINCT CJCH_TRAN_NRO_CJA, CJCH_TRAN_FECHA, CJCH_TRAN_NRO_COR, CJCH_TRAN_NRO_ASIG 
	            From cjach_transac where CJCH_TRAN_NRO_CJA = $nro_cjch and CJCH_TRAN_NRO_ASIG = $nro_asig
	            and (CJCH_TRAN_TIPO_OPE = 2 or CJCH_TRAN_TIPO_OPE = 2) and CJCH_TRAN_USR_BAJA is null 
				 order by CJCH_TRAN_TIPO_OPE, CJCH_TRAN_FECHA, CJCH_TRAN_NRO_COR ";
				 
    $res_tpa = mysql_query($con_tpa);
	
	while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		    $fec_pag = $lin_tpa['CJCH_TRAN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CJCH_TRAN_NRO_COR'];
			
		   // echo $fec_pag."*B*".$cta_ctble."*N*".$nro_cjch."*T*".$nro_tran;	
	      	$con_tra = "Select * From cjach_transac where CJCH_TRAN_NRO_CJA = $nro_cjch and 
	            CJCH_TRAN_FECHA = '$fec_pag' and CJCH_TRAN_NRO_COR = $nro_tran and
				CJCH_TRAN_CTA_CONT = '$cta_ctble'
				and CJCH_TRAN_USR_BAJA is null";
				
            $res_tra = mysql_query($con_tra)or die('No pudo seleccionarse tabla cart_det_tran');
			
			while ($lin_tra = mysql_fetch_array($res_tra)) {
			      $fec_tra  = $lin_tra['CJCH_TRAN_FECHA'];
				  $fec_tra = cambiaf_a_normal($fec_tra);
				  $p_imp = $lin_tra['CJCH_TRAN_IMPORTE'];
				  $cta  = leer_cta_des($lin_tra['CJCH_TRAN_CTA_CONT']);
				  $saldo = $saldo + $lin_tra['CJCH_TRAN_IMPORTE'];
				  
	           ?>
			  <tr>
		       <td align="center"><?php echo $fec_tra; ?></td>
	 	      <td align="center"><?php echo $lin_tra['CJCH_TRAN_NRO_COR']; ?></td>
		      <td align="left" style="font-size:11px"><?php echo utf8_encode($lin_tra['CJCH_TRAN_DESCRIP']); ?></td>
			  <td align="center"><?php echo $lin_tra['CJCH_TRAN_REL_FAC']; ?></td>
			  <td align="center"><?php echo $lin_tra['CJCH_TRAN_NRO_VEN']; ?></td>
		      <td align="right"><?php echo number_format($lin_tra['CJCH_TRAN_IMPORTE']*-1, 2, '.',','); ?></td>
		      <td align="right"  ><?php echo number_format($saldo, 2, '.',','); ?></td>
	     </tr>
  <?php }?>
		
         

	<?php }   ?>
		 <tr>
		      <td align="left"><?php echo encadenar(2); ?></th>
			  <td align="right"><?php echo encadenar(2); ?></td>
	 	      <th align="left"><?php echo "MONTO DE REPOSICION"; ?></th>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <td align="right"><?php echo encadenar(2); ?></td>
			  <td align="right"><?php echo encadenar(2); ?></td>
		      <th align="right"><?php echo number_format($_SESSION['mon_asig']-$saldo, 2, '.',','); ?></td>
	     </tr>
      </table>
   
	 </center>
	    <br>
	


<?php } ?>
<font size="-2">
<?php	
 	include("footer_in.php");
?>
</font>
</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

