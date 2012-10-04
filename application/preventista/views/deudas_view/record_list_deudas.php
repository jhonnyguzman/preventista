<script type="text/javascript">
	$(document).ready(function(){ setPagination('<?=base_url()?>deudas_controller/search_c','result-list'); });
</script>
<div id="result-list">
	<?php if(isset($deudas) && is_array($deudas) && count($deudas)>0):?>
		<table id="result-set">
			<thead>
				<tr>
					<th>Id</th>
					<th>Cliente</th>
					<th>Fecha</th>
					<th>Monto Total</th>
					<th>Monto Adeudado</th>
					<th>Estado</th>
					<th>Usuario</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbdoy>
				<?php foreach($deudas as $f):?>
					<tr>
						<td><?=$f->deudas_id?></td>
						<td><?=$f->clientes_apellido.' '.$f->clientes_nombre?></td>
						<td><?=$f->deudas_fecha?></td>
						<td>$&nbsp;<?=$f->deudas_montototal?></td>
						<td>$&nbsp;<?=$f->deudas_montoadeudado?></td>
						<td><?=$f->deudas_estado_descripcion?></td>
						<td><?=$f->usuarios_username?></td>
						<?php if($flag['u']):?>
							<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/deudas_controller/edit_c/<?=$f->deudas_id?>','right-content')" id="icon-edit">Modificar</a></td>
						<?php endif;?>
						<?php if($flag['d']):?>
							<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/deudas_controller/delete_c/<?=$f->deudas_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
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
