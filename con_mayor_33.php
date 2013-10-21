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
	//require('c:\wamp\www\fpdf\fpdf.php');


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
       <?php if($_SESSION['menu'] == 48){?> 
	   <a href='cont_rep_op.php?accion=9'>Salir</a>
	    <?php } elseif($_SESSION['menu'] == 51){?> 
	    <a href='cont_rep_op.php?accion=31'>Salir</a>
	    <?php }?>
	  </center> 
	 <br> 
	   <?php
	//include("header.php"); 
	echo $emp_nom.encadenar(180);
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
/*
      if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
		
	  }	//4b */
	   echo "----".$_POST['cod_cta']."----";
	  if (isset($_POST['cod_cta'])){
              $cta_numero = explode(" ", $_POST['cod_cta']);
              $cod_cta =  $cta_numero[0];
              $_SESSION['cod_cta'] =  $cod_cta;
			  }
		/*  
	  if ($_POST['cod_cta2'] <> ""){ //4a  
	     $cod_cta2 = $_POST['cod_cta2'];
		 $mon_cta2 = $cod_cta[5]; 
	     $_SESSION['cod_cta2'] = $cod_cta2;
		
	  }	//4b */
	  
	  echo "****". $_POST['cod_cta2']."****";
	    if (isset($_POST['cod_cta2'])){
              $cta_numero = explode(" ", $_POST['cod_cta2']);
              $cod_cta2 =  $cta_numero[0];
              $_SESSION['cod_cta2'] =  $cod_cta2;
			  }
	  
     if (isset ($_POST['fec_des'])){
	     $fec_des = $_POST['fec_des'];
		  $_SESSION['fec_des'] = $fec_des;
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
	 }
     if (isset ($_POST['fec_has'])){
	     $fec_has = $_POST['fec_has'];
		  $_SESSION['fec_has'] = $fec_has;
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
	 }
	 
	 
	  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	  $cuantos = $_SESSION['cuantos'];
	echo encadenar(15). "Detalle Movimientos Cuentas".encadenar(2);
	    
	echo encadenar(2)."de".encadenar(2).$_SESSION['cod_cta'].
		 encadenar(2)."a la".encadenar(2).$_SESSION['cod_cta2'];
	?>	
	    <br>
	<?php
	echo encadenar(15)."del".encadenar(2).$fec_des.
		 encadenar(2)."al".encadenar(2).$fec_has;
	?>		
	

 
	<?php
	
	if (isset( $_SESSION['gestion'])){
        $gestion = $_SESSION['gestion'];
	}else{
        $gestion = 2011;
    }
	
if ($gestion == 2010){	
	 $con_tran = "Select  DISTINCT CONTA_TRS_CTA From contab_t2010 
		    	  where (CONTA_TRS_CTA between '$cod_cta' and '$cod_cta2')
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2')";
	}else{
	$con_tran = "Select  DISTINCT CONTA_TRS_CTA From contab_trans 
		    	  where (CONTA_TRS_CTA between '$cod_cta' and '$cod_cta2')
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
	        
			if ($saldo < 0){
			    $saldo = $saldo * -1;
				}
			if ($saldo_sus < 0){
			    $saldo_sus = $saldo_sus * -1;
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
			// $_SESSION['cod_cta'] = $cod_cta;
		  $des_cta = leer_cta_des($cod_cta);
		  $largo = 0;
		 $largo = strlen($glosa);
		 if ($largo <= 1){ 
	  // if (substr($glosa,0,1) == "-"){
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
}	
	

header('Location:prueba_imp_33.php');	


?>
	
	
	 
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