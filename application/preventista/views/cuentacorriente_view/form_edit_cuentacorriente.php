<script> setDatePicker(new Array('cuentacorriente_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>cuentacorriente_controller/edit_c/<?=$cuentacorriente->cuentacorriente_id?>" method="post" name="formEditcuentacorriente" id="formEditcuentacorriente">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('cuentacorriente_id')?>:</label>
		<input type="text" value="<?=$cuentacorriente->cuentacorriente_id?>" name="cuentacorriente_id" id="cuentacorriente_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('clientes_id')?>:</label>
		<?php foreach($clientes as $f):?>
			<?php if($f->clientes_id == $cuentacorriente->clientes_id): ?>
				<input type="text" value="<?=$f->clientes_apellido." ".$f->clientes_nombre?>" name="clientes_apellnom" id="clientes_apellnom" readonly="true"></input>
				<input type="hidden" value="<?=$cuentacorriente->clientes_id?>" name="clientes_id" id="clientes_id"></input>
			<?php endif; ?>
		<?php endforeach;?>
	</p>
	<p>
		<label><?=$this->config->item('cuentacorriente_haber')?>:</label>
		<input type="text" value="<?=$cuentacorriente->cuentacorriente_haber?>" name="cuentacorriente_haber" id="cuentacorriente_haber"></input>
	</p>
	<p>
		<label><?=$this->config->item('cuentacorriente_debe')?>:</label>
		<input type="text" value="<?=$cuentacorriente->cuentacorriente_debe?>" name="cuentacorriente_debe" id="cuentacorriente_debe"></input>
	</p>
	<!--<p>
		<label><span class='required'>*</span><?=$this->config->item('cuentacorriente_saldo')?>:</label>
		<input type="text" value="<?=$cuentacorriente->cuentacorriente_saldo?>" name="cuentacorriente_saldo" id="cuentacorriente_saldo"></input>
	</p>-->
	<p>
		<label><?=$this->config->item('cuentacorriente_created_at')?>:</label>
		<input type="text" value="<?=$cuentacorriente->cuentacorriente_created_at?>" name="cuentacorriente_created_at" id="cuentacorriente_created_at" readonly="true"></input>
	</p>
	<p>
		<label><?=$this->config->item('cuentacorriente_updated_at')?>:</label>
		<input type="text" value="<?=$cuentacorriente->cuentacorriente_updated_at?>" name="cuentacorriente_updated_at" id="cuentacorriente_updated_at" readonly="true"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditcuentacorriente',new Array('right-content','right-content'))"></input>
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
