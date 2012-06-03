<div id="form-small">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>recibos_controller/in_c" method="post" name="formInrecibos" id="formInrecibos">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('recibos_id')?>:</label>
			<input type="text"  name="recibos_id" id="recibos_id"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('recibos_monto')?>:</label>
			<input type="text"  name="recibos_monto" id="recibos_monto"></input>
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
			<input type="submit" name="modificar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData3('formInrecibos','content_detail_modal',300,300,'Ingreso de recibo')" />
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