<?php
require_once '../lib/Mysql.php';
require_once 'Utilitarios.php';
require_once 'Proveedor.php';
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

	/*
	 * Lista de tipos devulvel el arreglo con los tipos de preoyectos
	 * @return listaTipos arreglo
	 */
	public function listaAgencias(){
		$query = 'SELECT alm_age_adu_id, alm_age_adu_cod,alm_age_adu_nom FROM alm_age_adu WHERE alm_age_adu_usr_baja is null AND alm_age_adu_est="1"';
		return $this->mysql->query($query);
	}

			/*
	* Metodo que crear la lista de los certificados 
	*/
	public function listaAgeOpciones(){
		$template = file_get_contents('tpl/age_seleccionar_form_tpl.html');
	    print($template);
		
	}


		/*
	 * Lista de tipos devulvel el arreglo con los tipos de preoyectos
	 * @return listaTipos arreglo
	 */
	public function listaAge($cod_proy, $cod_prov){
		$query = 'SELECT * FROM alm_age_adu_tra WHERE alm_age_adu_tra_cod_proy="'.$cod_proy.'" AND alm_age_adu_tra_cod_prov="'.$cod_prov.'" AND ISNULL(alm_age_adu_tra_usr_baja)';
		return $this->mysql->query($query);
	}

			/*
	 * Lista de tipos devulvel el arreglo con los tipos de preoyectos
	 * @return listaTipos arreglo
	 */
	public function planillaCons($cod_proy){
		$query = 'SELECT *
				  FROM alm_form_importacion 
                  WHERE alm_proy_cod="'.$cod_proy.'"  AND alm_form_tipo=10 AND ISNULL(alm_prov_id ) AND ISNULL(alm_form_usr_baja)';
		return $this->mysql->query($query);
	}
	/*
	*Lista planilla aduanera
	*/
	public function formularioListarAgenciaDespachante(){
	 	$template = file_get_contents('tpl/lista_planilla_tpl.html');
	 	print($template);
	 }

	 	/*
	*formulario detallar planilla aduanera
	*/
	public function formularioDetallarPlanillaAduanera(){
	 	$template = file_get_contents('tpl/detallar_agencia_despachante_tpl.html');
	 	print($template);
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
	 * Lista de Unidades de Medida
	 */
	public function listaUnidadMedida(){
		$query = 'SELECT GRAL_PAR_PRO_ID, GRAL_PAR_PRO_GRP, GRAL_PAR_PRO_COD, GRAL_PAR_PRO_SIGLA, GRAL_PAR_PRO_DESC
			FROM gral_param_propios 
			WHERE GRAL_PAR_PRO_GRP="1100" AND GRAL_PAR_PRO_COD<>"0" ORDER BY GRAL_PAR_PRO_COD';
		return $this->mysql->query($query);
	}

	/*
	* Metodo que crear el formulario de nuevos formulario agencia
	*/
	public function formularioAgenciaDespach(){
		$provee = new Proveedor();
		$template = file_get_contents('tpl/agencia_despachante_tpl.html');
		
		// lista las agencias aduaneras para el combobox
		$agencias = $this->listaAgencias();
		$agen = '<select name="cod_age" size="1" size="10" id="cod_age" style="height:30px">';
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
		
		// lista de proveedores para el combobox
		$proveedores = $provee->listaProveedores();
		$pro = '<select name="cod_prov" size="1" size="10" id="cod_prov"  style="height:30px">';
		$con = 0;
		foreach($proveedores as $key => $proveedor){
			if($con == 0){
				$pro = $pro.' <option value="'.utf8_encode($proveedor['alm_proveedor']['alm_prov_codigo_int']).'" >'.utf8_encode($proveedor['alm_proveedor']['alm_prov_nombre']).'</option>';
			}else{
				$pro = $pro.'<option value="'.utf8_encode($proveedor['alm_proveedor']['alm_prov_codigo_int']).'">'.utf8_encode($proveedor['alm_proveedor']['alm_prov_nombre']).'</option>';
			}
			$con++;
		}
		$pro = $pro.'</select>';
		$template = str_replace('{cod_proveedor}', $pro, $template);
	
		// lista unidades(Bultos) de medida para el combobox
		$uni_medidas = $this->listaUnidadMedida();
		$med = '<select name="und_med_bulto" size="1" size="10" id="und_med_bulto" style="width:160px;height:30px">';
		$con = 0;
		foreach($uni_medidas as $key => $uni_medida){
			if($con == 0){
				$med = $med.'<option value="" selected="selected">-Seleccione Valor-</option> <option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'" >'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}else{
				$med = $med.'<option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'">'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}
			$con++;
		}
		$pro = $med.'</select>';
		$template = str_replace('{unid_med_bulto}', $med, $template);
	
		// lista unidades(Peso) de medida para el combobox
		$uni_medidas = $this->listaUnidadMedida();
		$med = '<select name="und_med_peso" size="1" size="10" id="und_med_peso" style="width:160px;height:30px">';
		$con = 0;
		foreach($uni_medidas as $key => $uni_medida){
			if($con == 0){
				$med = $med.'<option value="" selected="selected">-Seleccione Valor-</option> <option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'" >'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}else{
				$med = $med.'<option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'">'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}
			$con++;
		}
		$pro = $med.'</select>';
		$template = str_replace('{unid_med_peso}', $med, $template);
	
		//Lista los item de la agencia aduanera
		$items = $this->listaItems();
		$item = ' ';
		foreach($items as $key => $items1){
			$item = $item.' <tr>
                <td align="left"><input type="hidden" name="item_age[]"  id="item_age" value="'.$items1['gral_param_propios']['GRAL_PAR_PRO_COD'].'">'.utf8_encode($items1['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</td>
            	<td align="left"><input type="text" name="des_age[]" id="des_age"></td>
                <td align="left"> <input type="number" name="monto_age[]" id="monto_age" onKeyPress="return soloNum(event)"></td>
               <td align="center"><input type="checkbox"  name="factura_age[]" id="factura_age" value="'.$items1['gral_param_propios']['GRAL_PAR_PRO_COD'].'"></td></tr>';
			
		
		}
		$template = str_replace('{cod_item}', $item, $template);
        print($template);
	}

	/*
	* Metodo que crear el formulario de nuevos formulario agencia
	*/
	/*public function formularioAgenciaDespachCons(){
		$provee = new Proveedor();
		$template = file_get_contents('tpl/agencia_despachante_cons_tpl.html');
		
		// lista las agencias aduaneras para el combobox
		$agencias = $this->listaAgencias();
		$agen = '<select name="cod_age1" size="1" size="10" id="cod_age1" style="height:30px">';
		$con = 0;
		foreach($agencias as $key => $agencia){
			if($con == 0){
				$agen = $agen.'<option value="" selected="selected">-Seleccione Valor-</option> <option value="'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_cod']).'" >'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_nom']).'</option>';
			}else{
				$agen = $agen.'<option value="'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_cod']).'">'.utf8_encode($agencia['alm_age_adu']['alm_age_adu_nom']).'</option>';
			}
			$con++;
		}
		$agen = $agen.'</select><input type="text" id="nom_age_selec1" name="nom_age_selec1">';
		$template = str_replace('{cod_agencia1}', $agen, $template);
		
		// lista de proveedores para el combobox
		//$proveedores = $provee->listaProveedores();
		$pro = 'Consolidado';
		//$con = 0;
		/*foreach($proveedores as $key => $proveedor){
			if($con == 0){
				$pro = $pro.' <option value="'.utf8_encode($proveedor['alm_proveedor']['alm_prov_codigo_int']).'" >'.utf8_encode($proveedor['alm_proveedor']['alm_prov_nombre']).'</option>';
			}else{
				$pro = $pro.'<option value="'.utf8_encode($proveedor['alm_proveedor']['alm_prov_codigo_int']).'">'.utf8_encode($proveedor['alm_proveedor']['alm_prov_nombre']).'</option>';
			}
			$con++;
		}*/
		//$pro = $pro.'</select>';
		//$template = str_replace('{cod_proveedor1}', $pro, $template);
	
		// lista unidades(Bultos) de medida para el combobox
		//$uni_medidas = $this->listaUnidadMedida();
		//$med = '<select name="und_med_bulto1" size="1" size="10" id="und_med_bulto1" style="width:160px;height:30px">';
		/*$con = 0;
		foreach($uni_medidas as $key => $uni_medida){
			if($con == 0){
				$med = $med.'<option value="" selected="selected">-Seleccione Valor-</option> <option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'" >'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}else{
				$med = $med.'<option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'">'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}
			$con++;
		}
		$pro = $med.'</select>';
		$template = str_replace('{unid_med_bulto1}', $med, $template);
	
		// lista unidades(Peso) de medida para el combobox
		$uni_medidas = $this->listaUnidadMedida();
		$med = '<select name="und_med_peso1" size="1" size="10" id="und_med_peso1" style="width:160px;height:30px">';
		$con = 0;
		foreach($uni_medidas as $key => $uni_medida){
			if($con == 0){
				$med = $med.'<option value="" selected="selected">-Seleccione Valor-</option> <option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'" >'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}else{
				$med = $med.'<option value="'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_COD']).'">'.utf8_encode($uni_medida['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</option>';
			}
			$con++;
		}
		$pro = $med.'</select>';
		$template = str_replace('{unid_med_peso1}', $med, $template);
	
		//Lista los item de la agencia aduanera
		$items = $this->listaItems();
		$item = ' ';
		foreach($items as $key => $items1){
			$item = $item.' <tr>
                <td align="left"><input type="hidden" name="item_age1[]"  id="item_age1" value="'.$items1['gral_param_propios']['GRAL_PAR_PRO_COD'].'">'.utf8_encode($items1['gral_param_propios']['GRAL_PAR_PRO_DESC']).'</td>
            	<td align="left"><input type="text" name="des_age1[]" id="des_age1"></td>
                <td align="left"> <input type="text" name="monto_age1[]" id="monto_age1" onKeyPress="return soloNum(event)"></td>
               <td align="center"><input type="checkbox"  name="factura_age1[]" id="factura_age1" value="'.$items1['gral_param_propios']['GRAL_PAR_PRO_COD'].'"></td></tr>';
			
		
		}
		$template = str_replace('{cod_item1}', $item, $template);
        print($template);
	}*/
	/**
	 * Metodo que graba los datos de la agencia aduanera en la base de datos
	 * @param $nombre_proyecto, $tipo_proyecto,$fec_ini,$fec_fin,$descripcion_proyecto
	 */	

	public function grabarAgeDesp($cod_proy,$cod_agencia,$nom_agencia, $nro_fac_age,$fec_age,$nro_sid_age,$mercaderia,$bulto,$medida_bulto,$peso,$medida_peso,$fact_comerc,$valor_cib,$cod_proveedor,$item_age,$des_age,$monto_age,$factura_age,$login,$fec_sistema){	
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
		$corr_max=$max[0][0]['max_numero']; // muestra el numero maximo del correlativo
	
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
			//print_r($fac_lista);
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
		$valor['alm_age_adu_tra_merc'] = utf8_encode(strtoupper($mercaderia));
		$valor['alm_age_adu_tra_bulto'] = $bulto;
		$valor['alm_age_adu_tra_med_bulto'] = $medida_bulto;
		$valor['alm_age_adu_tra_peso'] = $peso;
		$valor['alm_age_adu_tra_med_peso'] = $medida_peso;
		$valor['alm_age_adu_tra_fac_comer'] = utf8_encode(strtoupper($fact_comerc));
		$valor['alm_age_adu_tra_val_cif'] = $valor_cib;
		$valor['alm_age_adu_tra_cod_prov'] = $cod_proveedor;
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
					$valor2['alm_prov_id'] =$cod_proveedor;
					$valor2['alm_proy_cod'] =$cod_proy;
					$valor2['alm_age_adu_id'] = $cod_agencia;
					$valor2['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_sistema);
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
	 * Metodo que graba los datos de la agencia aduanera en la base de datos
	 * @param $nombre_proyecto, $tipo_proyecto,$fec_ini,$fec_fin,$descripcion_proyecto
	 */	

	public function grabarAgeDesp1($cod_proy,$cod_agencia,$nom_agencia, $nro_fac_age,$fec_age,$nro_sid_age,$mercaderia,$bulto,$medida_bulto,$peso,$medida_peso,$fact_comerc,$valor_cib,$item_age,$des_age,$monto_age,$factura_age,$login,$fec_sistema){	
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
		$corr_max=$max[0][0]['max_numero']; // muestra el numero maximo del correlativo
	
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
			//print_r($fac_lista);
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
		$valor['alm_age_adu_tra_merc'] = utf8_encode(strtoupper($mercaderia));
		$valor['alm_age_adu_tra_bulto'] = $bulto;
		$valor['alm_age_adu_tra_med_bulto'] = $medida_bulto;
		$valor['alm_age_adu_tra_peso'] = $peso;
		$valor['alm_age_adu_tra_med_peso'] = $medida_peso;
		$valor['alm_age_adu_tra_fac_comer'] = utf8_encode(strtoupper($fact_comerc));
		$valor['alm_age_adu_tra_val_cif'] = $valor_cib;
		$valor['alm_age_adu_tra_cod_prov'] = 'Consolidado';
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
					$valor2['alm_prov_id'] ='Consolidado';
					$valor2['alm_proy_cod'] =$cod_proy;
					$valor2['alm_age_adu_id'] = $cod_agencia;
					$valor2['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_sistema);
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
	 * Metodo que graba los datos de la agencia aduanera en la base de datos
	 * @param $nombre_proyecto, $tipo_proyecto,$fec_ini,$fec_fin,$descripcion_proyecto
	 */	

	public function grabarAgeDespCons($cod_proy,$cod_agencia,$nom_agencia, $nro_fac_age,$fec_age,$nro_sid_age,$mercaderia,$bulto,$medida_bulto,$peso,$medida_peso,$fact_comerc,$valor_cib,$cod_proveedor,$item_age,$des_age,$monto_age,$factura_age,$login,$fec_sistema){	
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
		$corr_max=$max[0][0]['max_numero']; // muestra el numero maximo del correlativo
	
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
			//print_r($fac_lista);
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
		$valor['alm_age_adu_tra_merc'] = utf8_encode(strtoupper($mercaderia));
		$valor['alm_age_adu_tra_bulto'] = $bulto;
		$valor['alm_age_adu_tra_med_bulto'] = $medida_bulto;
		$valor['alm_age_adu_tra_peso'] = $peso;
		$valor['alm_age_adu_tra_med_peso'] = $medida_peso;
		$valor['alm_age_adu_tra_fac_comer'] = utf8_encode(strtoupper($fact_comerc));
		$valor['alm_age_adu_tra_val_cif'] = $valor_cib;
		$valor['alm_age_adu_tra_cod_prov'] = $cod_proveedor;
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
					$valor2['alm_prov_id'] =$cod_proveedor;
					$valor2['alm_proy_cod'] =$cod_proy;
					$valor2['alm_age_adu_id'] = $cod_agencia;
					$valor2['alm_form_fecha_registro'] = $util->cambiaf_a_mysql($fec_sistema);
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
	 * Metodo que graba los datos modificados de la agencia aduanera en la base de datos
	 */	
	public function grabarModAgeDesp($cod_proy,$cod,$age_corr,$cod_agencia, $nro_fac_age,$fec_age,$nro_sid_age,$mercaderia,$bulto,$medida_bulto,$peso,$medida_peso,$fact_comerc,$valor_cib,$cod_proveedor,$item_age,$des_age,$monto_age,$factura_age,$login,$fec_sistema){	
	
		$util = new Utilitarios();
				
		$fecha= $util->obtenerFechaActual();	

		/*
		* Asigancion de variables para los checkbox
		*/
		$fac_chec=$factura_age;
		$fac_lista=$item_age;
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
		
		//actualizamso en la cabecra
		$valor['alm_age_adu_tra_usr_baja'] =$login;
		$valor['alm_age_adu_tra_fch_baja']=$fecha;
				//print_r($fac_lista);
				//print_r($valor);
				if($this->mysql->update('alm_age_adu_tra', $valor,'alm_age_adu_tra_fch_baja IS NULL AND alm_age_adu_tra_cod_proy="'.$cod_proy.'" AND alm_age_adu_tra_cod_prov="'.$cod_proveedor.'"')){
					
					for ($i = 0; $i < $num_total; $i++) {
					//actualizamso en el detalle
					$valor1['alm_age_adu_tra_det_usr_baja'] =$login;
					$valor1['alm_age_adu_tra_det_fch_baja'] = $fecha;
					
					$this->mysql->update('alm_age_adu_tra_det', $valor1,'alm_age_adu_tra_det_usr_baja IS NULL AND alm_age_adu_tra_det_cod="'.$cod.'"');
					}
					//inserta valores en la cabecera
					$valor2['alm_age_adu_tra_id'] = NULL;
					$valor2['alm_age_adu_tra_cod'] = $cod;
					$valor2['alm_age_adu_tra_num_corr'] = $age_corr;
					$valor2['alm_age_adu_tra_id_age'] = $cod_agencia;
					$valor2['alm_age_adu_tra_cod_proy'] =$cod_proy;
					$valor2['alm_age_adu_tra_nro_fac'] = $nro_fac_age;
					$valor2['alm_age_adu_tra_fecha'] = $fec_age;
					$valor2['alm_age_adu_tra_cod_sidu'] = utf8_encode(strtoupper($nro_sid_age));
					$valor2['alm_age_adu_tra_merc'] = utf8_encode(strtoupper($mercaderia));
					$valor2['alm_age_adu_tra_bulto'] = $bulto;
					$valor2['alm_age_adu_tra_med_bulto'] = $medida_bulto;
					$valor2['alm_age_adu_tra_peso'] = $peso;
					$valor2['alm_age_adu_tra_med_peso'] = $medida_peso;
					$valor2['alm_age_adu_tra_fac_comer'] = utf8_encode(strtoupper($fact_comerc));
					$valor2['alm_age_adu_tra_val_cif'] = $valor_cib;
					$valor2['alm_age_adu_tra_cod_prov'] = $cod_proveedor;
					$valor2['alm_age_adu_tra_est'] = 1;
					$valor2['alm_age_adu_tra_usr_alta'] =$login;
					
						if($this->mysql->insert('alm_age_adu_tra', $valor2)){
							
							for ($i = 0; $i < $num_total; $i++) {
								//Insetamos en el detalle
								$valor3['alm_age_adu_tra_det_id'] = NULL;
								$valor3['alm_age_adu_tra_det_cod'] =$cod;
								$valor3['alm_age_adu_tra_det_item'] = $item_age[$i];
								$valor3['alm_age_adu_tra_det_descrip'] = utf8_encode(strtoupper($des_age[$i]));
								$valor3['alm_age_adu_tra_det_monto'] =$monto_age[$i];
								$valor3['alm_age_adu_tra_det_factura'] = $fac_lista[$i];
								$valor3['alm_age_adu_tra_det_usr_alta'] = $login;
								
								$this->mysql->insert('alm_age_adu_tra_det', $valor3);
							}
								$json_data['completo'] = true;
							    $json_data['estado_proyecto'] = 11;
								$json_data['codigo_proyecto'] = $cod_proy;
						}else{
							$json_data['completo'] = false;
						}		
				print(json_encode($json_data));
			
	
		}else{
		 return false;
		}
	}
	 /**
	  *  Metodo que permite imprimir el dialogo de los mensajes en el html
	  */
	 public function dialogoMensaje(){
	 	$template = file_get_contents('tpl/dialogo_msg_tpl.html');
	 	print($template);
	 }
	 public function convertirNormal($fecha){
		 $util = new Utilitarios();
		 return $util->cambiaf_a_normal($fecha);
	 }
	/*
    * Dar de baja planilla
	*/
	 public function darBajaAgenciaLista($id_agencia, $codigo_proyecto,$cod_agencia, $login){
    //echo("GRABAR PHP CERT");
	$util = new Utilitarios();
	$fecha= $util->obtenerFechaActual();
    $value['alm_age_adu_tra_usr_baja']=$login;
	$value['alm_age_adu_tra_fch_baja']=$fecha;
	//$value2['alm_age_adu_tra_usr_det_baja']=$login;
	//$value2['alm_age_adu_tra_fch_det_baja']=$fecha;
	if ($this->mysql->update('alm_age_adu_tra',$value,'alm_age_adu_tra_id='.$id_agencia.'')) {
		$json_data['completo'] = true;
		$json_data['tipo_formulario']=11;
		$json_data['codigo_proyecto']=$codigo_proyecto;
	}else{
		$json_data['completo'] = false;
		}
	print(json_encode($json_data));
	}
	
	/*
	* Metodo que selecciona la transaccion aduanera del proyecto seleccionado Cabecera
	*/
	
	public function ModcodigoProyectoCabecera($cod_proy,$cod_aduana){	
		/*print_r($cod_proy);*/
		$query = "SELECT alm_age_adu_tra_id,alm_age_adu_tra_cod,alm_age_adu_tra_num_corr ,alm_age_adu_tra_id_age,alm_age_adu_tra_cod_proy,alm_age_adu_tra_nro_fac,
alm_age_adu_tra_fecha,alm_age_adu_tra_cod_sidu,alm_age_adu_tra_merc,alm_age_adu_tra_bulto,alm_age_adu_tra_med_bulto,alm_age_adu_tra_peso,
alm_age_adu_tra_med_peso,alm_age_adu_tra_fac_comer,alm_age_adu_tra_val_cif,alm_age_adu_tra_cod_prov,alm_age_adu_tra_monto,alm_age_adu_tra_est,
alm_age_adu_tra_usr_alta,alm_age_adu_tra_fch_alta,alm_age_adu_tra_usr_baja,alm_age_adu_tra_fch_baja
FROM alm_age_adu_tra 
WHERE alm_age_adu_tra_cod_proy='$cod_proy' AND alm_age_adu_tra_cod='$cod_aduana' AND  alm_age_adu_tra_est='1' AND alm_age_adu_tra_usr_baja IS NULL";
		return $this->mysql->query($query);
	}
	
	/*
	* Metodo que selecciona la transaccion aduanera del proyecto seleccionado Detalle
	*/
	public function ModcodigoProyectoDetalle($cod_proy,$cod_aduana){
		$query = "SELECT alm_age_adu_tra_det_id,alm_age_adu_tra_det_cod,alm_age_adu_tra_det_item,(SELECT GRAL_PAR_PRO_DESC	FROM gral_param_propios WHERE GRAL_PAR_PRO_GRP='1600' AND GRAL_PAR_PRO_COD<>'0' AND GRAL_PAR_PRO_COD=alm_age_adu_tra_det_item) AS ItemDesc,alm_age_adu_tra_det_descrip,alm_age_adu_tra_det_monto,
alm_age_adu_tra_det_factura,alm_age_adu_tra_det_usr_alta,alm_age_adu_tra_det_fch_alta,alm_age_adu_tra_det_usr_baja,alm_age_adu_tra_det_fch_baja 
FROM alm_age_adu_tra_det 
WHERE alm_age_adu_tra_det_cod=(SELECT alm_age_adu_tra_cod FROM alm_age_adu_tra WHERE alm_age_adu_tra_cod_proy='$cod_proy' AND alm_age_adu_tra_cod='$cod_aduana' AND  alm_age_adu_tra_est='1' AND alm_age_adu_tra_usr_baja IS NULL) AND alm_age_adu_tra_det_usr_baja IS NULL";
		
		//print_r($query);
		return $this->mysql->query($query);
	}
	
	/*
	* Metodo que selecciona la Cabecera Orden de compra auiiiiiiiiiiiiiiiii
	*/
	
	public function ListarCabeceraOrdenCompra($cod_proy){	
		/*print_r($cod_proy);*/
		$query = "SELECT ord.alm_proy_cod,ord.alm_id_orden_compra, ord.alm_nro_referencia_orden, ord.alm_nro_proforma, ord.alm_fecha_proforma, ord.alm_fecha_orden_registro, ord.alm_termino_pago, 
ord.alm_terms, ord.alm_prov_id,(SELECT p.alm_prov_nombre FROM alm_proveedor p WHERE p.alm_prov_usr_baja IS NULL AND p.alm_prov_codigo_int=ord.alm_prov_id  )AS alm_prov_nombre 
FROM alm_ord_compra_cab ord  
WHERE ISNULL(ord.alm_ord_compra_usr_baja) AND alm_nro_referencia_orden='7891011' AND ord.alm_nro_proforma='568' AND ord.alm_proy_cod='LIC0006'";
		return $this->mysql->query($query);
	}	
	
	/*
	* Metodo que selecciona el detalle orden de compra
	*/
	
	public function ListarDetalleOrdenCompra($cod_proy){	
		/*print_r($cod_proy);*/
		$query = "SELECT alm_nro_orden_compra, alm_cod_proyecto,alm_nro_proforma, alm_nro_parte_ord_compra, alm_descripcion, alm_cantidad_ord, alm_unidad_um, alm_precio_unitario, alm_precio_unitario,
alm_precio_moneda
FROM alm_ord_compra_det
WHERE alm_item_ord_usr_baja IS NULL  AND alm_nro_orden_compra='7891011' AND alm_nro_proforma='568' AND alm_cod_proyecto='LIC0006'";
		return $this->mysql->query($query);
	}	
	
	/*
	* Metodo que lista las planillas aduaneras
	*/
	
	public function listarPlanillasAduaneras($cod_proy){	
		//echo($cod_proy);
		$query = 'SELECT *, pro.alm_prov_nombre 
				  FROM alm_age_adu_tra adu INNER JOIN alm_proveedor pro ON adu.alm_age_adu_tra_cod_prov=pro.alm_prov_codigo_int 
				  WHERE alm_age_adu_tra_cod_proy="'.$cod_proy.'" AND ISNULL(pro.alm_prov_usr_baja) AND ISNULL(adu.alm_age_adu_tra_fch_baja)';
		//echo($query);
		return $this->mysql->query($query);
	}

	/*
	* Metodo que detalla la cabecera de la planilla
	*/
	
	public function detalleCabeceraAduana($cod_proy, $id_aduana){	
		//echo($cod_proy);
		$query = 'SELECT adu.alm_age_adu_tra_id,adu.alm_age_adu_tra_cod,adu.alm_age_adu_tra_id_age,adu.alm_age_adu_tra_cod_proy, pro.alm_prov_nombre, age.alm_age_adu_nom,
		adu.alm_age_adu_tra_nro_fac,adu.alm_age_adu_tra_fecha, adu.alm_age_adu_tra_cod_sidu, adu.alm_age_adu_tra_merc, adu.alm_age_adu_tra_bulto, 
		adu.alm_age_adu_tra_med_bulto,adu.alm_age_adu_tra_peso, adu.alm_age_adu_tra_med_peso, adu.alm_age_adu_tra_fac_comer, adu.alm_age_adu_tra_val_cif,
		adu.alm_age_adu_tra_monto, adu.alm_age_adu_tra_est
		FROM alm_age_adu_tra adu INNER JOIN alm_proveedor pro ON adu.alm_age_adu_tra_cod_prov=pro.alm_prov_codigo_int 
		INNER JOIN alm_age_adu age ON adu.alm_age_adu_tra_id_age=age.alm_age_adu_cod
		WHERE adu.alm_age_adu_tra_cod_proy="'.$cod_proy.'" AND ISNULL(pro.alm_prov_usr_baja) AND adu.alm_age_adu_tra_id='.$id_aduana.' AND ISNULL(age.alm_age_adu_usr_baja)';
				//echo($query);
		return $this->mysql->query($query);
	}		
	
	/*
	* Metodo que crear el formulario de Modificacion formulario agencia
	*/
	public function formularioModificacionAgenciaDespach(){
		$provee = new Proveedor();
		$template = file_get_contents('tpl/agencia_despachante_modif_tpl.html');

        print($template);	

	}
	
	public function GrabarModificacionAgenciaDespachante(){
		$provee = new Proveedor();
		$template = file_get_contents('tpl/agencia_despachante_modif_tpl.html');

        print($template);	

	}

}
?>