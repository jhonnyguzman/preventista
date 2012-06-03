<div id="result-list">
	<?php if(isset($remitos) && is_array($remitos) && count($remitos)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<th><input type="checkbox" name="chkAll" class="chkAll"></th>
					<?php foreach($fieldShow as $field):?>
					<th><?=$this->config->item($field)?></th>
					<?php endforeach; ?>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($remitos as $f):?>
					<?php if($f->remitos_estado == 12 ): ?>
						<tr class="markrow1">
							<td><input type="checkbox" name="chkRemitos" class="chkLote" value="<?=$f->remitos_id?>"></td>
							<?php foreach($fieldShow as $field):?>
							<td><?=$f->$field?></td>
							<?php endforeach; ?>
							<?php if($flag['u']):?>
								<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/pedidos_controller/edit_c/<?=$f->pedidos_id?>','right-content')" id="icon-edit">Modificar</a></td>
							<?php endif;?>
							<?php if($flag['d']):?>
								<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/remitos_controller/delete_c/<?=$f->remitos_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
							<?php endif;?>
						</tr>
					<?php elseif($f->remitos_estado == 13 ): ?>
						<tr class="markrow2">
							<td><input type="checkbox" name="chkRemitos" class="chkLote" value="<?=$f->remitos_id?>"></td>
							<?php foreach($fieldShow as $field):?>
							<td><?=$f->$field?></td>
							<?php endforeach; ?>
							<?php if($flag['u']):?>
								<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/pedidos_controller/edit_c/<?=$f->pedidos_id?>','right-content')" id="icon-edit">Modificar</a></td>
							<?php endif;?>
							<?php if($flag['d']):?>
								<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/remitos_controller/delete_c/<?=$f->remitos_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
							<?php endif;?>
						</tr>
					<?php else: ?>
						<tr class="markrow3">
							<td><input type="checkbox" name="chkRemitos" class="chkLote" value="<?=$f->remitos_id?>"></td>
							<?php foreach($fieldShow as $field):?>
							<td><?=$f->$field?></td>
							<?php endforeach; ?>
							<?php if($flag['u']):?>
								<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/pedidos_controller/edit_c/<?=$f->pedidos_id?>','right-content')" id="icon-edit">Modificar</a></td>
							<?php endif;?>
							<?php if($flag['d']):?>
								<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/remitos_controller/delete_c/<?=$f->remitos_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
							<?php endif;?>
						</tr>
					<?php endif; ?>
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
<script type="text/javascript">
	$(document).ready(function(){ 
		setPagination('<?=base_url()?>remitos_controller/search_c','result-list');
		selectAllChks('chkAll','chkRemitos');
	});
</script>