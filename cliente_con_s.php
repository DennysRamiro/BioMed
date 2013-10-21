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
 <?php
     include("header.php");
   ?>
<div id="pagina_sistema">
    <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
                  <li id="menu_modulo_creditos_modificar">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> S
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
 
    <h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">M </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
         Incorpore los clientes
        </div>
    
		
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $nro_sol = $_SESSION['nro_sol'];
?> 

<center>
<?php
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
if(isset($_POST["cod"])){
   $cod_cli =$_POST["cod"];
   } else {
   $cod_cli = "";
   }
//echo $_SESSION["continuar"];
//echo $_SESSION['nro_sol'];
if( $_SESSION["continuar"] == 2 ) {
//$_SESSION['msg_error']="";

if( isset($_POST['cod_sol']) ) {
$quecom = $_POST['cod_sol'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $nro_sol = $quecom[$i];
	$_SESSION['nro_sol'] = $nro_sol;
 }
 }
}
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
while ($lin_sol = mysql_fetch_array($res_sol)) {
      $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
	 //
	  }
}else{
$consul = 0;
if(isset($_POST["cod"])){
   $cod_cli =$_POST["cod"];
 } else {
   $cod_cli = "";
   }
//$t_op = $_POST["tip_ope"];
//$t_op = $_SESSION['cod_tipo'];
}
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
<strong> Solicitud </strong>
  <?php   
  echo $nro_sol; 
  $_SESSION['nro_sol'] =  $nro_sol;  
  $cuantos = 0;

  $consulta  = "Select CRED_DEU_RELACION,CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, 
  CLIENTE_NOMBRES From cliente_general, cred_deudor where CRED_SOL_CODIGO = $nro_sol
   and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null
   order by CRED_DEU_RELACION";
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
	 ?>
	 <tr>
	   <td><?php echo $cuantos; ?></td> 
	   <td><?php echo $linea['CRED_DEU_RELACION']; ?></td>
	   <td><?php echo $linea['CLIENTE_COD_ID']; ?></td>
	   <td><?php echo $cliente; ?></td>
	</tr>	
    <?php
}
?>
</table>
<br><br>
<center>
  <input class="btn_form" type="submit" name="accion" value="Consultar-Cliente"> 
  <input class="btn_form" type="submit" name="accion" value="Alta-Cliente">
  <input class="btn_form" type="submit" name="accion" value="Cambia-Coordinador">
  <input class="btn_form" type="submit" name="accion" value="Marca-Garante">
  <input class="btn_form" type="submit" name="accion" value="Siguiente-Paso">
  <input class="btn_form" type="submit" name="accion" value="Salir">

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