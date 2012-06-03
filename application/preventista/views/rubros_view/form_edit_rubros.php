<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>rubros_controller/edit_c/<?=$rubros->rubros_id?>" method="post" name="formEditrubros" id="formEditrubros">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('rubros_id')?>:</label>
			<input type="text" value="<?=$rubros->rubros_id?>" name="rubros_id" id="rubros_id"  readonly="readonly"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('rubros_descripcion')?>:</label>
			<input type="text" value="<?=$rubros->rubros_descripcion?>" name="rubros_descripcion" id="rubros_descripcion"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('rubros_estado')?>:</label>
			<select name="rubros_estado" id="rubros_estado">
				<?php foreach($estados as $f): ?>
					<?php if($f->tabgral_id == $rubros->rubros_estado): ?>
						<option value="<?=$f->tabgral_id?>" selected><?=$f->tabgral_descripcion?></option>
					<?php else: ?>
						<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
					<?php endif; ?>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('rubros_created_at')?>:</label>
			<input type="text" value="<?=$rubros->rubros_created_at?>" name="rubros_created_at" id="rubros_created_at" readonly="true"></input>
		</p>
		<div class="botonera">
			<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditrubros',new Array('right-content','right-content'))"></input>
			<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>rubros_controller/index','right-content')"></input>
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
