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
//	 $fec = leer_param_gral();
	$tc_ctb  = $_SESSION['TC_CONTAB'];	
?>
<html>
<head>
<title>Reimpresion Transaccion Fondo Garantia</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/cajas_reim_fongar_sel_imp.js"></script> 

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
                 <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_fg">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> FONDO DE GARANTIA
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_fg_sel">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SEL. FON. GARAN.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMP. FON. GARAN.
                    
                 </li>
              </ul> 
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR FONDO DE GARANTIA</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Elija la Transaccion
                     </div--> 

<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <!--a href='menu_s.php'>Salir</a-->
  </div>
  <strong> 
<?php	
	 $_SESSION['msg_err'] = "";	  
		 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc']; 
  }	
 	  
//echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];		  
?>
<strong>
<?php
//$f_des = "";
//$f_has = "";
$mone = " ";
if(isset($_POST['nro_desem'])){
   $quecom = $_POST['nro_desem'];
   //echo $quecom;
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $n_des = $_POST['nro_desem'];
	      }
   }
    //  $n_des = $_POST['nro_desem'];
   //   $_SESSION['nro_desem'] = $n_des;
	 // $f_des2 = cambiaf_a_mysql($f_des);
  }
  echo $n_des;
	$t_tran = substr($n_des,0,1);  
$n_des = substr($n_des,1,4);
$nro_tr_fond = $n_des;
$_SESSION['dep_ret'] = $t_tran; 
$con_tpa = "Select DISTINCT FOND_DTRA_FECHA,FOND_DTRA_NCTA,FOND_DTRA_IMPO,
                                             FOND_DTRA_FCH_HR_ALTA,
			                                 FOND_DTRA_NRO_TRAN,FOND_DTRA_NCRE,
											 FOND_DTRA_TIP_TRAN,FOND_DTRA_USR_ALTA
			 from  fond_det_tran
             where 
			   FOND_DTRA_NRO_TRAN = $n_des
			   and FOND_DTRA_TIP_TRAN = $t_tran
			   and FOND_DTRA_NRO_CTA = 2 
               and FOND_DTRA_USR_BAJA is null order by 
			   FOND_DTRA_TIP_TRAN,FOND_DTRA_NRO_TRAN";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['FOND_DTRA_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['FOND_DTRA_NRO_TRAN'];
			$cod_cre = $lin_tpa['FOND_DTRA_NCRE'];
			$n_cta = $lin_tpa['FOND_DTRA_NCTA'];
			$imp = $lin_tpa['FOND_DTRA_IMPO'];
			$_SESSION['fechr_proc'] = $lin_tpa['FOND_DTRA_FCH_HR_ALTA']; 
			$_SESSION['imp'] = $imp;
			$cta_fon = $n_cta;
			$caje = substr($lin_tpa['FOND_DTRA_USR_ALTA'],0,8); 
			$_SESSION['nom_rec'] = $caje;
			$_SESSION['ncre'] = $cod_cre;
			
			$_SESSION['f_tra'] = $fec_pag;
             $f_des2= cambiaf_a_normal($fec_pag);
			 $_SESSION['fec_proc'] = $f_des2;
			$_SESSION['nro_tran'] = $nro_tran;
			//echo $cod_cre ."-ncre-";
	//Consulta Cart_maestro
			
			$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $mon = $lin_car['CART_COD_MON'];
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					$tcred = $lin_car['CART_TIPO_CRED'];
					$asesor = $lin_car['CART_OFIC_RESP'];
					$tip_ope = $lin_car['CART_TIPO_OPER'];
                    $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
					$_SESSION['nombre'] = $nom_cli;
			
			$nom_ases = leer_nombre_usr($tcred,$asesor);
			$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tip_ope ";
            $res_top = mysql_query($con_top);
			 while ($lin_top = mysql_fetch_array($res_top)) {
			        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
			 
			    }
		 $nom_grp = "";	
		 $_SESSION['grupo'] = "";	
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
				  $_SESSION['grupo'] = $nom_grp;
	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}	
		 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
          $res_mon = mysql_query($con_mon);
	      while ($linea = mysql_fetch_array($res_mon)) {
	             $d_mon = $linea['GRAL_PAR_INT_DESC'];
				 $s_mon = $linea['GRAL_PAR_INT_SIGLA'];
				 $_SESSION['d_mon'] = $d_mon;
	         }	
			
		
			
		}	
}




?> 

 
<?php
$nom_ases = "";
$comif = 0;
$impsc = 0;
//$imp = 0;
$desc ="";
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }
if(isset($_SESSION['cta_fon'])){ 
   $cta_fon = $_SESSION['cta_fon'];
}
if(isset($_SESSION['cod_mon'])){ 
   $mon = $_SESSION['cod_mon'];
}

//echo $_SESSION['ncre']."ncre";
if(isset($_SESSION['ncre'])){ 
   $ncre = $_SESSION['ncre'];
   }else{
   $ncre = 0;
}

$total = 0;
$f_tra = cambiaf_a_mysql_2($fec_p);
//echo $fec_p, $f_tra;
$_SESSION['msg_err'] = " ";
//$log_usr = $_SESSION['login'];
if(isset($_POST['monto'])){  
  // $imp = $_POST['monto'];
  // $_SESSION['imp'] = $imp;
   }
 if(isset($_POST['descrip'])){  
   $desc = $_POST['descrip'];
   $desc = strtoupper($desc);
   
   }  
  //if ($_SESSION['continuar'] == 2){

	
//	}
if (isset($_SESSION['asesor'])){
    }else{
   $_SESSION['asesor']= "";
   }
 //  if ($_SESSION['dep_ret'] == 2){
  //    $imp = $_SESSION['imp'];
   // }   
  
 
 //if($_SESSION['cod_mon'] == 1){ 
  // $eqv = $imp;
//}  
//echo $imp,$eqv;
//if($_SESSION['cod_mon'] == 2){ 
  
   $eqv = $imp;
   $imp = $imp * $tc_ctb;
//}     
if(isset($_SESSION['cod_cta2'])){    
   $cod_cta2 = $_SESSION['cod_cta2'];
   }
if(isset($_SESSION['cod_cta1'])){    
   $cod_cta1 = $_SESSION['cod_cta1'];
   }
$deb_hab1 = 0;
$deb_hab2 = 0;
 $desc3 = "Cta."." ".$n_cta." ".$_SESSION['grupo']." / ".$_SESSION['nombre']; 
if($_SESSION['dep_ret'] == 1){
    $des_tra = "Deposito";
    $tip_tra = 1;
	$tip_ope = 1;
	$deb_hab1 = 1;
	$deb_hab2 = 2; 
	$desc1 = "DEPOSITO FONDO GARANTIA";
	
	$desc2 = "Transaccion por";
}
if ($_SESSION['dep_ret'] == 2){
   
  
    $eqv = $eqv * -1;
   $imp = $imp * -1;
    $des_tra = "Retiro";
    $tip_tra = 2;
	$tip_ope = 2;
	$deb_hab1 = 2;
	$deb_hab2 = 1;
	$desc1 = "RETIRO FONDO GARANTIA"; 
//	$desc3 = "RETIRO FONDO GARANTIA Cta."." ".$cta_fon; 
	$desc2 = "Transaccion por";
	
}

// $apli = 11000;
// $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
 
 $agen = 32;
 //$nro_tr_fond = leer_nro_co_fon($tip_tra,$log_usr); 
//echo $tip_tra, $nro_tr_fond;
 //Grabar Tablas
 //Caja
 $con_fga  = "Select * From  fond_maestro where  FOND_NRO_CTA = $n_cta and FOND_MAE_USR_BAJA is null"; 
$res_fga = mysql_query($con_fga);
   while ($lin_fga = mysql_fetch_array($res_fga)) {
          $top = $lin_fga['FOND_TIPO_OPER'];
		  if ($top == 1) {
		      $top_des = "Relacionada a Credito";
			 }
		   if ($top == 2) {
		      $top_des = "Particular";
			 }
   
   }
  
 // Impresion Comprobante Cartera
// echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];
     ?>
<strong>	 <font size="+1">
	 <?php
if ($_SESSION['EMPRESA_TIPO'] == 2){	 
echo encadenar(5).$desc1.encadenar(70).$desc1; 
?>
</font></strong>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte. Fond.Gar."; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_fond; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cmpte. Fond.Gar."; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_fond; ?></th>     
			
    </tr>	
	
	</table>
	</center>
		
<table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="left"><?php echo $cta_fon; ?></th> 
		
		<th align="center"><?php echo encadenar(50); ?></th>     
		<th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="left"><?php echo $cta_fon; ?></th> 
		
    </tr>	
	

<tr>
	    <th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="left"><?php echo  $top_des; ?></th> 
		
		<th align="center"><?php echo encadenar(23); ?></th>     
		<th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="left"><?php echo $top_des; ?></th> 
		
			
    </tr>	
	 <?php
	 if ($_SESSION['grupo'] <> ""){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['grupo']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $_SESSION['grupo']; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		
	<?php }else{  ?> 		
	 <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nombre']; ?></th>     
   </tr>
   <?php }  ?> 	
		    
   	
  </table> 
<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['d_mon']; ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th>  
	   	<td align="left"><?php echo $_SESSION['asesor']; ?></th> 
		<th align="center"><?php echo encadenar(45); ?></th>
		 <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['d_mon']; ?></th>        
		<th align="left"><?php echo "Asesor "; ?></th>  
		<td align="left"><?php echo $_SESSION['asesor']; ?></th>     
			
    </tr>	
</table>
 
 </strong><br>
<br>

	 <table border="0" width="900">
  <tr>
	    <th align="left"><?php echo $des_tra; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo number_format($_SESSION['imp'], 2, '.',',').encadenar(1).$s_mon; ?></th>
		<td align="left"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th> 
		<th align="left"><?php echo $des_tra; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo number_format($_SESSION['imp'], 2, '.',',').encadenar(1).$s_mon; ?></th>
		<td align="left"><?php echo encadenar(3); ?></th>  
   </tr>	
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   <tr>
	    <th align="left"><?php echo $desc2; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $desc; ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo $desc2; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $desc; ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   </table>
   
	<?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(2).$desc2.encadenar(3).$desc;
	 ?>
	 
	 <?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="900"> 
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>  
		<th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
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

if ($_SESSION['EMPRESA_TIPO'] == 1){	 
echo encadenar(5).$desc1.encadenar(10); 
?>
</font></strong>
<table border="0" width="500">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(30); ?></th>
					
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte. Fond.Gar."; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_fond; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		    
			
    </tr>	
	
	</table>
	</center>
		
<table border="0" width="500">
 <tr>
	    <th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="left"><?php echo $cta_fon; ?></th> 
		
		<th align="center"><?php echo encadenar(20); ?></th>     
		
		
    </tr>	
	

<tr>
	    <th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="left"><?php echo  $top_des; ?></th> 
		
		<th align="center"><?php echo encadenar(13); ?></th>     
	
		
			
    </tr>	
	 <?php
	 if ($_SESSION['grupo'] <> ""){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['grupo']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
	    
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
	
		
	<?php }else{  ?> 		
	 <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
	   
   </tr>
   <?php }  ?> 	
		    
   	
  </table> 
<table border="0" width="500">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['d_mon']; ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th>  
	   	<td align="left"><?php echo $_SESSION['asesor']; ?></th> 
		<th align="center"><?php echo encadenar(25); ?></th>
		     
			
    </tr>	
</table>
 
 </strong><br>
<br>

	 <table border="0" width="500">
  <tr>
	    <th align="left"><?php echo $des_tra; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo number_format($_SESSION['imp'], 2, '.',',').encadenar(1).$s_mon; ?></th>
		<td align="left"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		
		 
   </tr>	
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		 
   </tr>
   <tr>
	    <th align="left"><?php echo $desc2; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $desc; ?></th>
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
   
	<?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(2).$desc2.encadenar(3).$desc;
	 ?>
	 
	 <?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="500"> 
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(28); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
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
		
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
		
	 </tr>

  </table>
   <table border="0" width="500">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?> </th>  
		 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>  

   </tr>
</table>
 
  <?php
}

  
 // echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
 // echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>



 <?php
  
 // echo encadenar(10)."Antes de firmar verifique los datos";
  ?>
 
 <?php
 // Impresion Comprobante Fondo Garantia
 /*
 
  */
  ?>
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
 
                   