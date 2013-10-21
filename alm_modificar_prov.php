<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
  require('configuracion.php');
  require('funciones.php');
  $log = $_SESSION['login'];
  $id_proveedor= $_GET['id_proveedor'];
  $consulta  = "UPDATE alm_proveedor SET  alm_prov_estado = '3',
										  alm_prov_usr_baja = '".$log."',
										  alm_prov_fch_hr_baja = CURRENT_TIMESTAMP
				  WHERE alm_prov_id ='".$id_proveedor."'";
  
  $query = mysql_query($consulta);			  

  $tipo=$_POST['tipo'];
  $nom=$_POST['nombres'];
  $nom = strtoupper($nom);
  $cont=$_POST['contacto'];
  $con=$_POST['continente'];
  $con = strtoupper($con);
  $pais=$_POST['pais'];
  $pais = strtoupper($pais);
  $ciu=$_POST['ciudad'];
  $ciu = strtoupper($ciu);
  $dir=$_POST['direc'];
  $dir = strtoupper ($dir);
  $e_m=$_POST['email'];
  $fon=$_POST['fono'];
  $cel=$_POST['celu'];
  $est=$_POST['estado'];
  $cod_ext=$_POST['cod_ext'];
  $cod_ext = strtoupper($cod_ext);
  $cod_int=$_POST['cod_int'];
  $mon=$_POST['moneda'];
  $fax=$_POST['fax'];
  $e_cont=$_POST['email_cont'];
  $cod_num=$_POST['id_proveedor_num'];
  $nom_bco=$_POST['nom_bco'];
  $nom_bco = strtoupper ($nom_bco);
  $nom_cta_bco=$_POST['nom_cta_bco'];
  $nom_cta_bco = strtoupper ($nom_cta_bco);
   $nro_cta_bco=$_POST['nro_cta_bco'];;
  $log_usr = $_SESSION['login'];
  //echo  $_POST['tipo_proveedor']; 
  $consulta  = "Insert into alm_proveedor   (  alm_prov_codigo_int,
    										   alm_prov_numerico,
    										   alm_prov_tipo,
	                                           alm_prov_codigo_ext,
	                                           alm_prov_nombre,
	                                           alm_prov_contacto,
	                                           alm_prov_email_cont,
	                                           alm_prov_moneda,
	                                           alm_prov_continente,
	                                           alm_prov_fax,
	                                           alm_prov_pais,
	                                           alm_prov_ciudad,
	                                           alm_prov_direccion,
	                                           alm_prov_email,
	                                           alm_prov_telefono,
	                                           alm_prov_celular,
	                                           alm_prov_estado,
											   alm_prov_nom_banco,
											   alm_prov_cod_banco,
											   alm_prov_cod_cta,
	                                           alm_prov_usr_alta,
	                                           alm_prov_fch_hr_alta,
	                                           alm_prov_usr_baja,
	                                           alm_prov_fch_hr_baja) values
											   ('$cod_int',
											   	'$cod_num',
											    '$tipo',
											    '$cod_ext',
											    '$nom',
											    '$cont',
											    '$e_cont',
											    '$mon',
											    '$con',
											    '$fax',
											    '$pais',
											    '$ciu',
											    '$dir',
											    '$e_m',
											    '$fon',
											    '$cel',
											    '$est',
												'$nom_bco',
												'$nom_cta_bco',
												'$nro_cta_bco',
												'$log_usr',
											     null,
											     null,
											    '0000-00-00 00:00:00')";
$query = mysql_query($consulta);
//if($query){
	header('location: alm_proveedor_mod_cons.php?menu=1');
//}else{
	//header('Location: alm_alta_prod.php?msg=1');
//}
ob_end_flush();
?>