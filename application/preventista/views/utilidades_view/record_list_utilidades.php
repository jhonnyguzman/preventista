<div id="result-list-wrapper">
	<div id ="result-list-left">
		<div id="result-list">
			<!--<span class="markUtilidades">Ingreso:</span>-->
			<?php if(isset($upedidos) && is_array($upedidos) && count($upedidos)>0):?>
				<table id="result-set">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Pedido Id</th>
							<th>Utilidad</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($upedidos as $f): $ingreso+=$f['utilidad']; ?>
								<tr>
									<td><?=$this->basicrud->formatDateToHuman($f['pedidos_created_at'])?></td>
									<td><?=$f['pedidos_id']?></td>
									<td>$&nbsp;<?=$f['utilidad']?></td>
								</tr>
						<?php endforeach; ?>
						<tr>
							<td></td>
							<td><strong>Ingreso Total:</strong></td>
							<td><strong>$&nbsp;<?=$ingreso?></strong></td>
						</tr>
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
	</div>
	<!--<div id="result-list-right">
		<div id="result-list">
			<span class="markUtilidades">Egreso:</span>
			<?php if(isset($compras) && is_array($compras) && count($compras)>0):?>
				<table id="result-set">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Compra Id</th>
							<th>Monto total</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($compras as $f): $egreso+=$f->compras_montototal; ?>
								<tr>
									<td><?=$this->basicrud->formatDateToHuman($f->compras_created_at)?></td>
									<td><?=$f->compras_id?></td>
									<td>$&nbsp;<?=$f->compras_montototal?></td>
								</tr>
						<?php endforeach; ?>
						<tr>
							<td></td>
							<td><strong>Egreso Total:</strong></td>
							<td><strong>$&nbsp;<?=$egreso?></strong></td>
						</tr>
					</tbody>
				</table>
				<?php if(isset($paginationcompras)):?>
					<div class='pagination'>
						<?=$paginationcompras?>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<p>No results!</p>
			<?php endif; ?>
		</div>-->
	<!--</div>-->
	<!--<div id="result-list-ganancia">
		<span class="markUtilidades">Ganancia: $&nbsp; <?php echo $ingreso - $egreso; ?> </span>
	</div>-->
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		setPaginationTwo('<?=base_url()?>utilidades_controller/search_c','result-list-wrapper','formSearchUtilidades');
	});
</script>

