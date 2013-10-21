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
<title>Cobro enviado por Creditos</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Seleccionar Crédito
            </div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
if(isset($_SESSION['form_buffer'])){ 
   $datos = $_SESSION['form_buffer'];
   }
//$fec_des = $_POST["fec_exp"];
if(isset($_POST['fec_nac'])){  
   $fec_has = $_POST['fec_nac']; 
   $f_des = cambiaf_a_mysql($fec_des);
  }
if(isset($_POST['fec_has'])){    
   $f_has = cambiaf_a_mysql($fec_has);
   $_SESSION['f_has']=$f_has;
 }
$cod_es = 3;
$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est);
while ($linea = mysql_fetch_array($res_est)){
?>
<strong>Cobros Preparados por Créditos  </strong>
<?php
    }
  ?> 
  <br>
 <?php
$con_cob = "Select * From cart_cobro where CART_COB_FECHA = '2011-01-28' and CART_COB_USR_BAJA is null ";
$res_cob = mysql_query($con_cob);
//echo $cod_es;
?>
<form name="form2" method="post" action="cart_cobro_sel.php" >
<select name="cod_cre[]" size="12" multiple>
<?php
while ($linea = mysql_fetch_array($res_cob)){
  if ($cod_es > 2) {
     $cod_cre = $linea['CART_COB_NCRE'];
	 echo $cod_cre;
	// $_SESSION['cod_sol']= $cod_sol;
	// if ($linea['CRED_SOL_TIPO_OPER'] == 3){
        $con_deu = "Select CART_DEU_NCRED,CART_COB_CTA,CART_COB_FECHA,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cart_deudor, cliente_general, cart_cobro where CART_DEU_NCRED = $cod_cre and CART_COB_NCRE = $cod_cre and CART_DEU_RELACION = 'C' and CLIENTE_COD = CART_DEU_INTERNO and CART_COB_USR_BAJA is null and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
        $res_deu= mysql_query($con_deu);
   	    while ($lin_deu = mysql_fetch_array($res_deu)){
		      $fec_pld = $lin_deu['CART_COB_FECHA'];
			  $fec_pld2 = cambiaf_a_normal($fec_pld);
		      $linea['CART_COB_FECHA'] = $fec_pld2;
			  $linea['CART_COB_CTA'] = $lin_deu['CART_COB_CTA']; 
			  $linea['CART_DEU_NCRED'] = $lin_deu['CART_DEU_NCRED'];
  	          $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
              $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
              $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
         }   
 
?>
<option value=<?php echo $linea['CART_DEU_NCRED']; ?>>
	          <?php echo $linea['CART_DEU_NCRED']; ?>
			  <?php echo $linea['CART_COB_FECHA']; ?>
			  <?php echo $linea['CART_COB_CTA']; ?>
			  <?php echo $linea['CLIENTE_AP_PATERNO']; ?> 
			  <?php echo $linea['CLIENTE_AP_MATERNO']; ?> 
			  <?php echo $linea['CLIENTE_NOMBRES']; ?> 
<?php 
  }
}
?>
</select><br><br>
  <input type="submit" name="accion" value="Continuar">
  <input type="submit" name="accion" value="Salir">
  </form>
 
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Elija el Crédito</MARQUEE></FONT></B>
</div>
<?php
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>