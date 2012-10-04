<script> setDatePicker(new Array('pagosdeudas_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>pagosdeudas_controller/add_c" method="post" name="formAddpagosdeudas" id="formAddpagosdeudas">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_id')?>:</label>
		<input type="text" name="deudas_id" id="deudas_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_id')?>:</label>
		<input type="text" name="pagos_id" id="pagos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagosdeudas_montocubierto')?>:</label>
		<input type="text" name="pagosdeudas_montocubierto" id="pagosdeudas_montocubierto"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagosdeudas_created_at')?>:</label>
		<input type="text" name="pagosdeudas_created_at" id="pagosdeudas_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagosdeudas_updated_at')?>:</label>
		<input type="text" name="pagosdeudas_updated_at" id="pagosdeudas_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddpagosdeudas',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>pagosdeudas_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
