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
	require('funciones2.php');
	include("header_2.php");
	//require_once('.cc7/lib7/libreriaCC7.php');
	//require('D:\xampp\htdocs\cc7\lib7\libreriaCC7.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
			//	include("header.php");
			?>
            

				<?php
					 //$fec = leer_param_gral();
					 //$fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					 $_SESSION['nfactura'] = 0;
                     $_SESSION['orden'] = 0;
                     $_SESSION['cc7m'] = "";
                     $_SESSION['fecha_h'] =  "";
					 
					 
					 
					 
					 
					 $apli = 10000;
if(isset($_SESSION['fec_proc'])){ 
   $fec = $_SESSION['fec_proc']; 
   $fec1 = cambiaf_a_mysql_2($fec);
 }
if ( $_SESSION['t_fac_fis'] == 2){					 
/*	if ($_POST['nombre'] <> ""){  
	    $nombre = $_POST['nombre'];
	    $nombre = strtoupper ($nombre);
	    $_SESSION['nombre'] = $nombre;
	}			 
	$nitci = $_POST['nitci'];
$_SESSION['nitci'] =  $nitci;

 if (ctype_digit($nitci)) {
       // echo "Son numeros";
    } else {
         $_SESSION['msg_error']= "El Nit/CI Solo debe tener números";
     $_SESSION['detalle'] = 1 ;
	    
		 //    require 'solic_consulta.php';
	     header('Location: reg_ingresos.php');
    }				 
//}					 
					 
$consulta  = "SELECT * FROM factura_cntrl  
              ORDER BY FAC_CTRL_AGEN 
			  DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
$orden = $linea['FAC_CTRL_ORDEN'];
$llave = trim($linea['FAC_CTRL_LLAVE']);//'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS';    //					
$cc7m = 0;
$fecha =  $fec1;
$fecha_h =  $linea['FAC_CTRL_FEC_H'];
$monto =  $_SESSION['monto_t'] * -1;
$nfactura = leer_nro_corre_fac($orden);					
//$cc7m = genCodContrl($orden, $nfactura, $nitci, $fecha, $monto, $llave);					 
$_SESSION['nfactura'] = $nfactura;
$_SESSION['orden'] = $orden;
$_SESSION['cc7m'] = $cc7m;
$_SESSION['fecha_h'] = cambiaf_a_normal($fecha_h);
//echo $cc7m."---".$fecha."=== ".$llave."fin".$nitci."cinit".$nfactura."nro_fac";					 */
					 
}					 
				 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <!--a href="reg_ingr_fac.php">Factura</a-->
	   <?php
       if(trim($_SESSION['egre_bs_sus']) == 1){?>
	    <a href='egre_retro.php?accion=7'>Salir</a>
	   <?php } elseif(trim($_SESSION['egre_bs_sus']) == 2){?>
	    <a href='egre_retro.php?accion=8'>Salir</a>
	   <?php }?> 

       <?php 
/*
       if(trim($_SESSION['moneda']) == 'Bolivianos'){?>
	    <a href='egre_retro.php?accion=7'>Salir</a>
	   <?php } elseif(trim($_SESSION['moneda']) == 'Dolares'){?>
	    <a href='egre_retro.php?accion=8'>Salir</a>
	   <?php } */?> 

	    <!--a href='egre_mante.php'>Salir</a-->
  </div>


<font size="+3">
<?php
echo encadenar(8)."Recibo de Ingreso".encadenar(42)."Recibo de Ingreso";
?>
<br>
<font size="+2">
<?php
echo encadenar(20).$_SESSION['des_mon'].encadenar(75).$_SESSION['des_mon'];
?>
</font>


<?php
		
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
				$emp_nit = $lin_emp['GRAL_EMP_NIT'];
				$emp_fon = $lin_emp['GRAL_EMP_DIRECTOR'];
				
				$_SESSION['emp_nom'] = $emp_nom;
				$_SESSION['emp_dir'] = $emp_dir;
				$_SESSION['emp_fon'] = $emp_fon;
				$_SESSION['emp_nit'] = $emp_nit;
				
		  }
$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
    $nro_tr_ingegr = leer_nro_co_ingegr(1);
	$_SESSION['nro_tran'] = $nro_tr_ingegr;		  
//echo "Recibo de Ingreso en ".encadenar(2).$_SESSION['des_mon'];
?>
<table border="0" width="900" class="table_usuario">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte Ingreso"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cmpte Ingreso"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th>     
			
    </tr>	
	
	</table>

 <?php
//if ($_SESSION['detalle'] == 3){
   $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   if(isset($_SESSION['c_agen'])){
      $c_agen = $_SESSION['c_agen'];
	  }else{
	  $c_agen = $_SESSION['COD_AGENCIA'];
    }
   $descrip = $_SESSION['descrip'];
   $importe = $_SESSION['monto_t'] * -1;
   
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $dec_ctag = leer_cta_des($cta_ctbg);
   $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 1;	
  // $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
  //$nro_tr_ingegr = leer_nro_co_ingegr(1);  
   $tipo = 1;
   if ($_SESSION['egre_bs_sus'] == 2){
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'] * -1;
	$mon= 2;
    }else{
	$imp_or = $_SESSION['monto_t'] * -1;		 
   	$impo_sus = $_SESSION['monto_t'] * -1;
	$mon= 1;
	} 
   if ($_SESSION['monto_t'] < 0){
       $_SESSION['monto_t'] = $_SESSION['monto_t'] * -1;
	   $imp_or = $_SESSION['monto_t'];
  } 
  
  //echo "****".$_SESSION['t_fac_fis']."****";
?>
<br> 
  <table border="0" width="900" class="table_Usuario">
   <?php if ($_SESSION['egre_bs_sus'] == 2){ ?>
  <tr>
       <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
	 </tr>
	<?php }?>
	
	<?php if ($_SESSION['egre_bs_sus'] == 1){ ?>
	    <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'], 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Monto ".encadenar(5); ?> </th>  
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'], 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		 
	<?php }?>
     </tr>
  <tr>
	 <th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
    	<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
	 </tr>
	  <tr>
	 <th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		  
		</tr>
         </table>
		

</center>
<?php
    if ($_SESSION['egre_bs_sus'] == 1){
	    $mon_des = f_literal($imp_or,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		}
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	 ?>		
<table border="0" width="900" class="table_Usuario"> 
    <tr>
	 	<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>
		<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
	 </tr> 
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr> 
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>  
		<th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	 	</table>
	
<table border="0" width="900">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>

 <?php
$tip_cta = substr($cta_ctb,0,3);
if ($tip_cta == '111'){	
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 0,
												 '$fec1',
												 '$log_usr',
												 1,
												 13,
												 $nro_tr_caj,
												 $nro_tr_ingegr,
												 0,
												 '$log_usr',
												 13000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         $impo_sus,
												 $mon,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
         } 
		 
//Primer registro ingreso		 
if ($imp_or < 0){
   $imp_or = $imp_or * -1;
   
 }
    $impo_sus = $imp_or / $tc_ctb;
	$consulta = "insert into caja_ing_egre(caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctb',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												  $imp_or,
												  $impo_sus,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: '); 		 
		 
		 
$_SESSION['fechr_proc'] = leer_fechr_pro_ie($nro_tr_ingegr);
//echo "AQUIIIII".$_SESSION['fechr_proc'];
$fech_proc=$_SESSION['fechr_proc'];
//$fech_proc1= cambiaf_a_normal($fech_proc);

$pieces = explode(" ", $fech_proc);
$fecha=cambiaf_a_normal($pieces[0]); // piece1
$hora=$pieces[1]; // piece2

 ?>
  <table border="0" width="900" class="table_Usuario">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo $_SESSION['MON_AGENCIA'].encadenar(1).$fecha.encadenar(1).$hora?></th>
		<th align="left"><?php echo encadenar(55); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo $_SESSION['MON_AGENCIA'].encadenar(1).$fecha.encadenar(1).$hora?></th>
   </tr>
</table>
<?php 	
	 
if ($imp_or < 0){
   $imp_or = $imp_or * -1;
   
 }
    $impo_sus = $imp_or / $tc_ctb;
	$consulta = "insert into caja_ing_egre(caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctb',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												  $imp_or,
												  $impo_sus,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  2: '); 
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 1){
  	
 $deb_hab = 2;	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  3: ') ; 
 }
}

if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 6){
     $imp_or =  $_SESSION['monto']-$_SESSION['monto_i'];
     $cta_ctbg = $_SESSION['cta_otra'];
      $impo_sus = $imp_or / $tc_ctb;
  
  $deb_hab = 2;	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  3: ') ; 
  
  
  // $tipo = $_SESSION['t_fac_fis'];
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   // echo "tip_6";
   $deb_hab = 1;
   $cta_otra = $_SESSION['cta_it'];
  // $tipo = $_SESSION['t_fac_fis'];
  // $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_it'];
  	$impo_sus =  $imp_or/$tc_ctb;
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_otra',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  4: ') ;  

 $cta_ctbg = $_SESSION['cta_it2'];
   $imp_or =  $_SESSION['monto_it'];
   $impo_sus =  $imp_or/$tc_ctb;
  	 $deb_hab = 2; 
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre  5: ') ; 
$cta_ctbg = $_SESSION['cta_iva2'];
$imp_or = $_SESSION['monto_i'];
$impo_sus =  $imp_or/$tc_ctb; 
$deb_hab = 2; 	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre 6: ') ; 


 
  }
}
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 3){
  // $tipo = $_SESSION['t_fac_fis'];
   $deb_hab = 1;
   $cta_ctbg = $_SESSION['cta_f13'];
   $imp_or = $_SESSION['monto_i'] ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  

  $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_p'] ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  
  }
}
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 4){;
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'] * -1;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  

  $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'] * -1 ;
  	 $deb_hab = 2; 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
  
 $cta_ctbg = $_SESSION['cta_it'];
   $imp_or = $_SESSION['monto_3'] * -1 ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  



  }
}	
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 5){;
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'] * -1;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  

  $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'] * -1 ;
  	 $deb_hab = 2; 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
  
 $cta_ctbg = $_SESSION['cta_it'];
   $imp_or = $_SESSION['monto_3'] * -1 ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  
  }
}		 	 

	
if ($_SESSION['t_fac_fis'] == 2){
   $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $importe = $_SESSION['monto_t'] * -1;
   
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $dec_ctag = leer_cta_des($cta_ctbg);
   $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 1;	
   //$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
  //$nro_tr_ingegr = leer_nro_co_ingegr(1);  
   $tipo = 1;
   if ($_SESSION['egre_bs_sus'] == 2){
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'] * -1;
	$mon= 2;
    }else{
	$imp_or = $_SESSION['monto_t'] * -1;		 
   	$impo_sus = $_SESSION['monto_t'] * -1;
	$mon= 1;
	} 
  $consulta = "insert into factura (FACTURA_AGEN, 
                                    FACTURA_APLI,
									FACTURA_NRO,
									FACTURA_TALON,
									FACTURA_ORDEN,
					                FACTURA_ALFA,
					                FACTURA_LLAVE,
   				                    FACTURA_NUMERICO,
					                FACTURA_ENLACE, 
									FACTURA_NOMBRE, 
									FACTURA_NIT, 
									FACTURA_MONTO,
                                    FACTURA_ESTADO,
                                    FACTURA_FECHA,
                                    FACTURA_FEC_H,
                                    FACTURA_COD_CTRL,
                                    FACTURA_USR_ALTA,
									FACTURA_FCH_HR_ALTA,
                                    FACTURA_USR_BAJA,
                                    FACTURA_FCH_HR_BAJA
                                    ) values (32,
									          13000,
											  $nro_tr_ingegr,
											  null,
											 '$orden',
												null,
												 '$llave',
												 $nfactura,
												  null,
												 '$nombre',
												 '$nitci',
												  $monto,
										          1,
												 '$fec1',
												 '$fecha_h',
												 '$cc7m',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
//Detalle contable de Factura
$it = $monto * 0.03;
$iva = $monto * 0.13;
//echo "fec_factura".$fec1;
 $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '45502101',
											  '1',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  null)";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204101',
											  '2',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '$cta_ctbg',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204102',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_tran (FAC_TRA_FACTURA, 
                                       FAC_TRA_MODULO,
									   FAC_TRA_DESCRI,
									   FAC_TRA_IMPO,
									   FAC_TRA_FECHA,
					                   FAC_TRA_ESTADO,
									   FAC_TRA_USR_ALTA,
					                   FAC_TRA_FCH_HR_ALTA,
									   FAC_TRA_USR_BAJA,
                                       FAC_TRA_FCH_HR_BAJA
                                    ) values ($nfactura,
											  13000,
											  '$descrip',
											 $monto,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);






if ($_SESSION['egre_bs_sus'] == 1){
	    $mon_des = f_literal($imp_or,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		}
$_SESSION['mon_des'] = $mon_des;
}




/*
?>
 <tr>
	 	<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(38); ?> </th>
		<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',','); ?></th> 
	 </tr> 
</table>	  
  
		

</center>
<?php
    if ($_SESSION['egre_bs_sus'] == 1){
	    $mon_des = f_literal($imp_or,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		}
$_SESSION['mon_des'] = $mon_des;
	 ?>		
<table border="0" width="900"> 
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(38); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	  <tr>
	    <th align="left" style="font-size:10px"><?php echo "Son:".encadenar(1).$mon_des.encadenar(3).
		                       "Bs."; ?> </th> 
		<th align="left"><?php echo encadenar(38); ?> </th>  
		<th align="left"  style="font-size:10px"><?php echo "Son:".encadenar(1).$mon_des.encadenar(3).
		                       "Bs."; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(38); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
     <tr>
	    <th align="left"><?php echo "Codigo de Control:".encadenar(3).$cc7m; ?> </th> 
		<th align="left"><?php echo encadenar(38); ?> </th>  
		 <th align="left"><?php echo "Codigo de Control:".encadenar(3).$cc7m; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(38); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 <tr>
	    <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$fecha_h; ?> </th> 
		<th align="left"><?php echo encadenar(38); ?> </th>  
		 <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$fecha_h; ?> </th>
   </tr>
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(38); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(38); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	  <tr>
	    <th align="center" style="font-size:10px"><?php echo "La reproduccion total o parcial y/o el uso no autorizado de
		 esta Nota Fiscal,"; ?> </th> 
		<th align="left"><?php echo encadenar(38); ?> </th>  
		 <th align="center" style="font-size:10px"><?php echo "La reproduccion total o parcial y/o el uso no autorizado de
		 esta Nota Fiscal,"; ?> </th> 
   </tr>
   <tr>
	    <th align="center" style="font-size:11px"><?php echo "constituye un delito a ser sancionado conforme a ley"; ?> </th> 
		<th align="left"><?php echo encadenar(38); ?> </th>  
		 <th align="center" style="font-size:11px"><?php echo "constituye un delito a ser sancionado conforme a ley"; ?> </th> 
   </tr>
	 	</table>
	

	
<?php
*/
//}	
//header('Location: egre_mante.php');	
?>

  <?php //} ?>
	 
</div>
  <?php
	//	 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>