<div class="searchShort">
	<p>
		<label><?=$this->config->item("clientes_apellido")?>:</label>
		<select name="clientes_id" id="clientes_id">
			<option value="">Seleccione</option>
			<?php foreach($clientes as $f):?>
				<option value="<?=$f->clientes_id?>"><?=$f->clientes_apellido." ".$f->clientes_nombre?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchcuentacorriente',new Array('result-list','result-list'))" />
	</p>
</div>

<script>
$(document).ready(function() {

	$("#clientes_id").change(function(){
			submitData2('formSearchcuentacorriente',new Array('result-list','result-list'));
	});
});
</script>