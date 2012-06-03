<script> setDatePicker(new Array('sispermisos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>sispermisos_controller/edit_c/<?=$sispermisos->sispermisos_id?>" method="post" name="formEditsispermisos" id="formEditsispermisos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('perfiles_id')?>:</label>
		<select name="perfiles_id" id="perfiles_id">
			<?php foreach($perfiles as $f):  ?>
				<?php if($f->perfiles_id == $sispermisos->perfiles_id): ?>
					<option value="<?=$f->perfiles_id?>" selected><?=$f->perfiles_descripcion?></option>
				<?php else: ?>
					<option value="<?=$f->perfiles_id?>"><?=$f->perfiles_descripcion?></option>
				<?php endif; ?>
			<?php endforeach;  ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_id')?>:</label>
		<input type="text" value="<?=$sispermisos->sispermisos_id?>" name="sispermisos_id" id="sispermisos_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_tabla')?>:</label>
		<input type="text" value="<?=$sispermisos->sispermisos_tabla?>" name="sispermisos_tabla" id="sispermisos_tabla" readonly="true"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_read')?>:</label>
		<input type="radio" name="sispermisos_flag_read" value="1" <?php if($sispermisos->sispermisos_flag_read): ?>  checked="true" <?php endif;?> >Si
		<input type="radio" name="sispermisos_flag_read" value="0" <?php if(!$sispermisos->sispermisos_flag_read): ?>  checked="true" <?php endif;?>>No
	</p><br>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_insert')?>:</label>
		<input type="radio" name="sispermisos_flag_insert" value="1" <?php if($sispermisos->sispermisos_flag_insert): ?>  checked="true" <?php endif;?> >Si
		<input type="radio" name="sispermisos_flag_insert" value="0" <?php if(!$sispermisos->sispermisos_flag_insert): ?>  checked="true" <?php endif;?>>No
	</p><br>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_update')?>:</label>
		<input type="radio" name="sispermisos_flag_update" value="1" <?php if($sispermisos->sispermisos_flag_update): ?>  checked="true" <?php endif;?> >Si
		<input type="radio" name="sispermisos_flag_update" value="0" <?php if(!$sispermisos->sispermisos_flag_update): ?>  checked="true" <?php endif;?>>No
	</p><br>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_flag_delete')?>:</label>
		<input type="radio" name="sispermisos_flag_delete" value="1" <?php if($sispermisos->sispermisos_flag_delete): ?>  checked="true" <?php endif;?> >Si
		<input type="radio" name="sispermisos_flag_delete" value="0" <?php if(!$sispermisos->sispermisos_flag_delete): ?>  checked="true" <?php endif;?>>No
	</p><br>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sispermisos_created_at')?>:</label>
		<input type="text" value="<?=$sispermisos->sispermisos_created_at?>" name="sispermisos_created_at" id="sispermisos_created_at" readonly="true"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditsispermisos',new Array('right-content','right-content'))"></input>
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
