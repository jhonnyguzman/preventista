<div class="searchShort">
	<p>
		<label><?=$this->config->item("fleteros_id")?>:</label>
		<select name="fleteros_id" id="fleteros_id">
			<option value="">Seleccione</option>
			<?php foreach($fleteros as $f):?>
				<option value="<?=$f->fleteros_id?>"><?=$f->fleteros_apellido." ".$f->fleteros_nombre?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("hojaruta_estado_descripcion")?></label>
		<select name="hojaruta_estado" id="hojaruta_estado">
			<option value="">Seleccione</option>
			<?php foreach($hojarutaestados as $f):?>
				<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("hojaruta_created_at")?>:</label>
		<input type="text" name="hojaruta_created_at" id="hojaruta_created_at" />
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchhojaruta',new Array('result-list','result-list'))" />
	</p>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setDatePicker(new Array('hojaruta_created_at'));
		$("#fleteros_id").click(function(){
			submitData2('formSearchhojaruta',new Array('result-list','result-list'));
		});
		$("#hojaruta_estado").click(function(){
			submitData2('formSearchhojaruta',new Array('result-list','result-list'));
		});
		$("#hojaruta_created_at").change(function(){
			submitData2('formSearchhojaruta',new Array('result-list','result-list'));
		});
	});
</script>