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
	$_SESSION["tot_err"] = 0;
?>
<html>
<head>
<!--Titulo de la pestaña de la pagina-->
<title>Consulta Documento Contable</title>
<meta charset="UTF-8">

<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>
<script language="JavaScript" src="script/calendar_us.js"></script>
<!--script type="text/javascript" src="js/ValidarListaMultiple.js"></script--> 
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>      
<script type="text/javascript" src="js/Utilitarios.js"></script> 


</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar un Asiento Reservado</font></p>
</div>

  <?php
				include("header.php");
			?>
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>

    <?php if($_SESSION['menu']==0){?>
                 <li id="menu_modulo_general">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA SOLIDARIO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTI. RESERVADOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/import_64x64.png" border="0" alt="Modulo" align="absmiddle">UTILIZADOS RESERVADOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Elija el asiento reservado para realizar cambios
        </div>

<?php } elseif($_SESSION['menu']==1){?>

        <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>

              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/import_64x64.png" border="0" alt="Modulo" align="absmiddle">UTILIZAR RESERVADOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Elija el asiento reservado para realizar cambios
        </div>
 <?php }?>



	
           <?php
					 //$fec = leer_param_gral();
					 $logi = $_SESSION['login']; 
				?>
             
<?php
//echo "entra a grabar";
if (isset($_SESSION["tot_err"])){
   if ($_SESSION["tot_err"] == 1){ ?>
<font color="#FF0000">
<?php
echo "No puede anular Asiento Contable de fecha Anterior";

 ?>
 </font>
<?php
}
if ($_SESSION["tot_err"] == 2){ ?>
<font color="#FF0000">
<?php
echo "No puede Modificar  Asiento Contable Automatico";

 ?>
 </font>
<?php
}
}

 $_SESSION['nor_res'] = 2;

$_SESSION['form_buffer'] = $_POST;
/*$consul = 0;
$consul2 = 0;
 $nro_doc = 0;
if (isset($_POST['nro_doc'])){
   $nro_doc = $_POST['nro_doc'];
   $consul = 1;
 }
 if ($nro_doc == 0){
    if (isset($_SESSION['nro_doc'])){
     $nro_doc = $_SESSION['nro_doc'];
	 $consul = 1;
	} 
}	 
 if (isset($_POST['fec_nac'])){
   $fech = $_POST['fec_nac'];
   $fecha = cambiaf_a_mysql_2($fech);
   if ($fecha == "--"){
      $consul2 = 0;
	  }else{
	  $consul2 = 1;
	  }
 }
*/
//consul = 0;
//echo $fecha,$consul,$consul2,$nro_doc ;

   //echo "Consultara todos";
  // if (($consul + $consul2) == 2) {
   $consulta  = "Select CONTA_CAB_NRO,CONTA_CAB_GLOSA, CONTA_CAB_FEC_VAL
	              From contab_cabec where substr(CONTA_CAB_GLOSA,1, 19) = 'Documento Reservado' 
				  and CONTA_CAB_USR_BAJA is null group by 
				  CONTA_CAB_NRO,CONTA_CAB_GLOSA,CONTA_CAB_FEC_VAL order by CONTA_CAB_NRO ";
    $resultado = mysql_query($consulta);
//	}
/*	 if ($consul == 1) {
   $consulta  = "Select CONTA_CAB_NRO,CONTA_CAB_GLOSA
	              From contab_cabec where CONTA_CAB_NRO = $nro_doc and
				  CONTA_CAB_USR_BAJA is null group by 
				  CONTA_CAB_NRO,CONTA_CAB_GLOSA order by CONTA_CAB_NRO ";
    $resultado = mysql_query($consulta);
	}*/
/*	if ($consul2 == 1) {
   $consulta  = "Select CONTA_CAB_NRO,CONTA_CAB_GLOSA
	              From contab_cabec where 
				 CONTA_CAB_FEC_TRAN = '$fecha' and CONTA_CAB_USR_BAJA is null group by 
				  CONTA_CAB_NRO,CONTA_CAB_GLOSA order by CONTA_CAB_NRO ";
    $resultado = mysql_query($consulta);
	} */
?> 
 <?php 
   $resultado = mysql_query($consulta);
 ?>

<center>
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return check(this)">
<select name="nro_doc[]" size="12" width="50" style="width:500px; height:200px;" multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CONTA_CAB_NRO']; ?>>
	    <?php echo cambiaf_a_normal($linea['CONTA_CAB_FEC_VAL']); ?>
		<?php echo $linea['CONTA_CAB_NRO']; ?>
		<?php echo $linea['CONTA_CAB_GLOSA']; ?>
		</option>
<?php
   }
 ?>
  </select>
  <br><br>
  <?php
	  
	  ?>
	  <input class="btn_form" type="submit" name="accion" value="Registro Asiento">
	  <input class="btn_form" type="submit" name="accion" value="Copiar Reservado">
	  <input class="btn_form" type="submit" name="accion" value="Revertir Reservado">

    <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

  
  </form>
  </center>
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