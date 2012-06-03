<div id="lineascampos">
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
					<td><input type="text" name="articulos_descripcion-<?=$i?>" id="articulos_descripcion-<?=$i?>" onFocus="autocompleteTwo('articulos_descripcion-<?=$i?>','<?=base_url()?>autocomplete_controller/getAutocompleteLineas','articulos_model','',new Array('articulos_id-<?=$i?>', 'articulos_preciocompra-<?=$i?>','articulos_stockreal-<?=$i?>'),'articulos_descripcion');" 
						onblur="checkRepeatArticle(this,<?=$i?>)" value="<?=$compradetalle[$i]->articulos_descripcion?>"/>
						<input type="hidden" name="articulos_id-<?=$i?>" id="articulos_id-<?=$i?>" value="<?=$compradetalle[$i]->articulos_id?>" />
						<input type="hidden" name="comprasdetalle_id-<?=$i?>" id="comprasdetalle_id-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_id?>" />
					</td>
					<td><input type="text" name="articulos_stockreal-<?=$i?>" id="articulos_stockreal-<?=$i?>" value="<?=$compradetalle[$i]->articulos_stockreal?>" readonly="true"/></td>
					<td>
						<input type="text" name="articulos_preciocompra-<?=$i?>" id="articulos_preciocompra-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_costo?>" onblur="getSubtotal2(<?=$i?>)" />
						<input type="hidden" name="articulos_preciocompra_old-<?=$i?>" id="articulos_preciocompra_old-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_costo?>" />
					</td>
					<td>
						<input type="text" name="comprasdetalle_cantidad-<?=$i?>" id="comprasdetalle_cantidad-<?=$i?>" 
						onblur="getSubtotal2(<?=$i?>)" value="<?=$compradetalle[$i]->comprasdetalle_cantidad?>"></input>
						<input type="hidden" name="comprasdetalle_cantidad_old-<?=$i?>" id="comprasdetalle_cantidad_old-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_cantidad?>" />
					</td>
					<!--<td><input type="text" name="comprasdetalle_costo-<?=$i?>" id="comprasdetalle_costo-<?=$i?>"></input></td>-->
					<td><input type="text" name="comprasdetalle_subtotal-<?=$i?>" id="comprasdetalle_subtotal-<?=$i?>" value="<?=$compradetalle[$i]->comprasdetalle_subtotal?>" readonly="true"></input></td>
				</tr>
			<?php endfor; ?>
		</tbody>
	</table>
</div>
