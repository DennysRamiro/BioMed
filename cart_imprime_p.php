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
<title>Modificar Nombre Grupo</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/cjas_cart_dir_nom_cons_modif_plan.js"></script>    
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
  					<li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                 <li id="menu_modulo_cjas_cartera">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cjas_cartera_directo">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                   <li id="menu_modulo_cajas_cob_group_sel">
                    
                     <img src="img/user_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel_modif">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> SELECCIONAR GRUPO
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel_modificar_grupo">
                    
                     <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR GRUPO
                    
                 </li>
                 <li id="menu_modulo_fondo_grupo">
                    
                     <img src="img/address book_32x32.png" border="0" alt="Modulo" align="absmiddle"> PLAN DE PAGOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/address book_64x64.png" border="0" alt="Modulo" align="absmiddle">PLAN DE PAGOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
				          <img src="img/alert_32x32.png" align="absmiddle">
				         Impresion Plan de Pagos
				        </div>

	
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 


<form name="form1" method="post" action="cobro_retro_opd.php"  >
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//if (isset($_SESSION['continuar'])){  
//   if ( $_SESSION['continuar'] == 2) {
//    $cod_s = $_SESSION["cod_sol"];
//    }
//}
if ($_SESSION['cont_imp'] == 0){
    $ncre = $_POST['ncre'];
    $_SESSION["ncre"] = $ncre;
//if (isset($_POST['ncre'])){  
//    $quecom = $_POST['ncre'];
	}
if ($_SESSION['cont_imp'] == 1){
    $ncre = $_SESSION["nro_cre"];
	}	
 //  for( $i=0; $i < count($quecom); $i = $i + 1 ) {
  //    if( isset($quecom[$i]) ) {
   //      $ncre = $quecom[$i];
//		 $_SESSION["ncre"] = $ncre;
		// $_SESSION["cod_sol"] = $ncre;
//        }
 //     }
 //   }
//}
?>
<strong>
<?php
//if ($_SESSION['cont_imp'] == 1){ 
 //   $ncre = $_SESSION["ncre"];
//}
echo  "Credito Nro. ". $ncre. encadenar(2);
$_SESSION["nro_cre"] = $ncre;
//$_SESSION['msg_err'] = " ";
?>
</strong>
<?php
$con_mae  = "Select CART_TIPO_CRED From cart_maestro 
	 where CART_NRO_CRED = $ncre   
	 and CART_MAE_USR_BAJA is null";
$res_mae = mysql_query($con_mae);
while ($lin_mae = mysql_fetch_array($res_mae)) {
      $tip_cre =  $lin_mae['CART_TIPO_CRED']; 

}

$consulta  = "Select CART_DEU_RELACION, CART_DEU_ID, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cart_deudor 
	 where CART_DEU_NCRED = $ncre and CART_DEU_INTERNO = CLIENTE_COD 
	 and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null  order by CART_DEU_RELACION ";
    $resultado = mysql_query($consulta);
	
    ?>
<table border="1">
	<tr>
	    <th>Nro.</th>
	    <th>Relacion</th>
		<th>Carnet identidad</th>
		<th>Cliente</th>
		<th>Seleccione</th>
	</tr>
<?php
$nro_sel = 0 ;?>
         </tr>
		 <tr>
		 <td> <?php echo encadenar(2); ?></td>
		 <td><?php echo encadenar(2); ?></td>
		 <td><?php echo "GLOBAL"; ?></td>
		 <td><?php echo encadenar(2); ?></td>
		
        <td><INPUT NAME="ncre" TYPE=RADIO VALUE="TODO">	</td> 
		 </tr> 
       		
<?php
while ($linea = mysql_fetch_array($resultado)) {
       $nro_sel = $nro_sel + 1;
		//$r = "";
		$nom_cli = $linea['CLIENTE_AP_ESPOSO'].encadenar(1).$linea['CLIENTE_AP_PATERNO'].encadenar(1). $linea['CLIENTE_AP_MATERNO']
		.encadenar(1).$linea['CLIENTE_NOMBRES'];
		$c_cli = $linea['CART_DEU_ID'];
		$cod_ncre = $ncre;
		//$nray = 60 - $nro;
	//	echo $cod_ncre;
		 ?>
		 <tr>
		 <td><?php echo $nro_sel; ?></td>
		 <td><?php echo $linea['CART_DEU_RELACION']; ?></td>
		 <td><?php echo $linea['CART_DEU_ID']; ?></td>
		 <td><?php echo $nom_cli; ?></td>
		 <?php if ($tip_cre == 1){ ?>
        <td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $linea['CART_DEU_ID']; ?>">	</td> 
		 <?php } ?>
		 </tr>
	  <?php
	     
       }
       ?>
</table>
<center>
    <input class="btn_form" type="submit" name="accion" value="Imprime">
	
</center>
</form>
  <?php
     //  } 
 ?>
 </strong>
  <div id="FooterTable">

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
