<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
if($_GET['tp'] == 'buscar'){
	$consulta = "SELECT * 
                 FROM  alm_producto
                 WHERE (alm_prod_nombre like '%".$_GET['buscar']."%' OR
                        alm_prod_serie like '%".$_GET['buscar']."%' OR 
                        alm_prod_descripcion like '%".$_GET['buscar']."%') AND
					    alm_prod_usr_baja is null and 
					    alm_prod_estado <> 9  group by alm_prod_codigo order by alm_prod_nombre";
	$resultado = mysql_query($consulta);
	$cont =0;
	while($row = mysql_fetch_array($resultado)){
		$array['id'] = $row['alm_prod_codigo'];
		$array['label'] = $row['alm_prod_nombre']." ".$row['alm_prod_descripcion']." ".$row['alm_prod_serie']." ".$row['alm_prod_marca'];
		$array['value'] = $row['alm_prod_nombre'];
		$json_data[$cont] = $array;
		$cont++;
	}
	print_r(json_encode($json_data));	
}elseif($_GET['tp'] == 'selected'){

	$consulta = "SELECT *
				 FROM alm_producto
				 WHERE alm_prod_codigo=".$_GET['id'];
	$resultado = mysql_query($consulta);
	$prod = mysql_fetch_array($resultado);
	$consul_tipo = "SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC
                                          FROM gral_param_propios
                                          WHERE gral_par_pro_grp=1000 AND 
										  GRAL_PAR_PRO_COD = ".$prod['alm_prod_tipo'];
    $res = mysql_query($consul_tipo);
    $tipo = mysql_fetch_array($res);
    $consulta_unidad = "SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC
                                              FROM gral_param_propios
                                              WHERE  gral_par_pro_grp=1100 AND 
											  GRAL_PAR_PRO_COD = ".$prod['alm_prod_unidad'];
    $res_unidad = mysql_query($consulta_unidad);
    $unidad = mysql_fetch_array($res_unidad);
    $consulta_suc = "SELECT GRAL_AGENCIA_CODIGO, GRAL_AGENCIA_NOMBRE
                     FROM gral_agencia
                     WHERE GRAL_AGENCIA_CODIGO =".$prod['alm_prod_suc_origen'];
    $res_agencia = mysql_query($consulta_suc);
    $agencia = mysql_fetch_array($res_agencia);

    $consulta_estado = "SELECT GRAL_PAR_PRO_DESC
                                              FROM gral_param_propios 
                                              WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND                                              GRAL_PAR_PRO_COD=".$prod['alm_prod_estado'];
    $res_estado = mysql_query($consulta_estado);
    $estado = mysql_fetch_array($res_estado);
    $json_data['alm_prod_id'] = $prod['alm_prod_codigo'];
    $json_data['alm_prod_serie'] = $prod['alm_prod_serie'];
    $json_data['alm_prod_nombre'] = $prod['alm_prod_nombre'];
    $json_data['alm_prod_tipo_id'] = $tipo['GRAL_PAR_PRO_COD'];
    $json_data['alm_prod_tipo_nombre'] = $tipo['GRAL_PAR_PRO_DESC'];
    $json_data['alm_prod_marca'] = $prod['alm_prod_marca'];
    $json_data['alm_prod_unidad_id'] = $unidad['GRAL_PAR_PRO_COD'];
    $json_data['alm_prod_unidad_nom'] = $unidad['GRAL_PAR_PRO_DESC']; 
    $json_data['alm_prod_cantidad'] = $prod['alm_prod_cantidad_stock'];
    $json_data['alm_precio_compra']=$prod['alm_prod_prec_compra'];
    $json_data['alm_precio_venta'] = $prod['alm_prod_prec_venta'];
    $json_data['alm_suc_org_id'] = $agencia['GRAL_AGENCIA_CODIGO'];
    $json_data['alm_suc_org_nombre'] = $agencia['GRAL_AGENCIA_NOMBRE'];
    $json_data['estado_producto'] = $estado['GRAL_PAR_PRO_DESC'];
	print_r(json_encode($json_data));
}elseif($_GET['tp']=='list'){
    $consulta = "SELECT * 
                 FROM  alm_producto
                 WHERE (alm_prod_nombre like '%".$_GET['prod']."%' OR
                       alm_prod_serie like '%".$_GET['prod']."%' OR 
                       alm_prod_descripcion like '%".$_GET['prod']."%') AND
					    alm_prod_usr_baja is null and 
					    alm_prod_estado <> 9  group by alm_prod_codigo order by alm_prod_nombre";
    $cont =0;
    $resultado = mysql_query($consulta);
    while($prod = mysql_fetch_array($resultado)){
        $consul_tipo = "SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC
                                          FROM gral_param_propios
                                          WHERE gral_par_pro_grp=1000 AND 
										  GRAL_PAR_PRO_COD = ".$prod['alm_prod_tipo'];
        $res = mysql_query($consul_tipo);
        $tipo = mysql_fetch_array($res);
        $consulta_unidad = "SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC
                                              FROM gral_param_propios
                                              WHERE  gral_par_pro_grp=1100 AND 
											  GRAL_PAR_PRO_COD = ".$prod['alm_prod_unidad'];
        $res_unidad = mysql_query($consulta_unidad);
        $unidad = mysql_fetch_array($res_unidad);
        $consulta_suc = "SELECT GRAL_AGENCIA_CODIGO, GRAL_AGENCIA_NOMBRE
                         FROM gral_agencia
                         WHERE GRAL_AGENCIA_CODIGO =".$prod['alm_prod_suc_origen'];
        $res_agencia = mysql_query($consulta_suc);
        $agencia = mysql_fetch_array($res_agencia);
        $consulta_estado = "SELECT GRAL_PAR_PRO_DESC
                                              FROM gral_param_propios 
                                              WHERE gral_par_pro_grp=1200 AND GRAL_PAR_PRO_COD >= 1 AND                                              GRAL_PAR_PRO_COD=".$prod['alm_prod_estado'];
        $res_estado = mysql_query($consulta_estado);
        $estado = mysql_fetch_array($res_estado);
        $json_data['alm_prod_id'] = $prod['alm_prod_id'];
        $json_data['alm_prod_serie'] = $prod['alm_prod_serie'];
        $json_data['alm_prod_nombre'] = $prod['alm_prod_nombre'];
        $json_data['alm_prod_tipo_id'] = $tipo['GRAL_PAR_PRO_COD'];
        $json_data['alm_prod_tipo_nombre'] = $tipo['GRAL_PAR_PRO_DESC'];
        $json_data['alm_prod_marca'] = $prod['alm_prod_marca'];
        $json_data['alm_prod_unidad_id'] = $unidad['GRAL_PAR_PRO_COD'];
        $json_data['alm_prod_unidad_nom'] = $unidad['GRAL_PAR_PRO_DESC']; 
        $json_data['alm_prod_cantidad'] = $prod['alm_prod_cantidad_stock'];
        $json_data['alm_precio_compra']=$prod['alm_prod_prec_compra'];
        $json_data['alm_precio_venta'] = $prod['alm_prod_prec_venta'];
        $json_data['alm_suc_org_id'] = $agencia['GRAL_AGENCIA_CODIGO'];
        $json_data['alm_suc_org_nombre'] = $agencia['GRAL_AGENCIA_NOMBRE'];
        $json_data['estado_producto'] = $estado['GRAL_PAR_PRO_DESC'];
        $array[$cont] = $json_data;
        $cont++;
    }
    print_r(json_encode($array));
}

?>