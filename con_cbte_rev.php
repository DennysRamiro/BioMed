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
<title>Reversion Documento Contable</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_reg_cons_sel_cons.js"></script>  
</head>
  <?php
        include("header.php");
      ?>
<body>	

<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>

          
            
            <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                 <?php if($_SESSION['menu'] == 1){?> 
                  <li id="menu_modulo_contabilidad_asientocontable_consultar">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_consultar_sel">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_consultar_sel_modif_rev">
                    
                     <img src="img/back_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> REVDO. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
          <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">REVERTIDO ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                 <img src="img/checkmark_32x32.png" align="absmiddle">
                    El Asiento fue revertido exitosamente
                 </div>

                 <?php } elseif($_SESSION['menu'] == 2){?>
                  <li id="menu_modulo_contabilidad_asientocontable_util_res">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_util_res_rev">
                    
                     <img src="img/back_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> REVDO. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
          <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">REVERTIDO ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                          <div id="error_login"> 
                 <img src="img/checkmark_32x32.png" align="absmiddle">
                    El Asiento fue revertido exitosamente
                 </div>

                 <?php }?>



	 <!--div id="GeneralManUsuarioM"-->

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

 <center>
 <div id="TableModulo2" >
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
 //  echo "Trans.".encadenar(1)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<?php
//$_SESSION['f_tra'] = $fec_pag;
//$_SESSION['nro_tran'] = $nro_tran;
//			$_SESSION['tipo'] = $tipo;
if (isset($_SESSION['tipo'])){
   $tipo = $_SESSION['tipo'];
}
if (isset($_SESSION['f_tra'])){
   $f_tran = $_SESSION['f_tra'];
}
if (isset($_SESSION['nro_tran'])){
   $nro_tran = $_SESSION['nro_tran'];
}
if (isset($_POST['fec_nue'])){
$fec_nue = $_POST['fec_nue'];
//valida_fecha($fec_nue);
}
$hoy = date("Y-m-d H:i:s");
//$quecom = $_POST['nro_doc'];

    $nro_doc = $_SESSION['nro_doc'];
 
//echo $tipo, $f_tran,$nro_tran;
//reversion caja_transac
if ($_SESSION['con_baj'] == 2){
echo "Trans.".encadenar(1).$nro_doc.encadenar(1)."Revertida";

$act_tabla  = "update contab_trans set CONTA_TRS_USR_BAJA = '$logi',
                                        CONTA_TRS_FCH_HR_BAJA = '$hoy'
               where (CONTA_TRS_FEC_VAL between '$fec1' and '$fec1') and
				      CONTA_TRS_NRO = $nro_doc  and
	                  CONTA_TRS_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla);

$act_tabla  = "update contab_cabec set CONTA_CAB_USR_BAJA = '$logi',
                                        CONTA_CAB_FCH_HR_BAJA = '$hoy'
               where (CONTA_CAB_FEC_TRAN between '$fec1' and '$fec1') and
				      CONTA_CAB_NRO = $nro_doc  and
	                  CONTA_CAB_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla);

}

if ($_SESSION['con_baj'] == 3){

if (valida_fecha($fec_nue)){
echo "Trans.".encadenar(1).$nro_doc.encadenar(1)."Nueva Fecha". encadenar(1).$fec_nue;
$fec_nue_1 = cambiaf_a_mysql($fec_nue);
$act_tabla  = "update contab_trans set CONTA_TRS_FEC_VAL = '$fec_nue_1'
               where  CONTA_TRS_NRO = $nro_doc  and
	                  CONTA_TRS_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla);

$act_tabla  = "update contab_cabec set CONTA_CAB_FEC_VAL = '$fec_nue_1',
                                       CONTA_CAB_FEC_TRAN = '$fec_nue_1'
               where  CONTA_CAB_NRO = $nro_doc  and
	                  CONTA_CAB_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla);
		}	 

}




//}


			 
//reversion cart_maestro
/*$act_tabla  = "update cart_maestro set CART_MAE_USR_BAJA = '$logi',
                                       CART_MAE_FCH_HR_BAJA = '$hoy'
               where CART_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_maestro : ' . mysql_error());
	*/		 
//reversion cart_deudor
/*$act_tabla  = "update cart_deudor set CART_DEU_USR_BAJA = '$logi',
                                      CART_DEU_FCH_HR_BAJA = '$hoy'
               where CART_DEU_NCRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_deudor : ' . mysql_error());	
			 */
//reversion cart_plandp
/*
$act_tabla  = "update cart_plandp set CART_PLD_USR_BAJA = '$logi',
                                      CART_PLD_FCH_HR_BAJA = '$hoy'
               where CART_PLD_NCRE = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_plandp : ' . mysql_error());			 
			 */
//reversion fond_maestro
 
	/*		 
$act_tabla  = "update fond_maestro set FOND_MAE_USR_BAJA = '$logi',
                                       FOND_MAE_FCH_HR_BAJA = '$hoy'
               where FOND_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar fond_maestro : ' . mysql_error());			 
*/

			 
			 			 
//Actualizacion de cred_solicitud
  /* $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=7  where
    CRED_SOL_NRO_CRED = $ncre and CRED_SOL_USR_BAJA is null";
   $res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
*/









 	
	
?>

</select><br><br>
<center>
   
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