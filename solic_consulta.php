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
<title>Mantenimiento Solicitudes</title>
</head>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
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
 $ag_usr = $_SESSION['COD_AGENCIA'];
?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	 
              Condiciones Generales de Solicitud
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$quecom = $_POST['cod_sol'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_s = $quecom[$i];
 }
}
?>
<strong>
<?php
echo  "Solicitud  ". $cod_s;
$_SESSION["cod_sol"] = $cod_s;
?>
</strong>
<?php
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_s and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
while ($lin_sol = mysql_fetch_array($res_sol)) {
      $i_sol = $lin_sol['CRED_SOL_IMPORTE'];
      $t_op = $lin_sol['CRED_SOL_TIPO_OPER'];
	  $t_int = $lin_sol['CRED_SOL_TASA'];
	  $p_mes = $lin_sol['CRED_SOL_PLZO_M'];
	  $a_ini = $lin_sol['CRED_SOL_AHO_INI'];
	//zona
	  $c_zon = $lin_sol['CRED_SOL_ZONA'];
	  $con_zon  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 807 and GRAL_PAR_PRO_COD = $c_zon";
      $res_zon = mysql_query($con_zon);
	  while ($linea = mysql_fetch_array($res_zon)) {
	  $d_zon = $linea['GRAL_PAR_PRO_DESC'];
	  }
	// Tipo Operacion
	  $t_ope = $lin_sol['CRED_SOL_TIPO_OPER'];
	  $_SESSION['cod_tipo'] = $t_ope;
	//  $_SESSION['t_ope'] = $t_ope;
	  $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_ope";
      $res_top = mysql_query($con_top);
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }
	//Moneda
	  $c_mon = $lin_sol['CRED_SOL_COD_MON'];
	  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $c_mon";
      $res_mon = mysql_query($con_mon);
	  while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	  }
	 //Producto
	   $c_pro = $lin_sol['CRED_SOL_PRODUCTO'];
	   $con_pro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $c_pro";
       $res_pro = mysql_query($con_pro);
	   while ($linea = mysql_fetch_array($res_pro)) {
	         $d_pro = $linea['GRAL_PAR_PRO_DESC'];
	   }
	 //Forma de Pago
	   $c_fpa = $lin_sol['CRED_SOL_FORM_PAG']; 
	   $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $c_fpa";
       $res_fpa = mysql_query($con_fpa);
	   while ($linea = mysql_fetch_array($res_fpa)) {
	        $d_fpa = $linea['GRAL_PAR_INT_DESC'];
	   }
	 //Origen de Fondos
	   $c_ofo = $lin_sol['CRED_SOL_ORG_FON']; 
	   $con_ofo  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD = $c_ofo";
       $res_ofo = mysql_query($con_ofo);
	   while ($linea = mysql_fetch_array($res_ofo)) {
	         $d_ofo = $linea['GRAL_PAR_PRO_DESC'];
	   }
    //Comision
	  $c_com = $lin_sol['CRED_SOL_TIP_COM']; 
	  $con_com  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD = $c_com";
      $res_com = mysql_query($con_com);
      while ($linea = mysql_fetch_array($res_com)) {
	         $d_com = $linea['GRAL_PAR_PRO_DESC'];
	   }
   //Ahorro Durante
     $c_aho = $lin_sol['CRED_SOL_AHO_DUR']; 
	 // $con_aho  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and GRAL_PAR_PRO_COD = $c_aho";
     // $res_aho = mysql_query($con_aho);
     // while ($linea = mysql_fetch_array($res_aho)) {
	 //        $d_aho = $linea['GRAL_PAR_PRO_DESC'];
	 //  }

      $_SESSION['nro_sol'] = $cod_s;
	  }
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $ag_usr and GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD <> 0 ";
$res_top = mysql_query($con_top);
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
$res_mon = mysql_query($con_mon);
$con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD <> 0";
$res_fpa = mysql_query($con_fpa);
$con_pro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD <> 0 ";
$res_pro = mysql_query($con_pro);
$con_ofo  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD <> 0 ";
$res_ofo = mysql_query($con_ofo);
$con_zon  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 807 and GRAL_PAR_PRO_COD <> 0 ";
$res_zon = mysql_query($con_zon);
$con_com  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD <> 0 ";
$res_com = mysql_query($con_com);
$con_aho  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and GRAL_PAR_PRO_COD <> 0 ";
$res_aho = mysql_query($con_aho);
$datos = $_SESSION['form_buffer'];
 ?>
<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self" >
<strong>Agencia   </strong>
 <?php
   while ($linea = mysql_fetch_array($resultado)) {
         echo $linea['GRAL_AGENCIA_NOMBRE']; 
 	     } 
 ?>
 <strong>  Zona </strong>
 <?php
   echo $d_zon;
 ?> 
 <strong>  Tipo Operacion </strong>
 <?php
   echo $d_top;
 ?> 
 <BR><br>
 <strong>  Moneda  </strong>
 <?php
  echo $d_mon;
 ?> 
 <strong>  Importe Solicitado  </strong>
 <?php
  $datos['imp_sol'] =  number_format($i_sol, 2, '.',',');  
  echo $datos['imp_sol'];
 ?>
 <strong> Producto  </strong>
 <?php
  echo $d_pro;
 ?> 
 <br><br>
 <strong> Tasa Int. Anual % </strong>
 <?php
  echo $t_int;  
 ?>
 <strong> Plazo Meses</strong>
 <?php
  echo $p_mes;  
 ?>
 <strong> Forma de Pago </strong>
 <?php
  echo $d_fpa;
 ?> 
 <br><br>
 <strong> Origen de Fondos </strong>
 <?php
  echo $d_ofo;
 ?> 
 <strong> Comision  </strong>
 <?php
  echo $d_com;
 ?> 
 <strong> Fondo Garantia Ciclo  </strong>
 <?php
  echo $c_aho, "  %";
?> 
 <strong> Fondo Garantia  Inicio % </strong>
 <?php
 echo $a_ini;  
 ?>
 <br><br>
 <center>
    <input type="submit" name="accion" value="Siguiente Paso">
    <input type="submit" name="accion" value="Salir">

</form>
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Continue con la siguiente etapa</MARQUEE></FONT></B>
</div>
   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
<?php
}
ob_end_flush();
 ?>s