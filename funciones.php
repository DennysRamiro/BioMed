<?php
/*if (!isset ($_SESSION)){
	session_start();
	}
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else { */
	require('configuracion.php');
?>
<?php
function leer_param_gral()
{
 ?>
 <b>USUARIO:  </b>
 <?php
  echo $_SESSION['nombres'];
  $log = $_SESSION['login']; 
  
  ?> 
  <br><b> AGENCIA:  </b> 
  <?php
   echo leer_agencia_usr ($log);
   ?>
   <br><b> FECHA PROCESO:  </b>
   <?php
   //date_default_timezone_set('GMT');
   //$difhor = "+1"; //Diferencia horaria entre el server y la Laguna.
   //$ajuste = ($difhor * 60 * 60); //Ajustamos por horas 60 seg* 60 min.
   //$hora = date("g:i  a",time()); //la hora es igual a la hora 
   //$hora = date("h : i : s");
  //echo "Hora Actual: " .date("H:i:s") . "<br />"; 
//echo date("H:i:s",strtotime("-1 hour"));
  $ag_usr = $_SESSION['COD_AGENCIA'];
  $fecha = leer_fecha_proc($ag_usr);
  $_SESSION['fec_proc'] = $fecha;
  $tc_cont = leer_tipo_cam();
  /*echo $fecha.encadenar(2).date("H:i:s",strtotime("-1 hour")).encadenar(30).
  "TC Contable ".number_format($_SESSION['TC_CONTAB'], 2, '.',',');*/
  echo $fecha.encadenar(2).//date("H:i:s",strtotime("-1 hour")).
  "<br><b>TC CONTABLE:</b> ".number_format($_SESSION['TC_CONTAB'], 2, '.',',');
  return $fecha;
}

function cod_incrementable($tipo)

{ //return $tipo;
    $cons_alfanum="select Substring(alm_proy_cod, 1 , 1) as var, MAX(Substring(alm_proy_cod, 2 , 4))  as num  
             from alm_proyecto where alm_proy_tipo=".$tipo;
    $res_alfanum = mysql_query($cons_alfanum);
    $linea_alfanum= mysql_fetch_array($res_alfanum);

    //echo $linea_alfanum['var'];

  if (isset($linea_alfanum['var'])) {
      $cons_alfanum_ini="select Substring(alm_proy_cod, 1 , 1) as ini, Substring(alm_proy_cod, 2 , 3) as med, MAX(Substring(alm_proy_cod, 5 , 1)) as ult , MAX(Substring(alm_proy_cod, 4 , 1)) as penul 
                                from alm_proyecto where alm_proy_tipo=".$tipo;
      $res_alfanum_ini = mysql_query($cons_alfanum_ini);
      $linea_alfanum_ini= mysql_fetch_array($res_alfanum_ini);

      $cons_alfanum2="select Substring(alm_proy_cod, 1 , 1) as ini, Substring(alm_proy_cod, 2 , 2) as med, MAX(Substring(alm_proy_cod, 4 , 2)) as ult  , MAX(Substring(alm_proy_cod, 3 , 1)) as penul
                                from alm_proyecto where alm_proy_tipo=".$tipo;
      $res_alfanum2 = mysql_query($cons_alfanum2);
      $linea_alfanum2= mysql_fetch_array($res_alfanum2);

      $cons_alfanum3="select Substring(alm_proy_cod, 1 , 1) as ini, Substring(alm_proy_cod, 2 , 1) as med, MAX(Substring(alm_proy_cod, 3 , 3)) as ult , MAX(Substring(alm_proy_cod, 2 , 1)) as penul 
                                from alm_proyecto where alm_proy_tipo=".$tipo;
      $res_alfanum3 = mysql_query($cons_alfanum3);
      $linea_alfanum3= mysql_fetch_array($res_alfanum3);

      $cons_alfanum4="select Substring(alm_proy_cod, 1 , 1) as ini, Substring(alm_proy_cod, 2 , 0) as med, MAX(Substring(alm_proy_cod, 2 , 4)) as ult , MAX(Substring(alm_proy_cod, 2 , 1)) as penul   
                                from alm_proyecto where alm_proy_tipo=".$tipo;
      $res_alfanum4 = mysql_query($cons_alfanum4);
      $linea_alfanum4= mysql_fetch_array($res_alfanum4);


            if ($linea_alfanum_ini['ult']<9 && $linea_alfanum_ini['penul']==0 ) {
          $ceros= $linea_alfanum_ini['med'];
          $ult=$linea_alfanum_ini['ult']+1;
          $cod=$linea_alfanum_ini['ini'].$ceros.$ult;

            }elseif ($linea_alfanum_ini['ult']==9 && $linea_alfanum_ini['penul']==0 ) {
          $ceros= $linea_alfanum2['med'];
          $ult=$linea_alfanum_ini['ult']+1;
          $cod=$linea_alfanum_ini['ini'].$ceros.$ult;

            }elseif ($linea_alfanum2['ult']<99 && $linea_alfanum2['penul']==0 ) {
          $ceros= $linea_alfanum2['med'];
          $ult=$linea_alfanum2['ult']+1;
          $cod=$linea_alfanum2['ini'].$ceros.$ult;

            }elseif ($linea_alfanum2['ult']==99 && $linea_alfanum2['penul']==0 ) {
            $ceros= $linea_alfanum3['med'];
          $ult=$linea_alfanum2['ult']+1;
          $cod=$linea_alfanum2['ini'].$ceros.$ult;
          
            }elseif ($linea_alfanum3['ult']<999 && $linea_alfanum3['penul']==0 ) {
            $ceros= $linea_alfanum3['med'];
          $ult=$linea_alfanum3['ult']+1;
          $cod=$linea_alfanum3['ini'].$ceros.$ult;
            
            }elseif ($linea_alfanum3['ult']==999 && $linea_alfanum3['penul']==0 ) {
          $ult=$linea_alfanum3['ult']+1;
          $cod=$linea_alfanum3['ini'].$ult;
            
            }elseif($linea_alfanum4['ult']>999 && $linea_alfanum4['penul']>0 ) {
            $ult=$linea_alfanum4['ult']+1;
          $cod=$linea_alfanum4['ini'].$ult;
            }


    
   } else {
            //echo $cod=$tipo;
            if ($tipo==1) {
              $cod='C0001';
            }elseif ($tipo==2) {
              $cod='L0001';
            }elseif ($tipo==3) {
              $cod='O0001';
            }elseif ($tipo==4) {
              $cod='S0001';
            }
            
   }
    return ($cod);
}


   ?>
<?php
function leer_tipo_cam_2($fecha) 
{
$cod_agen = $_SESSION['COD_AGENCIA'];
$consulta  = "SELECT * FROM gral_tipo_cambio where GRAL_TIP_CAM_AGEN = $cod_agen
              and GRAL_TIP_CAM_FECHA <= '$fecha' ORDER BY GRAL_TIP_CAM_FECHA DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
//$linea = mysql_fetch_array($resultado);
    while ($linea = mysql_fetch_array($resultado)) {
//	echo $linea['GRAL_TIP_CAM_CONTAB']."contab";
//	echo $linea['GRAL_TIP_CAM_COMPRA']."compra";
//	echo $linea['GRAL_TIP_CAM_VENTA']."venta";
    $_SESSION['TC_CONTAB'] = $linea['GRAL_TIP_CAM_CONTAB'];
	$_SESSION['TC_COMPRA'] = $linea['GRAL_TIP_CAM_COMPRA'];
	$_SESSION['TC_VENTA'] = $linea['GRAL_TIP_CAM_VENTA'];
	$tc_contab = $_SESSION['TC_CONTAB'];
	//echo $tc_contab;
	}
    return $tc_contab;
}
?> 
<?php
function leer_tipo_cam_ufv($fecha) 
{
//$cod_agen = $_SESSION['COD_AGENCIA'];
$consulta  = "SELECT * FROM gral_ufv_cambio where  GRAL_UFV_CAM_FECHA = '$fecha'";
$resultado = mysql_query($consulta);

    while ($linea = mysql_fetch_array($resultado)) {

    $_SESSION['TC_UFV'] = $linea['GRAL_UFV_CAM_CONTAB'];
	
	$tc_ufv = $_SESSION['TC_UFV'];
	//echo $tc_contab;
	}
    return $tc_ufv;
}
?>  
<?php
function leer_agencia_usr ($usr) 
{
$consulta  = "Select GRAL_AGENCIA_NOMBRE, gral_agencia.GRAL_AGENCIA_CODIGO From gral_agencia, gral_usuario where GRAL_USR_LOGIN = '$usr' and gral_agencia.GRAL_AGENCIA_CODIGO = gral_usuario.GRAL_AGENCIA_CODIGO";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
   $_SESSION['COD_AGENCIA']=$linea['GRAL_AGENCIA_CODIGO'];
   $_SESSION['MON_AGENCIA'] = $linea['GRAL_AGENCIA_NOMBRE'];
 //  return $linea['GRAL_AGENCIA_NOMBRE'];
   $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
				$emp_nit = $lin_emp['GRAL_EMP_NIT'];
				$emp_fon = $lin_emp['GRAL_EMP_DIRECTOR'];
				$_SESSION['emp_nom'] = $emp_nom;
				$_SESSION['emp_dir'] = $emp_dir;
				$_SESSION['emp_fon'] = $emp_fon;
				$_SESSION['emp_nit'] = $emp_nit;
				
		  }
   return $linea['GRAL_AGENCIA_NOMBRE'];
}
?> 
<?php
function leer_nombre_usr($tcre,$usr) {
//echo $tcre,$usr;
if($tcre == 1) {
   $consulta  = "Select GRAL_USR_NOMBRES,GRAL_USR_AP_PATERNO  From gral_usuario
                where GRAL_USR_LOGIN = '$usr'";
}
if($tcre == 2) {
   $consulta  = "Select GRAL_USR_NOMBRES, GRAL_USR_AP_PATERNO From gral_usuario
                where GRAL_USR_CODIGO = $usr";
}			
	  
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
    $nomusr = substr($linea['GRAL_USR_NOMBRES'],0,1).".".$linea['GRAL_USR_AP_PATERNO'];
    return $nomusr;
}
?> 
<?php
function leer_fecha_proc($ag_u) 
{
  $consulta  = "SELECT GRAL_CTRL_FECHA_ANT,GRAL_CTRL_FECHA_ACT, GRAL_CTRL_FECHA_PROX FROM gral_control_fecha 
                ORDER BY GRAL_CTRL_FECHA_ACT DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
    $f_proc = $linea['GRAL_CTRL_FECHA_ACT'];
	$_SESSION['f_proc'] = $f_proc;
	$_SESSION['f_ant'] = $linea['GRAL_CTRL_FECHA_ANT'];
	$_SESSION['f_prox'] = $linea['GRAL_CTRL_FECHA_PROX'];
	
//	$dia_l = leer_dia($f_proc);

	$f_procc = cambiaf_a_normal($f_proc);
    return $f_procc;
}
?> 
<?php
function cambiaf_a_normal($f_proc){
   //echo $f_proc;
   $anio =  substr($f_proc, 0,4);
   $mes = substr($f_proc, 5,2);
   $dia = substr($f_proc, -2);
   $lafecha=$dia."/".$mes."/".$anio; 
  /* if ( ereg( "([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $f_proc, $regs ) ) {
   $f_norm = "$regs[3]/$regs[2]/$regs[1]";
   return $f_norm;
   //echo "$regs[3]/$regs[2]/$regs[1]";
  } else {
    echo "Formato de fecha no valido: $date";
}
*/
   // ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $f_proc, $mifecha); 
  //  $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
?> 
<?php
function cambiaf_a_normal_2($f_proc){
   //echo $f_proc;
   $anio =  substr($f_proc, 0,4);
   $mes = substr($f_proc, 5,2);
   $dia = substr($f_proc, -2);
   $lafecha=$dia."-".$mes."-".$anio; 
   return $lafecha; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 
function cambiaf_a_mysql($fecha){ 
   $anio =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$anio."-".$mes."-".$dia; 
   /* ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	 */
    return $lafecha; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 
function cambiaf_a_mysql_2($fecha){

  //echo $fecha;
   $anio =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$anio."-".$mes."-".$dia; 
/*    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	*/ 
    return $lafecha; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql con guiones
//////////////////////////////////////////////////// 
function cambiaf_a_mysql2($fecha){ 
    $anio =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$anio."-".$mes."-".$dia; 
   return $lafecha;
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el mes
//////////////////////////////////////////////////// 
function saca_mes($fec){ 
   // ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fec, $mifecha); 
    $elmes= substr($fec, 3,2); 
    return $elmes; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el dia
//////////////////////////////////////////////////// 
function saca_dia($fec){ 
  //  ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fec, $mifecha); 
    $eldia=substr($fec, 0,2); 
    return $eldia; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa anio
//////////////////////////////////////////////////// 
function saca_anio($fec){ 
   // ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $elanio=substr($fec, 6,4); 
    return $elanio; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el mes 2
//////////////////////////////////////////////////// 
function saca_mes_2($fec){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $elmes=$mifecha[2]; 
    return $elmes; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa el dia 2
//////////////////////////////////////////////////// 
function saca_dia_2($fec){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $eldia=$mifecha[1]; 
    return $eldia; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Separa anio 2
//////////////////////////////////////////////////// 
function saca_anio_2($fec){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fec, $mifecha); 
    $elanio=$mifecha[3]; 
    return $elanio; 
} 
?> 
<?php
//////////////////////////////////////////////////// 
//Valida fecha normal separada por -   
//////////////////////////////////////////////////// 
function valida_fecha($fecha){ 
 $mes = saca_mes($fecha);
 $dia = saca_dia($fecha);
 $anio = saca_anio($fecha);
 if (checkdate($mes,$dia,$anio)) {
   	return true;
    } else {
	 msgError(__FILE__,__LINE__, "Fecha Incorrecta!!!");
    return false;
    }
} 
?><?php
//////////////////////////////////////////////////// 
//Valida fecha normal separada por /  
//////////////////////////////////////////////////// 
function valida_fecha_2($fecha){ 
 $mes = saca_mes_2($fecha);
 $dia = saca_dia_2($fecha);
 $anio = saca_anio_2($fecha);
 if (checkdate($mes,$dia,$anio)) {
   	return true;
    } else {
	 msgError(__FILE__,__LINE__, "Fecha Incorrecta!!!");
    return false;
    }
} 
?>

<?php
	function msgError($file, $line, $message) {
		echo "<b>ERROR</b><br>";
		echo "<b>Archivo:</b> $file<br>";
		echo "<b>Linea:</b> $line<br>";
		echo "<b>Mensaje:</b> $message";
	}
?>

<?php
	function msgError2($message) {
			echo "<b>Mensaje:</b> $message<br><br>";
	}
?>
<?php
function leer_nro_cliente() 
{
$consulta  = "SELECT CLIENTE_NUMERICO FROM cliente_general where CLIENTE_USR_BAJA is null ORDER BY CLIENTE_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_cliente = $linea['CLIENTE_NUMERICO'];
if ($nro_cliente == 0) {
   	$nro_cliente = nro_cliente + 1;
	} else {
	$nro_cliente = $linea['CLIENTE_NUMERICO'] + 1;
	}
   return $nro_cliente; 
}
?> 	
<?php
function validar_usuario($loginn)
{
$con_usr = "Select GRAL_USR_LOGIN From gral_usuario where GRAL_USR_LOGIN = '$loginn' and GRAL_USR_USR_BAJA is null";
$res_usr = mysql_query($con_usr);
$linea = mysql_fetch_array($res_usr);
$log_con = $linea['GRAL_USR_LOGIN'];
if (empty($log_con)) {
   return false;
   }else{
   return true;
	}
}
?>
<?php
function validar_cliente($clie_ci)
{
$con_cli = "Select CLIENTE_COD_ID From cliente_general where CLIENTE_COD_ID = '$clie_ci' and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli);
$linea = mysql_fetch_array($res_cli);
$cli_con = $linea['CLIENTE_COD_ID'];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>
<?php
function validar_proveedor($cod_int)
{
  $con_cli = "select ALM_PROV_CODIGO_INT 
              from alm_proveedor 
              where ALM_PROV_CODIGO_INT= '$cod_int' ALM_PROV_USR_ALTA is null";
  $res_cli = mysql_query($con_cli);
  //echo "--".($res_cli)."--";
  if (empty($res_cli)) {
  return false;
  }
  else{
    $linea = mysql_fetch_array($res_cli);
    $cod_int = $linea['ALM_PROV_CODIGO_INT'];
    echo "El Codigo ya existe"; 
  }
}

?>
<?php
function validar_deu_solic($cod_cli,$nro_s)
{
$con_sdeu = "Select CRED_DEU_INTERNO From cred_deudor where CRED_DEU_INTERNO = '$cod_cli' and CRED_SOL_CODIGO = $nro_s and CRED_DEU_USR_BAJA is null";
$res_sdeu = mysql_query($con_sdeu);
$linea = mysql_fetch_array($res_sdeu);
$cli_con = $linea['CRED_DEU_INTERNO'];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>
 <?php
function validar_grupo($grup_nom)
{
$con_grp = "Select CRED_GRP_NOMBRE From cred_grupo where CRED_GRP_NOMBRE = '$grup_nom' and CRED_GRP_USR_BAJA is null";
$res_grp = mysql_query($con_grp);
$linea = mysql_fetch_array($res_grp);
$nom_g = $linea['CRED_GRP_NOMBRE'];
if (empty($nom_g)) {
   return false;
   }else{
   return true;
	}
}
?> 
<?php
function leer_nro_grupo() 
{
$consulta  = "SELECT CRED_GRP_NUMERICO FROM cred_grupo where CRED_GRP_USR_BAJA is null ORDER BY CRED_GRP_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_grupo = $linea['CRED_GRP_NUMERICO'];
if ($nro_grupo == 0){
   	$nro_grupo =$nro_grupo + 1;
	} else {
	$nro_grupo = $linea['CRED_GRP_NUMERICO'] + 1;
	}
	echo $nro_grupo;
   return $nro_grupo; 
}
?> 	
<?php
function leer_nro_solic() 
{
	$consulta  = "SELECT CRED_SOL_NUMERICO FROM cred_solicitud where CRED_SOL_USR_BAJA is null ORDER BY CRED_SOL_NUMERICO  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_solic = 0;

$nro_solic = $linea['CRED_SOL_NUMERICO'];
//echo $nro_solic;
if ($nro_solic == 0) {
   	$nro_solic = nro_solic + 1;
	} else {
	$nro_solic = $linea['CRED_SOL_NUMERICO'] + 1;
	}
   return $nro_solic; 
}
?> 	
<?php
function verif_deu_sol($n_sol)
{
$con_sdeu = "Select CRED_DEU_INTERNO From cred_deudor where CRED_SOL_CODIGO = $n_sol and CRED_DEU_USR_BAJA is null";
$res_sdeu = mysql_query($con_sdeu);
$linea = mysql_fetch_array($res_sdeu);
$cli_con = $linea['CRED_DEU_INTERNO'];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>
<?php
function validar_deu_grupo($cod_cli,$nro_g)
{
$con_gdeu = "Select CRED_GRP_MES_REL From cred_grupo_mesa where CRED_GRP_MES_CLI = '$cod_cli' and CRED_GRP_MES_COD = $nro_g and CRED_GRP_MES_USR_BAJA is null";
$res_gdeu = mysql_query($con_gdeu);
$linea = mysql_fetch_array($res_gdeu);
$cli_con = $linea['CRED_GRP_MES_REL'];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>

<?php
function verif_saldo_fin_cja($fec_ult,$usr) 
{
//echo $fec_ult,$usr;
$con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_USR_ALTA = '$usr' and CAJA_TRAN_TIPO_OPE = 2
 and CAJA_TRAN_FECHA = '$fec_ult'";
 $res_trc = mysql_query($con_trc);
 $nro_tra = 0;
 while ($lin_trc = mysql_fetch_array($res_trc)) {
       $nro_tra = $nro_tra + 1;
       }
	  // echo $nro_tra;
return  $nro_tra;
}
?>
<?php
function saldo_fin_cja2($fec_ult,$log_usr,$mon) 
{
    if ($mon == 1) {
    $con_trc = "SELECT sum(CAJA_TRAN_IMPORTE) FROM caja_transac where CAJA_TRAN_CAJERO1 = '$log_usr'
                and CAJA_TRAN_MON = $mon and CAJA_TRAN_FECHA = '$fec_ult' and CAJA_TRAN_TIPO_OPE <> 2
    			and CAJA_TRAN_USR_BAJA is null ";
    }	
    if ($mon == 2) {
    $con_trc = "SELECT sum(CAJA_TRAN_IMP_EQUIV) FROM caja_transac where CAJA_TRAN_CAJERO1 = '$log_usr'
                and CAJA_TRAN_IMPORTE <> CAJA_TRAN_IMP_EQUIV and CAJA_TRAN_FECHA = '$fec_ult' and CAJA_TRAN_TIPO_OPE <> 2
    			and CAJA_TRAN_USR_BAJA is null";
    }				
     $res_trc = mysql_query($con_trc);
     $nro_tra = 0;
    if ($mon == 1) { 
     while ($lin_trc = mysql_fetch_array($res_trc)) {
          $sald =  $lin_trc['sum(CAJA_TRAN_IMPORTE)'];
           }
    	 }  
    if ($mon == 2) { 
     while ($lin_trc = mysql_fetch_array($res_trc)) {
          $sald =  $lin_trc['sum(CAJA_TRAN_IMP_EQUIV)'];
           }
    	 }  	 
return  $sald;
}
?>
<?php
function saldo_fin_vale($fec_ult,$log_usr,$mon) 
{
$con_trc = "SELECT sum(CAJA_VAL_IMPO) FROM caja_vale where CAJA_VAL_USR_ALTA = '$log_usr'
            and CAJA_VAL_MON = $mon and CAJA_VAL_FECHA = '$fec_ult' and  CAJA_VAL_USR_BAJA is null";
$res_trc = mysql_query($con_trc);
  while ($lin_trc = mysql_fetch_array($res_trc)) {
      $sald =  $lin_trc['sum(CAJA_VAL_IMPO)'];
       }
return  $sald;
}
?>
<?php
function saldo_fin_banco($fec_ult,$log_usr,$mon) 
{
//echo $fec_ult,$log_usr,$mon;
$con_trc = "SELECT sum(CAJA_DEP_IMPO) FROM caja_deposito where CAJA_DEP_USR_ALTA = '$log_usr'
            and CAJA_DEP_MON = $mon and CAJA_DEP_FECHA = '$fec_ult' and
           substr(CAJA_DEP_CTA_CTB,1,3)='111'";
$res_trc = mysql_query($con_trc);
  while ($lin_trc = mysql_fetch_array($res_trc)) {
      $sald =  $lin_trc['sum(CAJA_DEP_IMPO)'];
       }
	   //echo $sald;
return  $sald;
}
?>
<?php
function leer_nro_corre($apli,$agen) 
{
$consulta  = "SELECT GRAL_CORRE_NRO_DOC FROM gral_correlativo where GRAL_CORRE_AGEN = $agen 
              and GRAL_CORRE_APL = $apli and GRAL_CORRE_USR_BAJA is null ORDER BY GRAL_CORRE_NRO_DOC 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['GRAL_CORRE_NRO_DOC'] + 1;
return $nro_tran; 
}
?>
<?php
function leer_nro_corre_fac($orden) 
{
$consulta  = "SELECT FACTURA_NUMERICO FROM factura where FACTURA_ORDEN = '$orden' 
              ORDER BY FACTURA_NUMERICO 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['FACTURA_NUMERICO'] + 1;
return $nro_tran; 
}
?>
<?php
function verif_saldo_ini_cja($fec_act,$cajero,$c_age) 
{
$fec_a = cambiaf_a_mysql_2($fec_act);
//echo $fec_a;
$con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_AGE_ORG = $c_age and CAJA_TRAN_TIPO_OPE = 1
 and CAJA_TRAN_FECHA = '$fec_a' and CAJA_TRAN_CAJERO1 = '$cajero'";
 $res_trc = mysql_query($con_trc);
 $nro_tra = 0;
 while ($lin_trc = mysql_fetch_array($res_trc)) {
       $nro_tra = $nro_tra + 1;
       }
return  $nro_tra;
}
?>
<?php
function leer_nro_co_cja($apli,$cajero) 
{
$consulta  = "SELECT CAJA_TRAN_NRO_DOC FROM caja_transac where CAJA_TRAN_CAJERO1 = '$cajero' 
              ORDER BY CAJA_TRAN_NRO_DOC 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CAJA_TRAN_NRO_DOC'];

if (empty($nro_tran)) {
$nro_tran = 1;
//echo("el valor es".$nro_tran);
   }else{
$nro_tran = $nro_tran + 1;
//echo("el valor sera".$nro_tran);
  }
return $nro_tran; 
}
?>
<?php

//Correlativo de productos
function leer_correla_prod($tipo) 
{
$consulta  = "SELECT alm_prod_numerico FROM alm_producto where alm_prod_tipo = $tipo 
              ORDER BY alm_prod_numerico 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['alm_prod_numerico'];

if (empty($nro_tran)) {
$nro_tran = 1;
//echo("el valor es".$nro_tran);
   }else{
$nro_tran = $nro_tran + 1;
//echo("el valor sera".$nro_tran);
  }
return $nro_tran; 
}

//Correlativo de proveedor
function leer_correla_prov() 
{
$consulta  = "SELECT alm_prov_numerico FROM alm_proveedor 
              ORDER BY alm_prov_numerico 
              DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['alm_prov_numerico'];

if (empty($nro_tran)) {
$nro_tran = 1;
//echo("el valor es".$nro_tran);
   }else{
$nro_tran = $nro_tran + 1;
//echo("el valor sera".$nro_tran);
  }
return $nro_tran; 
}
?>
<?php
//Correlativo Vales
function leer_nro_val_cja($cajero) 
{
$consulta  = "SELECT CAJA_VAL_NRO FROM caja_vale where CAJA_VAL_USR_ALTA = '$cajero' 
               ORDER BY CAJA_VAL_NRO
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CAJA_VAL_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
//Correlativo Reposicion CAja Chica
function leer_nro_rep_cjach() 
{
$consulta  = "SELECT CJCH_ASIN_NRO FROM cjach_asignacion where CJCH_ASIN_USR_BAJA is null 
               ORDER BY CJCH_ASIN_NRO
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CJCH_ASIN_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
//Correlativo Asignacion CAja Chica
function leer_nro_asi_cjach($cod_cja) 
{
$consulta  = "SELECT CJCH_ASIN_NRO_ASIG FROM cjach_asignacion where CJCH_ASIN_CAJA = $cod_cja
               and CJCH_ASIN_USR_BAJA is null 
               ORDER BY CJCH_ASIN_NRO_ASIG
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CJCH_ASIN_NRO_ASIG'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
/*  Función dia_semana by PaToRoCo (www.patoroco.net)
Se permite la distribución total y modificación de la función, siempre que se nombre al autor */

function dia_semana ($dia, $mes, $ano) {
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
}
?>
<?php
function mes_anio ($mes) {
//echo $mes;
    $meses = array('Nada', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Noviembre', 'Diciembre' );
    return $meses[$mes];
}
?>
<?php
function encadenar($nespacios){ 
  $espacios = "";
  $solo = "&nbsp;";
  for($i=0;$i<$nespacios;$i++){ 
    $espacios=$espacios.$solo;//voy sumando espacios... 
  } 
  return $espacios;//devuelvo la cadena con todos los espacios 
} 
?>
<?php
function leer_tipo_cam() 
{
$cod_agen = $_SESSION['COD_AGENCIA'];
$consulta  = "SELECT * FROM gral_tipo_cambio where GRAL_TIP_CAM_AGEN = $cod_agen ORDER BY GRAL_TIP_CAM_FECHA DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
//$linea = mysql_fetch_array($resultado);
    while ($linea = mysql_fetch_array($resultado)) {
//	echo $linea['GRAL_TIP_CAM_CONTAB']."contab";
//	echo $linea['GRAL_TIP_CAM_COMPRA']."compra";
//	echo $linea['GRAL_TIP_CAM_VENTA']."venta";
    $_SESSION['TC_CONTAB'] = $linea['GRAL_TIP_CAM_CONTAB'];
	$_SESSION['TC_COMPRA'] = $linea['GRAL_TIP_CAM_COMPRA'];
	$_SESSION['TC_VENTA'] = $linea['GRAL_TIP_CAM_VENTA'];
	$tc_contab = $_SESSION['TC_CONTAB'];
	//echo $tc_contab;
	}
    return $tc_contab;
}
?>
<?php
function leer_cta_car($tip,$top,$est,$mon) 
{
//echo "llega"."tip".$tip."top".$top."est".$est."mon".$mon;
 $con_cartc = "Select CART_VIA_CTA_CTB,CART_VIA_CTA_COD From cart_via_cta where CART_VIA_CTA_GRP = $tip and CART_VIA_TIP_OP = $top and CART_VIA_CTA_NRO = $est and CART_VIA_MON = $mon and CART_VIA_CTA_USR_BAJA is null ";
 $res_cartc = mysql_query($con_cartc);
	while ($lin_cartc = mysql_fetch_array($res_cartc)) {
	       $cta_cart = $lin_cartc['CART_VIA_CTA_CTB']; 
		   $cta_tip = $lin_cartc['CART_VIA_CTA_COD']; 	
	      }
//echo $cta_cart, "cta cart";		  
 return $cta_cart;
 }		  
?>
<?php
function leer_cta_tip($tip,$top,$est,$mon) 
{
//echo $tip,$top,$est,$mon,"llega";
 $con_cartc = "Select CART_VIA_CTA_COD From cart_via_cta where CART_VIA_CTA_GRP = $tip and CART_VIA_TIP_OP = $top and CART_VIA_CTA_NRO = $est and CART_VIA_MON = $mon and CART_VIA_CTA_USR_BAJA is null ";
 $res_cartc = mysql_query($con_cartc);
	while ($lin_cartc = mysql_fetch_array($res_cartc)) {
	      $cta_tip = $lin_cartc['CART_VIA_CTA_COD']; 	
	      }
 return $cta_tip;
 }		  
?>
<?php
function leer_cta_des($cta){
 //echo $cta;
    $des_cta = 0;		  
	$con_ctad  = "Select CONTA_CTA_DESC From contab_cuenta where CONTA_CTA_NRO = $cta ";
    $res_ctad = mysql_query($con_ctad) ;
	while ($lin_ctad = mysql_fetch_array($res_ctad)) {
	      $des_cta = $lin_ctad['CONTA_CTA_DESC'];
          }
	return $des_cta;
}	  
?>
<?php
function leer_cta_mon($cta){
 //echo $cta;
    $mon_cta = 0;		  
	$con_ctad  = "Select CONTA_CTA_MONE From contab_cuenta where CONTA_CTA_NRO = $cta ";
    $res_ctad = mysql_query($con_ctad) ;
	while ($lin_ctad = mysql_fetch_array($res_ctad)) {
	      $mon_cta = $lin_ctad['CONTA_CTA_MONE'];
          }
	return $mon_cta;
}	  
?>
<?php
function leer_nro_co_fon($top,$usr) 
{

$consulta  = "SELECT FOND_CAB_NRO_TRAN FROM fond_cabecera where FOND_CAB_TIP_TRAN = $top 
               
              ORDER BY FOND_CAB_NRO_TRAN DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['FOND_CAB_NRO_TRAN'];
if (empty($nro_tran)) {
$nro_tran = 1;
}else{
$nro_tran = $nro_tran + 1;
}
return $nro_tran; 
}
?>
<?php
function leer_nro_co_car($top,$usr) 
{
$consulta  = "SELECT CART_CAB_NRO_TRAN FROM cart_cabecera where CART_CAB_USR_ALTA = '$usr'
              and CART_CAB_TIP_TRAN = $top  ORDER BY CART_CAB_NRO_TRAN DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CART_CAB_NRO_TRAN'];
if (empty($nro_tran)) {
$nro_tran = 1;
}else{
$nro_tran = $nro_tran + 1;
}
return $nro_tran; 
}
?>
<?php
function leer_nro_credito($agen) 
{
$consulta  = "SELECT CART_NUMERICO FROM cart_maestro 
              ORDER BY CART_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_cta = 0;
$nro_ctaf = $linea['CART_NUMERICO'];
if (empty($nro_ctaf)) {
   $nro_ctaf = $nro_cta + 1;
   }else{
   $nro_ctaf = $nro_ctaf + 1;
   }
   return $nro_ctaf; 
}
?>
<?php
function leer_nro_ctafon($agen) 
{

$consulta  = "SELECT FOND_NUMERICO FROM fond_maestro  
              ORDER BY FOND_NUMERICO DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_cta = 0;
$nro_ctaf = $linea['FOND_NUMERICO'];
if (empty($nro_ctaf)) {
   $nro_ctaf = $nro_cta + 1;
   }else{
   $nro_ctaf = $nro_ctaf + 1;
   }
   return $nro_ctaf; 
}
?>
<?php
function montos_recuperados($cred,$fec,$tip) 
{
$fec_r = cambiaf_a_mysql_2($fec);

 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
if ($tip == 1){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               ((CART_DTRA_CCON between 131 and 134) or (CART_DTRA_CCON between 531 and 531))
			    and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
			 }
 if ($tip == 4){
 // echo $fec_r, $cred,$tip; 
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 138 and 138) 
			    and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
			 }
 if ($tip == 5){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               ((CART_DTRA_CCON between 513 and 513) or (CART_DTRA_CCON = 138))
			    and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
 if ($tip == 6){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 515 and 515) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  if ($tip == 2){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' 
                and  CART_DTRA_FECHA > '2010-09-30' and
               (CART_DTRA_CCON between 212 and 215) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DTRA_IMPO)'];
			   }
			
             return $monto;		  
}
	
?>
<?php
function montos_recupera_dos($cred,$fec,$tip) 
{
$fec_r = $fec;
//echo $fec_r, $cred,$tip;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
if ($tip == 1){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 131 and 133) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
 if ($tip == 5){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 513 and 515) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  if ($tip == 2){  
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 212 and 215) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 }
  $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DTRA_IMPO)'];
		     }
             return $monto;		  
}
	
?>
<?php
function monto_aho_cta_p($cred,$nro_cta)
{
//$fec_r = $fec;
//echo $fec_r, $cred,$tip;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$nro_cta' 
                and (CART_DTRA_CCON between 212 and 215) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_FECHA < '2010-09-30'
				 and CART_DTRA_USR_BAJA is null ";
 
  $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DTRA_IMPO)'];
		     }
             return $monto;		  
}
	
?>
<?php
function monto_aho_cab($cred,$nro_cta)
{
//$fec_r = $fec;
//echo $fec_r, $cred,$tip;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran, cart_cabecera where CART_DTRA_NCRE = $cred 
                           and CART_CAB_NRO_CTA = $nro_cta 
                and (CART_DTRA_CCON between 212 and 215) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_NRO_TRAN = CART_CAB_NRO_TRAN 
				 and CART_DTRA_USR_BAJA is null ";
 
  $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DTRA_IMPO)'];
		     }
             return $monto;		  
}
	
?>
<?php
function monto_aho_cuota($cred,$f_fec)
{
//echo $cred," -",$f_fec;
$cta_aho = 0;
  $con_dtra  = "Select sum(CART_PLD_AHORRO) From cart_plandp where CART_PLD_NCRE=$cred 
                 and CART_PLD_FECHA ='$f_fec'
                 and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $cta_aho = $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
    return $cta_aho;		  
}
	
?>
<?php
function monto_aho_cuotas($cred,$f_fec,$f_pro)
{
//echo $cred," -",$f_fec;
$cta_aho = 0;
  $con_dtra  = "Select sum(CART_PLD_AHORRO) From cart_plandp where CART_PLD_NCRE=$cred 
                 and (CART_PLD_FECHA >='$f_fec' and CART_PLD_FECHA <='$f_pro')
                 and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $cta_aho = $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
    return $cta_aho;		  
}
	
?>
<?php
function montos_devengados($cred,$fec,$tip) 
{
$fec_r = cambiaf_a_mysql_2($fec);

 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
  	 
  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred 
                and CART_DTRA_FECHA <= '$fec_r' and 
               (CART_DTRA_CCON between 138 and 138) 
			    and CART_DTRA_TIP_TRAN = 4 and CART_DTRA_USR_BAJA is null ";
			
  $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DTRA_IMPO)'];
				 
		     }
		
             return $monto;		  
}
	
?>



 <?php
function montos_dep_fgar($cred,$fec,$tip) 
{
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran, fond_maestro where FOND_NRO_CRED = $cred and  FOND_DTRA_FECHA <= '$fec' and FOND_DTRA_TIP_TRAN = $tip and FOND_DTRA_USR_BAJA is null and FOND_MAE_USR_BAJA is null ";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deuda_c($cred,$fec) 
{
$f_has = $fec;
//echo $f_has;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_CAPITAL) From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <= '$f_has' and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_CAPITAL)'];
		  }
			  
  return $monto;
  	  
	}
	
?>
 <?php
function monto_deuda_i($cred,$fec) 
{
//echo $fec;
$f_has = $fec;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_INTERES) From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <= '$f_has' and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_INTERES)'];
		  }
		  
  return $monto;		  
	}
	
?>
 <?php
function monto_deuda_a($cred,$fec) 
{
$f_has = $fec;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_AHORRO) From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <= '$f_has' and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deuda_t($cred,$fec) 
{
 //$f_has = cambiaf_a_mysql($fec);
 $f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_CAPITAL),sum(CART_PLD_INTERES),sum(CART_PLD_AHORRO)
                From cart_plandp where CART_PLD_NCRE=$cred 
				and CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_CAPITAL)']+
		           $lin_dtra['sum(CART_PLD_INTERES)'];
//				   $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
<?php
function monto_deuda_tf($cred,$fec) 
{
 //$f_has = cambiaf_a_mysql($fec);
 $f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CART_PLD_CAPITAL),sum(CART_PLD_INTERES),sum(CART_PLD_AHORRO)
                From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_FECHA <='$f_has' and  CART_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CART_PLD_CAPITAL)']+
		           $lin_dtra['sum(CART_PLD_INTERES)'];
//				   $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deu_cs($sol,$cli,$fec) 
{
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_CAPITAL) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$fec' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CRED_PLD_CAPITAL)'];
		  }
  return $monto;		  
	}
	
?>
<?php
function monto_deu_is($sol,$cli,$fec) 
{
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_INTERES) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$fec' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CRED_PLD_INTERES)'];
		  }
  return $monto;		  
	}
	
?>
<?php
function monto_deu_as($sol,$cli,$fec) 
{
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_AHORRO) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$fec' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $lin_dtra['sum(CRED_PLD_AHORRO)'];
		  }
  return $monto;		  
	}
	
?>
 <?php
function monto_deu_ts($sol,$cli,$fec) 
{
//$f_has = cambiaf_a_mysql($fec);
$f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto = 0;
  
  $con_dtra  = "Select sum(CRED_PLD_CAPITAL),sum(CRED_PLD_INTERES), sum(CRED_PLD_AHORRO) From cred_plandp where CRED_PLD_COD_SOL=$sol and CRED_PLD_COD_CLI=$cli  and CRED_PLD_FECHA <= '$f_has' and CRED_PLD_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto = $monto + ($lin_dtra['sum(CRED_PLD_CAPITAL)']+
		                     $lin_dtra['sum(CRED_PLD_INTERES)']+
							 $lin_dtra['sum(CRED_PLD_AHORRO)']);
		  }
  return $monto;		  
	}
	
?>
<?php
function  montos_recu_cli($sol,$fec,$cli,$tip) 
//monto_deu_a($sol,$cli,$fec) 
{
$f_has = cambiaf_a_mysql($fec);
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $monto_c = 0;
  $monto_i = 0;
  $monto_f = 0;
  $monto_t = 0; 
  $con_dtra  = "Select sum(CRED_PLP_MONTO), sum(CRED_PLP_CAPITAL),sum(CRED_PLP_INTERES), sum(CRED_PLP_AHORRO)  From cred_plandp_pag where CRED_PLP_COD_SOL=$sol and CRED_PLP_COD_CLI=$cli  and CRED_PLP_FECHA <= '$f_has' and CRED_PLP_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $monto_t = $lin_dtra['sum(CRED_PLP_MONTO)'];
	      $monto_c = $lin_dtra['sum(CRED_PLP_CAPITAL)'];
		  $monto_i = $lin_dtra['sum(CRED_PLP_INTERES)'];
		  $monto_f = $lin_dtra['sum(CRED_PLP_AHORRO)'];
		  }
	//echo $monto_c,$monto_i,$monto_f;	  
	if ($tip == 1){
	   return $monto_c;
	 } 
	 if ($tip == 2){
	   return $monto_i;
	 } 
	 if ($tip == 3){
	   return $monto_f;
	 } 
	 if ($tip == 4){
	   return $monto_t;
	 } 
	  		  
	}
	
?>

<?php
function validar_deu_cred($cod_cli,$nro_c)
{
$con_sdeu = "Select CART_DEU_INTERNO From cart_deudor where CART_DEU_INTERNO = '$cod_cli' and CART_DEU_NCRED = $nro_c and CART_DEU_USR_BAJA is null";
$res_sdeu = mysql_query($con_sdeu);
$linea = mysql_fetch_array($res_sdeu);
$cli_con = $linea['CART_DEU_INTERNO'];
if (empty($cli_con)) {
   return false;
   }else{
   return true;
	}
}
?>
 <?php
function saldo_c($cred,$fec,$f_tra) 
{
$f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $saldo = 0;
  $deuda = 0;
  $pago = 0;
  $con_dtra  = "Select sum(CART_PLD_CAPITAL) From cart_plandp where CART_PLD_NCRE=$cred 
                and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $lin_dtra['sum(CART_PLD_CAPITAL)'];
		  }
 $con_ptra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$f_tra' and    SUBSTRING(CART_DTRA_CTA_CBT,1,2) = 13 and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_ptra = mysql_query($con_ptra);
	while ($lin_ptra = mysql_fetch_array($res_ptra)) {
	      $pago = $lin_ptra['sum(CART_DTRA_IMPO)'];
		  }		  
		  
  $saldo = $deuda - $pago;	  
  return $saldo;		  
	}
	
?>
 <?php
function ult_cta_pag($cred,$fec_p) 
{
$f_has = $fec;
//echo $fec;
 //DEUDA EN LA MONEDA DEL CREDITO
  $saldo = 0;
  $deuda = 0;
  $pago = 0;
  $con_dtra  = "Select sum(CART_PLD_CAPITAL) From cart_plandp where CART_PLD_NCRE=$cred 
                and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $lin_dtra['sum(CART_PLD_CAPITAL)'];
		  }
 $con_ptra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$f_tra' and    SUBSTRING(CART_DTRA_CTA_CBT,1,2) = 13 and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_ptra = mysql_query($con_ptra) ;
	while ($lin_ptra = mysql_fetch_array($res_ptra)) {
	      $pago = $lin_ptra['sum(CART_DTRA_IMPO)'];
		  }		  
		  
  $saldo = $deuda - $pago;	  
  return $saldo;		  
	}
?>	
<?php
function cta_pag($cred) {
  $saldo = 0;
  $deuda = 0;
  $pago = 0;
  $con_dtra  = "Select * From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_STAT= 'C' and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $deuda + 1;
		  }
    return $deuda;		  
}
	
?>
<?php
function vto_fin($cred) {
  $fec_f = "";
  $con_dtra  = "Select CART_PLD_FECHA From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_USR_BAJA is null
                 ORDER BY CART_PLD_FECHA DESC LIMIT 0,1";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $fec_f = $lin_dtra['CART_PLD_FECHA'];
		  }
    return $fec_f;		  
}
	
?>
<?php
function ult_pag($cred) {
  $fec_f = "";
  $con_dtra  = "Select CART_DTRA_FECHA From cart_det_tran where CART_DTRA_NCRE=$cred
                and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null
                 ORDER BY CART_DTRA_FECHA DESC LIMIT 0,1";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $fec_f = $lin_dtra['CART_DTRA_FECHA'];
		  }
    return $fec_f;		  
}
	
?>
<?php
function cta_ven($cred) {
   $deuda = 0;
   $con_dtra  = "Select * From cart_plandp where CART_PLD_NCRE=$cred and CART_PLD_STAT= 'M' and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $deuda = $deuda + 1;
		  }
    return $deuda;		  
}
?>
<?php
function cta_venf($cred) {
  $fec_f = "";
  $con_dtra  = "Select CART_PLD_FECHA From cart_plandp where CART_PLD_NCRE=$cred 
                 and CART_PLD_STAT <> 'C' and CART_PLD_USR_BAJA is null
                ORDER BY CART_PLD_FECHA ASC LIMIT 0,1";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $fec_f = $lin_dtra['CART_PLD_FECHA'];
		  }
    return $fec_f;	
}
?>

 <?php
function monto_aho_cta($cred,$f_fec) 
{
$cta_aho = 0;
  $con_dtra  = "Select sum(CART_PLD_AHORRO) From cart_plandp where CART_PLD_NCRE=$cred 
                 and CART_PLD_FECHA <='$f_fec' 
                 and CART_PLD_USR_BAJA is null";
 
  $res_dtra = mysql_query($con_dtra);
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $cta_aho = $lin_dtra['sum(CART_PLD_AHORRO)'];
		  }
    return $cta_aho;	
}
?>
<?php
function montos_condonados($cred,$fec,$tip) 
{
$fec_r = cambiaf_a_mysql_2($fec);
//echo $fec_r.encadenar(2). $cred.encadenar(2).$tip;
 //RECUPERACIONES HASTA LA FECHA EN LA MONEDA DEL CREDITO
  $monto = 0;
 
//if ($tip == 1){  
//  $con_dtra  = "Select sum(CART_DTRA_IMPO) From cart_det_tran where CART_DTRA_NCRE = $cred and CART_DTRA_FECHA <= '$fec_r' and 
 //              (CART_DTRA_CCON between 131 and 133) and CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null ";
// }
 if ($tip == 5){  
  $con_dtra  = "Select sum(CART_DET_CON_IMPO_N) From cart_det_cond where
                CART_DET_CON_NCRE = $cred and CART_DET_CON_FCH_PRO <= '$fec_r' and 
               (CART_DET_CON_CODIGO between 513 and 514) and CART_DET_CON_USR_BAJA is null ";
 }
 if ($tip == 6){  
  $con_dtra  = "Select sum(CART_DET_CON_IMPO_N) From cart_det_cond where CART_DET_CON_NCRE = $cred 
                and CART_DET_CON_FCH_PRO = '$fec_r' and 
               (CART_DET_CON_CODIGO between 515 and 515) and CART_DET_CON_USR_BAJA is null ";
 }
if ($tip == 7){  
  $con_dtra  = "Select sum(CART_DET_CON_IMPO_N) From cart_det_cond where
                CART_DET_CON_NCRE = $cred and CART_DET_CON_FCH_PRO <= '$fec_r' and 
               (CART_DET_CON_CODIGO between 138 and 138) and CART_DET_CON_USR_BAJA is null ";
 }
  if ($tip == 8){  
  $con_dtra  = "Select sum(CART_DET_CON_IMPO_N) From cart_det_cond where
                CART_DET_CON_NCRE = $cred and CART_DET_CON_FCH_PRO = '$fec_r' and 
               (CART_DET_CON_CODIGO between 525 and 525) and CART_DET_CON_USR_BAJA is null ";
 }
  $res_dtra = mysql_query($con_dtra);
   	        while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	              $monto = $lin_dtra['sum(CART_DET_CON_IMPO_N)'];
			 //	  echo "monto func",$monto;
		     }
             return $monto;		  
}
	
?>
<?php
function leer_nro_co_ingegr($tipo) 
{
$consulta  = "SELECT caja_ingegr_corr FROM caja_ing_egre where caja_ingegr_tipo = $tipo and
              caja_ingegr_usr_baja is null ORDER BY caja_ingegr_corr 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['caja_ingegr_corr'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function leer_nro_co_cjach($tipo) 
{
$consulta  = "SELECT CJCH_TRAN_NRO_COR FROM cjach_transac where CJCH_TRAN_TIPO_OPE = $tipo and
              CJCH_TRAN_USR_BAJA is null ORDER BY CJCH_TRAN_NRO_COR 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CJCH_TRAN_NRO_COR'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>

<?php
function leer_nro_co_comven($tipo) 
{
$consulta  = "SELECT caja_comven_corr FROM caja_com_ven where  caja_comven_tipo = $tipo and
              caja_comven_usr_baja is null ORDER BY caja_comven_corr 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['caja_comven_corr'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function leer_nro_tr_banco($tipo) 
{
//echo $tipo."tipo";
$consulta  = "SELECT CAJA_DEP_NRO FROM caja_deposito where CAJA_DEP_TIPO = '$tipo' and
              CAJA_DEP_USR_BAJA is null ORDER BY CAJA_DEP_NRO
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CAJA_DEP_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>











<?php
function leer_nro_co_con() 
{
$consulta  = "SELECT CONTA_TRS_NRO FROM contab_trans where  
              CONTA_TRS_USR_BAJA is null ORDER BY CONTA_TRS_NRO
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CONTA_TRS_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function verif_cierre_cja($fec_ult,$log_usr,$mone) 
{
//echo "aqui".$log_usr,$fec_ult;
if ($mone == 1){
   $con_trc = "SELECT CAJERO_FIN1 FROM cajero where CAJERO_LOGIN = '$log_usr'
              and CAJERO_FECHA = '$fec_ult'";
   $res_trc = mysql_query($con_trc);
   while ($lin_trc = mysql_fetch_array($res_trc)) {
      $estad =  $lin_trc['CAJERO_FIN1'];
      }
 } 
 if ($mone == 2){
   $con_trc = "SELECT CAJERO_FIN2 FROM cajero where CAJERO_LOGIN = '$log_usr'
              and CAJERO_FECHA = '$fec_ult'";
   $res_trc = mysql_query($con_trc);
   while ($lin_trc = mysql_fetch_array($res_trc)) {
      $estad =  $lin_trc['CAJERO_FIN2'];
      }
 } 
if (isset($estad)){
    }else{
	$estad = 0;
	}   
return  $estad;
}
?>
<?php
function verif_cajero_hab($fec_ult,$log_usr) 
{
//echo "aqui".$log_usr,$fec_ult;
//if ($mone == 1){
   $con_trc = "SELECT count(*) 
              FROM cajero 
              WHERE CAJERO_LOGIN = '$log_usr'
              and CAJERO_FECHA = '$fec_ult'";
   $res_trc = mysql_query($con_trc);
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $estad =  $lin_trc['count(*)'];
      }
 //} 
 
if (isset($estad)){

    }else{
	     $estad = 0;
	}   
return  $estad;
}
?>
<?php
function verif_cierre_dia($fec_ult) 
{
//echo "aqui".$log_usr,$fec_ult;
//if ($mone == 1){
   $con_trc = "SELECT count(*) FROM gral_cierre_mod where GRAL_CIERR_MOD_FCH_CIERRE = '$fec_ult'";
   $res_trc = mysql_query($con_trc);
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $estad =  $lin_trc['count(*)'];
      }
 //} 
 
if (isset($estad)){
    }else{
	$estad = 0;
	} 
 $_SESSION['cierre_dia'] = $estad;	  
return  $estad;
}
?>
<?php
function sal_mayor($cta,$fec_cal,$mon,$gestion) 
{
$debe = 0;
$haber = 0;
$debe_2 = 0;
$haber_2 = 0;
//echo $gestion;
if ($gestion == 2010){	
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";
}else{								   
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";	
	}						   						   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
	if ($gestion == 2010){	
	          $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";
				}else{				   					
				  $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA = '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";
							}   
				  $res_tran = mysql_query($sum_tran);

				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			} 
$tip = substr($cta,0,1);
//echo $tip;

					
if ($mon == 1){						
    $saldo = $debe - $haber;
	}
if ($mon == 2){						
    $saldo =  $debe_2 - $haber_2;
	}
	
if ($tip == '4'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}
if ($tip == '2'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}
if ($tip == '3'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}		
//echo "func".$saldo;
return $saldo;		
}



?>
<?php
function sal_mayor2($cta,$fec_cal,$mon,$gestion) 
{
$debe = 0;
$haber = 0;
$debe_2 = 0;
$haber_2 = 0;
//$gestion = 2010;
if ($gestion == 2010){	
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";
	}else{	
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";	
	}						   					   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
	if ($gestion == 2010){						
				  $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA = '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null ";
				 
	}else{	
				$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";	
							   
		}	
		 $res_tran = mysql_query($sum_tran);				   			  
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			} 
$tip = substr($cta,0,1);
//echo $tip;

					
if ($mon == 1){						
    $saldo = $debe - $haber;
	}
if ($mon == 2){						
    $saldo =  $debe_2 - $haber_2;
	}
	
if ($tip == '4'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}
if ($tip == '2'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}	
if ($tip == '3'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}	
	
//echo "func".$saldo;
return $saldo;		
}
?>
<?php
function leer_fechr_pro($nrotra) 
{
$consulta  = "SELECT CAJA_TRAN_FCH_HR_ALTA FROM caja_transac where CAJA_TRAN_NRO_DOC = $nrotra
               ORDER BY CAJA_TRAN_FCH_HR_ALTA 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CAJA_TRAN_FCH_HR_ALTA'];
return $nro_tran; 
}
?>
<?php
function leer_fechr_pro_ie($nrotra) 
{
$consulta  = "SELECT caja_ingegr_fch_hra_alta FROM caja_ing_egre where caja_ingegr_corr = $nrotra
               ORDER BY caja_ingegr_fch_hra_alta
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['caja_ingegr_fch_hra_alta'];
return $nro_tran; 
}
?>
<?php
function leer_fechr_cjach($nrotra) 
{
$consulta  = "SELECT CJCH_TRAN_FCH_HR_ALTA FROM cjach_transac where CJCH_TRAN_NRO_COR = $nrotra
               ORDER BY CJCH_TRAN_FCH_HR_ALTA 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CJCH_TRAN_FCH_HR_ALTA'];
return $nro_tran; 
}
?>
<?php
function compararFechas($primera, $segunda)   
 {   
  $valoresPrimera = explode ("/", $primera);      
  $valoresSegunda = explode ("/", $segunda);    
  $diaPrimera    = $valoresPrimera[0];     
  $mesPrimera  = $valoresPrimera[1];     
  $anyoPrimera   = $valoresPrimera[2];    
  $diaSegunda   = $valoresSegunda[0];     
  $mesSegunda = $valoresSegunda[1];     
  $anyoSegunda  = $valoresSegunda[2];   
  $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);     
  $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);        
  if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){   
    // "La fecha ".$primera." no es válida";   
    return 0;   
  }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){   
    // "La fecha ".$segunda." no es válida";   
    return 0;   
  }else{   
    return  $diasPrimeraJuliano - $diasSegundaJuliano;   
  }    
}   
?>
<?php
function calculo_itf($monto)   
 {  
 //echo $monto.encadenar(2); 
  $itf = ($monto * 1.5)/1000;
 // $_SESSION['itf'] = $itf;
 // echo $itf."calculado itf";
    return  0;   
     
}   
?>
<?php
function leer_nro_condona() 
{
$consulta  = "SELECT CART_DET_CON_TIP_TRAN FROM cart_det_cond where 
              CART_DET_CON_USR_BAJA is null ORDER BY CART_DET_CON_TIP_TRAN 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CART_DET_CON_TIP_TRAN'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }
return $nro_tran; 
}
?>
<?php
function leer_fechr_con($nrotra) 
{
$consulta  = "SELECT CART_DET_CON_CHR_FCH_ALTA FROM cart_det_cond where 
               CART_DET_CON_TIP_TRAN = $nrotra
               ORDER BY CART_DET_CON_CHR_FCH_ALTA 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CART_DET_CON_CHR_FCH_ALTA'];
return $nro_tran; 
}
?>


<?php
function nro_dias($fec_1,$fec_2) 
{

                $fec_uno = ($fec_1);
				$fec_dos = ($fec_2);
				$ano1 = substr($fec_uno, 6,4); 
                $mes1 = substr($fec_uno, 3, 2); 
                $dia1 = substr($fec_uno, 0, 2);
                $ano2 = substr($fec_dos, 6,4); 
                $mes2 = substr($fec_dos, 3, 2); 
                $dia2 = substr($fec_dos, 0, 2);
			//	$cap = round( $cap - $c_kap,2);
			//	}
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
		 $nro_dias = round( ($segundos_diferencia / (60 * 60 * 24)),0); 
		 echo "funcion",$nro_dias ;
		 return $nro_dias;
}
?>
<?php
function mes_lit($mes) 
{
echo $mes;
if ($mes == 01){
    $mes_l = "Enero";
 } 
 if ($mes == 2){
    $mes_l = "Febrero";
 }
 if ($mes == 3){
    $mes_l = "Marzo";
 }
 if ($mes == 4){
    $mes_l = "Abril";
 }
 if ($mes == 5){
    $mes_l = "Mayo";
 }
 if ($mes == 6){
    $mes_l = "Junio";
 }
 if ($mes == 7){
    $mes_l = "Julio";
 }
 if ($mes == 8){
    $mes_l = "Agosto";
 }
 if ($mes == 9){
    $mes_l = "Septiembre";
 }
 if ($mes == 10){
    $mes_l = "Octubre";
 }
 if ($mes == 11){
    $mes_l = "Noviembre";
 }
 if ($mes == 12){
    $mes_l = "Diciembre";
 }
return $mes_l;
}
//}
?>