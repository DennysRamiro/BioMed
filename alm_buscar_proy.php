<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
//require('funciones.php');
if ($_GET['accion']=='buscar') {
 	$consulta="select * 
 			   from alm_proyecto pro inner join gral_param_propios ti on pro.alm_proy_tipo=ti.GRAL_PAR_PRO_ID
               WHERE ti.GRAL_PAR_PRO_GRP = 1500 
               and pro.alm_proy_nom like '%".$_GET['buscar']."%' 
               or pro.alm_proy_cod like '%".$_GET['buscar']."%' 
               or ti.GRAL_PAR_PRO_DESC like '%".$_GET['buscar']."%'";

	$resultado = mysql_query($consulta);
	$cont =0;
	while($row = mysql_fetch_array($resultado)){

		    $array['id'] = $row['alm_proy_id'];
			$array['label'] = $row['alm_proy_nom']." ".$row['alm_proy_cod']." ".$row['alm_proy_tipo'];
			$array['value'] = $row['alm_proy_nom'];

			$json_data[$cont] = $array;
		    $cont++;
	//echo $array['label'];
	}
	print_r(json_encode($json_data));	
//}

}elseif($_GET['accion'] == 'selected'){
		
		$cont =0;
		$consulta="select * from alm_proyecto
		WHERE alm_proy_id= '".$_GET['id']."'";
			
		$resultado = mysql_query($consulta);
		$linea= mysql_fetch_array($resultado);

		$consulta_tipo="select ti.GRAL_PAR_PRO_ID, ti.GRAL_PAR_PRO_DESC 
						from alm_proyecto pro inner join gral_param_propios ti on pro.alm_proy_tipo=ti.GRAL_PAR_PRO_ID
                        where ti.GRAL_PAR_PRO_GRP = 1500 and pro.alm_proy_id='".$_GET['id']."'";
		
		$resultado_tipo = mysql_query($consulta_tipo);
		$linea_tipo= mysql_fetch_array($resultado_tipo);

		
		$consulta_estado="select est.GRAL_PAR_PRO_ID, est.GRAL_PAR_PRO_DESC  
						  from alm_proyecto pro inner join gral_param_propios est on pro.alm_proy_estado=est.GRAL_PAR_PRO_ID
                          where GRAL_PAR_PRO_GRP = 1700 and pro.alm_proy_id='".$_GET['id']."'";
        //echo $consulta_estado;
		$resultado_estado = mysql_query($consulta_estado);
		$linea_estado= mysql_fetch_array($resultado_estado);
		$json_data['alm_proy_id'] = $linea['alm_proy_id'];
		$json_data['alm_proy_id_tipo'] = $linea['alm_proy_tipo'];
		$json_data['alm_proy_id_estado'] = $linea['alm_proy_estado'];
		$json_data['alm_proy_nombre'] = $linea['alm_proy_nom'];
		$json_data['alm_proy_cod'] = $linea['alm_proy_cod'];
		$json_data['alm_proy_fecha_inicio'] = $linea['alm_proy_fecha_inicio'];
		$json_data['alm_proy_fecha_fin'] = $linea['alm_proy_fecha_fin'];
		$json_data['alm_proy_tipo'] = $linea_tipo['GRAL_PAR_PRO_DESC'];
        $json_data['alm_proy_estado'] = $linea_estado['GRAL_PAR_PRO_DESC'];
  

        print_r(json_encode($json_data));

}elseif($_GET['accion']=='list'){
	    $consulta="select * 
 			       from alm_proyecto pro inner join gral_param_propios ti on pro.alm_proy_tipo=ti.GRAL_PAR_PRO_ID
 			       WHERE ti.GRAL_PAR_PRO_GRP = 1500 and pro.alm_proy_nom like '%".$_GET['proy']."%' or pro.alm_proy_cod like '%".$_GET['proy']."%' or ti.GRAL_PAR_PRO_DESC like '%".$_GET['proy']."%'";
		$cont =0;
		$resultado = mysql_query($consulta);
		//$linea= mysql_fetch_array($resultado);
		while($linea = mysql_fetch_array($resultado)){

		$consulta_tipo="select ti.GRAL_PAR_PRO_ID, ti.GRAL_PAR_PRO_DESC 
						from alm_proyecto pro inner join gral_param_propios ti on pro.alm_proy_tipo=ti.GRAL_PAR_PRO_ID
                        where ti.GRAL_PAR_PRO_GRP = 1500 and pro.alm_proy_id=".$linea['alm_proy_id'];
		
		$resultado_tipo = mysql_query($consulta_tipo);
		$linea_tipo= mysql_fetch_array($resultado_tipo);

		
		$consulta_estado="select est.GRAL_PAR_PRO_ID, est.GRAL_PAR_PRO_DESC  
						  from alm_proyecto pro inner join gral_param_propios est on pro.alm_proy_estado=est.GRAL_PAR_PRO_ID
                          where GRAL_PAR_PRO_GRP = 1700 and pro.alm_proy_id=".$linea['alm_proy_id'];
        //echo $consulta_estado;
		$resultado_estado = mysql_query($consulta_estado);
		$linea_estado= mysql_fetch_array($resultado_estado);
		$json_data['alm_proy_id'] = $linea['alm_proy_id'];
		$json_data['alm_proy_id_tipo'] = $linea['alm_proy_tipo'];
		$json_data['alm_proy_id_estado'] = $linea['alm_proy_estado'];
		$json_data['alm_proy_nombre'] = $linea['alm_proy_nom'];
		$json_data['alm_proy_cod'] = $linea['alm_proy_cod'];
		$json_data['alm_proy_fecha_inicio'] = $linea['alm_proy_fecha_inicio'];
		$json_data['alm_proy_fecha_fin'] = $linea['alm_proy_fecha_fin'];
		$json_data['alm_proy_tipo'] = $linea_tipo['GRAL_PAR_PRO_DESC'];
        $json_data['alm_proy_estado'] = $linea_estado['GRAL_PAR_PRO_DESC'];
        $array[$cont] = $json_data;
        $cont++;
    }
    print_r(json_encode($array));
}

?>