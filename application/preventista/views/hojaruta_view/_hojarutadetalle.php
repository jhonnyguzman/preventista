<table id="result-set">
	<thead>
		<tr>
			<th>Pedido Id</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($arrKeys as $f): ?>
		<tr>
			<td><input type="text" name="pedidos_id[]" id="pedidos_id" value="<?=$f?>" readonly="true" class="markInputModal"></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>