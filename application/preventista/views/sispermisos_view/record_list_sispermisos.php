<script type="text/javascript">
$(document).ready(function(){ setPagination('<?=base_url()?>sispermisos_controller/search_c','result-list'); });
</script>
<div id="result-list">
	<?php if(isset($sispermisos) && is_array($sispermisos) && count($sispermisos)>0):?>
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
				<?php foreach($sispermisos as $f):?>
					<tr>
						<?php foreach($fieldShow as $field):?>
						<?php if($f->$field==1 && ($field=='sispermisos_flag_read' || $field=='sispermisos_flag_insert' || $field=='sispermisos_flag_update' || $field=='sispermisos_flag_delete')):?>
							<td><img src="<?=base_url()?>css/images/icon-ok.png"></td>
						<?php elseif($f->$field==0 && ($field=='sispermisos_flag_read' || $field=='sispermisos_flag_insert' || $field=='sispermisos_flag_update' || $field=='sispermisos_flag_delete')):?>
							<td><img src="<?=base_url()?>css/images/icon-not.png"></td>
						<?php else:?>
							<td><?=$f->$field?></td>
						<?php endif;?>
						<?php endforeach; ?>
						<?php if($flag['u']):?>
							<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/sispermisos_controller/edit_c/<?=$f->sispermisos_id?>','right-content')" id="icon-edit">Modificar</a></td>
						<?php endif;?>
						<?php if($flag['d']):?>
							<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/sispermisos_controller/delete_c/<?=$f->sispermisos_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
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
