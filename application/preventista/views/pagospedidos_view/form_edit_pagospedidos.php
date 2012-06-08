<script> setDatePicker(new Array('pedidosremitos_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>pagospedidos_controller/edit_c/<?=$pagospedidos->pagospedidos_id?>" method="post" name="formEditpagospedidos" id="formEditpagospedidos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagospedidos_id')?>:</label>
		<input type="text" value="<?=$pagospedidos->pagospedidos_id?>" name="pagospedidos_id" id="pagospedidos_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidos_id')?>:</label>
		<input type="text" value="<?=$pagospedidos->pedidos_id?>" name="pedidos_id" id="pedidos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('recibos_id')?>:</label>
		<input type="text" value="<?=$pagospedidos->recibos_id?>" name="recibos_id" id="recibos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pagospedidos_montocubierto')?>:</label>
		<input type="text" value="<?=$pagospedidos->pagospedidos_montocubierto?>" name="pagospedidos_montocubierto" id="pagospedidos_montocubierto"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidosremitos_created_at')?>:</label>
		<input type="text" value="<?=$pagospedidos->pedidosremitos_created_at?>" name="pedidosremitos_created_at" id="pedidosremitos_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('pedidosremitos_updated_at')?>:</label>
		<input type="text" value="<?=$pagospedidos->pedidosremitos_updated_at?>" name="pedidosremitos_updated_at" id="pedidosremitos_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditpagospedidos',new Array('right-content','right-content'))"></input>
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
