<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<form action="<?=base_url()?>compras_controller/edit_c/<?=$compras->compras_id?>" method="post" name="formEditcompras" id="formEditcompras">
		<fieldset>
			<legend>Compra</legend>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('compras_id')?>:</label>
				<input type="text" value="<?=$compras->compras_id?>" name="compras_id" id="compras_id"  readonly="readonly"></input>
			</p>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('proveedores_id')?>:</label>
				<input type="text" value="<?=$compras->proveedores_apellido." ".$compras->proveedores_nombre?>" 
				name="proveedores_apellido" id="proveedores_apellido" readonly="true"></input>
				<input type="hidden" value="<?=$compras->proveedores_id?>" name="proveedores_id" id="proveedores_id"></input>
			</p>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('compras_montototal')?>:</label>
				<input type="text" value="<?=$compras->compras_montototal?>" name="compras_montototal" id="compras_montototal" readonly="true"></input>
			</p>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('usuarios_id')?>:</label>
				<input type="text" value="<?=$compras->usuarios_username?>" name="usuarios_username" id="usuarios_username" readonly="true"></input>
				<input type="hidden" value="<?=$compras->usuarios_id?>" name="usuarios_id" id="usuarios_id"></input>
			</p>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('compras_created_at')?>:</label>
				<input type="text" value="<?=$compras->compras_created_at?>" name="compras_created_at" id="compras_created_at" readonly="true"></input>
			</p>
		</fieldset>
		<fieldset>
			<legend>Detalle</legend>
			<?=$this->load->view("compras_view/_form_edit_comprasdetalle")?>
		</fieldset>

		<div class="botonera">
			<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditcompras',new Array('right-content','right-content'))"></input>
			<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>compras_controller/index','right-content')"></input>
		</div>
		<div class="errors" id="errors">
		<?php
			echo validation_errors();
			if(isset($error)) echo $error;
		?>
		</div>
		<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div>
	</form>
</div>
