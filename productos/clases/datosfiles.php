<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} 
require_once 'Utilitarios.php';
//require_once '../lib/Mysql.php';
require('../../configuracion.php');
require('../../funciones.php');

if(!empty($_FILES['img_produc']['tmp_name'])){
echo "vacio";
}

    $ruta = '';
	$ruta2 = '';
	if(!empty($_FILES['dat_tec']['tmp_name'])){
			$codigo = uniqid('treb_det_'); 
			$ruta = 'images/producto/dt/'.$codigo.$_FILES['dat_tec']['name'];
			copy($_FILES['dat_tec']['tmp_name'], $ruta);
	}
	if(!empty($_FILES['img_produc']['tmp_name'])){
		require_once('../lib/SimpleImage.class.php');
		$img = new SimpleImage();
		$codigo = uniqid('treb_img_');
		$ruta2 = 'images/producto/img/'.$codigo.$_FILES['img_produc']['name'];
		//$img->load($_FILES['img_produc']['tmp_name'])->resize(320, 200)->save($ruta2);
		copy($_FILES['img_produc']['tmp_name'], $ruta2);
	}		
	
	$crea_codigo = crearCodigo($_POST['tipo_producto'],$_POST['provedor_producto']);
	function crearCodigo($tipo_prod,$prov) {
				$r = "";
				$prefijo ="";
				//$tipo = $_POST['tipo_producto'];
				//echo $tipo."---";
				 $consulta = "SELECT GRAL_PAR_PRO_SIGLA FROM gral_param_propios 
							  WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD = ".$tipo_prod;
				 $resultado = mysql_query($consulta) or die(mysql_error());
				 
				 //echo($resultado);
				while ($linea = mysql_fetch_array($resultado)) {
					$prefijo = $linea['GRAL_PAR_PRO_SIGLA'];	
				}
				//$nro = leer_correla_prod($tipo);
				/****/
				$consulta  = "SELECT alm_prod_cab_numerico FROM alm_prod_cabecera where alm_prod_cab_tipo = ".$tipo_prod." 
								  ORDER BY alm_prod_cab_numerico 
								  DESC LIMIT 0,1";
					//echo $consulta;
					$resultado = mysql_query($consulta);
					$linea = mysql_fetch_array($resultado);
					$nro_tran = $linea['alm_prod_cab_numerico'];
					
					if (empty($nro_tran)) {
					$nro_tran = 1;
					//echo("el valor es vacio ".$nro_tran."<br>");
					   }else{
					$nro_tran = $nro_tran + 1;
					//echo("el valor sera contenido ".$nro_tran."<br>");
					  }
					//return $nro_tran;
					$_SESSION['numerico']=$nro_tran; 
				
					
				/*****/
				
				$nom_prov = substr($prov,0,3);
				$cod_prov = $prov;
				//Arma el codigo
			    //$n = strlen($nro);
				//echo ("nro_tra ".$nro_tran."<br>");
				 $n = strlen($nro_tran);
				 //echo "Cantidad de nro_tra".$n."<br>";
				$n2 = 6 - $n;
				for ($i = 1; $i <= $n2; $i++) {
					$r = $r."0";
					}  
				$codigo_producto = $prefijo."-".$nom_prov."-".$r.$nro_tran;
				return $codigo_producto;
				//$_SESSION['codigo']=$codigo_producto; 
	}
	
	function generaNumeroOrdenUnico() { 
    $codigo = uniqid('INTER_');
    return $codigo; 
  } 
  
  $unico = generaNumeroOrdenUnico();
  $fec_proc_prod = cambiaf_a_mysql($_POST['fec_proc_prod']);

				echo $crea_codigo."<br>";
				echo $_SESSION['numerico']."<br>";
				echo $_POST['cod_ref_cab']."<br>";
				echo $unico."<br>";
				echo $_POST['tipo_producto']."<br>";
				echo $fec_proc_prod."<br>";
				echo $_POST['provedor_producto']."<br>";
				echo $_POST['nom_prod']."<br>";
				echo $_POST['desc_prod']."<br>";
				echo $_POST['unidad_producto']."<br>";
				echo $_POST['cant_prod']."<br>";
				echo $_POST['prest_prod']."<br>";
				echo $_POST['moneda_producto']."<br>";
				echo "null"."<br>";
				echo $ruta."<br>";
				echo $ruta2."<br>";
				echo $_POST['sucursal_origen']."<br>";
				echo $_SESSION['login']."<br>";




$consulta = "INSERT INTO alm_prod_cabecera (
										alm_prod_cab_id,
										alm_prod_cab_codigo,
										alm_prod_cab_numerico,
										alm_prod_cab_cod_ref,
										alm_prod_cab_id_unico_prod,
										alm_prod_cab_tipo,
										alm_prod_cab_fecha_proceso,
										alm_prod_cab_prov,
										alm_prod_cab_nombre,
										alm_prod_cab_descripcion,
										alm_prod_cab_unidad,
										alm_prod_cab_cantidad_stock,
										alm_prod_cab_presentacion,
										alm_prod_cab_moneda,
										alm_prod_cab_porcentaje,
										alm_prod_cab_img,
										alm_prod_cab_pdf_descp,
										alm_prod_cab_suc_origen,
										alm_prod_cab_usr_alta,
										alm_prod_cab_fch_hr_alta,
										alm_prod_cab_usr_baja,
										alm_prod_cab_fch_hr_baja)
										values(
										 NULL,
										 '$crea_codigo',
										 ".$_SESSION['numerico'].",
										 ".$_POST['cod_ref_cab'].",
										 '$unico',
										 ".$_POST['tipo_producto'].",
										 '$fec_proc_prod',
										 '".$_POST['provedor_producto']."',
										 '".$_POST['nom_prod']."',
										 '".$_POST['desc_prod']."',
										 ".$_POST['unidad_producto'].",
										 ".$_POST['cant_prod'].",
										 '".$_POST['prest_prod']."',
										 ".$_POST['moneda_producto'].",
										 NULL,
										 '".$ruta2."',
										 '".$ruta."', 
										 ". $_POST['sucursal_origen'].",
										 '".$_SESSION['login']."',
										 CURRENT_TIMESTAMP , 
										 NULL , 
										 NULL
										)";
	$query = mysql_query($consulta) or die(mysql_error());
	



?>
<script>
	$(document).on("ready", function(){
		var codigo = "<?php echo $_POST['provedor_producto']; ?>" ;
	new Productos().formularioListarCabDetProductos_tpl(codigo);
	});
</script>