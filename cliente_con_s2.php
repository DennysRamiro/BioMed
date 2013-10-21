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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
          
<script language="javascript" src="script/validarForm.js"></script> 

</head>
<body>	
<div id="cuerpoModulo">

 <?php
	   include("header.php");
 	 ?>
<div id="UserData">
     <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />		


<?php
 $fec = leer_param_gral();
 
 $logi = $_SESSION['login']; 
 if(isset( $_SESSION['nro_sol'])){
    $nro_sol = $_SESSION['nro_sol'];
 }
?> 
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	
     <strong>Clientes Asignados </strong>
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<center>
<?php
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
if(isset($_POST["cod"])){
   $cod_cli =$_POST["cod"];
}
//if ($_SESSION["continuar"] == 2) {
if(isset($_POST['cod_sol'])){
   $quecom = $_POST['cod_sol'];
  }
 if(isset($quecom)){ 
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
   if (isset($quecom[$i])) {
      $nro_sol = $quecom[$i];
	  $_SESSION['nro_sol'] = $nro_sol;
      }
   }
 }  
   $con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
   $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
	  	 $_SESSION['cod_tipo'] = $t_op;
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $cod_g = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $_SESSION['cod_grupo'] = $cod_g;
		  $con_mon = "Select GRAL_PAR_INT_DESC  From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and                     GRAL_PAR_INT_COD = $mon ";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla mon')  ;
		  while ($lin_mon = mysql_fetch_array($res_mon)) {
		        $mon_d = $lin_mon['GRAL_PAR_INT_DESC'];
		  }
	 	 $con_com = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 913                    and GRAL_PAR_PRO_COD = $comi ";
         $res_com = mysql_query($con_com)or die('No pudo seleccionarse tabla comi')  ;
		  while ($lin_com = mysql_fetch_array($res_com)) {
		        $com_d = $lin_com['GRAL_PAR_PRO_DESC'];
				$com_f = $lin_com['GRAL_PAR_PRO_CTA1'];
		  }
		  $con_comf = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911                    and GRAL_PAR_PRO_COD = $comif ";
         $res_comf = mysql_query($con_comf)or die('No pudo seleccionarse tabla comif')  ;
		  while ($lin_comf = mysql_fetch_array($res_comf)) {
		        $comf_d = $lin_comf['GRAL_PAR_PRO_DESC'];
				}
		  
		  $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla ahod')  ;
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  }
		  
		 $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_op";
         $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla top')  ;
		  while ($lin_top = mysql_fetch_array($res_top)) {
		        $top_d = $lin_top['GRAL_PAR_INT_DESC'];
			}
   }
 ?>  
   
 <table align="center" border="1">
	<tr>
	   <td><strong> Solicitud </strong></td>
       <td><?php echo $nro_sol; ?></td>
       <td><strong> Importe Solicitado </strong></td>
       <td><?php $_SESSION["impo_sol"] = $impo;
	        $impo = number_format($impo, 2, '.',','); 
            echo $impo;  ?> </td>
	   <td><strong> Moneda </strong></td>
       <td><?php $_SESSION["mon_d"] = $mon_d;
            echo $mon_d;?></td>
    </tr>
	<tr>			
       <td><strong> Comision </strong></td>
       <td><?php echo $com_d;  ?></td>
       <td><strong> Calculo Comision </strong></td>
       <td><?php  echo  $comf_d ;?></td>
	</tr>   
  <br>
   <tr>			
       <td><strong> Fondo Garantia Inicio </strong></td>
       <td><?php $_SESSION["aho_i"] = $ahoi;  
                 echo $ahoi. "%   "; ?></td>
       <td><strong> Fondo Garantia Ciclo </strong></td>
       <td><?php  $_SESSION["aho_d"] =  $ahod; 
           echo $ahod. " %  ";  ?></td>
 <br>
 <strong> Tipo Operacion </strong>
   <?php
     $_SESSION["top_d"] = $top_d;
     echo $top_d,"   " ;   
 ?>
 </tr>
 </table>
 <br>
  <?php
 
 echo "_____________________________________________________________________________";
  ?>
 <br>
  <?php
  
 $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = '$cod_g' and CRED_GRP_USR_BAJA is null";
$res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla 1')  ;


while ($lin_grp = mysql_fetch_array($res_grp)){
     ?>
    <strong> Codigo Grupo </strong>      
     <?php
	 echo $cod_g. "    ";
	 ?>
    <strong> Nombre del Grupo </strong> 
	<?php
	 echo $lin_grp['CRED_GRP_NOMBRE']. "    ";
	     
}
 ?>
 
 
 </FONT>
<br>
   
  <?php 
   $consulta  = "Select CRED_DEU_RELACION, CLIENTE_COD,CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general , cred_deudor where CRED_SOL_CODIGO = $nro_sol and CLIENTE_COD = CRED_DEU_INTERNO and CRED_DEU_USR_BAJA is null and   CLIENTE_USR_BAJA is null order by CRED_DEU_RELACION";
    $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla clientes');
?> 

<form name="form2" method="post" action="incorp_cli_sol.php" >
<select name="cod_cliente[]" size="8" multiple>

  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CLIENTE_COD']; ?>>
	    <?php echo $linea['CRED_DEU_RELACION']; ?>
		<?php echo $linea['CLIENTE_AP_PATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_MATERNO']; ?>
		<?php echo $linea['CLIENTE_NOMBRES']; ?>
		
 <?php
   }
 ?>
  </select><br><br>
  <input type="submit" name="accion" value="Agregar-Clientes">
  <input type="submit" name="accion" value="Quitar-Cliente">
  <input type="submit" name="accion" value="Siguiente-Paso">
  <input type="submit" name="accion" value="Salir">
  <?php
 $cod_grupo = 0;
if(isset($_SESSION['cod_grupo'])){  
   $cod_grupo = $_SESSION['cod_grupo'];
}
$con_deu  = "Select * From cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_USR_BAJA is null ";
$res_deu = mysql_query($con_deu);
$cuantos = 0;
while ($nro_deu = mysql_fetch_array($res_deu)) {
   $cuantos = $cuantos + 1 ;
}
   
if ($t_op < 3) { 
if ($cuantos == 0) {
$con_grp  = "Select CRED_GRP_MES_REL, CRED_GRP_MES_CLI, CLIENTE_COD_ID From cliente_general, cred_grupo_mesa where CRED_GRP_MES_COD = $cod_grupo and CRED_GRP_MES_CLI = CLIENTE_COD  and CRED_GRP_MES_USR_BAJA is null and CLIENTE_USR_BAJA is null order by CRED_GRP_MES_REL";
$res_grp = mysql_query($con_grp);
 echo $cod_grupo, " cod grupo";
while ($lin_grp = mysql_fetch_array($res_grp)) {
 $rels = $lin_grp['CRED_GRP_MES_REL'];
 $ccli = $lin_grp['CRED_GRP_MES_CLI'];
 $c_i  = $lin_grp['CLIENTE_COD_ID'];
 echo $ccli;
 if ($rels == 1) {
    $rsol = "C";
	}
	else {
	$rsol = "D";
	}
	
	$consulta  = "Insert into cred_deudor(CRED_SOL_CODIGO, CRED_DEU_RELACION, CRED_DEU_INTERNO, CRED_DEU_ID, CRED_DEU_USR_ALTA, CRED_DEU_FCH_HR_ALTA, CRED_DEU_USR_BAJA, CRED_DEU_FCH_HR_BAJA) values 
($nro_sol,'$rsol',$ccli,'$c_i','$logi',null,null,'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error()); 
	
}
}
}

$con_deu2  = "Select * From cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_USR_BAJA is null ";
$res_deu2 = mysql_query($con_deu2);
$cuantos2 = 0;
while ($nro_deu2 = mysql_fetch_array($res_deu2)) {
   $cuantos = $cuantos + 1 ;

}
if ($cuantos > 0) {
   $act_estado = "update cred_solicitud set CRED_SOL_ESTADO = 3 where CRED_SOL_CODIGO= $nro_sol and  CRED_SOL_USR_BAJA is null";
  $res_estado = mysql_query($act_estado)or die('No pudo actualizar estado : ' . mysql_error());
}
  $consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    ?>
  </form>
   <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Clientes de la Solicitud</MARQUEE></FONT></B>
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
