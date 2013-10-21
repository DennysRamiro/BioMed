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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login'];
 
 ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
<?php


?> 
 <font size="+2"  style="" >
<?php
echo encadenar(45)."Detalle de Traspaso Cartera Cierre al".encadenar(3).$fec;
?>

<?php
 ?>  
  
     
 <?php  

?>


<center>
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Crédito</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Estado Actual</th>
		<th align="center">Estado Nuevo</th>
		<th align="center">Fecha Vto. Actual</th>
		<th align="center">Saldo </th>
  </tr>	
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$nro = 0;
$con_tras = "Select * From temp_trasp order by moneda, esta_act";
$res_tras = mysql_query($con_tras)or die('No pudo seleccionarse tabla temp_trasp')  ;
	
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
	        $nro = $nro + 1;
			$f_vto = cambiaf_a_normal($lin_tras['fecha_vto']); 
			if ($lin_tras['esta_act'] == 3) {
	           $est_act = "Vigente";
			   }
			if ($lin_tras['esta_act'] == 6) {
	           $est_act = "Vencido";
			   } 
			if ($lin_tras['esta_nue'] == 3) {
	           $est_nue = "Vigente";
			   }
			if ($lin_tras['esta_nue'] == 6) {
	           $est_nue = "Vencido";
			   } 
			if ($lin_tras['moneda'] == 1) { 
			    $d_mone = "BOLIVIANOS";
				}else{
				$d_mone = "DOLARES";
				}     
			if ($lin_tras['moneda'] <> $mone) {
	           $mone = $lin_tras['moneda'];	?>
			   
	<tr>
	    <th align="center"><?php echo encadenar(3); ?></th>  
	   	<th align="center"><?php echo encadenar(5); ?></th> 
		<th align="center"><?php echo 'MONEDA'; ?></th>           
	    <th align="center"><?php echo $d_mone; ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<th align="center"><?php echo encadenar(5); ?> </th>
  </tr>	
  <?php } ?> 
<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $lin_tras['credito']; ?></td>
	    <td align="left" ><?php echo $lin_tras['cliente']; ?></td>
		<?php
		if ($lin_tras['grupo'] <> ""){
		?>
		<td align="left" ><?php echo $lin_tras['grupo']; ?></td>
		<?php
		 }else{
		?> 
		<td align="left" ><?php echo encadenar(5); ?></td>
		<?php
		 }
		?> 
		<td align="center" ><?php echo $est_act; ?></td>
		<td align="center" ><?php echo $est_nue; ?></td>
		<td align="center" ><?php echo $f_vto; ?></td>
		<td align="right" ><?php echo number_format($lin_tras['saldo'], 2, '.',','); ?></td>
	</tr>	
	<?php
		}
    ?>
	
</table>
		  
<br>
</center>
</font>

<?php
		 	include("footer_in.php");
		 ?>

</div>




<?php
}
ob_end_flush();
 ?>

