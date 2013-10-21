<script type="text/javascript" language="javascript">
function cambioPais(opcionSeleccionada) {
var divCampo = document.getElementById('aquiCampo');
if (opcionSeleccionada == 'otro') {
divCampo.innerHTML = 'Nombre: <input type="text" name="nuevo_pais" size="20" />';
}else{
divCampo.innerHTML = '';
}
}
</script>
<form name="algo">
<select name="pais" id="pais" onchange="cambioPais(this.options

[this.selectedIndex].value);">
<option value="Argentina">Argentina</option>
<option value="Bolivia">Bolivia</option>
<option value="Brasil">Brasil</option>
<option value="Chile">Chile</option>
<option value="Colombia">Colombia</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cuba">Cuba</option>
<option value="Ecuador">Ecuador</option>
<option value="El Salvador">El Salvador</option>
<option value="Espana">España</option>
<option value="Guatemala">Guatemala</option>
<option value="Honduras">Honduras</option>
<option value="Mexico">México</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Panama">Panama</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Perú</option>
<option value="Uruguay">Uruguay</option>
<option value="Venezuela">Venezuela</option>
<option value="otro">Otro país </option>
</select>
<br />
<div id="aquiCampo"></div>
</form>