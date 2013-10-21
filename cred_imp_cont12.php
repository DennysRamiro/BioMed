<?php
ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
require('configuracion.php');
//require('funciones.php');
require('e:\wamp\www\fpdf\fpdf.php');

$pdf=new FPDF('P','mm','Legal');

$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->SetMargins(20, 15, 0);
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
    $w=array(10,15,75,15,16,16,15,16,16,6);
    //Cabeceras
	 $this->SetFont('','B');

    for($i=0;$i<count($header);$i++)
      // $this->Ln();
    //Datos
	   $logi = $_SESSION['login']; 
       $nro_sol = $_SESSION['nro_sol'];
       $datos = $_SESSION['form_buffer'];
	    $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa')  ;
		  while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
	   
	    $this->SetFont('Arial','B',12);
		
		 if ($_SESSION['EMPRESA_TIPO'] == 1){
		     $donde = "Ciudad de Cochabamba";
			 }else{
			 $donde = "Ciudad de Quillacollo";
		 }
		
		
    //Movernos a la derecha
  //  $this->Cell(80);
    //Título
	$txt1 ="                               CONTRATO PRIVADO DE PRESTAMO DE DINERO";
   $this->MultiCell(0,5,$txt1);
	   
	   
	   $this->SetFont('Arial','',8);
	    $this->MultiCell(0,5,'');
	   $txt = 'Conste por el contenido del presente contrato de préstamo de dinero, otorgada a “LOS DEUDORES” de forma mancomunada, solidaria e indivisible que con el solo reconocimiento de firmas y rúbricas ante autoridad competente surtirá los efectos que la ley le otorga y se suscribe de acuerdo a las siguientes cláusulas:';
	   $this->MultiCell(0,5,$txt);
	   $this->SetFont('Arial','BU',8); 
	   $txt1 ="PRIMERA.- (CONTRATANTES)";
	  $this->SetFont('Arial','',8);
	    $txt2 = 'Intervienen en la celebración del presente contrato:';
		 $this->MultiCell(0,5,$txt1.' '.$txt2);
		 if ($_SESSION['EMPRESA_TIPO'] == 1){
		  $txt = 'a).- '.' '.$emp_ger.' con '.$emp_cig.'., con domicilio en '.$emp_dir. ' de la '. $donde.', quien en adelante y para fines del presente contrato se denominara “EL ACREEDOR". ';
		  }
		   if ($_SESSION['EMPRESA_TIPO'] == 2){
		  $txt = 'a).- '.' PRODEMIC S.R.L., empresa legalmente constituida y representada por el   '.$emp_ger.' con '.$emp_cig.'., con domicilio en '.$emp_dir. ' de la '. $donde.', quien en adelante y para fines del presente contrato se denominara “EL ACREEDOR". ';
		  }
		  $this->SetFont('Arial','',8);
		   $this->MultiCell(0,5,$txt);
	
	//Caracteristicas del Crédito
	$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
   $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $icom  = $lin_sol['CRED_SOL_IMP_COM'];
		 $i_mes  = round($lin_sol['CRED_SOL_TASA']/ 12,2);
		 $plz_m  = $lin_sol['CRED_SOL_PLZO_M'] * 4;
		 $n_cta  = $lin_sol['CRED_SOL_NRO_CTA'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG'];
		 $l_cta = substr(f_literal($n_cta,2),0,3); 
		 $imes_i = f_literal($i_mes,2); 
		 if ($mon == 1){
		    $mon_t = "moneda nacional";
			}else{
			$mon_t = "moneda extranjera";
			} 
		 $con_mon = "Select GRAL_PAR_INT_DESC,GRAL_PAR_INT_SIGLA From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and                     GRAL_PAR_INT_COD = $mon ";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_mon = mysql_fetch_array($res_mon)) {
		        $mon_d = $lin_mon['GRAL_PAR_INT_DESC'];
				$mon_s = $lin_mon['GRAL_PAR_INT_SIGLA'];
		  }
	 	 $con_com = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911 and GRAL_PAR_PRO_COD = $comi ";
         $res_com = mysql_query($con_com)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_com = mysql_fetch_array($res_com)) {
		        $com_d = $lin_com['GRAL_PAR_PRO_DESC'];
				$com_f = $lin_com['GRAL_PAR_PRO_CTA1'];
		  }
		  $con_top = "Select GRAL_PAR_INT_DESC  From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and          GRAL_PAR_INT_COD = $t_op ";
         $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_top = mysql_fetch_array($res_top)) {
		        $top_d = $lin_top['GRAL_PAR_INT_DESC'];
				}
		  $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  }
		  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 3')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  } 
	}
	//Deudores	  
	$consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO,CLIENTE_AP_ESPOSO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES, CRED_DEU_RELACION, CLIENTE_DIRECCION From cliente_general, cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
    if ($comif == 2){
       $impo1 = $impo + $icom;
	   }else{
	   $impo1 = $impo;
	  }
	$impo = number_format($impo1, 2, '.',',');
	$imp_l = f_literal($impo1,1); 
	$i_mes1 = number_format($i_mes, 2, '.',','); 
	$imes_i = f_literal($i_mes,2); 
	$plz_m = number_format($plz_m, 0, '.',',');
	$plz_i = f_literal($plz_m,3); 
	$nrod_i = f_literal($nro_d,3); 
	$deudores ="";
	$deudor ="";
while ($linea = mysql_fetch_array($resultado)) {
      if (ltrim($linea['CLIENTE_DIRECCION']) <> ""){
	      $direc = "con domicilio en ".$linea['CLIENTE_DIRECCION'].",";
		  }else{
          $direc = "con domicilio en calle innominada de la ".$donde.",";
          }
if (isset($linea['CLIENTE_AP_ESPOSO'])){
     $deudores = $deudores." ". $linea['CLIENTE_NOMBRES']. " ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'].
	 " de ".$linea['CLIENTE_AP_ESPOSO'].
	  " con CI"." ".$linea['CLIENTE_COD_ID']."  ".$direc; 
	  $deudor = $deudor." ". $linea['CLIENTE_NOMBRES']. " ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'].
	  ." de ".$linea['CLIENTE_AP_ESPOSO'].", ";

}else{
      $deudores = $deudores." ". $linea['CLIENTE_NOMBRES']. " ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'].
	  " con CI"." ".$linea['CLIENTE_COD_ID']."  ".$direc; 
	  $deudor = $deudor." ". $linea['CLIENTE_NOMBRES']. " ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'].", ";
}
}	 
	$txt = 'b).- Las señoras(es): '. $deudores.' '.'todos mayores de edad y hábiles para contratar, a quienes para todo efecto de este contrato se les denominará  "LOS DEUDORES."'; 	 
	  $this->MultiCell(0,5,$txt);	 
	 $txt = 'SEGUNDA.- (DEL PRÉSTAMO).'.' "EL ACREEDOR" otorga en calidad de préstamo a "LOS DEUDORES", la suma de'.'  '.
	 $mon_s. ' '. $impo.' ('. $imp_l .' ' .$mon_d. '), '.'en adelante denominado "EL PRÉSTAMO", monto que "LOS DEUDORES" declaran haber recibido en su integridad  a su entera satisfacción y conformidad, a tiempo de la suscripción del presente documento, el cual se reputa como suficiente recibo y constancia de recepción del dinero prestado.';
		 $this->MultiCell(0,5,$txt);	 
	 $txt = 'TERCERA.- (INTERESES Y CARGOS). "EL PRÉSTAMO" objeto del presente contrato, devengará a favor de "EL ACREEDOR" un interés mensual fijo de '.$i_mes1. ' %  ('. $imes_i.' por ciento), que se pagará en forma conjunta con el capital. En caso de incumplimiento en cualquiera de las amortizaciones, los intereses penales se aplicaran de acuerdo a la escala legal vigente, durante el periodo que dure el incumplimiento.';	 
	  $this->MultiCell(0,5,$txt);
	 $txt = 'CUARTA.- (PLAZO Y FORMA DE PAGO). "LOS DEUDORES", se obligan a pagar y rembolsar a "EL ACREEDOR" el préstamo concedido a que se refiere este contrato, en el plazo de '.$plz_m. '  ('.$plz_i.')'. ' semanas contando a partir de la fecha de suscripción del presente documento, mediante el pago de '.$n_cta.' ('.$l_cta. ') amortización, que se cancelará al vencimiento del plazo pactado. Si el pago del capital y/o intereses venciere un día no hábil y/o feriado, el pago será efectuado el día anterior hábil devengándose los intereses hasta la fecha efectiva de ese pago.  "LOS DEUDORES" se encuentran facultados a realizar pagos anticipados parciales y/o totales durante la vigencia de este contrato. ';
	  $this->MultiCell(0,5,$txt);
	$txt = 'QUINTA.- (GARANTIAS).- "LOS DEUDORES", garantizan a favor de "EL ACREEDOR"  el cumplimiento de la obligación contraída en el presente contrato, con la generalidad de sus bienes muebles e inmuebles, presentes y futuros sin exclusión ni limitación alguna, renunciando de su parte a los beneficios de excusión, orden, división u otros que pudieran favorecerles.';
	  $this->MultiCell(0,5,$txt);
	$txt = 'SEXTA.- (MORA Y EJECUCION).- La falta de pago de "EL PRÉSTAMO" o la simple demora en el pago de cualquier cuota de capital, intereses, accesorios, etc., en la fecha de sus correspondientes vencimientos, constituirá a "LOS DEUDORES" en mora por el monto total de la obligación, la misma que se considerara de plazo vencido , liquido y exigible sin necesidad de intimación o requerimiento judicial o extrajudicial ni de otra formalidad o requisito alguno, lo que dará derecho a “EL ACREEDOR" a exigir el pago integro de "EL PRÉSTAMO"  y todos sus saldos deudores de capital, intereses, accesorios, etc., aunque el plazo final no se encuentre vencido. Asimismo, se conviene que “EL ACREEDOR" a su elección podrá demandarlos en forma individual o conjunta por la vía de la ejecución ejecutiva civil u otra que viere por conveniente, quedando en tal caso "LOS DEUDORES" obligados, además, al pago de todos los gastos, expensas y costos ocasionados a “EL ACREEDOR" emergentes de la cobranza judicial. La espera o esperas que “EL ACREEDOR" acordare o permitiere no constituirá ni implicara prorroga del plazo señalado ni novacion del contrato, sino simples actos de liberalidad y tolerancia que en nada afectara ni debilitara la fuerza ejecutiva de este contrato, ni los derechos de  “EL ACREEDOR" para exigir judicialmente el pago del monto total del préstamo, accesorios, etc., en cualquier tiempo.';  
	   $this->MultiCell(0,5,$txt);
	$txt = 'SEPTIMA.-(ACELERACIÓN DE PAGO) El incumplimiento de cualquiera de las cláusulas del presente contrato y la normativa vigente,  la disminución de la garantía otorgada en el patrimonio de "LOS DEUDORES", el embargo, secuestro ó exista cualquier tipo de persecución judicial de los mismos, ó si la información proporcionada a "EL ACREEDOR" por "LOS DEUDORES" sea falsa, inexacta o incorrecta y en términos generales cuando por cualquier causa y a sólo criterio y apreciación de "EL ACREEDOR"  , caigan en riesgo de insolvencia o se encuentre en peligro la recuperación total del crédito, dará lugar a que "EL ACREEDOR" inicie la acción ejecutiva u otra que viere por conveniente, destinada al cobro del total adeudado en concepto de capital, intereses convencionales, penales, honorarios de abogados y gastos emergentes de "EL PRÉSTAMO". Aclarándose que "LOS DEUDORES" intervienen en el presente contrato de forma mancomunada, solidaria e indivisible, por lo que las acciones legales podrán ejercitarse contra todos y/o cualquiera de ellos, a elección de "EL ACREEDOR".'; 
	 $this->MultiCell(0,5,$txt);
	 $txt = 'OCTAVA.-  (INFORMACION ECONOMICA Y FINANCIERA).- "LOS DEUDORES", autorizan expresamente a "EL ACREEDOR",  a obtener y dar información respecto de sus antecedentes y situación económica y financiera, a través de ellos o de terceras personas, durante todo el tiempo que dure la relación con "EL ACREEDOR".';
	  $this->MultiCell(0,5,$txt);
	  $txt = 'NOVENA.- (DOMICILIO ESPECIAL).- Para el caso de cobro judicial o para cualquier efecto legal emergente del presente contrato, "LOS DEUDORES", con la facultad que les otorga el parágrafo II del Art. 29 del Código  Civil, señalan como domicilio especial los declarados en las cláusula PRIMERA. En dichos domicilios se practicaran valida y legalmente todas las citaciones, notificaciones, avisos y comunicaciones, sin lugar a posterior observación, incidente o recurso alguno.';
	  $this->MultiCell(0,5,$txt);
	  $txt = 'DECIMA.- (FACULTAD DE EL ACREEDOR).- "LOS DEUDORES" autorizan a "EL ACREEDOR" a ceder, subrogar y/o transmitir a cualquier titulo el presente contrato, total o parcial, a favor de terceros, sin necesidad de aceptación de ninguno de  ellos y mucho menos su intervención en los contratos que suscriba "EL ACREEDOR" con terceros, siendo suficiente la información que proporcione el "EL ACREEDOR" a su elección, antes o después de la cesión, subrogación y/o transferencia.';
	   $this->MultiCell(0,5,$txt); 
	   
  
$txt = 'DECIMA PRIMERA.- (ACEPTACIÓN Y CONFORMIDAD).- Nosotros: '. $emp_ger. ' en calidad de "ACREEDOR", por una parte, y '.$deudor. ' en calidad de "DEUDORES", por otra parte, expresamos nuestra conformidad con el contenido de todas y cada una de las cláusulas precedentemente estipuladas y nos reatamos a su fiel y estricto cumplimiento, en señal de ello suscribimos a continuación.';  	
 
	   $this->MultiCell(0,5,$txt);
$fec = $_SESSION['fec_proc'];	   
$anio = substr($_SESSION['fec_proc'],6,4);
$mes = 	substr($_SESSION['fec_proc'],3,2);   
$dia = 	substr($_SESSION['fec_proc'],0,2);
if ($mes == 1){
    $mes_l = "Enero";
 } 
 if ($mes == 2){
    $mes_l = "Febrero";
 }
 if ($mes == 3){
    $mes_l = "Marzo";
 }
 if ($mes == 4){
    $mes_l = "Abril";
 }
 if ($mes == 5){
    $mes_l = "Mayo";
 }
 if ($mes == 6){
    $mes_l = "Junio";
 }
 if ($mes == 7){
    $mes_l = "Julio";
 }
 if ($mes == 8){
    $mes_l = "Agosto";
 }
 if ($mes == 9){
    $mes_l = "Septiembre";
 }
 if ($mes == 10){
    $mes_l = "Octubre";
 }
 if ($mes == 11){
    $mes_l = "Noviembre";
 }
 if ($mes == 12){
    $mes_l = "Diciembre";
 }
 $fecha = "                                                        ".$donde.", ".$dia." de ".$mes_l." de ".$anio;
 
 $this->SetFont('Arial','B',8);
 $this->MultiCell(0,25,$fecha);
 // $this->MultiCell(0,25,'');
  
 $consulta  = "Select CRED_DEU_INTERNO, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, 
 CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES, CRED_DEU_RELACION, CLIENTE_DIRECCION From cliente_general, cred_deudor where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $resultado = mysql_query($consulta);
 //   $impo1 = $impo + $icom ;
//	$impo = number_format($impo1, 2, '.',',');
//	$imp_l = f_literal($impo1,1); 
//	$i_mes1 = number_format($i_mes, 2, '.',','); 
//	$imes_i = f_literal($i_mes,2); 
//	$plz_m = number_format($plz_m, 0, '.',',');
//	$plz_i = f_literal($plz_m,3); 
//	$nrod_i = f_literal($nro_d,3); 

	$nro = 0;
while ($linea = mysql_fetch_array($resultado)) {
        $cis = "";
      	$deudores ="";
		$nro = $nro + 1;
	   	
       if (isset($linea['CLIENTE_AP_ESPOSO'])){	   	
       $deudores = $linea['CLIENTE_NOMBRES']. " ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO']." de ".$linea['CLIENTE_AP_ESPOSO'];
	   $deudor = $deudor." ". $linea['CLIENTE_NOMBRES']. " ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO']." de ".$linea['CLIENTE_AP_ESPOSO']", ";
 
}else{
      $deudores = $linea['CLIENTE_NOMBRES']. " ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'];

}	   

	  $cis = $linea['CLIENTE_COD_ID']; 
	    $deu[$nro] = $deudores;
	    $ci[$nro] = $cis; 
		 $cis = $deudores."   C.I. Nº  ".$cis ."   _______________________________________"; 
		//$this->MultiCell(0,5,$deudores);
	    $this->MultiCell(0,5,$cis);
		$this->MultiCell(0,5,' ');
		$this->MultiCell(0,5,' ');
		
		
		
		
		
		
	 }
	 
	
$deudores = "                                                             ".$emp_ger;
$cis = "                                                                             ".$emp_cig;
	$this->MultiCell(0,5,$deudores);
	$this->MultiCell(0,5,$cis);	  
	 /* */
    //Línea de cierre
  //  $this->Cell(array_sum($w),0,'','T');
	//$this->Ln(5);
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
$consulta  = "Select GRAL_EMP_NOMBRE,GRAL_EMP_CENTRAL From gral_empresa ";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
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
	  $fec_de2 = '01/03/2011';
	   $fec_ha2 = '31/03/2011';
	   $fec_des = '01/03/2011';
	   $fec_has = '31/03/2011';
	$tip_cam = 0;
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
   // $this->SetFont('Arial','B',12);
    //Movernos a la derecha
   // $this->Cell(80);
    //Título
  //  $this->Cell(30,10,'CONTRATO PRIVADO DE PRESTAMO DE DINERO',0,0,'C');
    //Salto de línea
 //   $this->Ln(15);
	 $this->SetFont('Arial','B',8);
//	$this->Cell(6,2, $_SESSION['NOM_EMPRESA'],0,0,''); 
//	$this->Cell(70);
	 //Número de página
 //   $this->Cell(0,3,'Pagina:  '.$this->PageNo(100),0,0,'R');
//	 $this->Ln(5);
	 
	 
//	$this->Cell(6,2,'Desde',0,0,'');
//	$this->Cell(10);
//	$this->Cell(12,2, $fec_des,0,0,'');
//	$this->Cell(12);
//	$this->Cell(7,2,'Hasta',0,0,'');
//	$this->Cell(8);
//	$this->Cell(15,2, $fec_has,0,0,'');
//	$this->Cell(70);
//	$this->Cell(7,2,'Cambio $us.',0,0,'');
//	$this->Cell(23);
//	$this->Cell(25,2, $tip_cam,0,0,'');
//	$this->Ln(7);
//	$this->Cell(6,2,'Cuentas desde',0,0,'');
//	$this->Cell(27);
//	$this->Cell(10,2,$_SESSION['cod_cta'],0,0,'');
//	$this->Cell(10);
//	$this->Cell(8,2,'hasta',0,0,'');
//	$this->Cell(6);
//	$this->Cell(38,2,$cod_cta2,0,0,'');
//	$this->Cell(70);
//	$this->Ln(7);
//	$this->Cell(7,2,'Expresado en Bolivianos',0,0,'');
////	$this->Ln(7);
//	$this->SetFont('Arial','B',8);
//	$this->Cell(10,5,'Cbte.',1,0,'C');
//	$this->Cell(15,5,'Fecha',1,0,'C');
//	$this->Cell(75,5,'Descripcion',1,0,'C');
//	$this->Cell(15,5,'Debe Bs.',1,0,'C');
//	$this->Cell(16,5,'Haber Bs.',1,0,'C');
//	$this->Cell(16,5,'Saldo Bs.',1,0,'C');
//	$this->Cell(15,5,'Debe $us.',1,0,'C');
//	$this->Cell(16,5,'Haber $us.',1,0,'C');
//	$this->Cell(16,5,'Saldo $us.',1,0,'C');
//	$this->Cell(6,5,'T.C.',1,0,'C');
//	$this->Ln(5);
}

//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,3,'Pag. '.$this->PageNo(),0,0,'C');
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$linea = 'Imprimiendo línea número '."----"."mis datos";
// $pdf->Ln();
// $pdf->Ln();
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
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla tipo_cambio');
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
    $res_ctad = mysql_query($con_ctad)or die('No pudo seleccionarse tabla aqui')  ;
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
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans 1');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_t2010 
				               where CONTA_TRS_CTA = '$cta'
							   and CONTA_TRS_FEC_VAL <= '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null ";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans2 ');
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
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans 1');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA = '$cta'
							   and CONTA_TRS_FEC_VAL < '$fec_cal'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans2 ');
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
function f_literal($l_valor,$c_s_cent){
      $l_centl = "";
	  $l_unilit = "";
	  $_SESSION['cent'] = " ";
	  $l_frase1 = "";
      $l_vallit = $l_valor * 100;
	// echo  "valor ", $l_valor, " cent ", $c_s_cent; 
     $l_frase = "";
     $l_tam = 0;
     $l_tam = strlen($l_vallit);
     $l_max = $l_tam - 2;
	 $l_centavo = substr($l_vallit,($l_tam - 2),2);
	 $_SESSION['cent'] = $l_centavo;
	  
     if ($l_valor < 1){ 
        $l_frase1 = "CERO ";
        }
		if ($l_valor > 1){ 
		switch($l_max){ 
	        case 1: 
			    $uni = substr($l_vallit,0,1);
			    if ($uni == 1){ 
                    $l_frase1 = "UN0 ".$l_centavo;
					echo " l_frase ", $l_frase1;
	          		} else {
                    $l_frase1 = f_tunidad($uni, $l_vallit);
			        }
				break; 
           case 2:
		         $dec = substr($l_vallit,0,2);
				 if ($dec > 19) {
				     $dec = substr($l_vallit,0,1);
			        }				
		             $l_frase1 =  f_tdezena($dec, $l_vallit);
					 $ude1 = substr($l_vallit,0,1);
                     $ude2 = substr($l_vallit,1,1); 
                     if ($ude1 <> 1 and $ude2 > 0){
                        $l_unilit = f_tunidad($ude2,$l_vallit);
						if ($l_unilit <> "CERO"){
                            $l_frase1 = $l_frase1." Y ".$l_unilit;
						}	
						if ($l_unilit == "CERO"){
                            $l_frase1 = $l_frase1;
						}
  	                    }
			 	break;
           case 3:
		         $cen1 = substr($l_vallit,0,3);
				 
		         if ($cen1 > 99 and $cen1 < 200){
		            $cen = substr($l_vallit,0,1);
					}
				 if ($cen1 == 100){
				     $cen = $cen1;
					 }	
				 if ($cen1 > 199){
		            $cen = substr($l_vallit,0,1);
					}
      	         $l_cenlit=  f_tcentena($cen,$l_vallit);
				 $l_cen2 = substr($l_vallit,1,2);
   
                    if ($l_cen2 > 19) {
		               $l_cen2 = substr($l_vallit,1,1);
		               }
	 
                       $l_dezlit = f_tdezena($l_cen2,$l_vallit);
					 
	                   $ude1 = substr($l_vallit,1,1);
                       $ude2 = substr($l_vallit,2,1); 
                       if ($ude1 <> 1 and $ude2 > 0){
                          $l_unilit = f_tunidad($ude2,$l_vallit);
       
  	                    }
	
                         //   $l_frase1 = $l_frase1." Y ".$l_unilit;
						
	if ($l_unilit <> "CERO"){										 
       $l_frase1 =   $l_cenlit." ".$l_dezlit ." Y ".$l_unilit;
    }
	if ($l_unilit == "CERO"){										 
       $l_frase1 =   $l_cenlit." ".$l_dezlit ;
    }
				 break;
			case 4:
		         $mil = substr($l_vallit,0,4);
				// echo "Aqui".$mil;
		         $l_frase1 =  f_tupmil($mil,$l_vallit);
				// echo "Aqui";
				 break;
         default:
		         $miles = substr($l_vallit,0,5);
		         $l_frase1 =  f_tupmiles($miles,$l_vallit);
				 break;
			 } 	  
     } 
	 if ($c_s_cent == 1){
	    $l_frase1 = $l_frase1." ".$l_centavo. "/100";
		}
	 if ($c_s_cent == 2){
	    $l_cent1 = "";
		$l_frasec = "";
		$l_cent2 = "";
		$dec = $l_centavo;
		$uni = substr($l_vallit,0,1);
		if ($uni == 1){ 
           $l_fraseu = "UN0 ";
		   } else {
           $l_fraseu = f_tunidad($uni, $l_vallit);
		  }
		
	    $l_cent1 = substr($l_centavo,0,1);
		if ($l_centl == 0){
		    $l_frasec = "CERO ";
			$l_cent2 = substr($l_centavo,1,1);
			$l_frasec = $l_frasec .f_tunidad($l_cent2,$l_centavo);
			}
		
		if ($l_centl <> "0"){
		    $dec = substr($l_centavo,0,2);
						
		$l_frase2 =  f_tdezena($dec, $l_vallit);
		
		if ($dec > 19) {
			$dec = substr($l_centavo,0,1);
			}				
		    $l_frase1 =  f_tdezena($dec, $l_centavo);
			$ude1 = substr($l_centavo,0,1);
            $ude2 = substr($l_centavo,1,1); 
            if ($ude1 <> 1 and $ude2 > 0){
                $l_unilit = f_tunidad($ude2,$l_vallit);
		if ($l_unilit <> "CERO"){		
                $l_frase1 = $l_frase1." Y ".$l_unilit;
		}	
		if ($l_unilit == "CERO"){		
                $l_frase1 = $l_frase1;
		}	
  	            }
			
		   $l_frase1 =  $l_fraseu." punto ".$l_frase1;
		  }			
	    }	
           return $l_frase1;
       }
if(isset($c_s_cent)){	     
  if ($c_s_cent == 3){
	    $l_cent1 = "";
		$l_frasec = "";
		$l_cent2 = "";
		$dec = $l_centavo;
		$uni = substr($l_vallit,0,1);
		if ($uni == 1){ 
           $l_fraseu = "UN0 ";
		   } else {
           $l_fraseu = f_tunidad($uni, $l_vallit);
		  }
	}
}	

//#-----------------------------------------------------------------------------
//# FUNCTION : Devolver la unidad
//#-----------------------------------------------------------------------------
function f_tunidad($l_uni,$l_val){
     $l_unilit = " ";
    switch ($l_uni) {
      case "0":
	      $l_unilit = "CERO";
		  break;
      case "1":
	      $l_unilit = "UN";
		  break;
      case "2":
	      $l_unilit = "DOS";
		  break;
      case "3":
	     $l_unilit = "TRES";
		 break;
      case "4":
	     $l_unilit = "CUATRO";
		  break;
      case "5":
	     $l_unilit = "CINCO";
		 break;
      case "6":
	     $l_unilit = "SEIS";
		 break;
      case "7": 
	     $l_unilit = "SIETE";
		 break;
      case "8":
	     $l_unilit = "OCHO";
		  break;
      case "9":
	     $l_unilit = "NUEVE";
		 break;
  }
    return $l_unilit;
}
//#-----------------------------------------------------------------------------
//# FUNCTION : Devolver la decena
//#-----------------------------------------------------------------------------
function f_tdezena($l_dez,$l_val){
    $l_dezlit = "";
    switch($l_dez){
      case "10":
	       $l_dezlit = "DIEZ";
		   break;
      case "11":
	       $l_dezlit = "ONCE";
		   break;
      case "12":
	       $l_dezlit = "DOCE";
		   break;
      case "13":
	       $l_dezlit = "TRECE";
		   break;
      case "14":
	       $l_dezlit = "CATORCE";
		   break;
      case "15":
	       $l_dezlit = "QUINCE";
		   break;
      case "16":
	       $l_dezlit = "DIECISEIS";
		   break;
      case "17":
	       $l_dezlit = "DIECISIETE";
		   break;
      case "18":
	       $l_dezlit = "DIECIOCHO";
		   break;
      case "19":
	       $l_dezlit = "DIECINUEVE";
		   break;
      case "2":
	       $l_dezlit = "VEINTE";
		   break;
      case "3":
	       $l_dezlit = "TREINTA";
		   break;
      case "4":
	       $l_dezlit = "CUARENTA";
		   break;
      case "5":
	       $l_dezlit = "CINCUENTA";
		   break;
      case "6":
	       $l_dezlit = "SESENTA";
		   break;
      case "7":
	  	   $l_dezlit = "SETENTA";
		   break;
      case  "8":
	       $l_dezlit = "OCHENTA";
		   break;
      case  "9":
	       $l_dezlit = "NOVENTA";
		   break;
   }
   
     return $l_dezlit;
}
//#-----------------------------------------------------------------------------
//# FUNCTION : Devolver la centena
//#-----------------------------------------------------------------------------
function f_tcentena($l_cen, $l_val){

   $l_cenlit = " ";
  // echo $l_cen."centena";
   switch($l_cen){
      case "100":
	       $l_cenlit = "CIEN";
           if ($l_cen > "100" and $l_cen < "200"){
	          $l_cenlit = "CIENTO";
			  }
			  break; 
	    case "1":
	       $l_cenlit = "CIENTO";
          
			  break;   		    
      case "2":
	       $l_cenlit = "DOSCIENTOS";
		  break; 
      case "3":
	       $l_cenlit = "TRESCIENTOS";
		  break;
      case "4":
	       $l_cenlit = "CUATROCIENTOS";
		  break;
      case "5":
	       $l_cenlit = "QUINIENTOS";
		  break;
      case "6": 
	       $l_cenlit = "SEISCIENTOS";
		  break;
      case "7":
	       $l_cenlit = "SETECIENTOS";
		   break;
	  case "8":
	       $l_cenlit = "OCHOCIENTOS";
		   break;
      case "9":
	       $l_cenlit = "NOVECIENTOS";
		   break;
   }
  
   return $l_cenlit;
}
#-----------------------------------------------------------------------------
# FUNCTION : Devolver los mil
#-----------------------------------------------------------------------------
function f_tupmil($l_up,$l_val){
//  echo "--".$l_up,"--".$l_val;
 for ($i=0; $i < 4; $i = $i + 1 ) {
     $numero = substr($l_up,$i,1);
	 
     switch($i){ 
	       case 0:
		        if ($numero == 1) {
				   $l_frase0 = " ";
				   }else{
		           $l_frase = f_tunidad($numero, $l_val);
				   $l_frase0 = $l_frase;
				 //  echo "---".$l_frase0."---";
				   }
				break;
			case 1:
                // echo $numero, "-cent-";			
				 if ($numero == 1){
		            $cen = 100;
					 $l_frase1 = "CIENTO";
					}else{
				    $l_frase1 =  f_tcentena($numero,$l_val);
					}
				    break;
			case 2:		
			     $dec = substr($l_val,2,2);
	//			 echo "dec_mil ", $dec;
				 if ($dec > 19) {
				     $dec = $numero;
				     }else{
					  $dec = substr($l_val,2,2);
					 }		
		             $l_frase2 =  f_tdezena($dec, $l_val);
				 break;
			case 3:
		         $l_frase3 = f_tunidad($numero, $l_val);
				 break;	 
	        }
      }
if ($l_frase3 <> "CERO"){
   $l_fraset = $l_frase0. " MIL ". $l_frase1. " ". $l_frase2. " Y ".$l_frase3;
 }
 if ($l_frase3 == "CERO"){
   $l_fraset = $l_frase0. " MIL ". $l_frase1. " ". $l_frase2;
 }
   return $l_fraset;
}
#-----------------------------------------------------------------------------
# FUNCTION : Devolver los miles
#-----------------------------------------------------------------------------
function f_tupmiles($l_up,$l_val){
  $l_frase1 = "";
  $l_frase = "";
 for ($i=0; $i < 5; $i = $i + 1 ) {
     $numero = substr($l_up,$i,1);
   //  echo $numero,"--";
     switch($i){ 
	       case 0:		
			     $decm = substr($l_val,0,2);
				 if ($decm > 19) {
				     $decm = substr($l_val,0,1);
					 $l_frase0 =  f_tdezena($decm, $l_val);
					 $unim = substr($l_val,1,1);
					 
					 
					 if  ($unim > 0){
					  
					     $l_frase =  " Y " . f_tunidad($unim, $l_val);
						 //echo $l_frase;
				         }
					 }else{
					  $l_frase0 =  f_tdezena($decm, $l_val);
					 // $l_frase = " MIL";
					 //$dec = $numero;
					 }		
		              $l_frase1 = $l_frase0. " ". $l_frase . " MIL";
				 break;
	       //case 1:
		    //    if ($numero == 1) {
				  
			//	   }else{
		           
				  // echo $l_frase1; 
			// 	   }
			//	break;
			case 2:
                // echo $numero, "-cent-";			
				 if ($numero == 1){
		            $numero = 100;
					 $l_frase2 =  f_tcentena($numero,$l_val);
					}else{
				    $l_frase2 =  f_tcentena($numero,$l_val);
					}
				    break;
			case 3:		
			     $dec = substr($l_val,3,2);
				 if ($dec > 19) {
				     $dec = substr($l_val,3,1);
					 }
					 $l_frase3 =  f_tdezena($dec, $l_val);
				 break;
			case 4:
			     $dec = substr($l_val,3,2);
				 if ($dec > 19) {
				    $unid = substr($l_val,4,1);
					$l_frase4 = f_tunidad($unid, $l_val);
					}else{
				     $l_frase4 = " ";
					 }
			    // echo $numero, " --unid--";
				 
		         
				 break;	 
	        }
      }

   $l_fraset = $l_frase1. " ". $l_frase2. " ".$l_frase3. " ".$l_frase4;
   return $l_fraset;
}
}
?> 

  
 