<div id="result-list">
	<?php if(isset($clientes) && is_array($clientes) && count($clientes)>0):?>
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
				<?php foreach($clientes as $f):?>
					<tr>
						<?php foreach($fieldShow as $field):?>
						<td><?=$f->$field?></td>
						<?php endforeach; ?>
						<td>
							<?php if($flag['r']):?>
								<a href="#" onClick="showModalCC('content_detail_modal',530,500, '<?=base_url()?>index.php/clientes_controller/showFormCC_c/<?=$f->clientes_id?>', 'Cuenta Corriente de: <?=$f->clientes_apellido." ".$f->clientes_nombre?>')" id="icon-cc" title="Detalle de Cuenta Corriente">CC</a>
							<?php endif;?>
							<?php if($flag['u']):?>
								<a href="#" onClick="loadPage('<?=base_url()?>index.php/clientes_controller/edit_c/<?=$f->clientes_id?>','right-content')" id="icon-edit">Modificar</a>
							<?php endif;?>
							<?php if($flag['d']):?>
								<a href="#" onClick="deleteData('<?=base_url()?>index.php/clientes_controller/delete_c/<?=$f->clientes_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a>
							<?php endif;?>
						</td>
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


<script type="text/javascript">
$(document).ready(function() {
	setPaginationTwo('<?=base_url()?>clientes_controller/search_c','result-list','formSearchclientes'); 
});
</script>
