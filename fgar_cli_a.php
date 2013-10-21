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
<link href="css/estilo.css" rel="stylesheet" type="text/css">  
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
 //$nro_sol = $_SESSION['nro_sol'];
?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	
            Incorporar Clientes 
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<center>
<?php
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
//if(isset($_POST["cod"])){
//   $cod_cli =$_POST["cod"];
 //  } else {
  // $cod_cli = "";
  // }
//echo $_SESSION["continuar"];
//echo $_SESSION['nro_sol'];
//if( $_SESSION["continuar"] == 2 ) {
//$_SESSION['msg_error']="";

if( isset($_POST['cod_cliente']) ) {
$quecom = $_POST['cod_cliente'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_cli = $quecom[$i];
	$_SESSION['cod_cli'] = $cod_cli;
 }
 }
}
//$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
//$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
//while ($lin_sol = mysql_fetch_array($res_sol)) {
 //     $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
	 //
//	  }
//}else{
//$consul = 0;
//if(isset($_POST["cod"])){
 //  $cod_cli =$_POST["cod"];
 //} else {
  // $cod_cli = "";
   //}
//$t_op = $_POST["tip_ope"];
//$t_op = $_SESSION['cod_tipo'];
//}
?>
 <font color="#FF0000">
 <?php
 if(isset($_SESSION['msg_error'])){
    echo $_SESSION['msg_error'];
    $_SESSION['error'] = "";
	}
?>
 </font>

<form name="form2" method="post" action="incorp_cli_sol.php" >


  <?php 
  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);  
  //echo $_SESSION['cta_aho'];
//   $cta_aho = $_SESSION['cta_aho'];
//  $_SESSION['nro_sol'] =  $nro_sol;  
  $cuantos = 0;

  $consulta  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, 
  CLIENTE_NOMBRES From cliente_general where CLIENTE_COD =  $cod_cli
   and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	
    ?>
<table border="1">
	<tr>
	    <th>Nro. Clientes</th>
		<th>Relacion</th>
		<th>Carnet identidad</th>
		<th>Cliente</th>
	</tr>
<?php
while ($linea = mysql_fetch_array($resultado)) {
      $cliente = $linea['CLIENTE_AP_PATERNO'].encadenar(2).$linea['CLIENTE_AP_MATERNO'].encadenar(2).$linea['CLIENTE_NOMBRES'];
	  $cuantos = $cuantos + 1;
	  $_SESSION['cliente'] = $cliente;
	 ?>
	 <tr>
	   <td><?php echo $cuantos; ?></td> 
	   <td><?php echo "TITULAR"; ?></td>
	   <td><?php echo $linea['CLIENTE_COD_ID']; ?></td>
	   <td><?php echo $cliente; ?></td>
	</tr>	
    <?php
}
?>

 <br><br>
<strong>Moneda  </strong>
		    <?php echo encadenar(8);?>
            <select name="cod_mon" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
</table>
<br><br>
<center>
  <input type="submit" name="accion" value="Grabar"> 
  <input type="submit" name="accion" value="Salir">
</form>
  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Datos de la Cuenta</MARQUEE></FONT></B>
</div>
   <?php
		 	include("footer_in.php");
	 ?> 
</body>
</html>
<?php
}
ob_end_flush();
 ?>