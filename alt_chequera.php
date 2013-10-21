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
<!--Titulo de la pesta�a de la pagina-->
<title>Alta Chequera</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery.numeric.js"></script>
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
<script type="text/javascript" src="js/cjas_chequeras.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script>
<script type="text/javascript" src="js/ValidarNumero.js"></script>  
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
 <script src="script/jquery-ui.js"></script>  
 <script type="text/javascript" src="js/calendario.js"></script>


</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 10 7px 20px 0;"></span><font size="2">El campo Nro. Recibo Desde no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2"> El campo Nro. Recibo Hasta no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2"> El Nro. Recibo Desde no puede ser mayor que el Nro. Recibo Hasta</font></p>
</div>

<?php
				include("header.php");
			?>
	
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                  <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                 <li id="menu_modulo_cjas_chequera">
                    
                     <img src="img/checkera_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT.CHEQUERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/compra_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTROL CHEQUERA
                    
                 </li>
              </ul>  


    <div id="contenido_modulo">
					<h2> <img src="img/COMPRA_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONTROL CHEQUERA </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           
        </div-->
	
           
				<?php
					 //$fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
          

  <form name="form2" method="post" action="con_retro_cheq1.php" onSubmit="return ValidaCamposControlEntrega(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
  if (isset($_SESSION['msg_error'])){ ?>
    <font color="#C02121">

    <?php if($_SESSION['menu'] == 1){?> 

	<?php echo $_SESSION['msg_error']; ?>

	 <?php } elseif($_SESSION['menu'] == 2){?>  

	    <div id="error_login2"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           <?php echo $_SESSION['msg_error']; ?>
        </div>

	  <?php }?>
    

    <?php  $con_ase = "Select * From gral_cta_banco where 
	              GRAL_CTA_BAN_COD <> 0 and GRAL_CTA_BAN_USR_BAJA is null order by GRAL_CTA_BAN_CTA_CTE";
     $res_ase = mysql_query($con_ase);  ?>
	</font>
	
   	<br>
  <table align="center" class="table_usuario">
	 <tr>
	 <th align="left">Cuenta Bancaria: </th>
	  	   
        <td>    <select name="cod_ase" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_ase)) {?>
            <option value=<?php echo $linea['GRAL_CTA_BAN_CTA_CTE']; ?>>
			              <?php echo $linea['GRAL_CTA_BAN_CTA_CTE'].encadenar(2); ?>
			              <?php echo utf8_encode($linea['GRAL_CTA_BAN_DESC']); ?></option>
	         <?php } ?>
		     </select>
			</td> 
			 </tr> 
		 <tr>
        <th align="left">Nro. Cheque Desde :</th>
	    <td><input class="txt_campo" type="text" name="nro_rec1" id="nro_rec1" size="10" maxlength="10"   onKeyPress="return soloNum(event)" onBlur="limpia()" > 
		<div id="error_nro_rec1"></div></td>
		 </tr> 
		 
		 <th align="left">Nro. Cheque Hasta :</th>
	    <td><input class="txt_campo" type="text" name="nro_rec2" id="nro_rec2" size="10" maxlength="10"  onKeyPress="return soloNum(event)" onBlur="limpia()"  > 
		<div id="error_nro_rec2"></div></td>
		 </tr>
		 <tr >			 
		  <th align="left">Fecha Entrega: </th>
		  <td align="left"><input class="txt_campo" type="text" id="datepicker" name="fec_des" maxlength="10"  size="10" > </th>
         </tr>
		  <tr>
	         <th align="left">Talonario :</th>
			 <td><input class="txt_campo" type="text" name="descrip" id="des" size="15" maxlength="15"  > <!--input class="btn_form" type="reset" value="limpiar" -->
			 <div id="error_des"></div></td>

		 </tr>
        </table>
	<center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Chequera">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

  <br>

</center>

</form>
<br>
 <table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
	
	<tr>
	     <th align="center">Nro. Cuenta </th>
	    <th align="center">Nombre Cuenta </th>
		<th align="center">Nro. Talon </th>
	    <th align="center">Fecha</th> 
		<th align="center">Nro. Cheque Desde</th>           
	    <th align="center">Nro. Cheque Hasta</th>
   </tr>	
	
	
	
	<?php
	 }
     
	 
	  $con_rec = "Select * From contab_chequera where CONTA_CHRA_USR_BAJA is null order by CONTA_CHRA_CTA";
      $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	        $fec_ent = cambiaf_a_normal($lin_res['CONTA_CHRA_FECHA']);
			$cta_cte = $lin_res['CONTA_CHRA_CTA'];
	        $con_ase = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE= '$cta_cte' and
	                    GRAL_CTA_BAN_COD <> 0 and GRAL_CTA_BAN_USR_BAJA is null order by GRAL_CTA_BAN_CTA_CTE";
            $res_ase = mysql_query($con_ase);
			while ($linea = mysql_fetch_array($res_ase)) {
			   $nom_cta = $linea['GRAL_CTA_BAN_DESC'];
			}
	  ?>
	     <tr>
		  <td align="left" ><?php echo $lin_res['CONTA_CHRA_CTA']; ?></td>
		  <td align="left" ><?php echo  utf8_encode($nom_cta); ?></td> 
		  <td align="left" ><?php echo $lin_res['CONTA_CHRA_TALON']; ?></td> 
		  <td align="left" ><?php echo $fec_ent; ?></td> 
	     <td align="right" ><?php echo $lin_res['CONTA_CHRA_INI']; //number_format($lin_res['REC_CTRL_DESDE'], 0, '.',','); ?></td>
		 <td align="right" ><?php echo $lin_res['CONTA_CHRA_FIN'];//number_format($lin_res['REC_CTRL_HASTA'], 0, '.',','); ?></td>
		 </tr>
	<?php
	  }
	 

 ?>

</table>
<br>
<br>

    <?php } ?>
<?php

 if ($_SESSION['detalle'] == 3){
 $cod_ase = $_POST['cod_ase'];
 echo $cod_ase;
$_SESSION['cod_ase'] =  $cod_ase;
$nro_rec1 = $_POST['nro_rec1'];
$_SESSION['nro_rec1'] =  $nro_rec1;
echo $nro_rec1;
 if (ctype_digit($nro_rec1)) {
       // echo "Son numeros";
    } else {
         $_SESSION['msg_error']= "Nro de Recibo desde debe ser n�mero";
         $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		 $_SESSION['modificar'] = 0;
		 $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	    header('Location: alt_chequera.php');
    } 
$nro_rec2 = $_POST['nro_rec2'];
$_SESSION['nro_rec2'] =  $nro_rec2;
 if (ctype_digit($nro_rec2)) {
       // echo "Son numeros";
    } else {
         $_SESSION['msg_error']= "Nro de Recibo hasta debe ser n�mero";
         $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		 $_SESSION['modificar'] = 0;
		 $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_chequera.php');
    } 
$cuan_1 = 0;
if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
  }
 if(isset($_POST['descrip'])){
      $talon = $_POST['descrip'];
      $_SESSION['talon'] = $talon;
	  
  } 
/*  
 $con_des = "Select count(*) From recibo_cntrl where  $nro_rec1 >= REC_CTRL_DESDE and
	             $nro_rec1 <= REC_CTRL_HASTA and
	             REC_CTRL_USR_BAJA is null ";
     $res_des = mysql_query($con_des);
	  while ($lin_des = mysql_fetch_array($res_des)) {
	        $cuan_1 =  $lin_des['count(*)'];
	  }
$cuan_2 = 0;
 $con_des = "Select count(*) From recibo_cntrl where  $nro_rec2 >= REC_CTRL_DESDE and
	             $nro_rec2 <= REC_CTRL_HASTA and
	             REC_CTRL_USR_BAJA is null ";
     $res_des = mysql_query($con_des);
	  while ($lin_des = mysql_fetch_array($res_des)) {
	        $cuan_2 =  $lin_des['count(*)'];
	  }
echo $cuan_1,$cuan_2;
  if (($cuan_1 + $cuan_2) > 0) {
     $_SESSION['msg_error']= "Talonario ya fue asignado";
     $_SESSION['detalle'] = 1 ;
	 $_SESSION['continuar'] = 1 ;
     $_SESSION['modificar'] = 0;
     $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_entr_rec.php');
    } else{
	  
	  
$consulta  = "SELECT REC_CTRL_NRO FROM recibo_cntrl where 
              REC_CTRL_USR_BAJA is null ORDER BY REC_CTRL_NRO 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['REC_CTRL_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }

*/  
      $consulta = "insert into contab_chequera ( CONTA_CHRA_AGEN, 
	                                          CONTA_CHRA_BNCO, 
                                              CONTA_CHRA_CTA,
									          CONTA_CHRA_TALON,
									          CONTA_CHRA_INI,
					                          CONTA_CHRA_FIN,
											  CONTA_CHRA_FECHA,
											  CONTA_CHRA_USR_ALTA,
											  CONTA_CHRA_FCH_HR_ALTA,
											  CONTA_CHRA_USR_BAJA,
											  CONTA_CHRA_FCH_HR_BAJA											   
					                      ) values (21,
										             1,
									                '$cod_ase',
												    '$talon',
												   $nro_rec1,
												   $nro_rec2,
												 '$f_des2',
												 '$logi',
												 null,
												 null,
												 null
												  )";
$resultado = mysql_query($consulta);	
 $_SESSION['msg_error'] = "";
	      $_SESSION['nor_res'] = 1;
	     $_SESSION['detalle'] = 1;
	     $_SESSION['continuar'] = 1;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		   $_SESSION['menu'] = 1;
	header('Location: alt_chequera.php'); 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
 // }
 }
 
  	 
 
 
 
 
 
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