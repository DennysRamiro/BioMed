<?php
//	session_start();
//	require('configuracion.php');
//	$literal = " ";
//	$literal = f_literal(1.67);
//	echo $literal."  ".$_SESSION['cent']."/100";
?>
<?php
function f_literal($l_valor,$c_s_cent){
      $l_centl = "";
	  $l_unilit = "";
	  $_SESSION['cent'] = " ";
	  $l_frase1 = "";
      $l_vallit = $l_valor * 100;
	
     $l_frase = "";
     $l_tam = 0;
     $l_tam = strlen($l_vallit);
     $l_max = $l_tam - 2;
	 $l_centavo = substr($l_vallit,($l_tam - 2),2);
	 $_SESSION['cent'] = $l_centavo;
	   //echo  "valor ", $l_valor, " cent ", $l_centavo,"nro",$l_max,"l_vallint".$l_vallit; 
     if ($l_valor < 1){ 
        $l_frase1 = "CERO ";
        }
		if ($l_valor >= 1){ 
		switch($l_max){ 
	        case 1: 
			    $uni = substr($l_vallit,0,1);
			    if ($uni == 1){ 
                    $l_frase1 = "UN0 ";
				//	echo " l_frase ", $l_frase1;
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
						if ($ude2 == 1){
                          $l_unilit = "UNO";
						} 	
                        $l_frase1 = $l_frase1." Y ".$l_unilit;
  	                    }
					
			 	break;
           case 3:
		         $cen1 = substr($l_vallit,0,3);
				// echo "----".$cen1;
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
				 // echo "*****".$l_cenlit;
				 $l_cen2 = substr($l_vallit,1,2);
                   //   echo "+++++".$l_cen2;
					$l_cen3 = substr($l_vallit,1,1); 
					 //echo "////".$l_cen3;
                    if ($l_cen2 > 19) {
		               $l_cen2 = substr($l_vallit,1,1);
		               }
	                 if ($l_cen3 > 0){
                       $l_dezlit = f_tdezena($l_cen2,$l_vallit);
					 }else{
					    $l_dezlit = "";
					}	
	                   $ude1 = substr($l_vallit,1,1);
                       $ude2 = substr($l_vallit,2,1); 
                       if ($ude1 <> 1 and $ude2 > 0){
                          $l_unilit = f_tunidad($ude2,$l_vallit);
                          if ($ude2 == 1){
                          $l_unilit = "UNO";
						 
                          } 
  	                    } 
	if ($l_cen3 > 0){
	//echo $l_cen3. "--l_cen3".$l_unilit."***$l_unilit";						
   $l_frase1 =   $l_cenlit." ".$l_dezlit ." ".$l_unilit;
  }else{
    $l_frase1 =   $l_cenlit." ".$l_dezlit ." ".$l_unilit;
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
		case 6:
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
						  if ($ude2 == 1){
                          $l_unilit = "UNO";
						 
                          } 
       
  	                    } 
   $l_frase1 =   $l_cenlit." ".$l_dezlit ." Y ".$l_unilit." MIL ";
   
   	         $cen1 = substr($l_vallit,3,3);
				 
		         if ($cen1 > 99 and $cen1 < 200){
		            $cen = substr($l_vallit,3,1);
					}
				 if ($cen1 == 100){
				     $cen = $cen1;
					 }	
				 if ($cen1 > 199){
		            $cen = substr($l_vallit,3,1);
					}
      	         $l_cenlit=  f_tcentena($cen,$l_vallit);
				 $l_cen2 = substr($l_vallit,4,2);
   
                    if ($l_cen2 > 19) {
		               $l_cen2 = substr($l_vallit,4,1);
		               }
	 
                       $l_dezlit = f_tdezena($l_cen2,$l_vallit);
					 
	                   $ude1 = substr($l_vallit,4,1);
                       $ude2 = substr($l_vallit,5,1); 
                       if ($ude1 <> 1 and $ude2 > 0){
                          $l_unilit = f_tunidad($ude2,$l_vallit);
						  if ($ude2 == 1){
                          $l_unilit = "UNO";
						 
                          } 
       
  	                    } 
						
						if ($ude2 == 1){
                          $l_unilit = "UNO";
       
  	                    } 
   $l_frase1 = $l_frase1." ". $l_cenlit." ".$l_dezlit ." Y ".$l_unilit;
   
   
   
  
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
				
                $l_frase1 = $l_frase1." Y ".$l_unilit;
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
           if ($l_cen > 100 and $l_cen < 200){
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
		//	 echo "dec_mil ", $l_val;
				 if ($dec > 19) {
				     $dec = $numero;
				     }else{
					  $dec = substr($l_val,2,2);
					 }
					$dec5 = substr($l_val,2,1); 
					// echo "dec_mil ", $l_val,"--".$dec."**".$dec5;
					 if ($dec5 > 0){		
		             $l_frase2 =  f_tdezena($dec, $l_val);
					 }else{
					  $l_frase2 = "";
					 }
				 break;
			case 3:
		         $l_frase3 = f_tunidad($numero, $l_val);
				 if ($numero == 1){
				    $l_frase3 = "UNO";
			}		 
				 break;	 
	        }
      }
if ($dec5 > 0){	 
   $l_fraset = $l_frase0. " MIL ". $l_frase1. " ". $l_frase2. " Y ".$l_frase3;
}else{
   $l_fraset = $l_frase0. " MIL ". $l_frase1. " ". $l_frase2. " ".$l_frase3;
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
					     $l_frase =  " Y " . f_tunidad($unim, $l_val) ;
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
?>