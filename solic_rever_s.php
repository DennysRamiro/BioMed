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
?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	 
<strong>                      Modificacion Estado de Solicitud</strong><br>
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//if (isset($_SESSION['continuar'])){  
//   if ( $_SESSION['continuar'] == 2) {
//    $cod_s = $_SESSION["cod_sol"];
//    }
//}

if (isset($_POST['cod_sol'])){  
    $quecom = $_POST['cod_sol'];
	}
if (isset($quecom)){  	
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_s = $quecom[$i];
        }
      }
}
?>
<strong>
<?php

//$_SESSION['msg_err'] = " ";
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
	  $a_dur = $lin_sol['CRED_SOL_AHO_DUR'];
	  $n_cta = $lin_sol['CRED_SOL_NRO_CTA'];
	  $f_des = $lin_sol['CRED_SOL_FEC_DES'];
	  $f_uno = $lin_sol['CRED_SOL_FEC_UNO'];
	  $hra_r = $lin_sol['CRED_SOL_HRA_REU'];
	  $dia_r = $lin_sol['CRED_SOL_DIA_REU'];
	  $dir_r = $lin_sol['CRED_SOL_DIR_REU'];
	  $estad = $lin_sol['CRED_SOL_ESTADO'];
	  $_SESSION['producto'] = $lin_sol['CRED_SOL_PRODUCTO']; 
	  $_SESSION['corre'] = $lin_sol['CRED_SOL_NUMERICO']; 
	  $f_des2= cambiaf_a_normal($f_des); 
	  $f_uno2= cambiaf_a_normal($f_uno);  
	//  echo $f_uno2."fecha uno";
	 //agencia
	  $agen = $lin_sol['CRED_SOL_COD_AGE'];
	  $con_age  = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $agen and GRAL_AGENCIA_USR_BAJA is null ";
      $res_age = mysql_query($con_age);
	  while ($linea = mysql_fetch_array($res_age)) {
	  $d_age = $linea['GRAL_AGENCIA_NOMBRE'];
	  }
	//zona
	  $c_zon = $lin_sol['CRED_SOL_ZONA'];
	  $con_zon  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 807 and GRAL_PAR_PRO_COD = $c_zon";
      $res_zon = mysql_query($con_zon);
	  while ($linea = mysql_fetch_array($res_zon)) {
	  $d_zon = $linea['GRAL_PAR_PRO_DESC'];
	  }
	// Tipo Operacion
	  $t_ope = $lin_sol['CRED_SOL_TIPO_OPER'];
	  $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_ope";
      $res_top = mysql_query($con_top);
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }
	  //Estado
	   $con_pro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = $estad";
       $res_pro = mysql_query($con_pro);
	   while ($linea = mysql_fetch_array($res_pro)) {
	         $d_est = $linea['GRAL_PAR_PRO_DESC'];
	   }
	 //  echo "Producto ".$d_pro;
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
       $res_pro = mysql_query($con_pro) ;
	   while ($linea = mysql_fetch_array($res_pro)) {
	         $d_pro = $linea['GRAL_PAR_PRO_DESC'];
	   }
	   echo "Producto ".$d_pro;
	 //Forma de Pago
	   $c_fpa = $lin_sol['CRED_SOL_FORM_PAG']; 
	   $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $c_fpa";
       $res_fpa = mysql_query($con_fpa);
	   while ($linea = mysql_fetch_array($res_fpa)) {
	        $d_fpa = $linea['GRAL_PAR_INT_DESC'];
	   }
	   //Calculo Interes
	   $c_int = $lin_sol['CRED_SOL_CAL_INT'];
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin);
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
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
	  $con_com  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $c_com";
      $res_com = mysql_query($con_com);
      while ($linea = mysql_fetch_array($res_com)) {
	         $d_com = $linea['GRAL_PAR_PRO_DESC'];
	   }
      //Comision forma de cobro
	  $c_fco = $lin_sol['CRED_SOL_COM_F']; 
	  $con_fco  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD = $c_fco";
      $res_fco = mysql_query($con_fco);
      while ($linea = mysql_fetch_array($res_fco)) {
	         $d_fco = $linea['GRAL_PAR_PRO_DESC'];
	   }
      $_SESSION['cod_sol'] = $cod_s;
	  }
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
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
$res_zon = mysql_query($con_zon) ;

$con_com  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD <> 0 ";
$res_com = mysql_query($con_com);
$con_fco  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD <> 0 ";

$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD <> 0 ";
$res_est = mysql_query($con_est);

$con_fco  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD <> 0 ";

$res_fco = mysql_query($con_fco);
$con_cai = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD <> 0";
$res_cai = mysql_query($con_cai);
if (isset($_SESSION['form_buffer'])){ 
    $datos = $_SESSION['form_buffer'];
	}
echo encadenar(2)."Solicitud  ". $cod_s. encadenar(2)."Estado Actual". encadenar(2).$d_est;
$_SESSION["cod_sol"] = $cod_s;	
	
	
	
 ?>
<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  >
<table align="center">
<tr>
   <td><strong>Agencia   </strong></td>
    <td> <?php echo encadenar(5); ?></td>
   <td>  <?php echo $d_age;?> </td>
  </tr>
 <tr>
   <td><strong>Zona </strong></td>
   <td> <?php echo encadenar(5); ?></td>
   <td> <?php echo $d_zon; ?></td>
 </tr>
 <tr>	  
    <td> <strong>Moneda </strong></td>
	 <td> <?php echo encadenar(5); ?></td>
    <td> <?php echo $d_mon; ?>  </td>
    
</tr>		
 <tr> 
    <td><strong>Tipo Operacion </strong></td>
	 <td> <?php echo encadenar(5); ?></td>
    <td> <?php echo $d_top; ?>  </td> 
    
</tr>
<tr>		 
	<td><strong>Origen de Fondos </strong></td>
	 <td> <?php echo encadenar(5); ?></td>
    <td> <?php echo $d_ofo; ?> </td>
 </tr>		
<tr>	
	<td><strong>Comision  </strong></td>
	 <td> <?php echo encadenar(5); ?></td>
	<td><?php echo $d_com;?> </td>
 </tr>
<tr>
   <td><strong>Cobro Comision  </strong></td>
   <td> <?php echo encadenar(5); ?></td>
   <td><?php  echo $d_fco; ?> </td>
   
</tr>
<tr>	   
   <td><strong>Forma Pago </strong></td>
    <td> <?php echo encadenar(5); ?></td>
   <td><?php echo $d_fpa;?> </td>	   
</tr>	   
<tr>
    <td><strong>Calculo Interes </strong></td>
	 <td> <?php echo encadenar(5); ?></td>
	<td><?php echo $d_cin; ?> </td>
    
</tr>
<tr>
    <td><strong>Importe Solicitado  </strong></td>
	<td><?php echo encadenar(5);?></td>
    <td><?php echo number_format($i_sol, 2, '.',',');?> </td>
</tr>
<tr>		 
   <td><strong>Int. Anual % </strong></td>
   <td><?php echo encadenar(5);?></td>
   <td><?php echo number_format($t_int, 2, '.',',');?> </td>
</tr>
<tr>		
   <td><strong>Plzo Meses</strong></td>
   <td><?php echo encadenar(5);?></td>
   <td><?php echo number_format($p_mes, 2, '.',',');?> </td>
</tr>
<tr>
	<td><strong>Nro. Cuotas </strong></td>
	<td><?php echo encadenar(5);?></td>
	<td><?php echo number_format($n_cta, 0, '.',',');?> </td>
</tr>		
<tr>    
    <td><strong>Fondo Garantia Inicio % </strong></td>
    <td><?php echo encadenar(5);?></td>
	<td><?php echo number_format($a_ini, 2, '.',',');?> </td>
</tr>
<tr>	
    <td><strong>Fondo Garantia Ciclo %  </strong></td>
    <td><?php echo encadenar(5);?></td>
	<td><?php echo number_format($a_dur, 2, '.',',');?> </td>
   
</tr>		
<tr>	 
	<td><strong>Fecha Desembolso </strong></td>
	<td><?php echo encadenar(5);?></td>
	<td><?php echo $f_des2; ?></td>
</tr>		
<tr>
    <td><strong>Fecha Primer Pago </strong></td>
    <td><?php echo encadenar(5);?></td> 
	<td><?php echo $f_uno2; ?></td>
</tr>		 
<tr>	 
	<td><strong>Hra Reunion (hh:mm) </strong></td>
	<td><?php echo encadenar(5);?></td>
	<td><?php echo $hra_r;?></td>
</tr>
<tr>
    <td><strong>Dirección Reunion </strong></td>
	<td><?php echo encadenar(5);?></td>
	<td><?php echo  $dir_r; ?></td>
</tr>
<tr>		 
	<td><strong>Nuevo Estado Solicitud </strong></td>
    <td><?php echo encadenar(5);?></td>
    <td><select name="cod_est" size="1"  >
  	    <?php while ($linea = mysql_fetch_array($res_est)) { ?>
        <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
	    <?php echo $linea['GRAL_PAR_PRO_COD'].encadenar(2).
		      $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	    <?php  } ?> 
        </select></td>
		 <td style="color:#FF0000"><?php echo $d_est;?></td>
</tr>
	</table> 
  <br><br>
	<center>  
    <input type="submit" name="accion" value="Cambiar Estado">
    <input type="submit" name="accion" value="Salir">
</form>
<strong>
 <?php
 if (isset($_SESSION['msg_err'])){ 
     echo $_SESSION['msg_err']; 
	 }
 ?>
 </strong>
  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Modificacion Estado de Solicitud </MARQUEE></FONT></B>
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
