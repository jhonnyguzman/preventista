<script> setDatePicker(new Array('deudas_fecha'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>deudas_controller/edit_c/<?=$deudas->deudas_id?>" method="post" name="formEditdeudas" id="formEditdeudas">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_id')?>:</label>
		<input type="text" value="<?=$deudas->deudas_id?>" name="deudas_id" id="deudas_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_montototal')?>:</label>
		<input type="text" value="<?=$deudas->deudas_montototal?>" name="deudas_montototal" id="deudas_montototal"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_montoadeudado')?>:</label>
		<input type="text" value="<?=$deudas->deudas_montoadeudado?>" name="deudas_montoadeudado" id="deudas_montoadeudado"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_fecha')?>:</label>
		<input type="text" value="<?=$deudas->deudas_fecha?>" name="deudas_fecha" id="deudas_fecha"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientes_id')?>:</label>
		<input type="hidden" value="<?=$deudas->clientes_id?>" name="clientes_id" id="clientes_id"></input>
		<input type="text" value="<?=$deudas->clientes_apellido.' '.$deudas->clientes_nombre?>" name="clientes_apellido" id="clientes_apellido" readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('usuarios_id')?>:</label>
		<input type="hidden" value="<?=$deudas->usuarios_id?>" name="usuarios_id" id="usuarios_id"></input>
		<input type="text" value="<?=$deudas->usuarios_username?>" name="usuarios_username" id="usuarios_username" readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_estado_descripcion')?>:</label>
		<input type="hidden" value="<?=$deudas->deudas_estado?>" name="deudas_estado" id="deudas_estado"></input>
		<input type="text" value="<?=$deudas->deudas_estado_descripcion?>" name="deudas_estado_descripcion" id="deudas_estado_descripcion" readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_created_at')?>:</label>
		<input type="text" value="<?=$deudas->deudas_created_at?>" name="deudas_created_at" id="deudas_created_at" readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('deudas_updated_at')?>:</label>
		<input type="text" value="<?=$deudas->deudas_updated_at?>" name="deudas_updated_at" id="deudas_updated_at" readonly="readonly"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditdeudas',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>deudas_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
