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
     require('header_2.php');
?>
          
<?php //  }
$consulta = "delete from temp_ctable3";
  $resultado = mysql_query($consulta);   
if ($_SESSION['continuar'] == 2){
	 $con_emp = "Select GRAL_EMP_NOMBRE  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				
		  }			
			?>
            <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
       <?php if($_SESSION['menu'] == 47){?> 
	   <a href='cont_rep_op.php?accion=8'>Salir</a>
	   <?php } elseif($_SESSION['menu'] == 50){?>
	   <a href='cont_rep_op.php?accion=30'>Salir</a> 
	   <?php }?>
	  </center> 
	 <br> 
	   <?php
	//include("header.php"); 
	//echo $emp_nom.encadenar(180);
	?>
	<br>
	<center>
<?php	
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
//$cuantos = 0;
$m_debe_1 = 0;
$m_haber_1 = 0;
$m_debe_2 = 0;
$m_haber_2 = 0;
$t_debe_1 = 0;
$t_haber_1 = 0;
$t_debe_2 = 0;
$t_haber_2 = 0;
$mon_cta = 0;
$saldo = 0;
$saldo_sus = 0;
$sal_1 = 0;
$sal_2 = 0;
	  
     if (isset ($_POST['fec_des'])){
	     $fec_des = $_POST['fec_des'];
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
	 }
     if (isset ($_POST['fec_has'])){
	     $fec_has = $_POST['fec_has'];
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
	 }
	 if ($_POST['cod_mon'] <> ""){ //4a  
	     $cod_mon = $_POST['cod_mon'];
		// $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_mon'] = $cod_mon;
		 if ($cod_mon == 1){
		     $des_mon = "Bolivianos";
		 }	 
		  if ($cod_mon == 2){
		     $des_mon = "Dolares";
		 }	
		  
	  }	//4b 
	 
	  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	  $cuantos = $_SESSION['cuantos'];
echo encadenar(15). "Detalle Movimientos Cuentas en".encadenar(2).$des_mon.encadenar(2);
	    
//	echo encadenar(2).$_SESSION['cod_cta'];
		 
		// $_SESSION['des_cta'] = $des_cta;
		 $_SESSION['fec_des'] = $fec_des;
		 $_SESSION['fec_has'] = $fec_has;
	?>	
	    <br>
	<?php
	echo encadenar(15)."del".encadenar(2).$fec_des.
		 encadenar(2)."al".encadenar(2).$fec_has;
		// $_SESSION['des_cta'] = $des_cta;
		 $_SESSION['fec_des'] = $fec_des;
		 $_SESSION['fec_has'] = $fec_has;
	?>		
	

 <table width="100%"  border="0" align="center">
    <tr>
	   <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	  <th scope="col" style="font-size:11px" align="right"><border="0" alt="" align="absmiddle" />NRO DOC</th>
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="40%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />DEBE BS.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />HABER BS.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO BS.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />DEBE $US.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />HABER $US.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO $US.</th>
	  
	</tr>
	<?php
	
	if (isset( $_SESSION['anio'])){
        $gestion = $_SESSION['anio'];
	}else{
        $gestion = 2011;
    }
	
if ($gestion == 2010){	
	 $con_tran = "Select  DISTINCT CONTA_TRS_CTA From contab_t2010 
		    	  where substring(CONTA_TRS_CTA,6,1) = '$cod_mon'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2')";
	}else{
	$con_tran = "Select  DISTINCT CONTA_TRS_CTA From contab_trans, contab_cuenta 
		    	  where CONTA_TRS_CTA = CONTA_CTA_NRO and
				  CONTA_CTA_MONE = '$cod_mon'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2')";
	
	
	}		  
	 $res_tran = mysql_query($con_tran);
	
	while ($lin_tran = mysql_fetch_array($res_tran)) {
		  $cod_cta = $lin_tran['CONTA_TRS_CTA'];
  if ($gestion == 2010){	
	 $con_tran2 = "Select * From contab_t2010 
		    	 where CONTA_TRS_CTA = '$cod_cta'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2') 
				  and CONTA_TRS_USR_BAJA is null order by CONTA_TRS_FEC_VAL";
	}else{
	 $con_tran2 = "Select * From contab_trans 
		    	 where CONTA_TRS_CTA = '$cod_cta'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2') 
				  and CONTA_TRS_USR_BAJA is null order by CONTA_TRS_FEC_VAL";			  
	}		  
	 $res_tran2 = mysql_query($con_tran2);
		
        while ($lin_tran2 = mysql_fetch_array($res_tran2)) {
	          
	  //   echo "entra 2";
	     $tipo_cta = substr($cod_cta,0,1);    
			if ($saldo < 0){
			    $saldo = $saldo * -1;
				}
			
			if ($saldo_sus < 0){
			    $saldo_sus = $saldo_sus * -1;
				}
				
			if ($tipo_cta > 3){	
			     $saldo_sus = 0; 	
		       }
			$sal_1 = $saldo;
			$sal_2 = $saldo_sus;	
						
	        $m_debe_1 = 0;
            $m_haber_1 = 0;
            $m_debe_2 = 0;
            $m_haber_2 = 0;
			$cod_cta = $lin_tran2['CONTA_TRS_CTA'];
			$mon_cta =  substr($cod_cta,5,1);
			$_SESSION['cod_mon'] = $mon_cta;
	        $nro_doc = $lin_tran2['CONTA_TRS_NRO'];
			$impo = $lin_tran2['CONTA_TRS_IMPO'];
			$impo_equiv = $lin_tran2['CONTA_TRS_IMPO_E'];
	        $deb_hab = $lin_tran2['CONTA_TRS_DEB_CRED'];	
			$glosa = $lin_tran2['CONTA_TRS_GLOSA'];
			$fec_tran = $lin_tran2['CONTA_TRS_FEC_VAL'];	
			$fec_tra = cambiaf_a_normal($fec_tran);
			 $_SESSION['cod_cta'] = $cod_cta;
		  $des_cta = leer_cta_des($cod_cta);
	   if (substr($glosa,0,1) == "-"){
	       if ($gestion == 2010){	
		  $con_glo  = "Select CONTA_CAB_GLOSA
	              From contab_c2010 where CONTA_CAB_FEC_VAL ='$fec_tran'
				  and CONTA_CAB_NRO =  $nro_doc
				  and CONTA_CAB_USR_BAJA is null";	
		   }else{		  
				  
		   $con_glo  = "Select CONTA_CAB_GLOSA
	              From contab_cabec where CONTA_CAB_FEC_VAL ='$fec_tran'
				  and CONTA_CAB_NRO =  $nro_doc
				  and CONTA_CAB_USR_BAJA is null";	
		}		  		  
		  $res_glo = mysql_query($con_glo);
	while ($lin_glo = mysql_fetch_array($res_glo)) {
	      $glosa = $lin_glo['CONTA_CAB_GLOSA'];
	
	
	}
			  
				  
		}  
		  
		  
	//		echo $glosa, $impo,"entra";		 
			if ($mon_cta == 1){
			    if ($deb_hab == 1){
				  //  $sal_1 = $sal_1 + $impo;
			 	    $m_debe_1 = $impo;
                    $m_haber_1 = 0;
                    $m_debe_2 = 0;
                               $m_haber_2 = 0; 
						    }
				if ($deb_hab == 2){
				  //  $sal_1 = $sal_1 - $impo;
				    $m_debe_1 = 0;
                    $m_haber_1 = $impo;
                    $m_debe_2 = 0;
                    $m_haber_2 = 0; 
						    }
	        			}
						if ($mon_cta == 2){
						    
						    if ($deb_hab == 1){
							   $m_debe_1 = $impo;
                               $m_haber_1 = 0;
                               $m_debe_2 = $impo_equiv;
                               $m_haber_2 = 0; 
						    }
							if ($deb_hab == 2){
							   $m_debe_1 = 0;
                               $m_haber_1 = $impo;
                               $m_debe_2 = 0;
                               $m_haber_2 = $impo_equiv; 
						    }
	        			}
	$tipo_cta = substr($cod_cta,0,1);					
	if ($tipo_cta > 3){	
	    $m_debe_2 = 0;
        $m_haber_2 = 0;
	}				
						
	$consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
										  temp_cuenta,
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($nro_doc,
										   '$fec_tra',
										  '$cod_cta',
									       '$glosa',
										   $m_debe_1,
										   $m_haber_1,
										   $m_debe_2,
										   $m_haber_2)";
										   
    $resultado = mysql_query($consulta);
	}
	}
	$consulta  = "Select * From temp_ctable3 order by temp_cuenta,temp_tip_tra";
    $resultado = mysql_query($consulta);
	
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = "";
	$cuenta2 = "";
	 $tot_1 = 0;
	 $tot_2 = 0;
	while ($linea = mysql_fetch_array($resultado)) {
	       $tot_1 = 0;
           $tot_2 = 0;
	      $cuenta2 = $linea['temp_cuenta'];
		    $tip_cta_1 = $cuenta2[0];
		 if ($cuenta1 == ""){ 	
			$tot_1 = sal_mayor2( $cuenta2,$fec_ha2,1,$gestion);
			 $tot_2 = sal_mayor2($cuenta2,$fec_ha2,2,$gestion);
			 }else{
			 $tot_1 = sal_mayor2( $cuenta1,$fec_ha2,1,$gestion);
			 $tot_2 = sal_mayor2($cuenta1,$fec_ha2,2,$gestion);
			 }
			//echo $tot_1."tot_1".$tot_2."tot_2";
	if ($cuenta1 <> $cuenta2){
	    $tipo_cta = substr($cuenta2,0,1);
	    $des_cta = leer_cta_des($cuenta2);
		$saldo = sal_mayor( $cuenta2,$fec_de2,1,$gestion);
		$sal_1 = $saldo;
			
			
			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2,$gestion);
			$sal_2 = $saldo_sus; 
			 if ($tipo_cta > 3){		
			     $saldo_sus = 0; 	
		    }
			 
			$sal_2 = $saldo_sus;
			
			
	  $_SESSION['saldo'] = $saldo;
	   $_SESSION['saldo_sus'] = $saldo_sus; ?>
	  
	<?php   if ($cuenta1 <> ""){
	 $tipo_cta = substr($cuenta1,0,1);
	 if ($tipo_cta > 3){		
			     $tot_2 = 0; 	
		    }
	
	 ?>
	  
	   
		<tr></tr>   
		 <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th align="right" style="font-size:12px"><?php echo encadenar(5); ?></td> 
		     <th align="center"><?php echo "Saldo Final"; ?></th>
		     <th align="right" style="font-size:12px" ><?php echo number_format( $tot_debe_1, 2, '.',','); ?></td> 
		     <th align="right" style="font-size:12px"><?php echo number_format($tot_haber_1, 2, '.',','); ?></td> 
			 
			 <th align="right" style="font-size:12px">
			 <?php echo number_format($tot_1 , 2, '.',','); ?></td>
			 <th align="right" style="font-size:12px"><?php echo number_format( $tot_debe_2, 2, '.',','); ?></td>
		     <th align="right" style="font-size:12px"><?php echo number_format($tot_haber_2, 2, '.',','); ?></td> 
			
			 <th align="right" style="font-size:12px">
			 <?php echo number_format( $tot_2 , 2, '.',','); ?></td>
			
		   </tr>
	 <?php  
	 $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	
	 
	 } ?>   
	 	   
		   
	<tr></tr>
	<tr>
	   <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
	   <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <th align="right" style="font-size:14px"><?php echo $cuenta2; ?></td> 
	 	<th align="left" style="font-size:14px"><?php echo $des_cta; ?></td>
	</tr>
	<tr></tr>	
		<?php 
//	$tipo_cta = substr($cuenta1,0,1);	
//	if ($tipo_cta > 3){		
//	    $saldo_sus = 0;
//	}		
		
		
		
	$cuenta1 = $cuenta2;
	
	?>
	
	<tr>
	 <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	   <td align="right" style="font-size:12px"><?php echo encadenar(5); ?></td> 
	 	<td align="left" style="font-size:12px"><?php echo encadenar(10); ?></td>
		<td align="left" style="font-size:12px"><?php echo "Saldo al ".$fec_des; ?></td>
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
	}
	
	
    
	
	      $tip_cta = $cuenta2[0];
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
	    if ($tip_cta == 3){  
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
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo $linea['temp_tip_tra']; ?></td>
			  <td align="left" style="font-size:12px"><?php echo $linea['temp_nro_cta']; ?></td>
	 	      <td align="left" style="font-size:12px"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
			  <td align="right" style="font-size:12px"><?php echo number_format($sal_1, 2, '.',','); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			  <td align="right" style="font-size:12px"><?php echo number_format($sal_2, 2, '.',','); ?></td>
	     </tr>
	
     <?php } ?>
         
   
	    
	
 <?php } 
 $tot_1 = sal_mayor2( $cuenta2,$fec_ha2,1,$gestion);
 $tot_2 = sal_mayor2( $cuenta2,$fec_ha2,2,$gestion);
 $tipo_cta = substr($cuenta2,0,1);	
	if ($tipo_cta > 3){		
	    $tot_2 = 0;
	}
 //1b?>
 <tr>
  
              <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td> 
	       	 <th><?php echo encadenar(3); ?></th>
			 <th align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
		     <th align="center"><?php echo "Saldo Final"; ?></th>
		     <th align="right" style="font-size:12px" ><?php echo number_format( $tot_debe_1, 2, '.',','); ?></td> 
		     <th align="right" style="font-size:12px"><?php echo number_format($tot_haber_1, 2, '.',','); ?></td> 
	
			 <th align="right" style="font-size:12px">
			 <?php echo number_format($tot_1 , 2, '.',','); ?></td>
			 
			 <th align="right" style="font-size:12px"><?php echo number_format( $tot_debe_2, 2, '.',','); ?></td>
		     <th align="right" style="font-size:12px"><?php echo number_format($tot_haber_2, 2, '.',','); ?></td> 
		
			 <th align="right" style="font-size:12px">
			 <?php echo number_format($tot_2 , 2, '.',','); ?></td>
			  
		   </tr>
	  </table>
     <center>
<?php
/*    


 } */ //1b?>
	
	
	 
</div>
  <?php
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>