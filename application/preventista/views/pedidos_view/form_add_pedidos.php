<script type="text/javascript">
	/*var nextinput = 0;
	function AgregarCampos(){
	nextinput++;
	campo = '<input type="text" size="20" id="campo' + nextinput + '"  name="campo' + nextinput + '"  />';
	$("#lineascampos").append(campo);
	}*/
</script>
<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<form action="<?=base_url()?>pedidos_controller/add_c" method="post" name="formAddpedidos" id="formAddpedidos">
	<fieldset>
		<legend>Pedido</legend>
		<p>
			<label><?=$this->config->item('pedidos_created_at')?>:</label>
			<input type="text" value="<?=$this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime())?>" name="pedidos_created_at" id="pedidos_created_at" readonly="true"></input>
		</p>
		<p>
			<label><span class='required'>*</span><?=$this->config->item('clientes_apellido')?>:</label>
			<input type="text" name="clientes_apellido" id="clientes_apellido"></input>
			<input type="hidden" name="clientes_id" id="clientes_id"></input>
		</p>
		<p>
			<label><span class='required'>*</span>Categ. Cliente:</label>
			<input type="hidden" name="clientescategoria_id" id="clientescategoria_id"></input>
			<input type="text" name="clientescategoria_descripcion" id="clientescategoria_descripcion" readonly="true"></input>
		</p>
	</fieldset>
	<fieldset>
		<legend>Detalle</legend>
		<div id="lineascampos">
			<table>
				<thead>
					<tr>
						<th>Descripci&oacute;n</th>
						<th>Stock</th>
						<th>Precio</th>
						<th>Monto acordado</th>
						<th>Cantidad</th>	
						<th>Subtotal</th>	
					</tr>
				</thead>
				<tbody>
					<?php for($i=0; $i<25; $i++): ?>
					<tr id="<?=$i?>">
						<td><input type="text" name="articulos_descripcion-<?=$i?>" id="articulos_descripcion-<?=$i?>" 
							onFocus="autocompleteTwo('articulos_descripcion-<?=$i?>','<?=base_url()?>autocomplete_controller/getAutocompleteLineas','articulos_model','',new Array('articulos_id-<?=$i?>', getPrecio('clientescategoria_id',<?=$i?>),'articulos_stockreal-<?=$i?>'),'articulos_descripcion');" 
							onBlur="checkRepeatArticle(this,<?=$i?>)"/>
							<input type="hidden" name="articulos_id-<?=$i?>" id="articulos_id-<?=$i?>" />
						</td>
						<td><input type="text" name="articulos_stockreal-<?=$i?>" id="articulos_stockreal-<?=$i?>" readonly="true" /></td>
						<td><input type="text" name="articulos_precio-<?=$i?>" id="articulos_precio-<?=$i?>" readonly="true" ></input></td>
						<td><input type="text" name="pedidodetalle_montoacordado-<?=$i?>" id="pedidodetalle_montoacordado-<?=$i?>"
							onblur="getSubtotal('clientescategoria_id',<?=$i?>)"></input></td>
						<td><input type="text" name="pedidodetalle_cantidad-<?=$i?>" id="pedidodetalle_cantidad-<?=$i?>" 
							onblur="getSubtotal('clientescategoria_id',<?=$i?>)"></input></td>
						<td><input type="text" name="pedidodetalle_subtotal-<?=$i?>" id="pedidodetalle_subtotal-<?=$i?>" readonly="true"></input></td>
					</tr>
					<?php endfor; ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?=$this->config->item('peididos_montototal')?>:</td>
						<td><input type="text" name="peididos_montototal" id="peididos_montototal"></input></td>
					</tr>
				</tbody>
			</table>
		</div>
		<p>
			<label><span class='required'>*</span>Tr&aacute;mite:</label>
			<select type="text" name="tramites_id" id="tramites_id" >
				<option value="">Seleccione</option>
				<?php foreach($tramites as $f): ?>
					<option value="<?=$f->tramites_id?>"><?=$f->tramites_descripcion?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label>Observaci&oacute;n:</label>
			<textarea name="pedidos_observaciones" id="pedidos_observaciones"></textarea>
		</p>
		<!--<a href="#" onclick="AgregarCampos();">Agregar Campos</a>-->
	</fieldset>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddpedidos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>pedidos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>

<script type="text/javascript"> 
	$(document).ready(function(){ 
		$('#clientes_apellido').focus(function(){
			autocomplete('clientes_apellido','<?=base_url()?>autocomplete_controller/getAutocomplete_c','clientes_model','',new Array('clientes_id','clientescategoria_id','clientescategoria_descripcion'));
		});
	});
</script>
