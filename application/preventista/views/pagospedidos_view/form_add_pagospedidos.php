<script> setDatePicker(new Array('pedidosremitos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>pagospedidos_controller/add_c" method="post" name="formAddpagospedidos" id="formAddpagospedidos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidos_id')?>:</label>
		<input type="text" name="pedidos_id" id="pedidos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_id')?>:</label>
		<input type="text" name="recibos_id" id="recibos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagospedidos_montocubierto')?>:</label>
		<input type="text" name="pagospedidos_montocubierto" id="pagospedidos_montocubierto"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidosremitos_created_at')?>:</label>
		<input type="text" name="pedidosremitos_created_at" id="pedidosremitos_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidosremitos_updated_at')?>:</label>
		<input type="text" name="pedidosremitos_updated_at" id="pedidosremitos_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddpagospedidos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>pagospedidos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
