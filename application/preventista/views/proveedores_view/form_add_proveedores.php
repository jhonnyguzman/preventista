<script> setDatePicker(new Array('proveedores_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>proveedores_controller/add_c" method="post" name="formAddproveedores" id="formAddproveedores">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_nombre')?>:</label>
		<input type="text" name="proveedores_nombre" id="proveedores_nombre"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_apellido')?>:</label>
		<input type="text" name="proveedores_apellido" id="proveedores_apellido"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_direccion')?>:</label>
		<input type="text" name="proveedores_direccion" id="proveedores_direccion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_telefono')?>:</label>
		<input type="text" name="proveedores_telefono" id="proveedores_telefono"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_created_at')?>:</label>
		<input type="text" name="proveedores_created_at" id="proveedores_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_updated_at')?>:</label>
		<input type="text" name="proveedores_updated_at" id="proveedores_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddproveedores',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>proveedores_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
