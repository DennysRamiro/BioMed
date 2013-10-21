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
	    <a href='cjach_reportes.php?menu=1'>Salir</a>
  </div>


<br>
<center>
  <!--input class="btn_form" type="submit" name="accion" value="Salir_Opc"-->
     
</form>	
<?php
//if ($_SESSION['continuar'] == 0){
if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
  }
 if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
  } 
 if(isset($_POST['cod_cta'])){
      $cod_cta = $_POST['cod_cta'];
      $_SESSION['cod_cta'] = $cod_cta;
	 
  } 
 $con_rec = "Select * From cjach_cntrl where CJCH_CTRL_NRO = $cod_cta and CJCH_CTRL_USR_BAJA is null ";
            $res_rec = mysql_query($con_rec);
	        while ($lin_res = mysql_fetch_array($res_rec)) {
	               $fec_ent = cambiaf_a_normal($lin_res['CJCH_CTRL_FEC_H']);
	               $_SESSION['ctble_cja'] = $lin_res['CJCH_CTRL_CTA'];
	               $_SESSION['cod_cja'] = $cod_cta;
	               $_SESSION['mon_asig'] = $lin_res['CJCH_CTRL_ASIG'];
				   $_SESSION['nom_func'] =$lin_res['CJCH_CTRL_FUNC'];
				   $_SESSION['nom_caja'] =$lin_res['CJCH_CTRL_NOMB'];
	               $nro_cjch = $lin_res['CJCH_CTRL_NRO'];
	               $nro_asig = $lin_res['CJCH_CTRL_NRO_ASIG'];
	               $cta_ctble = $lin_res['CJCH_CTRL_CTA'];
			}	    
  
  
  
 ?>

 <h2> DETALLE MOVIMIENTO CAJA CHICA
 <br>
  <?php echo encadenar(5)."Desde".encadenar(2).$f_des.encadenar(2)."Hasta".encadenar(2).$f_has;?>
   </h2>
   
   </center>
   <strong>
  <?php echo encadenar(20)."Caja Chica".encadenar(2).utf8_encode($_SESSION['nom_caja']).encadenar(2)."Responsable".encadenar(2).utf8_encode($_SESSION['nom_func']);?>
   <br>
  </strong>
  <table width="90%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th width="10%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="5%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />Nro.TRAN.</th>
	  <th width="30%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />CONCEPTO</th>
	  <th width="15%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FACTURA Nro.</th> 
	  <th width="15%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE Bs.</th>
	  
	</tr>
<?php
    $_SESSION['diferencia'] = 0;
    $_SESSION['detalle'] = 1;
    $_SESSION['cuantos'] = 0;
	$saldo = 0;
  //  $borr_cob  = "Delete From temp_ctable"; 
  //  $cob_borr = mysql_query($borr_cob);
 //   }
if ($_SESSION['detalle'] == 1){
    // cobros y desembolsos
	
    $con_tpa = "Select DISTINCT CJCH_TRAN_NRO_CJA, CJCH_TRAN_FECHA, CJCH_TRAN_NRO_COR,CJCH_TRAN_NRO_CJA
	            From cjach_transac where (CJCH_TRAN_FECHA between '$f_des2' and '$f_has2') 
	            and (CJCH_TRAN_TIPO_OPE = 2 or CJCH_TRAN_TIPO_OPE = 2) and CJCH_TRAN_NRO_CJA=$cod_cta
				and CJCH_TRAN_USR_BAJA is null 
				 order by CJCH_TRAN_FECHA, CJCH_TRAN_NRO_COR ";
				 
    $res_tpa = mysql_query($con_tpa);
	
	while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		    $fec_pag = $lin_tpa['CJCH_TRAN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CJCH_TRAN_NRO_COR'];
			$nro_cjch = $lin_tpa['CJCH_TRAN_NRO_CJA'];
			
			
		   // echo $fec_pag."*B*".$cta_ctble."*N*".$nro_cjch."*T*".$nro_tran;	
	      	$con_tra = "Select * From cjach_transac where  
	            CJCH_TRAN_FECHA = '$fec_pag' and CJCH_TRAN_NRO_COR = $nro_tran and
				CJCH_TRAN_CTA_CONT = '$cta_ctble' and CJCH_TRAN_TIPO_OPE = 2
				and CJCH_TRAN_USR_BAJA is null";
				
            $res_tra = mysql_query($con_tra)or die('No pudo seleccionarse tabla cart_det_tran');
			
			while ($lin_tra = mysql_fetch_array($res_tra)) {
			      $fec_tra  = $lin_tra['CJCH_TRAN_FECHA'];
				  $fec_tra = cambiaf_a_normal($fec_tra);
				  $p_imp = $lin_tra['CJCH_TRAN_IMPORTE'];
				  $cta  = leer_cta_des($lin_tra['CJCH_TRAN_CTA_CONT']);
				  $tipo = $lin_tra['CJCH_TRAN_TIPO_OPE'];
				  if ($lin_tra['CJCH_TRAN_IMPORTE'] < 1){
				      $lin_tra['CJCH_TRAN_IMPORTE'] = $lin_tra['CJCH_TRAN_IMPORTE'] * -1;
				  }
				  //if ($tipo == 2){
				       $saldo = $saldo + $lin_tra['CJCH_TRAN_IMPORTE'];
				  //}
	           ?>
			  <tr>
			  
		      <td align="center"><?php echo $fec_tra; ?></td>
	 	      <td align="center"><?php echo $lin_tra['CJCH_TRAN_NRO_COR']; ?></td>
		      <td align="left" style="font-size:11px"><?php echo utf8_encode($lin_tra['CJCH_TRAN_DESCRIP']); ?></td>
			  <td align="center"><?php echo $lin_tra['CJCH_TRAN_REL_FAC']; ?></td>
		      <td align="right"><?php echo number_format($lin_tra['CJCH_TRAN_IMPORTE'], 2, '.',','); ?></td>
		      
	     </tr>
  <?php }?>
		
         

	<?php }   ?>
		 <tr>
		      <td align="left"><?php echo encadenar(2); ?></th>
			  <td align="right"><?php echo encadenar(2); ?></td>
	 	      <th align="left"><?php echo "TOTAL "; ?></th>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <th align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
	     </tr>
      </table>
   
	 <center>
	    <br>
	




<?php //} ?>


<?php
/*

 
 
 */
 
 ?>
	
	
	 

  <?php
  //}
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>