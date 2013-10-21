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
<title>Clientes Solicitud Acople</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	
<div id="cuerpoModulo">
     <?php
	   include("header.php");
 	 ?>
<div id="UserData">
     <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />	
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $nro_sol = $_SESSION['nro_sol'];
 $log_usr = $_SESSION['login'];
 $cod_c = $_SESSION["cod_cre"];
?> 
<center>
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div> 
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	 
             Clientes Solicitud Credito Acople
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<?php
echo encadenar(3)."Credito  Nro ".encadenar(3).$cod_c;
if(isset($_SESSION['form_buffer'])){
   $_SESSION['form_buffer'] = $_POST;
   }
$consul = 0;
if(isset($_POST["cod"])){
   $cod_cli =$_POST["cod"];
}


//Clientes del credito Principal

$consulta  = "Select CART_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cart_deudor where CART_DEU_NCRED = $cod_c and CART_DEU_INTERNO = CLIENTE_COD and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    ?>
<center>
<table border="1">
	<tr>
	    <th>Codigo Int</th>
		<th>Carnet identidad</th>
		<th>Cliente</th>
		
	</tr>
<?php

while ($linea = mysql_fetch_array($resultado)) {
      $nom_cli= $linea['CLIENTE_AP_PATERNO'].encadenar(1).$linea['CLIENTE_AP_MATERNO'].encadenar(1).$linea['CLIENTE_NOMBRES'];
	 ?>
	 <tr>
		<td><?php echo $linea['CART_DEU_INTERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_COD_ID']; ?></td>
		<td><?php echo $nom_cli; ?></td>
	  <?php
}
?>
</table>
<?php

if( $_SESSION["continuar"] == 2 ) {
   $quecom = $_POST['cod_sol'];
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
       if( isset($quecom[$i]) ) {
          $nro_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $nro_sol;
       }
    }
    $con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
    $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
    while ($lin_sol = mysql_fetch_array($res_sol)) {
          $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		  }
  }else{
    $consul = 0;
	
if(isset($_POST["cod"])){
    $cod_cli =$_POST["cod"];
 }
}

if(isset($_SESSION['msg_error'])){
   echo $_SESSION['msg_error'];
   }
 $consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 8";
 
?> 
<br>
 <strong>
 <?php  
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
   echo  "Clientes para la Solicitud Nro.".encadenar(3).$nro_sol;   
 ?>
 </strong>
<form name="form2" method="post" action="incorp_cli_sol.php" >
<select name="cod_cliente[]" size="8" multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CLIENTE_COD']; ?>>
		<?php echo $linea['CLIENTE_AP_PATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_MATERNO']; ?>
		<?php echo $linea['CLIENTE_NOMBRES']; ?>
		
 <?php
   }
   
 ?>

  </select><br><br>
  <input type="submit" name="accion" value="Adicionar-Cliente">
  <input type="submit" name="accion" value="Alta-Cliente">
  <input type="submit" name="accion" value="Siguiente-Paso">
  <input type="submit" name="accion" value="Salir">
  <?php
//$cod_grupo = $_SESSION['cod_grupo'];

	
$con_deu  = "Select * From cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_USR_BAJA is null ";
$res_deu = mysql_query($con_deu);
$cuantos = 0;
while ($nro_deu = mysql_fetch_array($res_deu)) {
   $cuantos = $cuantos + 1 ;

}

  //  echo $cuantos;
  
//if ($t_op < 3) { 
//if ($cuantos == 0) {
//$con_grp  = "Select CRED_GRP_MES_REL, CRED_GRP_MES_CLI, CLIENTE_COD_ID From cliente_general, cred_grupo_mesa where CRED_GRP_MES_COD = $cod_grupo and CRED_GRP_MES_CLI = CLIENTE_COD  and CRED_GRP_MES_USR_BAJA is null and CLIENTE_USR_BAJA is null order by CRED_GRP_MES_REL";
//$res_grp = mysql_query($con_grp);
//while ($lin_grp = mysql_fetch_array($res_grp)) {
//$rels = $lin_grp['CRED_GRP_MES_REL'];
// $ccli = $lin_grp['CRED_GRP_MES_CLI'];
// $c_i  = $lin_grp['CLIENTE_COD_ID'];
// if ($rels == 1) {
//    $rsol = "C";
//	}
//	else {
//	$rsol = "D";
//	}
	
//	$consulta  = "Insert into cred_deudor(CRED_SOL_CODIGO, CRED_DEU_RELACION, CRED_DEU_INTERNO, CRED_DEU_ID, CRED_DEU_USR_ALTA, CRED_DEU_FCH_HR_ALTA, CRED_DEU_USR_BAJA, CRED_DEU_FCH_HR_BAJA) values 
//($nro_sol,'$rsol',$ccli,'$c_i','$logi',null,null,'0000-00-00 00:00:00')";
//$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error()); 
	
//}
//}
//}

$con_deu2  = "Select * From cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_USR_BAJA is null ";
$res_deu2 = mysql_query($con_deu2);
$cuantos2 = 0;
while ($nro_deu2 = mysql_fetch_array($res_deu2)) {
   $cuantos = $cuantos + 1 ;

}


if ($cuantos > 0) {
   $act_estado = "update cred_solicitud set CRED_SOL_ESTADO = 3 where CRED_SOL_CODIGO= $nro_sol and  CRED_SOL_USR_BAJA is null";
  $res_estado = mysql_query($act_estado)or die('No pudo actualizar estado : ' . mysql_error());
}

  $consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    ?>

<table border="1">
	<tr>
	    <th>Codigo Int</th>
		<th>Carnet identidad</th>
		<th>Ap.Paterno</th>
		<th>Ap.Materno</th>
		<th>Nombres</th>
	</tr>
<?php

while ($linea = mysql_fetch_array($resultado)) {
	 ?>
	 <tr>
		<td><?php echo $linea['CRED_DEU_INTERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_COD_ID']; ?></td>
		<td><?php echo $linea['CLIENTE_AP_PATERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_AP_MATERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_NOMBRES']; ?></td>
    <?php
}
?>
</table>
  </form>
  <?php
}
ob_end_flush();
 ?>

