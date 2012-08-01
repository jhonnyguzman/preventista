<div class="header-print">
	<table class="tb-header-print">
		<tr>
			<td><div class="title-print"><?=$title?></div></td>
			<td></td>
		</tr>
	</table>
</div>
<div id="result-list">
	<?php if(isset($detallearticulos) && is_array($detallearticulos) && count($detallearticulos)>0):?>
		<table class="tb-result-set-print">
			<thead>
				<tr>
					<th>Articulo</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detallearticulos as $f):?>
					<tr>
						<td><?=$f->articulos_descripcion?></td>
						<td><?=$f->cantidadpedido?></td>
					</tr>
				<?php  endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>No results!</p>
	<?php endif; ?>
</div>
<?=$this->load->view("default_view/_style_to_print")?>