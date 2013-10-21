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
<title>Mantenimiento Directiva Grupo</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
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
               <li id="menu_modulo_clientes">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CLIENTES
                    
                 </li>
                  <li id="menu_modulo_registro_clientes">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO CLIENTES
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
              </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE GRUPOS
              </li>
           </ul> 
    
    <div id="contenido_modulo">

             <h2> <img src="img/tools_64x64.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE GRUPOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                            <img src="img/alert_32x32.png" align="absmiddle">
                               Ingrese Mesa Directiva Grupo / Banca
                        </div>


				<?php
					 //$fec = leer_param_gral();
					 $logi = $_SESSION['login']; 
				?>

        <div id="CueproVerMod">
<?php
$datos = $_SESSION['form_buffer'];
$cod_g = $_SESSION["cod_g"] ;
?>
<?php
// $_SESSION["alta_grab"] = 1;
//$quecom = $_POST['cod_grupo'];
//for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 //if( isset($quecom[$i]) ) {
 //   $cod_g = $quecom[$i];
// }
//}
//echo $_SESSION["alta_grab"];
//if( $_SESSION["alta_grab"] == 2 ) {
 //$cod_g = $_SESSION["cod_g"] ;
 //}else{
 // $_SESSION["cod_g"] = $cod_g ;
 // $_SESSION["alta_grab"] = 1;
//} 
$consulta  = "Select * From cred_grupo where  CRED_GRP_CODIGO = $cod_g and CRED_GRP_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$con_car = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 910 and GRAL_PAR_PRO_COD <> 0 ";
$res_car1 = mysql_query($con_car);
$res_car2 = mysql_query($con_car);
$res_car3 = mysql_query($con_car);
$res_car4 = mysql_query($con_car);
$res_car5 = mysql_query($con_car);
//$datos = $_SESSION['form_buffer'];
  while ($linea = mysql_fetch_array($resultado)) {
		$_SESSION["nombre_g"] = $linea['CRED_GRP_NOMBRE'];
		 ?>
     <strong>Codigo  </strong>
	 <?php
	 echo $linea['CRED_GRP_CODIGO']; 
	  ?>
     <strong>Nombre  </strong>
	 <?php
     echo $linea['CRED_GRP_NOMBRE'];
	 ?>
     <strong>Direccion  </strong>
	 <?php
	 echo $linea['CRED_GRP_DIR_REU']; 
  } 
  ?>		
 </center>
<form name="form1" method="post" action="grupo_retro.php"  target="_self" >
	<?php
	$consulta  = "Select CRED_GRP_MES_CLI, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES,GRAL_PAR_PRO_DESC, CRED_GRP_MES_REL From cliente_general, cred_grupo_mesa, gral_param_propios where CRED_GRP_MES_COD = $cod_g and CRED_GRP_MES_CLI = CLIENTE_COD and GRAL_PAR_PRO_GRP =910 and GRAL_PAR_PRO_COD = CRED_GRP_MES_REL and CRED_GRP_MES_USR_BAJA is null and CLIENTE_USR_BAJA is null and GRAL_PAR_PRO_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    ?>
<strong>
<?php
echo "Cargo Registrado".encadenar(25)."Cliente".encadenar(10)."Nuevo Cargo";
 ?>
  </strong>
<br><br>
<?php
$nro_sel = 0 ;
while ($linea = mysql_fetch_array($resultado)) {
     $rel_mes = $linea['CRED_GRP_MES_REL'];
	 $con_car = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 910 and GRAL_PAR_PRO_COD = $rel_mes ";
	 $res_car = mysql_query($con_car);
	 while ($lin_car = mysql_fetch_array($res_car)){ 
	       $r = "";
		   $s = $lin_car['GRAL_PAR_PRO_DESC'];
		   $nro = strlen($s);
		   $nray = 20 - $nro;
		   echo $s.encadenar($nray);   
             }
	 $nro_sel = $nro_sel + 1;
	// echo  $nro_sel;
	 ?>
  <?php
		$r = "";
		$s = $linea['CLIENTE_AP_PATERNO'].encadenar(1). $linea['CLIENTE_AP_MATERNO'].encadenar(1).$linea['CLIENTE_NOMBRES'];
		$nro = strlen($s);
		$nray = 60 - $nro;
		//echo $nro, $nray;
		 ?>
	  <?php 
        echo $s.encadenar($nray);
  ?>
  	  <?php
	  if( $nro_sel == 1 ) {
	    //$res_car1 = mysql_query($con_car)or die('No pudo seleccionarse tabla')  ;
	   ?>
	  <select name="cod_cargo1[]" size=1 multiple>
	  <?php	
	     $_SESSION["cod_cli1"] =  $linea['CRED_GRP_MES_CLI']; 
	    while ($lin_car = mysql_fetch_array($res_car1)){   
       ?>
   <option value= <?php echo $lin_car['GRAL_PAR_PRO_COD']; ?>><?php echo $lin_car['GRAL_PAR_PRO_DESC']; ?> </option>
	  <?php
        }
      ?> 
    </select>
     <?php
      }
      ?> 
	<?php
	  if( $nro_sel == 2 ) {
	 // $res_car2 = mysql_query($con_car)or die('No pudo seleccionarse tabla')  ;
	   ?>
	  <select name="cod_cargo2[]" size=1 multiple>
	  <?php	
	   $_SESSION["cod_cli2"] =  $linea['CRED_GRP_MES_CLI']; 
	   while ($lin_car = mysql_fetch_array($res_car2)){   
       ?>
   <option value= <?php echo $lin_car['GRAL_PAR_PRO_COD']; ?>><?php echo $lin_car['GRAL_PAR_PRO_DESC']; ?> </option>
	  <?php
        }
      ?> 
    </select>
     <?php
      }
      ?>   
	<?php
	  if( $nro_sel == 3 ) {
	 // $res_car3 = mysql_query($con_car)or die('No pudo seleccionarse tabla')  ;
	   ?>
	  <select name="cod_cargo3[]" size=1 multiple>
	  <?php	
	     $_SESSION["cod_cli3"] =  $linea['CRED_GRP_MES_CLI'];   
	    while ($lin_car = mysql_fetch_array($res_car3)){   
       ?>
   <option value= <?php echo $lin_car['GRAL_PAR_PRO_COD']; ?>><?php echo $lin_car['GRAL_PAR_PRO_DESC']; ?> </option>
	  <?php
        }
      ?> 
    </select>
     <?php
      }
      ?>  
	  <?php
	  if( $nro_sel == 4 ) {
	  //$res_car4 = mysql_query($con_car)or die('No pudo seleccionarse tabla')  ;
	   ?>
	  <select name="cod_cargo4[]" size=1 multiple>
	  <?php	
	      $_SESSION["cod_cli4"] =  $linea['CRED_GRP_MES_CLI'];  
	    while ($lin_car = mysql_fetch_array($res_car4)){   
       ?>
   <option value= <?php echo $lin_car['GRAL_PAR_PRO_COD']; ?>><?php echo $lin_car['GRAL_PAR_PRO_DESC']; ?> </option>
	  <?php
        }
      ?> 
    </select>
     <?php
      }
      ?>  
	   <?php
	  if( $nro_sel == 5 ) {
	  //$res_car5 = mysql_query($con_car)or die('No pudo seleccionarse tabla')  ;
	   ?>
	  <select name="cod_cargo5[]" size=1 multiple>
	  <?php	
	    $_SESSION["cod_cli5"] =  $linea['CRED_GRP_MES_CLI'];    
	    while ($lin_car = mysql_fetch_array($res_car5)){   
       ?>
   <option value= <?php echo $lin_car['GRAL_PAR_PRO_COD']; ?>><?php echo $lin_car['GRAL_PAR_PRO_DESC']; ?> </option>
	  <?php
        }
      ?> 
    </select>
     <?php
      }
      ?>          
<br>
    <?php
}
?>
<center>
    <input class="btn_form" type="submit" name="accion" value="Registrar">
	<input class="btn_form" type="submit" name="accion" value="Volver">
</center>
</form>
</div>


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