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
	require('d:\wamp\www\fpdf\fpdf.php');
?>
<html>
<head>
<title>Diario</title>

	<?php
			//include("header_d.php");
			?>
            
				<?php
					// $fec = leer_param_gral();
					// $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
            
<?php
class PDF extends FPDF
{
//Cabecera de página
function Header()
{
    //Logo
   // $this->Image('logo_pb.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //Título
    $this->Cell(30,10,'Libro Diario',1,0,'C');
    //Salto de línea
    $this->Ln(20);
}

//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);






$pdf->Cell(40,10,'¡Mi primera página pdf con FPDF!');
$pdf->Ln();
$pdf->Cell(40,10,'¡Hola, Mundo!',1);
//$pdf->Output();








//$_SESSION['continuar'] = 1;
//$_SESSION['detalle'] = 1;
if ($_SESSION['continuar'] == 1){
    $_SESSION['cuantos'] = 0;
	$_SESSION['saldo'] = 0;
	$_SESSION['saldo_sus'] = 0;
   // $borr_cob  = "Delete From temp_ctable3 "; 
   // $cob_borr = mysql_query($borr_cob)or die('No pudo borrar temp_ctable');
  //  }
		
//if ($_SESSION['detalle'] == 1){
    $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
    $res_ctas = mysql_query($con_ctas); ?>
	<center
	 <strong>Fecha Desde</strong>
     <input type="text" name="fec_des" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_des'
            });
            </script>
			 <BR><br>
		 <strong>Fecha Hasta</strong>
     <input type="text" name="fec_has" maxlength="10"  size="10" > <script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_has'
            });
            </script>		
	  <BR><br>
 
	 <center>
	    
	 <input type="submit" name="accion" value="Generar">
  </form>	
<?php  }
   
    
if ($_SESSION['continuar'] == 2){
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Header();






?>

<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
if (isset( $_SESSION['anio'])){
    $gestion = $_SESSION['anio'];
	}else{
     $gestion = 2011;

}



//$cuantos = 0;
$m_debe_1 = 0;
$m_haber_1 = 0;
$m_debe_2 = 0;
$m_haber_2 = 0;
$t_debe_1 = 0;
$t_haber_1 = 0;
$t_debe_2 = 0;
$t_haber_2 = 0;
$mon_cta = 0;
$saldo = 0;
$saldo_sus = 0;
$sal_1 = 0;
$sal_2 = 0;
 //1a
    /* if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }*/	//4b
     if (isset ($_POST['fec_des'])){
	     $fec_des = $_POST['fec_des'];
		 $_SESSION['fec_des'] = $fec_des;
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
		 $_SESSION['fec_de2'] = $fec_de2;
	 }
     if (isset ($_POST['fec_has'])){
	     $fec_has = $_POST['fec_has'];
		 $_SESSION['fec_has'] = $fec_has;
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
		 $_SESSION['fec_ha2'] = $fec_ha2;
	 }
	/* 
		 */
	?>	
	  
		
	 
	<?php
	if ($gestion == 2010){
	$con_cbt  = "Select DISTINCT CONTA_TRS_NRO,CONTA_TRS_FEC_VAL,CONTA_TRS_TIPO
	              From contab_t2010 where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_FEC_VAL',CONTA_TRS_NRO";
	}else{			  
	$con_cbt  = "Select DISTINCT CONTA_TRS_NRO,CONTA_TRS_FEC_VAL,CONTA_TRS_TIPO
	              From contab_trans where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_FEC_VAL',CONTA_TRS_NRO";			  
	}			  
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	   if ($_SESSION['nro_pag'] > 21){
			include("header_d.php");
		}	
	      $nro_doc = $lin_cbt['CONTA_TRS_NRO'];
		  $fecha = $lin_cbt['CONTA_TRS_FEC_VAL'];
		  $fecha = cambiaf_a_normal($fecha);
		  $tip_doc = $lin_cbt['CONTA_TRS_TIPO'];
		 		  
		  if ($tip_doc == 1){
		      $t_doc = "Manual";
			  }
		   if ($tip_doc == 2){
		      $t_doc = "Automatico";
			  }
			  
	if ($gestion == 2010){		  
	$con_glo  = "Select CONTA_TRS_GLOSA
	              From contab_t2010 where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_NRO =  $nro_doc
				  and CONTA_TRS_USR_BAJA is null";
	}else{			  
	$con_glo  = "Select CONTA_TRS_GLOSA
	              From contab_trans where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_NRO =  $nro_doc
				  and CONTA_TRS_USR_BAJA is null";			  
	}			  
    $res_glo = mysql_query($con_glo);
	while ($lin_glo = mysql_fetch_array($res_glo)) {
	      $glosa = $lin_glo['CONTA_TRS_GLOSA'];
	
	
	}	
if (substr($glosa,0,1) == "-"){		  
	if ($gestion == 2010){		  
	$con_glo  = "Select CONTA_CAB_GLOSA
	              From contab_c2010 where (CONTA_CAB_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_CAB_NRO =  $nro_doc
				  and CONTA_CAB_USR_BAJA is null";
	}else{			  
	$con_glo  = "Select CONTA_CAB_GLOSA
	              From contab_cabec where (CONTA_CAB_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_CAB_NRO =  $nro_doc
				  and CONTA_CAB_USR_BAJA is null";			  
	}			  
    $res_glo = mysql_query($con_glo);
	while ($lin_glo = mysql_fetch_array($res_glo)) {
	      $glosa = $lin_glo['CONTA_CAB_GLOSA'];
	
	
	}
}	
	
?>
<br>
<?php
     $_SESSION['nro_pag'] = $_SESSION['nro_pag'] + 1;
?>	 

<table width="85%"  border="0" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="60%" scope="col" align="left"><border="0" alt="" align="absmiddle" />
	   <?php echo "Comprobante Nro.".encadenar(2).$nro_doc;?>  </th>
	  <th width="40%" scope="col" align="right"><border="0" alt="" align="absmiddle" /> 
	   <?php echo "Fecha".encadenar(2).$fecha;?></th>
	 </tr>
	  <tr>
      <th width="60%" scope="col" align="left"><border="0" alt="" align="absmiddle" />
	   <?php echo "Glosa ".encadenar(2).$glosa;?>  </th>
	  <th width="40%" scope="col" align="right"><border="0" alt="" align="absmiddle" /> 
	   <?php echo $t_doc;?></th>
	 </tr> 	 	
 </table>
 <?php
     $_SESSION['nro_pag'] = $_SESSION['nro_pag'] + 2;
?>
<table width="85%"  border="1" align="center">
    <tr>
      <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA  </th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="5%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr> 
	
	<?php
     $_SESSION['nro_pag'] = $_SESSION['nro_pag'] + 1;
?>
	 
	 </center> 
	<?php
	// echo "Glosa ".encadenar(2).$glosa;
	 ?>
	 
	 <?php 	
	$impo_t1 = 0;
	$impoe_t1 = 0;
	$impo_t2 = 0;
	$impoe_t2 = 0;
	if ($gestion == 2010){
	$con_cbt2  = "Select *
	              From contab_t2010 where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
	}else{
	$con_cbt2  = "Select *
	              From contab_trans where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
	}			  			  
    $res_cbt2 = mysql_query($con_cbt2);
	while ($lin_cbt2 = mysql_fetch_array($res_cbt2)) {
	      
	      $impo_1 = 0;
	      $impoe_1 = 0;
		  $impo_2 = 0;
	      $impoe_2 = 0;
		  $tip_doc = $lin_cbt2['CONTA_TRS_TIPO'];
		  if ($tip_doc == 1){
		      $t_doc = "Manual";
			  }
		   if ($tip_doc == 2){
		      $t_doc = "Automatico";
			  }
		   	  
			  
			  	  
		  $glosa_ind =  $lin_cbt2['CONTA_TRS_GLOSA']; 	  
	      $cuenta = $lin_cbt2['CONTA_TRS_CTA'];
		  $desc = leer_cta_des($cuenta);
	      $deb_hab =  $lin_cbt2['CONTA_TRS_DEB_CRED'];
	      
		  if ($deb_hab == 1){
		      $impo_1 = $lin_cbt2['CONTA_TRS_IMPO'];
	          $impoe_1 = $lin_cbt2['CONTA_TRS_IMPO_E'];
			}  
		  if ($deb_hab == 2){
		      $impo_2 = $lin_cbt2['CONTA_TRS_IMPO'];
	          $impoe_2 = $lin_cbt2['CONTA_TRS_IMPO_E'];
			}
			
		 
			
		  $impo_t1 = $impo_t1 +  $impo_1;
	      $impoe_t1 = $impoe_t1 + $impoe_1;
	      $impo_t2 = $impo_t2 + $impo_2  ;
	      $impoe_t2 = $impoe_t2 +  $impoe_2;  
	 
	?>
	 <?php
     $_SESSION['nro_pag'] = $_SESSION['nro_pag'] + 1;
?>
	
	
	
	
	
	 <tr>
	 	      <td align="left"><?php echo $_SESSION['nro_pag'].encadenar(2).$cuenta; ?></td>
			  <td align="left"><?php echo $desc; ?>
			  <br><?php echo $glosa_ind; ?> </td>
		      <td align="right"><?php echo number_format($impo_1, 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($impo_2, 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($impoe_1, 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($impoe_2, 2, '.',','); ?></td>
	     </tr>
		
	<?php }  ?>
	 <tr>
	 	      <th align="left"><?php echo encadenar(2); ?></td>
			  <th align="left"><?php echo "Totales"; ?></td>
		      <th align="right"><?php echo number_format($impo_t1, 2, '.',',') ; ?></td>
		      <th align="right"><?php echo number_format($impo_t2, 2, '.',','); ?></td>
		      <th align="right"><?php echo number_format($impoe_t1, 2, '.',',') ; ?></td>
		      <th align="right"  ><?php echo number_format($impoe_t2, 2, '.',','); ?></td>
	     </tr>
		</table>
		<?php
}

?>


	<?php

}
?>
	 
	<?php 


 //1b?>
	
	
	 

  <?php
    $pdf->Output();
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>