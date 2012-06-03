<script> setDatePicker(new Array('tramites_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>tramites_controller/edit_c/<?=$tramites->tramites_id?>" method="post" name="formEdittramites" id="formEdittramites">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('tramites_id')?>:</label>
		<input type="text" value="<?=$tramites->tramites_id?>" name="tramites_id" id="tramites_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('tramites_descripcion')?>:</label>
		<input type="text" value="<?=$tramites->tramites_descripcion?>" name="tramites_descripcion" id="tramites_descripcion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('tramites_created_at')?>:</label>
		<input type="text" value="<?=$tramites->tramites_created_at?>" name="tramites_created_at" id="tramites_created_at" readonly="true"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEdittramites',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>tramites_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
