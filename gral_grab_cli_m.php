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
$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login']; 
$est_civ = $_POST["cod_civ"];
$cod_ger = $_POST["cod_sex"];
$agen = $_POST["cod_agencia"];
$c_i = $_SESSION['ci'];
$tper = $_POST["tip_per"];
$csex = $_POST["cod_sex"];
$cciv = $_POST["cod_civ"]; 
$tdoc = $_SESSION['tip_doc'];
$nom = $_POST["nombres"];
$nom = strtoupper($nom);
$a_pat = $_POST["ap_pater"];
$a_pat = strtoupper($a_pat);
$a_mat = $_POST["ap_mater"]; 
$a_mat = strtoupper ($a_mat);
$a_esp = $_POST["ap_espos"]; 
$a_esp = strtoupper ($a_esp);
$fec_nac = $_POST['fec_nac']; 
$f_nac = cambiaf_a_mysql_2($fec_nac);
$l_nac = $_POST["lu_nac"]; 
$l_nac = strtoupper ($l_nac);
$t_viv = $_POST["tip_viv"];
$dir = $_POST["direc"];
$dir = strtoupper ($dir);
$zon = $_POST["zona"]; 
$zon = strtoupper ($zon);
$fon = $_POST["fono"];
 if($fon == ""){
    $fon = 0;} 
$cel = $_POST["celu"]; 
if($cel == ""){
    $cel = 0;} 
$e_m = $_POST["email"]; 
$ae_uno = $_POST["a_eco_uno"]; 
$ae_uno = strtoupper ($ae_uno);
$ae_dos = $_POST["a_eco_dos"];
$ae_dos = strtoupper ($ae_dos);
$cciiu = $_POST["cod_ciiu"]; 
$a_tr = $_POST["ant_tr"];
$d_tr = $_POST["dir_tr"];
$d_tr = strtoupper ($d_tr);
$z_tr = $_POST["zon_tr"];
$z_tr = strtoupper ($z_tr); 
$f_tr = $_POST["fon_t"]; 
$n_ref = $_POST["nom_ref"];
$n_ref = strtoupper ($n_ref); 
$d_ref = $_POST["dir_ref"];
$d_ref = strtoupper ($d_ref); 
$f_ref = $_POST["fon_ref"];
if (empty($f_ref)){
   $f_ref = 0;
   }
$n_con = $_POST["nom_con"]; 
$n_con = strtoupper ($n_con);
$c_con = $_POST["ci_con"];
$cint= $_POST["cal_int"]; 
if($f_ref == ""){
    $f_ref = 0;} 

$ccli = $_SESSION['cod_cli']; 
$nro =  $_SESSION['nro_cli'];
 echo $ccli,$_SESSION['tip_doc'],"---";
 echo $ccli."ccli".$nro."nro".$tper."tper".$tdoc."tdoc".$c_i."c_i".$nom."nom".$a_pat."a_pat".
    $a_mat."a_mat".$a_esp,"a_esp".$f_nac.$l_nac."l_nac".$csex."csex".$cciv."cciv".$d_tr."d_tr".
	$z_tr."z_tr".$f_tr."f_tr".$a_tr."a_tr".$t_viv."t_viv".$cciiu."cciuu".$dir."dir".$zon."zon".
	$fon."fon".$cel."cel".$e_m."e_m".$ae_uno."ae_uno".$ae_dos."ae_dos".$agen."agen".$cint."cint".
	$n_con."n_con".$c_con."c_con".$n_ref."n_ref".$d_ref."d_ref".$f_ref."f_ref".$log_usr."log_usr";

 $marca_baja = "update cliente_general set CLIENTE_USR_BAJA='$log_usr', CLIENTE_FCH_HR_BAJA=null where CLIENTE_COD= $ccli and  CLIENTE_USR_BAJA is null";
 $res_mbaja = mysql_query($marca_baja);
  $consulta  = "Insert into cliente_general (CLIENTE_COD,
	                                           CLIENTE_NUMERICO,
	                                           CLIENTE_COD_ANT,
											   CLIENTE_TIP_PER,
                                               CLIENTE_TIP_ID,
											   CLIENTE_COD_ID,											                        
											   CLIENTE_COD_EXP,	
											   CLIENTE_NOMBRES,
											   CLIENTE_AP_PATERNO,
											   CLIENTE_AP_MATERNO,
											   CLIENTE_AP_ESPOSO,
											   CLIENTE_FCH_NAC,
											   CLIENTE_LUG_NAC,
											   CLIENTE_SEXO,		
											   CLIENTE_EST_CIVIL,
											   CLIENTE_TRABAJO, 
											   CLIENTE_DIR_TRAB,
											   CLIENTE_ZON_TRAB,
											   CLIENTE_FONO_TRAB,
											   CLIENTE_PROFESION,
											   CLIENTE_ANT_ACT,
											   CLIENTE_CARGO,
											   CLIENTE_VIVIEN,
											   CLIENTE_ALFAB,
											   CLIENTE_CIIU,
											   CLIENTE_DIRECCION,
											   CLIENTE_ZONA,
											   CLIENTE_FONO,
											   CLIENTE_CELULAR,
											   CLIENTE_EMAIL,
											   CLIENTE_RUBRO,
											   CLIENTE_SECTOR1,
											   CLIENTE_SECTOR2,
											   CLIENTE_AGENCIA,
											   CLIENTE_CAL_INT,
											   CLIENTE_NOM_CONYUGE,
											   CLIENTE_CI_CONYUGE,
											   CLIENTE_NOM_REF,
											   CLIENTE_DIR_REF,
											   CLIENTE_FON_REF,
											   CLIENTE_USR_ALTA,
											   CLIENTE_FCH_HR_ALTA,
											   CLIENTE_USR_BAJA,
											   CLIENTE_FCH_HR_BAJA) values
											   ($ccli,
											    $nro,
											    null,
											    $tper,
											    $tdoc,
											    '$c_i',
											    null,
											    '$nom',
											    '$a_pat',
											    '$a_mat',
											    '$a_esp',
											    '$f_nac',
												'$l_nac',
											    $csex,
											    $cciv,
											    null,
											    '$d_tr',
												'$z_tr',
											    '$f_tr',
											    null,
												$a_tr,
											    null,
											    $t_viv,
											    null,
											    $cciiu,
											    '$dir', 
											    '$zon',
											    $fon,
											    $cel,
											    '$e_m',
											    null,
											    '$ae_uno',
											    '$ae_dos',
											    $agen,
											    $cint,
											    '$n_con',
											    '$c_con',
											    '$n_ref',
											    '$d_ref',
											    $f_ref,
											    '$log_usr',
											     null,
											     null,
											     '0000-00-00 00:00:00')";

$resultado = mysql_query($consulta);
 header('Location: cliente_mante.php');
?>
<?php
}
ob_end_flush();
 ?>