<div id="marcas">
	<form action="<?=base_url()?>articulos_controller/editFastGeneral_c" method="post" name="formEditFastPercentArticulos" id="formEditFastPercentArticulos">
		<?php foreach($articulos_ids as $f): ?>
			<input type="hidden" name="articulos_ids[]" id="articulos_ids" value="<?=$f?>">
		<?php endforeach; ?>
		<p>
			<strong>Items seleccionados:&nbsp;<?=$cantSeleccionados?></strong>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje1')?>:</label>
			<input type="text" name="articulos_porcentaje1" id="articulos_porcentaje1"></input>
			<input type="radio" name="radioPorcentaje1" value="sumar" checked>Sumar
			<input type="radio" name="radioPorcentaje1" value="restar">Restar
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje2')?>:</label>
			<input type="text" name="articulos_porcentaje2" id="articulos_porcentaje2"></input>
			<input type="radio" name="radioPorcentaje2" value="sumar" checked>Sumar
			<input type="radio" name="radioPorcentaje2" value="restar">Restar
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje3')?>:</label>
			<input type="text" name="articulos_porcentaje3" id="articulos_porcentaje3"></input>
			<input type="radio" name="radioPorcentaje3" value="sumar" checked>Sumar
			<input type="radio" name="radioPorcentaje3" value="restar">Restar
		</p>
		<div class="botonera">
			<input type="submit" name="actualizar" value="Actualizar" class="crudtest-button" id="btn-save" onClick="submitData('formEditFastPercentArticulos',new Array('right-content','right-content'))"></input>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){ 
		
	});
</script>