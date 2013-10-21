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
<title>Consulta Plan Cuentas</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_mant_plan_cons_list.js"></script>  
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
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>



		<?php if ($_GET["menu"]==1) { ?>

                  <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> ESTADO SITUACION BS
                    
                 </li>
              </ul>  
  


					<div id="contenido_modulo">

                      <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO SITUACION BS</h2>
                      <hr style="border:1px dashed #767676;">
                       <!-- id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          
        </div-->
        <?php } elseif ($_GET["menu"]==2) { ?>
                  <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>

                  <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> ESTADO SITUACION BS
                    
                 </li>
              </ul>  
  


					<div id="contenido_modulo">

                      <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO SITUACION BS/$us</h2>
                      <hr style="border:1px dashed #767676;">
                       <!-- id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          
        </div-->

        <?php } elseif ($_GET["menu"]==3) { ?>

                <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>

                 <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> ESTADO RESULTADOS
                    
                 </li>
              </ul>  
  


					<div id="contenido_modulo">

                      <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE RESULTADOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <!-- id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          
        </div-->

          <?php } elseif ($_GET["menu"]==4) { ?>
                <li id="menu_modulo_cont_mant_consul">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                 </li>
                  <li id="menu_modulo_cont_mant_consul_list">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. PLAN DE CTAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> LIST. PLAN DE CTAS
                    
                 </li>
              </ul>  
  


					<div id="contenido_modulo">

                      <h2> <img src="img/notepad_64x64.png" border="0" alt="Modulo" align="absmiddle"> LISTA PLAN DE CUENTAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <!-- id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          
        </div-->

        <?php } ?>


	

<?php
					 //$fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					 // $nro_tr_con = leer_nro_co_con();
				?>



<strong>
 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">
<?php
//echo "Nro. Asiento Contable ".encadenar(2). $nro_tr_con.encadenar(2);?>
<br>
</strong>
<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
//$cuantos = 0;
$debe_1 = 0;
$haber_1 = 0;
$debe_2 = 0;
$haber_2 = 0;
$mon_cta = 0;
$cod_cta = "";
//if ($_SESSION['continuar'] == 2){ //1a
    $quecom = $_POST['cod_cta'];
	 for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_cta = $quecom[$i];
	      $_SESSION['cod_cta'] = $cod_cta;
       }
   } 
   //  echo $cod_cta."cta".$_POST['cod_cta']."---";
   	//2b
	/*if (isset ($_POST['cod_cta'])){
      if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }	//4b
	  } */
	//  echo $cod_cta."cta";
	 $con_cta  = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cod_cta' ";
    $res_cta = mysql_query($con_cta);
     $des_cta = leer_cta_des($cod_cta);		 
	while ($lin_cta = mysql_fetch_array($res_cta)) {	
	   
	?>	
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />NIVEL</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA REVALORIZACION</th>
	   <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>  
	</tr>	
	 <tr>
		       <td align="left"><?php echo $cod_cta; ?></td>
	 	      <td align="left"><?php echo $des_cta; ?></td>
		      <td align="center"><?php echo $lin_cta['CONTA_CTA_NIVEL']; ?></td>
		       <td align="center"><?php echo $lin_cta['CONTA_CTA_AITB']; ?></td>
		      <td align="center"><?php echo $lin_cta['CONTA_CTA_MONE']; ?></td>	

	 <?php  
	 }
?>
	</table>
	 <center>	<br>
		 <!--input class="btn_form" type="submit" name="accion" value="Salir_Plancta"-->
     
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