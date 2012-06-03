<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>clientes_controller/add_c" method="post" name="formAddclientes" id="formAddclientes">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientes_nombre')?>:</label>
		<input type="text" name="clientes_nombre" id="clientes_nombre"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientes_apellido')?>:</label>
		<input type="text" name="clientes_apellido" id="clientes_apellido"></input>
	</p>
	<p>
		<label><?=$this->config->item('clientes_direccion')?>:</label>
		<input type="text" name="clientes_direccion" id="clientes_direccion"></input>
	</p>
	<p>
		<label><?=$this->config->item('clientes_telefono')?>:</label>
		<input type="text" name="clientes_telefono" id="clientes_telefono"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientescategoria_id')?>:</label>
		<select name="clientescategoria_id" id="clientescategoria_id">
			<?php foreach($clientescategoria as $f): ?>
				<option value="<?=$f->clientescategoria_id?>"><?=$f->clientescategoria_descripcion?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddclientes',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>clientes_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
