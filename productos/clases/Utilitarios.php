<?php
require_once '../lib/Mysql.php';

/**
 * Clase que permite Utilitarios
 * 
 */
class Utilitarios{
  private $mysql;
	/**
	 * Esta es la funcion correlativo
	 * @param $tipo este es el tipo al que pertenece el producto
	 *        $cadena este es el tipo de cadena
	 *        $cant esta es la cantidad 
	 */
	/*public function numeroCorrelativo($tipo, $cadena, $cant, $tabla){
		if($cadena != ""){
			$cadena = substr($cadena, 0, 2);
		}
		$n = strlen($cadena); /// Cuantos caracteres tiene la cadena 0
		$n2 = $cant - $n;  /// 9 - 3 = 6
		/*$nro_cred = 0;
		$nro_ctaf = 0;
		$nro_ctf = 0;*/
		/*if(isset($r)){ 
		   for ($i = 1; $i <= $n2; $i++) {
				$r = $r."0";
		   }
		}
		
		return '';
	}*/
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	/**
   * Este metodo cambia la fecha de la forma normal a la de mysql
   */ 	
	public function cambiaf_a_mysql($fecha){ 
	   $anio =  substr($fecha, -4);
	   $mes = substr($fecha, 3,2);
	   $dia = substr($fecha, 0,2);
	   $lafecha = $anio."-".$mes."-".$dia; 
	  // echo $lafecha;
	   return $lafecha; 
	}
	/**
   * Este metodo cambia la fecha de mysql a fecha  normal
   */
	public function cambiaf_a_normal($f_proc){
	   $anio =  substr($f_proc, 0,4);
	   $mes = substr($f_proc, 5,2);
	   $dia = substr($f_proc, -2);
	   $lafecha=$dia."/".$mes."/".$anio; 
	   return $lafecha; 
	} 
	
  /**
   * Este metodo obtiene la fecha actual
   */
  public function obtenerFechaActual(){
  
  date_default_timezone_set('America/La_Paz');
  $fecha_actual  = date("Y-m-d H:i:s");
  return $fecha_actual; 
  }

      


  /**
   * Metodo que incremente el codigo solo para proyectos
   */
	public function codigoIncrementableProyecto($tipo){ 
     //return $tipo;
        $cons_alfanum="select Substring(alm_proy_cod, 1 , 1) as var, MAX(Substring(alm_proy_cod, 2 , 4))  as num  
                       from alm_proyecto where alm_proy_tipo=".$tipo;
        $res_alfanum = mysql_query($cons_alfanum); // $arreglo = $this->mysql->query($cons_alfanum);
        // print_r($arreglo)
        $linea_alfanum= mysql_fetch_array($res_alfanum); // Esta ya no se hace con la clase Mysql

        //echo $linea_alfanum['var'];

      if (isset($linea_alfanum['var'])) {
          $cons_alfanum_ini="select MAX(Substring(alm_proy_cod, 1 , 3)) as ini, MAX(Substring(alm_proy_cod, 4 , 3)) as med, MAX(Substring(alm_proy_cod, 6 , 1)) as penul, MAX(Substring(alm_proy_cod, 7 , 1)) as ult  
    						 from alm_proyecto where alm_proy_tipo=".$tipo;
          $res_alfanum_ini = mysql_query($cons_alfanum_ini);
          $linea_alfanum_ini= mysql_fetch_array($res_alfanum_ini);

          $cons_alfanum2="select MAX(Substring(alm_proy_cod, 1 , 3)) as ini, MAX(Substring(alm_proy_cod, 4 , 2)) as med, MAX(Substring(alm_proy_cod, 5 , 1)) as penul, MAX(Substring(alm_proy_cod, 6 , 2)) as ult  
    					  from alm_proyecto where alm_proy_tipo=".$tipo;
          $res_alfanum2 = mysql_query($cons_alfanum2);
          $linea_alfanum2= mysql_fetch_array($res_alfanum2);

          $cons_alfanum3="select MAX(Substring(alm_proy_cod, 1 , 3)) as ini, MAX(Substring(alm_proy_cod, 4 , 1)) as med, MAX(Substring(alm_proy_cod, 4 , 1)) as penul, MAX(Substring(alm_proy_cod, 5 , 3)) as ult  
    					  from alm_proyecto where alm_proy_tipo=".$tipo;
          $res_alfanum3 = mysql_query($cons_alfanum3);
          $linea_alfanum3= mysql_fetch_array($res_alfanum3);

          $cons_alfanum4="select MAX(Substring(alm_proy_cod, 1 , 3)) as ini, MAX(Substring(alm_proy_cod, 3 , 1)) as med, MAX(Substring(alm_proy_cod, 3 , 1)) as penul, MAX(Substring(alm_proy_cod, 4 , 4)) as ult  
    					  from alm_proyecto where alm_proy_tipo=".$tipo;
          $res_alfanum4 = mysql_query($cons_alfanum4);
          $linea_alfanum4= mysql_fetch_array($res_alfanum4);


                if ($linea_alfanum_ini['ult']<9 && $linea_alfanum_ini['penul']==0 ) {
              $ceros= $linea_alfanum_ini['med'];
              $ult=$linea_alfanum_ini['ult']+1;
              $cod=$linea_alfanum_ini['ini'].$ceros.$ult;

                }elseif ($linea_alfanum_ini['ult']==9 && $linea_alfanum_ini['penul']==0 ) {
              $ceros= $linea_alfanum2['med'];
              $ult=$linea_alfanum_ini['ult']+1;
              $cod=$linea_alfanum_ini['ini'].$ceros.$ult;

                }elseif ($linea_alfanum2['ult']<99 && $linea_alfanum2['penul']==0 ) {
              $ceros= $linea_alfanum2['med'];
              $ult=$linea_alfanum2['ult']+1;
              $cod=$linea_alfanum2['ini'].$ceros.$ult;

                }elseif ($linea_alfanum2['ult']==99 && $linea_alfanum2['penul']==0 ) {
                $ceros= $linea_alfanum3['med'];
              $ult=$linea_alfanum2['ult']+1;
              $cod=$linea_alfanum2['ini'].$ceros.$ult;
              
                }elseif ($linea_alfanum3['ult']<999 && $linea_alfanum3['penul']==0 ) {
                $ceros= $linea_alfanum3['med'];
              $ult=$linea_alfanum3['ult']+1;
              $cod=$linea_alfanum3['ini'].$ceros.$ult;
                
                }elseif ($linea_alfanum3['ult']==999 && $linea_alfanum3['penul']==0 ) {
              $ult=$linea_alfanum3['ult']+1;
              $cod=$linea_alfanum3['ini'].$ult;
                
                }elseif($linea_alfanum4['ult']<9999) {
                $ult=$linea_alfanum4['ult']+1;
              $cod=$linea_alfanum4['ini'].$ult;
                }


        
       } else {
                //echo $cod=$tipo;
                if ($tipo==1) {
                  $cod='CON0001';
                }elseif ($tipo==2) {
                  $cod='LIC0001';
                }elseif ($tipo==3) {
                  $cod='ORC0001';
                }elseif ($tipo==4) {
                  $cod='STO0001';
                }
                
       }
        return ($cod);
    }
	
	/*
	* Metodo que devuelve un numero con ceros a la izquierda
	*/
	
	function NumCorrelativo($number,$n) {
	   return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
	}

  /**
   * Metodo que permite generar codigos unicos orden
   */
  function generaNumeroOrdenUnico() { 
    $codigo = uniqid('INTER_');
    return $codigo; 
  } 
  
   /**
   * Metodo que permite grabar la imagen y el pdf
   */
  function pdf($det_pro) { 
    $ruta = '';
	
	if(!empty($_FILES['det_tec']['tmp_name'])){
			$codigo = uniqid('treb_det_'); 
			$ruta = 'images/producto/dt/'.$codigo.$_FILES["'".$det_pro."'"]['name'];
			copy($_FILES["'".$det_pro."'"]['tmp_name'], $ruta);
			return $ruta;
	}
  
  } 
     /**
   * Metodo que permite grabar la imagen y el pdf
   */
  function imagen($ima_prod) { 
	
	//print_r($_FILES['img_produc']['tmp_name']);
	$ruta2 = '';
	
	if(!empty($_FILES['img_produc']['tmp_name'])){
		print_r($ima_prod);
		require_once('../lib/SimpleImage.class.php');
		$img = new SimpleImage();
		$codigo = uniqid('treb_img_');
		$ruta2 = 'images/producto/img/'.$codigo.$_FILES['img_produc']['name'];
		$img->load($_FILES['img_produc']['tmp_name'])->resize(320, 200)->save($ruta2);
		print_r($ruta2);
		return $ruta2;
	}
  
  }
  
  
   /**
   * Metodo que permite generar codigos unicos orden
   */
   
			//Generar codigo por tipo de producto
			//Buscar Prefijo
	function crearCodigo($tipo_prod,$prov) {
		$r = "";
		//$tipo = $_POST['tipo_producto'];
		//echo $tipo."---";
		 $consulta = "SELECT GRAL_PAR_PRO_SIGLA FROM gral_param_propios 
					  WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD = ".$tipo_prod;
		 $resultado = mysql_query($consulta);
		while ($linea = mysql_fetch_array($resultado)) {
		$prefijo = $linea['GRAL_PAR_PRO_SIGLA'];	
		}
		//$nro = leer_correla_prod($tipo);
		/****/
		$consulta  = "SELECT alm_prod_cab_numerico FROM alm_prod_cabecera where alm_prod_cab_tipo = ".$tipo_prod." 
						  ORDER BY alm_prod_cab_numerico 
						  DESC LIMIT 0,1";
			//echo $consulta;
			$resultado = mysql_query($consulta);
			$linea = mysql_fetch_array($resultado);
			$nro_tran = $linea['alm_prod_cab_numerico'];
			
			if (empty($nro_tran)) {
			$nro_tran = 1;
			//echo("el valor es vacio ".$nro_tran."<br>");
			   }else{
			$nro_tran = $nro_tran + 1;
			//echo("el valor sera contenido ".$nro_tran."<br>");
			  }
			//return $nro_tran;
			$_SESSION['numerico']=$nro_tran; 
			
		/*****/
		
		$nom_prov = substr($prov,0,3);
		$cod_prov = $prov;
		//Arma el codigo
	    //$n = strlen($nro);
		//echo ("nro_tra ".$nro_tran."<br>");
		 $n = strlen($nro_tran);
		 //echo "Cantidad de nro_tra".$n."<br>";
		$n2 = 6 - $n;
		for ($i = 1; $i <= $n2; $i++) {
			$r = $r."0";
			}  
		$codigo_producto = $prefijo."-".$nom_prov."-".$r.$nro_tran;
		return ($codigo_producto);
		
		//echo $codigo_producto;
		
	}
  

}
?>