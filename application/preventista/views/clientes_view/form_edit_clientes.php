<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>clientes_controller/edit_c/<?=$clientes->clientes_id?>" method="post" name="formEditclientes" id="formEditclientes">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('clientes_id')?>:</label>
			<input type="text" value="<?=$clientes->clientes_id?>" name="clientes_id" id="clientes_id"  readonly="readonly"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('clientes_nombre')?>:</label>
			<input type="text" value="<?=$clientes->clientes_nombre?>" name="clientes_nombre" id="clientes_nombre"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('clientes_apellido')?>:</label>
			<input type="text" value="<?=$clientes->clientes_apellido?>" name="clientes_apellido" id="clientes_apellido"></input>
		</p>
		<p>
			<label><?=$this->config->item('clientes_direccion')?>:</label>
			<input type="text" value="<?=$clientes->clientes_direccion?>" name="clientes_direccion" id="clientes_direccion"></input>
		</p>
		<p>
			<label><?=$this->config->item('clientes_telefono')?>:</label>
			<input type="text" value="<?=$clientes->clientes_telefono?>" name="clientes_telefono" id="clientes_telefono"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('clientescategoria_id')?>:</label>
			<select name="clientescategoria_id" id="clientescategoria_id">
			<?php foreach($clientescategoria as $f): ?>
				<?php if($f->clientescategoria_id == $clientes->clientescategoria_id): ?>
					<option value="<?=$f->clientescategoria_id?>" selected><?=$f->clientescategoria_descripcion?></option>
				<?php else: ?>
					<option value="<?=$f->clientescategoria_id?>"><?=$f->clientescategoria_descripcion?></option>
				<?php endif; ?>	
			<?php endforeach; ?>
		</select>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('clientes_created_at')?>:</label>
			<input type="text" value="<?=$clientes->clientes_created_at?>" name="clientes_created_at" id="clientes_created_at"></input>
		</p>
		<div class="botonera">
			<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditclientes',new Array('right-content','right-content'))"></input>
			<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>clientes_controller/index','right-content')"></input>
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
