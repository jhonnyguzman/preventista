<div class="searchShort">
	<p>
		<label><?=$this->config->item("clientes_apellido")?>:</label>
		<select name="clientes_id" id="clientes_id">
			<option value="">Seleccione</option>
			<?php foreach($clientes as $f):?>
				<option value="<?=$f->clientes_id?>"><?=$f->clientes_apellido." ".$f->clientes_nombre?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("usuarios_username")?></label>
		<select name="usuarios_id" id="usuarios_id">
			<option value="">Seleccione</option>
			<?php foreach($usuarios as $f):?>
				<option value="<?=$f->usuarios_id?>"><?=$f->usuarios_username?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("deudas_fecha")?>:</label>
		<input type="text" name="deudas_fecha" id="deudas_fecha" />
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchdeudas',new Array('result-list','result-list'))" />
	</p>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setDatePicker(new Array('deudas_fecha'));
		$("#clientes_id").change(function(){
			submitData2('formSearchdeudas',new Array('result-list','result-list'));
		});
		$("#usuarios_id").change(function(){
			submitData2('formSearchdeudas',new Array('result-list','result-list'));
		});
		$("#deudas_fecha").change(function(){
			submitData2('formSearchdeudas',new Array('result-list','result-list'));
		});
	});
</script>