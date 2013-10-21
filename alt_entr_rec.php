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
<title>Alta Entrega Recibos</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
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
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_facturacion_recibos">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> RECIBOS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTROL ENTREGA
                    
                 </li>
              </ul>  


    <div id="contenido_modulo">
				<h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONTROL DE ENTREGA </h2>
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
          

  <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposControlEntrega(this)">
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
    

    <?php  $con_ase = "Select * From gral_usuario where  
	             GRAL_USR_ESTADO = 1 and
	             GRAL_USR_USR_BAJA is null order by GRAL_USR_NOMBRES";
     $res_ase = mysql_query($con_ase);  ?>
	</font>
	
   	<br>
  <table align="center" class="table_usuario">
	 <tr>
	 <th align="left">Funcionario: </th>
	  	   
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
        <th align="left">Nro. Recibo Desde :</th>
	    <td><input class="txt_campo" type="text" name="nro_rec1" id="nro_rec1" size="10" maxlength="10"   onKeyPress="return soloNum(event)" onBlur="limpia()" > 
		<div id="error_nro_rec1"></div></td>
		 </tr> 
		 
		 <th align="left">Nro. Recibo Hasta :</th>
	    <td><input class="txt_campo" type="text" name="nro_rec2" id="nro_rec2" size="10" maxlength="10"  onKeyPress="return soloNum(event)" onBlur="limpia()"  > 
		<div id="error_nro_rec2"></div></td>
		 </tr>
        </table>
	<center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Entrega">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

  <br>

</center>

</form>
<br>
<table border="1" width="200" align="center" class="table_usuario">
	
	<tr>
	    <th align="center">Nro. Talon </th>
	    <th align="center">Responsable </th>  
	   	<th align="center">Fecha</th> 
		<th align="center">Nro. Recibo Desde</th>           
	    <th align="center">Nro. Recibo Hasta</th>
   </tr>	
	
	
	
	<?php
	 }
     
	 
	  $con_rec = "Select * From recibo_cntrl where REC_CTRL_USR_BAJA is null order by REC_CTRL_DESDE ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	   $fec_ent = cambiaf_a_normal($lin_res['REC_CTRL_FECHA']);
	  ?>
	     <tr>
		  <td align="left" ><?php echo $lin_res['REC_CTRL_NRO']; ?></td>
		  <td align="left" ><?php echo $lin_res['REC_CTRL_FUNC']; ?></td> 
		 <td align="left" ><?php echo $fec_ent; ?></td> 
	     <td align="right" ><?php echo $lin_res['REC_CTRL_DESDE']; //number_format($lin_res['REC_CTRL_DESDE'], 0, '.',','); ?></td>
		 <td align="right" ><?php echo $lin_res['REC_CTRL_HASTA'];//number_format($lin_res['REC_CTRL_HASTA'], 0, '.',','); ?></td>
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
    } 
$cuan_1 = 0;
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

  
      $consulta = "insert into recibo_cntrl ( REC_CTRL_NRO, 
	                                          REC_CTRL_AGEN, 
                                              REC_CTRL_FUNC,
									          REC_CTRL_ALFA,
									          REC_CTRL_DESDE,
					                          REC_CTRL_HASTA,
											  REC_CTRL_FECHA,
											  REC_CTRL_FEC_D,
											  REC_CTRL_FEC_H,
											  REC_CTRL_CAPO1,
											  REC_CTRL_USR_ALTA,
											  REC_CTRL_FCH_HR_ALTA,
											  REC_CTRL_USR_BAJA,
											  REC_CTRL_FCH_HR_BAJA											   
					                      ) values ($nro_tran,
										             32,
									                '$cod_ase',
												    '',
												   $nro_rec1,
												   $nro_rec2,
												 '$fec1',
												 '$fec1',
												 '$fec1',
												 null,
												 '$logi',
												 null,
												 null,
												 null
												  )";
$resultado = mysql_query($consulta);	

	header('Location: rec_imp_entr.php'); 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
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