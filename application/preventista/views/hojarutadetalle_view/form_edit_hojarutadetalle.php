<script> setDatePicker(new Array('hojarutadetalle_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>hojarutadetalle_controller/edit_c/<?=$hojarutadetalle->hojarutadetalle_id?>" method="post" name="formEdithojarutadetalle" id="formEdithojarutadetalle">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('hojarutadetalle_id')?>:</label>
		<input type="text" value="<?=$hojarutadetalle->hojarutadetalle_id?>" name="hojarutadetalle_id" id="hojarutadetalle_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('hojaruta_id')?>:</label>
		<input type="text" value="<?=$hojarutadetalle->hojaruta_id?>" name="hojaruta_id" id="hojaruta_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidos_id')?>:</label>
		<input type="text" value="<?=$hojarutadetalle->pedidos_id?>" name="pedidos_id" id="pedidos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('hojarutadetalle_created_at')?>:</label>
		<input type="text" value="<?=$hojarutadetalle->hojarutadetalle_created_at?>" name="hojarutadetalle_created_at" id="hojarutadetalle_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('hojarutadetalle_updated_at')?>:</label>
		<input type="text" value="<?=$hojarutadetalle->hojarutadetalle_updated_at?>" name="hojarutadetalle_updated_at" id="hojarutadetalle_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEdithojarutadetalle',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>hojarutadetalle_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
