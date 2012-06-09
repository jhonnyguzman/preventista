<div id="title-level2"><?=$subtitle?></div>
<div id="form">
	<div class="fields-required">Campos obligatorios (*)</div>
	<form action="<?=base_url()?>pedidos_controller/edit_c/<?=$pedidos->pedidos_id?>" method="post" name="formEditpedidos" id="formEditpedidos">
		<fieldset>
			<legend>Pedido</legend>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('pedidos_created_at')?>:</label>
				<input type="text" value="<?=$pedidos->pedidos_created_at?>" name="pedidos_created_at" id="pedidos_created_at" readonly="true"></input>
			</p>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('pedidos_id')?>:</label>
				<input type="text" value="<?=$pedidos->pedidos_id?>" name="pedidos_id" id="pedidos_id"  readonly="readonly"></input>
			</p>
			<!--<p>
				<label><span class='required'>*</span><?=$this->config->item('pedidos_montoadeudado')?>:</label>
				<input type="text" value="<?=$pedidos->pedidos_montoadeudado?>" name="pedidos_montoadeudado" id="pedidos_montoadeudado"></input>
			</p>-->
			<p>
				<label><span class='required'>*</span><?=$this->config->item('clientes_apellido')?>:</label>
				<input type="text" name="clientes_apellido" id="clientes_apellido" value="<?=$pedidos->clientes_apellido?>" readonly="true"/>
				<input type="hidden" name="clientes_id" id="clientes_id" value="<?=$pedidos->clientes_id?>"></input>
			</p>
			<p>	
				<label>Categ. Cliente:</label>
				<input type="hidden" name="clientescategoria_id" id="clientescategoria_id" value="<?=$pedidos->clientescategoria_id?>"></input>
				<input type="text" name="clientescategoria_descripcion" id="clientescategoria_descripcion" value="<?=$pedidos->clientescategoria_descripcion?>" readonly="true"/>
			</p>
			<p>
				<label><span class='required'>*</span><?=$this->config->item('pedidos_estado')?>:</label>
				<input type="hidden" value="<?=$pedidos->pedidos_estado?>" name="pedidos_estado" id="pedidos_estado"></input>
				<input type="text" value="<?=$pedidos->pedidos_estado_descripcion?>" name="pedidos_estado_descripcion" id="pedidos_estado_descripcion" readonly="true" />
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
						<?php for($i=0; $i<count($pedidodetalle); $i++): ?>
							<tr id="<?=$i?>">
								<td><input type="text" name="articulos_descripcion-<?=$i?>" id="articulos_descripcion-<?=$i?>" onFocus="autocompleteTwo('articulos_descripcion-<?=$i?>','<?=base_url()?>autocomplete_controller/getAutocompleteLineas','articulos_model','',new Array('articulos_id-<?=$i?>', getPrecio('clientescategoria_id',<?=$i?>),'articulos_stockreal-<?=$i?>'),'articulos_descripcion');" 
									onblur="checkRepeatArticle(this,<?=$i?>)" value="<?=$pedidodetalle[$i]->articulos_descripcion?>" />
									<input type="hidden" name="articulos_id-<?=$i?>" id="articulos_id-<?=$i?>" value="<?=$pedidodetalle[$i]->articulos_id?>" />
									<input type="hidden" name="pedidodetalle_id-<?=$i?>" id="pedidodetalle_id-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_id?>" />
								</td>
								<td><input type="text" name="articulos_stockreal-<?=$i?>" id="articulos_stockreal-<?=$i?>" value="<?=$pedidodetalle[$i]->articulos_stockreal?>" readonly="true"/></td>
								<td><input type="text" name="<?=$articulos_precio?>-<?=$i?>" id="<?=$articulos_precio?>-<?=$i?>" value="<?=$pedidodetalle[$i]->articulos_precio?>" readonly="true"></input></td>
								<td><input type="text" name="pedidodetalle_montoacordado-<?=$i?>" id="pedidodetalle_montoacordado-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_montoacordado?>"
									onChange="getSubtotal('clientescategoria_id',<?=$i?>)"></input></td>
								<td>
									<input type="text" name="pedidodetalle_cantidad-<?=$i?>" id="pedidodetalle_cantidad-<?=$i?>" 
									onChange="getSubtotal('clientescategoria_id',<?=$i?>)" value="<?=$pedidodetalle[$i]->pedidodetalle_cantidad?>" />
									<input type="hidden" name="pedidodetalle_cantidad_old-<?=$i?>" id="pedidodetalle_cantidad_old-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_cantidad?>" />
								</td>
								<td><input type="text" name="pedidodetalle_subtotal-<?=$i?>" id="pedidodetalle_subtotal-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_subtotal?>" readonly="true"></input></td>
							</tr>
						<?php endfor; ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?=$this->config->item('peididos_montototal')?>:</td>
							<td><input type="text" name="peididos_montototal" id="peididos_montototal" value="<?=$pedidos->peididos_montototal?>"></input></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--<a href="#" onclick="AgregarCampos();">Agregar Campos</a>-->
			<p>
				<label><span class='required'>*</span>Tr&aacute;mite:</label>
				<select type="text" name="tramites_id" id="tramites_id" >
					<?php foreach($tramites as $f): ?>
						<?php if($f->tramites_id == $pedidos->tramites_id): ?>
							<option value="<?=$f->tramites_id?>" selected><?=$f->tramites_descripcion?></option>
						<?php else: ?>
							<option value="<?=$f->tramites_id?>"><?=$f->tramites_descripcion?></option>
						<?php endif;?>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label>Observaci&oacute;n:</label>
				<textarea name="pedidos_observaciones" id="pedidos_observaciones" ><?=$pedidos->pedidos_observaciones?></textarea>
			</p>
		</fieldset>
		<div class="botonera">
			<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditpedidos',new Array('right-content','right-content'))"></input>
			<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>pedidos_controller/index','right-content')"></input>
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
<script type="text/javascript"> 
$(document).ready(function(){ 
	/*$('#clientes_apellido').focus(function(){
		autocomplete('clientes_apellido','<?=base_url()?>autocomplete_controller/getAutocomplete_c','clientes_model','',new Array('clientes_id','clientescategoria_id','clientescategoria_descripcion'));
	});*/
});
</script>
