<div class="searchShort">
	<p>
		<label>Descripci&oacute;n</label>
		<input type="text" name="articulos_descripcion" id="articulos_descripcion" />
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchByArticulo',new Array('result-list','result-list'))" />
	</p>
</div>

<script>
$(document).ready(function() {
	$("#articulos_descripcion").keypress(function(){
		submitData2('formSearchByArticulo',new Array('result-list','result-list'));
	});
});
</script>