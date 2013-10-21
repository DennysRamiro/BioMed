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
<title>Elimina Cuenta</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_mant_plan_elim.js"></script>    
</head>
<body>
	<?php
				include("header.php");
			?>
<?php
?>
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
if ($_SESSION['continuar'] == 1){ //1a
    $quecom = $_POST['cod_cta'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_cta = $quecom[$i];
        $_SESSION['cod_cta'] = $cod_cta;
       }
   } 
   
   $con_cta  = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cod_cta' ";
     $res_cta = mysql_query($con_cta);
     $des_cta = leer_cta_des($cod_cta);    
    while ($lin_cta = mysql_fetch_array($res_cta)) {  
           $trans = 0;
           $con_trc = "SELECT count(*) FROM contab_trans where CONTA_TRS_CTA = '$cod_cta'";
             $res_trc = mysql_query($con_trc);
              while ($lin_trc = mysql_fetch_array($res_trc)) {
                     $trans =  $lin_trc['count(*)'];
              }     
           $tra10 = 0;
           $con_trc = "SELECT count(*) FROM contab_t2010 where CONTA_TRS_CTA = '$cod_cta'";
             $res_trc = mysql_query($con_trc);
              while ($lin_trc = mysql_fetch_array($res_trc)) {
                     $tra10 =  $lin_trc['count(*)'];
              } 
  ?>  
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>

                 <?php
                      if($_SESSION['menu']==2){?> 
                  <li id="menu_modulo_cont_mant_plan">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                    
                 </li>
                  <li id="menu_modulo_cont_mant_plan_sel">
                    
                     <img src="img/delete user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ELIMINA CUENTAS
                    
                 </li>
                  <li id="menu_modulo_cont_mant_plan_sel_elm">
                    
                     <img src="img/delete user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ELIMINAR CUENTAS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> CUENTA ELIMINADA
                    
                 </li>
              </ul>  
  


<div id="contenido_modulo">

                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle"> CUENTA ELIMINADA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          La cuenta contable fue eliminado con exito
        </div>
				<?php }elseif ($_GET["menu"]==1) { ?>

				
				<li id="menu_modulo_cont_mant_plan">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                    
                 </li>
                <li id="menu_modulo_cont_mant_plan_sel">
                    
                     <img src="img/delete user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ELIMINA CUENTA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/delete user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ELIMINAR CUENTAS
                    
                 </li>
              </ul>  
  


<div id="contenido_modulo">

                      <h2> <img src="img/delete user_64x64.png" border="0" alt="Modulo" align="absmiddle"> ELIMINAR CUENTAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <?php if (($trans + $tra10) > 0)  {  ?>  
                          <div id="error_login2"> 
                          <img src="img/alert_32x32.png" align="absmiddle">
                          La cuenta no puede ser eliminada porque contine transacciones.
                          </div>
        		 <?php } ?>
				
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
<br>
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />NIVEL</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA REVALORIZACION</th>
	   <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th> 
	   <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />NRO.TRANS.</th> 
	</tr>	
	 <tr>
		       <td align="left"><?php echo $cod_cta; ?></td>
	 	    <td align="left"><?php echo utf8_encode($des_cta);?></td>
		      <td align="center"><?php echo $lin_cta['CONTA_CTA_NIVEL']; ?></td>
		       <td align="center"><?php echo $lin_cta['CONTA_CTA_AITB']; ?></td>
		      <td align="center"><?php echo $lin_cta['CONTA_CTA_MONE']; ?></td>	
			   <td align="center"><?php echo $trans + $tra10; ?></td>	
	 <?php    	//2
	 }  ?>
	</table>
	 <center>
	 <?php if (($trans + $tra10) > 0) {  ?>	
		 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
     <?php  }  ?>
	 <?php if ((($trans + $tra10) == 0) and ($_GET["menu"]==1)){  ?>
   <br>	
		 <input class="btn_form" type="submit" name="accion" value="Eliminar Cta.">
     <?php  }  ?> 
</form>	

	
	
	 
</div>
  <?php
		}
if ($_SESSION['continuar'] == 3){		
//	$nue_descrip = $_POST['descrip_2'];
//	echo $nue_descrip," - ",$_SESSION['cod_cta'];
	$cod_cta = $_SESSION['cod_cta'];
	 $con_ctas  = "delete from contab_cuenta where CONTA_CTA_NRO = '$cod_cta'";
    $res_ctas = mysql_query($con_ctas);	
		
    echo "Cuenta eliminida" .$cod_cta; 

	
}		
		
		 ?> 
		 <br>
		 <!--input class="btn_form" type="submit" name="accion" value="Salir"--> 
</form>	
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>