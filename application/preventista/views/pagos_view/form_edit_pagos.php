<script> setDatePicker(new Array('pagos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>pagos_controller/edit_c/<?=$pagos->pagos_id?>" method="post" name="formEditpagos" id="formEditpagos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_id')?>:</label>
		<input type="text" value="<?=$pagos->pagos_id?>" name="pagos_id" id="pagos_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_monto')?>:</label>
		<input type="text" value="<?=$pagos->pagos_monto?>" name="pagos_monto" id="pagos_monto"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientes_id')?>:</label>
		<input type="text" value="<?=$pagos->clientes_id?>" name="clientes_id" id="clientes_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('usuarios_id')?>:</label>
		<input type="text" value="<?=$pagos->usuarios_id?>" name="usuarios_id" id="usuarios_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_estado')?>:</label>
		<input type="text" value="<?=$pagos->pagos_estado?>" name="pagos_estado" id="pagos_estado"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_fechaingreso')?>:</label>
		<input type="text" value="<?=$pagos->pagos_fechaingreso?>" name="pagos_fechaingreso" id="pagos_fechaingreso"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_created_at')?>:</label>
		<input type="text" value="<?=$pagos->pagos_created_at?>" name="pagos_created_at" id="pagos_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagos_updated_at')?>:</label>
		<input type="text" value="<?=$pagos->pagos_updated_at?>" name="pagos_updated_at" id="pagos_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditpagos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>pagos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
