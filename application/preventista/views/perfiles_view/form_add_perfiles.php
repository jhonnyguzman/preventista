<script> setDatePicker(new Array('perfiles_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>perfiles_controller/add_c" method="post" name="formAddperfiles" id="formAddperfiles">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_descripcion')?>:</label>
		<input type="text" name="perfiles_descripcion" id="perfiles_descripcion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_estado')?>:</label>
		<select name="perfiles_estado" id="perfiles_estado">
			<?php foreach($estados as $f): ?>
				<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddperfiles',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>perfiles_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
