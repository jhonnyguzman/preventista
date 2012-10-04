<script> setDatePicker(new Array('pagosdeudas_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>pagosdeudas_controller/edit_c/<?=$pagosdeudas->pagosdeudas_id?>" method="post" name="formEditpagosdeudas" id="formEditpagosdeudas">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagosdeudas_id')?>:</label>
		<input type="text" value="<?=$pagosdeudas->pagosdeudas_id?>" name="pagosdeudas_id" id="pagosdeudas_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_id')?>:</label>
		<input type="text" value="<?=$pagosdeudas->deudas_id?>" name="deudas_id" id="deudas_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_id')?>:</label>
		<input type="text" value="<?=$pagosdeudas->pagos_id?>" name="pagos_id" id="pagos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagosdeudas_montocubierto')?>:</label>
		<input type="text" value="<?=$pagosdeudas->pagosdeudas_montocubierto?>" name="pagosdeudas_montocubierto" id="pagosdeudas_montocubierto"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagosdeudas_created_at')?>:</label>
		<input type="text" value="<?=$pagosdeudas->pagosdeudas_created_at?>" name="pagosdeudas_created_at" id="pagosdeudas_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagosdeudas_updated_at')?>:</label>
		<input type="text" value="<?=$pagosdeudas->pagosdeudas_updated_at?>" name="pagosdeudas_updated_at" id="pagosdeudas_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditpagosdeudas',new Array('right-content','right-content'))"></input>
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
