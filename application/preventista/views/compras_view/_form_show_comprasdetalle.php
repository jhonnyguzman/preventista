<div id="lineascampos-modal">
	<table>
		<thead>
			<tr>
				<th>Descripci&oacute;n</th>
				<th>Stock</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Subtotal</th>	
			</tr>
		</thead>
		<tbody>
			<?php for($i=0; $i<count($compradetalle); $i++): ?>
				<tr id="<?=$i?>">
					<td><input type="text" name="articulos_descripcion-<?=$i?>" id="articulos_descripcion-<?=$i?>" value="<?=$compradetalle[$i]->articulos_descripcion?>" readonly="true" />
						<input type="hidden" name="articulos_id-<?=$i?>" id="articulos_id-<?=$i?>" value="<?=$compradetalle[$i]->articulos_id?>" />
						<input type="hidden" name="comprasdetalle_id-<?=$i?>" id="comprasdetalle_id-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_id?>" />
					</td>
					<td><input type="text" name="articulos_stockreal-<?=$i?>" id="articulos_stockreal-<?=$i?>" value="<?=$compradetalle[$i]->articulos_stockreal?>" readonly="true" class="markInputModal"/></td>
					<td>
						<input type="text" name="articulos_preciocompra-<?=$i?>" id="articulos_preciocompra-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_costo?>" readonly="true" class="markInputModal"/>
						<input type="hidden" name="articulos_preciocompra_old-<?=$i?>" id="articulos_preciocompra_old-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_costo?>" />
					</td>
					<td>
						<input type="text" name="comprasdetalle_cantidad-<?=$i?>" id="comprasdetalle_cantidad-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_cantidad?>" readonly="true" class="markInputModal"/>
						<input type="hidden" name="comprasdetalle_cantidad_old-<?=$i?>" id="comprasdetalle_cantidad_old-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_cantidad?>" />
					</td>
					<td><input type="text" name="comprasdetalle_subtotal-<?=$i?>" id="comprasdetalle_subtotal-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_subtotal?>" readonly="true" class="markInputModal"></input></td>
				</tr>
			<?php endfor; ?>
		</tbody>
	</table>
</div>
