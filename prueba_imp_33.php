<?php
ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
require('configuracion.php');
require('\..\fpdf\fpdf.php');
 $_SESSION['nro']=0;
$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
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
function ImprovedTable($header,$saldo,$saldo_sus)
{
    //Anchuras de las columnas
    $w=array(8,25,65,15,16,16,15,16,16,6);
    //Cabeceras
	 $this->SetFont('','B');


    for($i=0;$i<count($header);$i++)
       $this->Cell($w[$i],0,$header[$i],1,0,'L');
       $this->Ln();
    //Datos
	   $this->SetFont('Arial','',6);
	   $consulta  = "Select * From temp_ctable3 order by temp_cuenta,temp_tip_tra";
       $resultado = mysql_query($consulta);
	   $fec_de2 = $_SESSION['fec_de2'];
	   $fec_ha2 = $_SESSION['fec_ha2'];
	   $gestion = $_SESSION['gestion'];
	 // $this->Cell($w[0],6,$gestion,'LR');
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = "";
	$cuenta2 = "";
	 $tot_1 = 0;
	 $tot_2 = 0;
	while ($linea = mysql_fetch_array($resultado)) { //1
	       $tot_1 = 0;
           $tot_2 = 0;
	      $cuenta2 = $linea['temp_cuenta'];
		    $tip_cta_1 = $cuenta2[0];
		 if ($cuenta1 == ""){ //2	
			$tot_1 = sal_mayor2( $cuenta2,$fec_ha2,1,$gestion);
			 $tot_2 = sal_mayor2($cuenta2,$fec_ha2,2,$gestion);
			 }else{ 
			 $tot_1 = sal_mayor2( $cuenta1,$fec_ha2,1,$gestion);
			 $tot_2 = sal_mayor2($cuenta1,$fec_ha2,2,$gestion);
			 } //2b
			//echo $tip_cta_1."tip";
	     if ($cuenta1 <> $cuenta2){ //3
	         $tipo_cta = substr($cuenta2,0,1);
	         $des_cta = leer_cta_des($cuenta2);
			
		     $saldo = sal_mayor( $cuenta2,$fec_de2,1,$gestion);
			 $sal_1 = $saldo;
			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2,$gestion);
			 if ($tipo_cta > 3){ //4		
			     $saldo_sus = 0; 	
		       } //4b
			 $sal_2 = $saldo_sus;
			 $_SESSION['saldo'] = $saldo;
	         $_SESSION['saldo_sus'] = $saldo_sus; 
	  
             if ($cuenta1 <> ""){ //5
	             $tipo_cta = substr($cuenta1,0,1);
	             if ($tipo_cta > 3){ //6		
		            $tot_2 = 0; 	
		         } //6b
				 $this->SetFont('Arial','B',10);
	             $this->Cell($w[0],6,' ','LR');
				 $this->Cell($w[1],6,' ','LR');
                 $this->Cell($w[2],6,'Saldo Final','LR');
				 $this->SetFont('Arial','B',6);
                 $this->Cell($w[3],6,number_format($tot_debe_1, 2, '.',','),'LR',0,'R');
                 $this->Cell($w[4],6,number_format($tot_haber_1, 2, '.',','),'LR',0,'R');
		         $this->Cell($w[5],6,number_format($tot_1, 2, '.',','),'LR',0,'R');
                 $this->Cell($w[6],6,number_format($tot_debe_2, 2, '.',','),'LR',0,'R');
                 $this->Cell($w[7],6,number_format($tot_haber_2, 2, '.',','),'LR',0,'R');
		         $this->Cell($w[8],6,number_format($tot_2, 2, '.',','),'LR',0,'R');
				 $this->Cell($w[9],6,'','LR');
				 $this->SetFont('Arial','',6);
                 $this->Ln();
			//	  		
		         $tot_debe_1 = 0;
                 $tot_haber_1 = 0;
                 $tot_debe_2 = 0;
                 $tot_haber_2 = 0;
	         } //5b 
			// $this->Cell(array_sum($w),0,'','T');	
	         $this->SetFont('Arial','B',8);
	         $this->Cell($w[0],6,' ','LR');
             $this->Cell($w[1],6,$cuenta2,'LR');
             $this->Cell($w[2],6,$des_cta,'LR',0,'L');
			 $this->Cell($w[3],6,'','LR');
			 $this->Cell($w[4],6,'','LR');
			 $this->Cell($w[5],6,'','LR');
			 $this->Cell($w[6],6,'','LR');
			 $this->Cell($w[7],6,'','LR');
			 $this->Cell($w[8],6,'','LR');
			 $this->Cell($w[9],6,'','LR');
			  $this->SetFont('Arial','',6);
             $this->Ln();
			 $_SESSION['cuenta']=$cuenta2;
			 $_SESSION['nro'] =$_SESSION['nro'] + 1;			 
	    	 $cuenta1 = $cuenta2;
			 $this->SetFont('Arial','B',8);
			 $this->Cell($w[0],6,'','LR');
			 $this->Cell($w[1],6,'','LR');
	         $this->Cell($w[2],6,'Saldo Inicial al '.'  '.$_SESSION['fec_des'],'LR');
             $this->Cell($w[3],6,'','LR');
			 $this->Cell($w[4],6,'','LR');
			 $this->SetFont('Arial','B',6);
	         $this->Cell($w[5],6,number_format($saldo, 2, '.',','),'LR',0,'R');
			 $this->Cell($w[6],6,'','LR');
			 $this->Cell($w[7],6,'','LR');
	         $this->Cell($w[8],6,number_format($saldo_sus, 2, '.',','),'LR',0,'R');
			 $this->Cell($w[9],6,'','LR');
			  $this->SetFont('Arial','',6);
             $this->Ln();
	    } //3b
	      $tip_cta = $cuenta2[0];
		  $_SESSION['cuenta']=$cuenta1;
			 $_SESSION['nro'] =$_SESSION['nro'] + 1;	
 	      if ($tip_cta == 1){ //7  
	          $sal_1 = $sal_1 + $linea['temp_debe_1'] - $linea['temp_haber_1'];
		      $sal_2 = $sal_2 + $linea['temp_debe_2'] - $linea['temp_haber_2'];	
			  } //7b 
	     
          if ($tip_cta == 5){  //8 
	         $sal_1 = $sal_1 + $linea['temp_debe_1'] - $linea['temp_haber_1'];
		     $sal_2 = $sal_2 + $linea['temp_debe_2'] - $linea['temp_haber_2'];	
		     }   //8b
           if ($tip_cta == 6){  //8 
	         $sal_1 = $sal_1 + $linea['temp_debe_1'] - $linea['temp_haber_1'];
		     $sal_2 = $sal_2 + $linea['temp_debe_2'] - $linea['temp_haber_2'];	
		     }  
	      if ($tip_cta == 2){ //9  
	         $sal_1 = $sal_1 - $linea['temp_debe_1'] + $linea['temp_haber_1'];
		     $sal_2 = $sal_2 - $linea['temp_debe_2'] + $linea['temp_haber_2'];	 
		     } //9b
	      if ($tip_cta == 3){ //10  
	          $sal_1 = $sal_1 - $linea['temp_debe_1'] + $linea['temp_haber_1'];
		      $sal_2 = $sal_2 - $linea['temp_debe_2'] + $linea['temp_haber_2'];	 
		     }  //10b
	      if ($tip_cta == 4){  //11 
	         $sal_1 = $sal_1 - $linea['temp_debe_1'] + $linea['temp_haber_1'];
		     $sal_2 = $sal_2 - $linea['temp_debe_2'] + $linea['temp_haber_2'];	
		   } //11b
	   
	    
	      $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; 
		  $fec_tra = $linea['temp_nro_cta']; 
		  $fec_tr2 = cambiaf_a_mysql_2($fec_tra);
		  $tip_ca = leer_tipo_cam_2($fec_tr2);
		  $this->Cell($w[0],4,$linea['temp_tip_tra'],'LR');
          $this->Cell($w[1],4,$linea['temp_nro_cta'],'LR');
		  $this->Cell($w[2],4,substr($linea['temp_des_cta'],0,59),'LR');
          $this->Cell($w[3],4,number_format($linea['temp_debe_1'], 2, '.',','),'LR',0,'R');
          $this->Cell($w[4],4,number_format($linea['temp_haber_1'], 2, '.',','),'LR',0,'R');
		  $this->Cell($w[5],4,number_format($sal_1, 2, '.',','),'LR',0,'R');
          $this->Cell($w[6],4,number_format($linea['temp_debe_2'], 2, '.',','),'LR',0,'R');
          $this->Cell($w[7],4,number_format($linea['temp_haber_2'], 2, '.',','),'LR',0,'R');
		  $this->Cell($w[8],4,number_format($sal_2, 2, '.',','),'LR',0,'R');
		  $this->Cell($w[9],4,number_format($tip_ca, 2, '.',','),'LR',0,'R'); 
          $this->Ln();
	   } // 1b 
  //} 
        $tot_1 = sal_mayor2( $cuenta2,$fec_ha2,1,$gestion);
        $tot_2 = sal_mayor2( $cuenta2,$fec_ha2,2,$gestion);
		$this->SetFont('Arial','B',10);
        $this->Cell($w[0],6,' ','LR');
		$this->Cell($w[1],6,' ','LR');
        $this->Cell($w[2],6,'Saldo Final','LR');
		$this->SetFont('Arial','B',6);
        $this->Cell($w[3],6,number_format($tot_debe_1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[4],6,number_format($tot_haber_1, 2, '.',','),'LR',0,'R');
		$this->Cell($w[5],6,number_format($tot_1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[6],6,number_format($tot_debe_2, 2, '.',','),'LR',0,'R');
        $this->Cell($w[7],6,number_format($tot_haber_2, 2, '.',','),'LR',0,'R');
		$this->Cell($w[8],6,number_format($tot_2, 2, '.',','),'LR',0,'R');
		$this->Cell($w[9],6,'','LR');
		$this->SetFont('Arial','',6);
        $this->Ln();
//	}	
		
			
  
	 
/*
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
	   $this->Cell($w[0],6,$cuenta,'LR');
        $this->Cell($w[1],6,$desc,'LR');
        $this->Cell($w[2],6,number_format($impo_1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[3],6,number_format($impo_2, 2, '.',','),'LR',0,'R');
		$this->Cell($w[4],6,number_format($impoe_1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[5],6,number_format($impoe_2, 2, '.',','),'LR',0,'R');
        $this->Ln();		
		 
			
		  $impo_t1 = $impo_t1 +  $impo_1;
	      $impoe_t1 = $impoe_t1 + $impoe_1;
	      $impo_t2 = $impo_t2 + $impo_2  ;
	      $impoe_t2 = $impoe_t2 +  $impoe_2; 
	}
	 $this->SetFont('','B');
	    $this->Cell($w[0],6,'','LR');
        $this->Cell($w[1],6,'Total','LR',0,'C');
        $this->Cell($w[2],6,number_format($impo_t1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[3],6,number_format($impo_t2, 2, '.',','),'LR',0,'R');
		$this->Cell($w[4],6,number_format($impoe_t1, 2, '.',','),'LR',0,'R');
        $this->Cell($w[5],6,number_format($impoe_t2, 2, '.',','),'LR',0,'R');
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
//}
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

$nro = $_SESSION['nro'];
$consulta  = "Select GRAL_EMP_NOMBRE,GRAL_EMP_CENTRAL From gral_empresa ";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
   $_SESSION['NOM_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
   $_SESSION['EMPRESA_TIPO']=$linea['GRAL_EMP_CENTRAL'];
   if (isset ($_SESSION['fec_des'])){
	     $fec_des = $_SESSION['fec_des'];
		// $_SESSION['fec_des'] = $fec_des;
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
		 $_SESSION['fec_de2'] = $fec_de2;
	 }
     if (isset ($_SESSION['fec_has'])){
	     $fec_has = $_SESSION['fec_has'];
		// $_SESSION['fec_has'] = $fec_has;
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
		 $_SESSION['fec_ha2'] = $fec_ha2;
	 }
	$tip_cam = leer_tipo_cam_2($fec_ha2);
	$tip_cam = number_format($tip_cam, 2, '.',',');
	
	 if (isset($_SESSION['cod_cta'])){ //4a  
	     $cod_cta3 =  $_SESSION['cod_cta'];
		// $mon_cta = $cod_cta[5]; 
	    // $_SESSION['cod_cta'] = $cod_cta;
		
	  }	//4b
	  if (isset($_SESSION['cod_cta2'])){ //4a  
	     $cod_cta2 =  $_SESSION['cod_cta2'];
		// $mon_cta2 = $cod_cta[5]; 
	    // $_SESSION['cod_cta2'] = $cod_cta2;
		
	  }	//4b
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //Título
    $this->Cell(30,10,'MAYORES GENERALES',0,0,'C');
    //Salto de línea
    $this->Ln(15);
	 $this->SetFont('Arial','B',12);
	$this->Cell(6,2, $_SESSION['NOM_EMPRESA'],0,0,''); 
	$this->Cell(70);
	 //Número de página
    $this->Cell(0,3,'Pagina:  '.$this->PageNo(),0,0,'R');
	 $this->Ln(5);
	 
	     
		
	// $nro_pag = PageNo();
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
	$this->SetFont('Arial','B',8);
	$this->Cell(8,5,'Cbte.',1,0,'C');
	$this->Cell(25,5,'Fecha',1,0,'C');
	$this->Cell(65,5,'Descripcion',1,0,'C');
	$this->Cell(15,5,'Debe Bs.',1,0,'C');
	$this->Cell(16,5,'Haber Bs.',1,0,'C');
	$this->Cell(16,5,'Saldo Bs.',1,0,'C');
	$this->Cell(15,5,'Debe $us.',1,0,'C');
	$this->Cell(16,5,'Haber $us.',1,0,'C');
	$this->Cell(16,5,'Saldo $us.',1,0,'C');
	$this->Cell(6,5,'T.C.',1,0,'C');
	$this->Ln(5);
	if ($nro > 1){
	$cuenta = $_SESSION['cuenta'];
	     $des_cta = leer_cta_des($cuenta);
	$this->Cell(10,5,'Cta',1,0,'C');
	$this->Cell(15,5,$cuenta,1,0,'C');
	$this->Cell(75,5,$des_cta,1,0,'L');
	$this->Cell(15,5,'',1,0,'C');
	$this->Cell(16,5,'',1,0,'C');
	$this->Cell(16,5,'',1,0,'C');
	$this->Cell(15,5,'',1,0,'C');
	$this->Cell(16,5,'',1,0,'C');
	$this->Cell(16,5,'',1,0,'C');
	$this->Cell(6,5,'',1,0,'C');
	$this->Ln(5);
	}
}

//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
 //   $this->Cell(0,3,'Pag. '.$this->PageNo(100),0,0,'C');
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$linea = 'Imprimiendo línea número '."----"."mis datos";
 $pdf->Ln();
 $pdf->Ln();
// $pdf->Cell(0,5,'Entra',0,1);
$saldo = 0;
$saldo_sus = 0;





 if (isset ($_SESSION['fec_des'])){
	     $fec_des = $_SESSION['fec_des'];
		// $_SESSION['fec_des'] = $fec_des;
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
		 $_SESSION['fec_de2'] = $fec_de2;
	 }
     if (isset ($_SESSION['fec_has'])){
	     $fec_has = $_SESSION['fec_has'];
		// $_SESSION['fec_has'] = $fec_has;
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
		 $_SESSION['fec_ha2'] = $fec_ha2;
	 }
if (isset($_SESSION['cod_cta'])){ //4a  
	     $cod_cta3 =  $_SESSION['cod_cta'];
		// $mon_cta = $cod_cta[5]; 
	    // $_SESSION['cod_cta'] = $cod_cta;
		
	  }	//4b
	  if (isset($_SESSION['cod_cta2'])){ //4a  
	     $cod_cta2 =  $_SESSION['cod_cta2'];
		// $mon_cta2 = $cod_cta[5]; 
	    // $_SESSION['cod_cta2'] = $cod_cta2;
		
	  }	//4b

$header=array('','','','','','','','','');

$pdf->ImprovedTable($header,$saldo,$saldo_sus);
// }
//}	
//}	






//$pdf->Cell(40,10,'¡Mi primera página pdf con FPDF!');
//$pdf->Ln();
//$pdf->Cell(40,10,'¡Hola, Mundo!',1);







$pdf->Output();

//Funciones

function cambiaf_a_mysql_2($fecha){
   $gestion =  substr($fecha, -4);
   $mes = substr($fecha, 3,2);
   $dia = substr($fecha, 0,2);
   $lafecha=$gestion."-".$mes."-".$dia; 
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
   
   $gestion =  substr($f_proc, 0,4);
   $mes = substr($f_proc, 5,2);
   $dia = substr($f_proc, -2);
   $lafecha=$dia."/".$mes."/".$gestion; 

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
	      $des_cta = $lin_ctad['CONTA_CTA_DESC'];
          }
	return $des_cta;
}
function sal_mayor2($cta,$fec_cal,$mon,$gestion) 
{
$debe = 0;
$haber = 0;
$debe_2 = 0;
$haber_2 = 0;
//$gestion = 2010;
if ($gestion == 2010){	
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";
	}else{	
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";	
	}						   					   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
	if ($gestion == 2010){					
				  $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA = '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null ";
	}else{	
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";	
	}						   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			} 
$tip = substr($cta,0,1);
//echo $tip;

					
if ($mon == 1){						
    $saldo = $debe - $haber;
	}
if ($mon == 2){						
    $saldo =  $debe_2 - $haber_2;
	}
	
if ($tip == '5'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}
if ($tip == '2'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}	
if ($tip == '3'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}	
	
//echo "func".$saldo;
return $saldo;		
}
function sal_mayor($cta,$fec_cal,$mon,$gestion) 
{
$debe = 0;
$haber = 0;
$debe_2 = 0;
$haber_2 = 0;
//$gestion = 2010;
if ($gestion == 2010){	
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";
}else{								   
$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";	
	}						   						   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
						
	if ($gestion == 2010){	
                 $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA= '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";
	}else{						   
							   					
				  $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA = '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";
	}						   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			} 
$tip = substr($cta,0,1);
//echo $tip;

					
if ($mon == 1){						
    $saldo = $debe - $haber;
	}
if ($mon == 2){						
    $saldo =  $debe_2 - $haber_2;
	}
	
if ($tip == '5'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}
if ($tip == '2'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}
if ($tip == '3'){	
//echo "aqui".$haber, $debe;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
}		
//echo "func".$saldo;
return $saldo;		
}




?> 

  
 