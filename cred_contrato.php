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
	require('funciones2.php');
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
//$_SESSION["total_s"] = 0;
 $fec = leer_param_gral();
 if (isset($_SESSION['login'])){
    $logi = $_SESSION['login'];
	} 
 if (isset($_SESSION['nro_sol'])){
    $nro_sol = $_SESSION['nro_sol'];
	}
 if (isset($_SESSION['form_buffer'])){
    $datos = $_SESSION['form_buffer'];
 }
?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	
     <strong>Datos para el Contrato </strong>
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<center>
<BR><BR>
<strong> Datos en el Contrato de Prestamo </strong><br>
<strong>Segun el Tipo de Operacion </strong>
<br><BR><BR><BR>
<?php
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
if ($_SESSION["continuar"] == 2 ) {
   $quecom = $_POST['cod_sol'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $nro_sol;
          }
       }
   }   
   $con_comf  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD <> 0 ";
   $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla')  ;
   $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD <> 0 ";
   $res_ahof = mysql_query($con_ahof)or die('No pudo seleccionarse tabla')  ;
   $con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
   $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $icom  = $lin_sol['CRED_SOL_IMP_COM'];
		 $i_mes  = round($lin_sol['CRED_SOL_TASA']/ 12,2);
		 $plz_m  = $lin_sol['CRED_SOL_PLZO_M'] * 4;
		 $n_cta  = $lin_sol['CRED_SOL_NRO_CTA'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $t_prod =  $lin_sol['CRED_SOL_PRODUCTO'];
		 $c_grup =  $lin_sol['CRED_SOL_COD_GRUPO'];
		 if (($t_op == 1) and ( $c_grup <> "")){
		    $_SESSION['tipo_cont'] = 1;
		 }
		 if (($t_op == 2) and ($c_grup <> "")){
		    $_SESSION['tipo_cont'] = 2;
		 }
		 if (($t_op == 3) and ($c_grup == "")){
		    $_SESSION['tipo_cont'] = 3;
		 }
		 $con_mon = "Select GRAL_PAR_INT_DESC,GRAL_PAR_INT_SIGLA From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon ";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_mon = mysql_fetch_array($res_mon)) {
		        $mon_d = $lin_mon['GRAL_PAR_INT_DESC'];
				$mon_s = $lin_mon['GRAL_PAR_INT_SIGLA'];
		  }
	 	 $con_com = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD = $comi ";
       $res_com = mysql_query($con_com)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_com = mysql_fetch_array($res_com)) {
		        $com_d = $lin_com['GRAL_PAR_PRO_DESC'];
				$com_f = $lin_com['GRAL_PAR_PRO_CTA1'];
		  }
		  $con_top = "Select GRAL_PAR_INT_DESC  From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and          GRAL_PAR_INT_COD = $t_op ";
        $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_top = mysql_fetch_array($res_top)) {
		        $top_d = $lin_top['GRAL_PAR_INT_DESC'];
				}
		  $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
        $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla')  ;
   	    while ($lin_ahod = mysql_fetch_array($res_ahod)) {
	        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  }
	  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 3')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
	        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  } 
//Datos empresa		  
		 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa')  ;
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
	}
?>  
<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  >
 <font color="#0000FF"
  <strong> Solicitud </strong>
   <?php  
     echo $nro_sol, "  ", $top_d;   
 ?>
 <br><br>
 <strong> Financiera  </strong>
   <?php 
       echo $emp_nom, "      ";   
   ?>
 <strong> Representante  </strong>
   <?php 
      echo $emp_ger, " con ", $emp_cig;   
   ?>
  <br> 
  <strong> Domicilio Financiera </strong>
   <?php 
      echo "calle ", $emp_dir;   
   ?>
  <br><br> 
   <strong> Importe Otorgado </strong>
   <?php 
    if ($comif == 2){
       $impo1 = $impo + $icom ;
	}
	if ($comif == 1){
       $impo1 = $impo;
	}
	$impo = number_format($impo1, 2, '.',',');
	$imp_l = f_literal($impo1,1);
	//echo $impo1; 
    echo $mon_s, " ", $impo , "  (", $imp_l ," " ,$mon_d, ")";   
 ?>
 <br>
 <strong> Plazo </strong>
   <?php 
 	$plz_m = number_format($plz_m, 0, '.',',');
	$plz_i = f_literal($plz_m,3);  
    echo $plz_m, "  (",$plz_i,")", " semanas";   
 ?> 
 <strong> Tasa Interes Mensual </strong>
   <?php
  //   echo $i_mes;   
     $i_mes1 = number_format($i_mes, 2, '.',','); 
	 $imes_i = f_literal($i_mes,2); 
     echo $i_mes1, " %  (", $imes_i," por ciento) " ;   
 ?>
 <br>
    <strong> Amortizaciones </strong>
   <?php
     $n_ctai = f_literal($n_cta,3); 
     echo $n_cta, " (", $n_ctai, ")  ";   
 ?>
 
 <strong>Cancelacion </strong>
   <?php  
    $nrod_i = f_literal($nro_d,3); 
    echo "cada  ", $nro_d, " (",$nrod_i, ") días  "; 
	 if ($t_op == 1) {
  ?>
  <br>
   <strong> Fondo Garantia  </strong>
   <?php
    $_SESSION["aho_d"] =  $ahod; 
	echo " Inicial " , $ahoi. "%" , "  Durante el ciclo ", $ahod. " %";   
   ?>
 <strong> Total Fondo Garantia  </strong>
   <?php
    echo $ahoi + $ahod,  " %";
	}   
 ?>
  <br><br>
 <strong>DEUDORES</strong>
 
 </FONT>
   <?php
$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION, CLIENTE_DIRECCION From cliente_general, cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    ?>
	<table border="1">
	<tr>
	    <th>Nombres</th>
	   	<th>Apellido Paterno</th>
		<th>Apellido Materno</th>
		<th>Documento Id.</th>
		<th>Domicilio</th>
	</tr>

<br><br>
<?php
while ($linea = mysql_fetch_array($resultado)) {
?>
    <tr>
	    <td><?php echo $linea['CLIENTE_NOMBRES']; ?></td>
	 	<td><?php echo $linea['CLIENTE_AP_PATERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_AP_MATERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_COD_ID']; ?></td>
		<td><?php echo $linea['CLIENTE_DIRECCION']; ?></td>
		
<?php	
}
?>
</table>
</center>
<strong>
<center>	
<br><br>
<input type="submit" name="accion" value="Impresion Contrato">
<input type="submit" name="accion" value="Salir">
</form>
 <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Revise los datos para el Contrato</MARQUEE></FONT></B>
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