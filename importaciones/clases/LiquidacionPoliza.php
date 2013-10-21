<?php

require_once '../lib/Mysql.php';
require_once 'Utilitarios.php';


/**
 * Clase Proyecto gestiona todas las consultas y formulario de agencias
 * @author ARGO SI 
 * @date 16/05/2013
 */
class AgenciaDespachante{
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
	/**
	 * Metodo que devuelve la lista de los proyectos
	 * @return el arreglo de la lista de proyectos
	 */
	public function listaProyectos(){
		$query = "select * from  alm_proyecto where  ISNULL(alm_proy_usr_baja)";
		return $this->mysql->query($query);
	}

	/**
	 * Metodo que se encarga de devolver el tipo dell proyecto
	 * @param $id_tipo  este es el id del tipo de proyecto
	 */
	public function obtenerTipo($id_tipo){
		$query = 'Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
                                                   From gral_param_propios 
                                                   where GRAL_PAR_PRO_GRP = 1500 and GRAL_PAR_PRO_COD <> 0  AND GRAL_PAR_PRO_COD='.$id_tipo;
		return $this->mysql->query($query);
	}

			/*
	* Metodo que crear la lista de los certificados 
	*/
	/*public function listaDetOpciones(){
		$template = file_get_contents('tpl/deta_seleccionar_form_tpl.html');
	    print($template);
		
	}*/

	/*
	 * Lista de tipos devulvel el arreglo con los tipos de preoyectos
	 * @return listaTipos arreglo
	 */
	public function listaAgencias(){
		$query = 'SELECT alm_age_adu_id, alm_age_adu_cod,alm_age_adu_nom FROM alm_age_adu WHERE alm_age_adu_usr_baja is null AND alm_age_adu_est="1"';
		return $this->mysql->query($query);
	}
	 /*
	 * Lista de de item del formulario agencia
	 * @return lista de item
	 */
	public function listaItems(){
		$query = 'SELECT GRAL_PAR_PRO_ID, GRAL_PAR_PRO_GRP, GRAL_PAR_PRO_COD, GRAL_PAR_PRO_SIGLA, GRAL_PAR_PRO_DESC
			FROM gral_param_propios 
			WHERE GRAL_PAR_PRO_GRP="1600" AND GRAL_PAR_PRO_COD<>"0" ORDER BY GRAL_PAR_PRO_COD';
		return $this->mysql->query($query);
	}

	/*
	* Metodo que crear el formulario de nuevos formulario agencia
	*/
	public function formularioAgenciaDespach(){
		$template = file_get_contents('tpl/agencia_despachante_tpl.html');
		// lista las agencias aduaneras para el combobox
		$agencias = $this->listaAgencias();
		$agen = '<select name="cod_age" size="1" size="10" id="cod_age">';
		$con = 0;
		foreach($agencias as $key => $agencia){
			if($con == 0){
				$agen = $agen.'<option value="" selected="selected">-Seleccione Valor-</option> <option value="'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_cod']).'" >'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_nom']).'</option>';
			}else{
				$agen = $agen.'<option value="'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_cod']).'">'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_nom']).'</option>';
			}
			$con++;
			
		}
		$agen = $agen.'</select><input type="hidden" id="nom_age_selec" name="nom_age_selec">';
		$template = str_replace('{cod_agencia}', $agen, $template);
		
		//Lista los item de la agencia aduanera
		$items = $this->listaItems();
		$item = ' ';
		foreach($items as $key => $items1){
			$item = $item.' <tr>
                <td align="left"><input type="hidden" name="item_age[]"  id="item_age" value="'.$items1['gral_param_propios']['GRAL_PAR_PRO_COD'].'">'.utf8_encode($items1['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</td>
            	<td align="left"><input class="txt_campo" type="text" name="des_age[]" id="des_age"></td>
                <td align="left"> <input type="text" name="monto_age[]" id="monto_age" class="txt_campo" onKeyPress="return soloNum(event)"></td>
               <td align="center"><input type="checkbox"  name="factura_age[]" id="factura_age" value="'.$items1['gral_param_propios']['GRAL_PAR_PRO_COD'].'"></td></tr>';
			
		
		}
		$template = str_replace('{cod_item}', $item, $template);
        print($template);
	}

	/**
	 * Metodo que graba los datos de la agencia aduanera en la base de datos
	 * @param $nombre_proyecto, $tipo_proyecto,$fec_ini,$fec_fin,$descripcion_proyecto
	 */	

	public function grabarAgeDesp($cod_proy,$cod_agencia,$nom_agencia, $nro_fac_age,$fec_age,$nro_sid_age,$item_age,$des_age,$monto_age,$factura_age,$login,$fec_sistema){	
		$util = new Utilitarios();					
		/*
		*prefijo de la agencia adunaera
		*/
		$prefijo=substr(utf8_encode(strtoupper($nom_agencia)),0,3);

		/*
		* Muestra el ultimo correlativo de 
		*/
		$query = 'SELECT MAX(alm_age_adu_tra_num_corr) AS max_numero FROM alm_age_adu_tra WHERE alm_age_adu_tra_est=1 AND 				substr(alm_age_adu_tra_cod,1,3)="'.$prefijo.'"';
		
		$max= $this->mysql->query($query);
		$corr_max=$max[0][0]['max_numero']; // muetra el numero maximo del correlativo
	
		if($corr_max == NULL or $corr_max == ''){
			$corr_max_i=1;
			}else{
				$corr_max_i =$corr_max + 1;
				}
		$num_corr=$util->NumCorrelativo($corr_max_i,'3');// Funcion pue asigana ceros a la izqquierda
		$corr=$prefijo.$num_corr;//concatenacion de $prefijo(3 primeras letras del nombre de la agencia) y el $numcorr(numero correlativo)
		//echo $corr.'codigo final<br>';
		
		/*
		* Asigancion de variables para los checkbox
		*/
		$fac_chec=$factura_age;
		$fac_lista=$item_age;
		$num_cabecera=count($cod_agencia);
		$num_total = count($fac_lista);
		$nun_chec = count($fac_chec);

		/*
		*los checkbox no tiqueados le ponemos  de vlaor "1"	
		*/
			for ($i = 0; $i < $num_total; $i++) {
				for ($j = 0; $j < $nun_chec; $j++) {
					if($fac_lista[$i]==$fac_chec[$j]){
						$fac_lista[$i]='true';
					}
				}
			}
		/*
		*los checkbox no tiqueados le ponemos  de vlaor "0"
		*/
		 $total1 = count($fac_lista);
			for ($i = 0; $i < $total1; $i++) {
				if($fac_lista[$i]!='true'){
						$fac_lista[$i]='false';	
				}
			}
		/*
		*valores de los checkbox se lo cambia a enteros True=1 y False=0. Esto por que surge prolemas con el codigo del item
		*/		
		for ($i = 0; $i < $total1; $i++) {
			if($fac_lista[$i]=='true'){
					$fac_lista[$i]=1;
				}else {
					$fac_lista[$i]=0;
					} 
		}
		/*
		* Controlamos que entre una sola vez para insertar la cabecera
		*/
		 if ($num_cabecera == 1) {
		//inserta valores en la cabecera	
		$valor['alm_age_adu_tra_id'] = NULL;
		$valor['alm_age_adu_tra_cod'] = $corr;
		$valor['alm_age_adu_tra_num_corr'] = $corr_max_i;
		$valor['alm_age_adu_tra_id_age'] = $cod_agencia;
		$valor['alm_age_adu_tra_cod_proy'] =$cod_proy;
		$valor['alm_age_adu_tra_nro_fac'] = $nro_fac_age;
		$valor['alm_age_adu_tra_fecha'] = $util->cambiaf_a_mysql($fec_age);
		$valor['alm_age_adu_tra_cod_sidu'] = utf8_encode(strtoupper($nro_sid_age));
		$valor['alm_age_adu_tra_est'] = 1;
		$valor['alm_age_adu_tra_usr_alta'] =$login;
		
			if($this->mysql->insert('alm_age_adu_tra', $valor)){
				
				for ($i = 0; $i < $num_total; $i++) {
					//Insetamos en el detalle
					$valor1['alm_age_adu_tra_det_id'] = NULL;
					$valor1['alm_age_adu_tra_det_cod'] =$corr;
					$valor1['alm_age_adu_tra_det_item'] = $item_age[$i];
					$valor1['alm_age_adu_tra_det_descrip'] = utf8_encode(strtoupper($des_age[$i]));
					$valor1['alm_age_adu_tra_det_monto'] =$monto_age[$i];
					$valor1['alm_age_adu_tra_det_factura'] = $fac_lista[$i];
					$valor1['alm_age_adu_tra_det_usr_alta'] = $login;
					
					$this->mysql->insert('alm_age_adu_tra_det', $valor1);
				}
					
					$valor2['alm_form_id'] = NULL;
					$valor2['alm_form_tipo'] ='11';
					$valor2['alm_form_nro_doc'] = $nro_fac_age;
					$valor2['alm_form_fecha_doc'] = $util->cambiaf_a_mysql($fec_age);
					$valor2['alm_proy_cod'] =$cod_proy;
					$valor2['alm_age_adu_id'] = $cod_agencia;
					$valor2['alm_form_fecha_registro'] = $fec_sistema;
					$valor2['alm_form_usr_alta'] = $login;
					
					$this->mysql->insert('alm_form_importacion', $valor2);
				
		
				$json_data['completo'] = true;
				$json_data['estado_proyecto'] = 11;
				$json_data['codigo_proyecto'] = $cod_proy;
			}else{
				$json_data['completo'] = false;
			}
		 }
		print(json_encode($json_data));
	 }

	 /**
	  *  Metodo que permite imprimir el dialogo de los mensajes en el html
	  *
	  */
	 public function dialogoMensaje(){
	 	$template = file_get_contents('tpl/dialogo_msg_tpl.html');
	 	print($template);
	 }
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }
}
?>