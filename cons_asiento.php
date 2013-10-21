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
<title>Consulta Documento Contable</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
<script type="text/javascript" src="js/contabilidad_reg_cons_sel.js"></script>
<script type="text/javascript" src="js/contabilidad_reg_rev_cop.js"></script> 
<!--script type="text/javascript" src="js/ValidarListaMultiple.js"></script--> 
 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
<!--script>
function check() {
if(document.form2["nro_doc[]"].value == "")
{alert('Please choose a widget for Question #2!');
return false; }
return true;
}
</script-->

</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar un Asiento Contable</font></p>
</div>

	<?php
				include("header.php");
			?>
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
            
            <?php if($_SESSION['menu']==22){?>

            
            <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_utilreserva">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_utilreserva_copiar">
                    
                     <img src="img/copy_24x24.png" border="0" alt="Modulo" align="absmiddle"> COPIAR ASIENTO RES.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>

              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONAR DE ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           
        </div>
            

              <?php } elseif($_SESSION['menu']==24){?>

 				<li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_consultar">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>

              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONAR DE ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Elija el Comprobante
        </div>

<?php }?>

				<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
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





$_SESSION['form_buffer'] = $_POST;
$consul = 0;
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
 if (isset($_SESSION['nor_res'])){
	     if ($_SESSION['nor_res'] == 2){
	         echo "Documento Reservado".encadenar(2). $_SESSION['nro_tr_con']; 
	     }
	 }	
//consul = 0;
//echo $fecha."--".$consul."--".$consul2."--".$nro_doc ;
//echo  $fecha;
//echo $_POST['fec_nac'];
   //echo "Consultara todos";
   if (($consul + $consul2) == 2) {
   $consulta  = "Select CONTA_CAB_NRO,CONTA_CAB_GLOSA
	              From contab_cabec where CONTA_CAB_NRO = $nro_doc and
				  CONTA_CAB_FEC_TRAN = '$fecha' and CONTA_CAB_USR_BAJA is null group by 
				  CONTA_CAB_NRO,CONTA_CAB_GLOSA order by CONTA_CAB_NRO ";
    $resultado = mysql_query($consulta);
	}
	 if ($consul == 1) {
   $consulta  = "Select CONTA_CAB_NRO,CONTA_CAB_GLOSA,CONTA_CAB_FEC_TRAN
	              From contab_cabec where CONTA_CAB_NRO = $nro_doc and
				  CONTA_CAB_USR_BAJA is null group by 
				  CONTA_CAB_NRO,CONTA_CAB_GLOSA order by CONTA_CAB_NRO ";
    $resultado = mysql_query($consulta);
	}
	if ($consul2 == 1) {
   $consulta  = "Select CONTA_CAB_NRO,CONTA_CAB_GLOSA, CONTA_CAB_FEC_TRAN
	              From contab_cabec where 
				 CONTA_CAB_FEC_TRAN = '$fecha' and CONTA_CAB_USR_BAJA is null group by 
				  CONTA_CAB_NRO,CONTA_CAB_GLOSA order by CONTA_CAB_NRO ";
    $resultado = mysql_query($consulta);
	}
?> 
 <?php 
   $resultado = mysql_query($consulta);
 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return check(this)">
	<center>
<select name="nro_doc[]" size="12" style="width:700px; height:300px; " multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CONTA_CAB_NRO']; ?>>
		<?php $r = "";
		      $nro_ctf = $linea['CONTA_CAB_NRO'];
		      $n = strlen($nro_ctf);
              $n2 = 6 - $n;
              for ($i = 1; $i <= $n2; $i++) {
              $r = encadenar(1).$nro_ctf;
              }  
		      echo $r; ?>
		<?php echo encadenar(2);?>	  
		<?php echo cambiaf_a_normal_2($linea['CONTA_CAB_FEC_TRAN']);?>
		<?php echo encadenar(2);?>	 
		<?php echo $linea['CONTA_CAB_GLOSA']; ?>
		</option>
<?php
   }
 ?>
  </select>
</center>
  <br><br>
  <?php
	   if (isset($_SESSION['nor_res'])){ 
		  if ($_SESSION['nor_res'] == 1){
	  ?>
	  			<center>
			  <input class="btn_form" type="submit" name="accion" value="Consulta" >
			  <input class="btn_form" type="submit" name="accion" value="Impreso">
			  <input class="btn_form" type="submit" name="accion" value="Revertir">
			  <input class="btn_form" type="submit" name="accion" value="Modifica Asiento">
			  <input class="btn_form" type="submit" name="accion" value="Copiar">
			  <!--input class="btn_form" type="submit" name="accion" value="Cambiar_Fecha"-->
		      <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
		      </center>
     <?php
	    }else{
	 
	  ?>  
	  <center>
	   <input class="btn_form" type="submit" name="accion" value="Copiar_2">
	   <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
	 	</center>  
  <?php
	    }
	  }
	  ?>   
  
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