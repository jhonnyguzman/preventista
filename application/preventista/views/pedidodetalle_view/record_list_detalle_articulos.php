
	<table class="result-set" id="tbDetalleArticulos">
		<thead>
			<tr>
				<th>Articulo</th>
				<th>Cantidad</th>	
			</tr>
		</thead>
		<tbody>
			<?php foreach($detallearticulos as $f): ?>
				<tr>
					<td><?=$f->articulos_descripcion?></td>
					<td><?=$f->cantidadpedido?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
