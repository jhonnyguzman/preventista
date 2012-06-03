<div class="header-print">
	<table class="tb-header-print">
		<tr>
			<td>Roja Ruta:&nbsp;<?=$hojaruta->hojaruta_id?></td>
			<td></td>
		</tr>
		<tr>
			<td>Fletero:&nbsp;<?=$hojaruta->fleteros_apellnom?></td>
			<td class='today-date-print2'>Fecha:&nbsp;<?=$todayDate?></td>
		</tr>
	</table>
</div>
<div id="result-list">
	<?php if(isset($hojarutadetalle) && is_array($hojarutadetalle) && count($hojarutadetalle)>0):?>
		<table class="tb-result-set-print">
			<thead>
				<tr>
					<th>Cliente</th>
					<th>Tram.</th>
					<th>Imp.</th>	
					<th>Monto recibido</th>
					<th>Recibo</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($hojarutadetalle as $f):?>
					<tr>
						<td><?=$f->clientes_apellido." ".$f->clientes_nombre?><br><?=$f->clientes_direccion?></td>
						<td><?=$f->tramites_descripcion?></td>
						<td><?=$f->peididos_montototal?></td>
						<td>____________</td>
						<td>____________</td>
					</tr>
				<?php  endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>No results!</p>
	<?php endif; ?>
</div>
<?=$this->load->view("default_view/_style_to_print")?>