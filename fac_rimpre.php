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
	//require('c:\wamp\www\cc7\lib7\libreriaCC7.php');
?>
<html>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
<head>
 <!--Titulo de la pestaña de la pagina-->
<title>Reimpresion Factura</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_reim_fac_imp.js"></script> 
</head>
<body>
<?php
				include("header.php");
			?>	
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_imp">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> FACTURA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMPRIMIR FACTURA
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR FACTURA</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div-->   
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <!--a href='cja_reimpre.php'>Salir</a-->
 </div>
	<?php
		//		include("header.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 

if ($_SESSION['EMPRESA_TIPO'] == 2){
//echo "aquiiii";
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
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

$nfac = $_POST['nro_fac'];

$con_fac  = "Select *
			 from  factura
				 where FACTURA_NUMERICO = $nfac 
				 and FACTURA_FECHA = '$fec1'"; 
             $res_fac = mysql_query($con_fac)or die('No pudo seleccionarse factura');
              while ($lin_fac = mysql_fetch_array($res_fac)) {
                     $_SESSION['monto'] = $lin_fac['FACTURA_MONTO'];
                     $_SESSION['nfactura'] = number_format($nfac, 0, '.','');
                     $_SESSION['orden'] = $lin_fac['FACTURA_ORDEN'];
					 $_SESSION['fec_emi'] = cambiaf_a_normal($lin_fac['FACTURA_FECHA']);
					 $_SESSION['nom_cli'] = $lin_fac['FACTURA_NOMBRE'];
					 $_SESSION['nitci'] = $lin_fac['FACTURA_NIT'];
					 $_SESSION['nro_tr_ingegr'] = number_format($lin_fac['FACTURA_NRO'], 0, '.','');                  $_SESSION['concep'] = "INTERES";
					 $_SESSION['cc7m'] = $lin_fac['FACTURA_COD_CTRL'];
					 $_SESSION['fecha_h'] = cambiaf_a_normal($lin_fac['FACTURA_FEC_H']);
//if ($_SESSION['imp_int'] + $_SESSION['imp_com'] > 0){
    $monto = $_SESSION['monto']; 	
?>
	<br><br><br>
	<table border="0" width="1200">
	
	<tr>
	    <td align="left"><?php echo encadenar(70); ?> </th> 
		<th align="left"  ><?php echo "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(115).
		 "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(12); ?></th>  
	    
			
    </tr>
	</table>
	<table border="0" width="1200">
	<tr>
	    <td align="left"><?php echo encadenar(55); ?> </th> 
		<th align="left"  ><?php echo "Factura Nro:".encadenar(2).$_SESSION['nfactura'].
		encadenar(120). "Factura Nro:".encadenar(2).$_SESSION['nfactura'].encadenar(12); ?></th>  
	   	
			
    </tr>	
	</table>
	<table border="0" width="1700">
	<tr>
	    <td align="left"><?php echo encadenar(40); ?> </th> 
		<th align="left" ><?php echo "Autorización Nro:".encadenar(1).$_SESSION['orden'].
		encadenar(80)."Autorización Nro:".encadenar(1).$_SESSION['orden'].encadenar(35); ?></th>  
	  	
    </tr>	
	
	</table>
    <table border="0" width="1200">
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	
	
	</table>	
	  <table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Fecha de Emision:".encadenar(2).$_SESSION['fec_emi']; ?> </th> 
		
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left" ><?php echo "Fecha de Emision:".encadenar(2).$_SESSION['fec_emi']; ?> </th> 
		
    </tr>
	</table>	
	  <table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Señor(es):".encadenar(2). $_SESSION['nom_cli'] ; ?> </th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left" ><?php echo "Señor(es):".encadenar(2). $_SESSION['nom_cli'] ; ?> </th> 
    </tr>
	</table>
	 <table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Nit / CI:".encadenar(2). $_SESSION['nitci'].encadenar(35)."Nro.Tran".encadenar(2).$_SESSION['nro_tr_ingegr'].encadenar(62)."Nit / CI::".encadenar(2). $_SESSION['nitci'].encadenar(25)."Nro.Tran".encadenar(2).$_SESSION['nro_tr_ingegr']; ?> </th> 
		
	
    </tr>
	</table>	
	 <table border="0" width="1000">
	<tr>
	    <th align="left" style="border: groove" ><?php echo "Cantidad".encadenar(25)."Concepto".encadenar(15); ?> </th> 
		<th align="right" style="border: groove" ><?php echo "Importe"; ?> </th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		 <th align="left" style="border: groove" ><?php echo "Cantidad".encadenar(25)."Concepto".encadenar(15); ?> </th> 
		<th align="right" style="border: groove" ><?php echo "Importe"; ?> </th>  
    </tr>
	
	
	
	
 <?php
 $tot = 0;
 $det_tran  = "Select *
			 from  factura_tran
				 where FAC_TRA_FACTURA = $nfac and
				 FAC_TRA_FECHA ='$fec1'"; 
             $res_det = mysql_query($det_tran)or die('No pudo seleccionarse factura');
              while ($lin_det = mysql_fetch_array($res_det)) {
                     $_SESSION['monto'] = $lin_det['FAC_TRA_IMPO'];
                     $_SESSION['concep'] = $lin_det['FAC_TRA_DESCRI'];
					 $tot = $tot + $lin_det['FAC_TRA_IMPO'];
//if ($_SESSION['detalle'] == 3){
   $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $nro_tran_cart = $_SESSION['nro_tr_ingegr'];
   $deb_hab = 1;	
   $tipo = 1;
   
// if ($_SESSION['imp_int'] > 0){
 //$descrip = 'INTERES CORRIENTE';
 ?>
  <tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25). $_SESSION['concep']; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['monto'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25).$_SESSION['concep']; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['monto'], 2, '.',','); ?></th> 
	 </tr>
<?php }	
  /* if ($_SESSION['imp_com'] > 0){
  $descrip = 'COMISION';

?>
 <tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['imp_com'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['imp_com'], 2, '.',',').encadenar(5); ?></th> 
	 </tr>
<?php } */	?>
    <tr>
	 	<th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right"style="border: groove" ><?php echo number_format($tot, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right" style="border: groove"><?php echo number_format($tot, 2, '.',','); ?></th> 
	 </tr>
</table>	  
  
		

</center>
<?php
 
	    $mon_des = f_literal($monto,1);

	 ?>		
<table border="0" width="1000"> 
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	  <tr>
	    <th align="left" style="font-size:12px"><?php echo "Son:".encadenar(1).$mon_des.encadenar(3).
		                       "Bolivianos"; ?> </th> 
		<th align="left"><?php echo encadenar(48); ?> </th>  
		<th align="left"  style="font-size:12px"><?php echo "Son:".encadenar(1).$mon_des.encadenar(3).
		                       "Bolivianos"; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
     <tr>
	    <th align="left"><?php echo "Codigo de Control:".encadenar(3).$_SESSION['cc7m']; ?> </th> 
		<th align="left"><?php echo encadenar(40); ?> </th>  
		 <th align="left"><?php echo "Codigo de Control:".encadenar(3).$_SESSION['cc7m']; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 <tr>
	    <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$_SESSION['fecha_h']; ?> </th> 
		<th align="left"><?php echo encadenar(40); ?> </th>  
		 <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$_SESSION['fecha_h']; ?> </th>
   </tr>
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 
	 	</table>
	

	
<?php

  }
}
		 ?>
</div>
<?php
//}
		 	include("footer_in.php");
		 ?>
</body>
</html>
<?php
}
ob_end_flush();
 ?>