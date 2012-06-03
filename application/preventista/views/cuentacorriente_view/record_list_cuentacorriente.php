<script type="text/javascript">
$(document).ready(function(){ setPagination('<?=base_url()?>cuentacorriente_controller/search_c','result-list'); });
</script>
<div id="result-list">
	<?php if(isset($cuentacorriente) && is_array($cuentacorriente) && count($cuentacorriente)>0):?>
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
				<?php foreach($cuentacorriente as $f):?>
					<tr>
						<?php foreach($fieldShow as $field):?>
						<td><?=$f->$field?></td>
						<?php endforeach; ?>
						<?php if($flag['u']):?>
							<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/cuentacorriente_controller/edit_c/<?=$f->cuentacorriente_id?>','right-content')" id="icon-edit">Modificar</a></td>
						<?php endif;?>
						<?php if($flag['d']):?>
							<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/cuentacorriente_controller/delete_c/<?=$f->cuentacorriente_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
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
