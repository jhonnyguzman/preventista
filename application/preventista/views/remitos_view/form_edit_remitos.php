<script> setDatePicker(new Array('remitos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>remitos_controller/edit_c/<?=$remitos->remitos_id?>" method="post" name="formEditremitos" id="formEditremitos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('remitos_id')?>:</label>
		<input type="text" value="<?=$remitos->remitos_id?>" name="remitos_id" id="remitos_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('hojarutadetalle_id')?>:</label>
		<input type="text" value="<?=$remitos->hojarutadetalle_id?>" name="hojarutadetalle_id" id="hojarutadetalle_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('remitos_estado')?>:</label>
		<input type="text" value="<?=$remitos->remitos_estado?>" name="remitos_estado" id="remitos_estado"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('remitos_created_at')?>:</label>
		<input type="text" value="<?=$remitos->remitos_created_at?>" name="remitos_created_at" id="remitos_created_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditremitos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>remitos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
