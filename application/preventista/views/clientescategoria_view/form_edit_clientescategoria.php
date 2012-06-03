<script> setDatePicker(new Array('clientescategoria_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>clientescategoria_controller/edit_c/<?=$clientescategoria->clientescategoria_id?>" method="post" name="formEditclientescategoria" id="formEditclientescategoria">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientescategoria_id')?>:</label>
		<input type="text" value="<?=$clientescategoria->clientescategoria_id?>" name="clientescategoria_id" id="clientescategoria_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientescategoria_descripcion')?>:</label>
		<input type="text" value="<?=$clientescategoria->clientescategoria_descripcion?>" name="clientescategoria_descripcion" id="clientescategoria_descripcion"></input>
	</p>
	<!--<p>
		<label><span class='required'>*</span><?=$this->config->item('clientescategoria_estado')?>:</label>
		<input type="text" value="<?=$clientescategoria->clientescategoria_estado?>" name="clientescategoria_estado" id="clientescategoria_estado"></input>
	</p>-->
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientescategoria_created_at')?>:</label>
		<input type="text" value="<?=$clientescategoria->clientescategoria_created_at?>" name="clientescategoria_created_at" 
		id="clientescategoria_created_at" readonly="true"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditclientescategoria',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>clientescategoria_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
