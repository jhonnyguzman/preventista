<script type="text/javascript">
$(document).ready(function(){ setPagination('<?=base_url()?>compras_controller/search_c','result-list'); });
</script>
<div id="result-list">
	<?php if(isset($compras) && is_array($compras) && count($compras)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<th><?=$this->config->item('compras_id')?></th>
					<th><?=$this->config->item('proveedores_apellido')?></th>
					<th><?=$this->config->item('compras_montototal')?></th>
					<th><?=$this->config->item('usuarios_username')?></th>
					<th><?=$this->config->item('compras_created_at')?></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($compras as $f):?>
					<tr>
						<td><a href="#" onClick="dialogUp('content_detail_modal',500,500, '<?=base_url()?>index.php/compras_controller/show_c/<?=$f->compras_id?>', 'Detalle de Compra: <?=$f->compras_id?>')"><?=$f->compras_id?></a></td>
						<td><?=$f->proveedores_apellido." ".$f->proveedores_nombre?></td>
						<td><?=$f->compras_montototal?></td>
						<td><?=$f->usuarios_username?></td>
						<td><?=$f->compras_created_at?></td>
						<?php if($flag['u']):?>
							<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/compras_controller/edit_c/<?=$f->compras_id?>','right-content')" id="icon-edit">Modificar</a></td>
						<?php endif;?>
						<?php if($flag['d']):?>
							<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/compras_controller/delete_c/<?=$f->compras_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
						<?php endif;?>
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
<div id="content_detail_modal"></div>
