<script> setDatePicker(new Array('pedidodetalle_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>pedidodetalle_controller/add_c" method="post" name="formAddpedidodetalle" id="formAddpedidodetalle">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidos_id')?>:</label>
		<input type="text" name="pedidos_id" id="pedidos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_id')?>:</label>
		<input type="text" name="articulos_id" id="articulos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidodetalle_cantidad')?>:</label>
		<input type="text" name="pedidodetalle_cantidad" id="pedidodetalle_cantidad"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidodetalle_montoacordado')?>:</label>
		<input type="text" name="pedidodetalle_montoacordado" id="pedidodetalle_montoacordado"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidodetalle_created_at')?>:</label>
		<input type="text" name="pedidodetalle_created_at" id="pedidodetalle_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidodetalle_updated_at')?>:</label>
		<input type="text" name="pedidodetalle_updated_at" id="pedidodetalle_updated_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidodetalle_subtotal')?>:</label>
		<input type="text" name="pedidodetalle_subtotal" id="pedidodetalle_subtotal"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddpedidodetalle',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>pedidodetalle_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
