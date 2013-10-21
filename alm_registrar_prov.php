<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
  require('configuracion.php');
  require('funciones.php');
  $ruta = '';
  $ruta2 = '';
  if(isset($_FILES['detalle_tecnico_prod']['tmp_name'])){
  		$codigo = uniqid('treb_det_'); 
  		$ruta = 'images/producto/dt/'.$codigo.$_FILES['detalle_tecnico_prod']['name'];
  		copy($_FILES['detalle_tecnico_prod']['tmp_name'], $ruta);
  }
  if(isset($_FILES['imagen_prod']['tmp_name'])){
  	require_once('lib/SimpleImage.class.php');
  	$img = new SimpleImage();
  	$codigo = uniqid('treb_img_');
  	$ruta2 = 'images/producto/img/'.$codigo.$_FILES['imagen_prod']['name'];
  	$img->load($_FILES['imagen_prod']['tmp_name'])->resize(320, 200)->save($ruta2);
  }
  $log = $_SESSION['login'];
  $consulta = "INSERT INTO alm_producto (
										alm_prod_id ,
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
										".$_POST['tipo_producto'].", 
										".$_POST['provedor_producto'].", 
										'".strtoupper($_POST['nombre_producto'])."', 
										'".strtoupper($_POST['descripcion_producto'])."', 
										'".strtoupper($_POST['marca_producto'])."', 
										'".strtoupper($_POST['serie_cliente'])."', 
										'".strtoupper($_POST['alternativo_producto'])."', 
										".$_POST['unidad_producto'].", 
										'".$_POST['cantidad_stock']."', 
										'".$_POST['precio_compra']."', 
										'".$_POST['precio_venta']."', 
										'".$_POST['precio_venta_max']."', 
										'".$_POST['precio_venta_min']."', 
										'".$_POST['porcentaje_venta']."', 
										'".$_POST['valor_contable']."', 
										'".strtoupper($_POST['presentacion_producto'])."', 
										".$_POST['estado_producto'].", 
										'2023-31-05', 
										'".strtoupper($_POST['lote_producto'])."', 
										".$_POST['moneda_producto'].", 
										'".strtoupper($_POST['tipo_cambio'])."',
										'".$ruta2."',
										'".$ruta."', 
										".$_POST['sucursal_origen'].", 
										'".$log."',
										CURRENT_TIMESTAMP , 
										NULL , 
										NULL);";
//echo $consulta;
$query = mysql_query($consulta);
if($query){
	header('Location: alm_consulta_prod.php?msg=1');
}else{
	header('Location: alm_alta_prod.php?msg=1');
}
ob_end_flush();
?>