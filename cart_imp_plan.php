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
 $_SESSION['cont_imp'] = 1; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='solic_imprime_p.php'>Retornar</a>
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
<?php
$ncre = " ";
if(isset($_POST['ncre'])){
      $ncre = $_POST['ncre'];
	  $ncre1 = $ncre;
      $_SESSION['ncre'] = $ncre;
      
   }
   echo $ncre;
 if ($ncre  == 'GLOBAL'){   
  echo "Va a otro programa"; 
   header('Location:solic_impr_2.php');  
  } 
   
?> 
<font size="+2"  style="" >
<?php
echo encadenar(50)."PLAN DE PAGOS";
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(140)."SOLICITUD  Nro. ".encadenar(3).$_SESSION["cod_sol"];
$cod_sol = $_SESSION["cod_sol"];
?>
</font>
<br>
<?php  
if ($ncre  == 'TODO'){ 
     $con_deu = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol
		         and  CRED_DEU_RELACION = 'C' and CRED_DEU_USR_BAJA is null";
     $res_deu = mysql_query($con_deu);
	 while ($lin_deu = mysql_fetch_array($res_deu)) {
	        $ncre = $lin_deu['CRED_DEU_ID'];
    	  }
 }
$con_sol  = "Select * From cred_solicitud,cred_deudor where cred_solicitud.CRED_SOL_CODIGO = $cod_sol
                 and cred_deudor.CRED_SOL_CODIGO = cred_solicitud.CRED_SOL_CODIGO
				 and CRED_DEU_ID = '$ncre'
			     and  CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);

$nro = 0;
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $cod_sol = $lin_sol['CRED_SOL_CODIGO']; 
		 $asesor = $lin_sol['CRED_SOL_OF_RESP']; 
		 $mon = $lin_sol['CRED_SOL_COD_MON']; 
		 $t_oper = $lin_sol['CRED_SOL_TIPO_OPER'];
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $f_pag = $lin_sol['CRED_SOL_FORM_PAG'];
		 $f_des = $lin_sol['CRED_SOL_FEC_DES'];
		 $c_grup = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $pag_int = $lin_sol['CRED_SOL_AHO_F'];
	if ($ncre1  == 'TODO'){ 	
	      $impo = $lin_sol['CRED_SOL_IMPORTE']; 
		 $impo_c = $lin_sol['CRED_SOL_IMP_COM']; 
		 }else{
		 $impo = $lin_sol['CRED_DEU_IMPORTE']; 
		 $impo_c = $lin_sol['CRED_DEU_COMISION']; 
	}	 
		 
		 
		 
		 $nom_grp = "";
		 $nom_ases = "";
		 $nom_ases = leer_nombre_usr(1,$asesor);
		 $f_des2= cambiaf_a_normal($f_des); 
	
		  $con_cli = "Select * From cliente_general where CLIENTE_COD_ID = '$ncre' and CLIENTE_USR_BAJA is null";
         $res_cli = mysql_query($con_cli) ;
	      while ($lin_cli = mysql_fetch_array($res_cli)) {
	            $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
				$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
				$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
				$lin_cli['CLIENTE_NOMBRES'].encadenar(1);
		        $ci = $lin_cli['CLIENTE_COD_ID'];
				$cod_cli =$lin_cli['CLIENTE_COD']; 
			}
	}	 
		 
		 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
         $res_mon = mysql_query($con_mon);
	      while ($linea = mysql_fetch_array($res_mon)) {
	            $d_mon = $linea['GRAL_PAR_INT_DESC'];
			   }
		 $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
       $res_fpa = mysql_query($con_fpa);
	   while ($linea = mysql_fetch_array($res_fpa)) {
	        $d_fpa = $linea['GRAL_PAR_INT_DESC'];
	   }	   
 				
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_oper";
        $res_dope = mysql_query($con_dope);
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
 if ($c_grup > 0){
	 	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
       }
	  }  
			
		//  $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
		//			$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
		//			$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
		//			$lin_car['CLIENTE_NOMBRES'].encadenar(1);
		// $ci = $lin_car['CLIENTE_COD_ID'];		
			
?>
<table border="0" width="950">
   <tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php  echo encadenar(20); ?></th>           
	    <th align="center"><?php echo encadenar(35); ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
		
   </tr>	
   <tr>
	    <td align="left" <b><?php echo "Cliente:" ; ?> </b></td>
		<td align="left" ><?php echo $nom_cli; ?></td>
		<td align="left" ><?php echo "C.I.".encadenar(2).$ci; ?></td>	
		<td align="right" <b><?php echo encadenar(2); ?></td>						
	   	<td align="left" <b><?php echo "Moneda:".encadenar(2); ?></td>
		<td align="left" ><?php echo $d_mon; ?></td>
	</tr>
	
	  <?php if($nom_grp <> ""){ ?>
	 <tr>
	   <td align="left" <b><?php echo "Grupo:"; ?></b></td>
	    <td align="left" ><?php echo $nom_grp; ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>	
		<td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" ><?php echo encadenar(10); ?></td>	
		<td align="left" ><?php echo encadenar(15); ?></td>
	</tr>
	<?php } ?>  
	<tr>
	    <td align="left" <b><?php echo "Tipo Operacion:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $d_ope; ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
		<td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo "Asesor:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $nom_ases; ?></td>
	</tr>
	<tr>
	    <td align="left" <b><?php echo "Monto Desembolsado:".encadenar(2); ?></b></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
		<td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo "Gas.Adm.".encadenar(2); ?></b></td>
		<td align="left" ><?php echo number_format($impo_c, 2, '.',','); ?></td>
	</tr>
	<tr>
	    <td align="left" <b><?php echo "Frecuencia Pago:".encadenar(2); ?></b></td>
		<td align="center" ><?php echo $d_fpa; ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
		<td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo "Nro. Cuotas".encadenar(2); ?></b></td>
		<td align="left" ><?php echo number_format($cuotas, 0, '.',','); ?></td>
	</tr>
	  <tr>
	 <?php if($pag_int == 1){ ?>
	    <td align="left" <b><?php echo "I - V" ; ?></td>
	 <?php } ?> 
	  <?php if($pag_int == 4){ ?>
	    <td align="left" <b><?php echo "I - A" ; ?></td>
	 <?php } ?> 	
	</tr>
	</table>
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">No. TRAN.</th> 
	    <th align="center">FECHA PAGO</th>  
	   	<th align="center">CAPITAL</th> 
		<th align="center">INTERES</th>
		 <th align="center">I.T.F</th>
		<th align="center">F.GAR</th>
		<th align="center">CUOTA</th>
		<th align="center">SALDO  </th>
  </tr>		
		  
		 <?php
 
		 $nom_grp = "";
		 $t_cap = "";
		 $t_int = 0;
		 $itf = 0;
		 $t_itf = 0;
		 $t_aho = 0; 
		 $saldo = $impo;
		 $nro_tran = 0;
				
	  //Datos del cart_det_tran		
if ($ncre1  <> 'TODO'){   				
	$con_tpa = "Select * From cred_plandp where CRED_PLD_COD_CLI = $cod_cli and 
	            CRED_PLD_COD_SOL = $cod_sol  and CRED_PLD_USR_BAJA is null 
				 order by CRED_PLD_NRO_CTA";
    $res_tpa = mysql_query($con_tpa);
	  while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		    if ($_SESSION['EMPRESA_TIPO'] == 2){
			   if ($mon == 2){
			       $itf = 0;
				   }else{
				   $itf = 0;
				 }
			}	   
		    $fec_pag = $lin_tpa['CRED_PLD_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
					
			$t_cap = $t_cap + $lin_tpa['CRED_PLD_CAPITAL'];
			$t_int = $t_int + $lin_tpa['CRED_PLD_INTERES'];
		    $t_itf = $t_itf + $itf;
		    $t_aho = $t_aho + $lin_tpa['CRED_PLD_AHORRO']; 
		    $saldo = $saldo - $lin_tpa['CRED_PLD_CAPITAL'];
		   
			
	/*			*/		
			?>
	 <?php if($pag_int == 1){ ?>
	<tr>
	    
	    <td align="center" ><?php echo $lin_tpa['CRED_PLD_NRO_CTA']; ?></td>
		<td align="center" ><?php echo $f_pag; ?></td>
		<td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_CAPITAL'], 2, '.',''); ?></td>							
	    <td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_INTERES'], 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($itf, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_AHORRO'], 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_CAPITAL']+
		                                            $lin_tpa['CRED_PLD_INTERES']+$itf+
													$lin_tpa['CRED_PLD_AHORRO'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
		
	</tr>
	<?php
	}
      ?>	
	   <?php if($pag_int == 4){ ?>
	<tr>
	    
	    <td align="center" ><?php echo $lin_tpa['CRED_PLD_NRO_CTA']; ?></td>
		<td align="center" ><?php echo $f_pag; ?></td>
		<td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_CAPITAL'], 2, '.',''); ?></td>							
	    <td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_INTERES'], 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($itf, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_AHORRO'], 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($lin_tpa['CRED_PLD_CAPITAL']+
		                                            $itf+
													$lin_tpa['CRED_PLD_AHORRO'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
		
	</tr>
	<?php
	}
      ?>	
	<?php
	}
	
	  ?>
	  <?php if($pag_int == 1){ ?>
	 <tr>
	    
	    <th align="center" ><?php echo "TOTAL"; ?></td>
		<th align="center" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($t_cap, 2, '.',''); ?></td>							
	    <th align="right" ><?php echo number_format($t_int, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($t_itf, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_aho, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_cap+
		                                            $t_int+
													$t_itf+
													$t_aho, 2, '.',','); ?></td>
		
		
	</tr>
	<?php }   ?>	
	 <?php if($pag_int == 4){ ?>
	 <tr>
	    
	    <th align="center" ><?php echo "TOTAL"; ?></td>
		<th align="center" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($t_cap, 2, '.',''); ?></td>							
	    <th align="right" ><?php echo number_format($t_int, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($t_itf, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_aho, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_cap+
		                                           	$t_itf+
													$t_aho, 2, '.',','); ?></td>
		
		
	</tr>
	<?php }   ?>	
	<?php	
	
 }	
 if ($ncre1  == 'TODO'){ 
 //	 }else{
	 $con_pld  = "Select CRED_PLD_FECHA, sum(CRED_PLD_CAPITAL), sum(CRED_PLD_INTERES), sum(CRED_PLD_AHORRO) From
             cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null group by CRED_PLD_FECHA";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
     $res_pld = mysql_query($con_pld);
	$nro_cta = 0;
 	while ($lin_pld = mysql_fetch_array($res_pld)) {
 	      $nro_cta = $nro_cta + 1;
          $fec_pld = $lin_pld['CRED_PLD_FECHA'];
		  $cap_pld = $lin_pld['sum(CRED_PLD_CAPITAL)'];
		  $int_pld = $lin_pld['sum(CRED_PLD_INTERES)'];
	 	  $aho_pld = $lin_pld['sum(CRED_PLD_AHORRO)'];
	 //	 } 

	//   while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		    if ($_SESSION['EMPRESA_TIPO'] == 2){
			   if ($mon == 2){
			       $itf = 0;
				   }else{
				   $itf = 0;
				 }
			}	   
	//	    $fec_pag = $lin_tpa['CRED_PLD_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pld);
					
			$t_cap = $t_cap + $cap_pld;
			$t_int = $t_int + $int_pld;
		    $t_itf = $t_itf + $itf;
		    $t_aho = $t_aho + $aho_pld; 
		    $saldo = $saldo - $cap_pld;
		   
			
	/*			*/		
			?>
	<?php if($pag_int == 1){ ?>
	<tr>
	    
	    <td align="center" ><?php echo  $nro_cta ; ?></td>
		<td align="center" ><?php echo $f_pag; ?></td>
		<td align="right" ><?php echo number_format($cap_pld, 2, '.',''); ?></td>							
	    <td align="right" ><?php echo number_format($int_pld, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($itf, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($aho_pld, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($cap_pld+
		                                            $int_pld+$itf+
													$aho_pld, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
		
	</tr>
	<?php }   ?>
	<?php if($pag_int == 4){ ?>
	<tr>
	    
	    <td align="center" ><?php echo  $nro_cta ; ?></td>
		<td align="center" ><?php echo $f_pag; ?></td>
		<td align="right" ><?php echo number_format($cap_pld, 2, '.',''); ?></td>							
	    <td align="right" ><?php echo number_format($int_pld, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($itf, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($aho_pld, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($cap_pld+
		                                            $itf+
													$aho_pld, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
		
	</tr>
	<?php }   ?>
	
	
		
	<?php
	}
      ?>
	  <?php if($pag_int == 1){ ?>
	 <tr>
	    
	    <th align="center" ><?php echo "TOTAL"; ?></td>
		<th align="center" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($t_cap, 2, '.',''); ?></td>							
	    <th align="right" ><?php echo number_format($t_int, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($t_itf, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_aho, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_cap+
		                                            $t_int+
													$t_itf+
													$t_aho, 2, '.',','); ?></td>
		
		
	</tr>	
	<?php }   ?> 
	  <?php if($pag_int == 4){ ?>
	 <tr>
	    
	    <th align="center" ><?php echo "TOTAL"; ?></td>
		<th align="center" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($t_cap, 2, '.',''); ?></td>							
	    <th align="right" ><?php echo number_format($t_int, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($t_itf, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_aho, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_cap+
		                                            $t_itf+
													$t_aho, 2, '.',','); ?></td>
		
		
	</tr>	
	<?php }   ?> 
<?php
	
   }
    ?>



		  
<br>
 </table>
 <br><br>
<?php
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

