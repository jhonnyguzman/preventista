<script> setDatePicker(new Array('marcas_created_at'));</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>marcas_controller/add_c" method="post" name="formAddmarcas" id="formAddmarcas">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_parent')?>:</label>
			<select  name="marcas_parent" id="marcas_parent">
				<option value="0">Sin padre</option>
				<?php foreach($marcaspadres as $f): ?>
					<option value="<?=$f->marcas_id?>"><?=$f->marcas_descripcion?></option>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_descripcion')?>:</label>
			<input type="text" name="marcas_descripcion" id="marcas_descripcion"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('marcas_estado')?>:</label>
			<select  name="marcas_estado" id="marcas_estado">
				<?php foreach($estados as $f): ?>
					<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
				<?php endforeach;?>
			</select>
		</p>
		<div class="botonera">
			<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddmarcas',new Array('right-content','right-content'))"></input>
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
