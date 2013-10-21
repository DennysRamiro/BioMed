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
<title>Actualizaci&oacute;n UFV's</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Calculo no puede estar vacio.</font></p>
</div>
	<?php
				include("header.php");
			?>
	<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_ufv">
                    
                     <img src="img/mante_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. DE UFV'S
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/save_24x24.png" border="0" alt="Modulo" align="absmiddle"> ACTUALIZACION UFV'S
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/save_64x64.png" border="0" alt="Modulo" align="absmiddle"> ACTUALIZACION DE UFV'S </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           La Actualizaci&oacute;n de Ufv's se realiz&oacute; con exito
        </div>
	
          <?php
                 $fec = $_SESSION['fec_proc']; //leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon) ;
                ?> 
			

   <form name="form2" method="post" action="con_ufv_op.php" onSubmit="return ValidarCamposActUfv(this)">
   <center>
   	<BR>
<?php if ($_SESSION['detalle'] == 1) { ?>
         <strong>Fecha C&aacute;lculo:</strong>
         <input class="txt_campo" type="text" id="datepicker" name="fec_nac" maxlength="10"  size="10" > 
         
			 <br><br> 
			
	  <input class="btn_form" type="submit" name="accion" value="Consultar">

    </center>
   <BR><br> 
 <?php	}  ?> 
 <?php if ($_SESSION['detalle'] == 2) {   
 

$f_des = "";
$f_has = "";
$mone = " ";
if(isset($_POST['fec_nac'])){
      $f_des = $_POST['fec_nac'];
	  $mes = substr($f_des,3,2);
	  $anio = substr($f_des,6,4);
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
	  
  }

 $con_emp = "Select *  From gral_ufv_cambio where month(GRAL_UFV_CAM_FECHA)=$mes and
             year(GRAL_UFV_CAM_FECHA)=$anio and GRAL_UFV_CAM_FECHA >= '$f_des2'  ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $fec_ufv = $lin_emp['GRAL_UFV_CAM_FECHA'];
				$ufv_cam = $lin_emp['GRAL_UFV_CAM_CONTAB'];
				 $dia = substr($fec_ufv,8,2);
				 $dia = number_format($dia, 0, '.',',');
			//	echo $dia." * ";
				 $dia_ufv[$dia] = $dia; 
				 $tip_ufv[$dia] = $ufv_cam; 
				 $f_ufv[$dia] = $fec_ufv; 
				// echo  $dia_ufv[$dia]."  ".$fec_ufv[$dia];
				
		  }
		  $_SESSION['dias'] = $dia;
			
		?>  
	 <table align="center">	  
	<?php	  
	for ($x=1; $x < $dia + 1; $x = $x + 1 ) {		//echo $dia_ufv[$x];	 //eroroooooooooooooooooooooooooooooooooo
	 ?>
	    <?php if( $dia_ufv[$x] == 1){?>
		<tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_1" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td> 
		 </tr>
	    <?php }?> 
		
		 <?php if( $dia_ufv[$x] == 2){?>
		 <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_2" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td> 
		</tr> 
	    <?php }?> 
		 <?php if( $dia_ufv[$x] == 3){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_3" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td> 
		 </tr>
	    <?php }?> 
		 <?php if( $dia_ufv[$x] == 4){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_4" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		 <?php if( $dia_ufv[$x] == 5){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_5" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		 <?php if( $dia_ufv[$x] == 6){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_6" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		 <?php if( $dia_ufv[$x] == 7){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_7" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 8){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_8" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 9){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_9" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 10){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_10" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 11){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_11" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 12){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_12" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> <?php if( $dia_ufv[$x] == 13){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_13" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 14){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_14" width="14"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 15){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_15" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 16){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_16" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 17){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_17" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 18){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_18" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 19){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_19" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 20){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_20" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 21){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_21" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 22){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_22" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 23){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_23" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 24){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_24" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 25){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_25" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 26){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_26" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 27){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_27" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 28){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_28" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 29){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_29" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 30){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_30" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		<?php if( $dia_ufv[$x] == 31){?>
		  <tr>
		 <td><?php echo cambiaf_a_normal($f_ufv[$x]);?></td>  
         <td>   <input class="txt_campo" type="text"  style align="right" name="ufv_31" width="10"  size="20" value="<?=$tip_ufv[$x];?>" ></td>
		 </tr> 
	    <?php }?> 
		
<?php }?>


</table>
<center>
 <input class="btn_form" type="submit" name="accion" value="Actualizar">
 </center>
    </form>
 <?php	}  ?>

 <?php if ($_SESSION['detalle'] == 3) {   
 
$_SESSION['detalle'] = 0;
$f_des = "";
$f_has = "";
$mone = "";
if(isset($_SESSION['f_des'])){
      $f_des = $_SESSION['f_des'];
	  $mes = substr($f_des,3,2);
	  $anio = substr($f_des,6,4);
   } 
 $dia = $_SESSION['dias'];
 $impo = 1;  
 for ($x=1; $x < $dia + 1; $x = $x + 1 ) {	  	
	  if ($x == 1){
	      $impo = $_POST["ufv_1"];
		  
	  }
	  if ($x == 2){
	      $impo = $_POST["ufv_2"];
		  
	  } 
	  if ($x == 3){
	      $impo = $_POST["ufv_3"];
	  }
	  if ($x == 4){
	      $impo = $_POST["ufv_4"];
	  }  
	  if ($x == 5){
	      $impo = $_POST["ufv_5"];
	  }
	  if ($x == 6){
	      $impo = $_POST["ufv_6"];
	  }
	  if ($x == 7){
	      $impo = $_POST["ufv_7"];
	  }
	  if ($x == 8){
	      $impo = $_POST["ufv_8"];
	  }
	  if ($x == 9){
	      $impo = $_POST["ufv_9"];
	  }
	  if ($x == 10){
	      $impo = $_POST["ufv_10"];
	  }
	  if ($x == 11){
	      $impo = $_POST["ufv_11"];
	  }
	  if ($x == 12){
	      $impo = $_POST["ufv_12"];
	  }
	  if ($x == 13){
	      $impo = $_POST["ufv_13"];
	  }
	  if ($x == 14){
	      $impo = $_POST["ufv_14"];
	  }
	  if ($x == 15){
	      $impo = $_POST["ufv_15"];
	  }
	  if ($x == 16){
	      $impo = $_POST["ufv_16"];
	  }
	  if ($x == 17){
	      $impo = $_POST["ufv_17"];
	  }
	  if ($x == 18){
	      $impo = $_POST["ufv_18"];
	  }
	  if ($x == 19){
	      $impo = $_POST["ufv_19"];
	  }
	  if ($x == 20){
	      $impo = $_POST["ufv_20"];
	  }
	  if ($x == 21){
	      $impo = $_POST["ufv_21"];
	  }
	  if ($x == 22){
	      $impo = $_POST["ufv_22"];
	  }
	  if ($x == 23){
	      $impo = $_POST["ufv_23"];
	  }
	  if ($x == 24){
	      $impo = $_POST["ufv_24"];
	  }
	  if ($x == 25){
	      $impo = $_POST["ufv_25"];
	  }
	  if ($x == 26){
	      $impo = $_POST["ufv_26"];
	  }
	  if ($x == 27){
	      $impo = $_POST["ufv_27"];
	  }
	  if ($x == 28){
	      $impo = $_POST["ufv_28"];
	  }
	  if ($x == 29){
	      $impo = $_POST["ufv_29"];
	  }
	  if ($x == 30){
	      $impo = $_POST["ufv_30"];
	  }
	  if ($x == 31){
	      $impo = $_POST["ufv_31"];
	  }
	  $act_ufv  = "update gral_ufv_cambio set GRAL_UFV_CAM_CONTAB = $impo
	               where month(GRAL_UFV_CAM_FECHA) = $mes and year(GRAL_UFV_CAM_FECHA) = $anio
				   and day(GRAL_UFV_CAM_FECHA) = $x";
      $res_act_s = mysql_query($act_ufv);
  }	
  require 'con_mant_ufv.php';

	
?>
  <script languaje="JavaScript">
				location.href='modificar_as1.php';
				</script>
<?php }	
	
?>	
	
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

