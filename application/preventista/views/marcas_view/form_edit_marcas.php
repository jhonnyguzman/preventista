<script> setDatePicker(new Array('marcas_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>marcas_controller/edit_c/<?=$marcas->marcas_id?>" method="post" name="formEditmarcas" id="formEditmarcas">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_id')?>:</label>
			<input type="text" value="<?=$marcas->marcas_id?>" name="marcas_id" id="marcas_id"  readonly="readonly"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_descripcion')?>:</label>
			<input type="text" value="<?=$marcas->marcas_descripcion?>" name="marcas_descripcion" id="marcas_descripcion"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_parent')?>:</label>
			<select  name="marcas_parent" id="marcas_parent">
				<?php foreach($marcaspadres as $f): ?>
					<?php if($f->marcas_id == $marcas->marcas_parent): ?>
						<option value="<?=$f->marcas_id?>" selected><?=$f->marcas_descripcion?></option>
					<?php else: ?>
						<option value="<?=$f->marcas_id?>"><?=$f->marcas_descripcion?></option>
					<?php endif; ?>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_estado')?>:</label>
			<select  name="marcas_estado" id="marcas_estado">
				<?php foreach($estados as $f): ?>
					<?php if($f->tabgral_id == $marcas->marcas_estado): ?>
						<option value="<?=$f->tabgral_id?>" selected><?=$f->tabgral_descripcion?></option>
					<?php else: ?>
						<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
					<?php endif; ?>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_created_at')?>:</label>
			<input type="text" value="<?=$marcas->marcas_created_at?>" name="marcas_created_at" id="marcas_created_at" readonly="true"></input>
		</p>
		<div class="botonera">
			<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditmarcas',new Array('right-content','right-content'))"></input>
			<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>marcas_controller/index','right-content')"></input>
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
