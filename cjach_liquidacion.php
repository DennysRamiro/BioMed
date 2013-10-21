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
<title>Liquidacion Caja Chica</title>
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
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Esta seguro de hacer LA LIQUIDACION?</font></p>
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
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> LIQUID. CAJA CHICA
                    
                 </li>
                
              </ul>  



 <div id="contenido_modulo">

                      <h2> <img src="img/open document_64x64.png" border="0" alt="Modulo" align="absmiddle"> LIQUIDACION CAJA CHICA </h2>
                      <hr style="border:1px dashed #767676;">
                  
<?php
					// $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
<form name="form2" method="post" action="con_retro_1_cjach.php" onSubmit="return ValidaCamposEgresos(this)">
  
<?php
 $_SESSION['continuar'] = 0;
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
	   header('location: cjach_selec_1.php');
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
$lin_res['CJCH_CTRL_SALDO']= 0;
   $con_rec = "Select * From cjach_cntrl where CJCH_CTRL_NRO = $cod_sol and CJCH_CTRL_ESTADO = 1
               and CJCH_CTRL_USR_BAJA is null ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	   $fec_ent = cambiaf_a_normal($lin_res['CJCH_CTRL_FEC_H']);
	   $_SESSION['ctble_cja'] = $lin_res['CJCH_CTRL_CTA'];
	   $_SESSION['cod_cja'] = $cod_sol;
	   $_SESSION['mon_asig'] = $lin_res['CJCH_CTRL_ASIG'];
	   $nro_cjch = $lin_res['CJCH_CTRL_NRO'];
	   $nro_asig = $lin_res['CJCH_CTRL_NRO_ASIG'];
	   $cta_ctble = $lin_res['CJCH_CTRL_CTA'];
       $sal = $lin_res['CJCH_CTRL_SALDO'];
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
				 order by CJCH_TRAN_FECHA, CJCH_TRAN_NRO_COR ";
				 
    $res_tpa = mysql_query($con_tpa);
	
	while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		    $fec_pag = $lin_tpa['CJCH_TRAN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CJCH_TRAN_NRO_COR'];
			
		   // echo $fec_pag."*B*".$cta_ctble."*N*".$nro_cjch."*T*".$nro_tran;	
	      	$con_tra = "Select * From cjach_transac where CJCH_TRAN_NRO_CJA = $nro_cjch and 
	            CJCH_TRAN_FECHA >= '$fec_pag' and CJCH_TRAN_NRO_COR = $nro_tran and
				CJCH_TRAN_CTA_CONT = '$cta_ctble'
				and CJCH_TRAN_USR_BAJA is null";
				
            $res_tra = mysql_query($con_tra)or die('No pudo seleccionarse tabla cart_det_tran');
			
			while ($lin_tra = mysql_fetch_array($res_tra)) {
			      $fec_tra  = $lin_tra['CJCH_TRAN_FECHA'];
				  $fec_tra = cambiaf_a_normal($fec_tra);
				  $p_imp = $lin_tra['CJCH_TRAN_IMPORTE'];
				  $cta  = leer_cta_des($lin_tra['CJCH_TRAN_CTA_CONT']);
				 
				  $tipo = $lin_tra['CJCH_TRAN_TIPO_OPE'];
				  if ($tipo == 1){
				      $saldo = $lin_tra['CJCH_TRAN_IMPORTE'];
				  }
				  if ($tipo == 2){
				       $saldo = $saldo + $lin_tra['CJCH_TRAN_IMPORTE'];
				  }
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
	 	      <th align="left"><?php echo "SALDO "; ?></th>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <td align="right"><?php echo encadenar(2); ?></td>
			  <td align="right"><?php echo encadenar(2); ?></td>
		      <th align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
	     </tr>
      </table>
   
	 <center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Imprimir Liquidacion"  onClick="return">
     
</form>	

 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">


<?php } ?>


<?php
/*

 
 
 */
 
 ?>
	
	
	 

  <?php
  }
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>