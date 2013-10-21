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
<title>Reversion Caja Chica</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cjach_rev_trans.js"></script>  
<script type="text/javascript" src="js/ModulosCajaChica.js"></script> 
<script type="text/javascript" src="js/cajas_imp_bco.js"></script>  
</head>
<body>
	

<div id="dialog-confirm" title="Advertencia" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar una transacci&oacute;n</font></p>
</div>
	<?php
				include("header.php");
			?>

  <div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
    
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_cajachica">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_cajachica_reversion">
                    
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> CJA CHI REVERSIONES
                    
                 </li>
                
              </ul>  



                  <?php
                      if($_SESSION['menu'] == 1){?> 
                  <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> BANCOS
                    
                 </li>
              </ul> 
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/add box_64x64.png" border="0" alt="Modulo" align="absmiddle">REVERSION CAJA CHICA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Elija la Transacci&oacute;n de gasto Caja Chica
                     </div> 
  					<?php }elseif ($_SESSION['menu'] == 2) {?>
                      <li id="menu_modulo_cajas_imp">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> BANCOS
                    
                 </li>
              </ul> 
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/officer_64x64.png" border="0" alt="Modulo" align="absmiddle">BANCOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Elija la Transacci&oacute;n de gasto Caja Chica
                     </div>  
                     <?php } ?>        
 <center>

<?php
                 //$fec = leer_param_gral();
        $fec = $_SESSION['fec_proc'];
         $fec1 = cambiaf_a_mysql_2($fec);
         $logi = $_SESSION['login']; 
                ?> 


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
   echo "Trans.".encadenar(4)."Descripci&oacute;n".encadenar(15)."Monto".encadenar(64);
 ?>
 </strong>
 <center>

<form name="form2" method="post" action="con_retro_1_cjach.php" onSubmit="return ValidarCampoLista(this)">

<?php
 //  echo "Trans.".encadenar(4)."Descripcion ".encadenar(22)."Monto";
 ?>
 </strong></font>
<select name="nro_tra" size="12" style="width:500px; height:300px;">


<?php

   
 	//Consulta Cart_maestro
			echo $fec1;
			$con_car  = "Select DISTINCT CJCH_TRAN_FECHA,CJCH_TRAN_NRO_COR,CJCH_TRAN_DESCRIP
			             
			 from cjach_transac
             where CJCH_TRAN_FECHA = '$fec1'
			 and  CJCH_TRAN_TIPO_OPE = 2
             and CJCH_TRAN_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			               $ncre = $lin_car['CJCH_TRAN_DESCRIP'];
					        // $desc = $lin_car['CJCH_TRAN_DESCRIP'];
					           $nro_tra = $lin_car['CJCH_TRAN_NRO_COR'];
					
					//$impo = $lin_car['CAJA_DEP_IMPO2'];
          				/*	if ($tipo == 1){
          					    $desc = "Dep.";
          						}
          					if ($tipo == 2){
          					    $desc = "Ret.";
          						}	*/		
?>
<table>
<tr>
<td><option value=<?php echo $nro_tra;?>></td>
<td><?php //echo $desc.encadenar(5); ?> </td>              
<td><?php echo $nro_tra.encadenar(5); ?></td>              
<td><?php echo $ncre.encadenar(2); ?></td>                         
</tr>             
		  
<?php 
}
//}
?>
</table>  
</select><br><br>
<center>
  <?php
                      if($_SESSION['menu'] == 1){?> 
   <input class="btn_form" type="submit" name="accion" value="Detalle Gasto">
   <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
<?php }elseif ($_SESSION['menu'] == 2) {?>
   <input class="btn_form" type="submit" name="accion" value="Reimpresion Bancos">
<?php } ?> 
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