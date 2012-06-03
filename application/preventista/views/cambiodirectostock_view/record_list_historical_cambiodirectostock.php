<?php if(isset($cambiodirectostock) && is_array($cambiodirectostock) && count($cambiodirectostock)>0):?>
	<table id="result-set-modal">
		<thead>
			<tr>
				<!--<th><?=$this->config->item("cambiodirectostock_id")?></th>-->
				<th><?=$this->config->item("articulos_descripcion")?></th>
				<th><?=$this->config->item("cambiodirectostock_stockantiguo")?></th>
				<th><?=$this->config->item("cambiodirectostock_stocknuevo")?></th>
				<th><?=$this->config->item("cambiodirectostock_comentario")?></th>
				<th><?=$this->config->item("usuarios_username")?></th>
				<th><?=$this->config->item("cambiodirectostock_created_at")?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($cambiodirectostock as $f):?>
				<tr>
					<!--<td><?=$f->cambiodirectostock_id?></td>-->
					<td><?=$f->articulos_descripcion?></td>
					<td><?=$f->cambiodirectostock_stockantiguo?></td>
					<td><?=$f->cambiodirectostock_stocknuevo?></td>
					<td><?=$f->cambiodirectostock_comentario?></td>
					<td><?=$f->usuarios_username?></td>
					<td><?=$f->cambiodirectostock_created_at?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p>No results!</p>
<?php endif; ?>

<script>
	//$(document).ready(function(){ setPagination('<?=base_url()?>cambiodirectostock_controller/getHistoricalChg_c','historicalChgs'); });
</script>