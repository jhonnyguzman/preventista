<script> setDatePicker(new Array('proveedores_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>proveedores_controller/edit_c/<?=$proveedores->proveedores_id?>" method="post" name="formEditproveedores" id="formEditproveedores">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_id')?>:</label>
		<input type="text" value="<?=$proveedores->proveedores_id?>" name="proveedores_id" id="proveedores_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_nombre')?>:</label>
		<input type="text" value="<?=$proveedores->proveedores_nombre?>" name="proveedores_nombre" id="proveedores_nombre"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_apellido')?>:</label>
		<input type="text" value="<?=$proveedores->proveedores_apellido?>" name="proveedores_apellido" id="proveedores_apellido"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_direccion')?>:</label>
		<input type="text" value="<?=$proveedores->proveedores_direccion?>" name="proveedores_direccion" id="proveedores_direccion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_telefono')?>:</label>
		<input type="text" value="<?=$proveedores->proveedores_telefono?>" name="proveedores_telefono" id="proveedores_telefono"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_created_at')?>:</label>
		<input type="text" value="<?=$proveedores->proveedores_created_at?>" name="proveedores_created_at" id="proveedores_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('proveedores_updated_at')?>:</label>
		<input type="text" value="<?=$proveedores->proveedores_updated_at?>" name="proveedores_updated_at" id="proveedores_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditproveedores',new Array('right-content','right-content'))"></input>
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
