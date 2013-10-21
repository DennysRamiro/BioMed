<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require('configuracion.php');
$log = $_SESSION['login'];
if($_GET['tp'] == 'registrar'){
	$ruta = '';
	$ruta2 = '';
	if(!empty($_FILES['detalle_tecnico_prod']['tmp_name'])){
			$codigo = uniqid('treb_det_'); 
			$ruta = 'images/producto/dt/'.$codigo.$_FILES['detalle_tecnico_prod']['name'];
			copy($_FILES['detalle_tecnico_prod']['tmp_name'], $ruta);
	}
	if(!empty($_FILES['imagen_prod']['tmp_name'])){
		require_once('lib/SimpleImage.class.php');
		$img = new SimpleImage();
		$codigo = uniqid('treb_img_');
		$ruta2 = 'images/producto/img/'.$codigo.$_FILES['imagen_prod']['name'];
		$img->load($_FILES['imagen_prod']['tmp_name'])->resize(320, 200)->save($ruta2);
	}
//Generar codigo por tipo de producto
//Buscar Prefijo
$r = "";
$tipo = $_POST['tipo_producto'];
echo $tipo."---";
 $consulta = "SELECT GRAL_PAR_PRO_SIGLA FROM gral_param_propios 
              WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD = $tipo";
 $resultado = mysql_query($consulta);
while ($linea = mysql_fetch_array($resultado)) {
$prefijo = $linea['GRAL_PAR_PRO_SIGLA'];	
}
$nro = leer_correla_prod($tipo);
$nom_prov = substr($_POST['provedor_producto'],0,3);
$cod_prov = $_POST['provedor_producto'];
//Arma el codigo
	$n = strlen($nro);
$n2 = 6 - $n;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$codigo_producto = $prefijo."-".$nom_prov."-".$r.$nro;

if ($_POST['test'] == 'value1'){
   //  if ($_POST['s1'] == "S"){ 
      $s1= "S"; 
	  $_SESSION['s1'] = $s1;
	  $_SESSION['codigo_producto'] =$codigo_producto;
	  $_SESSION['nro'] = $nro;
	  $_SESSION['tipo_producto'] =	$_POST['tipo_producto']; 
	  $_SESSION['cod_prov'] = $cod_prov; 
	  $_SESSION['nombre_producto'] = utf8_encode(strtoupper($_POST['nombre_producto'])); 
	  $_SESSION['descripcion_producto'] = utf8_encode(strtoupper($_POST['descripcion_producto']));
	  $_SESSION['marca_producto'] = utf8_encode(strtoupper($_POST['marca_producto']));
	  $_SESSION['serie_cliente'] = utf8_encode(strtoupper($_POST['serie_cliente']));
	  $_SESSION['alternativo_producto'] = utf8_encode(strtoupper($_POST['alternativo_producto'])); 
	  $_SESSION['unidad_producto'] = $_POST['unidad_producto']; 
	  $_SESSION['cantidad_stock'] = $_POST['cantidad_stock'];
	  $_SESSION['precio_compra'] = $_POST['precio_compra'];
	  $_SESSION['precio_venta'] = $_POST['precio_venta'];
	  $_SESSION['precio_venta_max'] = $_POST['precio_venta_max'];
	  $_SESSION['precio_venta_min'] = $_POST['precio_venta_min'];
	  $_SESSION['porcentaje_venta'] = $_POST['porcentaje_venta']; 
	  $_SESSION['valor_contable'] = $_POST['valor_contable'];
	  $_SESSION['presentacion_producto'] = utf8_encode(strtoupper($_POST['presentacion_producto']));
	  $_SESSION['estado_producto'] = $_POST['estado_producto'];
	  $_SESSION['fecha_vencimiento'] = cambiaf_a_mysql_2($_POST['fecha_vencimiento']);
	  $_SESSION['lote_producto'] = utf8_encode(strtoupper($_POST['lote_producto']));
	  $_SESSION['moneda_producto'] = $_POST['moneda_producto'];
	  $_SESSION['tipo_cambio'] = utf8_encode(strtoupper($_POST['tipo_cambio']));
	  $_SESSION['ruta2'] = $ruta2;
	  $_SESSION['ruta'] = $ruta; 
	  $_SESSION['sucursal_origen'] = $_POST['sucursal_origen'];
	  $_SESSION['log'] = $log;
	  
	  header('Location: alm_alta_prod_series.php');
	  
	  echo "Aqui abre";
	 // }
	    }else{
	 $_SESSION['s1'] = "";
   

	$fecha_vencimiento = $_POST['fecha_vencimiento'];
	
	$consulta = "INSERT INTO alm_producto (
										alm_prod_id ,
										alm_prod_codigo,
										alm_prod_numerico,
										alm_prod_tipo ,
										alm_prod_prov ,
										alm_prod_nombre ,
										alm_prod_descripcion ,
										alm_prod_marca ,
										alm_prod_serie ,
										alm_prod_alternativo ,
										alm_prod_unidad ,
										alm_prod_cantidad_stock ,
										alm_prod_prec_compra ,
										alm_prod_prec_venta ,
										alm_prod_prec_max_venta ,
										alm_prod_prec_min_venta ,
										alm_prod_porcentaje ,
										alm_prod_valor_contable ,
										alm_prod_presentacion ,
										alm_prod_estado ,
										alm_prod_fecha_venc ,
										alm_prod_lote ,
									    alm_prod_moneda ,
										alm_prod_tc ,
										alm_prod_img,
										alm_prod_pdf_descp,
										alm_prod_suc_origen ,
										alm_prod_usr_alta ,
										alm_prod_fch_hr_alta ,
										alm_prod_usr_baja ,
										alm_prod_fch_hr_baja)
								VALUES (
										NULL , 
										'$codigo_producto',
										$nro,
										".$_POST['tipo_producto'].", 
										'$cod_prov', 
										'".utf8_encode(strtoupper($_POST['nombre_producto']))."', 
										'".utf8_encode(strtoupper($_POST['descripcion_producto']))."', 
										'".utf8_encode(strtoupper($_POST['marca_producto']))."', 
										'".utf8_encode(strtoupper($_POST['serie_cliente']))."', 
										'".utf8_encode(strtoupper($_POST['alternativo_producto']))."', 
										".$_POST['unidad_producto'].", 
										'".$_POST['cantidad_stock']."', 
										'".$_POST['precio_compra']."', 
										'".$_POST['precio_venta']."', 
										'".$_POST['precio_venta_max']."', 
										'".$_POST['precio_venta_min']."', 
										'".$_POST['porcentaje_venta']."', 
										'".$_POST['valor_contable']."', 
										'".utf8_encode(strtoupper($_POST['presentacion_producto']))."', 
										".$_POST['estado_producto'].", 
										'".cambiaf_a_mysql_2($fecha_vencimiento)."', 
										'".utf8_encode(strtoupper($_POST['lote_producto']))."', 
										".$_POST['moneda_producto'].", 
										'".utf8_encode(strtoupper($_POST['tipo_cambio']))."',
										'".$ruta2."',
										'".$ruta."', 
										".$_POST['sucursal_origen'].", 
										'".$log."',
										CURRENT_TIMESTAMP , 
										NULL , 
										NULL);";
	$query = mysql_query($consulta);

	if($query){
		header('Location: alm_consulta_prod.php?msg=1');
	}else{
		header('Location: alm_consulta_prod.php?msg=0');
	}
	 }
}elseif($_GET['tp'] == 'actualizar'){
echo $_SESSION['alm_prod_codigo']."codigo";
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$alm_prod_codigo = $_SESSION['alm_prod_codigo'];
$alm_prod_numerico = $_SESSION['alm_prod_numerico'];
 
	$ruta = '';
	$ruta2 = '';
	if(!empty($_FILES['detalle_tecnico_prod']['tmp_name'])){
			$codigo = uniqid('treb_det_'); 
			$ruta = 'images/producto/dt/'.$codigo.$_FILES['detalle_tecnico_prod']['name'];
			copy($_FILES['detalle_tecnico_prod']['tmp_name'], $ruta);
	}
	if(!empty($_FILES['imagen_prod']['tmp_name'])){
		require_once('lib/SimpleImage.class.php');
		$img = new SimpleImage();
		$codigo = uniqid('treb_img_');
		$ruta2 = 'images/producto/img/'.$codigo.$_FILES['imagen_prod']['name'];
		$img->load($_FILES['imagen_prod']['tmp_name'])->resize(320, 200)->save($ruta2);
	}
	
	$consulta  = "UPDATE alm_producto SET 
										  alm_prod_usr_baja = '$log',
										  alm_prod_fch_hr_baja = CURRENT_TIMESTAMP
				  WHERE alm_prod_codigo ='$alm_prod_codigo'";
	
    mysql_query($consulta);
	
  //$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error()); 
	$consulta = "INSERT INTO alm_producto (
										alm_prod_id ,
										alm_prod_codigo,
										alm_prod_numerico,
										alm_prod_tipo ,
										alm_prod_prov ,
										alm_prod_nombre ,
										alm_prod_descripcion ,
										alm_prod_marca ,
										alm_prod_serie ,
										alm_prod_alternativo ,
										alm_prod_unidad ,
										alm_prod_cantidad_stock ,
										alm_prod_prec_compra ,
										alm_prod_prec_venta ,
										alm_prod_prec_max_venta ,
										alm_prod_prec_min_venta ,
										alm_prod_porcentaje ,
										alm_prod_valor_contable ,
										alm_prod_presentacion ,
										alm_prod_estado ,
										alm_prod_fecha_venc ,
										alm_prod_lote ,
									    alm_prod_moneda ,
										alm_prod_tc ,
										alm_prod_img,
										alm_prod_pdf_descp,
										alm_prod_suc_origen ,
										alm_prod_usr_alta ,
										alm_prod_fch_hr_alta ,
										alm_prod_usr_baja ,
										alm_prod_fch_hr_baja)
								VALUES (
										NULL , 
										'$alm_prod_codigo',
										$alm_prod_numerico,
										".$_POST['tipo_producto'].", 
										'".$_POST['provedor_producto']."', 
										'".utf8_encode(strtoupper($_POST['nombre_producto']))."', 
										'".utf8_encode(strtoupper($_POST['descripcion_producto']))."', 
										'".utf8_encode(strtoupper($_POST['marca_producto']))."', 
										'".utf8_encode(strtoupper($_POST['serie_cliente']))."', 
										'".utf8_encode(strtoupper($_POST['alternativo_producto']))."', 
										".$_POST['unidad_producto'].", 
										'".$_POST['cantidad_stock']."', 
										'".$_POST['precio_compra']."', 
										'".$_POST['precio_venta']."', 
										'".$_POST['precio_venta_max']."', 
										'".$_POST['precio_venta_min']."', 
										'".$_POST['porcentaje_venta']."', 
										'".$_POST['valor_contable']."', 
										'".utf8_encode(strtoupper($_POST['presentacion_producto']))."', 
										".$_POST['estado_producto'].", 
										'".cambiaf_a_mysql_2($fecha_vencimiento)."', 
										'".utf8_encode(strtoupper($_POST['lote_producto']))."', 
										".$_POST['moneda_producto'].", 
										'".utf8_encode(strtoupper($_POST['tipo_cambio']))."',
										'".$ruta2."',
										'".$ruta."', 
										".$_POST['sucursal_origen'].", 
										'".$log."',
										CURRENT_TIMESTAMP , 
										NULL , 
										NULL);";
	//echo $consulta;
	$query = mysql_query($consulta) or die('No pudo insertar : ' . mysql_error());
	if($query){
		header("Location: alm_consulta_prod.php?msg=2");
	}else{
		header('Location: alm_consulta_prod.php?msg=0');
	}
	
}

//Grabar Productos con Series

if($_GET['tp'] == 'regisserie'){
   $cantidad = $_SESSION['cantidad_stock'];
   //Datos
     $codigo_producto = $_SESSION['codigo_produc'];
	 $nro = $_SESSION['nro'];
	 $tipo_producto = $_SESSION['tipo_producto']; 
	 $cod_prov = $_SESSION['cod_prov']; 
	 $nombre_producto = $_SESSION['nombre_producto'];
	 $descripcion_producto = $_SESSION['descripcion_producto'];
	 $marca_producto = $_SESSION['marca_producto'];
	 //$serie_cliente = $_SESSION['serie_cliente'];
	 $alternativo_producto = $_SESSION['alternativo_producto']; 
	 $unidad_producto = $_SESSION['unidad_producto']; 
	 $cantidad_stock = 1;
	 $precio_compra = $_SESSION['precio_compra'];
	 $precio_venta = $_SESSION['precio_venta'];
	 $precio_venta_max = $_SESSION['precio_venta_max'];
	 $precio_venta_min = $_SESSION['precio_venta_min'];
	 $porcentaje_venta = $_SESSION['porcentaje_venta']; 
	 $valor_contable = $_SESSION['valor_contable'];
	 $presentacion_producto = $_SESSION['presentacion_producto'];
	 $estado_producto = $_SESSION['estado_producto'];
	 $fecha_vencimiento = $_SESSION['fecha_vencimiento'];
	 $lote_producto = $_SESSION['lote_producto'];
	 $moneda_producto = $_SESSION['moneda_producto'];
	 $tipo_cambio = $_SESSION['tipo_cambio'];
	 $ruta2 = $_SESSION['ruta2'];
	 $ruta = $_SESSION['ruta']; 
	 $sucursal_origen = $_SESSION['sucursal_origen'];
	 if ($porcentaje_venta == ''){
	     $porcentaje_venta = 0;
	 }
	 $log = $_SESSION['log'];
    for ($i=1; $i < $cantidad+1; $i = $i + 1 ) {
	    if ($i == 1){ 
	        echo $_POST['serie_1'];
			$serie = $_POST['serie_1'];
	    }
		 if ($i == 2){ 
	        echo $_POST['serie_2'];
			$serie = $_POST['serie_2'];
	    }
		 if ($i == 3){ 
	        echo $_POST['serie_3'];
			$serie = $_POST['serie_3'];
	    }
		 if ($i == 4){ 
	        echo $_POST['serie_4'];
			$serie = $_POST['serie_4'];
	    }
		 if ($i == 5){ 
	        echo $_POST['serie_5'];
			$serie = $_POST['serie_5'];
	    }
		 if ($i == 6){ 
	        echo $_POST['serie_6'];
			$serie = $_POST['serie_6'];
	    }
		 if ($i == 7){ 
	        echo $_POST['serie_7'];
			$serie = $_POST['serie_7'];
	    }
		 if ($i == 8){ 
	        echo $_POST['serie_8'];
			$serie = $_POST['serie_8'];
	    }
		 if ($i == 9){ 
	        echo $_POST['serie_9'];
			$serie = $_POST['serie_9'];
	    }
		 if ($i == 10){ 
	        echo $_POST['serie_10'];
			$serie = $_POST['serie_10'];
	    }
		if ($i == 11){ 
	        echo $_POST['serie_11'];
			$serie = $_POST['serie_11'];
	    }
		 if ($i == 12){ 
	        echo $_POST['serie_12'];
			$serie = $_POST['serie_12'];
	    }
		 if ($i == 13){ 
	        echo $_POST['serie_13'];
			$serie = $_POST['serie_13'];
	    }
		 if ($i == 14){ 
	        echo $_POST['serie_14'];
			$serie = $_POST['serie_14'];
	    }
		 if ($i == 15){ 
	        echo $_POST['serie_15'];
			$serie = $_POST['serie_15'];
	    }
		 if ($i == 16){ 
	        echo $_POST['serie_16'];
			$serie = $_POST['serie_16'];
	    }
		 if ($i == 17){ 
	        echo $_POST['serie_17'];
			$serie = $_POST['serie_17'];
	    }
		 if ($i == 18){ 
	        echo $_POST['serie_18'];
			$serie = $_POST['serie_18'];
	    }
		 if ($i == 19){ 
	        echo $_POST['serie_19'];
			$serie = $_POST['serie_19'];
	    }
		 if ($i == 20){ 
	        echo $_POST['serie_20'];
			$serie = $_POST['serie_20'];
	    }
		$consulta = "INSERT INTO alm_producto (
										alm_prod_id ,
										alm_prod_codigo,
										alm_prod_numerico,
										alm_prod_tipo ,
										alm_prod_prov ,
										alm_prod_nombre ,
										alm_prod_descripcion ,
										alm_prod_marca ,
										alm_prod_serie ,
										alm_prod_alternativo ,
										alm_prod_unidad ,
										alm_prod_cantidad_stock ,
										alm_prod_prec_compra ,
										alm_prod_prec_venta ,
										alm_prod_prec_max_venta ,
										alm_prod_prec_min_venta ,
										alm_prod_porcentaje ,
										alm_prod_valor_contable ,
										alm_prod_presentacion ,
										alm_prod_estado ,
										alm_prod_fecha_venc ,
										alm_prod_lote ,
									    alm_prod_moneda ,
										alm_prod_tc ,
										alm_prod_img,
										alm_prod_pdf_descp,
										alm_prod_suc_origen ,
										alm_prod_usr_alta ,
										alm_prod_fch_hr_alta ,
										alm_prod_usr_baja ,
										alm_prod_fch_hr_baja)
								VALUES (
										NULL , 
										'$codigo_producto',
										$nro,
										$tipo_producto, 
										'$cod_prov', 
										'$nombre_producto', 
										'$descripcion_producto', 
										'$marca_producto', 
										'$serie', 
										'$alternativo_producto', 
										$unidad_producto, 
										$cantidad_stock, 
										$precio_compra, 
										$precio_venta, 
										$precio_venta_max, 
										$precio_venta_min, 
										$porcentaje_venta, 
										$valor_contable, 
										'$presentacion_producto', 
										$estado_producto, 
										'$fecha_vencimiento', 
										'$lote_producto', 
										$moneda_producto, 
										$tipo_cambio,
										'$ruta2',
										'$ruta', 
										$sucursal_origen, 
										'$log',
										CURRENT_TIMESTAMP , 
										NULL , 
										NULL);";
	$query = mysql_query($consulta)or die('No pudo insertar caja_ing_egre xx: ' . mysql_error());
	}
  if($query){
		header("Location: alm_consulta_prod.php?msg=2");
	}else{
		header('Location: alm_consulta_prod.php?msg=0');
	}
}
/**
 * Convierte la fecha formato normal a mysql
 */
function cambiaf_a_mysql_2($fecha){
   $anio =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$anio."-".$mes."-".$dia; 
    return $lafecha; 
}

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


 
ob_end_flush();


?>