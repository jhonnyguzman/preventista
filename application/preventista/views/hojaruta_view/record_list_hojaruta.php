<div id="result-list">
	<?php if(isset($hojaruta) && is_array($hojaruta) && count($hojaruta)>0):?>
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
			<?php foreach($hojaruta as $f):?>
				<?php if($f->hojaruta_estado == 10): ?>
					<tr class="markrow1">
						<td><input type="checkbox" name="chkHojaRuta" class="chkLote" value="<?=$f->hojaruta_id?>"></td>
						<?php foreach($fieldShow as $field):?>
							<td><?=$f->$field?></td>
						<?php endforeach; ?>
						<td>
							<?php if($flag['u']):?>
								<a href="#" onClick="loadPage('<?=base_url()?>hojaruta_controller/edit_c/<?=$f->hojaruta_id?>','right-content')" id="icon-edit">Modificar</a>
							<?php endif;?>
							<?php if($flag['d']):?>
								<a href="#" onClick="deleteData('<?=base_url()?>hojaruta_controller/delete_c/<?=$f->hojaruta_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a>
							<?php endif;?>
						</td>
					</tr>
				<?php elseif($f->hojaruta_estado == 11) : ?>
					<tr class="markrow2">
						<td><input type="checkbox" name="chkHojaRuta" class="chkLote" value="<?=$f->hojaruta_id?>"></td>
						<?php foreach($fieldShow as $field):?>
							<td><?=$f->$field?></td>
						<?php endforeach; ?>
						<td>
							<?php if($flag['u']):?>
								<!--<a href="#" onClick="loadPage('<?=base_url()?>hojaruta_controller/edit_c/<?=$f->hojaruta_id?>','right-content')" id="icon-edit">Modificar</a>-->
								<a href="#" onClick="dialogUp('content_detail_modal',600,700,'<?=base_url()?>hojaruta_controller/showFormEvaluar_c/<?=$f->hojaruta_id?>','Evaluaci&oacute;n  de Hoja de Ruta: <?=$f->hojaruta_id?>')" id="icon-evaluar">Evaluar</a>
							<?php endif;?>
						</td>
					</tr>
				<?php else: ?>
					<tr class="markrow4">
						<td><input type="checkbox" name="chkHojaRuta" class="chkLote" value="<?=$f->hojaruta_id?>"></td>
						<?php foreach($fieldShow as $field):?>
							<td><?=$f->$field?></td>
						<?php endforeach; ?>
						<td>
							<?php if($flag['r']):?>
								<a href="#" onClick="dialogUp('content_detail_modal',650,700,'<?=base_url()?>hojaruta_controller/show_c/<?=$f->hojaruta_id?>','Hoja de Ruta: <?=$f->hojaruta_id?>')" id="icon-ver">Ver</a>
							<?php endif;?>
						</td>
					</tr>
				<?php endif;  ?>	
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
		setPagination('<?=base_url()?>hojaruta_controller/search_c','result-list');
		selectAllChks('chkAll','chkHojaRuta');
	});
</script>