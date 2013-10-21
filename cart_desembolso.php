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
<!--Titulo de la pestaña de la pagina-->
<title>Desembolso Cartera</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_desembolso.js"></script>  
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
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS 
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSO
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
                      <h2> <img src="img/down_64x64.png" border="0" alt="Modulo" align="absmiddle">DESEMBOLSO</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Solicitud  para Desembolsar
                     </div>
                 
				<?php
                // $fec = leer_param_gral();
        //$fec = $_SESSION['fec_proc'];
        //
        $ag_usr = 30; //$_SESSION['COD_AGENCIA'];
        $fec = leer_fecha_proc($ag_usr);
				// echo "$fec";
         $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; //echo $fec1;
                ?> 
 <center>
<?php
 $_SESSION['continuar'] = 0;
$caj_hab = 1;
$caj_hab = verif_cajero_hab($fec1,$logi);
if ($caj_hab == 0){
     echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
	 $_SESSION['continuar'] = 1;
	 ?> 
   <br>
   <center>
 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>
<?php } 

if ($_SESSION['continuar'] == 0){
// Se realiza una consulta SQL a tabla gral_param_propios
$quecom = 0;
if(isset($_SESSION['form_buffer'])){ 
  $datos = $_SESSION['form_buffer'];
  }
if(isset($_POST['est_sol'])){ 
  $quecom = $_POST['est_sol'];
 }
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_es = $quecom[$i];
 }
}
$cod_es = 7;
$_SESSION['c_estado'] = $cod_es;
$_SESSION['continuar'] = 2;
$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est);
while ($linea = mysql_fetch_array($res_est)){
?>
<strong>Solicitud en Estado </strong>
<?php
   echo $linea['GRAL_PAR_PRO_DESC'];
   }
  ?> 
 <?php
$con_sol = "Select * From cred_solicitud where CRED_SOL_ESTADO = $cod_es and CRED_SOL_FEC_DES = '$fec1' and CRED_SOL_USR_BAJA is null ";
$res_sol = mysql_query($con_sol);
//echo $cod_es;
?>
 <center>
<form name="form2" method="post" action="grab_retro_clim.php" >
<select name="cod_sol[]" size="12" style="width:300px; height:200px;" multiple>
<?php
while ($linea = mysql_fetch_array($res_sol)){
   

  if ($cod_es > 2) {
     $cod_cre = $linea['CRED_SOL_CODIGO'];
	 if ($linea['CRED_SOL_TIPO_OPER'] == 3){
     //echo "$cod_cre";
        $con_deu = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cred_deudor, cliente_general        
                    where cred_deudor.CRED_SOL_CODIGO = $cod_cre and  CRED_DEU_RELACION = 'C' and CLIENTE_COD = CRED_DEU_INTERNO       
                     and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
        $res_deu= mysql_query($con_deu);
   	    while ($lin_deu = mysql_fetch_array($res_deu)){
  	          $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
              $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
              $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
        }
    }   

if ($linea['CRED_SOL_TIPO_OPER'] < 3){
   $con_deu = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES 
              From cred_deudor, cliente_general where   cred_deudor.CRED_SOL_CODIGO = $cod_cre 
              and  CRED_DEU_RELACION = 'C' and CLIENTE_COD = CRED_DEU_INTERNO 
              and   CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
   $res_deu= mysql_query($con_deu);
   while ($lin_deu = mysql_fetch_array($res_deu)){
         $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
         $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
         $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
    } 
   } 
  }
  // echo "$cod_cre";
?>
<option value=<?php echo $linea['CRED_SOL_CODIGO']; ?>>
	          <?php echo $linea['CRED_SOL_CODIGO']; ?> 
		      <?php echo $linea['CLIENTE_AP_PATERNO']; ?> 
			  <?php echo $linea['CLIENTE_AP_MATERNO']; ?> 
			  <?php echo $linea['CLIENTE_NOMBRES'].encadenar(2).$linea['CRED_SOL_IMPORTE'] ?> 
<?php 
}
?>
</select><br><br>
  <input class="btn_form" type="submit" name="accion" value="Desembolsar">
  <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
  </form>


</div>
</div>
</div>
<?php
}
      include("footer_in.php");
     ?>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>