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
<body>
	<div id="cuerpoModulo">
	<?php
			//	include("header.php");
			?>
            <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='rep_param_cja.php?menu=8'>Salir</a>
  </div>
  <?php  
  //include("header_2.php");
  
	?>
 <br>
<?php

$fec_des = $_POST['fec_des'];
$fec1 = cambiaf_a_mysql_2($fec_des);
$fec_has = $_POST['fec_has'];
$fec2 = cambiaf_a_mysql_2($fec_has);
//if ($_SESSION['continuar'] == 1){
    $_SESSION['diferencia'] = 0;
    $_SESSION['detalle'] = 1;
    $_SESSION['cuantos'] = 0;
	$apli2 = 0;
	?>
	<center>
	<strong> 
	<?php
    echo encadenar(40)."Detalle de Transacciones Revertidas".encadenar(2);
	echo "Del ".encadenar(2).$fec_des. encadenar(2)."al". encadenar(2).$fec_has;
	?>
	
	</strong> </center>
<br><br>	
</table>
<font size="0"  style="" >
  <table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th  width="12%" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />NRO. TRAN.</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="12%" scope="col"><border="0" alt="" align="absmiddle" />NRO. OPERA.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />MONTO BS.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />MONTO $US.</th>
	  
	  
	</tr>  
<?php







if ($_SESSION['detalle'] == 1){
    $con_cart  = "select  * from caja_transac 
	              where (CAJA_TRAN_FECHA between '$fec1' and '$fec2') and 
				  CAJA_TRAN_USR_BAJA is not null
	              order by CAJA_TRAN_APL_DES,CAJA_TRAN_FECHA";
    $res_cart = mysql_query($con_cart); 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	    //    $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$apli = $lin_cart['CAJA_TRAN_APL_DES'];
			$nro_tran = $lin_cart['CAJA_TRAN_NRO_CAR'];
			$desc = utf8_encode($lin_cart['CAJA_TRAN_DESCRIP']);
			$fec = $lin_cart['CAJA_TRAN_FECHA'];
			$monto2  = $lin_cart['CAJA_TRAN_IMPORTE'];
			$mon_eqv = $lin_cart['CAJA_TRAN_IMP_EQUIV'];
			$nro_ope = $lin_cart['CAJA_TRAN_COD_SC'];
			$con_apl = "Select GRAL_PAR_PRO_DESC From gral_param_propios where
			            GRAL_PAR_PRO_GRP = 100 and GRAL_PAR_PRO_COD = $apli";
		     $res_apl = mysql_query($con_apl);
		     while ($lin_apl = mysql_fetch_array($res_apl)) {
		           $aplicacion = $lin_apl['GRAL_PAR_PRO_DESC']  ;
			  }
             if ($monto2 < 0){
			     $monto2 = $monto2 * -1;
				 $mon_eqv = $mon_eqv * -1;
	         }
			 if ($monto2 == $mon_eqv){
			     $mon_eqv = 0;
			}	 
/*		 
	 */ ?> 
	 <?php if ($apli <> $apli2){?>
	 <tr>
	          <td align="right"><?php echo encadenar(2); ?></td>
		      <th align="left"><?php echo $apli; ?></th>
	 	      <th align="left"><?php echo $aplicacion; ?></th>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <td align="right"  ><?php echo encadenar(2); ?></td>
	     </tr>
		 <?php $apli2 = $apli;
		  } ?>
	 <tr>
		      <td align="center"><?php echo cambiaf_a_normal($fec); ?></td>
		      <td align="left"><?php echo $nro_tran; ?></th>
	 	      <td align="left"><?php echo $desc ; ?></th>
			  <td align="left"><?php echo $nro_ope ; ?></th>
		     <td align="right"><?php echo number_format($monto2 , 2, '.',','); ?></th>
		     <td align="right"><?php echo number_format($mon_eqv, 2, '.',',') ; ?></th>
		     
	     </tr>
		
  
  <?php
  }
 ?>
	     </tr>
     </table>
   
	 <center>
	    
	 
<?php } ?>


<?php
/* 
*/ ?>
	
	
	 
</center>
  <?php
	 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>