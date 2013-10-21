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
<title>Alta Parametros Caja Chica</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="js/ModulosCajaChica.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script> 
 
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
                 <li id="menu_modulo_cajachica">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_cajachica_parametros">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> PARAM. CAJA CHICA
                    
                 </li>
                
              </ul>  


    <div id="contenido_modulo">
				<h2> <img src="img/notepad_64x64.png" border="0" alt="Modulo" align="absmiddle"> PARAMETROS CAJA CHICA </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           
        </div-->
	
           
				<?php
					 //$fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					// $_SESSION['detalle'] = 1;
				?>
          

  <form name="form2" method="post" action="con_retro_1_cjach.php" onSubmit="return ValidaCamposControlEntrega(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios

//echo $_SESSION['detalle'];
if(isset($_SESSION['detalle'])){
 if ($_SESSION['detalle'] == 1){

 /* if (isset($_SESSION['msg_error'])){ ?>
    <font color="#C02121">

    <?php if($_SESSION['menu'] == 1){?> 

	<?php echo $_SESSION['msg_error']; ?>

	 <?php } elseif($_SESSION['menu'] == 2){?>  

	    <div id="error_login2"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           <?php echo $_SESSION['msg_error']; ?>
        </div>

	  <?php echo "Aquiii";
	  }*/?>
    

    <?php 
	  $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A' and substring(CONTA_CTA_NRO,1,6)='111102'";
	  $res_ctas = mysql_query($con_ctas);
	  
	  
	 $con_ase = "Select * From gral_usuario where  GRAL_USR_ESTADO = 1 and
	             GRAL_USR_USR_BAJA is null order by GRAL_USR_NOMBRES";
     $res_ase = mysql_query($con_ase);  ?>
	</font>
	
   	<br>
  <table align="center" class="table_usuario">
	 <tr>
	 <th align="left">Funcionario </th>
	  	   
        <td>    <select name="cod_ase" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_ase)) {?>
             <option value=<?php echo $linea['GRAL_USR_LOGIN']; ?>>
			 <?php echo $linea['GRAL_USR_NOMBRES'].encadenar(2).
			          $linea['GRAL_USR_AP_PATERNO'] ; ?></option>
	         <?php } ?>
		     </select>
			</td> 
			 </tr> 
		  <tr> 
      				<th align="left">Cuenta Contable:</th>
	  				<td> <select name="cod_cta" id="cod_cta" size="1">
	  						
	       					<?php while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
	       
          					 <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
		                				   <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              				   <?php echo utf8_encode($lin_cta['CONTA_CTA_DESC']); ?></option>
           					<?php } 
//echo $_POST['c'];
                    ?>
		    			</select>
					</td>
				 </tr>		 
		 <tr>
        <tr>
		   	 <th align="left">Descripci&oacute;n :</th>
		 		  <td><input class="txt_campo" type="text" name="descrip" id="glosa" size="70" maxlength="70"><div id="error_glosa"></div> </td>
	  			</tr>
		 
		 <th align="left">Monto Asignado:</th>
	    <td><input class="txt_campo" type="text" name="nro_rec2" id="nro_rec2" size="10" maxlength="10"  onKeyPress="return soloNum(event)" onBlur="limpia()"  > 
		<div id="error_nro_rec2"></div></td>
		 </tr>
		  <tr>
              <th align="left" >Vigente Hasta</th>
        <td><input class="txt_campo" type="text" name="fec_des" id="datepicker2" maxlength="10"  size="10" > 
          
		   </td>
		 </tr>
        </table>
	<center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Parametros">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

  <br>

</center>

</form>
<br>
<table border="1" width="200" align="center" class="table_usuario">
	
	<tr>
	    <th align="center">Nro.</th>
	    <th align="center">Responsable </th>  
	   	<th align="center">Descripci&oacute;n</th> 
		<th align="center">Cta. Contab.</th>           
	    <th align="center">Desc. Cta.Contab.</th>
		<th align="center">Monto Asignado</th>
		<th align="center">Saldo</th>
		<th align="center">Vigencia</th>
   </tr>	
	
	
	
	<?php
	}
     }
	 
	  $con_rec = "Select * From cjach_cntrl where CJCH_CTRL_USR_BAJA is null order by CJCH_CTRL_ID ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	   $fec_ent = cambiaf_a_normal($lin_res['CJCH_CTRL_FEC_H']);
	  ?>
	     <tr>
		  <td align="left" ><?php echo $lin_res['CJCH_CTRL_ID']; ?></td>
		  <td align="left" ><?php echo $lin_res['CJCH_CTRL_FUNC']; ?></td> 
		  <td align="left" ><?php echo utf8_encode($lin_res['CJCH_CTRL_NOMB']); ?></td> 
		  <td align="left" ><?php echo $lin_res['CJCH_CTRL_CTA']; ?></td>
		  <td align="left" ><?php $des_cta = leer_cta_des($lin_res['CJCH_CTRL_CTA']);
		  echo utf8_encode($des_cta); ?></td>
		  <td align="right" ><?php echo number_format($lin_res['CJCH_CTRL_ASIG'], 2, '.',','); ?></td>
		  <td align="right" ><?php echo number_format($lin_res['CJCH_CTRL_SALDO'], 2, '.',','); ?></td>
		 <td align="left" ><?php echo $fec_ent; ?></td> 
	    
		
		 </tr>
	<?php
	  }
	 

 ?>

</table>
<br>
<br>

    <?php //} ?>
<?php
if(isset($_SESSION['detalle'])){
 if ($_SESSION['detalle'] == 3){
 $cod_ase = $_POST['cod_ase'];
 $cod_cta = $_POST['cod_cta'];
 $descrip = $_POST['descrip'];
 $descrip = strtoupper($descrip);
// echo $cod_ase;
$_SESSION['cod_ase'] =  $cod_ase;
$fec_des = $_POST['fec_des'];
$fec1 = cambiaf_a_mysql_2($fec_des);
$nro_rec2 = $_POST['nro_rec2'];

//echo $nro_rec1;
/* if (ctype_digit($nro_rec1)) {
       // echo "Son numeros";
    } else {
         $_SESSION['msg_error']= "Nro de Recibo desde debe ser n�mero";
         $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		 $_SESSION['modificar'] = 0;
		 $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	    header('Location: alt_entr_rec.php');
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
	     header('Location: alt_entr_rec.php');
    } */
/*$cuan_1 = 0;
 $con_des = "Select count(*) From recibo_cntrl where  $nro_rec1 >= REC_CTRL_DESDE and
	             $nro_rec1 <= REC_CTRL_HASTA and
	             REC_CTRL_USR_BAJA is null ";
     $res_des = mysql_query($con_des);
	  while ($lin_des = mysql_fetch_array($res_des)) {
	        $cuan_1 =  $lin_des['count(*)'];
	  }

 $con_des = "Select count(*) From recibo_cntrl where  $nro_rec2 >= REC_CTRL_DESDE and
	             $nro_rec2 <= REC_CTRL_HASTA and
	             REC_CTRL_USR_BAJA is null ";
     $res_des = mysql_query($con_des);
	  while ($lin_des = mysql_fetch_array($res_des)) {
	        $cuan_2 =  $lin_des['count(*)'];
	  }
echo $cuan_1,$cuan_2; */
$cuan_1 = 0;
$cuan_2 = 0;
  if (($cuan_1 + $cuan_2) > 0) {
     $_SESSION['msg_error']= "Talonario ya fue asignado";
     $_SESSION['detalle'] = 1 ;
	 $_SESSION['continuar'] = 1 ;
     $_SESSION['modificar'] = 0;
     $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_entr_rec.php');
    } else{
	  
	  
$consulta  = "SELECT CJCH_CTRL_NRO FROM cjach_cntrl where 
              CJCH_CTRL_USR_BAJA is null ORDER BY CJCH_CTRL_NRO 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$nro_tran = $linea['CJCH_CTRL_NRO'];

if (empty($nro_tran)) {
$nro_tran = 1;
   }else{
$nro_tran = $nro_tran + 1;
  }

  
      $consulta = "insert into cjach_cntrl ( CJCH_CTRL_NRO, 
	                                          CJCH_CTRL_AGEN, 
                                              CJCH_CTRL_FUNC,
									          CJCH_CTRL_NOMB,
									          CJCH_CTRL_CTA,
					                          CJCH_CTRL_ASIG,
											  CJCH_CTRL_SALDO,
											  CJCH_CTRL_FECHA,
											  CJCH_CTRL_FEC_D,
											  CJCH_CTRL_FEC_H,
											  CJCH_CTRL_NRO_ASIG,
											  CJCH_CTRL_ESTADO,
											  CJCH_CTRL_USR_ALTA,
											  CJCH_CTRL_FCH_HR_ALTA,
											  CJCH_CTRL_USR_BAJA,
											  CJCH_CTRL_FCH_HR_BAJA											   
					                      ) values ($nro_tran,
										             30,
									                '$cod_ase',
												    '$descrip',
													'$cod_cta',
												     $nro_rec2,
												     $nro_rec2,
												     null,
												     null,
												    '$fec1',
													1,
												    1,
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
		
	header('Location: alt_caja_chica.php'); 
 
  }
 }
 
  	 
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