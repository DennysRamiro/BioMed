<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
if($_GET['tp'] == 'buscar'){
	$consulta = "SELECT a.alm_age_adu_id,a.alm_age_adu_cod, a.alm_age_adu_nom, d.Name
FROM alm_age_adu a INNER JOIN city d ON	a.alm_age_adu_dep=d.ID
WHERE d.CountryCode='BOL' AND a.alm_age_adu_usr_baja is null AND a.alm_age_adu_est='1' AND 
 (a.alm_age_adu_cod like '%".$_GET['buscar']."%' OR a.alm_age_adu_nom like '%".$_GET['buscar']."%' OR d.Name like '%".$_GET['buscar']."%')";
 //echo $consulta;
	$resultado = mysql_query($consulta);
	$cont =0;
	while($row = mysql_fetch_array($resultado)){
		$array['id'] = $row['alm_age_adu_id'];
		$array['label'] = $row['alm_age_adu_cod']." ".$row['alm_age_adu_nom']." ".$row['Name'];
		$array['value'] = $row['alm_age_adu_nom'];
		$json_data[$cont] = $array;
		$cont++;
	}
	print_r(json_encode($json_data));	
}elseif($_GET['tp'] == 'selected'){

	$consulta = "SELECT  a.*, d.Name
				FROM alm_age_adu a INNER JOIN city d ON	a.alm_age_adu_dep=d.ID
				WHERE d.CountryCode='BOL' AND a.alm_age_adu_usr_baja is null AND a.alm_age_adu_est='1' AND alm_age_adu_id=".$_GET['id'];
				
	$resultado = mysql_query($consulta);
	$agen = mysql_fetch_array($resultado);
	
    $json_data['alm_age_adu_id'] = $agen['alm_age_adu_id'];
    $json_data['alm_age_adu_cod'] = $agen['alm_age_adu_cod'];
    $json_data['alm_age_adu_nom'] = $agen['alm_age_adu_nom'];
    $json_data['alm_age_adu_dep'] = $agen['alm_age_adu_dep'];
	$json_data['Name'] = $agen['Name'];
    $json_data['alm_age_adu_nit'] = $agen['alm_age_adu_nit'];
	$json_data['alm_age_adu_dir'] = $agen['alm_age_adu_dir'];
    $json_data['alm_age_adu_telf'] = $agen['alm_age_adu_telf'];
    $json_data['alm_age_adu_email'] = $agen['alm_age_adu_email'];
    $json_data['alm_age_adu_fax'] = $agen['alm_age_adu_fax'];
    $json_data['alm_age_adu_est'] = $agen['alm_age_adu_est'];

	print_r(json_encode($json_data));
	
}elseif($_GET['tp']=='list'){
    $consulta = "SELECT a.*, d.Name
				FROM alm_age_adu a INNER JOIN city d ON	a.alm_age_adu_dep=d.ID
				WHERE d.CountryCode='BOL' AND a.alm_age_adu_usr_baja is null AND a.alm_age_adu_est='1' AND (a.alm_age_adu_cod like '%".$_GET['age']."%' OR a.alm_age_adu_nom like '%".$_GET['age']."%' OR d.Name like '%".$_GET['age']."%')";
				//echo  $consulta;
    $cont =0;
    $resultado = mysql_query($consulta);
    while($agen = mysql_fetch_array($resultado)){
		
		$json_data['alm_age_adu_id'] = $agen['alm_age_adu_id'];
		$json_data['alm_age_adu_cod'] = $agen['alm_age_adu_cod'];
		$json_data['alm_age_adu_nom'] = $agen['alm_age_adu_nom'];
		$json_data['alm_age_adu_dep'] = $agen['alm_age_adu_dep'];
		$json_data['Name'] = $agen['Name'];
		$json_data['alm_age_adu_nit'] = $agen['alm_age_adu_nit'];
		$json_data['alm_age_adu_dir'] = $agen['alm_age_adu_dir'];
		$json_data['alm_age_adu_telf'] = $agen['alm_age_adu_telf'];
		$json_data['alm_age_adu_email'] = $agen['alm_age_adu_email'];
		$json_data['alm_age_adu_fax'] = $agen['alm_age_adu_fax'];
		$json_data['alm_age_adu_est'] = $agen['alm_age_adu_est'];

        $array[$cont] = $json_data;
        $cont++;
    }
    print_r(json_encode($array));
}

?>