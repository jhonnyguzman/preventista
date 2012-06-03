<script> setDatePicker(new Array('sismenu_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>index.php/sismenu_controller/edit_c/<?=$sismenu->sismenu_id?>" method="post" name="formEditsismenu" id="formEditsismenu">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sismenu_id')?>:</label>
		<input type="text" value="<?=$sismenu->sismenu_id?>" name="sismenu_id" id="sismenu_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sismenu_descripcion')?>:</label>
		<input type="text" value="<?=$sismenu->sismenu_descripcion?>" name="sismenu_descripcion" id="sismenu_descripcion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sismenu_parent')?>:</label>
		<select name="sismenu_parent" id="sismenu_parent">
			<?php foreach($sismenupadres as $f):  ?>
				<?php if($f->sismenu_id == $sismenu->sismenu_parent): ?>
					<option value="<?=$f->sismenu_id?>" selected><?=$f->sismenu_descripcion?></option>
				<?php else: ?>
					<option value="<?=$f->sismenu_id?>"><?=$f->sismenu_descripcion?></option>
				<?php endif; ?>
			<?php endforeach;  ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sismenu_estado')?>:</label>
		<select name="sismenu_estado" id="sismenu_estado">
			<?php foreach($estados as $f):  ?>
				<?php if($f->tabgral_id == $sismenu->sismenu_estado): ?>
					<option value="<?=$f->tabgral_id?>" selected><?=$f->tabgral_descripcion?></option>
				<?php else: ?>
					<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
				<?php endif; ?>
			<?php endforeach;  ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item('sisvinculos_link')?>:</label>
		<input type="text" value="<?=$sismenu->sisvinculos_link?>" name="sisvinculos_link" id="sisvinculos_link"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('sismenu_created_at')?>:</label>
		<input type="text" value="<?=$sismenu->sismenu_created_at?>" name="sismenu_created_at" id="sismenu_created_at" readonly="true"></input>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditsismenu',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>sismenu_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
