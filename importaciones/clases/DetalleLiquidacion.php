<?php

require_once '../lib/Mysql.php';
require_once 'Utilitarios.php';

/**
 * Clase Proyecto gestiona todas las consultas y formulario de proyecto
 * @author ARGO SI 
 * @date 16/05/2013
 */
class DetalleLiquidacion{
	// Esta es la variable mysql
	private $mysql;
	/**
	 * Este es el constructor de la clase proyecto
	 * @param  parm1 -> signigica esto
	 *         param2 -> significa esta otra cosa
	 * @return  variable, variable[] -> descripscion 
	 */
	public function __construct() {
		// Constructor
		$this->mysql = new Mysql();
	}
	
	/*
	* Metodo que crear el formulario de detalle de liquidacion de poliza
	*/
	public function formularioDetalleLiquidacion(){
		//$template = file_get_contents('tpl/det_liqu_poliza_form_tpl.html');
		//$cabecera = $this->
		$template = file_get_contents('tpl/detalle_liqui_pol_form_tpl.html');
		
	/*
		
		$listas_poliza = $listas_poliza.'<table align="center"><tr> <td>SIDUNEA :</td> <td>VALOR</td> <td>CARPETA</td><td>VALOR</td></tr>';
		$listas_poliza = $listas_poliza.'<tr> <td>AGENCIA</td> <td>VALOR</td> <td>MERCADERIA</td><td>VALOR</td></tr>';
		$listas_poliza = $listas_poliza.'<tr> <td>BULTOS</td> <td>VALOR</td> <td>PESO</td><td>VALOR</td></tr>';
		$listas_poliza = $listas_poliza.'<tr> <td>FACTURA COMERCIAL</td> <td>VALOR</td> <td>VALOR CIF BS</td><td>VALOR</td></tr>';
		$listas_poliza = $listas_poliza.'<tr> <td>PEDIDO NRO</td> <td>VALOR</td> <td>TERMINA</td><td>TERMINA</td></tr></table>';
		
		
		
		//$cod_proy = 'CID001';
		//$listas = $this->listaPoliza($cod_proy);
		//$suma = $this->sumatoriaPoliza($cod_proy);
		//print_r($suma);
		
			$listas_poliza = $listas_poliza.'<table  class="table_usuario" align="center">';
		
		$listas_poliza = $listas_poliza.'
		<tr>
    	<th>DETALLE</th>
        <th>TOTAL</th>
        <th>CF-IVA</th>
        <th>NETO</th>
        </tr>
		';
		foreach($listas as $key => $lista){
			//print_r($lista);
  		    $listas_poliza = $listas_poliza.'<tr><td>'.$lista['pp']['DETALLE'].'</td><td>'.$lista['adt']['TOTAL'].'</td><td>'.$lista['0']['IVA'].'</td><td>'.$lista['0']['NETO'].'</td></tr>';
		}
		//
		$listas_poliza = $listas_poliza.'<tr bgColor=#666666><td  valign="center">TOTALES</td><td>'.$suma['0']['0']['TOTAL'].'</td><td>'.$suma['0']['0']['TOTALIVA'].'</td><td>'.$suma['0']['0']['TOTALNETO'].'</td></tr>';
		$listas_poliza = $listas_poliza.'</table>';
		$template = str_replace('{Detalle_Liquidacion_Poliza}', $listas_poliza, $template);
	  */  print($template);
		
		
	}
	
	/*
	* Metodo que crear el formulario lista de detalle de liquidacion de poliza
	*/
	public function formularioListaDetalleLiquidacion(){

		$template = file_get_contents('tpl/lista_liquidacion_tpl.html');
	    print($template);		
	}

	/*
	* Metodo que crear el formulario lista de detalle de liquidacion de poliza
	*/
	public function formularioDetalleLiquidacionCons(){

		$template = file_get_contents('tpl/detalle_liqui_cons_pol_form_tpl.html');
	    print($template);		
	}

			/*
	* Metodo que crear la lista de los certificados 
	*/
	public function listaDetOpciones(){
		$template = file_get_contents('tpl/deta_seleccionar_form_tpl.html');
	    print($template);
		
	}
	/**
	 * Metodo que devuelve la listado del detalle de la liquidacion de la poliza
	 * @return el arreglo de la listado del detalle de la liquidacion de la poliza
	 */
	public function listadoDetallePoliza($cod_proy){
		//echo $cod_proy;
		$query = "SELECT adu.alm_age_adu_tra_nro_fac, pro.alm_prov_nombre, adu.alm_age_adu_tra_merc, adu.alm_age_adu_tra_id, adu.alm_age_adu_tra_cod, adu.alm_age_adu_tra_cod_proy
				  FROM alm_age_adu_tra adu INNER JOIN alm_proveedor pro ON adu.alm_age_adu_tra_cod_prov=pro.alm_prov_codigo_int 
				  WHERE alm_age_adu_tra_cod_proy='".$cod_proy."' AND ISNULL(pro.alm_prov_usr_baja) AND ISNULL(adu.alm_age_adu_tra_fch_baja)";
				  
				  //print_r($query);
		return $this->mysql->query($query);
	}
	
	/**
	 * Metodo que devuelve la lista del detalle de la liquidacion de la poliza
	 * @return el arreglo de la lista del detalle de la liquidacion de la poliza
	 */
	public function listaPoliza($cod_proy){
		//echo $cod_proy;
		$query = "SELECT distinct pp.GRAL_PAR_PRO_COD, pp.GRAL_PAR_PRO_DESC as DETALLE, pp.GRAL_PAR_PRO_SIGLA AS SIGLAS, 
				  pp.GRAL_PAR_PRO_GRP AS GRUPO,adt.alm_age_adu_tra_det_cod AS CODIGO, adt.alm_age_adu_tra_det_item, 
				  adt.alm_age_adu_tra_det_factura as FACTURA, adt.alm_age_adu_tra_det_monto as TOTAL,
				  ROUND((CASE WHEN pp.GRAL_PAR_PRO_COD<>3 AND adt.alm_age_adu_tra_det_factura = 1 THEN adt.alm_age_adu_tra_det_monto*.13 ELSE (CASE WHEN pp.GRAL_PAR_PRO_COD=3 THEN adt.alm_age_adu_tra_det_monto ELSE 0 END) END),2) as IVA,
				  ROUND((adt.alm_age_adu_tra_det_monto-(CASE WHEN pp.GRAL_PAR_PRO_COD<>3 AND adt.alm_age_adu_tra_det_factura = 1 THEN adt.alm_age_adu_tra_det_monto*.13 ELSE (CASE WHEN pp.GRAL_PAR_PRO_COD=3 THEN adt.alm_age_adu_tra_det_monto ELSE 0 END) END)),2) as NETO
				  from gral_param_propios pp INNER JOIN alm_age_adu_tra_det adt ON pp.GRAL_PAR_PRO_COD = adt.alm_age_adu_tra_det_item
                  WHERE pp.gral_par_pro_grp=1600 AND adt.alm_age_adu_tra_det_cod='".$cod_proy."'";
				  
				  //print_r($query);
		return $this->mysql->query($query);
	}
	
	/**
	* Metodoq ue saca la sumatoria de los totales de la poliza
	*/
	public function sumatoriaPoliza($cod_proy){
		$query="
				SELECT distinct  SUM(adt.alm_age_adu_tra_det_monto) as TOTAL, 
SUM(ROUND((CASE WHEN pp.GRAL_PAR_PRO_COD<>3 AND adt.alm_age_adu_tra_det_factura = 1 THEN adt.alm_age_adu_tra_det_monto*.13 ELSE (CASE WHEN pp.GRAL_PAR_PRO_COD=3 THEN adt.alm_age_adu_tra_det_monto ELSE 0 END) END),2)) as TOTALIVA,
SUM(ROUND((adt.alm_age_adu_tra_det_monto-(CASE WHEN pp.GRAL_PAR_PRO_COD<>3 AND adt.alm_age_adu_tra_det_factura = 1 THEN adt.alm_age_adu_tra_det_monto*.13 ELSE (CASE WHEN pp.GRAL_PAR_PRO_COD=3 THEN adt.alm_age_adu_tra_det_monto ELSE 0 END) END)),2)) as TOTALNETO
from gral_param_propios pp INNER JOIN alm_age_adu_tra_det adt ON pp.GRAL_PAR_PRO_COD = adt.alm_age_adu_tra_det_item
WHERE pp.gral_par_pro_grp=1600 AND adt.alm_age_adu_tra_det_cod='".$cod_proy."'
ORDER BY pp.GRAL_PAR_PRO_COD ASC
				";
				return $this->mysql->query($query);
	}
	
	/**
	* Metodoq ue saca la la cabecera de la lista de la poliza
	*/
	public function cabeceraPoliza($id_liquidacion, $cod_proy){
		$query="
		SELECT DISTINCT aat.alm_age_adu_tra_cod_sidu as SIDUNEA,  aat.alm_age_adu_tra_id_age, aat.alm_age_adu_tra_cod,aat.alm_age_adu_tra_merc AS MERCADERIA,
        aat.alm_age_adu_tra_bulto BULTOS, (SELECT pp.gral_par_pro_sigla
FROM alm_age_adu_tra aat INNER JOIN gral_param_propios pp ON aat.alm_age_adu_tra_med_bulto=pp.gral_par_pro_cod
WHERE aat.alm_age_adu_tra_cod_proy='".$cod_proy."' AND pp.gral_par_pro_grp=1100 AND aat.alm_age_adu_tra_id=".$id_liquidacion.") as Medida,
        aat.alm_age_adu_tra_peso AS PESO, (SELECT  pp.gral_par_pro_sigla
FROM alm_age_adu_tra aat INNER JOIN gral_param_propios pp ON aat.alm_age_adu_tra_med_peso=pp.gral_par_pro_cod
WHERE aat.alm_age_adu_tra_cod_proy='".$cod_proy."' AND pp.gral_par_pro_grp=1100 AND aat.alm_age_adu_tra_id=".$id_liquidacion.") as peso,
        aat.alm_age_adu_tra_fac_comer, aat.alm_age_adu_tra_val_cif,
        aat.alm_age_adu_tra_cod_prov,pro.alm_prov_nombre
FROM alm_age_adu_tra aat INNER JOIN gral_param_propios pp ON pp.gral_par_pro_cod = aat.alm_age_adu_tra_med_bulto 
INNER JOIN alm_proveedor pro ON pro.alm_prov_codigo_int=aat.alm_age_adu_tra_cod_prov
WHERE aat.alm_age_adu_tra_cod_proy='".$cod_proy."' AND aat.alm_age_adu_tra_id=".$id_liquidacion." AND aat.alm_age_adu_tra_med_bulto = pp.gral_par_pro_cod 
      OR aat.alm_age_adu_tra_med_peso = pp.gral_par_pro_cod
      AND PP.gral_par_pro_grp=1100
				";
				return $this->mysql->query($query);
	}

		/**
	* Metodoq ue saca la la cabecera de la lista de la poliza
	*/
	public function cabeceraPoliza1($cod_proy){
		$query="SELECT DISTINCT aat.alm_age_adu_tra_cod_sidu as SIDUNEA, aat.alm_age_adu_tra_id_age, aat.alm_age_adu_tra_cod,aat.alm_age_adu_tra_merc AS MERCADERIA,
        aat.alm_age_adu_tra_bulto BULTOS, (SELECT pp.gral_par_pro_sigla
																						FROM alm_age_adu_tra aat INNER JOIN gral_param_propios pp ON aat.alm_age_adu_tra_med_bulto=pp.gral_par_pro_cod
																						WHERE aat.alm_age_adu_tra_cod_proy='".$cod_proy."' AND pp.gral_par_pro_grp=1100 AND aat.alm_age_adu_tra_cod_prov='Consolidado') as Medida,
        aat.alm_age_adu_tra_peso AS PESO, (SELECT  pp.gral_par_pro_sigla
																						FROM alm_age_adu_tra aat INNER JOIN gral_param_propios pp ON aat.alm_age_adu_tra_med_peso=pp.gral_par_pro_cod
																						WHERE aat.alm_age_adu_tra_cod_proy='".$cod_proy."' AND pp.gral_par_pro_grp=1100 AND aat.alm_age_adu_tra_cod_prov='Consolidado') as peso,
        aat.alm_age_adu_tra_fac_comer, aat.alm_age_adu_tra_val_cif,
        aat.alm_age_adu_tra_cod_prov
FROM alm_age_adu_tra aat INNER JOIN gral_param_propios pp ON pp.gral_par_pro_cod = aat.alm_age_adu_tra_med_bulto 
WHERE  aat.alm_age_adu_tra_cod_proy='".$cod_proy."' AND aat.alm_age_adu_tra_cod_prov='Consolidado'  AND (aat.alm_age_adu_tra_med_bulto = pp.gral_par_pro_cod 
      OR aat.alm_age_adu_tra_med_peso = pp.gral_par_pro_cod)
      AND PP.gral_par_pro_grp=1100 ";
				return $this->mysql->query($query);
	}

	/**
	*Metodo que saca la sumatorio de los totales de la poliza con el parametro cod proy
	*/
	public function sumatoriaPoliza2($codigo_proy,$codigo_prov){
	//echo($codigo_proy.$nro_ref);

	$query='SELECT SUM(det.alm_age_adu_tra_det_monto) AS total,
	SUM(ROUND((CASE WHEN pp.GRAL_PAR_PRO_COD<>3 AND det.alm_age_adu_tra_det_factura = 1 THEN det.alm_age_adu_tra_det_monto*.13 ELSE (CASE WHEN pp.GRAL_PAR_PRO_COD=3 THEN det.alm_age_adu_tra_det_monto ELSE 0 END) END),2)) as totaliva,
	SUM(ROUND((det.alm_age_adu_tra_det_monto-(CASE WHEN pp.GRAL_PAR_PRO_COD<>3 AND det.alm_age_adu_tra_det_factura = 1 THEN det.alm_age_adu_tra_det_monto*.13 ELSE (CASE WHEN pp.GRAL_PAR_PRO_COD=3 THEN det.alm_age_adu_tra_det_monto ELSE 0 END) END)),2)) as totalneto
	FROM alm_age_adu_tra cab INNER JOIN alm_age_adu_tra_det det ON cab.alm_age_adu_tra_cod= det.alm_age_adu_tra_det_cod 
	INNER JOIN gral_param_propios pp ON pp.GRAL_PAR_PRO_COD=det.alm_age_adu_tra_det_item
	WHERE cab.alm_age_adu_tra_cod_proy="'.$codigo_proy.'" AND pp.gral_par_pro_grp=1600 AND cab.alm_age_adu_tra_cod_prov="'.$codigo_prov.'"';
	return $this->mysql->query($query);
	}
	
}