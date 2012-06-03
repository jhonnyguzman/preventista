<script> setDatePicker(new Array('cambiodirectostock_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>cambiodirectostock_controller/edit_c/<?=$cambiodirectostock->cambiodirectostock_id?>" method="post" name="formEditcambiodirectostock" id="formEditcambiodirectostock">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cambiodirectostock_id')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->cambiodirectostock_id?>" name="cambiodirectostock_id" id="cambiodirectostock_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cambiodirectostock_tipo')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->cambiodirectostock_tipo?>" name="cambiodirectostock_tipo" id="cambiodirectostock_tipo"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_id')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->articulos_id?>" name="articulos_id" id="articulos_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cambiodirectostock_stockantiguo')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->cambiodirectostock_stockantiguo?>" name="cambiodirectostock_stockantiguo" id="cambiodirectostock_stockantiguo"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cambiodirectostock_stocknuevo')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->cambiodirectostock_stocknuevo?>" name="cambiodirectostock_stocknuevo" id="cambiodirectostock_stocknuevo"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('usuarios_id')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->usuarios_id?>" name="usuarios_id" id="usuarios_id"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cambiodirectostock_comentario')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->cambiodirectostock_comentario?>" name="cambiodirectostock_comentario" id="cambiodirectostock_comentario"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cambiodirectostock_created_at')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->cambiodirectostock_created_at?>" name="cambiodirectostock_created_at" id="cambiodirectostock_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cambiodirectostock_updated_at')?>:</label>
		<input type="text" value="<?=$cambiodirectostock->cambiodirectostock_updated_at?>" name="cambiodirectostock_updated_at" id="cambiodirectostock_updated_at"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditcambiodirectostock',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>cambiodirectostock_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
