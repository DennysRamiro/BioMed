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
<title>Simulacion Plan de Pagos</title>
<meta charset="UTF-8">
</head>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosInfoCred.js"></script> 

   <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
</head>
<body>	
	<?php
	   include("header.php");
 	 ?>
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CREDTOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_24x24.png" border="0" alt="Modulo" align="absmiddle"> SIMU. PLAN DE PAGOS
                    
                 </li>
              </ul>  

<div id="contenido_modulo">

                      <h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle"> SIMULADOR DE PLAN DE PAGOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
         Alta Solicitud Credito Normal
        </div>



<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$_SESSION['nro_sol'] = 0;
$_SESSION['cod_sol'] = 0;
//$produ = $_SESSION['producto'];
//$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $produ";
//$res_dpro = mysql_query($con_dpro)or die('No pudo seleccionarse tabla');
//while ($lin_dpro = mysql_fetch_array($res_dpro)) {
//      $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
//	  }
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD <> 0 ";
$res_top = mysql_query($con_top);
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
$res_mon = mysql_query($con_mon);
$con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD <> 0";
$res_fpa = mysql_query($con_fpa);
$con_pro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD <> 0 ";
$res_pro = mysql_query($con_pro);
$con_ofo  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 802 and GRAL_PAR_PRO_COD <> 0 ";
$res_ofo = mysql_query($con_ofo);
$con_zon  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 807 and GRAL_PAR_PRO_COD <> 0 ";
$res_zon = mysql_query($con_zon);
$con_com  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD <> 0 ";
$res_com = mysql_query($con_com);
$con_fco  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD <> 0 ";
$res_fco = mysql_query($con_fco);

$con_cai = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD <> 0";
$res_cai = mysql_query($con_cai);

$con_pai = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD <> 0";
$res_pai = mysql_query($con_pai);


if(isset($_SESSION['form_buffer'])){
	$datos = $_SESSION['form_buffer'];
}
 ?>
 <strong>
 <?php
 if(isset($_SESSION['msg_err'])){
 ?> 
 <font color="#FF0000"> 
  <?php
	 echo $_SESSION['msg_err'];
	 $_SESSION['msg_err'] = "";
 } 
 ?>
 <?php

 
 ?> 
 </font>
  </strong>
  
 <form name="form2" method="post" action="solic_retro_sol.php" onSubmit="return">
  <?php

 ?> 
 <table align="center">
   
	     <tr>   
             <td><strong>Forma de Pago </strong></td>
			 <td><?php echo encadenar(5);?></td>
             <td align="left"><select name="cod_fpa" size="1"  >
  	             <?php while ($linea = mysql_fetch_array($res_fpa)) {?>
                 <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
	             <?php echo $linea['GRAL_PAR_INT_DESC']; ?> </option>
	             <?php  }  ?> 
                 </select></td>
		 </tr> 
	     <tr>
            <td><strong>Calculo de Interes </strong></td>
			<td><?php echo encadenar(5);?></td>
            <td align="left"><select name="cod_cin" size="1"  >
  	            <?php while ($linea = mysql_fetch_array($res_cai)) {?>
                <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?> >
				<?php echo $linea['GRAL_PAR_INT_DESC']; ?> </option>
	            <?php  }  ?> 
                </select></td>
		</tr> 
		<tr>
		  <td><strong>Importe Solicitado  </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"><?php if(isset($datos['imp_sol'])){?>
              <input class="txt_campo" type="text" name="imp_sol" maxlength="12" size="12" value="<?=$datos['imp_sol'];?>" > 
              <?php }else{?>
  		      <input class="txt_campo" type="text" name="imp_sol" maxlength="12" size="12" value="" >
	          <?php }?></td>
		</tr>  
        <tr>
		  <td><strong>Int. Anual % </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"> <?php if(isset($datos['tas_int'])){?>
              <input class="txt_campo" type="text" name="tas_int" maxlength="8" size="8" value="<?=$datos['tas_int'];?>" > 
	          <?php }else{ ?>
	          <input class="txt_campo" type="text" name="tas_int" maxlength="8" size="8" value="" >
		      <?php } ?></td>
		</tr>   
	    <tr>
		  <td><strong>Plzo Meses</strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td align="rigth"> <?php if(isset($datos['plz_mes'])){?>
              <input class="txt_campo" type="text" name="plz_mes" maxlength="12" size="12" value="<?=$datos['plz_mes'];?>" > 
	          <?php }else{ ?>
              <input class="txt_campo" type="text" name="plz_mes" maxlength="12" size="12" value="" > 
		      <?php }?></td>
		</tr>   
	    <tr>
		  <td><strong>Nro. Cuotas </strong></td>
		  <td><?php echo encadenar(5);?></td>
          <td><?php if(isset($datos['nro_cta'])){?>
              <input class="txt_campo"  type="text" name="nro_cta" maxlength="5" size="5" value="<?=$datos['nro_cta'];?>" >
		      <?php }else{ ?>
		      <input class="txt_campo"  type="text" name="nro_cta" maxlength="5" size="5" value="" >
		      <?php }?></td>
		</tr>
		<tr>
           <td><strong>Fondo Garantia Ciclo %  </strong></td>
		   <td><?php echo encadenar(5);?></td>
           <td><?php if(isset($datos['aho_dur'])){?>
               <input class="txt_campo"  type="text" name="aho_dur" maxlength="8" size="8" value="<?=$datos['aho_dur'];?>" > 
		       <?php }else{ ?>
		       <input class="txt_campo"  type="text" name="aho_dur" maxlength="8" size="8" value="" >
		       <?php }?></td>
		</tr>
		<tr>
           <td><strong>Fecha Desembolso (dd-mm-aaaa) </strong></td>
		   <td><?php echo encadenar(5);?></td>
		   <td><input class="txt_campo" type="text" id="datepicker" name="fec_des" maxlength="12"  size="12" > 
       </td>
		</tr>
		<tr>	   
	        <td><strong>Fecha Primer Pago (dd-mm-aaaa) </strong></td>
			<td><?php echo encadenar(5);?></td>
            <td><input class="txt_campo" type="text" id="datepicker2" name="fec_uno" maxlength="12"  size="12" > 
              </td>
		</tr>
	
	</table>
  <br><br>
	<center>
	 <?php

 ?> 
	
    <input class="btn_form" type="submit" name="accion" value="Simular">
    <input class="btn_form" type="submit" name="accion" value="Salir">
</form>


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