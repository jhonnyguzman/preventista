<div class="header-print">
	<table class="tb-header-print">
		<tr>
			<td><div class="title-print"><?=$title?></div></td>
			<td class="today-date-print">Fecha:&nbsp;<?=$todayDate?></td>
		</tr>
	</table>
</div>
<div id="result-list">
	<?php if(isset($articulos) && is_array($articulos) && count($articulos)>0):?>
		<table class="tb-result-set-print">
			<thead>
				<tr>
					<?php foreach($fieldstoprint as $field):?>
					<th><?=$this->config->item($field)?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($articulos as $f):?>
					<tr>
						<?php foreach($fieldstoprint as $field):?>
							<td><?=$f->$field?></td>
						<?php endforeach; ?>
					</tr>
				<?php  endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>No results!</p>
	<?php endif; ?>
</div>
<?=$this->load->view("default_view/_style_to_print")?>