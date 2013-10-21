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
<title>Crea Titular Fondo</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	
	<div id="cuerpoModulo">
<?php
				include("header.php");
			?>
            
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Crea Mesa Directiva Grupo
            </div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
 ?>  
  
  <table border="1" width="1300">
	
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Crédito</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Moneda</th>
		<th align="center">Monto</th>
		<th align="center">Cta Fondo</th>
		<th align="center">Dep. Fondo</th>
		<th align="center">Ret. Fondo</th>
		<th align="center">Saldo</th>
	</tr>	
   <?php 
 $gru = "0"; 
$con_car  = "Select CART_NRO_CRED,CART_IMPORTE,CART_COD_MON,CART_COD_GRUPO
             From cart_maestro where CART_ESTADO < 8 
			 and CART_COD_MON = 2 and CART_TIPO_CRED = 2
			 and CART_MAE_USR_BAJA is null
			                          "; 
$res_car = mysql_query($con_car)or die('No pudo seleccionar cart_maestro');
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $nro = $nro + 1;
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		// $imp_c = $lin_car['CART_IMP_COM'];
		// $tint = $lin_car['CART_TASA'];
		 $mon = $lin_car['CART_COD_MON'];
		// $t_oper = $lin_car['CART_TIPO_OPER'];
		// $t_prod = $lin_car['CART_PRODUCTO'];
		// $cuotas = $lin_car['CART_NRO_CTAS'];
		// $f_pag = $lin_car['CART_FORM_PAG'];
		// $ahod = $lin_car['CART_AHO_DUR'];
		// $f_des = $lin_car['CART_FEC_DES'];
		// $f_uno = $lin_car['CART_FEC_UNO'];
		// $c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		// $estado = $lin_car['CART_ESTADO'];
		// $f_des2= cambiaf_a_normal($f_des); 
		 $nom_grp = "";
		 $cod_fon = 0;
		 $d_est = "";
		// $f_uno2= cambiaf_a_normal($f_uno);
		// echo $cod_sol;
   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
       $con_fga = "Select FOND_NRO_CTA From fond_maestro where 
                   FOND_NRO_CRED = $cod_cre";
       $res_fga = mysql_query($con_fga)or die('No pudo seleccionarse tabla 3')  ;
          while ($lin_fga = mysql_fetch_array($res_fga)) {
		        $nro_cta = $lin_fga['FOND_NRO_CTA'];
				//$fpag_d = $lin_fga['GRAL_PAR_INT_DESC'];
		  }
		  
if ($c_grup > 0){		    
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}
}
$tot_tde = 0;
$tot_tre = 0;

 $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $nro_cta 
		       and FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra)or die('No pudo leer : fond_det_tran ' . mysql_error()) ;
         while ($lin_dtra = mysql_fetch_array($res_dtra)) { // 2a
                $tot_tde = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	   	        } // 2c
				
	     $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $nro_cta 
		               and  FOND_DTRA_CCON = 212 and 
                       FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_USR_BAJA is null ";
         $res_dtra = mysql_query($con_dtra)or die('No pudo leer : fond_det_tran ' . mysql_error()) ;
   	     while ($lin_dtra = mysql_fetch_array($res_dtra)) {   // 3a
	            $tot_tre = $lin_dtra['sum(FOND_DTRA_IMPO)'];
	        } // 3c
		 $saldo = $tot_tde - $tot_tre;

$con_cli  = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_AP_ESPOSO, CLIENTE_NOMBRES, CART_DEU_ID,CART_DEU_INTERNO 
             From cart_deudor, cliente_general
             where CART_DEU_NCRED = $cod_cre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CLIENTE_USR_BAJA is null"; 
             $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse cart_deudor, cliente_general');
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
	               // $c_grup = 0;
					$nom_cli = "-";
	             //   $mon = $lin_car['CART_COD_MON'];
			//		$tcred = $lin_car['CART_TIPO_CRED'];
			//		$asesor = $lin_car['CART_OFIC_RESP'];
					$cod_int = $lin_cli['CART_DEU_INTERNO'];
			        $cod_id = $lin_cli['CART_DEU_ID'];  
					$nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_cli['CLIENTE_NOMBRES'].encadenar(1); 
			 $con_ccli = "insert into fond_cliente (FOND_CLI_NCTA, 
                                         FOND_CLI_SOL,
										 FOND_CLI_RELACION,
										 FOND_CLI_INTERNO, 
										 FOND_CLI_ID, 
										 FOND_CLI_USR_ALTA, 
										 FOND_CLI_FCH_HR_ALTA, 
										 FOND_CLI_USR_BAJA, 
										 FOND_CLI_FCH_HR_BAJA) 
										 values ($nro_cta,
										         0,
												 'T',
												 $cod_int,
												 '$cod_id',
												 '$logi', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_ccli = mysql_query($con_ccli)or die('No pudo insertar : cart_deudor ' . mysql_error());		
	}				

			
/*			
	$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_oper";
      $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }	
	
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla');
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
	$con_fon = "Select * From fond_maestro where FOND_NRO_CRED = $cod_cre and FOND_MAE_USR_BAJA is null";
        $res_fon = mysql_query($con_fon)or die('No pudo seleccionarse tabla fond_maestro')  ;
	    while ($lin_fon = mysql_fetch_array($res_fon)) {
	        $cod_fon = $lin_fon['FOND_NRO_CTA'];
			$_SESSION['fondo'] = $cod_fon;
			}
	$con_cli = "Select * From cart_deudor, cliente_general where CART_DEU_NCRED = $cod_cre
	            and CLIENTE_COD_ID = CART_DEU_ID  and CART_DEU_RELACION = 'C' 
	           and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla cart_deudor, cliente_general')  ;
	    while ($lin_cli = mysql_fetch_array($res_cli)) {
	        $nom_cli = $lin_cli['CLIENTE_NOMBRES'].encadenar(2).
			           $lin_cli['CLIENTE_AP_PATERNO'].encadenar(2).
					   $lin_cli['CLIENTE_AP_MATERNO'].encadenar(2).
					   $lin_cli['CLIENTE_AP_ESPOSO'].encadenar(2);
			}	
				
	*/	
		
/*	$con_mes = "Select * From cart_deudor, cliente_general where CART_DEU_NCRED = $cod_cre
	            and CLIENTE_COD_ID = CART_DEU_ID   
	           and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $res_mes = mysql_query($con_mes)or die('No pudo seleccionarse tabla cart_deudor, cliente_general')  ;
	    $mes_rel2 = 1;
	    while ($lin_mes = mysql_fetch_array($res_mes)) {
		    $mes_rel = $lin_mes['CART_DEU_RELACION'];
	        $mes_cli = $lin_mes['CLIENTE_COD'];
			if ($mes_rel == "C"){
			    $mes_rel2 = 1;
			}else{
			    $mes_rel2 = $mes_rel2 + 1;
			}	
		
	  if ($mes_rel2 < 4){
			  $consulta  = "Insert into cred_grupo_mesa(CRED_GRP_MES_COD,
	                                           CRED_GRP_MES_CLI,
	                                           CRED_GRP_MES_REL,
											   CRED_GRP_MES_USR_ALTA,
											   CRED_GRP_MES_FCH_HR_ALTA,
											   CRED_GRP_MES_USR_BAJA,
											   CRED_GRP_MES_FCH_HR_BAJA) values
											   ($c_grup,
											    $mes_cli,
											    $mes_rel2,
											    '$log_usr',
											    null,
											    null,
											     '0000-00-00 00:00:00')";

$resultado = mysql_query($consulta)or die('No pudo insertar : cart_deudor ' . mysql_error());
         
			}	
	}			
	*/	
	if ($saldo > 0){
		
//	if ($tot_tre = ""){
//        $tot_tre = 0;
//		echo "tot_tre ".$tot_tre;	
//	}

	 $consulta = "insert into temp_fondo (TEMP_CTA,
	                                          TEMP_CRED, 
                                              TEMP_NOM,
						 	                  TEMP_DEP,
									          TEMP_RET,
										      TEMP_SAL
									          ) values
										      ($nro_cta,
										       '$cod_cre',
									          '$nom_cli',
										      $tot_tde,
										      0,
										      $saldo)";
										   
         $resultado = mysql_query($consulta)or die('No pudo insertar temp_fondo : ' . mysql_error());
	
			?>	
	<center>
					 
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $cod_cre; ?></td>
	    <td align="left" ><?php echo $nom_cli ; ?></td>
       	<td align="left" ><?php echo $nom_grp; ?></td>
		<td align="left" ><?php echo $d_mon; ?></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
		<td align="left" ><?php echo $nro_cta; ?></td>
		<td align="right" ><?php echo number_format($tot_tde, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_tre, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
				
	</tr>	
	<?php
       }
	  } 
    ?>	  
</table>		  
<br>
 

<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Verificando Consistencia</MARQUEE></FONT></B>
</div>


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

