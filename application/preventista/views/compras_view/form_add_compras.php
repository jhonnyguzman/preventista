<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<form action="<?=base_url()?>compras_controller/add_c" method="post" name="formAddcompras" id="formAddcompras">
		<fieldset>
			<legend>Compra</legend>
			<p>
				<label><?=$this->config->item('proveedores_id')?>:</label>
				<input type="text" name="proveedores_apellido" id="proveedores_apellido"></input>
				<input type="hidden" name="proveedores_id" id="proveedores_id"></input>
			</p>
			<p>
				<label><?=$this->config->item('compras_montototal')?>:</label>
				<input type="text" name="compras_montototal" id="compras_montototal"></input>
			</p>
		</fieldset>
		<fieldset>
			<legend>Detalle</legend>
			<?=$this->load->view("compras_view/_form_add_comprasdetalle")?>
		</fieldset>
		<div class="botonera">
			<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddcompras',new Array('right-content','right-content'))"></input>
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
<script type="text/javascript"> 
	$(document).ready(function(){ 
		$('#proveedores_apellido').focus(function(){
			autocomplete('proveedores_apellido','<?=base_url()?>autocomplete_controller/getAutocomplete_c','proveedores_model','',new Array('proveedores_id'));
		});
		
	});
</script>