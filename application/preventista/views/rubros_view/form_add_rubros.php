<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>rubros_controller/add_c" method="post" name="formAddrubros" id="formAddrubros">
		<p>
			<label><span class='required'>*</span><?=$this->config->item('rubros_descripcion')?>:</label>
			<input type="text" name="rubros_descripcion" id="rubros_descripcion"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('rubros_estado')?>:</label>
			<select name="rubros_estado" id="rubros_estado">
				<?php foreach($estados as $f): ?>
					<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
				<?php endforeach;?>
			</select>
		</p>
		<div class="botonera">
			<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddrubros',new Array('right-content','right-content'))"></input>
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
