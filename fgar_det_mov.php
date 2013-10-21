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
<!--Titulo de la pestaña de la pagina-->
<title>Reporte Detalle Movimientos</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" /> 
<script type="text/javascript" src="js/reportes_fondo_det_mov_proc.js"></script>
</head>
<body>	

    <?php
                include("header.php");
            ?>
 
           <div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->     
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                     <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                  <li id="menu_modulo_reportes_fondo">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
 				 <li id="menu_modulo_reportes_fondo_det_mov">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> DET. MOVIMIENTOS
                 </li> 
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMP. DET. MOV.
                 </li> 
                   </ul>  
                       <div id="contenido_modulo">
                        <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR DETALLE DE MOVIMIENTOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                         <img src="img/alert_32x32.png" align="absmiddle">
                       
                      </div>

<?php

 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <!--a href='fgar_reportes.php'>Salir</a-->
  </div>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
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
  if(isset($_POST['cod_mon'])){
      $mone = $_POST['cod_mon'];
      $_SESSION['mone'] = $mone;
  }  
?> 
<font size="+1"  style="" >
<?php
if ($mone == 1){
    echo encadenar(35)."LISTADO MOVIMIENTOS FONDO DE GARANTIA EN ".encadenar(2). "BOLIVIANOS";
  }
 if ($mone == 2){
    echo encadenar(35)."LISTADO MOVIMIENTOS FONDO DE GARANTIA EN ".encadenar(2). "DOLARES";
  } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(60)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<font size="0"  style="" >
	 <table border="1" width="800">
	
	<tr>
	    <th align="center">FECHA TRANSAC.</th> 
		<th align="center">A/M</th> 
		<th align="center">NRO. TRAN.</th>
		<th align="center">ASESOR</th> 
		<th align="center">NRO. CUENTA</th>  
	   	<th align="center">NRO. CREDITO</th> 
		<th align="center">CLIENTE</th>
		<th align="center">GRUPO</th>
		<th align="center">DEPOSITOS</th>           
	    <th align="center">RETIROS</th> 
		
    </tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_sep = 0;
	$t_ret = 0;
	$t_dep = 0;
	//echo $f_des2,$f_has2,$mone;	
	$con_tpa = "Select *
	            From fond_det_tran where
	            (FOND_DTRA_FECHA between '$f_des2' and '$f_has2') and 
				FOND_DTRA_CCON = 212 and
	             FOND_DTRA_USR_BAJA is null 
				 order by FOND_DTRA_FECHA,FOND_DTRA_NRO_CTA ";
    $res_tpa = mysql_query($con_tpa);
		$n_cre = "";
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    
		    $fec_pag = $lin_tpa['FOND_DTRA_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['FOND_DTRA_NRO_TRAN'];
			$cod_cta = $lin_tpa['FOND_DTRA_NCTA'];
			$n_cre = $lin_tpa['FOND_DTRA_NCRE'];
			$contab = $lin_tpa['FOND_DTRA_NRO_CTA'];
			$t_tra = $lin_tpa['FOND_DTRA_TIP_TRAN'];
			 
			$con_fma = "Select *
	            From fond_maestro where FOND_NRO_CTA = $cod_cta and
	                 FOND_MAE_USR_BAJA is null";
    $res_fma = mysql_query($con_fma);
//		$n_cre = "";
	    while ($lin_fma = mysql_fetch_array($res_fma)) {
		      $mon_cta = $lin_fma['FOND_COD_MON'];	
			  $t_ctaf = $lin_fma['FOND_TIPO_OPER'];
			  $f_stat = $lin_fma['FOND_ESTADO'];
			  $ncre2 = $lin_fma['FOND_NRO_CRED'];
		}
		
	
if ($mon_cta == $mone){			
	//echo $n_cre."---";			
	//Consulta Cart_maestro
	
	
	     
		if ($t_ctaf == 1) {	
		
		    if ($n_cre == 0){
			
			$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre2 and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and CART_MAE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $mon = $lin_car['CART_COD_MON'];
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					//$c_grup = "";
                    $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
					$t_cred = $lin_car['CART_TIPO_CRED'];
				//	$t_ctaf = $lin_car['FOND_TIPO_OPER'];
					$asesor = $lin_car['CART_OFIC_RESP'];
				  $nom_ases = leer_nombre_usr($t_cred,$asesor); 
		$nom_grp = "";	
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			     // $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;	
				//  echo $nom_cli;	
				}
			}
			}		
			}else{
			
			
			
			
		  
		 //    echo $n_cre;
			$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $n_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and CART_MAE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $mon = $lin_car['CART_COD_MON'];
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					//$c_grup = "";
                    $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
					$t_cred = $lin_car['CART_TIPO_CRED'];
				//	$t_ctaf = $lin_car['FOND_TIPO_OPER'];
					$asesor = $lin_car['CART_OFIC_RESP'];
				  $nom_ases = leer_nombre_usr($t_cred,$asesor); 
		$nom_grp = "";	
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			     // $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;	
				//  echo $nom_cli;	
				}	
			}	
		}	
	   }
	   }
	 // echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cta;	 
	   if ($t_ctaf == 2) {	
	       $con_car  = "Select * From fond_cliente, cliente_general
             where FOND_CLI_NCTA = $cod_cta  
             and CLIENTE_COD_ID = FOND_CLI_ID and FOND_CLI_RELACION = 'T' 
			 and FOND_CLI_USR_BAJA is null and CLIENTE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			      $nom_grp = ""; 
	               $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					          $lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					          $lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					         $lin_car['CLIENTE_NOMBRES'].encadenar(1);
	           }
	   
	   
	   }  		
		
			$p_dep = 0;
			$p_ret = 0;
		    $con_tra = "Select * From fond_det_tran where FOND_DTRA_NCTA = $cod_cta and 
	            FOND_DTRA_FECHA = '$fec_pag' and FOND_DTRA_NRO_TRAN = $nro_tran and substr(FOND_DTRA_CTA_CBT,1,3) = '212'
				 and FOND_DTRA_USR_BAJA is null";
            $res_tra = mysql_query($con_tra);
			while ($lin_tra = mysql_fetch_array($res_tra)) { // 2 a
			   $p_dep = 0;
			   $p_ret = 0;
			     // $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['FOND_DTRA_IMPO'];
				  $t_tran = $lin_tra['FOND_DTRA_TIP_TRAN'];
				  $t_ccon = $lin_tra['FOND_DTRA_CCON'];
				  $contab = $lin_tra['FOND_DTRA_NRO_CTA'];
				  
				//  echo $p_imp;
				  if ($contab == 1){ // 3a
				      $cont =  "A";
				//echo $nro_tran,$fec_pag	,$t_tra; 		
	            $con_fca = "Select *
	            From fond_cabecera where FOND_CAB_NRO_TRAN = $nro_tran and
				                         FOND_CAB_FECHA = '$fec_pag' and 
										 FOND_CAB_TIP_TRAN = $t_tra and
										 FOND_CAB_TRAN_CAR > 0 and
										  FOND_CAB_NCTA = '$cod_cta' and
	                                     FOND_CAB_USR_BAJA is null";
                $res_fca = mysql_query($con_fca);
//		$n_cre = "";
	    while ($lin_fca = mysql_fetch_array($res_fca)) {
		      $nro_tran = $lin_fca['FOND_CAB_TRAN_CAR'];	
			  }

					} // 3b
				  	if ($contab == 2){ // 3a
				      $cont =  "M";
					}
			 if ($t_tran == 1){ //4a
			   //  if ($t_ccon == 212){ //5a
				    $p_dep =  $p_imp;
					$t_dep =  $t_dep + $p_dep;
				 //  } // 5b
				} // 4b
			 if ($t_tran == 2){ //4a
			     //if ($t_ccon == 212){ //5a
				    $p_ret =  $p_imp;
					$t_ret =  $t_ret + $p_ret;
				  // } // 5b
				} // 4b	
			//	$p_tot  = $p_cap ;	
				
			} // 2b	
		//	$t_tot = $t_tot + $p_tot;
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
		 <td align="center" ><?php echo $cont; ?></td>
		<td align="left" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="right" ><?php echo $nom_ases; ?></td>	
		<td align="right" ><?php echo $cod_cta; ?></td>	
		<td align="right" ><?php echo $n_cre; ?></td>	
		<td align="left" ><?php echo $nom_cli; ?></td>	
		<td align="left" ><?php echo $nom_grp; ?></td>							
	    <td align="right" ><?php echo number_format($p_dep, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($p_ret, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($f_stat , 0, '.',','); ?></td>
		
	</tr>	
	
	<?php					 
				    	
		
//	$nro = $nro + 1;
	             
	 
				 
			}	 
				 
	           } // 1b
		
			   			
	?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>					
	    <th align="right" ><?php echo number_format($t_dep, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_ret, 2, '.',','); ?></th>
		
	</tr>	
	
	
	
	</table>		
<?php	








/* 
$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_maestro, cart_deudor, cliente_general');
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
		 $mon = $lin_car['CART_COD_MON'];
		 $t_oper = $lin_car['CART_TIPO_OPER'];
		 $t_prod = $lin_car['CART_PRODUCTO'];
		 $cuotas = $lin_car['CART_NRO_CTAS'];
		 $f_pag = $lin_car['CART_FORM_PAG'];
		 $ahod = $lin_car['CART_AHO_DUR'];
		 $f_des = $lin_car['CART_FEC_DES'];
		 $f_uno = $lin_car['CART_FEC_UNO'];
		 $c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		 $estado = $lin_car['CART_ESTADO'];
		 $tasa = $lin_car['CART_TASA'];
		 $of_resp = $lin_car['CART_OFIC_RESP'];
		 $nom_grp = "";
		 
		 $f_des2= cambiaf_a_normal($f_des); 
		 $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
		 $ci = $lin_car['CLIENTE_COD_ID'];
		 
		 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	      while ($linea = mysql_fetch_array($res_mon)) {
	            $d_mon = $linea['GRAL_PAR_INT_DESC'];
			   }
 		 
		 ?>
		 
		 <?php
		 $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
         $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla');
	     while ($linea = mysql_fetch_array($res_est)) {
	           $d_est = $linea['GRAL_PAR_PRO_DESC'];
	           $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	        }
		 	 
		 ?>
		
		 <?php
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_oper";
        $res_dope = mysql_query($con_dope)or die('No pudo seleccionarse tabla');
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
		 
		 	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
       
			?>
		 
		 <?php		
			}
?>
<table border="0" width="950">
   <tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(45); ?></th> 
		<th align="center"><?php  echo encadenar(20); ?></th>           
	    <th align="center"><?php echo encadenar(35); ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
		
   </tr>	
   <tr>
	    <td align="left" <b><?php echo "Cliente:".encadenar(2). "C.I."; ?> </b></td>
		<td align="left" ><?php echo $ci; ?></td>
		<td align="left" ><?php echo $nom_cli; ?></td>	
		<?php if($nom_grp <> ""){ ?>
		<td align="right" <b><?php echo "Grupo:".encadenar(2); ?></b></td>						
	    <td align="left" ><?php echo $nom_grp; ?></td>
		<?php }else{ ?>
		<td align="center"><?php echo encadenar(20); ?></th> 
		<td align="center"><?php echo encadenar(35); ?></th> 
		<?php } ?>   
	 	<td align="left" <b><?php echo "Moneda:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $d_mon; ?></td>
	</tr>
	<tr>
	    <td align="left" <b><?php echo "Estado:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $d_est; ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
		<td align="right" ><?php echo encadenar(45); ?></td>						
	    <td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo "Tasa Interes:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo number_format($tasa, 2, '.',','); ?></td>
	</tr>
	<tr>
	    <td align="left" <b><?php echo "Tipo Operacion:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $d_ope; ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
		<td align="right" ><?php echo encadenar(45); ?></td>						
	    <td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo "Asesor:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $of_resp; ?></td>
	</tr>
	<?php
	$con_fon  = "Select * From fond_maestro where FOND_NRO_CRED = $ncre and FOND_MAE_USR_BAJA is null"; 
    $res_fon = mysql_query($con_fon)or die('No pudo seleccionarse fond_maestro');
      while ($lin_fon = mysql_fetch_array($res_fon)) {
         $cod_cre2 = $lin_fon['FOND_NRO_CRED']; 
		 $cta = $lin_fon['FOND_NRO_CTA'];
		 
		 $tot_tre = 0;
		 $tot_tde = 0;
	   }
	 ?>
	 <tr>
	    <td align="left" <b><?php echo "Fondo Garantia".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $cta; ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
		<td align="right" ><?php echo encadenar(45); ?></td>						
	    <td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo encadenar(20); ?></b></td>
		<td align="left" ><?php echo encadenar(20); ?></td>
	</tr>
	 
	</table>
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">FECHA TRANSAC.</th>  
	   	<th align="center">TIPO TRANSAC.</th> 
		<th align="center">NRO. TRAN.</th> 
		<th align="center">AMORTIZACION CAPITAL</th>           
	    <th align="center">INTERES NORMAL</th>
		 <th align="center">INTERES VENCIDO</th>
		<th align="center">APORTE VOLUNTARIO</th>
		<th align="center">INTERES PENAL</th>
		<th align="center">OTROS</th>
		<th align="center">DESEM/PAGO TOTAL</th>
		<th align="center">SALDO  </th>
  </tr>		
		  
		 <?php
		 $nom_grp = "";
		 $p_cap = 0;
		 $d_est = "";
		 $p_int = 0;
		 $p_iven = 0;
		 $p_aho = 0; 
		 $p_otro = 0;
		 $p_pen = 0;
		 $p_otro = 0;
		 $p_tot  = 0;
		 $saldo = 0;
		 $nro_tran = 0;
				
	  //Datos del cart_det_tran						
	$con_tpa = "Select DISTINCT CART_DTRA_FECHA, CART_DTRA_NRO_TRAN From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            (CART_DTRA_TIP_TRAN = 1 or CART_DTRA_TIP_TRAN = 2) and CART_DTRA_USR_BAJA is null 
				 order by CART_DTRA_FECHA, CART_DTRA_NRO_TRAN ";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
		    $fec_pag = $lin_tpa['CART_DTRA_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CART_DTRA_NRO_TRAN'];
			
			$p_cap = 0;
			$p_int = 0;
		    $p_iven = 0;
		    $p_aho = 0; 
		    $p_otro = 0;
		    $p_pen = 0;
		    $p_otro = 0;
		    $p_tot  = 0;
			
			$con_tra = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            CART_DTRA_FECHA = '$fec_pag' and CART_DTRA_NRO_TRAN = $nro_tran and CART_DTRA_USR_BAJA is null";
            $res_tra = mysql_query($con_tra)or die('No pudo seleccionarse tabla cart_det_tran')  ;
			while ($lin_tra = mysql_fetch_array($res_tra)) {
			      $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['CART_DTRA_IMPO'];
				  $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
				  
				  if ($t_tran == 1){
				      $saldo =  $p_imp;
					}
			 if ($t_tran == 2){
			     if ($t_ccon > 130 and $t_ccon < 135){
				    $p_cap =  $p_imp;
					$saldo =  $saldo - $p_cap;
					}
				 if ($t_ccon > 512 and $t_ccon < 514){
				    $p_int =  $p_imp;
					}
				 if ($t_ccon > 514 and $t_ccon < 516){
				    $p_iven =  $p_imp;
					}
				 if ($t_ccon == 212){
				    $p_aho =  $p_imp;
					}
				 if ($t_ccon == 242){
				    $p_otro =  $p_imp;
					}	
				}	
				$p_tot  = $p_cap + $p_int + $p_iven + $p_aho + $p_otro;	
				 
				    	
		
	$nro = $nro + 1;
	           }			
			?>
	<center>
	
	
	
	
	
	
	
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
		<td align="left" ><?php if ($t_tran == 1 ){echo "Desem.";
		                            }else{echo "Pago"; } ?></td>
		<td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>							
	    <td align="right" ><?php echo number_format($p_cap, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($p_int, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_iven, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_aho, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_pen, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_otro, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_tot, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
	</tr>	
	<?php
	}
  }
    ?>
</table>
 <table border="1" width="450" align="center">
	
	<tr>
	    <th align="center">NUMERO CUENTA  FONDO DE GARANTIA</th>  
	   	<th align="center">DEPOSITOS</th> 
		<th align="center">RETIROS</th> 
		<th align="center">SALDO  </th>
  </tr>	
  <?php
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $depos = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		  }
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $ret = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		  }		  
  
  ?> 
  <tr>
	    <td align="left" ><?php echo $cta; ?></td>
	   	<td align="right" ><?php echo number_format($depos, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($ret, 2, '.',','); ?></td> 
		<td align="right" ><?php echo number_format($depos - $ret, 2, '.',','); ?></td>
  </tr>	
  	
</table> 




		  
<br>
 
<?php
*/
		 
		 ?>

</div>
<?php
            include("footer_in.php");
         ?>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

