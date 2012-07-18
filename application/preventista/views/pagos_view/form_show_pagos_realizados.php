<div id="form-search">
	<form action="" method="post" name="formPagosRealizados" id="formPagosRealizados">
		<?php if(count($pagosrealizados) > 0): ?>
				<div id="lineascampos-modal">
					<table id="result-set">
						<thead>
							<tr>
								<th>Fecha</th>			
								<th>Monto</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($pagosrealizados as $f): ?>
								<tr>
									<td><?=$f->pagos_created_at?></td>
									<td>$&nbsp;<?=$f->pagos_monto?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
		<?php else: ?>
			<p>No existen pagos realizados</p>
		<?php endif; ?>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
	});
</script>