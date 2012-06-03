<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>usuarios_controller/edit_c/<?=$usuarios->usuarios_id?>" method="post" name="formEditusuarios" id="formEditusuarios">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('usuarios_id')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_id?>" name="usuarios_id" id="usuarios_id" readonly="true"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('perfiles_id')?>:</label>
			<select name="perfiles_id" id="perfiles_id">
				<?php foreach($perfiles as $f):  ?>
					<?php if($f->perfiles_id == $usuarios->perfiles_id): ?>
						<option value="<?=$f->perfiles_id?>" selected><?=$f->perfiles_descripcion?></option>
					<?php else: ?>
						<option value="<?=$f->perfiles_id?>"><?=$f->perfiles_descripcion?></option>
					<?php endif; ?>
				<?php endforeach;  ?>
			</select>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('usuarios_username')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_username?>" name="usuarios_username" id="usuarios_username" readonly="true"></input>
		</p>
		<p>
			<label><?=$this->config->item('usuarios_password')?>:</label>
			<input type="password" value="" name="usuarios_password" id="usuarios_password"></input>
		</p>
		<p>
			<label>Repite contrase&ntilde;a:</label>
			<input type="password" name="usuarios_passwordconf" id="usuarios_passwordconf"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('usuarios_nombre')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_nombre?>" name="usuarios_nombre" id="usuarios_nombre"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('usuarios_apellido')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_apellido?>" name="usuarios_apellido" id="usuarios_apellido"></input>
		</p>
		<p>
			<label><?=$this->config->item('usuarios_email')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_email?>" name="usuarios_email" id="usuarios_email"></input>
		</p>
		<p>
			<label><?=$this->config->item('usuarios_direccion')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_direccion?>" name="usuarios_direccion" id="usuarios_direccion"></input>
		</p>
		<p>
			<label><?=$this->config->item('usuarios_telefono')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_telefono?>" name="usuarios_telefono" id="usuarios_telefono"></input>
		</p>
		<p>
			<label><?=$this->config->item('provincias_id')?>:</label>
			<input type="text" value="<?=$usuarios->provincias_nombre?>" name="provincias_nombre" id="provincias_nombre"></input>
			<input type="hidden" value="<?=$usuarios->provincias_id?>" name="provincias_id" id="provincias_id"></input>
		</p>
		<p>
			<label><?=$this->config->item('localidades_id')?>:</label>
			<input type="text" value="<?=$usuarios->localidades_nombre?>" name="localidades_nombre" id="localidades_nombre"></input>
			<input type="hidden" value="<?=$usuarios->localidades_id?>" name="localidades_id" id="localidades_id"></input>
		</p>
		<p>
			<label><?=$this->config->item('usuarios_created_at')?>:</label>
			<input type="text" value="<?=$usuarios->usuarios_created_at?>" name="usuarios_created_at" id="usuarios_created_at" readonly="true"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('usuarios_estado')?>:</label>
			<select name="usuarios_estado" id="usuarios_estado">
				<?php foreach($estados as $f):  ?>
					<?php if($f->tabgral_id == $usuarios->usuarios_estado): ?>
						<option value="<?=$f->tabgral_id?>" selected><?=$f->tabgral_descripcion?></option>
					<?php else: ?>
						<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
					<?php endif; ?>
				<?php endforeach;  ?>
			</select>
		</p>
		<div class="botonera">
			<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditusuarios',new Array('right-content','right-content'))"></input>
			<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>usuarios_controller/index','right-content')"></input>
		</div>
		<div class="errors" id="errors">
		<?php
			echo validation_errors();
			if(isset($error)) echo $error;
		?>
		</div>
		<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div>
	</form>
</div>
<script type="text/javascript"> 
$(document).ready(function(){ 
	$('#provincias_nombre').focus(function(){
		autocomplete('provincias_nombre','<?=base_url()?>autocomplete_controller/getAutocomplete_c','provincias_model','',new Array('provincias_id'));
	});
	$('#localidades_nombre').focus(function(){
		autocomplete('localidades_nombre','<?=base_url()?>autocomplete_controller/getAutocomplete_c/','localidades_model','provincias_id', new Array('localidades_id','localidades_codpostal'));
	});
});
</script>