<script> setDatePicker(new Array('sispermisos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>sispermisos_controller/add_c" method="post" name="formAddsispermisos" id="formAddsispermisos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_id')?>:</label>
		<select name="perfiles_id" id="perfiles_id">
			<?php foreach($perfiles as $f):  ?>
				<option value="<?=$f->perfiles_id?>"><?=$f->perfiles_descripcion?></option>
			<?php endforeach;  ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_tabla')?>:</label>
		<input type="text" name="sispermisos_tabla" id="sispermisos_tabla"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_read')?>:</label>
		<input type="radio" name="sispermisos_flag_read" value="1" checked/> Si
		<input type="radio" name="sispermisos_flag_read" value="0" /> No
	</p><br>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_insert')?>:</label>
		<input type="radio" name="sispermisos_flag_insert" value="1" checked /> Si
		<input type="radio" name="sispermisos_flag_insert" value="0" /> No
	</p><br>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_update')?>:</label>
		<input type="radio" name="sispermisos_flag_update" value="1" checked /> Si
		<input type="radio" name="sispermisos_flag_update" value="0" /> No
	</p><br>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_delete')?>:</label>
		<input type="radio" name="sispermisos_flag_delete" value="1" checked /> Si
		<input type="radio" name="sispermisos_flag_delete" value="0" /> No
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddsispermisos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>sispermisos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
