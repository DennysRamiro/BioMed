<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
	include('header_2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='con_retro.php?accion=2'>Salir</a>
  </div>
	<div id="cuerpoModulo">
        
<center>
<BR>
<font  size="+2">
<?php
echo "Asiento Contable";
?>
<div id="GeneralManCliente">
<?php
$quecom = $_POST['nro_doc'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $nro_doc = $quecom[$i];
 }
}
$con_cab  = "Select CONTA_CAB_GLOSA
	              From contab_cabec where CONTA_CAB_NRO = $nro_doc  
				  and CONTA_CAB_USR_BAJA is null";
    $res_cab = mysql_query($con_cab);
	while ($lin_cab = mysql_fetch_array($res_cab)) {
	 $glosa =  $lin_cab['CONTA_CAB_GLOSA'];
	}
$con_cbt  = "Select *
	              From contab_trans where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	     
		  $fecha = $lin_cbt['CONTA_TRS_FEC_VAL'];
		  $fecha = cambiaf_a_normal($fecha);
		  
	}
	
?>

<table width="85%"  border="0" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="60%" scope="col" align="left"><border="0" alt="" align="absmiddle" />
	   <?php echo "Comprobante Nro.".encadenar(2).$nro_doc;?>  </th>
	  <th width="40%" scope="col" align="right"><border="0" alt="" align="absmiddle" /> 
	   <?php echo "Fecha".encadenar(2).$fecha;?></th>
	 </tr>
	  <tr>
      <th width="60%" scope="col" align="left"><border="0" alt="" align="absmiddle" />
	   <?php echo "Glosa ".encadenar(2).$glosa;?>  </th>
	  <th width="40%" scope="col" align="right"><border="0" alt="" align="absmiddle" /> 
	   <?php echo encadenar(2);?></th>
	 </tr> 	 	
 <?php

	 ?>
<br>
<table width="85%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA  </th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="5%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr> 
	
	<?php
	// echo "Comprobante Nro.".encadenar(2).$nro_doc.encadenar(60)."Fecha".encadenar(2).$fecha;
	 ?>
	 <br>
	 </center> 
	<?php
	// echo "Glosa ".encadenar(2).$glosa;
	 ?>
	 <br>
	 <?php 	
	$impo_t1 = 0;
	$impoe_t1 = 0;
	$impo_t2 = 0;
	$impoe_t2 = 0;
	$con_cbt  = "Select *
	              From contab_trans where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	      $glosa_ind =  $lin_cbt['CONTA_TRS_GLOSA'];
	      $impo_1 = 0;
	      $impoe_1 = 0;
		  $impo_2 = 0;
	      $impoe_2 = 0;
	      $cuenta = $lin_cbt['CONTA_TRS_CTA'];
		  $desc = leer_cta_des($cuenta);
	      $deb_hab =  $lin_cbt['CONTA_TRS_DEB_CRED'];
	      
		  if ($deb_hab == 1){
		      $impo_1 = $lin_cbt['CONTA_TRS_IMPO'];
	          $impoe_1 = $lin_cbt['CONTA_TRS_IMPO_E'];
			}  
		  if ($deb_hab == 2){
		      $impo_2 = $lin_cbt['CONTA_TRS_IMPO'];
	          $impoe_2 = $lin_cbt['CONTA_TRS_IMPO_E'];
			}
			
		 
			
		  $impo_t1 = $impo_t1 +  $impo_1;
	      $impoe_t1 = $impoe_t1 + $impoe_1;
	      $impo_t2 = $impo_t2 + $impo_2  ;
	      $impoe_t2 = $impoe_t2 +  $impoe_2;  
	 
	?>
	
	
	
	
	
	
	 <tr>
	 	      <td align="left"><?php echo $cuenta; ?></td>
			  <td align="left"><?php echo $desc; ?>
			  <br><?php echo  $glosa_ind; ?> </td>
		      <td align="right"><?php echo number_format($impo_1, 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($impo_2, 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($impoe_1, 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($impoe_2, 2, '.',','); ?></td>
	     </tr>
	<?php }  ?>
	 <tr>
	 	      <th align="left"><?php echo encadenar(2); ?></td>
			  <th align="left"><?php echo "Totales"; ?></td>
		      <th align="right"><?php echo number_format($impo_t1, 2, '.',',') ; ?></td>
		      <th align="right"><?php echo number_format($impo_t2, 2, '.',','); ?></td>
		      <th align="right"><?php echo number_format($impoe_t1, 2, '.',',') ; ?></td>
		      <th align="right"  ><?php echo number_format($impoe_t2, 2, '.',','); ?></td>
	     </tr>
	
	
	
	
	</table>
	 
 
  <br>
 <br>
 <br>
  <br><br>
<center>
 <?php


  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
  
 <?php
  
  echo encadenar(12)."GERENTE", encadenar(40),"     CONTADOR";
  ?>	
  <br><br>
  <br><br>
  </center>
 
 
</div>
  <?php
		 	include("footer_in.php");
  ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>