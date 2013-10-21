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
<?php
		//echo 'llegando al formulario';
	
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
			

/*if ($_SESSION['t_fac_fis'] <> 2){	
echo "Factura";
}*/

//if (trim($_SESSION['tipo']) == 'Deposito') {
		
/************************************************

		$nit = $_POST["nit"];
		$nro_fact = $_POST["nro_fac"];
		$_SESSION['nro_fact'] = $nro_fact;
		$nro_auto = $_POST["nro_auto"];
		$razon_social = $_POST["razon_social"];
		$razon_social = strtoupper ($razon_social);
		$periodo = $_POST["fec_fac"]; 
		$perio = cambiaf_a_mysql_2($periodo);
		$_SESSION['fec_fac'] = $perio;
		$imp_tot = $_POST["imp_tot"];
		$imp_ice = $_POST["imp_ice"];
		$imp_excento = $_POST["imp_excento"];
		$tot_neto = $_POST["tot_neto"];
		$cred_fisc_iva = $_POST["cred_fisc_iva"];
		$agencia = $_SESSION['COD_AGENCIA'];

		if (isset($_POST["cod_control"])) {
			//echo "vacio";
			$cod_control = $_POST["cod_control"];
		}else{
			$cod_control = " ";
			//$_POST["cod_control"]=0;
			//echo $_POST["cod_control"];
		}

		//

		if (isset($_POST["fac_anu"])){
			$fac_anu=9;
		}else{
			$fac_anu=1;
		}
***************************************************************/
//$fac_anu = $_POST["fac_anu"];

/*
$cta_banco = $_POST["cod_ban"];
$contra_cta = $_POST["con_cuen"];
$hace_transac = $_POST["trans"];
*/

//echo $_POST['fac_egres'];
//echo $_SESSION['tipo']; 


//echo $nit."--".$nro_fact."--".$nro_auto."--".$razon_social."--".$periodo."--".$imp_tot."--".$imp_ice."--".$imp_excento."--".$tot_neto."--".$cred_fisc_iva."--".$cod_control."---".$fac_anu;
//echo "<br>";

//echo "-------------------------".$_SESSION['egr'];

//if (isset($_POST["fac_egres"])){

if (isset($_POST["CajaChica"])){

if ($_POST['CajaChica'] == 'Caja Chica') {
		$nit = $_POST["nit"];
		$nro_fact = $_POST["nro_fac"];
		$_SESSION['nro_fact'] = $nro_fact;
		$nro_auto = $_POST["nro_auto"];
		$razon_social = $_POST["razon_social"];
		$razon_social = strtoupper ($razon_social);
		$periodo = $_POST["fec_fac"]; 
		$perio = cambiaf_a_mysql_2($periodo);
		$_SESSION['fec_fac'] = $perio;
		$imp_tot = $_POST["imp_tot"];
		$imp_ice = $_POST["imp_ice"];
		$imp_excento = $_POST["imp_excento"];
		$tot_neto = $_POST["tot_neto"];
		$cred_fisc_iva = $_POST["cred_fisc_iva"];
		$agencia = $_SESSION['COD_AGENCIA'];

		if (isset($_POST["cod_control"])) {
			$cod_control = strtoupper ($_POST["cod_control"]);
		}else{
			$cod_control = " ";
		}

		if (isset($_POST["fac_anu"])){
			$fac_anu=9;
		}else{
			$fac_anu=1;
		}


	 
	echo $_POST['moneda'];
	echo $_POST['cue_egr'];
	echo $_POST['ag'];
	echo $_POST['CajaChica'];
	
$_SESSION['cta_ctbg'] = $_POST['cue_egr'];	
	$_SESSION['cue_egr'] = $_POST["cue_egr"];
$_SESSION['ag'] = $_POST["ag"];
$_SESSION['des'] = $_POST["des"];


$_SESSION['monto'] = $_POST["imp_tot"];
if ($imp_excento > 0) {
    $_SESSION['myradio'] = "cre_fex";
	$_SESSION['imp_exe'] = $imp_excento;
	$_SESSION['monto_i'] = round($imp_excento * .13,2);
}else{ 
     $_SESSION['myradio'] = "cre_fac";
	 $_SESSION['monto_i'] = round($imp_tot * .13,2);
}	 
$importe = $_SESSION['monto'];
	echo $_SESSION['cue_egr']."--".$razon_social."--".$_SESSION['monto']."--";
$_SESSION['t_fac_fis'] = 2;
$cred_fisc_iva = $_SESSION['monto_i'];
$cta_otra = $_SESSION['cue_egr'];	              
	              //$_SESSION['monto_p'] = $monto_t - $_SESSION['monto_i'];
				  $iva = $_SESSION['monto_i'];
	              $cta_f13 = 1141010010001;


$consulta = "insert into factura (FACTURA_TIPO,
	                                       FACTURA_AGEN,
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
											FACTURA_ICE,
											FACTURA_EXCENTO,
											FACTURA_NETO,
											FACTURA_IVA,
											FACTURA_ESTADO,
											FACTURA_FECHA,
											FACTURA_FEC_H,
											FACTURA_COD_CTRL,
											FACTURA_USR_ALTA,
											FACTURA_FCH_HR_ALTA,
											FACTURA_USR_BAJA,
											FACTURA_FCH_HR_BAJA)
									values(1,
									'$agencia',
										'13000',
										'$nro_fact',
										 null,
										'$nro_auto',
										null,
										null,
										0,
										null,
										'$razon_social',
										'$nit',
										'$imp_tot',
										'$imp_ice',
										'$imp_excento',
										'$tot_neto',
										'$cred_fisc_iva',
										'$fac_anu',
										'$perio',
										'$fec1',
										'$cod_control',
										'$log_usr',
										null,
										null,
										'0000-00-00 00:00:00')";

			$resultado = mysql_query($consulta);
/*$consulta = "insert into factura_deta (FAC_DET_AGEN, 
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
                                    ) values ($agencia,
									          $nro_fact,
											  '$cta_otra',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

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
                                    ) values ($agencia,
									          $nro_fact,
											  '$cta_f13',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);			
*/
 $_SESSION['detalle'] = 2;
 $_SESSION['menu'] = 3;
 $_SESSION['t_fac_fis'] = 2;	 
	    //   require 'reg_gastos_cjach.php';

		header('location: reg_gastos_cjach.php');

}
}

//}

if (isset($_POST["fac_egres"])){

if ($_POST['fac_egres'] == 'facturaegreso') {

		$_SESSION['debe1'] = $_POST['debe1'];
		$_SESSION['haber1'] = $_POST['haber1'];
		$_SESSION['debe2'] = $_POST['debe2'];
		$_SESSION['haber2'] = $_POST['haber2'];
		$_SESSION['glosa'] = $_POST['glosas'];
		$_SESSION['cuenta'] = $_POST['cuen_cont'];
		$_SESSION['glosas'] = $_POST['glosas2'];


		/*$consulta = "insert into factura (FACTURA_AGEN,
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
											FACTURA_ICE,
											FACTURA_EXCENTO,
											FACTURA_NETO,
											FACTURA_IVA,
											FACTURA_ESTADO,
											FACTURA_FECHA,
											FACTURA_FEC_H,
											FACTURA_COD_CTRL,
											FACTURA_USR_ALTA,
											FACTURA_FCH_HR_ALTA,
											FACTURA_USR_BAJA,
											FACTURA_FCH_HR_BAJA)
									values('$agencia',
										'13000',
										'$nro_fact',
										'talon',
										'$nro_auto',
										'null',
										'null',
										'null',
										'null',
										'$razon_social',
										'$nit',
										'$imp_tot',
										'$imp_ice',
										'$imp_excento',
										'$tot_neto',
										'$cred_fisc_iva',
										'$fac_anu',
										'$periodo',
										'0000-00-00',
										'$cod_control',
										'$log_usr',
										'null',
										'null',
										'0000-00-00 00:00:00')";

			$resultado = mysql_query($consulta);
*/
		header("location: con_retro_1.php?accion=Adicionar");

//echo $_POST['haber1']."-".$_POST['debe1']."-".$_POST['haber2']."-".$_POST['haber2']."-".$_POST['glosas']."-".$_POST['cuen_cont']."-".$_POST['glosas2'];
}

}
if (isset($_POST["fac_ingr"])){


if ($_POST['fac_ingr'] == 'facturaingreso') {
        echo "aqui";
        
		$_SESSION['debe1'] = $_POST['debe1'];
		$_SESSION['haber1'] = $_POST['haber1'];
		$_SESSION['debe2'] = $_POST['debe2'];
		$_SESSION['haber2'] = $_POST['haber2'];
		$_SESSION['glosa'] = $_POST['glosas'];
		$_SESSION['cuenta'] = $_POST['cuen_cont'];
		$_SESSION['glosas'] = $_POST['glosas2'];

echo $_SESSION['debe1']."deb";
	 $_SESSION['haber1']."hab";
	 $_SESSION['debe2']."----";
	 $_SESSION['haber2']."---";
	 $_SESSION['glosa']."----";
	 $_SESSION['cuenta']."----";
	 $_SESSION['glosas']."----";
		/*$consulta = "insert into factura (FACTURA_AGEN,
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
											FACTURA_ICE,
											FACTURA_EXCENTO,
											FACTURA_NETO,
											FACTURA_IVA,
											FACTURA_ESTADO,
											FACTURA_FECHA,
											FACTURA_FEC_H,
											FACTURA_COD_CTRL,
											FACTURA_USR_ALTA,
											FACTURA_FCH_HR_ALTA,
											FACTURA_USR_BAJA,
											FACTURA_FCH_HR_BAJA)
									values('$agencia',
										'13000',
										'$nro_fact',
										'talon',
										'$nro_auto',
										'null',
										'null',
										'null',
										'null',
										'$razon_social',
										'$nit',
										'$imp_tot',
										'$imp_ice',
										'$imp_excento',
										'$tot_neto',
										'$cred_fisc_iva',
										'$fac_anu',
										'$periodo',
										'0000-00-00',
										'$cod_control',
										'$log_usr',
										'null',
										'null',
										'0000-00-00 00:00:00')";

			$resultado = mysql_query($consulta);
*/
		header("location: con_retro_1.php?accion=Adicionar");

//echo $_POST['haber1']."-".$_POST['debe1']."-".$_POST['haber2']."-".$_POST['haber2']."-".$_POST['glosas']."-".$_POST['cuen_cont']."-".$_POST['glosas2'];
}
}



//echo $_SESSION['egr'];
//echo $_SESSION['tipo'];
//echo $_SESSION['ingr'];


//else

//if ($_SESSION['egr']==2) {
//echo $_SESSION['tipo'];
//echo $_SESSION['tipo'];

//INGRESOS EGRESOS        **********************************************************************************************************

if (isset($_POST["egreso"])){
if (($_POST["egreso"] == 'Egresos') && ((trim($_SESSION['moneda']) == 'Bolivianos') || (trim($_SESSION['moneda']) == 'Dolares'))) {

$nit = $_POST["nit"];
		$nro_fact = $_POST["nro_fac"];
		$_SESSION['nro_fact'] = $nro_fact;
		$nro_auto = $_POST["nro_auto"];
		$razon_social = $_POST["razon_social"];
		$razon_social = strtoupper ($razon_social);
		$periodo = $_POST["fec_fac"]; 
		$perio = cambiaf_a_mysql_2($periodo);
		$_SESSION['fec_fac'] = $perio;
		$imp_tot = $_POST["imp_tot"];
		$imp_ice = $_POST["imp_ice"];
		$imp_excento = $_POST["imp_excento"];
		$tot_neto = $_POST["tot_neto"];
		$cred_fisc_iva = $_POST["cred_fisc_iva"];
		$agencia = $_SESSION['COD_AGENCIA'];

		if (isset($_POST["cod_control"])) {
			//echo "vacio";
			$cod_control = $_POST["cod_control"];
		}else{
			$cod_control = " ";
			//$_POST["cod_control"]=0;
			//echo $_POST["cod_control"];
		}
if ($imp_excento <> 0) {
    $_SESSION['myradio'] = "cre_fex";
	$_SESSION['imp_exe'] = $imp_excento;
	$_SESSION['monto_i'] = round($imp_excento * .13,2);
}else{ 
     $_SESSION['myradio'] = "cre_fac";
	 $_SESSION['monto_i'] = round($imp_tot * .13,2);
	// echo "AAAAAqqqqquuuuiiii";
}
$cred_fisc_iva = $_SESSION['monto_i'];//

	 
$importe = $_SESSION['monto'];
	echo "--".$razon_social."--".$_SESSION['monto']."--";
$_SESSION['t_fac_fis'] = 2;

		if (isset($_POST["fac_anu"])){
			$fac_anu=9;
		}else{
			$fac_anu=1;
		}
 /* if (isset($_POST['cod_cta'])){
              $cta_numero = explode(" ", $_POST['cod_cta']);
              $cta_ctbg =  $cta_numero[0];
              $_SESSION['cta_ctbg'] =  $cta_ctbg;
			  }
            //Separa la cuenta devengado
			 if (isset($_POST['cue_egr2'])){
			 		
			   $cta_numero2 = explode(" ", $_POST['cue_egr2']);
			$cta_ctb =  $cta_numero2[0];
              $_SESSION['cta_ctb'] =  $cta_ctb;
			}
*/
echo '*****'.$_SESSION['cta_ctb'].'****';

//$_SESSION['moneda'] = $_POST["moneda"];
$_SESSION['cta_ctb'] = $_POST["cue_egr2"];
$_SESSION['cue_egr'] = $_POST["cue_egr"];
$_SESSION['ag'] = $_POST["ag"];
$_SESSION['des'] = $_POST["des"];
$_SESSION['monto'] = $_POST["imp_tot"];
$importe = $_SESSION['monto'];
	echo $_SESSION['cue_egr']."--".$_SESSION['cta_ctb']."--".$_SESSION['monto']."--";
$_SESSION['t_fac_fis'] = 2;
$_SESSION['monto_i'] = round($importe * .13,2);
$cta_otra = $_SESSION['cue_egr'];	              
	              //$_SESSION['monto_p'] = $monto_t - $_SESSION['monto_i'];
				  $iva = $_SESSION['monto_i'];
	              $cta_f13 = 1141010010001;

$consulta = "insert into factura (FACTURA_TIPO,
	                                       FACTURA_AGEN,
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
											FACTURA_ICE,
											FACTURA_EXCENTO,
											FACTURA_NETO,
											FACTURA_IVA,
											FACTURA_ESTADO,
											FACTURA_FECHA,
											FACTURA_FEC_H,
											FACTURA_COD_CTRL,
											FACTURA_USR_ALTA,
											FACTURA_FCH_HR_ALTA,
											FACTURA_USR_BAJA,
											FACTURA_FCH_HR_BAJA)
									values(1,
									'$agencia',
										'13000',
										'$nro_fact',
										 null,
										'$nro_auto',
										null,
										null,
										0,
										null,
										'$razon_social',
										'$nit',
										'$imp_tot',
										'$imp_ice',
										'$imp_excento',
										'$tot_neto',
										'$cred_fisc_iva',
										'$fac_anu',
										'$perio',
										'$fec1',
										'$cod_control',
										'$log_usr',
										null,
										null,
										'0000-00-00 00:00:00')";

			$resultado = mysql_query($consulta);
/*			
			
*/
$_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 3;
		header('location: reg_egresos.php'); 	
		

}
}


if (isset($_POST["ingreso"])){
if (($_POST["ingreso"] == 'Ingresos') && ((trim($_SESSION['moneda']) == 'Bolivianos') || (trim($_SESSION['moneda']) == 'Dolares'))) {
$nit = $_POST["nit_i"];
		$nro_fact = $_POST["nro_fac_i"];
		$_SESSION['nro_fact_i'] = $nro_fact;
		$nro_auto = $_POST["nro_auto_i"];
		$razon_social = $_POST["razon_social_i"];
		$razon_social = strtoupper ($razon_social);
		$periodo = $_POST["fec_fac_i"]; 
		$perio = cambiaf_a_mysql_2($periodo);
		$_SESSION['fec_fac'] = $perio;
		$imp_tot = $_POST["imp_tot_i"];
		$imp_ice = $_POST["imp_ice_i"];
		$imp_excento = $_POST["imp_excento_i"];
		$tot_neto = $_POST["tot_neto_i"];
		$cred_fisc_iva = $_POST["cred_fisc_iva_i"];
		$agencia = $_SESSION['COD_AGENCIA'];

		if (isset($_POST["cod_control_i"])) {
			//echo "vacio";
			$cod_control = $_POST["cod_control_i"];
		}else{
			$cod_control = " ";
			//$_POST["cod_control"]=0;
			//echo $_POST["cod_control"];
		}

		//

		if (isset($_POST["fac_anu_i"])){
			$fac_anu=9;
		}else{
			$fac_anu=1;
		}

$_SESSION['myradio'] = "cre_fac";
$_SESSION['monto_i'] = round($imp_tot * .13,2);





	

//$_SESSION['moneda'] = $_POST["moneda"];
$_SESSION['cue_egr_i'] = $_POST["cue_egr_i"];
$_SESSION['cue_egr_i2'] = $_POST["cue_egr_i2"];
$_SESSION['ag'] = $_POST["ag_i"];
$_SESSION['des'] = $_POST["des_i"];
$_SESSION['monto'] = $_POST["imp_tot_i"];
 if ($_SESSION['egre_bs_sus'] == 2){
     $_SESSION['monto_eq'] = $_POST['imp_tot_i'];
     $monto_t = (($_POST['imp_tot_i'] * $_SESSION['TC_CONTAB'])* -1);
     }else{
	 $monto_t = ($_POST['imp_tot_i']* -1);
 }	
 //Transacciones de Factura



//$iva = round($monto_t  * 0.13,2);		
$_SESSION['monto_t'] =  $monto_t;
	//}
$cta_otra = $_SESSION['cue_egr_i'];
$_SESSION['cta_ctbg'] = $cta_otra;
$_SESSION['descrip'] = $_SESSION['des'];
echo $_SESSION['cue_egr_i']."--".$razon_social."--".$_SESSION['monto_t']."--";
$_SESSION['t_fac_fis'] = 2;
$consulta = "insert into factura (FACTURA_TIPO,
	                                       FACTURA_AGEN,
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
											FACTURA_ICE,
											FACTURA_EXCENTO,
											FACTURA_NETO,
											FACTURA_IVA,
											FACTURA_ESTADO,
											FACTURA_FECHA,
											FACTURA_FEC_H,
											FACTURA_COD_CTRL,
											FACTURA_USR_ALTA,
											FACTURA_FCH_HR_ALTA,
											FACTURA_USR_BAJA,
											FACTURA_FCH_HR_BAJA)
									values(2,
									'$agencia',
										'13000',
										'$nro_fact',
										 null,
										'$nro_auto',
										null,
										null,
										0,
										null,
										'$razon_social',
										'$nit',
										'$imp_tot',
										'$imp_ice',
										'$imp_excento',
										'$tot_neto',
										'$cred_fisc_iva',
										'$fac_anu',
										'$perio',
										'$fec1',
										'$cod_control',
										'$log_usr',
										null,
										null,
										'0000-00-00 00:00:00')";

			$resultado = mysql_query($consulta);

//Transacciones de Factura

$it = round($imp_tot * 0.03,2);
$iva = round($imp_tot * 0.13,2);
//echo "fec_factura".$fec1;
/*
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
                                    ) values ($agencia,
									          $nro_fact,
											  '2111020010001',
											  '1',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  null)";
$resultado = mysql_query($consulta);

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
                                    ) values ($agencia,
									          $nro_fact,
											  '2111070010001',
											  '2',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
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
                                    ) values ($agencia,
									          $nro_fact,
											  '$cta_otra',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

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
                                    ) values ($agencia,
									          $nro_fact,
											  '2111060010001',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
*/
		$_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 9;
       header('location: reg_ingresos.php'); 	
}
}



//DEPOSITO Y RETIRO       **********************************************************************************
if (isset($_POST["egres"])){
if ($_POST["egres"] == 'Deposito') {


        $nit = $_POST["nit"];
		$_SESSION['nit'] = $nit;
		$nro_fact = $_POST["nro_fac"];
		$_SESSION['nro_fact'] = $nro_fact;
		$nro_auto = $_POST["nro_auto"];
		$_SESSION['nro_auto'] = $$nro_auto;
		$razon_social = $_POST["razon_social"];
		$razon_social = strtoupper ($razon_social);
		$_SESSION['razon_social'] = $razon_social;
		$periodo = $_POST["fec_fac"]; 
		$perio = cambiaf_a_mysql_2($periodo);
		$_SESSION['fec_fac'] = $perio;
		$imp_tot = $_POST["imp_tot"];
		$_SESSION['imp_tot'] = $imp_tot;
		$imp_ice = $_POST["imp_ice"];
		$imp_excento = $_POST["imp_excento"];
		$tot_neto = $_POST["tot_neto"];
		$cred_fisc_iva = $_POST["cred_fisc_iva"];
		$agencia = $_SESSION['COD_AGENCIA'];

		if (isset($_POST["cod_control"])) {
			//echo "vacio";
			$cod_control = $_POST["cod_control"];
		}else{
			$cod_control = " ";
			//$_POST["cod_control"]=0;
			//echo $_POST["cod_control"];
		}

		//

		if (isset($_POST["fac_anu"])){
			$fac_anu=9;
		}else{
			$fac_anu=1;
		}

//if ($imp_excento <> 0) {
 //   $_SESSION['myradio'] = "cre_fex";
//	$_SESSION['imp_exe'] = $imp_excento;
//	$_SESSION['monto_i'] = round($imp_excento * .13,2);
//}else{ 
     $_SESSION['myradio'] = "dep_fac";
	 $_SESSION['monto_i'] = round($imp_tot * .13,2);
	 $_SESSION['monto_it'] = round($imp_tot * .03,2);
	// echo "AAAAAqqqqquuuuiiii";
//}	 




$_SESSION['cta_banco'] = $_POST["cod_ban"];
$_SESSION['contra_cta'] = $_POST["con_cuen"];
$_SESSION['hace_transac'] = $_POST["trans"];
$_SESSION['monto'] = $_POST["imp_tot"];
//Para llevar a globales antes de grabar
$_SESSION['t_fac_fis'] = 2;	
$_SESSION['descrip'] = $_SESSION['hace_transac'];
$_SESSION['cta_ctbg'] = $_POST['cue_egr'];	
	$_SESSION['cue_egr'] = $_POST["cue_egr"];
$_SESSION['ag'] = $_POST["ag"];
$_SESSION['des'] = $_POST["des"];

$importe = $_SESSION['monto'];
$cta_bco = $_SESSION['cta_banco'];
$cta_otra = $_SESSION['contra_cta'];
$_SESSION['cta_bco'] =$cta_bco;  
$consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE = '$cta_bco' and
              GRAL_CTA_BAN_USR_BAJA is null ";
    $resultado = mysql_query($consulta);
	while ($linea = mysql_fetch_array($resultado)) {
	      $cta_banco = $linea['GRAL_CTA_BAN_CTBL'];
		  $_SESSION['cod_bco'] =  $linea['GRAL_CTA_BAN_COD']; 
	      $_SESSION['cta_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	      $_SESSION['nom_cta'] =  $linea['GRAL_CTA_BAN_DESC']; 
		  $_SESSION['nit_bco'] =  $linea['GRAL_CTA_BAN_NIT']; 
	}
	echo "---".$cta_banco."---";
		$des_banco = leer_cta_des($cta_banco);
		$des_otra = leer_cta_des($cta_otra);
	    $_SESSION['cta_otra'] = $cta_otra;
		$_SESSION['cta_banco'] = $cta_banco;
		$_SESSION['des_otra'] = $des_otra;
	    $_SESSION['des_banco'] = $des_banco;
		$mon_otra = leer_cta_mon($cta_otra);;
	
	if ($_SESSION['bco_bs_sus'] == 2){
	    $impo_bs1  = round(($importe * $_SESSION['TC_CONTAB']),2);
		$impo_eqv1 = $importe;
		$_SESSION['impo_bs1'] = $impo_bs1;
		$_SESSION['impo_eqv1'] = $impo_eqv1;
	  }
	if ($_SESSION['bco_bs_sus'] == 1){
	    $impo_bs1 = $importe ;
	    $impo_eqv1 = round(($importe / $_SESSION['TC_CONTAB']),2);
		$_SESSION['impo_bs1'] = $impo_bs1;
		$_SESSION['impo_eqv1'] = $impo_eqv1;
		}
	if ($mon_otra == 2){
	    $impo_bs2  = round(($importe * $_SESSION['TC_CONTAB']),2);
		$impo_eqv2 = $importe ;
		$_SESSION['impo_bs2'] = $impo_bs2;
		$_SESSION['impo_eqv2'] = $impo_eqv2;
	  }	
	if ($mon_otra == 1){
	    $impo_bs2 = $importe;
	    $impo_eqv2 = round(($importe / $_SESSION['TC_CONTAB']),2);
		$_SESSION['impo_bs2'] = $impo_bs2;
		$_SESSION['impo_eqv2'] = $impo_eqv2;
		}

echo $_SESSION['cta_banco']."--".$_SESSION['contra_cta']."--".$_SESSION['hace_transac']."--".$_SESSION['monto'];

//  Graba factura;
	$consulta = "insert into factura (FACTURA_TIPO,
	                                       FACTURA_AGEN,
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
											FACTURA_ICE,
											FACTURA_EXCENTO,
											FACTURA_NETO,
											FACTURA_IVA,
											FACTURA_ESTADO,
											FACTURA_FECHA,
											FACTURA_FEC_H,
											FACTURA_COD_CTRL,
											FACTURA_USR_ALTA,
											FACTURA_FCH_HR_ALTA,
											FACTURA_USR_BAJA,
											FACTURA_FCH_HR_BAJA)
									values(2,
									'$agencia',
										'15000',
										'$nro_fact',
										 null,
										'$nro_auto',
										null,
										null,
										0,
										null,
										'$razon_social',
										'$nit',
										'$imp_tot',
										'$imp_ice',
										'$imp_excento',
										'$tot_neto',
										'$cred_fisc_iva',
										'$fac_anu',
										'$perio',
										'$fec1',
										'$cod_control',
										'$log_usr',
										null,
										null,
										'0000-00-00 00:00:00')";

			$resultado = mysql_query($consulta);
 $_SESSION['detalle'] = 2 ;
 if ($_SESSION['bco_bs_sus'] == 1){
	     $_SESSION['menu'] = 14 ;
	}	
	if ($_SESSION['bco_bs_sus'] == 2){
	     $_SESSION['menu'] = 15 ;
	} 
		header('location: bco_dep_ret.php'); 
//Transacciones de Factura
/*
$it = round($imp_tot * 0.03,2);
$iva = round($imp_tot * 0.13,2);
//echo "fec_factura".$fec1;
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
                                    ) values ($agencia,
									          $nro_fact,
											  '2111020010001',
											  '1',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  null)";
$resultado = mysql_query($consulta);

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
                                    ) values ($agencia,
									          $nro_fact,
											  '2111070010001',
											  '2',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
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
                                    ) values ($agencia,
									          $nro_fact,
											  '$cta_otra',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

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
                                    ) values ($agencia,
									          $nro_fact,
											  '2111060010001',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
/*
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
											  13000,
											  '$descrip',
											 $monto,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar factura_tran : ' . mysql_error());

*/
	

		//header('location: banco_grab.php');
}
}
if (isset($_POST["ingres"])){
if ($_POST["ingres"]=='Retiro') {



        $nit = $_POST["nit_ret"];
		$_SESSION['nit'] = $nit;
		$nro_fact = $_POST["nro_fac_ret"];
		$_SESSION['nro_fact'] = $nro_fact;
		$nro_auto = $_POST["nro_auto_ret"];
		$_SESSION['nro_auto'] = $$nro_auto;
		$razon_social = $_POST["razon_social_ret"];
		$razon_social = strtoupper ($razon_social);
		$_SESSION['razon_social'] = $razon_social;
		$periodo = $_POST["fec_fac_ret"]; 
		$perio = cambiaf_a_mysql_2($periodo);
		$_SESSION['fec_fac'] = $perio;
		$imp_tot = $_POST["imp_tot_ret"];
		$_SESSION['imp_tot'] = $imp_tot;
		$imp_ice = $_POST["imp_ice_ret"];
		$imp_excento = $_POST["imp_excento_ret"];
		$tot_neto = $_POST["tot_neto_ret"];
		$cred_fisc_iva = $_POST["cred_fisc_iva_ret"];
		$agencia = $_SESSION['COD_AGENCIA'];

		if (isset($_POST["cod_control"])) {
			//echo "vacio";
			$cod_control = $_POST["cod_control"];
		}else{
			$cod_control = " ";
			//$_POST["cod_control"]=0;
			//echo $_POST["cod_control"];
		}
if ($imp_excento <> 0) {
    $_SESSION['myradio'] = "cre_fex";
	$_SESSION['imp_exe'] = $imp_excento;
	$_SESSION['monto_i'] = round($imp_excento * .13,2);
}else{ 
     $_SESSION['myradio'] = "cre_fac";
	 $_SESSION['monto_i'] = round($imp_tot * .13,2);
	// echo "AAAAAqqqqquuuuiiii";
}	 
$importe = $_SESSION['monto'];
	echo "--".$razon_social."--".$_SESSION['monto']."--";
$_SESSION['t_fac_fis'] = 2;

		if (isset($_POST["fac_anu_ret"])){
			$fac_anu=9;
		}else{
			$fac_anu=1;
		}
//echo $nit."--".$nro_fact."--".$nro_auto."--".$razon_social."--".$periodo."--".$imp_tot."--".$imp_ice."--".$imp_excento."--".$tot_neto."--".$cred_fisc_iva."--".$cod_control."---".$fac_anu;
//echo "<br>";
$_SESSION['cheque'] = $_POST["chq"];
$_SESSION['chequera'] = $_POST["cheqra"];
$_SESSION['cta_banco'] = $_POST["cod_ban1"];
$_SESSION['contra_cta'] = $_POST["con_cuen1"];
$_SESSION['hace_transac'] = $_POST["trans1"];
$_SESSION['monto'] = $_POST["imp_tot_ret"];
$_SESSION['cue_egr'] = $_SESSION['contra_cta'];

	//Para llevar a globales antes de grabar
$_SESSION['t_fac_fis'] = 2;	
$_SESSION['descrip'] = $_SESSION['hace_transac'];
$_SESSION['des'] = $_SESSION['descrip'];
echo $_SESSION['cta_banco']."++++".$_SESSION['contra_cta']."****".$_SESSION['cue_egr']."----".$_SESSION['des'];
$importe = $_SESSION['monto'];
$cta_bco = $_SESSION['cta_banco'];
$cta_otra = $_SESSION['contra_cta'];
$_SESSION['cta_bco'] =$cta_bco;  
$consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE = '$cta_bco' and
              GRAL_CTA_BAN_USR_BAJA is null ";
    $resultado = mysql_query($consulta);
	while ($linea = mysql_fetch_array($resultado)) {
	      $cta_banco = $linea['GRAL_CTA_BAN_CTBL'];
		  $_SESSION['cod_bco'] =  $linea['GRAL_CTA_BAN_COD']; 
	      $_SESSION['cta_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	      $_SESSION['nom_cta'] =  $linea['GRAL_CTA_BAN_DESC']; 
		  $_SESSION['nit_bco'] =  $linea['GRAL_CTA_BAN_NIT']; 
	}
	$des_banco = leer_cta_des($cta_banco);
		$des_otra = leer_cta_des($cta_otra);
	    $_SESSION['cta_otra'] = $cta_otra;
		$_SESSION['cta_banco'] = $cta_banco;
		$_SESSION['des_otra'] = $des_otra;
	    $_SESSION['des_banco'] = $des_banco;
		$mon_otra = leer_cta_mon($cta_otra);
	
	if ($_SESSION['bco_bs_sus'] == 2){
	    $impo_bs1  = round(($importe * $_SESSION['TC_CONTAB']),2);
		$impo_eqv1 = $importe;
		$_SESSION['impo_bs1'] = $impo_bs1;
		$_SESSION['impo_eqv1'] = $impo_eqv1;
	  }
	if ($_SESSION['bco_bs_sus'] == 1){
	    $impo_bs1 = $importe ;
	    $impo_eqv1 = 0;
		$_SESSION['impo_bs1'] = $impo_bs1;
		$_SESSION['impo_eqv1'] = $impo_eqv1;
		}
	if ($mon_otra == 2){
	    $impo_bs2  = round(($importe * $_SESSION['TC_CONTAB']),2);
		$impo_eqv2 = $importe ;
		$_SESSION['impo_bs2'] = $impo_bs2;
		$_SESSION['impo_eqv2'] = $impo_eqv2;
	  }	
	if ($mon_otra == 1){
	    $impo_bs2 = $importe;
	    $impo_eqv2 = 0;
		$_SESSION['impo_bs2'] = $impo_bs2;
		$_SESSION['impo_eqv2'] = $impo_eqv2;
		}
//Para factura

$_SESSION['t_fac_fis'] = 2;
	$cred_fisc_iva = $_SESSION['monto_i'];              
	              
	              
	              //$_SESSION['monto_p'] = $monto_t - $_SESSION['monto_i'];
				  $iva = $_SESSION['monto_i'];
	              $cta_f13 = 1141010010001;
	            //  $_SESSION['cta_f13'] = $cta_f13;
echo $_SESSION['cta_banco']."--".$_SESSION['contra_cta']."--".$_SESSION['hace_transac']."--".$_SESSION['monto']."---".$_SESSION['monto_i'];


		$consulta = "insert into factura (  FACTURA_TIPO,
		                                    FACTURA_AGEN,
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
											FACTURA_ICE,
											FACTURA_EXCENTO,
											FACTURA_NETO,
											FACTURA_IVA,
											FACTURA_ESTADO,
											FACTURA_FECHA,
											FACTURA_FEC_H,
											FACTURA_COD_CTRL,
											FACTURA_USR_ALTA,
											FACTURA_FCH_HR_ALTA,
											FACTURA_USR_BAJA,
											FACTURA_FCH_HR_BAJA)
									values(1,
									    '$agencia',
										'15000',
										'$nro_fact',
										 null,
										'$nro_auto',
										null,
										null,
										0,
										null,
										'$razon_social',
										'$nit',
										'$imp_tot',
										'$imp_ice',
										'$imp_excento',
										'$tot_neto',
										'$cred_fisc_iva',
										'$fac_anu',
										'$perio',
										'$fec1',
										'$cod_control',
										'$log_usr',
										null,
										null,
										'0000-00-00 00:00:00')";

			$resultado = mysql_query($consulta);
	  $_SESSION['detalle'] = 2 ;
	     $_SESSION['menu'] = 12 ;
		header('location: bco_dep_ret.php'); 		
/*			
			
			
		
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
                                    ) values ($agencia,
									          $nro_fact,
											  '$cta_otra',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

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
                                    ) values ($agencia,
									          $nro_fact,
											  '$cta_f13',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

*/


//

		

}
}


?>
<?php
}
ob_end_flush();
 ?>