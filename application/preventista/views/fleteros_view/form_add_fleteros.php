<script> setDatePicker(new Array('fleteros_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>fleteros_controller/add_c" method="post" name="formAddfleteros" id="formAddfleteros">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('fleteros_nombre')?>:</label>
		<input type="text" name="fleteros_nombre" id="fleteros_nombre"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('fleteros_apellido')?>:</label>
		<input type="text" name="fleteros_apellido" id="fleteros_apellido"></input>
	</p>
	<p>
		<label><?=$this->config->item('fleteros_telefono')?>:</label>
		<input type="text" name="fleteros_telefono" id="fleteros_telefono"></input>
	</p>
	<p>
		<label><?=$this->config->item('fleteros_direccion')?>:</label>
		<input type="text" name="fleteros_direccion" id="fleteros_direccion"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddfleteros',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>fleteros_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
