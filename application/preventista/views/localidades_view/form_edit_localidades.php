<script> setDatePicker(new Array('localidades_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>localidades_controller/edit_c/<?=$localidades->localidades_id?>" method="post" name="formEditlocalidades" id="formEditlocalidades">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('localidades_id')?>:</label>
		<input type="text" value="<?=$localidades->localidades_id?>" name="localidades_id" id="localidades_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('localidades_nombre')?>:</label>
		<input type="text" value="<?=$localidades->localidades_nombre?>" name="localidades_nombre" id="localidades_nombre"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('localidades_codpostal')?>:</label>
		<input type="text" value="<?=$localidades->localidades_codpostal?>" name="localidades_codpostal" id="localidades_codpostal"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('provincias_id')?>:</label>
		<input type="text" value="<?=$localidades->provincias_id?>" name="provincias_id" id="provincias_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('localidades_created_at')?>:</label>
		<input type="text" value="<?=$localidades->localidades_created_at?>" name="localidades_created_at" id="localidades_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('localidades_updated_at')?>:</label>
		<input type="text" value="<?=$localidades->localidades_updated_at?>" name="localidades_updated_at" id="localidades_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditlocalidades',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>localidades_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
