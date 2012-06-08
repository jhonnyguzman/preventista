<div id="form-search">
	<form action="<?=base_url()?>hojaruta_controller/evaluar_c" method="post" name="formEvaluacionHojaRuta" id="formEvaluacionHojaRuta">
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
								<td><input type="checkbox" name="chkEvaluacionHojaRuta[]" value="<?=$f->pedidos_id?>" checked></td>
								<input type="hidden" name="pedidos_id[]" value="<?=$f->pedidos_id?>"/>
								<input type="hidden" name="hojarutadetalle_id[]" value="<?=$f->hojarutadetalle_id?>"/>
								<td><?=$f->pedidos_id?></td>
								<td><?=$f->tramites_descripcion?></td>
								<td><?=$f->clientes_apellido." ".$f->clientes_nombre?></td>
								<td><?=$f->peididos_montototal?></td>
								<td><input name="monto_recibido[]" id="monto_recibido"/></td>
							</tr>
						<?php  endforeach; ?>
						</tbody>
					</table>
				</div>
		<?php endif; ?>
		<div class="botonera">
			<input type="submit" name="Registrar" value="Registrar" class="crudtest-button" onClick="submitData3('formEvaluacionHojaRuta','content_detail_modal1',500,400,'Resultado')"/>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		//selectAllChks('chkAll','chkEvaluacionHojaRuta');
	});
</script>
