<div class="header-print">
	<table class="tb-header-print">
		<tr>
			<td><strong>Remito:&nbsp;<?=$remito[0]->remitos_id?></strong></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>Cliente:&nbsp;<?=$pedido[0]->clientes_apellido." ".$pedido[0]->clientes_nombre?></strong></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>Fletero:&nbsp;<?=$hojaruta->fleteros_apellnom?></strong></td>
			<td class='today-date-print2'><strong>Fecha:&nbsp;<?=$remito[0]->remitos_created_at?></strong></td>
		</tr>
	</table>
</div>
<div id="result-list">
	<?php if(isset($pedidodetalle) && is_array($pedidodetalle) && count($pedidodetalle)>0):?>
		<table class="tb-result-set-print">
			<thead>
				<tr>
					<th>Articulo</th>
					<th>Cantidad</th>
					<th>Precio Unitario</th>
					<th>Monto total</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pedidodetalle as $f):?>
					<tr>
						<td><?=$f->articulos_descripcion?></td>
						<td><?=$f->pedidodetalle_cantidad?></td>
						<td><span>$&nbsp;</span><?=$f->articulos_precio?></td>
						<td><span>$&nbsp;</span><?=$f->pedidodetalle_subtotal?></td>
					</tr>
				<?php  endforeach; ?>
			</tbody>
			<tr>
				<td></td>
				<td></td>
				<td class="alignRight"><strong>Total Pedido:</strong></td>
				<td><span>$&nbsp;</span><?=$pedido[0]->peididos_montototal?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><strong>Remitos adeudados</strong></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php if(count($pedidosadeudados) > 0): ?>
				<?php foreach($pedidosadeudados as $f): ?>
					<tr>
						<td>&nbsp;</td>
						<td><?=$f->remitos_id?></td>
						<td><?=$this->basicrud->formatDateToHuman($f->remitos_created_at)?></td>
						<?php if($f->pedidos_montoadeudado > 0): ?>
							<td><span>$&nbsp;</span><?=$f->pedidos_montoadeudado?></td>
						<?php else: ?>
							<td><span>$&nbsp;</span><?=$f->peididos_montototal?></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			<tr>
				<td></td>
				<td></td>
				<td class="alignRight"><strong>Saldo C/C:</strong></td>
				<td><span>$&nbsp;</span><?=$saldocliente?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td class="alignRight"><strong>Saldo + Total Pedido:</strong></td>
				<td><span>$&nbsp;</span><?php echo $saldocliente + $pedido[0]->peididos_montototal; ?></td>
			</tr>
			<tr>
				<td class="markRow">&nbsp;</td>
				<td class="markRow">&nbsp;</td>
				<td class="markRow">&nbsp;</td>
				<td class="markRow">&nbsp;</td>
			</tr>
			<tr>
				<td><strong>Remito:&nbsp;</strong><?=$remito[0]->remitos_id?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class='today-date-print2'><strong>Fecha:&nbsp;</strong><?=$remito[0]->remitos_created_at?></td>
			</tr>
			<tr>
				<td><strong>Cliente:&nbsp;</strong><?=$pedido[0]->clientes_apellido." ".$pedido[0]->clientes_nombre?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><strong>Fletero:&nbsp;</strong><?=$hojaruta->fleteros_apellnom?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="alignRight"><strong>Total Pedido:</strong></td>
				<td><span>$&nbsp;</span><?=$pedido[0]->peididos_montototal?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="alignRight"><strong>Saldo C/C:</strong></td>
				<td><span>$&nbsp;</span><?=$saldocliente?></td>
			</tr>
			<tr>
				<td><strong>Firma cliente:</strong></td>
				<td>______________________</td>
				<td class="alignRight"><strong>Deuda:</strong></td>
				<td><span>$&nbsp;</span><?php echo $saldocliente + $pedido[0]->peididos_montototal; ?></td>
			</tr>
			<tr>
				<td class="markRow">&nbsp;</td>
				<td class="markRow">&nbsp;</td>
				<td class="markRow">&nbsp;</td>
				<td class="markRow">&nbsp;</td>
			</tr>
		</table>
	<?php else: ?>
		<p>No results!</p>
	<?php endif; ?>
</div>
<?=$this->load->view("default_view/_style_to_print")?>