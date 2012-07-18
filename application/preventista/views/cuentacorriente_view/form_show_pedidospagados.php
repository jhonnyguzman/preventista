<div id="form-search">
	<form action="" method="post" name="formPedidosPagados" id="formPedidosPagados">
		<?php if(count($pedidospagados) > 0): ?>
				<div id="lineascampos-modal">
					<table id="result-set">
						<thead>
						<tr>
							<th>Pedido Id</th>			
							<th>Fecha</th>
							<th>Monto Total</th>
							<th>Monto Adeudado</th>
							<th>Pagado</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($pedidospagados as $f): ?>
							<tr>
								<td><?=$f->pedidos_id?></td>
								<td><?=$this->basicrud->formatDateToHuman($f->pedidos_updated_at)?></td>
								<td>$&nbsp;<?=$f->peididos_montototal?></td>
								<td>$&nbsp;<?=$f->pedidos_montoadeudado?></td>
								<td class="markPedidoPagado">$&nbsp;<?=$f->peididos_montototal-$f->pedidos_montoadeudado?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
		<?php else: ?>
			<p>No existen pedidos pagados</p>
		<?php endif; ?>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
	});
</script>