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
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cja_bancos.php'>Salir</a>
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
$nro_doc = 0;
//echo "LLega " .	$_SESSION['cta_otra'];  

$descrip = strtoupper ($_SESSION['descrip']);
if ($_SESSION['t_fac_fis'] == 2){


 $cta_unica = explode(" ", $_SESSION['cta_otra']);
        $_SESSION['cta_otra'] = $cta_unica[0];
		$cta_cuen =  $_SESSION['cta_otra'];
        $_SESSION['cta_ctbg'] = $_SESSION['cta_otra'];
		$_SESSION['des_otra'] = leer_cta_des($cta_cuen);
 $mon = $_SESSION['bco_bs_sus'];
$tipo = $_SESSION['b_dep_ret'];
 $mon = $_SESSION['bco_bs_sus'];
 $cta_bco = $_SESSION['cta_bco'];
$cta_otra = $_SESSION['cta_otra'];
$cta_banco = $_SESSION['cta_banco'];
$des_otra = $_SESSION['des_otra'];
$des_banco = $_SESSION['des_banco'];
$impo_bs1 = $_SESSION['impo_bs1'];
$impo_eqv1 = $_SESSION['impo_bs1']/$_SESSION['TC_CONTAB'];
$impo_bs2 = $_SESSION['impo_bs2'];
$impo_eqv2 = $_SESSION['impo_eqv2'];		
$tc_ctb = $_SESSION['TC_CONTAB'];
$cod_bco = $_SESSION['cod_bco'];
if (isset($_SESSION['nro_doc'])){
     $nro_doc = $_SESSION['nro_doc'];
}
$tip_cta = substr($cta_otra,0,3);
$mon_otra = leer_cta_mon($cta_otra);
$descrip = strtoupper ($_SESSION['descrip']);
$nro_tr_bco = leer_nro_tr_banco($tipo);	
$cta_ctble = leer_cta_des($cta_banco);	
 
//datos factura


  
}else{
//echo "Aqquiiii deposito";
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
$nro_doc = $_SESSION['deposito'];
$cod_bco = $_SESSION['cod_bco'];
$tip_cta = substr($cta_otra,0,3);
$mon_otra = leer_cta_mon($cta_otra);
//$descrip = strtoupper ($_SESSION['hace_transac']);
$nro_tr_bco = leer_nro_tr_banco($tipo);	
$cta_ctble = leer_cta_des($cta_banco);	  


//echo "Fatura";
} 
//echo "Recibo de ".encadenar(1).;
?>
</center>
<strong>
<font size="+2"> 
<?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(5)."Recibo de". encadenar(1).$_SESSION['des_tran'].encadenar(1)."Bancos".encadenar(55).
"Recibo de". encadenar(1).$_SESSION['des_tran'].encadenar(1)."Bancos";
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
 <?php if ($_SESSION['des_tran']=='Retiro') { ?>
	 <tr>
	 <th align="left"><?php echo "Cheque Nro."; ?> </th> 
		<th align="left"><?php echo " "; ?></th>
		<td align="left"><?php echo $_SESSION['cheque']; ?></th> 
		<th align="left"><?php echo encadenar(40); ?> </th>
		<th align="left"><?php echo "Cheque Nro."; ?> </th> 
		<th align="left"><?php echo " "; ?></th>
		<td align="left"><?php echo $_SESSION['cheque']; ?></th> 
	</tr> 
	 
	 <?php } ?>	
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
		<th align="left"><?php echo "Cta. Ctble".encadenar(1); ?> </th> 
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

 
//echo $tipo. " "."tipo".$mon. " "."mon".$impo_bs1." * ".$impo_eqv1." * ". 
//$impo_bs2." * ".$impo_eqv2." * "; 
if ($tipo == 1){
$desc = "Deposito";
   $deb_hab1 = 1;
   $deb_hab2 = 2;
   /* if ($mon == 1){
        $impo_eqv1 = $impo_bs1;
		$impo_bs2 = $impo_bs2 * -1;
		$impo_eqv2 = $impo_bs2;	
	}else{
	    $impo_bs2 = $impo_bs2 * -1;
		$impo_eqv2 = $impo_eqv2 * -1;	
	}*/
}
if ($tipo == 2){
   $desc = "Retiro";
   $deb_hab1 = 2;
   $deb_hab2 = 1;
   /* if ($mon == 1){
	    $impo_bs1 = $impo_bs1 * - 1;
        $impo_eqv1 = $impo_bs1;
		//$impo_bs2 = $impo_bs1 * -1;
		$impo_eqv2 = $impo_bs2;	
	}else{
	    $impo_bs1 = $impo_bs1 * -1;
		$impo_eqv1 = $impo_eqv1 * -1;	
	} */
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
if (isset($_SESSION['nro_fact'])){
    $nro_fact = $_SESSION['nro_fact'];
}
if (isset($_SESSION['fec_fac'])){
     $fec_fac = $_SESSION['fec_fac'];
}
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
	$resultado = mysql_query($consulta)or die('No pudo insertar caja_deposito  1: ' . mysql_error()); 																				  
//$resultado = mysql_query($consulta); 


if(isset($_SESSION['t_fac_fis'])){
   $tipo2 = $_SESSION['t_fac_fis'];
  if ($_SESSION['t_fac_fis'] == 1){

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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
$resultado = mysql_query($consulta); 
  }
}

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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
//Grabar resto deposito con factura

if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 6){
  
//  echo $_SESSION['nro_fact'],"nro fac".$_SESSION['fec_fac']."fecha";	
if (isset($_SESSION['nro_fact'])){
    $nro_fact = $_SESSION['nro_fact'];
}
if (isset($_SESSION['fec_fac'])){
     $fec_fac = $_SESSION['fec_fac'];
}
  
  
  
  
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   // echo "tip_6";
   $deb_hab = 1;
   $cta_otra = $_SESSION['cta_it'];
  // $tipo = $_SESSION['t_fac_fis'];
  // $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_it'];
  	$impo_sus =  $imp_or/$tc_ctb;
	
	$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
//IT por pagar
 $cta_ctbg = $_SESSION['cta_it2'];
   $imp_or =  $_SESSION['monto_it'];
   $impo_sus =  $imp_or/$tc_ctb;
  	 $deb_hab = 2; 
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
//iva 
$cta_ctbg = $_SESSION['cta_iva2'];
$imp_or = $_SESSION['monto_i'];
$impo_sus =  $imp_or/$tc_ctb; 
$deb_hab = 2; 	 
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
	
//otra cuenta
$cta_ctbg = $_SESSION['cta_otra'];
$imp_or = $_SESSION['impo_bs1']-$_SESSION['monto_i'];
$impo_sus =  $imp_or/$tc_ctb; 
$deb_hab = 2; 	 
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
  //echo $_SESSION['nro_fact'],"nro fac".$_SESSION['fec_fac']."fecha";	
if (isset($_SESSION['nro_fact'])){
    $nro_fact = $_SESSION['nro_fact'];
}
if (isset($_SESSION['fec_fac'])){
     $fec_fac = $_SESSION['fec_fac'];
}
  
  
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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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
	 
	  if (isset($_SESSION['nro_fact'])){
    $nro_fact = $_SESSION['nro_fact'];
}
if (isset($_SESSION['fec_fac'])){
     $fec_fac = $_SESSION['fec_fac'];
}

	 
	 
	 
	// $nro_fac = $_SESSION['nro_fact'];	
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
									   CAJA_DEP_NRO_DOC,
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
												 $nro_doc,
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

//Grabar Cheque
//echo "Tipo" .$tipo."cheqra".$_SESSION['chequera']."cheq".$_SESSION['cheque'];
if ($tipo == 2){
$cheque =  $_SESSION['cheque'];
$chequera =  $_SESSION['chequera'];
$imp_or = $_SESSION['impo_bs1'];
 $consulta = "insert into contab_cheques(CONTA_CHEQ_AGEN, 
	                                   CONTA_CHEQ_BNCO,
                                       CONTA_CHEQ_CTA,
									   CONTA_CHEQ_TALON,
									   CONTA_CHEQ_NRO,
									   CONTA_CHEQ_IMPO,
									   CONTA_CHEQ_FECHA,
									   CONTA_CHEQ_DOC,
					                   CONTA_CHEQ_NCRE,
									   CONTA_CHEQ_APLI,
					                   CONTA_CHEQ_USR_ALTA, 
									   CONTA_CHEQ_FCH_HR_ALTA,
									   CONTA_CHEQ_USR_BAJA,
									   CONTA_CHEQ_FCH_HR_BAJA
                                       ) values ($c_agen,
												 $cod_bco,
												 '$cta_bco',
												 '$chequera',
												 $cheque,
												 $imp_or,
												 '$fec1',
												  $nro_tr_bco,
												 0,
												 0,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); ; 

}
//Bancarizacion 
$tip_ban = 0;
if(isset($_SESSION['bancariza'])){
  if ($_SESSION['bancariza'] == 1){
  if ($_SESSION['b_dep_ret'] == 1){
      $tip_ban = 2;
  }
  if ($_SESSION['b_dep_ret'] == 2){
      $tip_ban = 1;
  }
 $fec_fac = $_SESSION['fec_fac'];
 $nro_fact = $_SESSION['nro_fact'];
 $nro_auto =  $_SESSION['nro_auto'];
 $monto = $_SESSION['monto'];
 $nit = $_SESSION['nit'];
 $razon_social =  $_SESSION['razon_social'];
 $cta_bco = $_SESSION['cta_bco'];
 $nit_bco = $_SESSION['nit_bco'];
 
    // $tipo = $_SESSION['t_fac_fis'];
   /*$deb_hab = 1;
   $cta_ctbg = $_SESSION['cta_f13'];
   $imp_or = $_SESSION['monto_i'];
   if ($imp_or < 0){
      $imp_or = $imp_or * -1;
   }
   $impo_sus =  $imp_or/$tc_ctb; 
   */
	$consulta = "insert into fac_bancari(FAC_BAN_AGEN, 
	                                   FAC_BAN_TIPO,
                                       FAC_BAN_APLI,
									   FAC_BAN_NRO,
									   FAC_BAN_MOD,
									   FAC_BAN_FECHA,
									   FAC_BAN_TIPO2,
									   FAC_BAN_NIT,
									   FAC_BAN_NOMBRE,
					                   FAC_BAN_NUMERICO,
									   FAC_BAN_MONTO,
					                   FAC_BAN_AUTORIZA,
   				                       FAC_BAN_CTABAN,
									   FAC_BAN_MONTO_P,
									   FAC_BAN_MONTO_A,
									   FAC_BAN_NITBAN,
									   FAC_BAN_NUMPAGO,
									   FAC_BAN_TIPPAG,
									   FAC_BAN_FECPAG,
									   FAC_BAN_USR_ALTA,
									   FAC_BAN_FCH_HR_ALTA,
									   FAC_BAN_USR_BAJA,
									   FAC_BAN_FCH_HR_BAJA
                                       ) values ($c_agen,
									             $tip_ban,
												 '15000',
												 $nro_tr_bco,
												 1,
												 '$fec1',
												 1,
												 '$nit',
												 '$razon_social',
												 $nro_fact,
												 $monto,
												 '$nro_auto',
												 '$cta_bco',
												 $monto,
												 $monto,
												 $nit_bco,
												 1,
												 8,
												 '$fec_fac',
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar fac_bancari : ' . mysql_error()); 

	}
}


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