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
<!--Titulo de la pesta�a de la pagina-->
<title>Cobro enviado por Creditos</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosInfoCred.js"></script>
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
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_creditos_infocred_validacion">
                    
                     <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> DATOS INFOCRED
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> VAL. DE NOMBRES
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">VALIDACION DE NOMBRES </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Verificando Consistencia
        </div>


           <?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 

           

<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
 ?>  
  
  <table border="1" width="450px">
	
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Cr�dito</th> 
		<th align="center">Grupo</th>
		<th align="center">Nombres</th>
		<th align="center">Apellido Paterno</th>
		<th align="center">Apellido Materno</th>
		<th align="center">Apellido Esposo</th>
		<th align="center">Sexo</th>
		<th align="center">Estado Civil</th>
		<th align="center">Asesor</th>
		
	</tr>	
  
 <?php  
 $con_cali  = "Select * From cart_califica where cart_cal_fec = '2012-08-31'"; 
$res_cali = mysql_query($con_cali);
$nro = 0;
   while ($lin_cali = mysql_fetch_array($res_cali)) {
         $cod_cred = $lin_cali['cart_cal_ncre']; 
   
 
$con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_cred and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);

   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
		 $tint = $lin_car['CART_TASA'];
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
		 $f_des2= cambiaf_a_normal($f_des); 
		  $of_res = $lin_car['CART_OFIC_RESP'];
		 $tcred = $lin_car['CART_TIPO_CRED'];
		  $nom_of  = leer_nombre_usr($tcred,$of_res); 
		 $nom_grp = "";
		 $cod_fon = 0;
		 $d_est = "";
		// $f_uno2= cambiaf_a_normal($f_uno);
		// echo $cod_sol;
   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
   $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				  }
if 	($c_grup > 0){			    
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}
}			
	$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_oper";
      $res_top = mysql_query($con_top);
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }	
	
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
	$con_fon = "Select * From fond_maestro where FOND_NRO_CRED = $cod_cre and FOND_MAE_USR_BAJA is null";
        $res_fon = mysql_query($con_fon);
	    while ($lin_fon = mysql_fetch_array($res_fon)) {
	        $cod_fon = $lin_fon['FOND_NRO_CTA'];
			$_SESSION['fondo'] = $cod_fon;
			}
			
	$con_deu = "Select * From cart_deudor where CART_DEU_NCRED = $cod_cre
	            and CART_DEU_USR_BAJA is null ";
        $res_deu = mysql_query($con_deu);
	    while ($lin_deu = mysql_fetch_array($res_deu)) {
		       $cod_cli = $lin_deu['CART_DEU_INTERNO'];
		 
		$codigo = 0;
		$con_cli = "Select * From  cliente_general where CLIENTE_COD = $cod_cli and
		           CLIENTE_EST_CIVIL = 1 
                   and CLIENTE_SEXO = 1
                   and CLIENTE_AP_ESPOSO <> ' ' and
	            CLIENTE_USR_BAJA is null ";
        $res_cli = mysql_query($con_cli);
	    while ($lin_cli = mysql_fetch_array($res_cli)) {
		//echo $cod_cli;
		    $codigo = 0;
		    $codigo = $lin_cli['CLIENTE_COD'];
	        $nom_cli = $lin_cli['CLIENTE_NOMBRES'];
			$ap_pate = $lin_cli['CLIENTE_AP_PATERNO'];
			$ap_mate = $lin_cli['CLIENTE_AP_MATERNO'];
			$ap_espo = $lin_cli['CLIENTE_AP_ESPOSO'];
			$sexo = "F";
			$est_civ = "SOLTERA";
			
			}
		if ($codigo > 0){
		    if ($of_res == "jesus"){
			   $act_cli = "update cliente_general set CLIENTE_EST_CIVIL = 2 
			    where CLIENTE_COD = $cod_cli 
		           
                   and CLIENTE_SEXO = 1
                   and CLIENTE_AP_ESPOSO <> ' ' and
	            CLIENTE_USR_BAJA is null ";
        $res_act = mysql_query($act_cli);
	    while ($lin_act = mysql_fetch_array($res_act)) {
		    echo "act".$cod_cli;
			}	
	}		
		    $nro = $nro + 1;
			?>
	<center>
	
				 
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $cod_cre; ?></td>
	    <td align="left" ><?php echo $nom_grp; ?></td>
		<td align="left" ><?php echo $nom_cli; ?></td>
		<td align="left" ><?php echo $ap_pate; ?></td>
		<td align="right" ><?php echo $ap_mate; ?></td>
		<td align="right" ><?php echo $ap_espo; ?></td>
		<td align="left" ><?php echo $sexo; ?></td>
		<td align="left" ><?php echo $est_civ; ?></td>
		<td align="left" ><?php echo $nom_of; ?></td>
		
	</tr>	
	<?php
    	
	
	}		
				
			}	

	   }
	   }
    ?>	  
</table>		  

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

