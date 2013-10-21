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
<title>Seleccionar Credito</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
                        Credito a Seleccionar
			</div>
            <div id="AtrasBoton">
           		<a href="cred_cobros.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
            </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$datos = $_SESSION['form_buffer'];
//$fec_des = $_POST["fec_exp"]; 
if(isset($_POST['fec_has'])){  
   $fec_has = $_POST['fec_has'];
   $f_has = cambiaf_a_mysql_2($fec_has); 
   $_SESSION['f_has']=$f_has;
 }  
if(isset($fec_des)){   
  $f_des = cambiaf_a_mysql($fec_des);
 }
$cod_es = 3;
$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla')  ;
while ($linea = mysql_fetch_array($res_est)){
?>
<strong>Cartera  </strong>
<?php
   echo $linea['GRAL_PAR_PRO_DESC'];
   }
  ?> 
  <br>
 <strong>Vencimientos al 
<?php
   if(isset($fec_des)){   
      echo $fec_des;
	  }
  ?>  
   </strong>
 <?php
$con_car = "Select * From cart_maestro where CART_ESTADO = $cod_es and CART_MAE_USR_BAJA is null ";
$res_car = mysql_query($con_car)or die('No pudo seleccionarse tabla solicitud')  ;
?>
<form name="form2" method="post" action="cobro_sel.php" >
<select name="cod_cre[]" size="12" multiple>
<?php
while ($linea = mysql_fetch_array($res_car)){
  if ($cod_es > 2) {
     $cod_cre = $linea['CART_NRO_CRED'];
	 $con_deu = "Select CART_DEU_NCRED,CART_PLD_CTA,CART_PLD_FECHA,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cart_deudor, cliente_general, cart_plandp where CART_DEU_NCRED = $cod_cre and  CART_DEU_RELACION = 'C' and CLIENTE_COD = CART_DEU_INTERNO and CART_PLD_NCRE = $cod_cre and (CART_PLD_FECHA = '$f_has') and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null and CART_PLD_USR_BAJA is null";
        $res_deu= mysql_query($con_deu)or die('No pudo seleccionarse tabla deudores');
   	    while ($lin_deu = mysql_fetch_array($res_deu)){
		      $fec_pld = $lin_deu['CART_PLD_FECHA'];
			  $fec_pld2 = cambiaf_a_normal($fec_pld);
		      $linea['CART_PLD_FECHA'] = $fec_pld2;
			  $linea['CART_PLD_CTA'] = $lin_deu['CART_PLD_CTA']; 
			  $linea['CART_DEU_NCRED'] = $lin_deu['CART_DEU_NCRED'];
  	          $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
              $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
              $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
    }   
  }
?>
<?php 
if(isset($linea['CART_DEU_NCRED'])){ 
 ?>
<option value=<?php echo $linea['CART_DEU_NCRED']; ?>>
	          <?php echo $linea['CART_DEU_NCRED']; ?>
			  <?php echo $linea['CART_PLD_FECHA']; ?>
			  <?php echo $linea['CART_PLD_CTA']; ?>
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
Seleccione el Crédito
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