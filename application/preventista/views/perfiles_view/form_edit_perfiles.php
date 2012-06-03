<script> setDatePicker(new Array('perfiles_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>perfiles_controller/edit_c/<?=$perfiles->perfiles_id?>" method="post" name="formEditperfiles" id="formEditperfiles">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_id')?>:</label>
		<input type="text" value="<?=$perfiles->perfiles_id?>" name="perfiles_id" id="perfiles_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_descripcion')?>:</label>
		<input type="text" value="<?=$perfiles->perfiles_descripcion?>" name="perfiles_descripcion" id="perfiles_descripcion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_estado')?>:</label>
		<select name="perfiles_estado" id="perfiles_estado">
			<?php foreach($estados as $f): ?>
				<?php if($f->tabgral_id == $perfiles->perfiles_estado): ?>
					<option value="<?=$f->tabgral_id?>" selected><?=$f->tabgral_descripcion?></option>
				<?php else: ?>	
					<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
				<?php endif; ?>	
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_created_at')?>:</label>
		<input type="text" value="<?=$perfiles->perfiles_created_at?>" name="perfiles_created_at" id="perfiles_created_at" readonly="true"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditperfiles',new Array('right-content','right-content'))"></input>
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
