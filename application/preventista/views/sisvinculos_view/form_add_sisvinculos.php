<script> setDatePicker(new Array('sisvinculos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>sisvinculos_controller/add_c" method="post" name="formAddsisvinculos" id="formAddsisvinculos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sismenu_id')?>:</label>
		<input type="text" name="sismenu_id" id="sismenu_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sisvinculos_link')?>:</label>
		<input type="text" name="sisvinculos_link" id="sisvinculos_link"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sisvinculos_created_at')?>:</label>
		<input type="text" name="sisvinculos_created_at" id="sisvinculos_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sisvinculos_updated_at')?>:</label>
		<input type="text" name="sisvinculos_updated_at" id="sisvinculos_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddsisvinculos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>sisvinculos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
