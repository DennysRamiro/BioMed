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
	require('funciones2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
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
$consulta  = "Select * From temp_ctable order by temp_nro_cta,temp_tip_tra";
    $resultado = mysql_query($consulta);
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	?>
	
	<tr>
	   <td align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
	 	<td align="left" style="font-size:12px"><?php echo encadenar(10); ?></td>
		<td align="left" style="font-size:12px"><?php echo "Saldo al ".$fec_has; ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5) ; ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo number_format($saldo_sus, 2, '.',','); ?></td>
	 </tr>
	
	<?php
	
	
	
    while ($linea = mysql_fetch_array($resultado)) {
	
	      $tip_cta = $cod_cta[0];
 	  if ($tip_cta == 1){  
	      $sal_1 = $sal_1 + $linea['temp_debe_1'] - $linea['temp_haber_1'];
		  $sal_2 = $sal_2 + $linea['temp_debe_2'] - $linea['temp_haber_2'];	 
	   } 
	     
       if ($tip_cta == 4){  
	      $sal_1 = $sal_1 + $linea['temp_debe_1'] - $linea['temp_haber_1'];
		  $sal_2 = $sal_2 + $linea['temp_debe_2'] - $linea['temp_haber_2'];	 
	   }   
	   if ($tip_cta == 2){  
	      $sal_1 = $sal_1 - $linea['temp_debe_1'] + $linea['temp_haber_1'];
		  $sal_2 = $sal_2 - $linea['temp_debe_2'] + $linea['temp_haber_2'];	 
	   } 
	   if ($tip_cta == 5){  
	      $sal_1 = $sal_1 - $linea['temp_debe_1'] + $linea['temp_haber_1'];
		  $sal_2 = $sal_2 - $linea['temp_debe_2'] + $linea['temp_haber_2'];	 
	   } 
	   
	   
	   
	      $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
		      <td align="left" style="font-size:12px"><?php echo $linea['temp_tip_tra']; ?></td>
			  <td align="left" style="font-size:12px"><?php echo $linea['temp_nro_cta']; ?></td>
	 	      <td align="left" style="font-size:12px"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
			  <td align="right" style="font-size:12px"><?php echo number_format($sal_1, 2, '.',','); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			  <td align="right" style="font-size:12px"><?php echo number_format($sal_2, 2, '.',','); ?></td>
	     </tr>
	
     <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
		     <th align="center"><?php echo "Saldo Final"; ?></th>
		     <td align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
		     <td align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
			 <th align="right"><?php echo number_format($sal_1, 2, '.',','); ?></td>
		     <td align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
		     <td align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
			 <th align="right" ><?php echo number_format($sal_2, 2, '.',','); ?></th>
	     </tr>
     </table>
     <center>
	    
	 <input type="submit" name="accion" value="Imprimir Mayor">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php // } //1b?>
<?php
/*$quecom = $_POST['nro_doc'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $nro_doc = $quecom[$i];
 }
}
$con_cbt  = "Select *
	              From contab_trans where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	     $glosa =  $lin_cbt['CONTA_TRS_GLOSA'];
		  $fecha = $lin_cbt['CONTA_TRS_FEC_VAL'];
		  $fecha = cambiaf_a_normal($fecha);
		  
	} 
echo "Detalle Movimientos Cuenta".encadenar(2).$_SESSION['cod_cta'].encadenar(2).
	     $_SESSION['des_cta'].encadenar(2)."del".encadenar(2).$_SESSION['fec_des'].
		 encadenar(2)."al".encadenar(2).$_SESSION['fec_has'];
		 	
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
			  <td align="left"><?php echo $desc; ?></td>
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
  */
		 	include("footer_in.php");
  ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>