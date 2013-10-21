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
<title>Reimpresiones</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_imp_des_det.js"></script>
<script type="text/javascript" src="js/cajas_imp_cob.js"></script> 

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
                  <li id="menu_modulo_cajas_imp">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                 <?php
                      if($_GET["menu"]==9){?> 
                 <li id="menu_modulo_cajas_imp_des">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SEL. DESEMBOLSOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONAR DESEMBOLSOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion 
                     </div>
					<?php }elseif ($_GET["menu"]==10) {?> 
					<li id="menu_modulo_cajas_imp_cob">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SEL. COBROS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONAR COBROS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de consulta para reimpresion
                     </div> 
                     <?php } ?>


            <div id="UserData">
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
                 //$fec = leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
 <center>

<?php
 $_SESSION['continuar'] = 0;
/* */
/*
 */
//$cod_es = 7;
/* */
  ?> 
 <?php
/*
	*/
	   
?>
 <center>
 <!--div id="GeneralManUsuarioM"-->
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
   echo "Trans.".encadenar(4)."Operacion".encadenar(22)."Cliente / Grupo".$_POST['fec_nac'];
   echo "Aquiiiii ". $_SESSION["reimpre"]. "****";
 ?>
 </strong></font>
<select name="nro_desem" size="12" >


<?php
//echo "Aquiiiii ". $_SESSION["reimpre"]. "****";
$consul = 0;
$consul2 = 0;
 $nro_doc = 0;
if (isset($_POST['nro_doc'])){
   $nro_doc = $_POST['nro_doc'];
   $consul = 1;
 }
/* if ($nro_doc == 0){
     $nro_doc = $_SESSION['nro_doc'];
	 $consul = 1;
} */	 
 if (isset($_POST['fec_nac'])){
   $fech = $_POST['fec_nac'];
   $fecha = cambiaf_a_mysql_2($fech);
   //echo $fecha."----- fecha ----";
   if ($fecha == "--"){
      $consul2 = 0;
	  }else{
	  $consul2 = 1;
	  }
 }

 	//Consulta Cart_maestro
		//	echo $fec1;
if ($_SESSION["reimpre"] == 1){		
if (($consul + $consul2) == 2) {		
			$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where CART_DTRA_FECHA = '$fecha' 
			 and CART_DTRA_NRO_TRAN = $nro_doc
             and CART_DTRA_TIP_TRAN = 1 
			 and CART_DTRA_USR_BAJA is null";
}	
if ($consul == 1) {		
			$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where 	CART_DTRA_NRO_TRAN = $nro_doc
             and CART_DTRA_TIP_TRAN = 1 
			 and CART_DTRA_USR_BAJA is null";
}
if ($consul2 == 1) {
$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where CART_DTRA_FECHA = '$fecha' 
			 and CART_DTRA_TIP_TRAN = 1 
			 and CART_DTRA_USR_BAJA is null";




}
}
if ($_SESSION["reimpre"] == 2){		
if (($consul + $consul2) == 2) {		
			$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where CART_DTRA_FECHA = '$fecha' 
			 and CART_DTRA_NRO_TRAN = $nro_doc
             and CART_DTRA_TIP_TRAN = 2 
			 and CART_DTRA_USR_BAJA is null";
}	
if ($consul == 1) {		
			$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where 	CART_DTRA_NRO_TRAN = $nro_doc
             and CART_DTRA_TIP_TRAN = 2 
			 and CART_DTRA_USR_BAJA is null";
}
if ($consul2 == 1) {
$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where CART_DTRA_FECHA = '$fecha' 
			 and CART_DTRA_TIP_TRAN = 2 
			 and CART_DTRA_USR_BAJA is null";
}
}
					  
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['CART_DTRA_NCRE'];
					$nro_tra = $lin_car['CART_DTRA_NRO_TRAN'];
					$_SESSION['ncre']=$ncre;
			 $con_cli  = "Select * From  cart_deudor, cliente_general
             where  CART_DEU_NCRED = $ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_cli['CLIENTE_NOMBRES'].encadenar(1); 
				}
		// maestro
		
		$con_cli  = "Select * From  cart_maestro
                     where  CART_NRO_CRED = $ncre
                     and CART_MAE_USR_BAJA is null "; 
        $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $c_grup = $lin_cli['CART_COD_GRUPO']; 
			}
				
				
			
		//	
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
           $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	 		      $nom_cli = $nom_cli.encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}
			
			
?>

<option value=<?php echo $nro_tra;?>>
             <?php echo $nro_tra.encadenar(2); ?>  
	          <?php echo $ncre.encadenar(2); ?> 
		      <?php echo  $nom_cli; ?> 
			  
<?php 
}
if ($_SESSION["reimpre"] == 3){
//echo "Aquiiiii ". $_SESSION["reimpre"]. "****";		
if (($consul + $consul2) == 2) {		
			$con_car  = "Select DISTINCT FOND_DTRA_FECHA,FOND_DTRA_NCTA, FOND_DTRA_NRO_TRAN
			 from  fond_det_tran
             where FOND_DTRA_FECHA = '$fecha' 
			 and FOND_DTRA_NRO_TRAN = $nro_doc
             and FOND_DTRA_USR_BAJA is null";
}	
if ($consul == 1) {		
			$con_car  = "Select DISTINCT FOND_DTRA_FECHA,FOND_DTRA_NCTA, FOND_DTRA_NRO_TRAN
			  from  fond_det_tran
             where FOND_DTRA_NRO_TRAN = $nro_doc
             and FOND_DTRA_USR_BAJA is null";
}
if ($consul2 == 1) {
$con_car  = "Select DISTINCT FOND_DTRA_FECHA,FOND_DTRA_NCTA, FOND_DTRA_NRO_TRAN
			 from   fond_det_tran
             where FOND_DTRA_FECHA = '$fecha' 
			 and FOND_DTRA_USR_BAJA is null";
}
 $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['FOND_DTRA_NCTA'];
					$nro_tra = $lin_car['FOND_DTRA_NRO_TRAN']; ?> 
					<option value=<?php echo $nro_tra;?>>
             <?php echo $nro_tra.encadenar(2)."nela"; ?>  
	          <?php echo $ncre.encadenar(2); ?> 
		      <?php echo  $nom_cli; 
					
					
			}		
}	
?>

</select><br><br>
<center>
   <input type="submit" name="accion" value="Reimpresion">
   <!--input type="submit" name="accion" value="Salir"-->
  </form>


</div>
<?php
//}
		 	include("footer_in.php");
		 ?>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>