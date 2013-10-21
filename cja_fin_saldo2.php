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
<title>Saldo Final Caja</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
</head>
<body>
	<div id="cuerpoModulo">
	<?php
				include("header.php");
			?>
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />

				<?php
					 $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					// $_SESSION['continuar'] = 1;
					// $_SESSION['detalle'] = 1;
				?>
             </div>
             <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div> 
				<div id="TitleModulo">
                	<img src="images/24x24/001_35.png" border="0" alt="" />Saldo Final Caja
          </div> 
              <div id="AtrasBoton">
           		<a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposCortes(this)">
<?php
$mon = $_SESSION['caja_bs_sus'];

//if ($_SESSION['continuar'] == 1){
//    $_SESSION['cuantos'] = 0;
  //  $borr_cob  = "Delete From temp_ctable "; 
  //  $cob_borr = mysql_query($borr_cob)or die('No pudo borrar temp_ctable');
//    }
if ($_SESSION['detalle'] == 1){ //1a
	$saldo = saldo_fin_cja2($fec1,$log_usr,$mon);
	$_SESSION['saldo'] = $saldo;
	$vales = saldo_fin_vale($fec1,$log_usr,$mon);
	$_SESSION['vales'] = $vales;
	$banco = saldo_fin_banco($fec1,$log_usr,$mon);
	$_SESSION['banco'] = $banco;
?>
    <table align="center" border="1">
    
      <tr>
	    <th align="left">Saldo Transacciones :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['saldo'])){?>
		<th align="right"><?php echo number_format($_SESSION['saldo'], 2, '.',','); ?> </td>
		<?php } ?> 
	  </tr>
	  <tr>
	    <th align="left">Saldo Vales :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['vales'])){?>
		<th align="right"><?php echo number_format($_SESSION['vales'], 2, '.',','); ?> </td>
		<?php } ?> 
	  </tr>
	  <tr>
	    <th align="left">Saldo Bancos :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['bancos'])){?>
		<th align="right"><?php echo number_format($_SESSION['bancos'], 2, '.',','); ?> </td>
		<?php }else{
		    $_SESSION['bancos'] = 0; ?>
		<th align="right"><?php echo number_format(0, 2, '.',','); ?> </td>
		 <?php } ?> 
	  </tr>
	   <tr>
	    <th align="left">Saldo Efectivo :</th>
		<td align="center"><?php echo encadenar(2); ?></td>
		<?php if (isset ($_SESSION['bancos'])){?>
		<th align="right"><?php echo number_format($_SESSION['saldo'] - $_SESSION['vales'] - $_SESSION['bancos'] 
		                              , 2, '.',','); ?> </td>
		<?php }
		    
	  }  //1b?>
	 </table>
<?php if ($_SESSION['continuar'] == 1){	 
	 ?>  	 
	 <table align="center" border="1">
	  <tr>
        <td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Cantidad </strong></td>
   </tr>
     	 
	<?php // } 
	if ($mon == 1){
	 $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP >= 110 and 
	              GRAL_PAR_PRO_GRP <= 120 and GRAL_PAR_PRO_COD <> 0   order by 1,2";
	}	
	if ($mon == 2){
	 $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130  
	              and GRAL_PAR_PRO_COD <> 0   order by 1,2";
	}			  
    $res_cor = mysql_query($con_cor);
	 while ($lin_cor = mysql_fetch_array($res_cor)) { 
	       $cod_grp = $lin_cor['GRAL_PAR_PRO_GRP'].$lin_cor['GRAL_PAR_PRO_COD']; 
		//  echo $cod_grp;
		  ?> 
	  <?php if ($lin_cor['GRAL_PAR_PRO_GRP'] == 110 and
	           $lin_cor['GRAL_PAR_PRO_COD'] == 1 ){?>	  
	  <tr>
        <th align="center"><strong>Billetes  </strong> </th>
		<td align="center"> <?php echo encadenar(2); ?></td>
		<td align="center"><?php echo encadenar(2); ?></td>
   </tr>       
	<?php } ?> 
	 <?php if ($lin_cor['GRAL_PAR_PRO_GRP'] == 120 and
	           $lin_cor['GRAL_PAR_PRO_COD'] == 1 ){?>	  
	  <tr>
        <th align="center"><strong>Monedas  </strong> </th>
		<td align="center"> <?php echo encadenar(2); ?></td>
		<td align="center"><?php echo encadenar(2); ?></td>
   </tr>       
	<?php } ?> 
    <tr>
	  	<td><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?> </td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<?php if ($cod_grp == 1101){?>
		      <td><input type="text" name="can_1101" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
         <?php if ($cod_grp == 1102){?>
		      <td><input type="text" name="can_1102" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
		 <?php if ($cod_grp == 1103){?>
		      <td><input type="text" name="can_1103" maxlength="8" size="8" value="" ></td>    
        <?php } ?> 
		 <?php if ($cod_grp == 1104){?>
		      <td><input type="text" name="can_1104" maxlength="8" size="8" value="" ></td>    
        <?php } ?>
		 <?php if ($cod_grp == 1105){?>
		      <td><input type="text" name="can_1105" maxlength="8" size="8" value="" ></td>    
        <?php } ?> 
		 <?php if ($cod_grp == 1106){?>
		      <td><input type="text" name="can_1106" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
		  <?php if ($cod_grp == 1201){?>
		      <td><input type="text" name="can_1201" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
		 <?php if ($cod_grp == 1202){?>
		      <td><input type="text" name="can_1202" maxlength="8" size="8" value="" ></td>    
        <?php } ?> 
		 <?php if ($cod_grp == 1203){?>
		      <td><input type="text" name="can_1203" maxlength="8" size="8" value="" ></td>    
        <?php } ?> 
		 <?php if ($cod_grp == 1204){?>
		      <td><input type="text" name="can_1204" maxlength="8" size="8" value="" ></td>    
        <?php } ?>
		 <?php if ($cod_grp == 1205){?>
		      <td><input type="text" name="can_1205" maxlength="8" size="8" value="" ></td>    
        <?php } ?> 
		<?php if ($cod_grp == 1206){?>
		      <td><input type="text" name="can_1206" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
		<?php if ($cod_grp == 1301){?>
		      <td><input type="text" name="can_1301" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
         <?php if ($cod_grp == 1302){?>
		      <td><input type="text" name="can_1302" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
		 <?php if ($cod_grp == 1303){?>
		      <td><input type="text" name="can_1303" maxlength="8" size="8" value="" ></td>    
        <?php } ?> 
		 <?php if ($cod_grp == 1304){?>
		      <td><input type="text" name="can_1304" maxlength="8" size="8" value="" ></td>    
        <?php } ?>
		 <?php if ($cod_grp == 1305){?>
		      <td><input type="text" name="can_1305" maxlength="8" size="8" value="" ></td>    
        <?php } ?> 
		 <?php if ($cod_grp == 1306){?>
		      <td><input type="text" name="can_1306" maxlength="8" size="8" value="" ></td>    
        <?php } ?>  
		 <?php if ($cod_grp == 1307){?>
		      <td><input type="text" name="can_1307" maxlength="8" size="8" value="" ></td>    
        <?php } 
		} ?>  
		               
		
    </tr>
  </table>
  <?php } ?> 
	 <center>
	<?php //} 
if ($_SESSION['continuar'] == 1){  ?>
	    
	 <input type="submit" name="accion" value="Recalcular">
     
</form>	
 <?php } 
 ?> 
 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

<?php //} 
if ($_SESSION['continuar'] == 2){ 
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
//$cuantos = 0;
$m_debe_1 = 0;
$m_haber_1 = 0;
$m_debe_2 = 0;
$m_haber_2 = 0;
$mon_cta = 0;
$tot_bs = 0;
$tot_sus = 0;
//1a


 //echo "Recalcular";
 ?>
  <table align="center" border="1">
	  <tr>
        <td align="center"><strong>Corte  </strong> </td>
		<td align="center"><strong>Sigla  </strong></td>
		<td align="center"><strong>Cantidad </strong></td>
		<td align="center"><strong>Monto </strong></td>
   </tr> 
 
 <?php
 if ($_SESSION['caja_bs_sus'] == 1){
    $can_1101 = $_POST['can_1101'];
	$can_1102 = $_POST['can_1102'];
    $can_1103 = $_POST['can_1103'];
    $can_1104 = $_POST['can_1104'];
    $can_1105 = $_POST['can_1105'];
    $can_1201 = $_POST['can_1201'];
    $can_1202 = $_POST['can_1202'];
	$can_1203 = $_POST['can_1203'];
	$can_1204 = $_POST['can_1204'];
	$can_1205 = $_POST['can_1205'];
	$can_1206 = $_POST['can_1206'];
	 ?>
	<?php
     if ($can_1101 > 0){
	     $_SESSION['can_1101'] = $can_1101;
		 }else{
		 $_SESSION['can_1101'] = 0;
		 $_SESSION['mon_1101'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD = 1"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	         $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		     $_SESSION['mon_1101'] = $can_1101 * $cod_por;
		     $tot_bs = $tot_bs + $_SESSION['mon_1101'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1101'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1101'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }
	//   }
     if ($can_1102 > 0){
	     $_SESSION['can_1102'] = $can_1102;
		 }else{
		 $_SESSION['can_1102'] = 0;
		 $_SESSION['mon_1102'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD = 2"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1102'] = $_SESSION['can_1102'] * $cod_por;  
		   $tot_bs = $tot_bs + $_SESSION['mon_1102'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1102'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1102'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }
	 //  }
	  if ($can_1103 > 0){
	     $_SESSION['can_1103'] = $can_1103;
		 }else{
		 $_SESSION['can_1103'] = 0;
		 $_SESSION['mon_1103'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD = 3"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1103'] = $_SESSION['can_1103'] * $cod_por;  
		   $tot_bs = $tot_bs + $_SESSION['mon_1103'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1103'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1103'], 2, '.',',');?></td>
     </tr> 
	<?php
	     } 
	 if ($can_1104 > 0){
	     $_SESSION['can_1104'] = $can_1104;
		 }else{
		 $_SESSION['can_1104'] = 0;
		 $_SESSION['mon_1104'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD = 4"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1104'] = $_SESSION['can_1104'] * $cod_por; 
		    $tot_bs = $tot_bs + $_SESSION['mon_1104'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1104'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1104'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }   
	  if ($can_1105 > 0){
	     $_SESSION['can_1105'] = $can_1105;
		 }else{
		 $_SESSION['can_1105'] = 0;
		 $_SESSION['mon_1105'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 110 and 
	                GRAL_PAR_PRO_COD = 5"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1105'] = $_SESSION['can_1105'] * $cod_por;
		   $tot_bs = $tot_bs + $_SESSION['mon_1105'];  
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1105'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1105'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }   
	   
	 	  if ($can_1201 > 0){
	     $_SESSION['can_1201'] = $can_1201;
		 }else{
		 $_SESSION['can_1201'] = 0;
		 $_SESSION['mon_1201'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 120 and 
	                GRAL_PAR_PRO_COD = 1"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1201'] = $_SESSION['can_1201'] * $cod_por; 
		    $tot_bs = $tot_bs + $_SESSION['mon_1201'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1201'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1201'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }   
  
	   if ($can_1202 > 0){
	     $_SESSION['can_1202'] = $can_1202;
		 }else{
		 $_SESSION['can_1202'] = 0;
		 $_SESSION['mon_1202'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 120 and 
	                GRAL_PAR_PRO_COD = 2"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1202'] = $_SESSION['can_1202'] * $cod_por; 
		    $tot_bs = $tot_bs + $_SESSION['mon_1202'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1202'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1202'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }     
	  if ($can_1203 > 0){
	     $_SESSION['can_1203'] = $can_1203;
		 }else{
		 $_SESSION['can_1203'] = 0;
		 $_SESSION['mon_1203'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 120 and 
	                GRAL_PAR_PRO_COD = 3"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1203'] = $_SESSION['can_1203'] * $cod_por; 
		   $tot_bs = $tot_bs + $_SESSION['mon_1203']; 
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1203'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1203'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }      
	    if ($can_1204 > 0){
	     $_SESSION['can_1204'] = $can_1204;
		 }else{
		 $_SESSION['can_1204'] = 0;
		 $_SESSION['mon_1204'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 120 and 
	                GRAL_PAR_PRO_COD = 4"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1204'] = $_SESSION['can_1204'] * $cod_por;
		   $tot_bs = $tot_bs + $_SESSION['mon_1204'];  
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1204'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1204'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }       
	  if ($can_1205 > 0){
	     $_SESSION['can_1205'] = $can_1205;
		 }else{
		 $_SESSION['can_1205'] = 0;
		 $_SESSION['mon_1205'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 120 and 
	                GRAL_PAR_PRO_COD = 5"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1205'] = $_SESSION['can_1205'] * $cod_por; 
		    $tot_bs = $tot_bs + $_SESSION['mon_1205'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1205'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1205'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }        
	  if ($can_1206> 0){
	     $_SESSION['can_1206'] = $can_1206;
		 }else{
		 $_SESSION['can_1206'] = 0;
		 $_SESSION['mon_1206'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 120 and 
	                GRAL_PAR_PRO_COD = 6"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1206'] = $_SESSION['can_1206'] * $cod_por;
		   $tot_bs = $tot_bs + $_SESSION['mon_1206'];  
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1206'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1206'], 2, '.',',');?></td>
     </tr> 
	<?php
	     } 
	  ?>
	  <tr>
        <th align="center"><?php echo "Total"; ?></td>
		<td align="right"><?php echo encadenar(3); ?> </td>
		<td align="right"><?php echo encadenar(3);?></td>
		<td align="right"><?php echo number_format($tot_bs, 2, '.',',');?></td>
     </tr> 
	<?php	 
		 
		 
		        
	 }  
//Dolares	
if ($_SESSION['caja_bs_sus'] == 2){	
	$can_1301 = $_POST['can_1301'];
    $can_1302 = $_POST['can_1302'];
	$can_1303 = $_POST['can_1303'];
	$can_1304 = $_POST['can_1304'];
	$can_1305 = $_POST['can_1305'];
	$can_1306 = $_POST['can_1306'];
	$can_1307 = $_POST['can_1307'];
	if ($can_1301 > 0){
	     $_SESSION['can_1301'] = $can_1301;
		 }else{
		 $_SESSION['can_1301'] = 0;
		 $_SESSION['mon_1301'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = 1"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1301'] = $_SESSION['can_1301'] * $cod_por; 
		    $tot_sus = $tot_sus + $_SESSION['mon_1301'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1301'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1301'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }   
  
	   if ($can_1302 > 0){
	     $_SESSION['can_1302'] = $can_1302;
		 }else{
		 $_SESSION['can_1302'] = 0;
		 $_SESSION['mon_1302'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = 2"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1302'] = $_SESSION['can_1302'] * $cod_por; 
		    $tot_sus = $tot_sus + $_SESSION['mon_1302'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1302'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1302'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }     
	  if ($can_1303 > 0){
	     $_SESSION['can_1303'] = $can_1303;
		 }else{
		 $_SESSION['can_1303'] = 0;
		 $_SESSION['mon_1303'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = 3"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1303'] = $_SESSION['can_1303'] * $cod_por; 
		   $tot_sus = $tot_sus + $_SESSION['mon_1303']; 
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1303'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1303'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }      
	    if ($can_1304 > 0){
	     $_SESSION['can_1304'] = $can_1304;
		 }else{
		 $_SESSION['can_1304'] = 0;
		 $_SESSION['mon_1304'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = 4"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1304'] = $_SESSION['can_1304'] * $cod_por;
		   $tot_sus = $tot_sus + $_SESSION['mon_1304'];  
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1304'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1304'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }       
	  if ($can_1305 > 0){
	     $_SESSION['can_1305'] = $can_1305;
		 }else{
		 $_SESSION['can_1305'] = 0;
		 $_SESSION['mon_1305'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = 5"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1305'] = $_SESSION['can_1305'] * $cod_por; 
		    $tot_sus = $tot_sus + $_SESSION['mon_1305'];
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1305'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1305'], 2, '.',',');?></td>
     </tr> 
	<?php
	     }        
	  if ($can_1306> 0){
	     $_SESSION['can_1306'] = $can_1306;
		 }else{
		 $_SESSION['can_1306'] = 0;
		 $_SESSION['mon_1306'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = 6"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1306'] = $_SESSION['can_1306'] * $cod_por;
		   $tot_sus = $tot_sus + $_SESSION['mon_1306'];  
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1306'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1306'], 2, '.',',');?></td>
     </tr> 
	<?php
	     } 
	 if ($can_1307> 0){
	     $_SESSION['can_1307'] = $can_1307;
		 }else{
		 $_SESSION['can_1307'] = 0;
		 $_SESSION['mon_1307'] = 0;
	}
	   $con_cor  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 130 and 
	                GRAL_PAR_PRO_COD = 7"; 
	   $res_cor = mysql_query($con_cor);
	   while ($lin_cor = mysql_fetch_array($res_cor)) {
	        $cod_por = $lin_cor['GRAL_PAR_PRO_CTA1'];
		   $_SESSION['mon_1307'] = $_SESSION['can_1307'] * $cod_por;
		   $tot_sus = $tot_sus + $_SESSION['mon_1307'];  
	       ?>
	  <tr>
        <td align="left"><?php echo $lin_cor['GRAL_PAR_PRO_DESC']; ?></td>
		<td align="right"><?php echo $lin_cor['GRAL_PAR_PRO_SIGLA']; ?> </td>
		<td align="right"><?php echo number_format($_SESSION['can_1307'], 2, '.',',');?></td>
		<td align="right"><?php echo number_format($_SESSION['mon_1307'], 2, '.',',');?></td>
     </tr> 
	<?php
	     } 	 
	  ?>
	  <tr>
        <th align="center"><?php echo "Total"; ?></td>
		<td align="right"><?php echo encadenar(3); ?> </td>
		<td align="right"><?php echo encadenar(3);?></td>
		<td align="right"><?php echo number_format($tot_sus, 2, '.',',');?></td>
     </tr> 
	<?php	
	   }
    }
	if ($_SESSION['continuar'] == 2){  ?> 
 <center>
	 <input type="submit" name="accion" value="Imprimir">
     <input type="submit" name="accion" value="Salir">

</form>	
<?php }
?>
 <?php  
/*if ($_SESSION['continuar'] == 3){
    if ($_SESSION['detalle'] == 3){
       $consulta  = "Select * From temp_ctable";
       $resultado = mysql_query($consulta);
       $tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
       $con_temp = "Select * From temp_ctable";
       $res_temp = mysql_query($con_temp);
	   while ($lin_temp = mysql_fetch_array($res_temp)) {
             $tot_debe_1 = $tot_debe_1 +$lin_temp['temp_debe_1'];
	         $tot_haber_1 = $tot_haber_1 +$lin_temp['temp_haber_1'];
	    }
			
	if ($tot_debe_1 <> $tot_haber_1) {	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Modificar</th>
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        //$tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        //$tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			<td><INPUT NAME="nlin" TYPE=RADIO VALUE="<?php echo $nro_lin; ?>">	</td> 
	     </tr>
	
    <?php }
	
	   echo "No iguala Debe y Haber Revise y Modifique ......... ";  ?>
	    <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
	   </table>
	<center>
	 <input type="submit" name="accion" value="Modificar">
     <input type="submit" name="accion" value="Salir">
	   
	<?php    
	   
    }else{
  
  	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	    </tr>
	
    <?php }
	
	   echo "Revise Bien antes de Imprimir ......... ";
    
  
  ?>
   <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
  
  	</table>
	<center>
	 <input type="submit" name="accion" value="Imprimir">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php
 }
  }
	} 

if ($_SESSION['continuar'] == 4){ //1 a
   if(isset($_POST['nlin'])){ //2a
     $nlin = $_POST['nlin'];
	 $_SESSION['nlin'] = $nlin;?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
  <?php
	 $consulta  = "Select * From temp_ctable where temp_tip_tra = $nlin";
     $resultado = mysql_query($consulta);
	 while ($linea = mysql_fetch_array($resultado)) { //3a
	       $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
           $res_ctas = mysql_query($con_ctas)or die('No pudo seleccionarse contab_cuenta')  ; ?>
	 	 
	 <table align="center">
     <tr>
	    <th align="left">Glosa :</th>
		<?php if (isset ($_SESSION['descrip'])){?>
		<td align="left"><?php echo $_SESSION['descrip']; ?> </td>`
		<?php } //3b ?>
	 </tr>
	 <tr> 
      <th align="left">Cuenta Contable :</th>
	  <td><?php echo $linea['temp_nro_cta'].encadenar(2).$linea['temp_des_cta']; ?></td>
	 </tr>
     <tr> 
      <th align="left">Cuenta Contable :</th>
	  <td> <select name="cod_cta" size="1"  >
	       <?php while ($lin_cta = mysql_fetch_array($res_ctas)) { //4a ?>
           <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php echo $lin_cta['CONTA_CTA_DESC']; ?></option>
           <?php } //4b?>
		    </select></td>
    </tr>
	<tr> 
         <th align="left" >Monto :</th>
		 <td align="left"><?php echo number_format($linea['temp_debe_1']+
		                                            $linea['temp_haber_1'], 2, '.',',') ; ?></td>
    </tr>	  
    <tr> 
         <th align="left" >Monto :</th>
		 <td><input  type="text" name="egr_monto"> </td>
    </tr>
    <tr>
	<th align="left">Aplicacion :</th>
	     <?php if ($linea['temp_debe_1'] > 0) {  //5a?>
		 <td><?php echo "Debe"; ?></td>
		 <?php } //5b?>
		 <?php if ($linea['temp_haber_1'] > 0) { //6a ?>
		 <td><?php echo "Haber"; ?></td>
		 <?php } //6b?>
	</tr>	
	<th align="left">Aplicacion :</th>
		 <td><select name="deb_hab" >
	         <option>Debe</option>
	         <option>Haber</option>
	         </select></td>
	</tr>	
	
  </table>
  <center>
   <input type="submit" name="accion" value="Grab_modi">
     <input type="submit" name="accion" value="Salir">

</form>	
  
  
  
	 
	 <?php } //2b
	 
	 
	 
	 
	 
	  //}else{
	 //$_SESSION['continuar'] = 1;
	 //$_SESSION['calculo'] == 1; 
	// header('Location:cobro_pag_det_gd.php');
	 }  //1b
    // if(isset($_SESSION['grupo'])){
    //   $nom_grp =$_SESSION['grupo'];
	//   }
  }	// 1 b 
if ($_SESSION['continuar'] == 5){ //1a
     $nlin = $_SESSION['nlin'];
     if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }	//4b
      if ($_POST['deb_hab'] <> ""){ //5a  
	     $deb_hab = $_POST['deb_hab'];
	  	 $_SESSION['deb_hab'] = $deb_hab;
	  } //5b
      if ($_POST['egr_monto'] > 0){ //6a  
	     $monto_t = ($_POST['egr_monto']);
	     $_SESSION['monto_t'] =  $monto_t;
      } //6b
      if ($deb_hab == "Debe"){ //7a     
         $m_debe_1 = $monto_t;
	     $m_haber_1 = 0;
	     }else{
	     $m_debe_1 = 0;
	     $m_haber_1 = $monto_t;
	     } //7b
      if ($mon_cta == 2){ //8a
	     if ($deb_hab == "Debe"){ //9a     
            $m_debe_2 = $monto_t / $tc_ctb;
	        $m_haber_2 = 0;
	        }else{
	        $m_debe_2 = 0;
	        $m_haber_2 = $monto_t / $tc_ctb;
	        } //8b
          } //9b
	
      $des_cta = leer_cta_des($cod_cta);
	//  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	 // $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "update temp_ctable set temp_nro_cta =$cod_cta, 
                                          temp_des_cta ='$des_cta',
						 	              temp_debe_1 = $m_debe_1,
									      temp_haber_1 = $m_haber_1,
										  temp_debe_2 = $m_debe_2,
									      temp_haber_2 = $m_haber_2 
										  where temp_tip_tra = $nlin";
										   
    $resultado = mysql_query($consulta)or die('No pudo actualizar temp_ctable 1 : ' . mysql_error());
	
	$consulta  = "Select * From temp_ctable";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	?>
	<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
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
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	     </tr>
	
     <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>
     <center>
	    
	 <input type="submit" name="accion" value="Grabar">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   
		   require 'con_asiento.php';
 } //1b?>
*/	
	
?>	 

 
		
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>