<div class="searchShort">
	<p>
		<label><?=$this->config->item("articulos_descripcion")?>:</label>
		<input type="text" name="articulos_descripcion" id="articulos_descripcion" />
	</p>
	<p>
		<label><?=$this->config->item("rubros_descripcion")?></label>
		<select name="rubros_id" id="rubros_id">
			<option value="">Seleccione</option>
			<?php foreach($rubros as $f):?>
				<option value="<?=$f->rubros_id?>"><?=$f->rubros_descripcion?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("marcas_descripcion")?></label>
		<select name="marcas_id[]" id="marcas_id"  onClick="getR(this,'<?=base_url()?>marcas_controller/get_c/')">
			<option value="">Seleccione</option>
			<?php foreach($marcas as $f):?>
				<option value="<?=$f->marcas_id?>"><?=$f->marcas_descripcion?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearcharticulos',new Array('result-list','result-list'))" />
	</p>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#articulos_descripcion").bind("keypress",function(){
		submitData2('formSearcharticulos',new Array('result-list','result-list'));
	});
	$("#rubros_id").change(function(){
		submitData2('formSearcharticulos',new Array('result-list','result-list'));
	});
	$("#marcas_id").change(function(){
		submitData2('formSearcharticulos',new Array('result-list','result-list'));
	});
});
</script>