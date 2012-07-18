<div id="result-list">
	<?php if(isset($pedidos) && is_array($pedidos) && count($pedidos)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<th><input type="checkbox" name="chkAll" class="chkAll"></th>
					<th><?=$this->config->item("pedidos_id")?></th>
					<th>Cliente</th>
					<th><?=$this->config->item("tramites_descripcion")?></th>
					<th><?=$this->config->item("pedidos_estado_descripcion")?></th>
					<th><?=$this->config->item("peididos_montototal")?></th>
					<th><?=$this->config->item("pedidos_montoadeudado")?></th>
					<th><?=$this->config->item("pedidos_created_at")?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pedidos as $f):?>
					<?php if($f->pedidos_estado == 6): ?>
						<tr>
							<td><input type="checkbox" name="chkPedidos" class="chkLote" value="<?=$f->pedidos_id?>"></td>							
							<td><?=$f->pedidos_id?></td>
							<td><?=$f->clientes_apellido." ".$f->clientes_nombre?></td>
							<td><?=$f->tramites_descripcion?></td>
							<td><?=$f->pedidos_estado_descripcion?></td>
							<td><?=$f->peididos_montototal?></td>
							<td><?=$f->pedidos_montoadeudado?></td>
							<td><?=$f->pedidos_created_at?></td>
							<td>
								<?php if($flag['r']):?>
									<a href="#" onClick="dialogUp('content_detail_modal',600,700,'<?=base_url()?>index.php/pedidos_controller/show_c/<?=$f->pedidos_id?>','Detalle de Pedido: <?=$f->pedidos_id?>')" id="icon-ver">Ver</a>
								<?php endif;?>
								<?php if($flag['u']):?>
									<a href="#" onClick="loadPage('<?=base_url()?>index.php/pedidos_controller/edit_c/<?=$f->pedidos_id?>','right-content')" id="icon-edit">Modificar</a>
								<?php endif;?>
								<?php if($flag['d']):?>
									<a href="#" onClick="deleteData('<?=base_url()?>index.php/pedidos_controller/delete_c/<?=$f->pedidos_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a>
								<?php endif;?>
							</td>
						</tr>
					<?php else: ?>
						<tr>
							<td><input type="checkbox" name="chkPedidos" class="chkLote" value="<?=$f->pedidos_id?>"></td>
							<td><?=$f->pedidos_id?></td>
							<td><?=$f->clientes_apellido." ".$f->clientes_nombre?></td>
							<td><?=$f->tramites_descripcion?></td>
							<td><?=$f->pedidos_estado_descripcion?></td>
							<td><?=$f->peididos_montototal?></td>
							<td><?=$f->pedidos_montoadeudado?></td>
							<td><?=$f->pedidos_created_at?></td>
							<td>
								<?php if($flag['r']):?>
									<a href="#" onClick="dialogUp('content_detail_modal',600,700,'<?=base_url()?>index.php/pedidos_controller/show_c/<?=$f->pedidos_id?>','Detalle de Pedido: <?=$f->pedidos_id?>')" id="icon-ver">Ver</a>
								<?php endif;?>
							</td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
				<input type="hidden" id="id123" >
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

<script type="text/javascript">
	$(document).ready(function(){ 
		setPagination('<?=base_url()?>pedidos_controller/search_c','result-list'); 
		selectAllChks('chkAll','chkPedidos');
	});
</script>
