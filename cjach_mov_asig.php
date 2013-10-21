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
 
  
  
  
 ?>

 <h2> DETALLE ASIGNACIONES CAJA CHICA
 <br>
  <?php echo encadenar(5)."Desde".encadenar(2).$f_des.encadenar(2)."Hasta".encadenar(2).$f_has;?>
   </h2>
   
   </center>
   <strong>
  <?php // echo encadenar(20)."Caja Chica".encadenar(2).utf8_encode($_SESSION['nom_caja']).encadenar(2)."Responsable".encadenar(2).utf8_encode($_SESSION['nom_func']);?>
   <br>
  </strong>
  <table width="90%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th width="10%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FECHA TRAN.</th>
	  <th width="5%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />Nro.TRAN.</th>
	  <th width="30%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />CAJA CHICA</th>
	  <th width="15%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FECHA SOLIC.</th> 
	  <th width="15%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />FECHA ASIG.</th> 
	  <th width="15%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />IMP. SOLICITADO</th>
	  <th width="15%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />IMP. ASIGNADO</th>
	  <th width="15%" style="font-size:11px" scope="col"><border="0" alt="" align="absmiddle" />ESTADO</th>
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
	
    $con_tpa = "Select *
	            From cjach_asignacion where (CJCH_ASIN_FECHA between '$f_des2' and '$f_has2') 
	            and CJCH_ASIN_USR_BAJA is null 
				 order by CJCH_ASIN_FECHA, CJCH_ASIN_NRO ";
				 
    $res_tpa = mysql_query($con_tpa);
	
	while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		    $fec_pag = $lin_tpa['CJCH_ASIN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CJCH_ASIN_NRO'];
			$nro_cjch = $lin_tpa['CJCH_ASIN_CAJA'];
			$fec_sol = $lin_tpa['CJCH_ASIN_FEC_S'];
			$f_sol = cambiaf_a_normal($fec_sol);
			$fec_asg = $lin_tpa['CJCH_ASIN_FEC_A']; 
			$f_asg = cambiaf_a_normal($fec_asg);
	//Datos generales Caja chica		
			 $con_rec = "Select * From cjach_cntrl where CJCH_CTRL_NRO = $nro_cjch and CJCH_CTRL_USR_BAJA is null ";
            $res_rec = mysql_query($con_rec);
	        while ($lin_res = mysql_fetch_array($res_rec)) {
	               $fec_ent = cambiaf_a_normal($lin_res['CJCH_CTRL_FEC_H']);
	               $_SESSION['ctble_cja'] = $lin_res['CJCH_CTRL_CTA'];
	               $_SESSION['cod_cja'] = $nro_cjch;
	               $_SESSION['mon_asig'] = $lin_res['CJCH_CTRL_ASIG'];
				   $_SESSION['nom_func'] =$lin_res['CJCH_CTRL_FUNC'];
				   $_SESSION['nom_caja'] =$lin_res['CJCH_CTRL_NOMB'];
	               $nro_cjch = $lin_res['CJCH_CTRL_NRO'];
	               $nro_asig = $lin_res['CJCH_CTRL_NRO_ASIG'];
	               $cta_ctble = $lin_res['CJCH_CTRL_CTA'];
			}	   
			
		  
				  if ($lin_tpa['CJCH_ASIN_ESTADO'] == 2){
				       $estad = "Asig.";
					   
				  }
				  if ($lin_tpa['CJCH_ASIN_ESTADO'] == 1){
				       $estad = "Solic.";
					   
				  }
	           ?>
			  <tr>
			  
		      <td align="center"><?php echo $f_pag; ?></td>
	 	      <td align="center"><?php echo $lin_tpa['CJCH_ASIN_NRO']; ?></td>
		      <td align="left" style="font-size:11px"><?php echo utf8_encode($_SESSION['nom_caja']); ?></td>
			 <td align="center"><?php echo $f_sol; ?></td>
			 <td align="center"><?php echo $f_asg; ?></td>
			 <td align="right"><?php echo number_format($lin_tpa['CJCH_ASIN_SOLIC'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($lin_tpa['CJCH_ASIN_ASIG'], 2, '.',','); ?></td>
		      <td align="center"><?php echo $estad; ?></td>
	     </tr>
  <?php }?>
		
         

	<?php //}   ?>
		 
      </table>
   
	
	    <br>
	




<?php //} ?>


<?php
/*

 
 
 */
 
 ?>
	</center>
<font size="-2"	 >

  <?php
  //}
			include("footer_in.php");
		 ?>
</font>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>