<div id="marcas">
	<form action="<?=base_url()?>articulos_controller/editFastGeneralPrecio_c" method="post" name="formEditFastPriceArticulos" id="formEditFastPriceArticulos">
		<?php foreach($articulos_ids as $f): ?>
			<input type="hidden" name="articulos_ids[]" id="articulos_ids" value="<?=$f?>">
		<?php endforeach; ?>
		<p>
			<strong>Items seleccionados:&nbsp;<?=$cantSeleccionados?></strong>
		</p>
		<p>
			<label>%&nbsp;<?=$this->config->item('articulos_preciocompra')?>:</label>
			<input type="text" name="articulos_porcentaje_preciocompra" id="articulos_porcentaje_preciocompra"></input>
			<input type="radio" name="flag_p" id="flag_p" value="sumar" checked /> Sumar
			<input type="radio" name="flag_p" id="flag_p" value="restar" /> Restar
		</p>
		<p>
			<label><?=$this->config->item('articulos_precio1')?>:</label>
			<input type="text" name="articulos_precio1" id="articulos_precio1"></input>
		</p>
		<p>
			<label><?=$this->config->item('articulos_precio2')?>:</label>
			<input type="text" name="articulos_precio2" id="articulos_precio2"></input>
		</p>
		<p>
			<label><?=$this->config->item('articulos_precio3')?>:</label>
			<input type="text" name="articulos_precio3" id="articulos_precio3"></input>
		</p>
		<p>
			<label>¿Qu&eacute; desea hacer?:</label>
			<input type="radio" name="flag" id="flag" value="porcentaje" checked /> Modificar s&oacute;lo el porcentaje
			<input type="radio" name="flag" id="flag" value="precio" /> Modificar s&oacute;lo el precio de compra
		</p>
		<div class="botonera">
			<input type="submit" name="actualizar" value="Actualizar" class="crudtest-button" id="btn-save" onClick="submitData('formEditFastPriceArticulos',new Array('right-content','right-content'))"></input>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){ 
		$('#articulos_porcentaje_preciocompra').change(function(){
			if($(this).val() != '') {
				$('#articulos_precio1').attr('disabled','disabled');
				$('#articulos_precio2').attr('disabled','disabled');
				$('#articulos_precio3').attr('disabled','disabled');
				$('input[name=flag]').attr('disabled','disabled');
			}else{
				$('#articulos_precio1').attr('disabled',false);
				$('#articulos_precio2').attr('disabled',false);
				$('#articulos_precio3').attr('disabled',false);
				$('input[name=flag]').attr('disabled',false);
			}
		});
	});
</script>