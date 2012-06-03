<script> setDatePicker(new Array('recibos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>recibos_controller/edit_c/<?=$recibos->recibos_id?>" method="post" name="formEditrecibos" id="formEditrecibos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_id')?>:</label>
		<input type="text" value="<?=$recibos->recibos_id?>" name="recibos_id" id="recibos_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_monto')?>:</label>
		<input type="text" value="<?=$recibos->recibos_monto?>" name="recibos_monto" id="recibos_monto"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientes_id')?>:</label>
		<input type="text" value="<?=$recibos->clientes_id?>" name="clientes_id" id="clientes_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('usuarios_id')?>:</label>
		<input type="text" value="<?=$recibos->usuarios_id?>" name="usuarios_id" id="usuarios_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_estado')?>:</label>
		<input type="text" value="<?=$recibos->recibos_estado?>" name="recibos_estado" id="recibos_estado"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_fechaingreso')?>:</label>
		<input type="text" value="<?=$recibos->recibos_fechaingreso?>" name="recibos_fechaingreso" id="recibos_fechaingreso"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_created_at')?>:</label>
		<input type="text" value="<?=$recibos->recibos_created_at?>" name="recibos_created_at" id="recibos_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_updated_at')?>:</label>
		<input type="text" value="<?=$recibos->recibos_updated_at?>" name="recibos_updated_at" id="recibos_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditrecibos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>recibos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
