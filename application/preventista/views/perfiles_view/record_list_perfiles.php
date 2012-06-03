<script type="text/javascript">
$(document).ready(function(){ setPagination('<?=base_url()?>perfiles_controller/search_c','result-list'); });
</script>
<div id="result-list">
	<?php if(isset($perfiles) && is_array($perfiles) && count($perfiles)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<?php foreach($fieldShow as $field):?>
					<th><?=$this->config->item($field)?></th>
					<?php endforeach; ?>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($perfiles as $f):?>
					<tr>
						<?php foreach($fieldShow as $field):?>
						<td><?=$f->$field?></td>
						<?php endforeach; ?>
						<?php if(!$flag['u']):?>
							<td><div class='block-item'><a href="#" id="icon-edit">Modificar</a><div class='mask-item'></div></div></td>
						<?php else: ?>
							<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/perfiles_controller/edit_c/<?=$f->perfiles_id?>','right-content')" id="icon-edit">Modificar</a></td>
						<?php endif;?>
						<?php if(!$flag['d']):?>
							<td><div class='block-item'><a href="#" id="icon-delete">Eliminar</a><div class='mask-item'></div></div></td>
						<?php else: ?>
							<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/perfiles_controller/delete_c/<?=$f->perfiles_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
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
