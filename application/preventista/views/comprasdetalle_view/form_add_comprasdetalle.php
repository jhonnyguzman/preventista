<script> setDatePicker(new Array('comprasdetalle_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>comprasdetalle_controller/add_c" method="post" name="formAddcomprasdetalle" id="formAddcomprasdetalle">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('compras_id')?>:</label>
		<input type="text" name="compras_id" id="compras_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_id')?>:</label>
		<input type="text" name="articulos_id" id="articulos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('comprasdetalle_cantidad')?>:</label>
		<input type="text" name="comprasdetalle_cantidad" id="comprasdetalle_cantidad"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('comprasdetalle_costo')?>:</label>
		<input type="text" name="comprasdetalle_costo" id="comprasdetalle_costo"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('comprasdetalle_subtotal')?>:</label>
		<input type="text" name="comprasdetalle_subtotal" id="comprasdetalle_subtotal"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('comprasdetalle_created_at')?>:</label>
		<input type="text" name="comprasdetalle_created_at" id="comprasdetalle_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('comprasdetalle_updated_at')?>:</label>
		<input type="text" name="comprasdetalle_updated_at" id="comprasdetalle_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddcomprasdetalle',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>comprasdetalle_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
