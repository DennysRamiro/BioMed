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
$tipo = $_POST["tipo"];
$cod_ext = $_POST["cod_ext"];
$cod_ext = strtoupper($cod_ext);

//Generar codigo por tipo de proveedor
//Buscar Prefijo
//$tipo = $_POST['tipo_producto'];
//echo $tipo."---";
$nro = leer_correla_prov();
echo "NUM".$nro;
$nom_prov = substr($_POST['nombres'],0,3);
//Arma el codigo
	$n = strlen($nro);
$n2 = 3 - $n;
for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }  
$cod_int =$nom_prov.$r.$nro;

$cod_num=$nro;


//$cod_int = $_POST["cod_int"];

//echo $cod_int; $cod_num
//$cod_int = strtoupper($cod_int);

$mon = $_POST["moneda"];

$mon = strtoupper($mon);
$con = $_POST["continente"];
$con = strtoupper($con);
$pais = $_POST["pais"];
$pais = strtoupper($pais);
$ciu = $_POST["ciudad"];
$ciu = strtoupper($ciu);
$dir = $_POST["direc"];
$dir = strtoupper ($dir);
if(isset($_POST["fono"])){ 
   $fon = $_POST["fono"];
   }else{
   $fon = 999;
   }

 if(isset($_POST["celu"])){ 
   $cel = $_POST["celu"]; 
   }else{
   $cel = 999;
   }   
if(isset($_POST["email"])){ 
   $e_m = $_POST["email"];
   $e_m = ($e_m);
    }else{
	$e_m = "nela";
	}
$fax = $_POST["fax"];
$fax = strtoupper ($fax);
$cont = $_POST["contacto"];
$cont = strtoupper ($cont);
$est = $_POST["estado"];
$e_cont = $_POST["email_cont"];
$e_cont = ($e_cont);
if(isset($_POST["nom_bco"])){ 
   $nom_bco = $_POST["nom_bco"];
   $nom_bco = strtoupper ($nom_bco);
  }else{
	$nom_bco = "";
	}
if(isset($_POST["nom_cta_bco"])){ 
   $nom_cta_bco = $_POST["nom_cta_bco"];
   $nom_cta_bco = strtoupper ($nom_cta_bco);
  }else{
	$nom_cta_bco = "";
	}
if(isset($_POST["nro_cta_bco"])){ 
   $nro_cta_bco = $_POST["nro_cta_bco"];
  }else{
	$nro_cta_bco = "";
	}
if (validar_proveedor($cod_int)) {
	echo "validar";
//header('Location: alm_proveedor_mod_al.php');
      $_SESSION['error'] = "Documento de identificacion ya existe".encadenar(2).$cod_int;
 //  echo "Documento de identificacion ya existe <a href='cliente_mante_a.php'>volver a Intentar</a><br>";
  return;
}
	


    $consulta  = "Insert into alm_proveedor   (alm_prov_codigo_int,
    										   alm_prov_numerico,
    										   alm_prov_tipo,
	                                           alm_prov_codigo_ext,
	                                           alm_prov_nombre,
	                                           alm_prov_contacto,
	                                           alm_prov_email_cont,
	                                           alm_prov_moneda,
	                                           alm_prov_continente,
	                                           alm_prov_fax,
	                                           alm_prov_pais,
	                                           alm_prov_ciudad,
	                                           alm_prov_direccion,
	                                           alm_prov_email,
	                                           alm_prov_telefono,
	                                           alm_prov_celular,
	                                           alm_prov_estado,
											   alm_prov_nom_banco,
											   alm_prov_cod_banco,
											   alm_prov_cod_cta,
	                                           alm_prov_usr_alta,
	                                           alm_prov_fch_hr_alta,
	                                           alm_prov_usr_baja,
	                                           alm_prov_fch_hr_baja) values
											   ('$cod_int',
											   	'$cod_num',
											    '$tipo',
											    '$cod_ext',
											    '$nom',
											    '$cont',
											    '$e_cont',
											    '$mon',
											    '$con',
											    '$fax',
											    '$pais',
											    '$ciu',
											    '$dir',
											    '$e_m',
											    '$fon',
											    '$cel',
											    '$est',
												'$nom_bco',
												'$nom_cta_bco',
												'$nro_cta_bco',
												'$log_usr',
											     null,
											     null,
											    '0000-00-00 00:00:00')";
//echo $cod_int ."-". $cod_num ."-". $tipo ."-".  $cod_ext ."-". $nom ."-". $cont."-". $e_cont."-". $mon."-". $ciu."-". $con."-". $fax."-". $pais."-". $pais."-". $pais."-". $pais;
//print_r($consulta);
$resultado = mysql_query($consulta);

 header('Location: alm_proveedor_mod.php?accion=6');
 
?>
<?php
}
ob_end_flush();
 ?>