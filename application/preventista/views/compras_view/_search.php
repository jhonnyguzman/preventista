<div class="searchShort">
	<p>
		<label><?=$this->config->item("proveedores_id")?></label>
		<select name="proveedores_id" id="proveedores_id">
			<option value="">Seleccione</option>
			<?php foreach($proveedores as $f):?>
				<option value="<?=$f->proveedores_id?>"><?=$f->proveedores_apellido." ".$f->proveedores_nombre?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("compras_created_at")?>:</label>
		<input type="text" name="compras_created_at" id="compras_created_at" />
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchcompras',new Array('result-list','result-list'))" />
	</p>
</div>

<script>
$(document).ready(function() {
	setDatePicker(new Array('compras_created_at'));
	$("#proveedores_id").click(function(){
		submitData2('formSearchcompras',new Array('result-list','result-list'));
	});
	$("#compras_created_at").change(function(){
		submitData2('formSearchcompras',new Array('result-list','result-list'));
	});
});
</script>