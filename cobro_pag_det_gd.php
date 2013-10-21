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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_cobros_cart_dir_group_sel_modif.js"></script>  
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
                  <li id="menu_modulo_cajas_cob">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cajas_cob_group">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
                 <li id="menu_modulo_cajas_cob_group_sel_modif">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SELECCIONAR GRUPO
                    
                 </li>
                 <li id="menu_modulo_fondogrupo">
                    
                     <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR GRUPO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle">MODIFICAR GRUPO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
				          <img src="img/alert_32x32.png" align="absmiddle">
				          Elija el Grupo para modificar
				        </div>
    	

	<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $_SESSION['calculo'] = 1; 
?> 

<font size="+1">
<?php
//$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login']; 
$cod_cre = 0;
$f_cal = "";
$f_has ="";
$mon="";
$imp_ind = 0;
$imp_cta = 0;
//$_SESSION['grupo'] = "";
//$_SESSION['cod_gru'] = ""; 
if(isset($_SESSION['f_has'])){
  $f_has = $_SESSION['f_has'];
  }
//$imp_sol = $_SESSION["impo_sol"];
//echo $_SESSION['nro_sol'], "codigo sol";
$total = 0;
if ( $_SESSION['continuar'] == 2) {
   $quecom = $_POST['cod_grupo'];
   if ($quecom == "" ) {
         header('Location:grupo_con_cob.php');
       }
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_gru = $quecom[$i];
	      $_SESSION['cod_gru'] = $cod_gru;
       }
	   
   } 
   }else{
   
   $cod_gru = $_SESSION['cod_gru'];
   echo "Debe Marcar uno de los creditos";
   }
  
   $consulta  = "Select * from cred_grupo where CRED_GRP_CODIGO = $cod_gru and CRED_GRP_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   while ($linea = mysql_fetch_array($resultado)) {
	     $nom_com = $linea['CRED_GRP_NOMBRE'];
		  $_SESSION['nombre'] = $nom_com;
	    }
  if ($_SESSION['cart_fgar'] == 1){ 
       
      $con_cli  = "Select * From cart_maestro where CART_COD_GRUPO = $cod_gru 
      and CART_ESTADO  < 8 and CART_MAE_USR_BAJA is null order by CART_FEC_DES"; 
   }
   if ($_SESSION['cart_fgar'] == 3){  
      $con_cli  = "Select * From cart_maestro where CART_COD_GRUPO = $cod_gru 
      and CART_ESTADO = 9 and CART_FCH_CAN is not null and CART_MAE_USR_BAJA is null order by CART_FEC_DES"; 
   }
			 
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse cart_maestro 1');
 ?>
 <form name="form2" method="post" action="cobro_retro_opd.php"  onSubmit="return ValidaCamposClientes(this)"> 
 <?php
   echo "Grupo".encadenar(3).$nom_com;
 ?>
 <!--div id="TableModulo">
 <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
      <th width="22%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />NRO. CREDITO</th>
	  <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />TITULAR/COORDINADORA</th>
      <th width="20%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />GRUPO</th>
      <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />IMP. DESEM.</th>
	  <th width="25%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />SALDO</th>
	  <th width="32%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />MONEDA</th>
	  <th width="32%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />ESTADO</th>
	  <th width="32%" scope="col" style="font-size:10px" ><border="0" alt="" align="absmiddle" />TIPO OPERACION</th>
	  <th width="32%" scope="col"style="font-size:10px" ><border="0" alt="" align="absmiddle" />ASESOR</th>
	  <th width="20%" scope="col" style="font-size:10px"><border="0" alt="" align="absmiddle" />CAL</th>
	  </tr>
	
   <?php
   while ($lin_cli = mysql_fetch_array($res_cli)){
          $cod_ncre = $lin_cli['CART_NRO_CRED'];
		  $mon_pag = montos_recuperados($cod_ncre,$fec,1); 
	 if ($_SESSION['cart_fgar'] == 1){ 	  
	     $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_ncre and CART_ESTADO  < 8 and
	               CART_MAE_USR_BAJA is null"; 
	}
	 if ($_SESSION['cart_fgar'] == 3){ 	  
	     $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_ncre and CART_ESTADO  = 9
		              and CART_FCH_CAN is not null and  CART_MAE_USR_BAJA is null"; 
	}			   
      $res_car = mysql_query($con_car)or die('No pudo seleccionarse cart_maestro 2');
          
	  while ($lin_car = mysql_fetch_array($res_car)) {
	        $nom_grp = " ";
	  
	        $cod_sol = $lin_car['CART_NRO_SOL']; 
		    $impo = $lin_car['CART_IMPORTE'];
		    $mon = $lin_car['CART_COD_MON'];
		    $tint = $lin_car['CART_TASA'];
			$est =  $lin_car['CART_ESTADO'];
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
			$asesor = $lin_car['CART_OFIC_RESP'];
			$t_cred = $lin_car['CART_TIPO_CRED'];
			$_SESSION['mon'] = $mon;
			$f_des2= cambiaf_a_normal($f_des); 
			 $nom_ases = leer_nombre_usr($t_cred,$asesor);
		    $con_deu  = "Select * From cart_deudor, cliente_general
             where CART_DEU_NCRED = $cod_ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_deu = mysql_query($con_deu)or die('No pudo seleccionarse cart_deudor, cliente_general');
             while ($lin_deu = mysql_fetch_array($res_deu)) {
			       // $c_grup = 0;
					//$nom_ases = "";
	                $nom_cli = $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_deu['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_deu['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_deu['CLIENTE_NOMBRES'].encadenar(1);
					$ci = $lin_deu['CLIENTE_COD_ID'];
					 $_SESSION['nombre'] =  $nom_cli;
					 $_SESSION['ci'] = $ci;
					$cod_sold = $lin_deu['CART_DEU_SOL'];
			        $cod_cli = $lin_deu['CART_DEU_INTERNO']; 
				//	echo $cod_sold,"sold", $cod_cli,"c_cli";
		
		}
		   if ($t_cred == 1) { 
		      
		      $f_uno2= cambiaf_a_normal($f_uno);
			  
		      $con_sol  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sold and CRED_DEU_INTERNO = $cod_cli
		               and CRED_DEU_USR_BAJA is null"; 
              $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse cred_deudor');
		      while ($lin_csol = mysql_fetch_array($res_sol)){
		         $imp_ind = $lin_csol ['CRED_DEU_IMPORTE'];          
				 }
		      $con_cta  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sold and CRED_PLD_COD_CLI = $cod_cli
		               and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
              $res_cta = mysql_query($con_cta)or die('No pudo seleccionarse cred_plandp');
		      while ($lin_cta = mysql_fetch_array($res_cta)){
		         $imp_cta = $lin_cta['CRED_PLD_CAPITAL'] + $lin_cta['CRED_PLD_INTERES'] + $lin_cta['CRED_PLD_AHORRO'];          		 } 
			 $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
             $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 4')  ;
	         while ($linea = mysql_fetch_array($res_cin)) {
	               $d_cin = $linea['GRAL_PAR_INT_DESC'];
	             }
		      }
                
				 
		$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $t_prod";
        $res_dpro = mysql_query($con_dpro)or die('No pudo seleccionarse tabla');
        while ($lin_dpro = mysql_fetch_array($res_dpro)) {
               $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	     }
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
        $res_dope = mysql_query($con_dope)or die('No pudo seleccionarse tabla');
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
		      
		$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}		 
		}
	$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
        $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla est');
	      while ($linea = mysql_fetch_array($res_est)) {
	             $d_est = $linea['GRAL_PAR_PRO_DESC'];
	             $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	         }		
			 
       $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 3')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
      
  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 5')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				
		  }
	
	  	?>
		       <?php if ($t_prod == 1){ ?>
			        <td bgcolor="#66CCFF"><?php echo $cod_ncre; ?></td>
					<td bgcolor="#66CCFF"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#66CCFF"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#66CCFF"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#66CCFF"><?php echo number_format($impo - $mon_pag, 2, '.',',');  ?></td>
					<td bgcolor="#66CCFF"><?php echo $d_mon; ?></td>
					<td bgcolor="#66CCFF"><?php echo $s_est;  ?></td>
                    <td bgcolor="#66CCFF"><?php echo $d_ope; ?></td>
					<td bgcolor="#66CCFF"><?php echo $nom_ases; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>">	</td> 


					<?php }?>
				 <?php if ($t_prod == 2){ ?>
			        <td bgcolor="#FFFF33"><?php echo $cod_ncre; ?></td>
					<td bgcolor="#FFFF33"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#FFFF33"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#FFFF33"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33"><?php echo number_format($impo - $mon_pag, 2, '.',',');  ?></td>
					<td bgcolor="#FFFF33" ><?php echo $d_mon; ?></td>
					<td bgcolor="#FFFF33"><?php echo $s_est;  ?></td>
                    <td bgcolor="#FFFF33"><?php echo $d_ope; ?></td>
					<td bgcolor="#FFFF33" ><?php echo $nom_ases; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td>  
					<?php }?>
					<?php if ($t_prod == 3){ ?>
			        <td bgcolor="#66CC66"><?php echo $cod_ncre; ?></td>
					<td bgcolor="#66CC66"><?php echo $nom_cli; ?></td>
                    <td bgcolor="#66CC66"><?php echo $nom_grp; ?></td>
                    <td bgcolor="#66CC66"><?php echo number_format($impo, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66"><?php echo number_format($impo - $mon_pag, 2, '.',',');  ?></td>
					<td bgcolor="#66CC66" ><?php echo $d_mon; ?></td>
					<td bgcolor="#66CC66"><?php echo $s_est;  ?></td>
                    <td bgcolor="#66CC66"><?php echo $d_ope; ?></td>
					<td bgcolor="#66CC66" ><?php echo $nom_ases; ?></td>
					<td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>"></td> 
					<?php }?>		
					
		</font>			
	 </tr>
                  <?php }?>
               
                </table>
            </div >
	<?php //if ($_SESSION['cargo'] == 4){ ?>			
	
	 <?php  if ($_SESSION['cart_fgar'] == 1){ ?>
	 <input class="btn_form" type="submit" name="accion" value="Detalle">
	  <?php }?>       
	<input class="btn_form" type="submit" name="accion" value="Kardex">
	<input class="btn_form" type="submit" name="accion" value="Mov. Fondo Gar">
	<input class="btn_form" type="submit" name="accion" value="Plan de Pagos">
	<input class="btn_form" type="submit" name="accion" value="Boleta de Cobro">
	<input class="btn_form" type="submit" name="accion" value="Seguimiento de Pagos">
    <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
	 
</form>			
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