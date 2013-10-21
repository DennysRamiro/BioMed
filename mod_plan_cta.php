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
<title>Modificacion Plan Cuentas</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<!--script type="text/javascript" src="js/contabilidad_reportes_bg.js"></script-->
<script type="text/javascript" src="js/contabilidad_mant_plan_glosa_grab.js"></script> 
<!--script type="text/javascript" src="js/ValidarListaMultiple.js"></script-->
</head>
<body>

<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe Seleccionar una cuenta.</font></p>
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

                  <?php
                      if($_SESSION['menu']==7){?> 
                  <li id="menu_modulo_cont_mant_plan">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> MODIF. DE GLOSA
                    
                 </li>
              </ul>  
  


<div id="contenido_modulo">

                      <h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">MODIFICACION DE GLOSA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Seleccione una Cuenta Contable
        </div>
	
        		<?php }elseif ($_SESSION['menu']==9) { ?>
        		<li id="menu_modulo_cont_mant_plan">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                    
                 </li>
                  <li id="menu_modulo_cont_mant_plan_modif">
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> MODIF. DE GLOSA
                    
                 </li>
                 <li id="menu_modulo_cont_mant_plan_modif_grab">
                    
                     <img src="img/save 2_24x24.png" border="0" alt="Modulo" align="absmiddle"> GRAB. DE GLOSA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> IMPR. DE GLOSA
                    
                 </li>
              </ul>  
  


<div id="contenido_modulo">

                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR DE GLOSA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Revise Bien antes de Imprimir...
        </div>





			<?php } ?>
          
				<?php
					 $fec = $_SESSION['fec_proc'];  //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 //$fec1 = cambiaf_a_mysql_2();
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					 // $nro_tr_con = leer_nro_co_con();
				?>
            

<strong>
<?php
//echo "Nro. Asiento Contable ".encadenar(2). $nro_tr_con.encadenar(2);?>
<br>
</strong>
<?php
if ($_SESSION['continuar'] == 1){
    $_SESSION['cuantos'] = 0;

    }
if ($_SESSION['detalle'] == 1){ ?>

    <form name="form2" method="post" action="mod_plancta.php" onSubmit="return checkCtas(this)">
<?php	
    $con_ctas  = "Select * From contab_cuenta ";
    $res_ctas = mysql_query($con_ctas);
	$_SESSION['continuar'] = 1;
	 ?>
 

	<center>

		<table>
	<tr><td>Cuenta Contable :</td></tr>	
    <tr> 	  
	  <td> <select name="cod_cta[]" size="5" style="width:500px; height:200px;" multiple>
	       <?php while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
           <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php echo utf8_encode(encadenar(2).$lin_cta['CONTA_CTA_DESC']); ?></option>
           <?php } ?>
		    </select>
			<br><br>	</td>
	 </tr>
	 <center>	
		 
     </table><input class="btn_form" type="submit" name="accion" value="Modificar Glosa">
</form>	

	
 
<?php } ?>


<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
//$cuantos = 0;
$debe_1 = 0;
$haber_1 = 0;
$debe_2 = 0;
$haber_2 = 0;
$mon_cta = 0;
$cod_cta = "";
if ($_SESSION['continuar'] == 2){ //1a
    $quecom = $_POST['cod_cta'];
	 for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_cta = $quecom[$i];
	      $_SESSION['cod_cta'] = $cod_cta;
       }
   } 
     echo $cod_cta."cta".$_POST['cod_cta']."---";
   	//2b
	if (isset ($_POST['cod_cta'])){
      if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }	//4b
	  }
	  echo $cod_cta."cta";
	 $con_cta  = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cod_cta' ";
    $res_cta = mysql_query($con_cta);
     $des_cta = leer_cta_des($cod_cta);		 
		
	
	?>	
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />NIVEL</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA REVALORIZACION</th>
	   <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>  
	</tr>	
		   
	 <?php    	//2
    /*  if ($deb_hab == "Debe"){ //7a
	     if ($mon_cta == 1){ 
             $m_debe_1 = $monto_t;
	         $m_haber_1 = 0;
			 $m_debe_2 = 0;
	         $m_haber_2 = 0;
			 }else{
			 $m_debe_1 = $monto_t * $tc_ctb;
	         $m_haber_1 = 0;
			 $m_debe_2 = $monto_t;
	         $m_haber_2 = 0;
		}	 
	     }else{
		     if ($mon_cta == 1){
	             $m_debe_1 = 0;
	             $m_haber_1 = $monto_t;
				 $m_debe_2 = 0;
	             $m_haber_2 = 0;
				 }else{
				 $m_debe_1 = 0;
	             $m_haber_1 = $monto_t * $tc_ctb;
				 $m_debe_2 = 0;
	             $m_haber_2 = $monto_t;
			}	 
	     } */
     if ($mon_cta == 2){ //8a
	     if ( $debe_2 > 0){ //9a     
            $debe_1 = round($debe_2 * $tc_ctb,2);
	        $haber_1 = 0;
	        }
		 if ($haber_2 > 0){ 
	        $debe_1 = 0;
	        $haber_1 = round($haber_2 * $tc_ctb,2);
	        } //8b
		 if ( $debe_1 > 0){ //9a     
            $debe_2 = round($debe_1 / $tc_ctb,2);
	        $haber_2 = 0;
	        }	
		 if ($haber_1 > 0){ 
	        $debe_2 = 0;
	        $haber_2 = round($haber_1 / $tc_ctb,2);
	        } 
			
			
			
			
       } //9b
//if (isset ($_POST['debe_1'] + $_POST['haber_1'] +  $_POST['debe_2'] +  $_POST['haber_2'])){
	if (($debe_1 + 	$haber_1 + 
	    $debe_2 +  $haber_2) > 0 ){
      $des_cta = leer_cta_des($cod_cta);
	  $descrip = $_SESSION['descrip'];
	  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	  $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2,
										  temp_glosa,
										  temp_glosa2 
									  	  ) values
										  ($cuantos,
										   $cod_cta,
									       '$des_cta',
										   $debe_1,
										   $haber_1,
										   $debe_2,
										   $haber_2,
										   '$descrip',
										   '$glosa_2')";
										   
    $resultado = mysql_query($consulta);
	}
	//}
	
	$consulta  = "Select * From temp_ctable3";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
		       <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			 
			   <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			  
			  
	     </tr>
	
     <?php }?>
         <tr>
		     <th><?php echo encadenar(3); ?></th>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>

     <center>
	 <input class="btn_form" type="submit" name="accion" value="Elimina_linea">   
	 <input class="btn_form" type="submit" name="accion" value="Modificar">
	 <input class="btn_form" type="submit" name="accion" value="Grabar">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php } //1b?>
  <?php
 if(isset($_SESSION['eliminar'])){
 if ($_SESSION['eliminar'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $consulta  = "Delete From temp_ctable3 where temp_tip_tra = $cmone";
     $resultado = mysql_query($consulta);
	$consulta  = "Select * From temp_ctable3 order by temp_tip_tra";
    $resultado = mysql_query($consulta);?>
	<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Mod/Eli.</th>
	 
	  
	</tr>
   <?php
   $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
     $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
		       <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			  <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			  
			  
	     </tr>
	
     <?php }?>
         <tr>
		     <th><?php echo encadenar(3); ?></th>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>
     <center>
	 <input class="btn_form" type="submit" name="accion" value="Elimina_linea">   
	 <input class="btn_form" type="submit" name="accion" value="Modificar">
	 <input class="btn_form" type="submit" name="accion" value="Grabar">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php
 //}
 }
 }
} 
?>
<?php
    
if ($_SESSION['continuar'] == 3){
    if ($_SESSION['detalle'] == 3){
       $consulta  = "Select * From temp_ctable3";
       $resultado = mysql_query($consulta);
       $tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
       $con_temp = "Select * From temp_ctable3";
       $res_temp = mysql_query($con_temp);
	   while ($lin_temp = mysql_fetch_array($res_temp)) {
             $tot_debe_1 = round($tot_debe_1 +$lin_temp['temp_debe_1'],2);
	         $tot_haber_1 = round($tot_haber_1 +$lin_temp['temp_haber_1'],2);
	    }
			
	if ($tot_debe_1 <> $tot_haber_1) {	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	 <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th> 
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Mod/Eli.</th>
	 
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        //$tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        //$tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			 <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
			<td><INPUT NAME="nlin" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			
	     </tr>
	
    <?php }
	
	   echo "No iguala Debe y Haber Revise y Modifique ......... ";  ?>
	    <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
	   </table>
	<center>
	 <input class="btn_form" type="submit" name="accion" value="Retornar">
    
	   
	<?php    
	   
    }else{
  
  	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			 <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
	    </tr>
	
    <?php }
	
	   //echo "Revise Bien antes de Imprimir ......... ".encadenar(2). $_SESSION['descrip'];
       //echo $_SESSION['descrip'];
  
  ?>
   <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
  
  	</table>
	<center>
	 <input class="btn_form" type="submit" name="accion" value="Imprimir">
	 <!--input class="btn_form" type="submit" name="accion" value="Retornar"-->
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php
 }
  }
	} 

if(isset($_SESSION['modificar'])){ 
 if ($_SESSION['modificar'] == 1){
 
    $con_ctas1  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
    $res_ctas1 = mysql_query($con_ctas1); 
 
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 // echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $con_modi  = "Select * From temp_ctable3 where temp_tip_tra = $cmone";
     $res_modi = mysql_query($con_modi);
	   while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>

	 
	</tr>
		 
    <tr> 
	  <td align="left"><?php echo encadenar(2); ?></td> 
      <th align="left">Nueva Cuenta :</th>
	  <td> <select name="nue_cta" size="1"  >
	       <?php while ($lin_cta1 = mysql_fetch_array($res_ctas1)) { ?>
           <option value=<?php echo $lin_cta1['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta1['CONTA_CTA_NRO']; ?>
			              <?php echo $lin_cta1['CONTA_CTA_DESC']; ?></option>
           <?php } ?>
		    </select>
			</td>
	 <td align="left"><?php echo encadenar(50); ?></td> 		
	 </tr>	
 	  <tr>
	          <td align="left"><?php echo $lin_modi['temp_tip_tra']; ?></td> 
	 	      <td align="left"><?php echo $lin_modi['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $lin_modi['temp_des_cta']; ?></td>
	 </tr>
</table>
<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
 <tr>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
 </tr>

	 
	 <tr>		  
		      <td align="right"><input type="text" name="nue_deb1" align="right" size="10" 
			   value="<?php echo number_format($lin_modi['temp_debe_1'], 2, '.',','); ?>">
			  <td align="right"><input type="text" name="nue_hab1" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_haber_1'], 2, '.',','); ?>">	
			   <td align="right"><input type="text" name="nue_deb2" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_debe_2'], 2, '.',','); ?>">
			  <td align="right"><input type="text" name="nue_hab2" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_haber_2'], 2, '.',','); ?>">
			   <td align="right"><input type="text" name="nue_glo" align="right" 
			   value="<?php echo $lin_modi['temp_glosa2']; ?>">	 	 
	     </tr>
	</table>
	<input type="submit" name="accion" value="Grab_modi">

</form>		 
   <?php 
		 
	   }
	  
	 
	 
	 
	$consulta  = "Select * From temp_ctable3 order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	 
	 
	  
	</tr>	
		
   <?php
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	       <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	    </tr>
	 <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
  
  	</table>
	 <center>
 	
       <input type="submit" name="accion" value="Grabar">
       <!--input type="submit" name="accion" value="Salir"-->

  </form>
  
  
	 
	 <?php } //2b
	 
	 
	 
	 
	 
	  //}else{
	 //$_SESSION['continuar'] = 1;
	 //$_SESSION['calculo'] == 1; 
	// header('Location:cobro_pag_det_gd.php');
	 }  //1b
    // if(isset($_SESSION['grupo'])){
    //   $nom_grp =$_SESSION['grupo'];
	//   }
  }	// 1 b 
if ($_SESSION['continuar'] == 5){
    $nue_deb1 = 0;
    $nue_deb2 = 0;
	$nue_hab1 = 0;
    $nue_hab2 = 0;
	$nue_glo = "-";
     $nlin =  $_SESSION['cmone'];
     if ($_POST['nue_cta'] <> ""){ //4a  
	     $nue_cta = $_POST['nue_cta'];
		 $mon_cta = $nue_cta[5]; 
	     $_SESSION['nue_cta'] = $nue_cta;
	  }	//4b
      if ($_POST['nue_deb1'] > 0){ //5a  
	     $nue_deb1 = $_POST['nue_deb1'];
	  	 $_SESSION['nue_deb1'] = $nue_deb1;
	  } //5b
	  
	    if ($_POST['nue_hab1'] > 0){ //5a  
	     $nue_hab1 = $_POST['nue_hab1'];
	  	 $_SESSION['nue_hab1'] = $nue_hab1;
	  }
	  
      if ($_POST['nue_deb2'] > 0){ //5a  
	     $nue_hab2 = $_POST['nue_deb2'];
	  	 $_SESSION['nue_deb2'] = $nue_deb2;
	  } //5bb
	  
	    if ($_POST['nue_hab2'] > 0){ //5a  
	     $nue_hab2 = $_POST['nue_hab2'];
	  	 $_SESSION['nue_hab2'] = $nue_hab2;
	  }
	  
	  if ($_POST['nue_glo'] <> "-"){ //5a  
	     $nue_glo = $_POST['nue_glo'];
		  $nue_glo = strtoupper ($nue_glo);
	  	 $_SESSION['nue_glo'] = $nue_glo;
	  }
      if ($mon_cta == 2){ //8a
	     if ( $nue_deb2 > 0){ //9a     
            $nue_deb1 = round($nue_deb2 * $tc_ctb,2);
	        $nue_hab1 = 0;
	        }
		 if ($nue_hab2 > 0){ 
	        $nue_deb1 = 0;
	        $nue_hab1 = round($nue_hab2 * $tc_ctb,2);
	        } //8b
		 if ($nue_deb1 > 0){ //9a     
            $nue_deb2 = round($nue_deb1 / $tc_ctb,2);
	        $nue_hab2 = 0;
	        }	
		 if ($nue_hab1 > 0){ 
	        $nue_deb2 = 0;
	        $nue_hab2 = round($nue_hab1 / $tc_ctb,2);
	        } 
       } 
      $des_cta = leer_cta_des($nue_cta);
	//  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	 // $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "update temp_ctable3 set temp_nro_cta ='$nue_cta', 
                                          temp_des_cta ='$des_cta',
						 	              temp_debe_1 = $nue_deb1,
									      temp_haber_1 = $nue_hab1,
										  temp_debe_2 = $nue_deb2,
									      temp_haber_2 = $nue_hab2,
										  temp_glosa2 = '$nue_glo'
										  where temp_tip_tra = $nlin";
										   
    $resultado = mysql_query($consulta);
	
	$consulta  = "Select * From temp_ctable3";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	?>
	<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Mod/Eli.</th>
	  
	</tr>
	
	<?php
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			  <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
	     </tr>
	
     <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>
      <center>
	 <input type="submit" name="accion" value="Elimina_linea">   
	 <input type="submit" name="accion" value="Modificar">
	 <input type="submit" name="accion" value="Grabar">
     <!--input type="submit" name="accion" value="Salir"-->

</form>		
 <?php $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   
		   require 'con_asiento.php';
 } //1b?>
	
	
	 
</div>

</div>  
<?php
		// 	include("footer_in.php");
		 ?>
</body>
</html>
<?php
}
ob_end_flush();
 ?>