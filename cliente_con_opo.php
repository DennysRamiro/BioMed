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
<body>	<?php
     include("header.php");
   ?>
<div id="pagina_sistema">
    <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
                  <li id="menu_modulo_creditos_modificar">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> S
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
 
    <h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">SIGUIENTE PASO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
        Puede Quitar Clientes
        </div>

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $nro_sol = $_SESSION['nro_sol'];
?> 

<center>
<strong>
   <?php  
     echo "Solicitud".encadenar(3).$nro_sol.encadenar(2).$_SESSION['d_pro'];   
 ?>
 </strong> 
<br>
<strong>Relacionado a Credito  </strong>
<?php if (isset($_SESSION['ncre'])){
echo encadenar(3).$_SESSION['ncre'];
      $ncre = $_SESSION['ncre']; 
	  }
	  ?>
<br>
<?php
if (isset($_SESSION["tot_err"])){ ?>
<font color="#FF0000">
<?php
echo "Debe elegir el Titular/Coordinador";

 ?>
 </font>
<?php
$_SESSION["continuar"]= 1;
}

$_SESSION['form_buffer'] = $_POST;
$consul = 0;
$com_d = "";
if(isset($_POST["cod"])){
   $cod_cli =$_POST["cod"];
}
if ($_SESSION["continuar"] == 2) {
   $imp_resta = 0;
   $com_resta = 0;
   $_SESSION['com_deu'] = 0;
   $_SESSION['imp_deu'] = 0;
    $_SESSION['imp_car'] = 0;
   $quecom = $_POST['cod_sol'];
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
   if (isset($quecom[$i])) {
      $nro_sol = $quecom[$i];
	  $_SESSION['nro_sol'] = $nro_sol;
      }
   }
}else{
  $nro_sol = $_SESSION['nro_sol'];
  if(isset($imp_resta)){
    $imp_resta = $imp_resta - $_SESSION['imp_deu'];
	$_SESSION['imp_resta'] = $imp_resta;
    }
  if(isset($com_resta)){
   $com_resta = $com_resta - $_SESSION['com_deu'];
    $_SESSION['com_resta'] = $com_resta;
   }
   
  
}   
   $con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
   $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
	  	 $_SESSION['cod_tipo'] = $t_op;
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $icomi = $lin_sol['CRED_SOL_IMP_COM'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $cod_g = $lin_sol['CRED_SOL_COD_GRUPO'];
		  $con_mon = "Select GRAL_PAR_INT_DESC  From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and                     GRAL_PAR_INT_COD = $mon ";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla mon')  ;
		  while ($lin_mon = mysql_fetch_array($res_mon)) {
		        $mon_d = $lin_mon['GRAL_PAR_INT_DESC'];
		  }
	 	 $con_com = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911                    and GRAL_PAR_PRO_COD = $comi ";
         $res_com = mysql_query($con_com)or die('No pudo seleccionarse tabla comi')  ;
		  while ($lin_com = mysql_fetch_array($res_com)) {
		        $com_d = $lin_com['GRAL_PAR_PRO_DESC'];
				$com_f = $lin_com['GRAL_PAR_PRO_CTA1'];
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
   <font color="#0000FF"
    <table align="center">
 <tr>
  <td><strong> Importe Solicitado </strong></td>
  <td align="right"> <?php $_SESSION["impo_sol"] = $impo;
	         if (isset($_SESSION['imp_deu'])){
	            $impo = $impo - $_SESSION['imp_deu'];
		        }
	         $impo = number_format($impo, 2, '.',','); 
             echo $impo,"   ";    ?></td>
   <td><strong> Comision </strong></td>
   <td align="right"><?php $_SESSION["impo_com"] = $icomi;
 	         if (isset($_SESSION['com_deu'])){
	             $icomi = $icomi - $_SESSION['com_deu'];
	         }
	         $icomi = number_format($icomi, 2, '.',','); 
             echo $icomi,"   ";  ?> </td>
			 
    <td><strong> Importe Cartera </strong></td>
    <td align="right"><?php if ($comif == 1){
                 $impo = $_SESSION["impo_sol"];
	             if (isset($_SESSION['imp_deu'])){
	                 $impo = $impo - $_SESSION['imp_deu'];
	                 }
	             $impo = number_format($impo, 2, '.',',');
	             echo $impo,"   "; 
	           }
	           if ($comif == 2){
                   $_SESSION["imp_car"] = $impo+$icomi;
	               $impo = ($impo+$icomi) - ($_SESSION['imp_deu'] + $_SESSION['com_deu']);
	               $impo_c = number_format($impo, 2, '.',',');
	               echo $impo_c,"   "; 
	            } ?></td>
</tr>
<tr>				
     <td><strong> Moneda </strong></td>
     <td><?php $_SESSION["mon_d"] = $mon_d;
               echo $mon_d,"   " ; ?>
     <td><strong> Fondo Garantia Inicio </strong></td>
     <td align="right"><?php  $_SESSION["aho_i"] = $ahoi;  
         echo $ahoi. "%   ";  ?> </td>
     <td><strong> Fondo Garantia Ciclo</strong></td>
     <td align="right"><?php $_SESSION["aho_d"] =  $ahod; 
          echo $ahod. " %  ";  ?></td>
</tr>		  
 </tr>
<tr>
    <td><strong> Tipo Operacion </strong></td>
    <td><?php $_SESSION["top_d"] = $top_d;
         echo $top_d,"   " ;  ?></td>
</tr>
 </font>
 </table>
 <br>
  <?php
 //echo "_____________________________________________________________________________";
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
  
  if (isset($_SESSION['oport'])) {
     if ($_SESSION['oport'] == 1){
   $con_deu  = "Select CART_DEU_RELACION,CART_DEU_ID, CLIENTE_COD,CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From
                cliente_general , cart_deudor where CART_DEU_NCRED = $ncre and CLIENTE_COD = CART_DEU_INTERNO and 
				CART_DEU_USR_BAJA is null and   CLIENTE_USR_BAJA is null order by CART_DEU_RELACION";
    $resu_deu = mysql_query($con_deu)or die('No pudo seleccionarse tabla clientes');
    while ($lin_deu = mysql_fetch_array($resu_deu)) {
	// echo $lin_deu['CLIENTE_COD'].encadenar(2).$lin_deu['CART_DEU_RELACION'].encadenar(2).
		//        $lin_deu['CLIENTE_AP_PATERNO'].encadenar(2).$lin_deu['CLIENTE_AP_MATERNO'].
	//			encadenar(2).$lin_deu['CLIENTE_NOMBRES'];
	       $rsol = $lin_deu['CART_DEU_RELACION'];
	       $ccli = $lin_deu['CLIENTE_COD'];
		   $c_i = $lin_deu['CART_DEU_ID'];
	
	       $con_grab  = "Insert into cred_deudor(CRED_SOL_CODIGO,
		                                         CRED_DEU_RELACION,
												 CRED_DEU_INTERNO,
												 CRED_DEU_ID,
												 CRED_DEU_IMPORTE,
												 CRED_DEU_COMISION,
												 CRED_DEU_AHO_INI,
												 CRED_DEU_AHO_DUR,
												 CRED_DEU_INT_CTA,
												 CRED_DEU_USR_ALTA,
												 CRED_DEU_FCH_HR_ALTA,
												 CRED_DEU_USR_BAJA,
												 CRED_DEU_FCH_HR_BAJA)
										  values ($nro_sol,
										          '$rsol',
												  $ccli,
												  '$c_i',
												  0,
												  0,
												  0,
												  0,
												  0,
												  '$logi',
												  null,null,
												  '0000-00-00 00:00:00')";
              $resu_grab = mysql_query($con_grab)or die('No pudo insertar cred_deudor : ' . mysql_error());
	 
   }
  $con_deu2  = "Select * From cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_USR_BAJA is null ";
$res_deu2 = mysql_query($con_deu2);
$cuantos2 = 0;
$cuantos = 0;
while ($nro_deu2 = mysql_fetch_array($res_deu2)) {
   $cuantos = $cuantos + 1 ;
}
if ($cuantos > 0) {
   $act_estado = "update cred_solicitud set CRED_SOL_ESTADO = 3 where CRED_SOL_CODIGO= $nro_sol and  CRED_SOL_USR_BAJA is null";
  $res_estado = mysql_query($act_estado)or die('No pudo actualizar estado : ' . mysql_error());
}
 } 
 }
  
   $consulta  = "Select CRED_DEU_RELACION, CLIENTE_COD,CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,
                 CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES From cliente_general , cred_deudor where 
				 CRED_SOL_CODIGO = $nro_sol and CLIENTE_COD = CRED_DEU_INTERNO and 
				 CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null order by CRED_DEU_RELACION";
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
		<?php echo $linea['CLIENTE_AP_ESPOSO']; ?>
		<?php echo $linea['CLIENTE_NOMBRES']; ?>
<?php
   }
 ?>
  </select><br><br>
  <input class="btn_form" type="submit" name="accion" value="Ingresa-Deudor">
  <input class="btn_form" type="submit" name="accion" value="Sale-Deudor">
  <input class="btn_form" type="submit" name="accion" value="Siguiente-Paso">
  <input class="btn_form" type="submit" name="accion" value="Salir">
  <?php
if(isset($_SESSION['cod_grupo'])){
   $cod_grupo = $_SESSION['cod_grupo'];
   }
$con_deu  = "Select * From cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_USR_BAJA is null ";
$res_deu = mysql_query($con_deu);
$cuantos = 0;
while ($nro_deu = mysql_fetch_array($res_deu)) {
   $cuantos = $cuantos + 1 ;
}
  //  echo $cuantos;
if ($t_op < 3) { 
if ($cuantos == 0) {
$con_grp  = "Select CRED_GRP_MES_REL, CRED_GRP_MES_CLI, CLIENTE_COD_ID From cliente_general, cred_grupo_mesa where CRED_GRP_MES_COD = $cod_grupo and CRED_GRP_MES_CLI = CLIENTE_COD  and CRED_GRP_MES_USR_BAJA is null and CLIENTE_USR_BAJA is null order by CRED_GRP_MES_REL";
$res_grp = mysql_query($con_grp);
while ($lin_grp = mysql_fetch_array($res_grp)) {
 $rels = $lin_grp['CRED_GRP_MES_REL'];
 $ccli = $lin_grp['CRED_GRP_MES_CLI'];
 $c_i  = $lin_grp['CLIENTE_COD_ID'];
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
//if ($cuantos > 0) {
//   $act_estado = "update cred_solicitud set CRED_SOL_ESTADO = 9 where CRED_SOL_CODIGO= $nro_sol and  CRED_SOL_USR_BAJA is null";
 // $res_estado = mysql_query($act_estado)or die('No pudo actualizar estado : ' . mysql_error());
//}
  $consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    ?>
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