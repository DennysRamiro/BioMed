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
?>
<html>
<head>
<title>Consulta Clientes para Solicitud</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 

<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/mant_cuenta_ape_cta_incor_imp.js"></script>  
</head>
<body>
<?php
        include("header.php");
      ?>
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                  <li id="menu_modulo_mant_cuenta">
                    
                     <img src="img/app folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD MANT. CUENTA
                    
                 </li>
                  <li id="menu_modulo_mant_cuenta_incor">
                    
                     <img src="img/open_32x32.png" border="0" alt="Modulo" align="absmiddle"> APERTURA DE CUENTA
                    
                 </li>
                 <li id="menu_modulo_mant_cuenta_incor_impr">
                    
                     <img src="img/add_32x32.png" border="0" alt="Modulo" align="absmiddle"> INCORPORAR APE. CTA.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> APE. CTA.
                    
                 </li>
              </ul> 
    <!--Cabecera del modulo con su alerta-->
     
     <div id="contenido_modulo">
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">APERTURA DE CUENTA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     
                     </div>            
<?php
//echo "entra a grabar";
$nro_cli = 0;
$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login']; 
$datos = $_SESSION['form_buffer'];
$quecom = $_POST['cod_cliente'];
$nro_sol = $_SESSION['nro_sol'];
$_SESSION['msg_error'] = "";
		// echo $nro_sol;
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_c = $quecom[$i];
 }
}
if (empty($cod_c)) {
    $_SESSION['msg_error'] = "Debe elegir un cliente";
	header('Location: cliente_con_s.php');
	return;
	}
if (validar_deu_solic($cod_c,$nro_sol)) {
   $_SESSION['msg_error'] = "Cliente ya existe en la ";
   header('Location: cliente_con_s.php');
   return;
  // echo "Cliente ya existe en la operacion <a href='cliente_con_s.php'>volver a Intentar</a><br>";
  // return;
 }
 $con_trc = "SELECT count(*) FROM cred_deudor where CRED_SOL_CODIGO = $nro_sol
              and CRED_DEU_USR_BAJA is null";
   $res_trc = mysql_query($con_trc);
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $nro_cli =  $lin_trc['count(*)'];
      } 
 
 
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli);
while ($linea = mysql_fetch_array($res_cli)){
$c_i = $linea['CLIENTE_COD_ID'];
$ccli = $linea['CLIENTE_COD']; 
if ($nro_cli == 0){
    $rsol = "C";
	}else{
	$rsol = "D";
  }	
 }
 // echo $csol,$rsol,$ccli,$c_i,$log_usr;
$consulta  = "Insert into cred_deudor(CRED_SOL_CODIGO, CRED_DEU_RELACION, CRED_DEU_INTERNO, CRED_DEU_ID, CRED_DEU_IMPORTE,CRED_DEU_COMISION, CRED_DEU_AHO_INI, CRED_DEU_AHO_DUR, CRED_DEU_INT_CTA, CRED_DEU_USR_ALTA, CRED_DEU_FCH_HR_ALTA, CRED_DEU_USR_BAJA, CRED_DEU_FCH_HR_BAJA) values 
($nro_sol,'$rsol',$ccli,'$c_i',0,0,0,0,0,'$log_usr',null,null,'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
// require 'cliente_mante_a.php';
 header('Location: cliente_con_s.php');
//echo "Cliente Agregado <a href='cliente_con_s.php'>volver a Consulta de Clientes</a>";
//echo "Volver a Solicitud ?<a href='solic_mante_aa.php'>Volver </a>";
?>
<?php
}
ob_end_flush();
 ?>