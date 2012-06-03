<script type="text/javascript">
	$(document).ready(function(){ setPagination('<?=base_url()?>comprasdetalle_controller/searchByArticulo_c','result-list'); });
</script>
<div id="result-list">
	<?php if(isset($comprasdetalle) && is_array($comprasdetalle) && count($comprasdetalle)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<th>Compra Id</th>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Articulo</th>
					<th>Cantidad</th>
					<th>Costo</th>
					<th>Subtotal</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($comprasdetalle as $f):?>
					<tr>
						<td><a href="#" onClick="dialogUp('content_detail_modal',500,500, '<?=base_url()?>index.php/compras_controller/show_c/<?=$f->compras_id?>', 'Detalle de Compra: <?=$f->compras_id?>')"><?=$f->compras_id?></a></td>
						<td><?=$f->comprasdetalle_created_at?></td>
						<td><?=$f->proveedores_apellido." ".$f->proveedores_nombre?></td>
						<td><?=$f->articulos_descripcion?></td>
						<td><?=$f->comprasdetalle_cantidad?></td>
						<td><?=$f->comprasdetalle_costo?></td>
						<td><?=$f->comprasdetalle_subtotal?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php if(isset($pagination)):?>
			<div class='pagination'>
				<?=$pagination?>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<p>No results!</p>
	<?php endif; ?>
</div>
<div id="content_detail_modal" ></div>
