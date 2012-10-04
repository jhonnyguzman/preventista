<div class="searchShort">
	<p>
		<label><?=$this->config->item("clientes_apellido")?>:</label>
		<select name="clientes_id" id="clientes_id">
			<option value="">Seleccione</option>
			<?php foreach($clientes as $f):?>
				<option value="<?=$f->clientes_id?>"><?=$f->clientes_apellido." ".$f->clientes_nombre?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item("pedidos_created_at")?>:</label>
		<input type="text" name="pedidos_created_at" id="pedidos_created_at" />
	</p>
	<p>
		<label><?=$this->config->item("pedidos_estado_descripcion")?></label>
		<select name="pedidos_estado" id="pedidos_estado">
			<option value="">Seleccione</option>
			<?php foreach($pedidosestado as $f):?>
				<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" name="btn-search" class="crudtest-button" id="btn-search" value="Buscar" onClick="submitData('formSearchpedidos',new Array('result-list','result-list'))"></input>
	</p>
</div>

<script type="text/javascript">
$(document).ready(function() {
	setDatePicker(new Array('pedidos_created_at'));
	$("#pedidos_created_at").change(function(){
		submitData2('formSearchpedidos',new Array('result-list','result-list'));
	});
	$("#pedidos_estado").click(function(){
		submitData2('formSearchpedidos',new Array('result-list','result-list'));
	});
	$("#clientes_id").click(function(){
		submitData2('formSearchpedidos',new Array('result-list','result-list'));
	});
	$("#clientes_id").keypress(function(){
		submitData2('formSearchpedidos',new Array('result-list','result-list'));
	});

});
</script>