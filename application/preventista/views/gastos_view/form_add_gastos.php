<script> setDatePicker(new Array('gastos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>gastos_controller/add_c" method="post" name="formAddgastos" id="formAddgastos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('gastos_descripcion')?>:</label>
		<input type="text" name="gastos_descripcion" id="gastos_descripcion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('hojaruta_id')?>:</label>
		<input type="text" name="hojaruta_id" id="hojaruta_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('gastos_monto')?>:</label>
		<input type="text" name="gastos_monto" id="gastos_monto"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('gastos_created_at')?>:</label>
		<input type="text" name="gastos_created_at" id="gastos_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('gastos_updated_at')?>:</label>
		<input type="text" name="gastos_updated_at" id="gastos_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddgastos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>gastos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
