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
//	$fec = leer_param_gral();
	$tc_ctb  = $_SESSION['TC_CONTAB'];	
?>
<html>
<head>
<title>Reimpresiones</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_imp_des_det_imp.js"></script> 

<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
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
                  <li id="menu_modulo_cajas_imp">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                 <li id="menu_modulo_cajas_imp_des">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSOS
                    
                 </li>
                  <li id="menu_modulo_cajas_imp_des_sel">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SEL. DESEMBOLSOS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMP. DESEMBOLSOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRESO DETALLE DESEMBOLSOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion 
                     </div-->



<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <!--a href='menu_s.php'>Salir</a-->
  </div>
<?php	
	
	//Datos empresa		  
		 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
?>
<strong> 
<?php
$_SESSION['ahorro'] = 0;
$_SESSION['interes'] = 0;
$_SESSION['comision'] = 0;
if (isset($_POST['nro_desem'])) {
$nro_tran = $_POST['nro_desem'];
   }
 echo "Nro Trsn ".$nro_tran;  
$_SESSION['msg_err'] = " ";
$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where  CART_DTRA_NRO_TRAN = $nro_tran
             and CART_DTRA_TIP_TRAN = 1 
			 and CART_DTRA_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
			 
		while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['CART_DTRA_NCRE'];
					$nro_tra = $lin_car['CART_DTRA_NRO_TRAN'];
					$fec_tra = $lin_car['CART_DTRA_FECHA'];	
					$_SESSION['fec_proc'] = cambiaf_a_normal($fec_tra);
					 $nro_cred = $ncre;
	//consulta cliente		 
		$_SESSION['ncre']=$ncre;
			 $con_cli  = "Select * From  cart_deudor, cliente_general
             where  CART_DEU_NCRED = $ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_cli['CLIENTE_NOMBRES'].encadenar(1); 
					$ci_cli = $lin_cli['CLIENTE_COD_ID'];
				}
//Consulta Maestro

$con_cli  = "Select * From  cart_maestro
                     where  CART_NRO_CRED = $ncre
                     and CART_MAE_USR_BAJA is null "; 
        $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $c_grup = $lin_cli['CART_COD_GRUPO'];
				 $cod_sol =  $lin_cli['CART_NRO_SOL'];
				 $t_ope = $lin_cli['CART_TIPO_OPER'];
				 $prod = $lin_cli['CART_PRODUCTO'];
				 $mon = $lin_cli['CART_COD_MON'];
				 $comif = $lin_cli['CART_TIP_COM'];
				 $impo = $lin_cli['CART_IMPORTE'];
				 $imp_c = $lin_cli['CART_IMP_COM'];
				 $_SESSION['ahorro'] = $lin_cli['CART_AHO_INI'];
				$_SESSION['fechr_proc'] = $lin_cli['CART_MAE_FCH_HR_ALTA'];
				  $_SESSION['nom_rec'] = $lin_cli['CART_MAE_USR_ALTA'];
				 $_SESSION['asesor'] = $lin_cli['CART_OFIC_RESP'];
				 $_SESSION['comision'] = $imp_c; 
				 $nom_grup = $lin_cli['CART_COD_GRUPO'];
				 
	  $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_ope";
       $res_top = mysql_query($con_top);
	   while ($linea = mysql_fetch_array($res_top)) {
	        $d_top = $linea['GRAL_PAR_INT_DESC'];
	   }
 $con_prod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and                     GRAL_PAR_PRO_COD = $prod ";
         $res_prod = mysql_query($con_prod);
		  while ($lin_prod = mysql_fetch_array($res_prod)) {
		        $pro_d = $lin_prod['GRAL_PAR_PRO_DESC'];
		  }	   
		  
  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$s_mon = $linea['GRAL_PAR_INT_SIGLA'];
	   }		  
		  
		  
	   			 
				 
		//		 $d_top
				 
				 
				 
				 
				 
			}				
   }
  // $_SESSION['ahorro'] = 0;
//  $_SESSION['interes'] = 0;
   //$_SESSION['comision'] = 0;
  $con_tran  = "Select * From  cart_det_tran
                     where  CART_DTRA_NCRE = $ncre
					 and CART_DTRA_NRO_TRAN = $nro_tran
                     and CART_DTRA_TIP_TRAN = 1 
			         and CART_DTRA_USR_BAJA is null";
                     
        $res_tran = mysql_query($con_tran);
 
             while ($lin_tran = mysql_fetch_array($res_tran)) {
			       $ccon = $lin_tran['CART_DTRA_CCON'];
			    if ($ccon == 513){
				     $_SESSION['interes'] = $lin_tran['CART_DTRA_IMPO'];
				}
			 
			 }
  
 ?>
 <?php
echo encadenar(25)."DESEMBOLSO  DE  CREDITO".encadenar(80)."DESEMBOLSO  DE  CREDITO"; 
?>
 <table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tran; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tran; ?></th>       
			
    </tr>	
	
	</table>
	</center>	


 <table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Solicitud"; ?> </th> 
		<th align="right"><?php echo $cod_sol; ?></th> 
		<th align="left"><?php echo encadenar(5);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>
		<th align="center"><?php echo encadenar(30); ?></th>     
		<th align="left"><?php echo "Solicitud"; ?> </th> 
		<th align="right"><?php echo $cod_sol; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>  
			
    </tr>	
<tr>
	    <th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Producto"; ?></th> 
		<th align="right"><?php echo $pro_d; ?></th>
		<th align="center"><?php echo encadenar(30); ?></th>     
		<th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Producto"; ?></th> 
		<th align="right"><?php echo $pro_d; ?></th>  
			
    </tr>	
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(30); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>
	</table>
  <table border="0" width="900">
 <?php
	 if ($t_ope < 3){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_cli; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_cli; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
    <?php
	} else{
	?> 
	<tr>
	    <th align="left"><?php echo "Deudor"; ?> </th> 
		<td align="left"><?php echo $nom_cli; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Deudor"; ?></th>
		<td align="left"><?php echo $nom_cli; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
	
   	
	  <?php }  ?>
	  </table> 
	 <br>
      <br>
	 <?php
  if ($comif == 2){
    	$impsc = $imp_sc ;
		}
	if ($comif == 1){
    	$impsc = $impo ;
		}	
	$imposc = number_format($impsc, 2, '.',',');  
  
//     echo encadenar(2)."Desembolso a Capital".encadenar(50).$imposc.encadenar(3).$s_mon;   
 ?>
  <table border="0" width="900">
  <tr>
	    <th align="left"><?php echo "Desembolso a Capital"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $imposc; ?></th>
		<td align="right"><?php echo $s_mon; ?></th> 
		<th align="center"><?php echo encadenar(45); ?></th> 
		<th align="left"><?php echo "Desembolso a Capital"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $imposc; ?></th>
		<td align="right"><?php echo $s_mon; ?></th>  
   </tr>	 
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   </table>
   
   	
	 <?php 
	//$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    //$resultado = mysql_query($consulta);
   // while ($linea = mysql_fetch_array($resultado)) {
   //        $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
	//  }
	// $impfg = number_format($imp_fg, 2, '.',',');  
	//echo encadenar(2)."Fondo Garantia Inicio".encadenar(51)."(".$impfg.")".encadenar(3).$s_mon; 	
	
	?>
	<strong>
	
	 <table border="0" width="900">
	<?php
	 $mon_des = f_literal($impsc,1);
//	 echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <tr>
	    <th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
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
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
     <?php 
	 $mon_desem = $impsc - $imp_c - $_SESSION['ahorro'] - $_SESSION['interes'];
//	 echo $_SESSION['ahorro']." "."ahorro";
	 $mon_dese = number_format($mon_desem, 2, '.',','); 
	 ?>
	  <table border="0" width="900">
	  <tr>
	    <th align="left" style="font-size:10px"><?php echo encadenar(8)." MONTO ENTREGADO ".
		                                 encadenar(3).$mon_dese.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(28); ?> </th>  
		<th align="left" style="font-size:10px" ><?php echo encadenar(32); ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
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
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(15).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(15).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
<br><br><br>

<strong> 
<?php
if ($_SESSION['ahorro'] > 0){
$con_cab  = "Select CART_CAB_TRAN_FON From cart_cabecera where CART_CAB_NCRE = $nro_cred 
	              and CART_CAB_TIP_TRAN = 1
				  and CART_CAB_NRO_TRAN = $nro_tran
				 and CART_CAB_USR_BAJA is null";
    $res_cab = mysql_query($con_cab);
	$imp_co = 0;
    while ($lin_cab = mysql_fetch_array($res_cab)) {
	      $nro_tr_fond = $lin_cab['CART_CAB_TRAN_FON'];
 
    }
$con_cab  = "Select FOND_DTRA_NCTA, FOND_DTRA_IMPO From fond_det_tran 
             where FOND_DTRA_NCRE = $nro_cred 
	              and FOND_DTRA_TIP_TRAN = 1
				  and FOND_DTRA_NRO_TRAN = $nro_tr_fond
				 and FOND_DTRA_USR_BAJA is null";
    $res_cab = mysql_query($con_cab);
	$imp_co = 0;
    while ($lin_cab = mysql_fetch_array($res_cab)) {
	      $nro_ctaf  = $lin_cab['FOND_DTRA_NCTA'];
		  $impfg = $lin_cab['FOND_DTRA_IMPO'];
 
    }



echo encadenar(15)."DEPOSITO INICIAL FONDO GARANTIA".encadenar(55)."DEPOSITO INICIAL FONDO GARANTIA"; 
?>
 
<table border="0" width="900">
	
	<tr>
	    <th align="center"><?php echo encadenar(16); ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(15); ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>           
	    <th align="center"><?php echo encadenar(42); ?></th>     
		<th align="center"><?php echo encadenar(16); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>  
		<th align="center"><?php echo encadenar(15); ?></th>     
		<th align="center"><?php echo encadenar(12); ?></th>
		
    </tr>	
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_fond; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>   
	   	<th align="right"><?php echo encadenar(5).$nro_tr_fond; ?></th>    
			
    </tr>	
</table>
	
	<table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="right"><?php echo $nro_ctaf; ?></th> 
		<th align="left"><?php echo encadenar(20);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>
		<th align="center"><?php echo encadenar(45); ?></th>     
		<th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="right"><?php echo $nro_ctaf; ?></th> 
		<th align="left"><?php echo encadenar(20);; ?></th>  
	   	<th align="left"><?php echo "Nro. Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>  
    </tr>	
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(38); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>	
</table>
 <table border="0" width="900">
 <?php
	 if ($t_ope < 3){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_cli; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_cli; ?></th>     
   </tr>
   	 <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo encadenar(10); ?> </th> 
		<td align="left"><?php echo encadenar(10); ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo encadenar(10); ?></th>
		<td align="left"><?php echo encadenar(10); ?></th>     
   </tr>
    <?php
	} else{
	?> 
	<tr>
	    <th align="left"><?php echo "Deudor"; ?> </th> 
		<td align="left"><?php echo $nom_cli; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Deudor"; ?></th>
		<td align="left"><?php echo $nom_cli; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
	
   	
	  <?php }  ?>
	  </table> 
	 <br>

		
	 <?php 
	$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$imp_fg = 0;
    while ($linea = mysql_fetch_array($resultado)) {
           $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
	  }
	 $impfg = number_format($imp_fg, 2, '.',',');  
//	echo encadenar(2)."Fondo Garantia Inicio".encadenar(51).$impfg.encadenar(3).$s_mon; 	
	
	?>
	<table border="0" width="900">
	 <tr>
	    <th align="left"><?php echo "Deposito Fondo Garantia Inicio"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impfg; ?></th>
		<td align="right"><?php echo $s_mon; ?></th> 
		<th align="center"><?php echo encadenar(47); ?></th> 
		<th align="left"><?php echo "Deposito Fondo Garantia Inicio"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impfg; ?></th>
		<td align="right"><?php echo $s_mon; ?></th>  
   </tr>	 
   
  
   </table>
	<?php 
//	echo encadenar(80)."_______________ ";
	?>
	<BR><strong>
	 <?php 
	// $mon_desem = $impsc - $imp_c - $imp_fg;
	// $mon_dese = number_format($mon_desem, 2, '.',','); 
	// echo encadenar(8)." MONTO A DESEMBOLSAR EFECTIVO ".encadenar(5).$mon_dese.encadenar(3).$s_mon;
	 ?>
	
	 <table border="0" width="900">
	 <?php
	// echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	 <br><br>
	 <?php
	 $mon_fond = f_literal( $imp_fg,1);
//	 echo encadenar(8).$mon_fond.encadenar(3).$s_mon;
	 ?>
	<tr>
	    <th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_fond.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_fond.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
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
		<th align="left"><?php echo encadenar(50); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
   
	   </table>
  <table border="0" width="900">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	   <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(20).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
  <br><br>
  
 <?php 
 }
 
  //Comision
 if ($_SESSION['comision'] > 0){ 
  $con_cab  = "Select caja_ingegr_corr From cart_cabecera, caja_ing_egre where CART_CAB_NCRE = $nro_cred 
	              and CART_CAB_TIP_TRAN = 1
				  and CART_CAB_NRO_TRAN = $nro_tran
				  and caja_ingegr_corr_cja = CART_CAB_TRAN_CAJ
				  and substr(caja_ingegr_cta,1,3) = '519'
	              and CART_CAB_USR_BAJA is null";
    $res_cab = mysql_query($con_cab);
	$imp_co = 0;
    while ($lin_cab = mysql_fetch_array($res_cab)) {
	      $nro_tr_ingegr = $lin_cab['caja_ingegr_corr'];
 
    }
 
 
 
 echo encadenar(20)."INGRESO POR COMISION".encadenar(85)."INGRESO POR COMISION"; ?>
  <table border="0" width="900">
	
	<tr>
	    <th align="center"><?php echo encadenar(16); ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(15); ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>           
	    <th align="center"><?php echo encadenar(42); ?></th>     
		<th align="center"><?php echo encadenar(16); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>  
		<th align="center"><?php echo encadenar(15); ?></th>     
		<th align="center"><?php echo encadenar(12); ?></th>
		
    </tr>	
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>   
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th>  
			
    </tr>	
	
	</table>
	<?php

?>
<table border="0" width="900">
 <tr>
        <th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>
	    <th align="left"><?php echo encadenar(6); ?> </th> 
		<th align="right"><?php echo encadenar(6); ?></th> 
		<th align="left"><?php echo encadenar(25);; ?></th>  
	   	<th align="center"><?php echo encadenar(50); ?></th>     
		<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>  
		<th align="left"><?php echo encadenar(6); ?> </th> 
		<th align="right"><?php echo encadenar(6); ?></th> 
		<th align="left"><?php echo encadenar(25);; ?></th>  
	   	
    </tr>	
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(38); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>	
</table>
<table border="0" width="900">
 <?php
	 if ($t_ope < 3){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_cli; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_cli; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
    <?php
	} else{
	?> 
	<tr>
	    <th align="left"><?php echo "Deudor"; ?> </th> 
		<td align="left"><?php echo $nom_cli; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "Deudor"; ?></th>
		<td align="left"><?php echo $nom_cli ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
	
   	
	  <?php }  ?>
	  </table> 
<br>	  
<?php

$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$imp_co = 0;
    while ($linea = mysql_fetch_array($resultado)) {
           $imp_co = $imp_co + $linea['CRED_DEU_COMISION'];
	  }
	 $impco = number_format($imp_co, 2, '.',',');  
	//echo encadenar(2)."Comision Desembolso".encadenar(51).$impco.encadenar(3).$s_mon; 
?>

	 <?php
	// echo encadenar(8)." MONTO COMISION".encadenar(5);
	 ?>
	 <br><br>
	 <?php
	 $mon_comi = f_literal( $imp_co,1);
	// echo encadenar(8).$mon_comi.encadenar(3).$s_mon;
	 ?>
  <table border="0" width="900">
	 <?php
	// echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	<tr>
	    <th align="left"><?php echo " MONTO COMISION"; ?> </th> 
		<th align="left"><?php echo $impco.encadenar(1).$s_mon; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left"><?php echo " MONTO COMISION"; ?> </th> 
		<th align="left"><?php echo $impco.encadenar(1).$s_mon; ?></th> 
   </tr>
	<tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(4); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	 <tr>
	    <th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(4); ?> </th>  
		<th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(4); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"style="font-size:10px" ><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
  <table border="0" width="900">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	   <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(20).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
 <?php
 }
 if ($_SESSION['interes'] > 0){ 
     $con_cab  = "Select caja_ingegr_corr From cart_cabecera, caja_ing_egre where CART_CAB_NCRE = $nro_cred 
	              and CART_CAB_TIP_TRAN = 1
				  and CART_CAB_NRO_TRAN = $nro_tran
				  and caja_ingegr_corr_cja = CART_CAB_TRAN_CAJ
				  and substr(caja_ingegr_cta,1,3) = '513'
	              and CART_CAB_USR_BAJA is null";
    $res_cab = mysql_query($con_cab);
	$imp_co = 0;
    while ($lin_cab = mysql_fetch_array($res_cab)) {
	      $nro_tr_ingegr = $lin_cab['caja_ingegr_corr'];
 
    }
     echo encadenar(20)."INGRESO POR INTERES".encadenar(85)."INGRESO POR INTERES";  ?>
   <table border="0" width="900">
	
	<tr>
	    <th align="center"><?php echo encadenar(16); ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(15); ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>           
	    <th align="center"><?php echo encadenar(42); ?></th>     
		<th align="center"><?php echo encadenar(16); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>  
		<th align="center"><?php echo encadenar(15); ?></th>     
		<th align="center"><?php echo encadenar(12); ?></th>
		
    </tr>	
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>   
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th> 
			
    </tr>	
	</table>
	 <table border="0" width="900">
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(38); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>	
</table>

<?php

$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
$resultado = mysql_query($consulta);
$imp_in = 0;
while ($linea = mysql_fetch_array($resultado)) {
      $imp_in = $imp_in + $linea['CRED_DEU_INT_CTA'];
      }	
	 $impin = number_format($imp_in, 2, '.',',');  
//	echo encadenar(2)."Interes anticipado Cred. Oportunidad".encadenar(51).$impin.encadenar(3).$s_mon; 
?>

    <?php
	 if ($t_ope  < 3){
	?> 
	 <table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_cli; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_cli; ?></th>     
   </tr>
   	 <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo encadenar(10); ?> </th> 
		<td align="left"><?php echo encadenar(10); ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo encadenar(10); ?></th>
		<td align="left"><?php echo encadenar(10); ?></th>     
   </tr>
   
   	</table> 
	  <?php }  ?>
   <table border="0" width="900">
	 <tr>
	    <th align="left"><?php echo "Int. anticipado Oportunidad"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impin; ?></th>
		<td align="right"><?php echo $s_mon; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th> 
		<th align="left"><?php echo "Int. anticipado Oportunidad"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impin; ?></th>
		<td align="right"><?php echo $s_mon; ?></th>  
   </tr>	 
   
  
   </table>
   
   
	 <?php
	// echo encadenar(8)." MONTO INTERES".encadenar(5);
	 ?>
	 <br><br>
	 <?php
	 $mon_comi = f_literal( $imp_in,1);
	// echo encadenar(8).$mon_comi.encadenar(3).$s_mon;
	 ?>
  <table border="0" width="900">
	 <?php
	// echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	
	
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
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
		<th align="left"><?php echo encadenar(50); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_cli; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
  <table border="0" width="900">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(25).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(25).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
  
  
<?php
}
}
ob_end_flush();
 ?>
 
                      