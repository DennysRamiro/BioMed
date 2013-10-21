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
<title>Reimpresion Factura</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_imp_fac.js"></script>   
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
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> FACTURA
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">FACTURA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
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
<font size="2">
 <strong>
 <?php
   echo "Trans.".encadenar(4)."Descripcion".encadenar(42)."Monto".encadenar(45);
 ?>
 </strong>
 <center>

<form name="form2" method="post" action="grab_retro_cja.php" >

<?php
 //  echo "Trans.".encadenar(4)."Descripcion ".encadenar(22)."Monto";
 ?>
 </strong></font>
<select name="nro_fac" size="12" >


<?php
 	//Consulta Cart_maestro
	       $_SESSION["reimpre"] = 5; 
			echo $fec1;
			$con_car  = "Select DISTINCT FACTURA_FECHA,FACTURA_NUMERICO,FACTURA_NOMBRE,
			             FACTURA_ESTADO
			 from  factura
             where FACTURA_FECHA = '$fec1'"; 
             $res_car = mysql_query($con_car)or die('No pudo seleccionarse caja_ing_egr');
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $nfac = $lin_car['FACTURA_NUMERICO'];
					$esta = $lin_car['FACTURA_ESTADO'];
					$nom = $lin_car['FACTURA_NOMBRE'];
					/*if ($tipo == 1){
					    $desc = "Ing.";
						}
					if ($tipo == 2){
					    $desc = "Egr.";
						} */	
						
		/*	 $con_cli  = "Select * From  cart_deudor, cliente_general
             where  CART_DEU_NCRED = $ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse cart_maestro, cart_deudor, cliente_general');
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_cli['CLIENTE_NOMBRES'].encadenar(1); 
				} */
		// maestro
		/*
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
			*/	
			
?>

<option value=<?php echo $nfac;?>>
             <?php echo $nfac; ?> 
             <?php echo $esta.encadenar(2); ?>  
	          <?php echo $nom;
			  $_SESSION['$nfac'] = $nfac;
			  //$_SESSION['nro_tran'] = $nro_tra;
			  
			  
			   ?> 
             
			  
<?php 
}
//}
?>

</select><br><br>
<center>
   <input class="btn_form" type="submit" name="accion" value="Reimpresion">
   <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
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