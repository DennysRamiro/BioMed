<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
	//include("header_3.php");
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
		//		include("header.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc']; 
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>


<!--inicio de la recuperacion de los datos para poder imprimir recien y grabar-->


 <?php
            $apli = 10000;
			 if ($_SESSION['monto'] > 0){
			     $_SESSION['monto_t'] = $_SESSION['monto'];
				  }else{
				 $_SESSION['monto'] = $_SESSION['monto_t'];
			}
            $_SESSION['monto_p'] = 0;
          //  $_SESSION['monto_i'] = 0;
           // $_SESSION['monto_125'] = 0;
           // $_SESSION['monto_3'] = 0;
           // $_SESSION['t_fac_fis'] = 0;
            $tc_ctb = $_SESSION['TC_CONTAB'];
            $c_agen = $_SESSION['COD_AGENCIA'];
            $_SESSION['c_agen'] = $c_agen;
            $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
         if (isset($_SESSION['des'])){
            if ($_SESSION['des'] <> ""){  
            	$descrip = $_SESSION['des'];
            	$descrip = strtoupper ($descrip);
            	$_SESSION['descrip'] = $descrip;
            	}
         }
             if ($_SESSION['monto_t'] > 0){  
                if ($_SESSION['egre_bs_sus'] == 2){
            	   $_SESSION['monto_eq'] = $_SESSION['monto_t'];
                     $monto_t = (($_SESSION['monto'] * $_SESSION['TC_CONTAB'])* -1);
                  }else{
            	            $monto_t = ($_SESSION['monto_t']* -1);
            	  }			
            				$_SESSION['monto_t'] =  $monto_t;
            	}
         if (isset($_SESSION['cue_egr'])){
            $cta_ctbg = $_SESSION['cue_egr'];
            $_SESSION['cta_ctbg'] =  $cta_ctbg;
         }
            //Factura
			/*
            if(isset($_POST['cre_fac'])){
	              $_SESSION['t_fac_fis'] = 2;
	              
	              $_SESSION['monto_i'] = $monto_t * .13 ;
	              
	              $_SESSION['monto_p'] = $monto_t - $_SESSION['monto_i'];
	              $cta_f13 = 14306101;
	              $_SESSION['cta_f13'] = $cta_f13;
	               $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
	               $res_ctable = mysql_query($con_ctable);
	               while ($lin_ctable = mysql_fetch_array($res_ctable)) {
            		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
            		 }	 
             } */
             //Factura excenta
             if(isset($_POST['cre_fex'])){
              $_SESSION['t_fac_fis'] = 3;
         
         		}
 			//Pago Servicios
			
         		if(isset($_SESSION['t_fac_fis'])){
	/*			
  if ($_SESSION['t_fac_fis'] == 4){
  //echo "tip_4";
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
  // $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'] * -1;
  	$impo_sus =  $imp_or/$tc_ctb;
		            $_SESSION['t_fac_fis'] = 4;
		            $monto_imp = $monto_t * .1550;
		            $monto_neto = $monto_t - $monto_imp;
		        	$monto_fis = ($monto_t * $monto_t) / $monto_neto;
		        	$cta_iue = 24203105; //
		        	$cta_it = 24203104;  // 
		            $_SESSION['cta_iue'] = $cta_iue;
		            $_SESSION['cta_it'] = $cta_it;
		            $_SESSION['monto_fis'] = $monto_fis;
		            $_SESSION['monto_125'] = $monto_fis * 0.125;
		            $_SESSION['monto_3'] = $monto_fis * 0.03;
		         // $cta_f13 = 14306101;
		           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
		           $res_ctable = mysql_query($con_ctable);
		           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		        		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
		        			     }	 
		           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
		           $res_ctable = mysql_query($con_ctable);
		           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		        		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
		        	}	 				 
		         } */
 }
          		if(isset($_POST['cre_bie'])){
		            $_SESSION['t_fac_fis'] = 5;
		            $monto_imp = $monto_t * .08;
		            $monto_neto = $monto_t - $monto_imp;
		        	$monto_fis = ($monto_t * $monto_t) / $monto_neto;
		        	$cta_iue = 24203105; //
		        	$cta_it = 24203104;  // 
		            $_SESSION['cta_iue'] = $cta_iue;
		            $_SESSION['cta_it'] = $cta_it;
		            $_SESSION['monto_fis'] = $monto_fis;
		            $_SESSION['monto_125'] = $monto_fis * 0.05;
		            $_SESSION['monto_3'] = $monto_fis * 0.03;
		         // $cta_f13 = 14306101;
		           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
		           $res_ctable = mysql_query($con_ctable);
		           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		        		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
		        			     }	 
		           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
		           $res_ctable = mysql_query($con_ctable);
		           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		        		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
		        	}	 				 
		        }

 
 
				if ($_SESSION['t_fac_fis'] <> 3){  
						?>
						<br><br><br>
						<?php
						//echo "Detalle Contable";
	
					if ($_SESSION['egre_bs_sus'] == 1){
					      $imp_or = $_SESSION['monto_t'];
						  $_SESSION['imp_or'] = $imp_or;
					      $importe = $_SESSION['monto_t'];
						  $cta_ctb =  $_SESSION['cta_ctb'];
						  $_SESSION['cta_ctb'] = $cta_ctb;
						  $importe_e =0;
						  $deb_hab = 2;
	 				} else {
				          $imp_or = $_SESSION['monto'] * $_SESSION['TC_CONTAB'];
						  $_SESSION['imp_or'] = $imp_or;
					      $importe = $monto_t;
						  $cta_ctb =  $_SESSION['cta_ctb'];
						  $_SESSION['cta_ctb'] = $cta_ctb;
						  $importe_e =$_SESSION['monto_eq'];
						  $deb_hab = 2;
	 				}
					//echo "---".$importe."---".$_SESSION['monto_t']."---";		  
			         $cta_ctbg = $_SESSION['cta_ctbg'];
					  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
		              $res_ctable = mysql_query($con_ctable);
				      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
				            $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
					     }
					  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
		              $res_ctable = mysql_query($con_ctable);
				      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
				            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
					     }	 
			     		
			     		//echo $des_ctableg;
  				} 
   ?>

<!--fin de la recuperacion de los datos para poder imprimir recien y grabar-->



 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>

         <?php 

       if(trim($_SESSION['egre_bs_sus']) == 1){?>
	    <a href='egre_retro.php?accion=1'>Salir</a>
	   <?php } elseif(trim($_SESSION['egre_bs_sus']) == 2){?>
	    <a href='egre_retro.php?accion=2'>Salir</a>
	   <?php }?> 


  
  </div>


<font  size="+1">


<?php
$apli = 10000;
if(isset($_SESSION['fec_proc'])){ 
   $fec = $_SESSION['fec_proc']; 
   $fec1 = cambiaf_a_mysql_2($fec);
 }	


 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }

$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
//echo $nro_tr_caj;
    $nro_tr_ingegr = leer_nro_co_ingegr(2); 		  

?>
	</table>
	<font size="+3">
<?php
 if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(8)."Recibo de Egreso".encadenar(42)."Recibo de Egreso";
?>
<br>
<font size="+2">
<?php
 
echo encadenar(20).$_SESSION['des_mon'].encadenar(75).$_SESSION['des_mon'];
?>
</font>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte. Egreso"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Egreso"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th>     
			
    </tr>	
	
	</table>
	
 <?php
//if ($_SESSION['detalle'] == 3){
 // echo $_SESSION['monto_t']."+".$_SESSION['monto_eq']."*".$_SESSION['egre_bs_sus']."//".$_SESSION['t_fac_fis'];
    $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $importe = $_SESSION['monto'];
   $imp_or = $_SESSION['monto_t'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   
    $cta_numero = explode(" ", $_SESSION['cta_ctbg']);
		       $cta_ctbg = $cta_numero[0];
   	$dec_ctag = leer_cta_des($cta_ctbg);		   
   $cta_ctb = $_SESSION['cta_ctb'];
   
   $deb_hab = 2;
   if(isset($_SESSION['t_fac_fis'])){
      $tipo2 = $_SESSION['t_fac_fis'];
	   }
   if ($_SESSION['egre_bs_sus'] == 2){
 //  echo $_SESSION['monto_eq'];
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'];
    }else{
	
	$imp_or = $_SESSION['monto_t'];		 
   	$impo_sus = $_SESSION['monto_t'];
	//echo "Aquiiiii ..... ".$impo_sus.$imp_or;
	} 
      	
   
   
   $tipo = 2;
   //echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
 //   echo "aqui".$impo_sus;
?>
<br>

 
 <table border="0" width="900">
  
	
        <?php if ($_SESSION['egre_bs_sus'] == 2){ ?>
  <tr>
       <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
	 </tr>
	<?php }?>
	
	<?php if ($_SESSION['egre_bs_sus'] == 1){ ?>
	    <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Monto ".encadenar(5); ?> </th>  
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		 
	<?php }?>
     </tr>
	 <tr>
	 <th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
    	<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
	 </tr>
	  <tr>
	 <th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		  
		</tr>
      </table>



</center>
<?php
	  if ($_SESSION['egre_bs_sus'] == 1){
	   //  echo $_SESSION['monto_t']*-1;
	    $mon_des = f_literal($_SESSION['monto_t']*-1,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		}
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
			
//$mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="900"> 
	 <tr>
	 	<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>
		<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
	 </tr> 
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>  
		<th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	</table>
	
<table border="0" width="900">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>

 <?php
  }
 //Prodesarrollo
 if ($_SESSION['EMPRESA_TIPO'] == 1){
echo encadenar(5)."Recibo de Egreso".encadenar(92);
?>
<br>
<font size="+2">
<?php
 
echo encadenar(5).$_SESSION['des_mon'].encadenar(75);
?>
</font>
<table border="0" width="450">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
		   
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte. Egreso"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
					
    </tr>	
	
	</table>
	
 <?php
//if ($_SESSION['detalle'] == 3){
 // echo $_SESSION['monto_t']."+".$_SESSION['monto_eq']."*".$_SESSION['egre_bs_sus']."//".$_SESSION['t_fac_fis'];
    $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $importe = $_SESSION['monto_t'];
   $imp_or = $_SESSION['monto_t'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
    $cta_numero = explode(" ", $_SESSION['cta_ctbg']);
		       $cta_ctbg = $cta_numero[0];
 
   $dec_ctag = leer_cta_des($cta_ctbg);
   $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 2;
   if(isset($_SESSION['t_fac_fis'])){
      $tipo2 = $_SESSION['t_fac_fis'];
	   }
   if ($_SESSION['egre_bs_sus'] == 2){
 //  echo $_SESSION['monto_eq'];
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'];
    }else{
	
	$imp_or = $_SESSION['monto_t'];		 
   	$impo_sus = $_SESSION['monto_t'];
	//echo "Aquiiiii ..... ".$impo_sus.$imp_or;
	} 
      	
   
   
   $tipo = 2;
   //echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
 //   echo "aqui".$impo_sus;
?>
<br>

 
 <table border="0" width="450">
  
	
        <?php if ($_SESSION['egre_bs_sus'] == 2){ ?>
  <tr>
       <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
	
	 </tr>
	<?php }?>
	
	<?php if ($_SESSION['egre_bs_sus'] == 1){ ?>
	    <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		<th align="left"><?php echo encadenar(30); ?> </th>
		
		 
	<?php }?>
     </tr>
	 <tr>
	 <th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
    	<th align="left"><?php echo encadenar(30); ?> </th>
		
	 </tr>
	  <tr>
	 <th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		
		  
		</tr>
      </table>



</center>
<?php
	  if ($_SESSION['egre_bs_sus'] == 1){
	   //  echo $_SESSION['monto_t']*-1;
	    $mon_des = f_literal($_SESSION['monto_t']*-1,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		}
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
			
//$mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="450"> 
	 <tr>
	 	<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(18); ?> </th>
		
	 </tr> 
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		 
	 </tr>
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(18); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	</table>
	
<table border="0" width="450">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
		
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		
	 </tr>

  </table>

 <?php
  }  
  
  ?>	
  
 <?php
// echo $_SESSION['egre_bs_sus'].$importe;
$tip_cta = substr($cta_ctb,0,3);
if ($_SESSION['egre_bs_sus'] == 2){
    $impo_sus = $_SESSION['monto_eq']*-1;
	$cod_mon = 2;
    }else{		 
  	$importe = $_SESSION['monto_t'];
    $cod_mon = 1;
	} 
if ($tip_cta == '111'){	
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 0,
												 '$fec1',
												 '$log_usr',
												 2,
												 13,
												 $nro_tr_caj,
												 $nro_tr_ingegr,
												 0,
												 '$log_usr',
												 13000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         $impo_sus,
												 $cod_mon,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
           }
 $cta_numero = explode(" ", $cta_ctb);
   $cta_ctb = $cta_numero[0];
   $impo_sus = $imp_or/$tc_ctb; 
	$consulta = "insert into caja_ing_egre(caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctb',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												  $imp_or,
												  $impo_sus,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  1: ' . mysql_error()); 		    
$_SESSION['fechr_proc'] = leer_fechr_pro_ie($nro_tr_ingegr);
//echo "AQUIIIII".$_SESSION['fechr_proc'];
$fech_proc=$_SESSION['fechr_proc'];
//$fech_proc1= cambiaf_a_normal($fech_proc);

$pieces = explode(" ", $fech_proc);
$fecha=cambiaf_a_normal($pieces[0]); // piece1
$hora=$pieces[1]; // piece2

 if ($_SESSION['EMPRESA_TIPO'] == 2){	
 ?>
 <br>
  <table border="0" width="900">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo $_SESSION['MON_AGENCIA'].encadenar(1).$fecha.encadenar(1).$hora?></th>
		<th align="left"><?php echo encadenar(55); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo $_SESSION['MON_AGENCIA'].encadenar(1).$fecha.encadenar(1).$hora?></th>
   </tr>
</table>
<center>

<?php
}	
 //Prodesarrollo
 
 
 
 if ($_SESSION['EMPRESA_TIPO'] == 1){	
 
 ?>
 
 <br>
  <table border="0" width="450">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(35); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(55).$_SESSION['MON_AGENCIA'].encadenar(1).$fecha.encadenar(1).$hora?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		
   </tr>
</table>
<center>

<?php
}	

//	 echo $nro_tr_ingegr.encadenar(2).$nro_tr_caj.encadenar(2).$c_agen.encadenar(2).$deb_hab.encadenar(2).$cta_ctb.encadenar(2).
		// $fec1.encadenar(2).$descrip.encadenar(2).$imp_or.encadenar(2).$imp_or.encadenar(2).$log_usr;
 //echo "***".$_SESSION['t_fac_fis']."****";
  
if(isset($_SESSION['t_fac_fis'])){
   $tipo2 = $_SESSION['t_fac_fis'];
 if ($_SESSION['t_fac_fis'] == 1){
  if ($_SESSION['egre_bs_sus'] == 2){
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'] * -1;
    }else{		 
  	$imp_or = $imp_or * -1;
    $impo_sus = $imp_or;
	} 
$deb_hab = 1;	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error()); 
 }
}

if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 2){
    // $tipo = $_SESSION['t_fac_fis'];
   $deb_hab = 1;
   $cta_ctbg = $_SESSION['cta_f13'];
   $imp_or = $_SESSION['monto_i'];
   if ($imp_or < 0){
      $imp_or = $imp_or * -1;
   }
   $impo_sus =  $imp_or/$tc_ctb; 
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  

  $cta_numero = explode(" ", $_SESSION['cue_egr']);
		$cta_ctbg = $cta_numero[0];
 //if(isset($_SESSION['myradio'])){
 
	// if($_SESSION['myradio'] == "cre_fac"){ 
	 $nro_fac = $_SESSION['nro_fact'];	
	
	if ($_SESSION['monto_i'] < 0 ){
	   $_SESSION['monto_i'] = $_SESSION['monto_i'] * -1;
	 }
	 
//echo  $_SESSION['monto']. "****".$_SESSION['monto_i'];	 
   $imp_or = $_SESSION['monto'] - $_SESSION['monto_i'];
 //  } else {
   
   // $imp_or = $_SESSION['monto_e'];
   //} }
  	$impo_sus =  $imp_or/$tc_ctb; 
  	 $deb_hab = 1; 
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  
  }
}
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 3){
  // $tipo = $_SESSION['t_fac_fis'];
   $deb_hab = 1;
   $cta_ctbg = $_SESSION['cta_f13'];
   $imp_or = $_SESSION['monto_i'] ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  

  $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_p'] ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  
  }
}
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 4){
  //echo "tip_4";
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
  // $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'];
  	$impo_sus =  $imp_or/$tc_ctb;
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
//   $imp_or = $_SESSION['monto_fis'] * -1;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  

  $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'] ;
   $impo_sus =  $imp_or/$tc_ctb;
  	 $deb_hab = 2; 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());
  
$cta_ctbg = $_SESSION['cta_it'];
   $imp_or = $_SESSION['monto_3'];
  	 $impo_sus =  $imp_or/$tc_ctb; 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  



  }
}	
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 5){;
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   // echo "tip_5";
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'];
  	$impo_sus =  $imp_or/$tc_ctb;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: ' . mysql_error());  

 $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'];
   $impo_sus =  $imp_or/$tc_ctb;
  	 $deb_hab = 2; 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  3: ' . mysql_error());
  
 $cta_ctbg = $_SESSION['cta_it'];
 $imp_or = $_SESSION['monto_3'];
 $impo_sus =  $imp_or/$tc_ctb; 
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  4: ' . mysql_error());  
  }
}		 	 
	 
	//header('Location: egre_mante.php');
	?>
	
<?php
//}	
//header('Location: egre_mante.php');	
?>

  <?php //} ?>
	 
</div>
<font size="1">
  <?php
		//	include("footer_in.php");
		 ?>
		</font> 
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>