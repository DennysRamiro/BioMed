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
<title>Reimpresion Transaccion Fondo Garantia</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/cajas_reim_fongar_sel.js"></script>  
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
                 <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_fg">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> FONDO DE GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SEL. FON. GARAN.
                    
                 </li>
              </ul> 
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONAR FONDO DE GARANTIA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div> 
	
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

	   
?>
<!--div id="cuerpoModulo"-->
 <font size="2">
 <strong>
 <?php
   echo "Trans.".encadenar(4)."Operacion".encadenar(42)."Cliente / Grupo".encadenar(45);
 ?>
 </strong>
 <center>
 
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
  // echo "Trans.".encadenar(4)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<select name="nro_desem" size="12" >


<?php
 	//Consulta Cart_maestro
			echo $fec1;
	if (($consul + $consul2) == 2) {		
	   	 $con_car  = "Select DISTINCT FOND_DTRA_FECHA,FOND_DTRA_NCTA,
			                                 FOND_DTRA_NRO_TRAN,FOND_DTRA_NCRE,
											 FOND_DTRA_TIP_TRAN
			 from  fond_det_tran
             where FOND_DTRA_FECHA = '$fecha' 
			 and FOND_DTRA_NRO_TRAN = $nro_doc
             and FOND_DTRA_NRO_CTA = 2 
               and FOND_DTRA_USR_BAJA is null order by 
			   FOND_DTRA_TIP_TRAN,FOND_DTRA_NRO_TRAN";
}	
if ($consul == 1) {		
			$con_car  = "Select DISTINCT FOND_DTRA_FECHA,FOND_DTRA_NCTA,
			                                 FOND_DTRA_NRO_TRAN,FOND_DTRA_NCRE,
											 FOND_DTRA_TIP_TRAN
			  from  fond_det_tran
             where FOND_DTRA_NRO_TRAN = $nro_doc
             and FOND_DTRA_NRO_CTA = 2 
               and FOND_DTRA_USR_BAJA is null order by 
			   FOND_DTRA_TIP_TRAN,FOND_DTRA_NRO_TRAN";
}
if ($consul2 == 1) {
$con_car  = "Select DISTINCT FOND_DTRA_FECHA,FOND_DTRA_NCTA,
			                                 FOND_DTRA_NRO_TRAN,FOND_DTRA_NCRE,
											 FOND_DTRA_TIP_TRAN
			 from   fond_det_tran
             where FOND_DTRA_FECHA = '$fecha' 
			 and FOND_DTRA_NRO_CTA = 2 
               and FOND_DTRA_USR_BAJA is null order by 
			   FOND_DTRA_TIP_TRAN,FOND_DTRA_NRO_TRAN";
}
			
			
             $res_car = mysql_query($con_car)or die('No pudo seleccionarse fond_det_tran');
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $n_cta = $lin_car['FOND_DTRA_NCTA'];
			        $ncre = $lin_car['FOND_DTRA_NCRE'];
					$nro_tra = $lin_car['FOND_DTRA_NRO_TRAN'];
					$t_tra = $lin_car['FOND_DTRA_TIP_TRAN'];
					$_SESSION['ncre']=$ncre;
			 if ($t_tra == 1){
			     $dep_ret = "Dep";
				 }else{
				 $dep_ret = "Ret";
			  }   		
			 $con_cli  = "Select * From  cart_deudor, cliente_general
             where  CART_DEU_NCRED = $ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse cart_maestro, cart_deudor, cliente_general');
 
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
        $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse 
			 cart_maestro, cart_deudor, cliente_general');
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $c_grup = $lin_cli['CART_COD_GRUPO']; 
			}
				
				
			
		//	
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
           $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	 		      $nom_cli = $nom_cli.encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}	
			
?>

<option value=<?php echo $t_tra.$nro_tra;?>>
             <?php echo $nro_tra.encadenar(2); ?>  
			 <?php echo $dep_ret.encadenar(2); ?>
	          <?php echo $ncre.encadenar(2); ?> 
		      <?php echo  $nom_cli; ?> 
			  
<?php 
}
//}
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