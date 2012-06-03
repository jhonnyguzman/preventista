<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>fleteros_controller/edit_c/<?=$fleteros->fleteros_id?>" method="post" name="formEditfleteros" id="formEditfleteros">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('fleteros_id')?>:</label>
		<input type="text" value="<?=$fleteros->fleteros_id?>" name="fleteros_id" id="fleteros_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('fleteros_nombre')?>:</label>
		<input type="text" value="<?=$fleteros->fleteros_nombre?>" name="fleteros_nombre" id="fleteros_nombre"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('fleteros_apellido')?>:</label>
		<input type="text" value="<?=$fleteros->fleteros_apellido?>" name="fleteros_apellido" id="fleteros_apellido"></input>
	</p>
	<p>
		<label><?=$this->config->item('fleteros_telefono')?>:</label>
		<input type="text" value="<?=$fleteros->fleteros_telefono?>" name="fleteros_telefono" id="fleteros_telefono"></input>
	</p>
	<p>
		<label><?=$this->config->item('fleteros_direccion')?>:</label>
		<input type="text" value="<?=$fleteros->fleteros_direccion?>" name="fleteros_direccion" id="fleteros_direccion"></input>
	</p>
	<p>
		<label><?=$this->config->item('fleteros_created_at')?>:</label>
		<input type="text" value="<?=$fleteros->fleteros_created_at?>" name="fleteros_created_at" id="fleteros_created_at" readonly="true"></input>
	</p>
	
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditfleteros',new Array('right-content','right-content'))"></input>
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
