<?php
require('configuracion.php');
//require('funciones.php');
require('..\..\fpdf\fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Header();
class PDF extends FPDF
{
//Tabla simple
function BasicTable($header,$data)
{
    //Cabecera
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    //Datos
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}
//Una tabla más completa
function ImprovedTable($header,$nro_doc,$gestion)
{
    //Anchuras de las columnas
    $w=array(25,85,25,25,18,18);
    //Cabeceras
	 $this->SetFont('','B');

    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],0,0,'L');
    $this->Ln();
    //Datos
	 $this->SetFont('','');

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
		  if ($cuenta <> 0){
		     $desc = leer_cta_des($cuenta);
			 }else{
			 $desc = "";
			 }
	      $deb_hab =  $lin_cbt2['CONTA_TRS_DEB_CRED'];
	      
		  if ($deb_hab == 1){
		      $impo_1 = $lin_cbt2['CONTA_TRS_IMPO'];
	          $impoe_1 = $lin_cbt2['CONTA_TRS_IMPO_E'];
			}  
		  if ($deb_hab == 2){
		      $impo_2 = $lin_cbt2['CONTA_TRS_IMPO'];
	          $impoe_2 = $lin_cbt2['CONTA_TRS_IMPO_E'];
			}
		$desc = substr($desc,0,38);
	   $this->Cell($w[0],4,$cuenta,'LR');
        $this->Cell($w[1],4,$desc,'LR');
        $this->Cell($w[2],4,number_format($impo_1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[3],4,number_format($impo_2, 2, '.',','),'LR',0,'R');
		$this->Cell($w[4],4,number_format($impoe_1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[5],4,number_format($impoe_2, 2, '.',','),'LR',0,'R');
        $this->Ln();		
		 
			
		  $impo_t1 = $impo_t1 +  $impo_1;
	      $impoe_t1 = $impoe_t1 + $impoe_1;
	      $impo_t2 = $impo_t2 + $impo_2  ;
	      $impoe_t2 = $impoe_t2 +  $impoe_2; 
	}
	 $this->SetFont('','B');
	    $this->Cell($w[0],5,'','LR');
        $this->Cell($w[1],5,'Total','LR',0,'C');
        $this->Cell($w[2],5,number_format($impo_t1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[3],5,number_format($impo_t2, 2, '.',','),'LR',0,'R');
		$this->Cell($w[4],5,'','LR',0,'R');
        $this->Cell($w[5],5,'','LR',0,'R');
        $this->Ln();	
	 $this->SetFont('','');	
	
	//
  /*  foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    } */
    //Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
	$this->Ln(5);
	$this->Ln();
}
//Cargar los datos
function LoadData($file)
{
    //Leer las líneas del fichero
    $lines=file($file);
    $data=array();
    foreach($lines as $line)
        $data[]=explode(';',chop($line));
    return $data;
}

//Cabecera de página
function Header()
{
    $consulta  = "Select GRAL_EMP_NOMBRE,GRAL_EMP_CENTRAL From gral_empresa ";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
   $_SESSION['NOM_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
   $_SESSION['EMPRESA_TIPO']=$linea['GRAL_EMP_CENTRAL'];


    //Logo
   // $this->Image('logo_pb.png',10,8,33);
    //Arial bold 15
	
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
	$tip_cam = leer_tipo_cam_2($fec_ha2);
	$tip_cam = number_format($tip_cam, 2, '.',',');
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //Título
    $this->Cell(30,10,'LIBRO  DIARIO',0,0,'C');
    //Salto de línea
    $this->Ln(15);
	 $this->SetFont('Arial','B',12);
	$this->Cell(6,2, $_SESSION['NOM_EMPRESA'],0,0,''); 
	$this->Cell(70);
	 //Número de página
    $this->Cell(0,3,'Pagina:  '.$this->PageNo(100),0,0,'R');
	// $this->Ln(5);
	 
	 $this->Ln(5); 
	$this->Cell(6,2,'Desde',0,0,'');
	$this->Cell(10);
	$this->Cell(12,2, $fec_des,0,0,'');
	$this->Cell(12);
	$this->Cell(7,2,'Hasta',0,0,'');
	$this->Cell(8);
	$this->Cell(15,2, $fec_has,0,0,'');
	$this->Cell(70);
	$this->Cell(7,2,'Cambio $us.',0,0,'');
	$this->Cell(23);
	$this->Cell(25,2, $tip_cam,0,0,'');
	$this->Ln(7);
	$this->Cell(7,2,'Expresado en Bolivianos',0,0,'');
	$this->Ln(7);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,5,'Cuenta',1,0,'C');
	$this->Cell(85,5,'Descripcion',1,0,'C');
	$this->Cell(25,5,'Debe Bs.',1,0,'C');
	$this->Cell(25,5,'Haber Bs.',1,0,'C');
	$this->Cell(18,5,'Debe $us.',1,0,'C');
	$this->Cell(18,5,'Haber $us.',1,0,'C');
	$this->Ln(7);
	
	
}

//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
	
    //Número de página
    //$this->Cell(0,3,'Pag. '.$this->PageNo(100),0,0,'C');
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$linea = 'Imprimiendo línea número '."----"."mis datos";
 $pdf->Ln();
 $pdf->Ln();
//for($i=1;$i<=140;$i++)
//    $pdf->Cell(0,5,$linea.$i,0,1);
if (isset( $_SESSION['anio'])){
        $gestion = $_SESSION['anio'];
	   }else{
        $gestion = 2011;
    }
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
//$pdf->Cell(0,5,"Gestion".$gestion);	 
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
	
	/*      if ($gestion == 2010){		  
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
	
	
	} */
	$glosa = "-";
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
// $pdf->Ln();
 //      $pdf->Cell(0,5,"Comprobante Nro.   ".$nro_doc."                                            "."Fecha  ".$fecha,0,0);
	   // $pdf->Cell(0,5,"Fecha    ".$fecha,0,1);
	   //echo "Comprobante Nro.".encadenar(2).$nro_doc; 

	   //echo "Fecha".encadenar(2).$fecha;
	
	   //echo "Glosa ".encadenar(2).$glosa; 
	 
	   //echo $t_doc;
	   // $pdf->Ln();
	 
	// 	 $pdf->Cell(0,5,"Glosa   ".$glosa,0,1);
		// $pdf->Ln();
		// $pdf->Cell(0,5,"Tipo Doc.  ".$t_doc,0,1);
		//  $pdf->Ln();
          $fec_tra = $fecha; 
		  $fec_tr2 = cambiaf_a_mysql_2($fec_tra);
		  $tip_ca = leer_tipo_cam_2($fec_tr2);	
		  $tip_ca = number_format( $tip_ca, 2, '.',',');
		  $glosa = substr($glosa,0,36);	
		$header=array('Cbte. '.$nro_doc,$glosa,'T.C. '.$tip_ca,$t_doc,'         Fecha',$fecha);
//Carga de datos
//$data=$pdf->LoadData('paises.txt');
//$pdf->SetFont('Arial','',14);
//$pdf->AddPage();
$pdf->ImprovedTable($header,$nro_doc,$gestion);


		 
		 
		 
	 }
	
	






//$pdf->Cell(40,10,'¡Mi primera página pdf con FPDF!');
//$pdf->Ln();
//$pdf->Cell(40,10,'¡Hola, Mundo!',1);







$pdf->Output();

//Funciones

function cambiaf_a_mysql_2($fecha){
   $anio =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$anio."-".$mes."-".$dia; 
/*    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	*/ 
    return $lafecha; 
} 

function leer_tipo_cam_2($fecha) 
{
$cod_agen = $_SESSION['COD_AGENCIA'];
$consulta  = "SELECT * FROM gral_tipo_cambio where GRAL_TIP_CAM_AGEN = $cod_agen
              and GRAL_TIP_CAM_FECHA <= '$fecha' ORDER BY GRAL_TIP_CAM_FECHA DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
//$linea = mysql_fetch_array($resultado);
    while ($linea = mysql_fetch_array($resultado)) {
//	echo $linea['GRAL_TIP_CAM_CONTAB']."contab";
//	echo $linea['GRAL_TIP_CAM_COMPRA']."compra";
//	echo $linea['GRAL_TIP_CAM_VENTA']."venta";
    $_SESSION['TC_CONTAB'] = $linea['GRAL_TIP_CAM_CONTAB'];
	//$_SESSION['TC_COMPRA'] = $linea['GRAL_TIP_CAM_COMPRA'];
	//$_SESSION['TC_VENTA'] = $linea['GRAL_TIP_CAM_VENTA'];
	$tc_contab = $_SESSION['TC_CONTAB'];
	//echo $tc_contab;
	}
    return $tc_contab;
}
function cambiaf_a_normal($f_proc){
   
   $anio =  substr($f_proc, 0,4);
   $mes = substr($f_proc, 5,2);
   $dia = substr($f_proc, -2);
   $lafecha=$dia."/".$mes."/".$anio; 

    return $lafecha; 
}
 function encadenar($nespacios){ 
  $espacios = "";
  $solo = "&nbsp;";
  for($i=0;$i<$nespacios;$i++){ 
    $espacios=$espacios.$solo;//voy sumando espacios... 
  } 
  return $espacios;//devuelvo la cadena con todos los espacios 
} 

function leer_cta_des($cta){
 //echo $cta;
    $des_cta = 0;		  
	$con_ctad  = "Select CONTA_CTA_DESC From contab_cuenta where CONTA_CTA_NRO = $cta and CONTA_CTA_NIVEL = 'A' ";
    $res_ctad = mysql_query($con_ctad);
	while ($lin_ctad = mysql_fetch_array($res_ctad)) {
	      $des_cta = substr ($lin_ctad['CONTA_CTA_DESC'],0,39);
          }
	return $des_cta;
}





?> 

  
 