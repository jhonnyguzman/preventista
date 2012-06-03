<div class="searchShort">
	<p>
		<label>Apellido:</label>
		<input type="text" name="clientes_apellido" id="clientes_apellido" />
	</p>
	<p>
		<label>Nombre:</label>
		<input type="text" name="clientes_nombre" id="clientes_nombre" />
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchclientes',new Array('result-list','result-list'))" />	
	</p>
</div>

<script>
$(document).ready(function() {
	$("#clientes_nombre").keypress(function(){
		submitData2('formSearchclientes',new Array('result-list','result-list'));
	});
	$("#clientes_apellido").keypress(function(){
		submitData2('formSearchclientes',new Array('result-list','result-list'));
	});
});
</script>