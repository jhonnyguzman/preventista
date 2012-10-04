<script type="text/javascript">
	$(document).ready(function(){
		setDatePicker(new Array('deudas_fecha'));
	});
</script>
<div id="form-small">
	<form action="<?=base_url()?>deudas_controller/add_c" method="post" name="formAdddeudas" id="formAdddeudas">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('deudas_montototal')?>:</label>
			<input type="text" name="deudas_montototal" id="deudas_montototal"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('deudas_fecha')?>:</label>
			<input type="text" name="deudas_fecha" id="deudas_fecha"/>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('clientes_apellido')?>:</label>
			<select name="clientes_id" id="clientes_id">
				<option value="">Seleccione</option>
				<?php foreach($clientes as $f):?>
					<option value="<?=$f->clientes_id?>"><?=$f->clientes_apellido." ".$f->clientes_nombre?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<div class="botonera">
			<input type="submit" name="modificar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData3('formAdddeudas','content_detail_modal',300,300,'Ingreso de Deuda')" />
		</div>
		<div class="errors" id="errors">
		<?php
			echo validation_errors();
			if(isset($error)) echo $error;
		?>
		</div>
		<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div>
	</form>
</div>
