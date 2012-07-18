<table class="tb-result-set-print-recibos">
	<?php for($i=$nro_from; $i < $nro_to; $i++):?>
		<tr>
			<td><strong>Recibo N&#176;:&nbsp;</strong></td>
			<td><?=$i?></td>
			<td>&nbsp;</td>
			<td class="alignRight"><strong>Fecha:&nbsp;</strong>___/___/_____</td>
		</tr>
		<!--<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>-->
		<tr>
			<td><strong>Recib&iacute; de:</strong></td>
			<td class="markRowRecibos">&nbsp;</td>
			<td class="markRowRecibos">&nbsp;</td>
			<td class="markRowRecibos">&nbsp;</td>
		</tr>
		<!--<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>-->
		<tr>
			<td><strong>La suma de:&nbsp;</strong></td>
			<td class="markRowRecibos">&nbsp;</td>
			<td class="markRowRecibos">&nbsp;</td>
			<td class="alignRight">En concepto de pago de deuda.</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="alignRight"><strong>Firma:</strong></td>
			<td class="markRowRecibos"></td>
		</tr>
		<tr>
			<td class="markRowRecibos2">&nbsp;</td>
			<td class="markRowRecibos2">&nbsp;</td>
			<td class="markRowRecibos2">&nbsp;</td>
			<td class="markRowRecibos2">&nbsp;</td>
		</tr>
	<?php endfor;  ?>
</table>
<?=$this->load->view("default_view/_style_to_print")?>