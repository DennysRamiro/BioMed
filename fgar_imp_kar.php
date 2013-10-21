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
<title>Modificar Nombre Grupo</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />

<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/cjas_cart_dir_nom_cons_modif_fon.js"></script>  

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
  				<li id="menu_modulo_cjas">
                    
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
                  <li id="menu_modulo_cajas_cob_group_sel_modificar_grupo">
                    
                     <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR GRUPO
                    
                 </li>
                 <li id="menu_modulo_fondo_grupss">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMPRIMIR NOM. CLIENTE
                    
                 </li>

              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR NOMBRE CLIENTE </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          
        </div-->  




<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>

  </div>

<br><br>
<?php
$_SESSION['ncre'] = 0;
$_SESSION['ncta'] = 0;
$d_est = "";
//echo $_SESSION['cart_fgar']."cart_fgar";
if(isset($_POST['ncre'])){
      $ncre = $_POST['ncre'];
      $_SESSION['ncre'] = $ncre;
	  }
if ($_SESSION['cart_fgar'] == 1){ 
	$ncre = $_SESSION['ncre'];
	$con_fon  = "Select FOND_NRO_CTA From fond_maestro where FOND_NRO_CRED = $ncre
                 and FOND_MAE_USR_BAJA is null";
    $res_fon = mysql_query($con_fon);
	while ($lin_fon = mysql_fetch_array($res_fon)) {
         $ncta = $lin_fon['FOND_NRO_CTA'];
		 $_SESSION['ncta'] = $ncta;
	}
	}
	
	
 if(isset($_POST['ncta'])){
 
      $ncta1 = $_POST['ncta'];
      
	  //echo $_SESSION['ncta']."*****";
	  $trozos = explode("*", $ncta1);
	  $ncta = $trozos[0]; 
	  $_SESSION['ncta'] = $ncta;
	  $ncre = $trozos[1];
	  $_SESSION['ncre'] = $ncre;
	  
	  $con_fon  = "Select FOND_NRO_CTA From fond_maestro where FOND_NRO_CTA = $ncta
                 and FOND_MAE_USR_BAJA is null";
    $res_fon = mysql_query($con_fon);
	while ($lin_fon = mysql_fetch_array($res_fon)) {
         $ncta = $lin_fon['FOND_NRO_CTA'];
		 $_SESSION['ncta'] = $ncta;
	}
	  
	  
   if(isset($_POST['ncre'])){
     $ncre = $_POST['ncre'];
      $_SESSION['ncre'] = $ncre;
    $con_fon  = "Select FOND_NRO_CTA From fond_maestro where FOND_NRO_CRED = $ncre
                 and FOND_MAE_USR_BAJA is null";
    $res_fon = mysql_query($con_fon);
	while ($lin_fon = mysql_fetch_array($res_fon)) {
         $ncta = $lin_fon['FOND_NRO_CTA'];
		$_SESSION['ncta'] = $ncta; 
		 echo "AQuiiiii";
	}
	}
//	echo $ncta;
	}
if(isset($_SESSION["tip_cta"])){	
if ($_SESSION["tip_cta"] == 2){	
    
	if(isset($_POST['nro_cta'])){
	//   echo "Aquuuuiiii".$_POST['nro_cta'];
       $ncta = $_POST['nro_cta'];
		 $_SESSION['ncta'] = $ncta;
	}
}	
}
?> 
<font size="+2"  style="" >


<br>
<font size="+1"  style="" >
<?php
echo $_SESSION['cart_fgar'];


if ($_SESSION['cart_fgar'] == 1){
echo encadenar(60)."CREDITO  Nro. ".encadenar(3).$ncre;
}else{
	//codigo que se aumento para poder eviatr los vacios de la variable $ncta
	if (isset($ncta)){
		echo encadenar(80)."CUENTA  Nro. ".encadenar(3).$ncta;
	}else{
		echo "no existe cuenta";
	}

?>
<br><br>
<?php 
echo "CLIENTE".encadenar(3).$_SESSION['nombre'];
}
?>
</font>
<br>
<?php 

if ($_SESSION['cart_fgar'] <> 2){ 
$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			 and CLIENTE_USR_BAJA is null";
			  

$res_car = mysql_query($con_car);
$nro = 0;
$tot_dep = 0;
$tot_ret = 0;
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
		 $tcred = $lin_car['CART_TIPO_CRED'];
		 $of_resp = $lin_car['CART_OFIC_RESP'];
		  $nom_ases = "";
		 $nom_ases = leer_nombre_usr($tcred,$of_resp);
		 $nom_grp = "";
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
if ($_SESSION['cart_fgar'] == 2){		 
		 	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
       		}
	}		
		  }
		}
		
if ($ncta <> 0 or $ncta <> ""){		
    $con_fon  = "Select * From fond_maestro where FOND_NRO_CTA = $ncta
                 and FOND_MAE_USR_BAJA is null";
    $res_fon = mysql_query($con_fon);
$nro = 0;
   while ($lin_fon = mysql_fetch_array($res_fon)) {
         $ncre = $lin_fon['FOND_NRO_CRED'];
		 $tipo = $lin_fon['FOND_TIPO_OPER'];
		 }
if ($tipo == 1){
	$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			 and CLIENTE_USR_BAJA is null ";
			  

$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {	 
		 
		 
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
		  $tcred = $lin_car['CART_TIPO_CRED'];
		 $of_resp = $lin_car['CART_OFIC_RESP'];
		  $nom_ases = "";
		 $nom_ases = leer_nombre_usr($tcred,$of_resp);
		 $nom_grp = "";
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
       		}
		}	
		  }
		}		
//	}	
if ($tipo == 2) {	
    $con_car  = "Select * From fond_maestro, fond_cliente, cliente_general
             where FOND_NRO_CTA = $ncta and FOND_CLI_NCTA = FOND_NRO_CTA 
             and CLIENTE_COD_ID = FOND_CLI_ID and FOND_CLI_RELACION = 'T' 
			 and FOND_CLI_USR_BAJA is null and  FOND_MAE_USR_BAJA is null
			 and CLIENTE_USR_BAJA is null ";
			  

$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
		 $ci = $lin_car['CLIENTE_COD_ID'];
		 $nom_grp = "-";
		 $d_est = "-";
		 $d_ope = "-";
		 $nom_ases = "-";
		 $tasa = 0;
		 $mon = $lin_car['FOND_COD_MON'];
		 		 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
         $res_mon = mysql_query($con_mon);
	      while ($linea = mysql_fetch_array($res_mon)) {
	            $d_mon = $linea['GRAL_PAR_INT_DESC'];
			   }

	}
		
}		

?>
		
		  
		
	  <table border="0" width="950">
   <tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		
		<th align="center"><?php  echo encadenar(20); ?></th>           
	   
		 <th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
		
   </tr>	
   <tr>
	    <td align="left" <b><?php echo "Cliente:".encadenar(2). "C.I."; ?> </b></td>
		<td align="left" ><?php echo $ci.encadenar(2); ?></td>
		<td align="left" ><?php echo $nom_cli; ?></td>	
		<?php if($nom_grp <> ""){ ?>
		<td align="right" <b><?php echo "Grupo:".encadenar(2); ?></b></td>						
	    <td align="left" ><?php echo $nom_grp; ?></td>
		<?php }else{ ?>
		
		<td align="center"><?php echo encadenar(35); ?></th> 
		<?php } ?>   
	 	<td align="left" <b><?php echo "Moneda:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $d_mon; ?></td>
	</tr>
	<tr>
	    <td align="left" <b><?php echo "Estado:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $d_est; ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
								
	    <td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo "Tasa Inter&eacute;s:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo number_format($tasa, 2, '.',','); ?></td>
	</tr>
	<tr>
	    <td align="left" <b><?php echo "Tipo Operaci&oacute;n:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $d_ope; ?></td>
		<td align="left" ><?php echo encadenar(20); ?></td>	
							
	    <td align="left" ><?php echo encadenar(35); ?></td>
		<td align="left" <b><?php echo "Asesor:".encadenar(2); ?></b></td>
		<td align="left" ><?php echo  $nom_ases; ?></td>
	</tr>
	
	
	<?php
//	echo "Nro Cta FOndo **** ".$ncta."nro cred*****".$ncre;
	$con_fon  = "Select * From fond_maestro where FOND_NRO_CRED = $ncre and FOND_MAE_USR_BAJA is null"; 
    $res_fon = mysql_query($con_fon);
      while ($lin_fon = mysql_fetch_array($res_fon)) {
         $cod_cre2 = $lin_fon['FOND_NRO_CRED']; 
		 $cta = $lin_fon['FOND_NRO_CTA'];
		 
		 $tot_tre = 0;
		 $tot_tde = 0;
	   }
	   $cta = $_SESSION['ncta']; 
	 ?>
	 <tr>
	    <td align="left" <b><?php echo "Fondo de Garant&iacute;a".encadenar(2); ?></b></td>
		<td align="left" ><?php echo $cta; ?></td>
		<td align="left" ><?php echo encadenar(40); ?></td>	
		<th align="right" ><?php echo "Nro. Operaci&oacute;n".encadenar(2);; ?></td>						
	    <td align="left" ><?php echo $ncre; ?></td>
		<td align="left" <b><?php echo encadenar(20); ?></b></td>
		<td align="left" ><?php echo encadenar(20); ?></td>
	</tr>
	 
	</table>
	 <table border="1" width="800">
	
	<tr>
	    <th align="center" style="font-size:12px">FECHA </th> 
		<th align="center" style="font-size:12px">NRO. TRAN. FOND.</th> 
		<th align="center" style="font-size:12px">NRO. TRAN. CART.</th> 
	   	<th align="center" style="font-size:12px">TIP. TRAN.</th> 
		<th align="center" style="font-size:12px" >DEPOSITO</th>           
	    <th align="center" style="font-size:12px">RETIRO</th>
		<th align="center" style="font-size:12px">SALDO  </th>
  </tr>		
		  
		 <?php
		 $nom_grp = "";
		 $dep = 0;
		 $ret = "";
		 $saldo = 0;
		 $nro_tran = 0;
		 $tot_imp = 0;	
		  $tot_dep = 0;	
		  $tot_ret = 0;	
	  //Datos del cart_det_tran						
	
	$con_dtra  = "Select * From fond_det_tran where FOND_DTRA_NCTA = '$cta' and  FOND_DTRA_CCON = 212
	              and FOND_DTRA_USR_BAJA is null ";
    $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
			      $dep = 0 ;
				  $ret = 0;
	              $tot_imp = $lin_dtra['FOND_DTRA_IMPO'];
				  $t_tran = $lin_dtra['FOND_DTRA_TIP_TRAN'];
		          $nro_tran = $lin_dtra['FOND_DTRA_NRO_TRAN'];
				  $f_tran = $lin_dtra['FOND_DTRA_FECHA'];
				  $man_aut = $lin_dtra['FOND_DTRA_NRO_CTA'];
				  $f_tra = cambiaf_a_normal($f_tran);
				  if ($t_tran == 1){
				      $dep =  $tot_imp;
					  $saldo = $saldo + $dep;
					  $tot_dep = $tot_dep +$dep;

					}
			      if ($t_tran == 2){
			         $ret =  $tot_imp;
				     $saldo = $saldo - $ret;
					 $tot_ret = $tot_ret+$ret;
				    }	
		//		$p_tot  = $p_cap + $p_int + $p_iven + $p_aho + $p_otro;	
		$tran_cart = 0;
				if ($man_aut == 1){
				   $con_ctra  = "Select FOND_CAB_TRAN_CAR From fond_cabecera where FOND_CAB_NCTA = '$cta' 
				                 and  FOND_CAB_NRO_TRAN = $nro_tran and FOND_CAB_FECHA = '$f_tran'
	                             and FOND_CAB_USR_BAJA is null ";
                  $res_ctra = mysql_query($con_ctra);
   	              while ($lin_ctra = mysql_fetch_array($res_ctra)) { 
				         $tran_cart =  $lin_ctra['FOND_CAB_TRAN_CAR'];
				    	
		        }
				}
	$nro = $nro + 1;
	    //    }			
			?>
	<center>
	
	
	<tr>
	    <td align="left" ><?php echo $f_tra; ?></td>
		<td align="left" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>	
		<td align="left" ><?php echo number_format($tran_cart, 0, '.',''); ?></td>	
		<td align="left" ><?php if ($t_tran == 1 ){echo "Deposito";
		                            }else{echo "Retiro"; } ?></td>
		<td align="right" ><?php echo number_format($dep, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($ret, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
	</tr>	
	<?php
	
	//}
	
       }
	   
    ?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>	
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($tot_dep, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($tot_ret, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($tot_dep - $tot_ret, 2, '.',','); ?></td>
	</tr>
</table>		  
<br>
 
<?php
	}else{
			echo "No tiene FONDO DE GARANTIA";
		}
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

