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
    //echo "prueba";
?>
<?php
$_SESSION['error'] = "";
$r = 0;
$log_usr = $_SESSION['login']; 
$nom = $_POST["nombres"];
$nom = strtoupper($nom);
$fch_ini = $_POST["fec_ini"];
$fch_ini1 = cambiaf_a_mysql($fch_ini);

$fch_fin = $_POST["fec_fin"];
$fch_fin1 = cambiaf_a_mysql($fch_fin);

$tipo = $_POST["tipo"];
$cod=cod_incrementable($tipo);
//echo $cod;
$desc = $_POST["desc"];
$cons="Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
               From gral_param_propios 
               where GRAL_PAR_PRO_GRP = 1700 and GRAL_PAR_PRO_COD=1";
    $res= mysql_query($cons);
    $linea= mysql_fetch_array($res);

$est=$linea['GRAL_PAR_PRO_COD'];
    		

if (validar_proveedor($cod)) {
//$est = $_POST["estado"];

	echo "validar";
//header('Location: alm_proveedor_mod_al.php');
      $_SESSION['error'] = "Documento de identificacion ya existe".encadenar(2).$cod;
 //  echo "Documento de identificacion ya existe <a href='cliente_mante_a.php'>volver a Intentar</a><br>";
  return;
}


//echo $fch_fin1;
//echo $log_usr."-".$nom."-".$fch_ini1."-".$fch_fin1 ."-". $cod."-".$tipo."-".$cod."-".$desc."-".$est;
//echo $c_i ."-". $ex_id ."-". $c_i ."-".  $nom ."-". $a_pat ."-". $a_mat;
   
    $consulta  = "Insert into alm_proyecto   ( alm_proy_cod,
	                                           alm_proy_nom,
	                                           alm_proy_fecha_inicio,
	                                           alm_proy_fecha_fin,
	                                           alm_proy_tipo,
	                                           alm_proy_estado,
	                                           alm_proy_usr_alta,
	                                           alm_proy_fch_hr_alta,
	                                           alm_proy_usr_baja,
	                                           alm_proy_fch_hr_baja,
	                                           alm_proy_descripcion) values
											   ('$cod',
											   	'$nom',
											    '$fch_ini1',
											    '$fch_fin1',
											    '$tipo',
											    '$est',
											    '$log_usr',
											     null,
											     null,
											    '0000-00-00 00:00:00',
												'$desc')";
//print_r($consulta);
$resultado = mysql_query($consulta);

header('Location: alm_proyecto_cons.php');
 
?>
<?php
}
ob_end_flush();
 ?>