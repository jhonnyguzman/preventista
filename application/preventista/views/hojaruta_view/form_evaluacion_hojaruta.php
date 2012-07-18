	
		<?php if(count($hojarutadetalle) > 0): ?>
				<div id="lineascampos-modal">
					<input type="hidden" name="hojaruta_id" value="<?=$hojaruta_id?>"/>
					<table id="result-set">
						<thead>
						<tr>
							<th>¿Entregado?</th>			
							<th>Pedido Id</th>
							<th>Tr&aacute;mite</th>
							<th>Cliente</th>
							<th>Monto total</th>
							<th>Monto Recibido</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($hojarutadetalle as $f): ?>
							<tr>
								<td>
									<input type="checkbox" name="chkEvaluacionHojaRuta[]" id="chkEvaluacionHojaRuta" value="<?=$f->pedidos_id?>" checked />
									<input type="hidden" name="peididos_montotoal" value="<?=$f->peididos_montototal?>"/>
								</td>
								<input type="hidden" name="pedidos_id[]" value="<?=$f->pedidos_id?>"/>
								<input type="hidden" name="hojarutadetalle_id[]" value="<?=$f->hojarutadetalle_id?>"/>
								<td><?=$f->pedidos_id?></td>
								<td><?=$f->tramites_descripcion?></td>
								<td><?=$f->clientes_apellido." ".$f->clientes_nombre?></td>
								<td><?=$f->peididos_montototal?></td>
								<td><input name="monto_recibido[]" id="monto_recibido" onBlur="calcTotalEvaluacion()"/></td>
							</tr>
						<?php  endforeach; ?>
						</tbody>
					</table>
				</div>
		<?php endif; ?>
		


<script type="text/javascript">
	$(document).ready(function(){ 
		//selectAllChks('chkAll','chkEvaluacionHojaRuta');
		
	});
</script>
