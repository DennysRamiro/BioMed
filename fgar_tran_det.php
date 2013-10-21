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
<title>Consulta Entrada / Salida Fondo Garantia</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/fondo_dr_cliente_consultar_modif.js"></script>  
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
                 <li id="menu_modulo_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS RETIROS
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret_cliente">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE CLIENTE
                    
                 </li>
                    <li id="menu_modulo_fondo_dep_ret_cliente_modif">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret_modif">
                    
                     <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR CLIENTE
                    
                 </li>
                    </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle">MODIFICAR CLIENTE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          
        </div>
 

    	
           
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
	<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $_SESSION['calculo'] = 1; 
?> 

           
<font size="+1">
 <div id="TableModulo">
 <center>
<?php
//$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login']; 
$cod_cre = 0;
$f_cal = "";
$f_has ="";
$mon="";
$imp_ind = 0;
$imp_cta = 0;
$par_cre = 0;
$dep = 0;
$ret = 0;
$_SESSION['grupo'] = "";
$_SESSION['cart_fgar'] = 2;
if(isset($_SESSION['f_has'])){
  $f_has = $_SESSION['f_has'];
  }
//$imp_sol = $_SESSION["impo_sol"];
//echo $_SESSION['nro_sol'], "codigo sol";
$total = 0;
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_cliente'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_cli = $quecom[$i];
	      $_SESSION['cod_cli'] = $cod_cli;
       }
   } 
   }else{
   $cod_cli = $_SESSION['cod_cli'];
   }
  
   $consulta  = "Select * from cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   while ($linea = mysql_fetch_array($resultado)) {
	     $nom_com = $linea['CLIENTE_AP_PATERNO']. " ". $linea['CLIENTE_AP_MATERNO']." ".
		 $linea['CLIENTE_AP_ESPOSO']." ".$linea['CLIENTE_NOMBRES'];
		  $_SESSION['nombre'] = $nom_com;
		  $cod_ci = $linea['CLIENTE_COD_ID'];
	    }
 $estad = 0;
$cot_cli  = "Select count(*) From fond_cliente, fond_maestro where  FOND_CLI_INTERNO = $cod_cli 
             and FOND_CLI_NCTA = FOND_NRO_CTA
			 and FOND_CLI_RELACION = 'T'
			 and FOND_MAE_USR_BAJA is null
			 and FOND_CLI_USR_BAJA is null "; 
$ret_cli = mysql_query($cot_cli);
 while ($lin_trc = mysql_fetch_array($ret_cli)) {
         $estad =  $lin_trc['count(*)'];
		 }
 //echo $estad;  
$con_cli  = "Select * From cart_deudor, cart_maestro, fond_maestro where  CART_DEU_INTERNO = $cod_cli 
             and CART_NRO_CRED = CART_DEU_NCRED and FOND_NRO_CRED = CART_NRO_CRED
			 and CART_DEU_IMPORTE > 0
			 and CART_TIPO_OPER <> 2
			 and CART_DEU_USR_BAJA is null
			 and CART_MAE_USR_BAJA is null and FOND_MAE_USR_BAJA is null"; 
$res_cli = mysql_query($con_cli);
 ?>
 <form name="form2" method="post" action="cobro_retro_opd.php" style="border:groove" onSubmit="return ValidaCamposClientes(this)"> 
 <?php
   echo $cod_cli.encadenar(2).$nom_com;
 ?>
 <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="22%" scope="col"><border="0" alt="" align="absmiddle" />NUMERO CUENTA</th>
	  <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />NUMERO CREDITO</th>
      <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />GRUPO</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>
      <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE DEPOSITOS</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE RETIROS</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />SALDO</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />PRODUCTO</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />PROCESAR</th>
	  </tr>
   
	
   <?php
   while ($lin_cli = mysql_fetch_array($res_cli)){ 
     
          $par_cre = 1;
          $cod_ncre = $lin_cli['CART_DEU_NCRED'];
		  $cod_cta = $lin_cli['FOND_NRO_CTA'];
		  
		  $_SESSION['cta_fon'] = $cod_cta;
		  
	  $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_ncre  and
	               CART_MAE_USR_BAJA is null"; 
      $res_car = mysql_query($con_car);
          
	  while ($lin_car = mysql_fetch_array($res_car)) {
	        $nom_grp = " ";
	  
	        $cod_sol = $lin_car['CART_NRO_SOL']; 
		    $impo = $lin_car['CART_IMPORTE'];
		    $mon = $lin_car['CART_COD_MON'];
		    $tint = $lin_car['CART_TASA'];
			$tope = $lin_car['CART_TIPO_OPER'];
		    $plzm = $lin_car['CART_PLZO_M'];
		    $plzd = $lin_car['CART_PLZO_D'];
		    $cuotas = $lin_car['CART_NRO_CTAS'];
		    $c_int = $lin_car['CART_CAL_INT'];
		    $f_pag = $lin_car['CART_FORM_PAG'];
		    $ahod = $lin_car['CART_AHO_DUR'];
		    $f_des = $lin_car['CART_FEC_DES'];
		    $f_uno = $lin_car['CART_FEC_UNO'];
		    $c_agen = $lin_car['CART_COD_AGEN'];
			$c_grup = $lin_car['CART_COD_GRUPO'];
			$t_prod = $lin_car['CART_PRODUCTO'];
			$t_cred = $lin_car['CART_TIPO_CRED'];
			$asesor = $lin_car['CART_OFIC_RESP'];
			$nom_ases = leer_nombre_usr($t_cred,$asesor);
			 $_SESSION['nom_ases'] = $nom_ases;
			$f_des2= cambiaf_a_normal($f_des); 
		    
		   if ($t_cred == 1) { 
		      $cod_sold = $lin_cli['CART_DEU_SOL'];
		      $f_uno2= cambiaf_a_normal($f_uno);
			  
		      $con_sol  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sold and CRED_DEU_INTERNO = $cod_cli
		               and CRED_DEU_USR_BAJA is null"; 
              $res_sol = mysql_query($con_sol);
		      while ($lin_csol = mysql_fetch_array($res_sol)){
		         $imp_ind = $lin_csol ['CRED_DEU_IMPORTE'];          
				 }
		      $con_cta  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sold and CRED_PLD_COD_CLI = $cod_cli
		               and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
              $res_cta = mysql_query($con_cta);
		      while ($lin_cta = mysql_fetch_array($res_cta)){
		         $imp_cta = $lin_cta['CRED_PLD_CAPITAL'] + $lin_cta['CRED_PLD_INTERES'] + $lin_cta['CRED_PLD_AHORRO'];          		               } 
			 $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
             $res_cin = mysql_query($con_cin);
	         while ($linea = mysql_fetch_array($res_cin)) {
	               $d_cin = $linea['GRAL_PAR_INT_DESC'];
	             }
		      }
                
				 
		$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $t_prod";
        $res_dpro = mysql_query($con_dpro);
        while ($lin_dpro = mysql_fetch_array($res_dpro)) {
               $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	     }
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
        $res_dope = mysql_query($con_dope);
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
	if ($tope < 3){	 
		$_SESSION['grupo'] = "";      
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
			 
       $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$_SESSION['d_mon'] = $d_mon;
	   }
      
  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				
		  }
	 $saldo = 0;
	 $dep = 0 ;
	 $ret = 0;
	$con_dtra  = "Select * From fond_det_tran where FOND_DTRA_NCTA = '$cod_cta' 
	              and  FOND_DTRA_CCON = 212
	              and FOND_DTRA_USR_BAJA is null ";
    $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
			     
			      
	              $tot_imp = $lin_dtra['FOND_DTRA_IMPO'];
				  $t_tran = $lin_dtra['FOND_DTRA_TIP_TRAN'];
		          $nro_tran = $lin_dtra['FOND_DTRA_NRO_TRAN'];
				  $f_tran = $lin_dtra['FOND_DTRA_FECHA'];
				  $f_tra = cambiaf_a_normal($f_tran);
				  if ($t_tran == 1){
				      $dep =  $dep + $tot_imp;
					//  $saldo = $saldo + $dep;
					}
			      if ($t_tran == 2){
			         $ret =  $ret + $tot_imp;
				    // $saldo = $saldo - $ret;
				    }	
				}		  
	      $saldo = $dep - $ret;
		  $_SESSION['saldo_cta'] = $saldo;
	  	?>
		       <?php if ($tope == 1){ ?>
			        <td bgcolor="#66CCFF"><?php echo $cod_cta; ?></td> 
			        <td bgcolor="#66CCFF"><?php echo $cod_ncre; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $nom_grp; ?></td>
					<td bgcolor="#66CCFF"><?php echo $d_mon; ?></td>
                    <td bgcolor="#66CCFF" align="right"><?php echo number_format($dep, 2, '.',',');  ?></td>
					<td bgcolor="#66CCFF" align="right"  ><?php echo number_format($ret, 2, '.',',');  ?></td>
					<td bgcolor="#66CCFF" align="right"><?php echo number_format($saldo, 2, '.',',');  ?></td>
	                <td bgcolor="#66CCFF"><?php echo $d_ope; ?></td>
					<td><INPUT NAME="ncta" TYPE=RADIO VALUE="<?php echo $cod_cta."*".$cod_ncre; ?>">	</td> 
					<?php }?>
				 <?php if ($tope == 2){ ?>
				    <td bgcolor="#FFFF33"><?php echo $cod_cta; ?></td> 
			        <td bgcolor="#FFFF33"><?php echo $cod_ncre; ?></td>
                    <td bgcolor="#FFFF33"><?php echo $nom_grp; ?></td>
					<td bgcolor="#FFFF33" ><?php echo $d_mon; ?></td>
                    <td bgcolor="#FFFF33"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33"><?php echo number_format($imp_ind, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33"><?php echo number_format($imp_cta, 2, '.',',');  ?></td>
	                <td bgcolor="#FFFF33"><?php echo $d_ope; ?></td>
					<td><INPUT NAME="ncta" TYPE=RADIO VALUE="<?php echo $cod_cta."*".$cod_ncre; ?>"></td>  
					<?php }?>
					<?php if ($tope == 3){ ?>
			        <td bgcolor="#66CC66"><?php echo $cod_cta; ?></td> 
			        <td bgcolor="#66CC66"><?php echo $cod_ncre; ?></td>
                    <td bgcolor="#66CC66"><?php echo $nom_grp; ?></td>
					<td bgcolor="#66CC66"><?php echo $d_mon; ?></td>
                    <td bgcolor="#66CC66" align="right"><?php echo number_format($dep, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66" align="right"  ><?php echo number_format($ret, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66" align="right"><?php echo number_format($saldo, 2, '.',',');  ?></td>
	                <td bgcolor="#66CC66"><?php echo $d_ope; ?></td>
					<td><INPUT NAME="ncta" TYPE=RADIO VALUE="<?php echo $cod_cta."*".$cod_ncre; ?>"></td> 
					<?php }?>		
					
		</font>			
	 </tr>
	
                  <?php }
	if ($estad > 0){
	    $par_cre = 0;
		}			  
	if ($par_cre == 0){	
	    $dep = 0;
		$ret = 0;
		$saldo = 0;	  
		$con_cli  = "Select * From fond_cliente, fond_maestro where  FOND_CLI_ID = '$cod_ci'
             and FOND_NRO_CTA = FOND_CLI_NCTA  and
			 FOND_ESTADO = 3 and 
			 FOND_TIPO_OPER = 2
			 and FOND_CLI_USR_BAJA is null and FOND_MAE_USR_BAJA is null"; 
        $res_cli = mysql_query($con_cli);	
		
	while ($lin_cli = mysql_fetch_array($res_cli)){ 
	      $cod_cta = $lin_cli['FOND_NRO_CTA'];
	      $mon = $lin_cli['FOND_COD_MON'];
		  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
          $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$_SESSION['d_mon'] = $d_mon;
	   }
      $con_dtra  = "Select * From fond_det_tran where FOND_DTRA_NCTA = '$cod_cta' 
	              and  FOND_DTRA_CCON = 212
	              and FOND_DTRA_USR_BAJA is null ";
      $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
			     
			      
	              $tot_imp = $lin_dtra['FOND_DTRA_IMPO'];
				  $t_tran = $lin_dtra['FOND_DTRA_TIP_TRAN'];
		          $nro_tran = $lin_dtra['FOND_DTRA_NRO_TRAN'];
				  $f_tran = $lin_dtra['FOND_DTRA_FECHA'];
				  $f_tra = cambiaf_a_normal($f_tran);
				  if ($t_tran == 1){
				      $dep =  $dep + $tot_imp;
					//  $saldo = $saldo + $dep;
					}
			      if ($t_tran == 2){
			         $ret =  $ret + $tot_imp;
				    // $saldo = $saldo - $ret;
				    }	
				}		  
	      $saldo = $dep - $ret;
		  $_SESSION['saldo_cta'] = $saldo;
		  
		  
		  
	?>
	   <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
   <tr>
      <th width="22%" scope="col"><border="0" alt="" align="absmiddle" />NUMERO CUENTA</th>
	  <th width="35%" scope="col"><border="0" alt="" align="absmiddle" />CLIENTE</th>
      <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>
      <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE DEPOSITOS</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE RETIROS</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />SALDO</th>
	  <th width="32%" scope="col"><border="0" alt="" align="absmiddle" />PRODUCTO</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />PROCESAR</th>
	  </tr>
	
	<?php		  
		$consulta  = "Select * from cliente_general where CLIENTE_COD_ID = '$cod_ci' and CLIENTE_USR_BAJA is null ";
        $resultado = mysql_query($consulta);
        while ($linea = mysql_fetch_array($resultado)) {
	          $nom_com = $linea['CLIENTE_AP_PATERNO']. " ". $linea['CLIENTE_AP_MATERNO']." ".
		      $linea['CLIENTE_AP_ESPOSO']." ".$linea['CLIENTE_NOMBRES'];
		      $_SESSION['nombre'] = $nom_com;
		      $cod_ci = $linea['CLIENTE_COD_ID'];
			  $d_ope = "Particular";
	       }
	  ?>	  
		      <td bgcolor="#99FFCC"><?php echo $cod_cta; ?></td> 
			  <td  bgcolor="#99FFCC" ><?php echo $nom_com; ?></td>
			  <td bgcolor="#99FFCC"><?php echo $d_mon; ?></td>
              <td bgcolor="#99FFCC" align="right"><?php echo number_format($dep, 2, '.',',');  ?></td>
			  <td bgcolor="#99FFCC" align="right"  ><?php echo number_format($ret, 2, '.',',');  ?></td>
			  <td bgcolor="#99FFCC" align="right"><?php echo number_format($saldo, 2, '.',',');  ?></td>
	          <td bgcolor="#99FFCC"><?php echo $d_ope; ?></td>
			  <td><INPUT NAME="ncta" TYPE=RADIO VALUE="<?php echo $cod_cta; ?>">	</td> 
			<?php				  
		//	echo $cod_ci.encadenar(2).$nom_com;	  
		}			  
			}		  
			  ?>
    </table>
            </div id="TableModulo2">
    <center>
	<?php if ($_SESSION['cargo'] == 4){ ?>			
	<input class="btn_form" type="submit" name="accion" value="Deposito">
	<input class="btn_form" type="submit" name="accion" value="Retiro">
	<input class="btn_form" type="submit" name="accion" value="Salir">
	 <?php }else{?>
	
	<input class="btn_form" type="submit" name="accion" value="Mov. Fondo Gar">
    <input class="btn_form" type="submit" name="accion" value="Salir">
	  <?php }?>		
			
</form>			
         
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