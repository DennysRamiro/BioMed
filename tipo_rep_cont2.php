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
<title>Consulta Documentos Contables</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<!--script type="text/javascript" src="js/ModulosContabilidad.js"></script--> 
<script type="text/javascript" src="js/contabilidad_reg_rev_cop.js"></script> 

   <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
		<script type="text/javascript" src="js/Utilitarios.js"></script> 
</head>


<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Consulta no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. Documento no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Ingrese al menos un campo de b&uacute;squeda </font></p>
</div>
	<?php
				include("header.php");
			?>
<div id="pagina_sistema">
   
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>

<?php  /*     BANCA SOLIDARIO 
  <?php if($_GET["menu"]==0){?>
                 <li id="menu_modulo_general">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA SOLIDARIO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASIENTO CON.
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">CONSULTA ASIENTO CONTABLE</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Ingrese la fecha de consulta / Impresion
        </div>
        */?>

         <?php if($_SESSION['menu'] == 24){ $parm=24;?>

 				<li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">CONSULTA DE ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese los datos para realizar la consulta
        </div>
        <?php } elseif($_SESSION['menu'] == 22){ $parm=22?>
        
                <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_util_res">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/copy_24x24.png" border="0" alt="Modulo" align="absmiddle"> COPIAR ASIENTO RES.
                    
                 </li>

              </ul> 
              <div id="contenido_modulo">
      <h2> <img src="img/copy_64x64.png" border="0" alt="Modulo" align="absmiddle">COPIAR ASIENTO RESERVADO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Registre el asiento
        </div>
        
 <?php }?>
	
			<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
				 if (isset($_SESSION['nor_res'])){ 
				  if ($_SESSION['nor_res'] == 2){
				     if (isset($_POST['nro_doc'])){
                         $quecom = $_POST['nro_doc'];
                         for( $i=0; $i < count($quecom); $i = $i + 1 ) {
                             if( isset($quecom[$i]) ) {
                                $nro_doc = $quecom[$i];
                            	$_SESSION['nro_doc'] = $nro_doc;
								$_SESSION['nro_tr_con'] = $nro_doc;
                         }
                      }
                    } 
				    
				  
					  //   $nro_doc = $_SESSION['nro_tr_con'];
					//	echo $nro_doc;
					     $consulta  = "Select CONTA_CAB_NRO,CONTA_CAB_GLOSA, CONTA_CAB_FEC_VAL
	                                   From contab_cabec where CONTA_CAB_NRO = $nro_doc 
				                       and CONTA_CAB_USR_BAJA is null group by 
				                       CONTA_CAB_NRO,CONTA_CAB_GLOSA,CONTA_CAB_FEC_VAL 
				                       order by CONTA_CAB_NRO ";
                         $resultado = mysql_query($consulta);
						while ($linea = mysql_fetch_array($resultado)) {
					           $fec1 = $linea['CONTA_CAB_FEC_VAL'];
							   $_SESSION['fec1'] = $fec1;
							   $_SESSION['nro_tr_con'] = $nro_doc;
							   
					     }
						 }
				 }		 
                ?> 
			
          
<center>
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="cons_asiento.php?menu=<?php echo $parm ?>" onSubmit="return ValidaCamposConsultaAsiento(this)">
	 <?php
	 if (isset($_SESSION['nor_res'])){
	     if ($_SESSION['nor_res'] == 2){
	         echo "Documento Reservado".encadenar(2). $_SESSION['nro_tr_con']; 
	     }
	 }	 
	 ?>
   <table>
    <tr> 
         <th>Fecha Consulta:</th>
         <td><input class="txt_campo" type="text" id="datepicker" name="fec_nac" maxlength="10"  size="10" > </td>
       </tr>  
			<br>
        <tr>
			   <th>Nro. Documento:</th>
			   <td><input class="txt_campo" type="text" name="nro_doc" maxlength="8" size="5" ></td>
   </tr>   
	</table>	 
  <br>
	  <input class="btn_form" type="submit" name="accion" value="Consultar">
    </form>
    </center>
   <BR><br> 
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