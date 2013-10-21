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
<title>Consulta Cobro detalle</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cjas_cart_dir_nom_cons_modif_kar.js"></script>  
<!--script type="text/javascript" src="js/cajas_cobros_cart_dir_group_sel_kardex.js"></script--> 
</head>

<body>
<?php
				include("header.php");
			?>
<div id="pagina_sistema">
		     <ul id="lista_menu">      
		                 <li id="menu_modulo">
		                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
		                    
		                 </li>
		  		  <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                 <li id="menu_modulo_cjas_cartera">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cjas_cartera_directo">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
  
					 <li id="menu_modulo_cajas_cob_group_sel">
                    
                     <img src="img/user_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO 
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel_modif">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> SELECCIONAR GRUPO
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel_modificar">
                    
                     <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR GRUPO
                    
                 </li>

                    <li id="menu_modulo_fondogrupo">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> KARDEX CLIENTE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/my documents_64x64.png" border="0" alt="Modulo" align="absmiddle">KARDEX CLIENTE</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
				          <img src="img/alert_32x32.png" align="absmiddle">
				          Elija el Grupo para modificar
				        </div>


<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <!--a href='menu_s.php'>Salir</a-->
  </div>

<br><br>
<?php
$nre = " ";
if(isset($_POST['ncre'])){
      $ncre = $_POST['ncre'];
      $_SESSION['ncre'] = $ncre;
      
   }
?> 
<font size="+2"  style="" >
<?php
echo encadenar(35)."EXTRACTO DE MOVIMIENTOS DE CREDITOS";
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(60)."CREDITO  Nro. ".encadenar(3).$ncre;
?>
</font>
<br>
<?php  
$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			  and CLIENTE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
		 $mon = $lin_car['CART_COD_MON'];
		 $t_oper = $lin_car['CART_TIPO_OPER'];
		 $tcred = $lin_car['CART_TIPO_CRED'];
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
		 $nom_ases = "";
		 $nom_ases = leer_nombre_usr($tcred,$of_resp);
		 $f_des2= cambiaf_a_normal($f_des); 
		 $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
		 $ci = $lin_car['CLIENTE_COD_ID'];
		 
		 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
         $res_mon = mysql_query($con_mon);
	      while ($linea = mysql_fetch_array($res_mon)) {
	            $d_mon = $linea['GRAL_PAR_INT_DESC'];
			   }
 		 
		 ?>
		 
		 <?php
		 $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
         $res_est = mysql_query($con_est);
	     while ($linea = mysql_fetch_array($res_est)) {
	           $d_est = $linea['GRAL_PAR_PRO_DESC'];
	           $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	        }
		 	 
		 ?>
		
		 <?php
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
       
			?>
		 
		 <?php		
			}
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
		<td align="left" ><?php echo $nom_ases; ?></td>
	</tr>
	<?php
	$con_fon  = "Select * From fond_maestro where FOND_NRO_CRED = $ncre and FOND_MAE_USR_BAJA is null"; 
    $res_fon = mysql_query($con_fon);
      while ($lin_fon = mysql_fetch_array($res_fon)) {
         $cod_cre2 = $lin_fon['FOND_NRO_CRED']; 
		 $cta = $lin_fon['FOND_NRO_CTA'];
		 
		 $tot_tre = 0;
		 $tot_tde = 0;
	   }
	 if (isset($cta)){  
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
	 <?php } ?>
	</table>
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">FECHA TRANSAC.</th>  
	   	<th align="center">TIPO TRANSAC.</th>
		<th align="center">NRO. CUOTA</th> 
		<th align="center">NRO. TRAN.</th> 
		<th align="center">AMORTIZACION CAPITAL</th>           
	    <th align="center">INTERES NORMAL</th>
		 <th align="center">INTERES VENCIDO</th>
		<th align="center">FORMULARIOS</th>
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
		$tot_cap = 0;
		$tot_int = 0;
		$tot_intv = 0;
		$tot_aho = 0;
		$tot_otr = 0;		
	  //Datos del cart_det_tran						
	$con_tpa = "Select DISTINCT CART_DTRA_FECHA, CART_DTRA_NRO_TRAN From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            (CART_DTRA_TIP_TRAN = 1 or CART_DTRA_TIP_TRAN = 2) and CART_DTRA_USR_BAJA is null 
				 order by CART_DTRA_FECHA, CART_DTRA_NRO_TRAN ";
    $res_tpa = mysql_query($con_tpa);
	
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
			
	$con_cta = "Select CART_CAB_NRO_CTA From cart_cabecera where CART_CAB_NCRE = $cod_cre and 
	            CART_CAB_NRO_TRAN = $nro_tran and CART_CAB_USR_BAJA is null";
    $res_cta = mysql_query($con_cta);
	 $nro_cta = "-";
	    while ($lin_cta = mysql_fetch_array($res_cta)) {
		       
		       $nro_cta = $lin_cta['CART_CAB_NRO_CTA'];
		}
			
			$con_tra = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            CART_DTRA_FECHA = '$fec_pag' and CART_DTRA_NRO_TRAN = $nro_tran and CART_DTRA_USR_BAJA is null";
            $res_tra = mysql_query($con_tra);
			while ($lin_tra = mysql_fetch_array($res_tra)) {
			      $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['CART_DTRA_IMPO'];
				  $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
				  $deb_cre = $lin_tra['CART_DTRA_DEB_CRE'];
				  $tc_tran = $lin_tra['CART_DTRA_TIP_CAM'];
				  $cta_ctb = $lin_tra['CART_DTRA_CTA_CBT'];
				  if ($t_tran == 1){
				   if ($t_ccon > 130 and $t_ccon < 135){
				    $p_cap =  $p_imp;
					$saldo =  $p_cap;
					}
				     
					}
			 if ($t_tran == 2){
			     if ($t_ccon > 130 and $t_ccon < 138){
				    $p_cap =  $p_imp;
					$saldo =  $saldo - $p_cap;
					$tot_cap = $tot_cap + $p_cap;
					}
				  if ($t_ccon > 530 and $t_ccon < 532){
				     $t_cp = substr($cta_ctb,3,2);
					// echo $t_cp;
				     if ($t_cp == '04'){ 
				   	     $p_cap =  $p_imp;
					     $saldo =  $saldo - $p_cap;
					     $tot_cap = $tot_cap + $p_cap;
						 }
					  if ($t_cp == '02'){ 
				   	     $p_int =  $p_imp;
					     $tot_int = $tot_int + $p_int;
						 } 	 
					}	
				 if ($t_ccon > 512 and $t_ccon < 514){
				    $p_int =  $p_imp;
					$tot_int = $tot_int + $p_int;
					}
				 if ($t_ccon == 138){
				    $p_int = $p_int + $p_imp;
					$tot_int = $tot_int + $p_imp;
				}	
				 if ($t_ccon > 514 and $t_ccon < 516){
				    $p_iven =  $p_imp;
					$tot_intv = $tot_intv + $p_iven;
					}
				 if ($t_ccon == 212){
				    if ($deb_cre == 2){
				    $p_aho =  $p_imp;
					$tot_aho = $tot_aho + $p_aho;
					}
					}
				 if ($t_ccon == 242){
				    if ($mon == 2){
				       $p_otro =  $p_imp/$tc_tran;
					 } 
					 if ($mon == 1){
				       $p_otro =  $p_imp;
					 }   
					$tot_otr = $tot_otr + $p_otro;
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
		<td align="center" ><?php echo $nro_cta; ?></td>							
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
	<tr>
	    <th align="left" ><?php echo "Total"; ?></td>
		<th align="left" ><?php echo encadenar(3);?> </td>
		<th align="right" ><?php echo  encadenar(3); ?></td>
		<th align="right" ><?php echo  encadenar(3); ?></td>								
	    <th align="right" ><?php echo number_format($tot_cap, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($tot_int, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($tot_intv, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($tot_aho, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($tot_otr, 2, '.',','); ?></td>
		<td align="right" ><?php echo encadenar(3); ?></td>
		<td align="right" ><?php echo encadenar(3); ?></td>
	</tr>	
 <?php
   if (isset($cta)){  ?>	

</table>
 <table border="1" width="450" align="center">
	
	<tr>
	    <th align="center">NUMERO FONDO GARANTIA</th>  
	   	<th align="center">DEPOSITOS</th> 
		<th align="center">RETIROS</th> 
		<th align="center">SALDO  </th>
  </tr>	
  <?php
 //  if (isset($cta)){  
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $depos = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		  }
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_CCON = 212 and  FOND_DTRA_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra) ;
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
   <?php } ?>	
</table> 
	  
<br>
 


</div>
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

