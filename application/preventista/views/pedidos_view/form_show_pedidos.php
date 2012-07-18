<div id="form-small">
	<form action="" method="post" name="formShowpedidos" id="formShowpedidos">
		<fieldset>
			<legend>Pedido</legend>
			<p>
				<label><?=$this->config->item('pedidos_created_at')?>:</label>
				<input type="text" value="<?=$pedidos->pedidos_created_at?>" name="pedidos_created_at" id="pedidos_created_at" readonly="true"/>
			</p>
			<p>
				<label><?=$this->config->item('pedidos_id')?>:</label>
				<input type="text" value="<?=$pedidos->pedidos_id?>" name="pedidos_id" id="pedidos_id"  readonly="readonly" />
			</p>
			<p>
				<label><?=$this->config->item('pedidos_montoadeudado')?>:</label>
				<input type="text" value="<?=$pedidos->pedidos_montoadeudado?>" name="pedidos_montoadeudado" id="pedidos_montoadeudado" readonly="true"/>
			</p>
			<p>
				<label><?=$this->config->item('clientes_apellido')?>:</label>
				<input type="text" name="clientes_apellido" id="clientes_apellido" value="<?=$pedidos->clientes_apellido." ".$pedidos->clientes_nombre?>" readonly="true"/>
				<input type="hidden" name="clientes_id" id="clientes_id" value="<?=$pedidos->clientes_id?>" />
			</p>
			<p>	
				<label>Categ. Cliente:</label>
				<input type="hidden" name="clientescategoria_id" id="clientescategoria_id" value="<?=$pedidos->clientescategoria_id?>" />
				<input type="text" name="clientescategoria_descripcion" id="clientescategoria_descripcion" value="<?=$pedidos->clientescategoria_descripcion?>" readonly="true"/>
			</p>
			<p>
				<label><?=$this->config->item('pedidos_estado')?>:</label>
				<input type="hidden" value="<?=$pedidos->pedidos_estado?>" name="pedidos_estado" id="pedidos_estado" />
				<input type="text" value="<?=$pedidos->pedidos_estado_descripcion?>" name="pedidos_estado_descripcion" id="pedidos_estado_descripcion" readonly="true" />
			</p>
		</fieldset>
		<fieldset>
			<legend>Detalle</legend>
			<div id="lineascampos-modal">
				<table>
					<thead>
						<tr>
							<th>Descripci&oacute;n</th>
							<th>Stock</th>
							<th>Precio</th>
							<th>Monto Acord.</th>
							<th>Cantidad</th>	
							<th>Subtotal</th>	
						</tr>
					</thead>
					<tbody>
						<?php for($i=0; $i<count($pedidodetalle); $i++): ?>
							<tr id="<?=$i?>">
								<td><input type="text" name="articulos_descripcion-<?=$i?>" id="articulos_descripcion-<?=$i?>" value="<?=$pedidodetalle[$i]->articulos_descripcion?>" readonly="true"/>
									<input type="hidden" name="articulos_id-<?=$i?>" id="articulos_id-<?=$i?>" value="<?=$pedidodetalle[$i]->articulos_id?>" />
									<input type="hidden" name="pedidodetalle_id-<?=$i?>" id="pedidodetalle_id-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_id?>" />
								</td>
								<td><input type="text" name="articulos_stockreal-<?=$i?>" id="articulos_stockreal-<?=$i?>" value="<?=$pedidodetalle[$i]->articulos_stockreal?>" readonly="true" class="markInputModal" /></td>
								<td><input type="text" name="<?=$articulos_precio?>-<?=$i?>" id="<?=$articulos_precio?>-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_pv?>" readonly="true" class="markInputModal" /></td>
								<td><input type="text" name="pedidodetalle_montoacordado-<?=$i?>" id="pedidodetalle_montoacordado-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_montoacordado?>" readonly="true" class="markInputModal" /></td>
								<td>
									<input type="text" name="pedidodetalle_cantidad-<?=$i?>" id="pedidodetalle_cantidad-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_cantidad?>" readonly="true" class="markInputModal" />
									<input type="hidden" name="pedidodetalle_cantidad_old-<?=$i?>" id="pedidodetalle_cantidad_old-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_cantidad?>" />
								</td>
								<td><input type="text" name="pedidodetalle_subtotal-<?=$i?>" id="pedidodetalle_subtotal-<?=$i?>" value="<?=$pedidodetalle[$i]->pedidodetalle_subtotal?>" readonly="true" class="markInputModal" /></td>
							</tr>
						<?php endfor; ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?=$this->config->item('peididos_montototal')?>:</td>
							<td><input type="text" name="peididos_montototal" id="peididos_montototal" value="<?=$pedidos->peididos_montototal?>" readonly="true" class="markInputModal"/></td>
						</tr>
					</tbody>
				</table>
			</div>
			<p>
				<label>Tr&aacute;mite:</label>
				<input type="text" name="tramites_descripcion" id="tramites_descripcion" value="<?=$pedidos->tramites_descripcion?>" readonly="true" />
			</p>
			<p>
				<label>Observaci&oacute;n:</label>
				<textarea name="pedidos_observaciones" id="pedidos_observaciones" readonly="true" style="height:60px;"><?=$pedidos->pedidos_observaciones?></textarea>
			</p>
		</fieldset>
		<div class="botonera">
			<input type="button" name="btnCerrar" id="btnCerrar" value="Cerrar" />
		</div>
	</form>
</div>
<script type="text/javascript"> 
$(document).ready(function(){ 
	$("#btnCerrar").click(function(){
		$("#content_detail_modal").dialog("close");	
	});
});
</script>

