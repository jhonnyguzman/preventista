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
			<?php for($i=0; $i<10; $i++): ?>
				<tr id="<?=$i?>">
					<td><input type="text" name="articulos_descripcion-<?=$i?>" id="articulos_descripcion-<?=$i?>" onFocus="autocompleteTwo('articulos_descripcion-<?=$i?>','<?=base_url()?>autocomplete_controller/getAutocompleteLineas','articulos_model','',new Array('articulos_id-<?=$i?>', 'articulos_preciocompra-<?=$i?>','articulos_stockreal-<?=$i?>'),'articulos_descripcion');" 
						onblur="checkRepeatArticle(this,<?=$i?>); setPriceOld(<?=$i?>);"/>
						<input type="hidden" name="articulos_id-<?=$i?>" id="articulos_id-<?=$i?>" />
					</td>
					<td><input type="text" name="articulos_stockreal-<?=$i?>" id="articulos_stockreal-<?=$i?>" readonly="true" /></td></td>
					<td>
						<input type="text" name="articulos_preciocompra-<?=$i?>" id="articulos_preciocompra-<?=$i?>" onblur="getSubtotal2(<?=$i?>)"/>
						<input type="hidden" name="articulos_preciocompra_old-<?=$i?>" id="articulos_preciocompra_old-<?=$i?>" />
					</td>
					<td><input type="text" name="comprasdetalle_cantidad-<?=$i?>" id="comprasdetalle_cantidad-<?=$i?>" 
						onblur="getSubtotal2(<?=$i?>)"></input></td>
					<!--<td><input type="text" name="comprasdetalle_costo-<?=$i?>" id="comprasdetalle_costo-<?=$i?>"></input></td>-->
					<td><input type="text" name="comprasdetalle_subtotal-<?=$i?>" id="comprasdetalle_subtotal-<?=$i?>" readonly="true" /></td>
				</tr>
			<?php endfor; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript"> 
	function setPriceOld(i){
		$('#articulos_preciocompra_old-'+i).val($("#articulos_preciocompra-"+i).val());
	}
</script>