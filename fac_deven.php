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
	require('d:\wamp\www\cc7\lib7\libreriaCC7.php');
?>
<html>
<head>
<title>Devengamiento de Intereses</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
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
 $f_pro = cambiaf_a_mysql_2($fec);
 $logi = $_SESSION['login'];
 $borr_tras  = "Delete From temp_trasp"; 
 $cob_tras = mysql_query($borr_tras)or die('No pudo borrar temp_trasp');
 ?>
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                      Devengamiento de Intereses 
			</div>
            <div id="AtrasBoton">
           	<a href="menu_s.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0"  alt="Regresar" align="absmiddle">Atras</a>
            </div>
<font size="+1">
<div id="TableModulo2" >
<form name= "form2" method="post" action= "cobro_retro_opd.php" style= "border:groove" onSubmit= "return">  
<?php
$_SESSION['continuar'] = 0;
 if ($_SESSION['cargo'] == 2){ 
      echo "Usuario no Habilitado para este proceso ".encadenar(2)." !!!!!";
      $_SESSION['continuar'] = 1;
	  
?>
<br>
<center>
  <input type="submit" name="accion" value="Salir_Opc">
     
</form>	
<?php
  }
if ($_SESSION['continuar'] == 0){
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$est1 = 3;
$est2 = 7;
$cas = "";
$fec_pro = $_POST['fec_nac'] ;
$f_pro = cambiaf_a_mysql($fec_pro); 
?> 
 <font size="+2"  style="" >
<?php
echo encadenar(25)."Facturacion de Interes Devengado al".encadenar(3).$fec_pro;
?>
</font>



<center>
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">Nro Tran</th> 
		<th align="center">Nro Fac</th> 
	   	<th align="center">Nro. Crédito</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">NIT</th>
		<th align="center">Monto</th>
		<th align="center">Cod. Control </th>
		
	  </tr>	
<?php
  
     
  
$con_dtra  = "Select * From cart_det_tran where CART_DTRA_FECHA = '$f_pro' and  
               (CART_DTRA_CCON between 536 and 536) 
			    and CART_DTRA_TIP_TRAN = 4 and CART_DTRA_USR_BAJA is null ";
			//    echo $monto."capital".$fec_r."fec_r";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $ncre = $lin_dtra['CART_DTRA_NCRE'];
				  $monto = $lin_dtra['CART_DTRA_IMPO_BS'];
				  $nro_tran_cart = $lin_dtra['CART_DTRA_NRO_TRAN'];
				  $nrocta = $lin_dtra['CART_DTRA_CTA_CBT'];
				  //echo $monto,"CAp";
		     //}
		 $nro = 0;
$con_car  = "Select CART_NRO_CRED,CART_IMPORTE,CART_IMP_COM,CART_TIPO_OPER,CART_PRODUCTO,
             CART_NRO_CTAS,CART_COD_MON,CART_FORM_PAG,CART_AHO_DUR,CART_FEC_DES,CART_FEC_UNO,
			 CART_COD_AGEN,CART_COD_GRUPO,CART_ESTADO,CART_TASA,CLIENTE_AP_PATERNO,
			 CLIENTE_AP_MATERNO, CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES,CLIENTE_COD_ID
             From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			 and CLIENTE_USR_BAJA is null order by CART_NRO_CRED"; 
$res_car = mysql_query($con_car)or die('No pudo seleccionarse solicitud 2');		 
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
		  $nom_grp = "";
		 $_SESSION['ci_cli'] = $lin_car['CLIENTE_COD_ID'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $nom_cli = $lin_car['CLIENTE_AP_PATERNO']." ".
					$lin_car['CLIENTE_AP_MATERNO']." ".
					$lin_car['CLIENTE_AP_ESPOSO']." ".
					$lin_car['CLIENTE_NOMBRES'];
		  $_SESSION['nom_cli'] = $nom_cli;
		  if ($c_grup > 0){		
		  $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
          $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	      while ($lin_grp = mysql_fetch_array($res_grp)) {
	             $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
				 $_SESSION['nom_grp'] = $nom_grp;
		      }	
			}  
		
		 $cod_fon = 0;
		 $d_est = "";
		 $mon_plan = 0;
		 $tot_plan = 0;
		 $tot_cta = 0; 
		 $tot_pag = 0;
		 $tot_tde = 0;
		 $tot_tpa = 0;
		 $mon_tpa  = 0;
		 $mon_tde = 0;
		// $f_uno2= cambiaf_a_normal($f_uno);
		// echo $cod_sol;
	$cod_id = rtrim($_SESSION['ci_cli']);
					$nro_char = strlen($cod_id);
					$nitci= substr($cod_id,0,$nro_char-2);
					$ext_ci = substr($cod_id,$nro_char-2,2);

    $_SESSION['nitci'] = $nitci;
    $consulta  = "SELECT * FROM factura_cntrl  
                 ORDER BY FAC_CTRL_AGEN 
		   	     DESC LIMIT 0,1";
	$nombre = $_SESSION['nom_cli'];			 
    $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
    $linea = mysql_fetch_array($resultado);
    $orden = $linea['FAC_CTRL_ORDEN'];
    $llave = trim($linea['FAC_CTRL_LLAVE']);//'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS';    //					 
    $fecha =  $f_pro;
    $fecha_h =  $linea['FAC_CTRL_FEC_H'];
$_SESSION['fecha_h'] = cambiaf_a_normal($fecha_h);	
//$monto =  $_SESSION['pag_int'] + $_SESSION['pag_pen'];
$_SESSION['monto'] = $monto;
$nfactura = leer_nro_corre_fac($orden);					
$cc7m = genCodContrl($orden, $nfactura, $nitci, $fecha, $monto, $llave);	
$_SESSION['nfactura'] = $nfactura;
$_SESSION['orden'] = $orden;
$_SESSION['cc7m'] = $cc7m;
$_SESSION['fecha_h'] = cambiaf_a_normal($fecha_h);	
		
	}
$consulta = "insert into factura (FACTURA_AGEN, 
                                    FACTURA_APLI,
									FACTURA_NRO,
									FACTURA_TALON,
									FACTURA_ORDEN,
					                FACTURA_ALFA,
					                FACTURA_LLAVE,
   				                    FACTURA_NUMERICO,
					                FACTURA_ENLACE, 
									FACTURA_NOMBRE, 
									FACTURA_NIT, 
									FACTURA_MONTO,
                                    FACTURA_ESTADO,
                                    FACTURA_FECHA,
                                    FACTURA_FEC_H,
                                    FACTURA_COD_CTRL,
                                    FACTURA_USR_ALTA,
									FACTURA_FCH_HR_ALTA,
                                    FACTURA_USR_BAJA,
                                    FACTURA_FCH_HR_BAJA
                                    ) values (32,
									          13000,
											  $nro_tran_cart,
											  null,
											 '$orden',
												null,
												 '$llave',
												 $nfactura,
												  null,
												 '$nombre',
												 '$nitci',
												  $monto,
										          1,
												 '$fecha',
												 '$fecha_h',
												 '$cc7m',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());	

$it = round($monto * 0.03,2);
$iva = round($monto * 0.13,2);
$descrip = 'D INTERES CORRIENTE';
 $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '45502101',
											  '1',
											 $it,
											 '$fecha',
											 1,
											'$log_usr',
												  null,
												  null,
												  null)";
$resultado = mysql_query($consulta)or die('No pudo insertar factura_deta 1 : ' . mysql_error());

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204101',
											  '2',
											 $it,
											 '$fecha',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
$cta_ctbg = $nrocta; 
$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '$cta_ctbg',
											  '1',
											 $iva,
											 '$fecha',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204102',
											  '2',
											 $iva,
											 '$fecha',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
$imp_int = $monto;
$consulta = "insert into factura_tran (FAC_TRA_FACTURA, 
                                       FAC_TRA_MODULO,
									   FAC_TRA_DESCRI,
									   FAC_TRA_IMPO,
									   FAC_TRA_FECHA,
					                   FAC_TRA_ESTADO,
									   FAC_TRA_USR_ALTA,
					                   FAC_TRA_FCH_HR_ALTA,
									   FAC_TRA_USR_BAJA,
                                       FAC_TRA_FCH_HR_BAJA
                                    ) values ($nfactura,
											  6000,
											  '$descrip',
											 $imp_int,
											 '$fecha',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar factura_tran : ' . mysql_error());

	
	
?>
<?php 
?>


	
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$nro = 0;
?>
<tr>
	    <td align="right" ><?php echo number_format($nro_tran_cart, 0, '',''); ?></td>
		<td align="right" ><?php echo number_format($nfactura, 0, '',''); ?></td>
	 	<td align="left" ><?php echo $ncre; ?></td>
	    <td align="left" ><?php echo $nombre; ?></td>
		<?php
		if ($nom_grp <> ""){
		?>
		<td align="left" ><?php echo $nom_grp; ?></td>
		<?php
		 }else{
		?> 
		<td align="left" ><?php echo encadenar(5); ?></td>
		<?php
		 }
		?> 
		<td align="center" ><?php echo $nitci; ?></td>
		<td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
		
		<td align="center" ><?php echo $cc7m ; ?></td>
		
	</tr>	
	<?php
		}
    ?>
	
</table>
		  
<br>
</select>
   <br> <br>
  <input type="submit" name="accion" value="Reporte">
  
<?php
		}
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

