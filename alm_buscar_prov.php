<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
//require('funciones.php');
if ($_GET['accion']=='buscar') {
 	$consulta="select *, cou.`Name`as Pais, ci.`Name` as Ciudad
from alm_proveedor pro INNER JOIN continent con ON pro.alm_prov_continente=con.Cont_id
INNER JOIN country cou ON pro.alm_prov_pais=cou.`Code`
INNER JOIN city ci ON pro.alm_prov_ciudad=ci.ID
WHERE ISNULL(pro.alm_prov_usr_baja) AND (pro.alm_prov_nombre like '%".$_GET['buscar']."%' or cou.`Name` like '%".$_GET['buscar']."%' or pro.alm_prov_codigo_ext like '%".$_GET['buscar']."%' 
or pro.alm_prov_codigo_int like '%".$_GET['buscar']."%')";

	$resultado = mysql_query($consulta);
	$cont =0;
	while($row = mysql_fetch_array($resultado)){

		    $array['id'] = $row['alm_prov_id'];
			$array['label'] = $row['alm_prov_nombre']." ".$row['Pais']." ".$row['alm_prov_codigo_int']." ".$row['alm_prov_codigo_ext'];
			$array['value'] = $row['alm_prov_nombre'];

			$json_data[$cont] = $array;
		    $cont++;
	//echo $array['label'];
	}
	print_r(json_encode($json_data));	
//}

}elseif($_GET['accion'] == 'selected'){
		
		$cont =0;
		$consulta="select *, cou.`Name`as Pais, ci.`Name` as Ciudad
		from alm_proveedor pro INNER JOIN continent con ON pro.alm_prov_continente=con.Cont_id
		INNER JOIN country cou ON pro.alm_prov_pais=cou.`Code`
		INNER JOIN city ci ON pro.alm_prov_ciudad=ci.ID
		WHERE ISNULL(pro.alm_prov_usr_baja) AND pro.alm_prov_id= '".$_GET['id']."'";
			
		$resultado = mysql_query($consulta);
		$linea= mysql_fetch_array($resultado);

		$consulta_tipo="select  par.GRAL_PAR_PRO_DESC FROM alm_proveedor pro INNER JOIN gral_param_propios par 
        ON pro.alm_prov_tipo=par.GRAL_PAR_PRO_COD 
        WHERE par.GRAL_PAR_PRO_GRP=1400 and pro.alm_prov_id='".$_GET['id']."'";
		
		$resultado_tipo = mysql_query($consulta_tipo);
		$linea_tipo= mysql_fetch_array($resultado_tipo);

		
		$consulta_estado="select  par.GRAL_PAR_PRO_DESC FROM alm_proveedor pro INNER JOIN gral_param_propios par 
        ON pro.alm_prov_estado=par.GRAL_PAR_PRO_COD 
        WHERE par.GRAL_PAR_PRO_GRP=1200 and pro.alm_prov_id='".$_GET['id']."'";
        //echo $consulta_estado;
		$resultado_estado = mysql_query($consulta_estado);
		$linea_estado= mysql_fetch_array($resultado_estado);
		$json_data['alm_prov_id'] = $linea['alm_prov_id'];
		$json_data['alm_prov_id_tipo'] = $linea['alm_prov_tipo'];
		$json_data['alm_prov_id_estado'] = $linea['alm_prov_estado'];
		$json_data['alm_prov_continente'] = $linea['alm_prov_continente'];
		$json_data['alm_prov_moneda'] = $linea['alm_prov_moneda'];
		$json_data['alm_prov_nombre'] = $linea['alm_prov_nombre'];
        $json_data['alm_prov_tipo'] = $linea_tipo['GRAL_PAR_PRO_DESC'];
        $json_data['alm_prov_codigo_ext'] = $linea['alm_prov_codigo_ext'];
        $json_data['alm_prov_codigo_int'] = $linea['alm_prov_codigo_int'];
        $json_data['alm_prov_pais'] = utf8_encode($linea['Pais']);
        $json_data['alm_prov_ciudad'] = utf8_encode($linea['Ciudad']);
        $json_data['alm_prov_direccion'] = $linea['alm_prov_direccion'];
        $json_data['alm_prov_telefono'] = $linea['alm_prov_telefono'];
        $json_data['alm_prov_celular'] = $linea['alm_prov_celular'];
        $json_data['alm_prov_estado'] = $linea_estado['GRAL_PAR_PRO_DESC'];

        print_r(json_encode($json_data));

}elseif($_GET['accion']=='list'){
	    $consulta="select *, cou.`Name`as Pais, ci.`Name` as Ciudad
		from alm_proveedor pro INNER JOIN continent con ON pro.alm_prov_continente=con.Cont_id
		INNER JOIN country cou ON pro.alm_prov_pais=cou.`Code`
		INNER JOIN city ci ON pro.alm_prov_ciudad=ci.ID
		WHERE ISNULL(pro.alm_prov_usr_baja) AND (pro.alm_prov_nombre like '%".$_GET['prov']."%' or cou.`Name` like '%".$_GET['prov']."%' or pro.alm_prov_codigo_ext like '%".$_GET['prov']."%' 
		or pro.alm_prov_codigo_int like '%".$_GET['prov']."%')";
		$cont =0;
		$resultado = mysql_query($consulta);
		//$linea= mysql_fetch_array($resultado);
		while($linea = mysql_fetch_array($resultado)){

		$consulta_tipo="select  par.GRAL_PAR_PRO_DESC FROM alm_proveedor pro INNER JOIN gral_param_propios par 
        ON pro.alm_prov_tipo=par.GRAL_PAR_PRO_COD 
        WHERE par.GRAL_PAR_PRO_GRP=1400 and pro.alm_prov_id=".$linea['alm_prov_id'];
		
		$resultado_tipo = mysql_query($consulta_tipo);
		$linea_tipo= mysql_fetch_array($resultado_tipo);

		
		$consulta_estado="select  par.GRAL_PAR_PRO_DESC FROM alm_proveedor pro INNER JOIN gral_param_propios par 
        ON pro.alm_prov_estado=par.GRAL_PAR_PRO_COD 
        WHERE par.GRAL_PAR_PRO_GRP=1200 and pro.alm_prov_id=".$linea['alm_prov_id'];
        //echo $consulta_estado;
		$resultado_estado = mysql_query($consulta_estado);
		$linea_estado= mysql_fetch_array($resultado_estado);
		$json_data['alm_prov_id'] = $linea['alm_prov_id'];
		$json_data['alm_prov_id_tipo'] = $linea['alm_prov_tipo'];
		$json_data['alm_prov_id_estado'] = $linea['alm_prov_estado'];
		$json_data['alm_prov_continente'] = $linea['alm_prov_continente'];
		$json_data['alm_prov_moneda'] = $linea['alm_prov_moneda'];
		$json_data['alm_prov_nombre'] = $linea['alm_prov_nombre'];
        $json_data['alm_prov_tipo'] = $linea_tipo['GRAL_PAR_PRO_DESC'];
        $json_data['alm_prov_codigo_ext'] = $linea['alm_prov_codigo_ext'];
        $json_data['alm_prov_codigo_int'] = $linea['alm_prov_codigo_int'];
        $json_data['alm_prov_pais'] = utf8_encode($linea['Pais']);
        $json_data['alm_prov_ciudad'] = utf8_encode($linea['Ciudad']);
        $json_data['alm_prov_direccion'] = $linea['alm_prov_direccion'];
        $json_data['alm_prov_telefono'] = $linea['alm_prov_telefono'];
        $json_data['alm_prov_celular'] = $linea['alm_prov_celular'];
        $json_data['alm_prov_estado'] = $linea_estado['GRAL_PAR_PRO_DESC'];
        $array[$cont] = $json_data;
        $cont++;
    }
    print_r(json_encode($array));
}

?>