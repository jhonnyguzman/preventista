<div class="searchShort">
	<p>
		<label><?=$this->config->item("remitos_id")?>:</label>
		<input type="text" name="remitos_id" id="remitos_id" />
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchremitos',new Array('result-list','result-list'))" />
	</p>
	<p>
		<label><?=$this->config->item("remitos_estado_descripcion")?></label>
		<select name="remitos_estado" id="remitos_estado">
			<option value="">Seleccione</option>
			<?php foreach($remitosestados as $f):?>
				<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("remitos_created_at")?>:</label>
		<input type="text" name="remitos_created_at" id="remitos_created_at" />
	</p>
</div>

<script type="text/javascript">
$(document).ready(function() {
	
});
</script>