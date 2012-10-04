<script type="text/javascript">
	$(document).ready(function(){ setPagination('<?=base_url()?>pagos_controller/search_c','result-list'); });
</script>
<div id="result-list">
	<?php if(isset($pagos) && is_array($pagos) && count($pagos)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<th>Id</th>
					<th>Cliente</th>
					<th>Monto</th>
					<th>Usuario</th>
					<th>Fecha de alta</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pagos as $f):?>
					<tr>
						<td><?=$f->pagos_id?></td>
						<td><?=$f->clientes_apellido.' '.$f->clientes_nombre?></td>
						<td>$&nbsp;<?=$f->pagos_monto?></td>
						<td><?=$f->usuarios_username?></td>
						<td><?=$f->pagos_created_at?></td>
						<?php if($flag['d']):?>
							<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/pagos_controller/delete_c/<?=$f->pagos_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
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
