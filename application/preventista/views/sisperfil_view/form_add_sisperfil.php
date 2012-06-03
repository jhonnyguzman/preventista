<script> setDatePicker(new Array('sisperfil_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>sisperfil_controller/add_c" method="post" name="formAddsisperfil" id="formAddsisperfil">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sismenu_id')?>:</label>
		<input type="text" name="sismenu_id" id="sismenu_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_id')?>:</label>
		<input type="text" name="perfiles_id" id="perfiles_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sisperfil_estado')?>:</label>
		<input type="text" name="sisperfil_estado" id="sisperfil_estado"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sisperfil_created_at')?>:</label>
		<input type="text" name="sisperfil_created_at" id="sisperfil_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sisperfil_updated_at')?>:</label>
		<input type="text" name="sisperfil_updated_at" id="sisperfil_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddsisperfil',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>sisperfil_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
