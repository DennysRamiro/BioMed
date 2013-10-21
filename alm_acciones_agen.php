<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
require('funciones.php');
$log = $_SESSION['login'];

if($_GET['tp'] == 'registrar'){

$nom=$_POST['nombre'];
//echo $nom;
$prefijo=substr($nom,0,3);?> <br><?php
//echo $prefijo;
$ultimo_corr =mysql_query("SELECT MAX(alm_correlativo) FROM alm_age_adu WHERE alm_age_adu_usr_baja IS NULL AND alm_age_adu_est='1'");
$corre= mysql_fetch_array($ultimo_corr);
//print_r($corre);
$corr= $corre[0] + 1;
$codigo=$prefijo.$corr;
//print_r($corr);
			$query = mysql_query("INSERT INTO alm_age_adu 
									(alm_age_adu_id,
									alm_correlativo,
									alm_age_adu_cod,
									alm_age_adu_nom, 
									alm_age_adu_dep, 
									alm_age_adu_nit, 
									alm_age_adu_dir, 
									alm_age_adu_telf,
									alm_age_adu_email,
									alm_age_adu_fax,
									alm_age_adu_est, 
									alm_age_adu_nom_nit,
									alm_age_adu_usr_alta, 
									alm_age_adu_fch_alta, 
									alm_age_adu_usr_baja,
									alm_age_adu_fch_baja) 
									VALUES 
									(NULL ,
									'$corr',
									'".utf8_encode(strtoupper($codigo))."',
									'".utf8_encode(strtoupper($_POST['nombre']))."',
									".$_POST['dep'].",
									'".utf8_encode(strtoupper($_POST['nit']))."',
									'".utf8_encode(strtoupper($_POST['dir']))."',
									'".utf8_encode(strtoupper($_POST['tel']))."',
									'".utf8_encode($_POST['email'])."',
									'".utf8_encode(strtoupper($_POST['fax']))."',
									'1',	
									NULL,
									'".$_SESSION['login']."',
									CURRENT_TIMESTAMP,
									NULL, 
									NULL)") or die ('fallo la consulta!!!');
//falalla al guardar el prefijo y elcodigooooooooooooooooooooooooooo revisar
	if($query){
		header('Location: alm_consulta_agen.php?msg=1');
	}else{
		header('Location: alm_alta_agen.php.php?msg=0');
		}
}elseif($_GET['tp'] == 'modificar'){
	
$cod_ag=$_GET['cod_agencia'];
//echo  $cod_ag;
$act_age = "UPDATE alm_age_adu SET alm_age_adu_usr_baja ='".$_SESSION['login']."',  alm_age_adu_fch_baja = CURRENT_TIMESTAMP WHERE alm_age_adu_cod ='$cod_ag';" or die ('fallo update');
		
	$consulta = mysql_query($act_age);	
	 	//echo $consulta;	
	$query_insert = "INSERT INTO alm_age_adu 
									(alm_age_adu_id,
									alm_correlativo,
									alm_age_adu_cod,
									alm_age_adu_nom, 
									alm_age_adu_dep, 
									alm_age_adu_nit, 
									alm_age_adu_dir, 
									alm_age_adu_telf,
									alm_age_adu_email,
									alm_age_adu_fax, 
									alm_age_adu_est,
									alm_age_adu_nom_nit,
									alm_age_adu_usr_alta, 
									alm_age_adu_fch_alta, 
									alm_age_adu_usr_baja,
									alm_age_adu_fch_baja) 
									VALUES 
									(NULL ,
									".$_POST['corr'].",
									'$cod_ag',
									'".utf8_encode(strtoupper($_POST['nombre']))."',
									".$_POST['dep'].",
									'".utf8_encode(strtoupper($_POST['nit']))."',
									'".utf8_encode(strtoupper($_POST['dir']))."',
									'".utf8_encode(strtoupper($_POST['tel']))."',
									'".utf8_encode($_POST['email'])."',
									'".utf8_encode(strtoupper($_POST['fax']))."',
									'".$_POST['est']."',	
									NULL,
									'".$_SESSION['login']."',
									CURRENT_TIMESTAMP,
									NULL, 
									NULL)";
									

			//echo $query_insert;						
		$query = mysql_query($query_insert) or die ('fallo la consulta insert!!!');

	if($query && $consulta){
		header('Location: alm_consulta_agen.php?msg=2');
	}else{
		header('Location: alm_alta_agen.php?msg=0');
		}
	} 
	
elseif($_GET['tp'] == 'baja'){
	
$cod_ag=$_GET['idAgen'];
//echo  $id_ag;
$act_age = "UPDATE alm_age_adu SET alm_age_adu_usr_baja ='".$_SESSION['login']."',  alm_age_adu_fch_baja = CURRENT_TIMESTAMP WHERE alm_age_adu_cod ='$cod_ag';" or die ('fallo update') or die ('fallo consulta de bajaaaaaaaa');
		
	$query = mysql_query($act_age);	
	 	//echo $consulta;	
	

	if($query ){
		//header('Location: alm_agencia.php');
		$msg = array('completo' => true);
	}else{
		//header('Location: alm_consulta_agen.php');
		$msg = array('completo' => false);
		}
		print_r(json_encode($msg));
	} 
	
ob_end_flush();
?>