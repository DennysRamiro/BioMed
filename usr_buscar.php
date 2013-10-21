<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
//require('funciones.php');
if ($_GET['accion']=='buscar') {

	//console.log($_GET['accion']);
 	
 	
$consulta="SELECT DISTINCT u.GRAL_USR_CARGO,pp.gral_par_pro_cod,u.GRAL_USR_CI, u.GRAL_USR_LOGIN, 
u.GRAL_USR_NOMBRES, u.GRAL_USR_AP_PATERNO, u.GRAL_USR_AP_MATERNO, u.GRAL_USR_DIRECCION, 
u.GRAL_USR_TELEFONO, u.GRAL_USR_CELULAR, u.GRAL_USR_EMAIL
FROM gral_usuario as u, gral_param_propios as pp 
WHERE u.gral_usr_cargo=pp.gral_par_pro_cod and (u.GRAL_USR_USR_BAJA=' ' or u.GRAL_USR_USR_BAJA is null) and (GRAL_USR_AP_PATERNO like '%".$_GET['usuario']."%' or GRAL_USR_CI like '%".$_GET['usuario']."%' or GRAL_PAR_PRO_DESC like '%".$_GET['usuario']."%' or GRAL_USR_NOMBRES like '%".$_GET['usuario']."%')";


	$resultado = mysql_query($consulta);
	$cont =0;
	while($row = mysql_fetch_array($resultado)){

		    $array['id'] = $row['GRAL_USR_CI'];
			$array['label'] = $row['GRAL_USR_NOMBRES']." ".$row['GRAL_USR_AP_PATERNO']." ".$row['GRAL_USR_AP_MATERNO'];
			$array['value'] = $row['GRAL_USR_NOMBRES'];
			$json_data[$cont] = $array;
		    $cont++;
	}
	print_r(json_encode($json_data));	


}elseif($_GET['accion'] == 'seleccionado'){
	
	$consulta="SELECT DISTINCT u.GRAL_USR_CARGO,pp.gral_par_pro_cod,u.GRAL_USR_CI, u.GRAL_USR_LOGIN, 
u.GRAL_USR_NOMBRES, u.GRAL_USR_AP_PATERNO, u.GRAL_USR_AP_MATERNO, u.GRAL_USR_DIRECCION, 
u.GRAL_USR_TELEFONO, u.GRAL_USR_CELULAR, u.GRAL_USR_EMAIL,pp.GRAL_PAR_PRO_DESC
FROM gral_usuario as u, gral_param_propios as pp
 				WHERE pp.GRAL_PAR_PRO_COD = u.GRAL_USR_CARGO  and u.GRAL_USR_CI = '". $_GET['ci']."'";
 	

 
 	$resultado = mysql_query($consulta);
 	$linea= mysql_fetch_array($resultado);

 	$json_data['GRAL_USR_CI'] = $linea['GRAL_USR_CI'];
 	$json_data['GRAL_USR_LOGIN'] = $linea['GRAL_USR_LOGIN'];
 	$json_data['GRAL_USR_NOMBRES'] = $linea['GRAL_USR_NOMBRES'];
 	$json_data['GRAL_USR_AP_PATERNO'] = $linea['GRAL_USR_AP_PATERNO'];
 	$json_data['GRAL_USR_AP_MATERNO'] = $linea['GRAL_USR_AP_MATERNO'];
 	$json_data['GRAL_USR_DIRECCION'] = $linea['GRAL_USR_DIRECCION'];
 	$json_data['GRAL_USR_TELEFONO'] = $linea['GRAL_USR_TELEFONO'];
 	$json_data['GRAL_USR_CELULAR'] = $linea['GRAL_USR_CELULAR'];
 	$json_data['GRAL_USR_EMAIL'] = $linea['GRAL_USR_EMAIL'];
 	$json_data['GRAL_PAR_PRO_DESC'] = $linea['GRAL_PAR_PRO_DESC'];

 	print_r(json_encode($json_data));


}elseif($_GET['accion']=='list'){


/*
$consulta="SELECT DISTINCT u.GRAL_USR_CARGO,pp.gral_par_pro_cod,u.GRAL_USR_CI, u.GRAL_USR_LOGIN, 
u.GRAL_USR_NOMBRES, u.GRAL_USR_AP_PATERNO, u.GRAL_USR_AP_MATERNO, u.GRAL_USR_DIRECCION, 
u.GRAL_USR_TELEFONO, u.GRAL_USR_CELULAR, u.GRAL_USR_EMAIL,u.GRAL_PAR_PRO_DESC
FROM gral_usuario as u, gral_param_propios as pp 
WHERE u.gral_usr_cargo=pp.gral_par_pro_cod and (u.GRAL_USR_USR_BAJA=' ' or u.GRAL_USR_USR_BAJA is null) and (GRAL_USR_AP_PATERNO like '%".$_GET['usuario']."%' or GRAL_USR_CI like '%".$_GET['usuario']."%' or GRAL_PAR_PRO_DESC like '%".$_GET['usuario']."%' or GRAL_USR_NOMBRES like '%".$_GET['usuario']."%')";
*/



$consulta="SELECT GRAL_USR_CARGO,gral_par_pro_cod,GRAL_USR_CI, GRAL_USR_LOGIN, 
GRAL_USR_NOMBRES, GRAL_USR_AP_PATERNO, GRAL_USR_AP_MATERNO, GRAL_USR_DIRECCION, 
GRAL_USR_TELEFONO, GRAL_USR_CELULAR, GRAL_USR_EMAIL, GRAL_PAR_PRO_DESC
FROM gral_usuario, gral_param_propios 
WHERE gral_param_propios.GRAL_PAR_PRO_GRP=300 AND (GRAL_USR_USR_BAJA = '' OR GRAL_USR_USR_BAJA is null)    
AND GRAL_USR_ESTADO=1 
AND gral_param_propios.GRAL_PAR_PRO_COD = gral_usuario.GRAL_USR_CARGO 
and (GRAL_USR_AP_PATERNO like '%".$_GET['usuario']."%' or GRAL_USR_CI like '%".$_GET['usuario']."%' or GRAL_USR_NOMBRES like '%".$_GET['usuario']."%' or GRAL_USR_LOGIN like '%".$_GET['usuario']."%' or GRAL_PAR_PRO_DESC like '%".$_GET['usuario']."%')
ORDER BY GRAL_USR_LOGIN";



//echo $consulta;

/*
$consulta="SELECT DISTINCT u.GRAL_USR_CARGO,pp.gral_par_pro_cod,u.GRAL_USR_CI, u.GRAL_USR_LOGIN, 
u.GRAL_USR_NOMBRES, u.GRAL_USR_AP_PATERNO, u.GRAL_USR_AP_MATERNO, u.GRAL_USR_DIRECCION, 
u.GRAL_USR_TELEFONO, u.GRAL_USR_CELULAR, u.GRAL_USR_EMAIL, pp.GRAL_PAR_PRO_DESC
FROM gral_usuario as u, gral_param_propios as pp 
WHERE u.gral_usr_cargo=pp.gral_par_pro_cod and (u.GRAL_USR_USR_BAJA=' ' or u.GRAL_USR_USR_BAJA is null) and (GRAL_USR_AP_PATERNO like '%".$_GET['usuario']."%' or GRAL_USR_CI like '%".$_GET['usuario']."%' or GRAL_PAR_PRO_DESC like '%".$_GET['usuario']."%' or GRAL_USR_NOMBRES like '%".$_GET['usuario']."%')";

*/
	$resultado = mysql_query($consulta);
	$linea= mysql_fetch_array($resultado);
	
	$json_data['GRAL_USR_CI'] = $linea['GRAL_USR_CI'];
 	$json_data['GRAL_USR_LOGIN'] = $linea['GRAL_USR_LOGIN'];
 	$json_data['GRAL_USR_NOMBRES'] = $linea['GRAL_USR_NOMBRES'];
 	$json_data['GRAL_USR_AP_PATERNO'] = $linea['GRAL_USR_AP_PATERNO'];
 	$json_data['GRAL_USR_AP_MATERNO'] = $linea['GRAL_USR_AP_MATERNO'];
 	$json_data['GRAL_USR_DIRECCION'] = $linea['GRAL_USR_DIRECCION'];
 	$json_data['GRAL_USR_TELEFONO'] = $linea['GRAL_USR_TELEFONO'];
 	$json_data['GRAL_USR_CELULAR'] = $linea['GRAL_USR_CELULAR'];
 	$json_data['GRAL_USR_EMAIL'] = $linea['GRAL_USR_EMAIL'];
 	$json_data['GRAL_PAR_PRO_DESC'] = $linea['GRAL_PAR_PRO_DESC'];

    print_r(json_encode($json_data));

}

?>