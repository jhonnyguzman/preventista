<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>cuentacorriente_controller/add_c" method="post" name="formAddcuentacorriente" id="formAddcuentacorriente">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientes_id')?>:</label>
		<select name="clientes_id" id="clientes_id">
			<?php foreach($clientes as $f):?>
				<option value="<?=$f->clientes_id?>"><?=$f->clientes_apellido." ".$f->clientes_nombre?></option>
			<?php endforeach;?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item('cuentacorriente_haber')?>:</label>
		<input type="text" name="cuentacorriente_haber" id="cuentacorriente_haber"></input>
	</p>
	<p>
		<label><?=$this->config->item('cuentacorriente_debe')?>:</label>
		<input type="text" name="cuentacorriente_debe" id="cuentacorriente_debe"></input>
	</p>
	<!--<p>
		<label><span class='required'>*</span><?=$this->config->item('cuentacorriente_saldo')?>:</label>
		<input type="text" name="cuentacorriente_saldo" id="cuentacorriente_saldo"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cuentacorriente_created_at')?>:</label>
		<input type="text" name="cuentacorriente_created_at" id="cuentacorriente_created_at"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cuentacorriente_updated_at')?>:</label>
		<input type="text" name="cuentacorriente_updated_at" id="cuentacorriente_updated_at"></input>
	</p>-->
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddcuentacorriente',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>cuentacorriente_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
