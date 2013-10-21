<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
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
			
	include("header_3.php");
			?>
            

				<?php
					 
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					 $_SESSION['des_mon']="Bolivianos";
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cjach_selec_3.php'>Salir</a>
  </div>
          <br>

<?php if (isset($_SESSION['tipo'])){
		if ((trim($_SESSION['tipo'])=="Deposito") && ($_SESSION['des_mon']=="Bolivianos")) { ?>
			 <a href='egre_retro.php?accion=10'>Salir</a>
	<?php 	}elseif ((trim($_SESSION['tipo'])=="Deposito") && ($_SESSION['des_mon']=="Dolares")) { ?>
			 <a href='egre_retro.php?accion=11'>Salir</a>
	<?php 	}elseif ((trim($_SESSION['tipo'])=="Retiro") && ($_SESSION['des_mon']=="Bolivianos")) { ?>
			 <a href='egre_retro.php?accion=12'>Salir</a>
	<?php 	}elseif ((trim($_SESSION['tipo'])=="Retiro") && ($_SESSION['des_mon']=="Dolares")) { ?>
			 <a href='egre_retro.php?accion=13'>Salir</a>
	<?php 	}else{}
	      }else{  ?>
            
		<?php 	} ?>	 
	    <!--a href='cja_bancos.php'>Salir</a-->
  </div>
          <br>
<center>
<font  size="+2">

<?php
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
		  
$nro_fact = 0;
$fec_fac = '0000-00-00';
$descrip = strtoupper ($_SESSION['descrip']);
$tipo = $_SESSION['b_dep_ret'];
 $mon = $_SESSION['bco_bs_sus'];
 $cta_bco = $_SESSION['cta_bco'];
$cta_otra = $_SESSION['cta_otra'];
$cta_banco = $_SESSION['cta_banco'];
$des_otra = $_SESSION['des_otra'];
$des_banco = $_SESSION['des_banco'];
$impo_bs1 = $_SESSION['impo_bs1'];
$impo_eqv1 = $_SESSION['impo_eqv1'];
$impo_bs2 = $_SESSION['impo_bs2'];
$impo_eqv2 = $_SESSION['impo_eqv2'];		
$tc_ctb = $_SESSION['TC_CONTAB'];
$cod_bco = $_SESSION['cod_bco'];
$tip_cta = substr($cta_otra,0,3);
$mon_otra = leer_cta_mon($cta_otra);
//$descrip = strtoupper ($_SESSION['hace_transac']);
$nro_tr_bco = leer_nro_tr_banco($tipo);	
$cta_ctble = leer_cta_des($cta_banco);	  
$nro_cjch = $_SESSION['nro_cjch'];

//echo "Fatura";
//} 
//echo "Tipo ".encadenar(1).$_SESSION['b_dep_ret'];
?>
</center>
<strong>

<font size="+2"> 
<?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(3)."Recibo de". encadenar(1).$_SESSION['des_tran'].encadenar(40).
"Recibo de". encadenar(1).$_SESSION['des_tran'];
?>
<br>
</strong>

<?php
//echo encadenar(10).$_SESSION['des_mon'].encadenar(60).$_SESSION['des_mon'];
?>

</font>
<table border="0" width="1000">
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
	    <td align="left" style="font-size:12px"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte. Banco"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_bco; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left" style="font-size:12px"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cmpte Banco"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_bco; ?></th>     
			
    </tr>	
	
	</table>



 <?php
//if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['COD_AGENCIA'];
   $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
   
  ?>
    <strong>
 <?php // echo $_SESSION['des_tran'].encadenar(2)."a cta.".encadenar(2).
 // $_SESSION['cta_bco'].encadenar(2).$_SESSION['nom_cta']; ?>
  
	
<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th> 
		<th align="left"><?php echo encadenar(3); ?></th>  
	   	
		<th align="center"><?php echo encadenar(35); ?></th>
		 <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th>        
		<th align="left"><?php echo encadenar(3); ?></th>  
		 
			
    </tr>	
</table>

 <br>
<table border="0" width="900">
 <tr>
	 <th align="left"><?php echo $_SESSION['des_tran']; ?> </th> 
		<th align="left"><?php echo "a cta."; ?></th>
		<td align="left"><?php echo $_SESSION['cta_bco']; ?></th> 
		<th align="left"><?php echo encadenar(40); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran']; ?> </th> 
		<th align="left"><?php echo "a cta."; ?></th>
		<td align="left"><?php echo $_SESSION['cta_bco']; ?></th> 
	</tr>
</table>

<table border="0" width="900">		
<tr>
	 <th align="left" style="font-size:11px"><?php echo $_SESSION['nom_cta']; ?> </th> 
	
	 <th align="left"><?php echo encadenar(60); ?> </th>
	 <th align="left" style="font-size:11px"><?php echo $_SESSION['nom_cta']; ?> </th> 
	
</tr>
<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(40); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		
</tr>
</table>
<table border="0" width="900">
 <tr>
	 <th align="left"><?php echo "Cta. Ctble".encadenar(1); ?> </th> 
		<th align="left"><?php echo $_SESSION['cta_otra'].encadenar(1); ?></th>
		<td align="left"><?php echo $_SESSION['des_otra']; ?></th> 
		<th align="left"><?php echo encadenar(65); ?> </th>
		<th align="left"><?php echo "Cta. Ctable".encadenar(1); ?> </th> 
		<th align="left"><?php echo $_SESSION['cta_otra'].encadenar(1); ?></th>
		<td align="left"><?php echo $_SESSION['des_otra']; ?></th> 
	</tr>
</table>
<table border="0" width="900">			 
		 <?php if ($_SESSION['bco_bs_sus'] == 2){  
		         $mon_des = f_literal(1,$_SESSION['impo_eqv1']).encadenar(2)."Dol";
				 
				 
				 ?> 
		
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo  number_format($_SESSION['impo_eqv1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(43); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo  number_format($_SESSION['impo_eqv1'], 2, '.',',').encadenar(2); ?></th>
		</tr>	 
		<?php } ?> 
		 <?php if ($_SESSION['bco_bs_sus'] ==1){ 
		 $mon_des = f_literal(1,$_SESSION['impo_bs1']).encadenar(2)."Bs."; ?> 
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(43); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',',').encadenar(2); ?></th>
		</tr>	 
		<?php } ?> 
		</tr>
		
	</table>
<table border="0" width="900">	
	<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>	 
		<tr>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>
		<tr>
		<th align="left"><?php echo $_SESSION['des_tran']
		                       .encadenar(2)."por".encadenar(2).strtoupper($_SESSION['descrip']); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(40); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran']
		                      .encadenar(2)."por".encadenar(2).strtoupper($_SESSION['descrip']); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
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
</center>
 
 <?php
}
if ($_SESSION['EMPRESA_TIPO'] == 1){
echo encadenar(5)."Recibo de". encadenar(1).$_SESSION['des_tran'].encadenar(1)."Bancos";
?>
<br>
</strong>

<?php
//echo encadenar(10).$_SESSION['des_mon'].encadenar(60).$_SESSION['des_mon'];
?>
</font>
<table border="0" width="500">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(30); ?></th>
		
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte. Banco"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_bco; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		
			
    </tr>	
	
	</table>



 <?php
//if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['COD_AGENCIA'];
   $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
  ?>
    <strong>
 <?php // echo $_SESSION['des_tran'].encadenar(2)."a cta.".encadenar(2).
 // $_SESSION['cta_bco'].encadenar(2).$_SESSION['nom_cta']; ?>
  
	
<table border="0" width="500">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th> 
		<th align="left"><?php echo encadenar(3); ?></th>  
	   	
		<th align="center"><?php echo encadenar(25); ?></th>
		
		 
			
    </tr>	
</table>

 <br>
<table border="0" width="500">
 <tr>
	 <th align="left"><?php echo $_SESSION['des_tran']; ?> </th> 
		<th align="left"><?php echo "a cta."; ?></th>
		<td align="left"><?php echo $_SESSION['cta_bco']; ?></th> 
		<th align="left"><?php echo encadenar(30); ?> </th>
		
	</tr>
</table>

<table border="0" width="500">		
<tr>
	 <th align="left" style="font-size:11px"><?php echo $_SESSION['nom_cta']; ?> </th> 
	
	 <th align="left"><?php echo encadenar(20); ?> </th>
	 
	
</tr>
<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(20); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		
</tr>
</table>
<table border="0" width="500">
 <tr>
	 <th align="left"><?php echo "Cta. Ctble".encadenar(1); ?> </th> 
		<th align="left"><?php echo $_SESSION['cta_banco'].encadenar(1); ?></th>
		<td align="left"><?php echo $cta_ctble; ?></th> 
		<th align="left"><?php echo encadenar(45); ?> </th>
	</tr>
</table>
<table border="0" width="500">			 
		 <?php if ($_SESSION['bco_bs_sus'] == 2){  
		         $mon_des = f_literal(1,$_SESSION['impo_eqv1']).encadenar(2)."Dol";
				 
				 
				 ?> 
		
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo  number_format($_SESSION['impo_eqv1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
		
		</tr>	 
		<?php } ?> 
		 <?php if ($_SESSION['bco_bs_sus'] ==1){ 
		 $mon_des = f_literal(1,$_SESSION['impo_bs1']).encadenar(2)."Bs."; ?> 
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
			 
		<?php } ?> 
		</tr>
		
	</table>
<table border="0" width="500">	
	<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>	 
		<tr>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>
		<tr>
		<th align="left"><?php echo $_SESSION['des_tran']
		                       .encadenar(2)."por".encadenar(2).strtoupper($_SESSION['descrip']); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>
		
		</tr>	 	 			
</table>		
<table border="0" width="500">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
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
		<th align="left"><?php echo encadenar(20); ?></th>
		
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
		
	 </tr>

  </table>
</center>
 
 <?php
}
if ($tipo == 1){
$desc = "Deposito";
   $deb_hab1 = 1;
   $deb_hab2 = 2;
  }
if ($tipo == 2){
   $desc = "Retiro";
   $deb_hab1 = 2;
   $deb_hab2 = 1;
   }
if ($tip_cta == '111'){
$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
											 					 		 
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
												 $tipo,
												 15,
												 $nro_tr_caj,
												 $nro_tr_bco,
												 0,
												 '$log_usr',
												 15000,
												 null,
												 null,
 											     null,
												 null,
												 '$cta_otra',
												 $impo_bs2,
										         $impo_eqv2,
												 $mon,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
//Correlativo de compra venta
}

$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);	
 ?>
 <br><br>
  <table border="0" width="500">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>  
		 
   </tr>
</table>
<?php
//echo $fec_fac. "fec_fac". $nro_fac. "nro_fact";
if ($impo_bs1 < 0){
    $impo_bs1 = $impo_bs1 * -1;
    $impo_eqv1 = $impo_eqv1 * -1;
}

$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN, 
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_banco',
												 '$cta_bco',
												 $deb_hab1,
												 $nro_tr_bco,
												 $mon,
												 $impo_bs1,
												 $impo_eqv1,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
	//$resultado = mysql_query($consulta)or die('No pudo insertar caja_deposito  1: ' . mysql_error()); 																				  
$resultado = mysql_query($consulta)or die('No pudo insertar caja_deposito xx: ' . mysql_error()); 


//if(isset($_SESSION['t_fac_fis'])){
  // $tipo2 = $_SESSION['t_fac_fis'];
  //if ($_SESSION['t_fac_fis'] == 1){

if ($impo_bs2 < 0){
    $impo_bs2 = $impo_bs2 * -1;
    $impo_eqv2 = $impo_eqv2 * -1;
}
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_otra',
												 '$cta_bco',
												 $deb_hab2,
												 $nro_tr_bco,
												 $mon,
												 $impo_bs2,
												 $impo_eqv2,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_deposito yy: ' . mysql_error()); 

//Actualiza estado de caja chica tabla control 
//echo $nro_cjch."---";
$nro_asig_c =  leer_nro_asi_cjach($nro_cjch );
$consulta  = "update cjach_cntrl set CJCH_CTRL_ESTADO = 1, CJCH_CTRL_NRO_ASIG =  $nro_asig_c,
              CJCH_CTRL_SALDO = CJCH_CTRL_SALDO+$impo_bs2
                where CJCH_CTRL_NRO = $nro_cjch 
              and CJCH_CTRL_ESTADO = 2 and CJCH_CTRL_USR_BAJA is null";

$resultado = mysql_query($consulta)or die('No pudo actualizar : cjach_cntrl ' . mysql_error());
//Actualiza estado de asignacion tabla asiganacion caja chica
//echo $nro_cjch.$fec1;
$consulta  = "update cjach_asignacion set CJCH_ASIN_ESTADO = 2, CJCH_ASIN_ASIG = $impo_bs2,  CJCH_ASIN_FEC_A = '$fec1'
              where CJCH_ASIN_CAJA = $nro_cjch 
              and CJCH_ASIN_ESTADO = 1 and CJCH_ASIN_USR_BAJA is null";

$resultado = mysql_query($consulta)or die('No pudo actualizar : cjach_cntrl ' . mysql_error());





//Inserta Caja Chica Transac
$deb_hab = 1;
$nro_tr_ingegr = leer_nro_co_cjach(1); 	 
$consulta = "insert into cjach_transac(CJCH_TRAN_NRO_CJA,
	                                    CJCH_TRAN_NRO_COR, 
	                                   CJCH_TRAN_FUNC,
                                       CJCH_TRAN_COD_PROY,
									   CJCH_TRAN_FECHA,
									   CJCH_TRAN_COD_AGEN,
									   CJCH_TRAN_TIPO_OPE,
									   CJCH_TRAN_NRO_ASIG,
					                   CJCH_TRAN_NRO_ALM,
					                   CJCH_TRAN_NRO_VEN,
   				                       CJCH_TRAN_VIA_PAG, 
									   CJCH_TRAN_REL_FAC, 
									   CJCH_TRAN_DEB_CRED,
									   CJCH_TRAN_CTA_CONT,
									   CJCH_TRAN_IMPORTE,
                                       CJCH_TRAN_IMP_EQUIV,
                                       CJCH_TRAN_MON,
									   CJCH_TRAN_TIP_CAMB,
									   CJCH_TRAN_DESCRIP,
									   CJCH_TRAN_USR_ALTA,
									   CJCH_TRAN_FCH_HR_ALTA,
									   CJCH_TRAN_USR_BAJA,
                                       CJCH_TRAN_FCH_HR_BAJA
                                       ) values ($nro_cjch,
									             $nro_tr_ingegr,
									             null,
									             0,
									             '$fec1',
												 $c_agen,
												 1,
												 $nro_asig_c,
												 0,
												 0,
												 0,
												 0,
												 $deb_hab,
												 '$cta_otra',
												 $impo_bs1,
												 $impo_eqv1,
												 1,
												 $tc_ctb,
												 '$descrip',
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_ing_egre xx: ' . mysql_error()); 





/*
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 4){
  //echo "tip_4";
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
  // $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'] * -1;
  	$impo_sus =  $imp_or/$tc_ctb;
	$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_otra',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
 $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'] * -1 ;
   $impo_sus =  $imp_or/$tc_ctb;
  	 $deb_hab = 2; 
	 $consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_ctbg',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
 $cta_ctbg = $_SESSION['cta_it'];
   $imp_or = $_SESSION['monto_3'] * -1 ;
  	 $impo_sus =  $imp_or/$tc_ctb; 
	 $consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_ctbg',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
  }
}
//Grabar resto Bienes

if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 5){;
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   // echo "tip_5";
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
  // $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'];
  	$impo_sus =  $imp_or/$tc_ctb;
	$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_otra',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
 $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'];
   $impo_sus =  $imp_or/$tc_ctb;
  	 $deb_hab = 2; 
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_ctbg',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
$cta_ctbg = $_SESSION['cta_it'];
   $imp_or = $_SESSION['monto_3'];
  	 $impo_sus =  $imp_or/$tc_ctb; 	 
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_ctbg',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
	

  }
}	
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 2){
    // $tipo = $_SESSION['t_fac_fis'];
   $deb_hab = 1;
   $cta_ctbg = $_SESSION['cta_f13'];
   $imp_or = $_SESSION['monto_i'];
   if ($imp_or < 0){
      $imp_or = $imp_or * -1;
   }
   $impo_sus =  $imp_or/$tc_ctb; 
	$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_ctbg',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
$cta_numero = explode(" ", $_SESSION['cue_egr']);
		$cta_ctbg = $cta_numero[0];
 if(isset($_SESSION['myradio'])){
 
	 if($_SESSION['myradio'] == "cre_fac"){ 
	 $nro_fac = $_SESSION['nro_fact'];	
   $imp_or = $_SESSION['monto'] + $_SESSION['monto_i'];
   } else {
   
    $imp_or = $_SESSION['monto_e'];
   } }
  	$impo_sus =  $imp_or/$tc_ctb; 
  	 $deb_hab = 1; 
	 $consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN,
									   CAJA_DEP_FEC_FAC,
									   CAJA_DEP_NRO_FAC,
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_ctbg',
												 '$cta_bco',
												 $deb_hab,
												 $nro_tr_bco,
												 $mon,
												 $imp_or,
												 $impo_sus,
												 '$fec1',
												 '$descrip',
												 '$fec_fac',
												 $nro_fact,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 







	}
}
	*/

	?>
	
<?php

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
ob_end_flush();
 ?>