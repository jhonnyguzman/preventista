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
		<label><?=$this->config->item("pagos_fechaingreso")?>:</label>
		<input type="text" name="pagos_fechaingreso" id="pagos_fechaingreso" />
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchpagos',new Array('result-list','result-list'))" />
	</p>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setDatePicker(new Array('pagos_fechaingreso'));
		$("#clientes_id").click(function(){
			submitData2('formSearchpagos',new Array('result-list','result-list'));
		});
		$("#usuarios_id").click(function(){
			submitData2('formSearchpagos',new Array('result-list','result-list'));
		});
		$("#pagos_fechaingreso").change(function(){
			submitData2('formSearchpagos',new Array('result-list','result-list'));
		});
	});
</script>