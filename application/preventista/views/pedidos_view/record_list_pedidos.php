<div id="result-list">
	<?php if(isset($pedidos) && is_array($pedidos) && count($pedidos)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<th><input type="checkbox" name="chkAll" class="chkAll"></th>
					<?php foreach($fieldShow as $field):?>
					<th><?=$this->config->item($field)?></th>
					<?php endforeach; ?>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pedidos as $f):?>
					<?php if($f->pedidos_estado == 6): ?>
						<tr>
							<td><input type="checkbox" name="chkPedidos" class="chkLote" value="<?=$f->pedidos_id?>"></td>
							<?php foreach($fieldShow as $field):?>
							<td><?=$f->$field?></td>
							<?php endforeach; ?>
							<td>
								<?php if($flag['r']):?>
									<a href="#" onClick="dialogUp('content_detail_modal',570,670,'<?=base_url()?>index.php/pedidos_controller/show_c/<?=$f->pedidos_id?>','Detalle de Pedido: <?=$f->pedidos_id?>')" id="icon-show">Ver</a>
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
							<?php foreach($fieldShow as $field):?>
								<td><?=$f->$field?></td>
							<?php endforeach; ?>
							<td>
								<?php if($flag['r']):?>
									<a href="#" onClick="dialogUp('content_detail_modal',570,500,'<?=base_url()?>index.php/pedidos_controller/show_c/<?=$f->pedidos_id?>','Detalle de Pedido: <?=$f->pedidos_id?>')" id="icon-show">Ver</a>
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
<div id="content_detail_modal"></div>
<script type="text/javascript">
	$(document).ready(function(){ 
		setPagination('<?=base_url()?>pedidos_controller/search_c','result-list'); 
		selectAllChks('chkAll','chkPedidos');
	});
</script>
