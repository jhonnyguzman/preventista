<div id="result-list">
	<?php if(isset($articulos) && is_array($articulos) && count($articulos)>0):?>
	<table id="result-set">
		<thead>
			<tr>
				<th><input type="checkbox" name="chkAll" class="chkAll"></th>
				<?php foreach($fieldShow as $field):?>
				<th><?=$this->config->item($field)?></th>
				<?php endforeach; ?>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $i= 0; foreach($articulos as $f):?>
				<tr id="<?=$f->articulos_id?>">
					<td><input type="checkbox" name="chkArticulos" class="chkLote" value="<?=$f->articulos_id?>"></td>
					<td><?=$f->articulos_id?></td>
					<td><?=$f->articulos_descripcion?></td>
					<td><span><?=$f->rubros_descripcion?></span></td>
					<td><span><?=$f->marcas_descripcion?></span></td>
					<td><span class="spmark">$&nbsp;</span><input type="text" name="articulos_preciocompra-<?=$i?>" id="articulos_preciocompra-<?=$i?>" value="<?=$f->articulos_preciocompra?>" 
						onChange="check(<?=$f->articulos_id?>); calcPrice(<?=$i?>,'articulos_preciocompra');" style="width: 45px;" /></td>
					<td><input type="text" name="articulos_stockreal-<?=$i?>" id="articulos_stockreal-<?=$i?>" value="<?=$f->articulos_stockreal?>" 
						onChange="check(<?=$f->articulos_id?>); setComment(<?=$i?>)" style="width: 45px;" />
						<a href="#" onclick="getHistoricChgDirect('<?=base_url()?>index.php/cambiodirectostock_controller/getHistoricalChg_c/<?=$f->articulos_id?>')">H</a>
						<input type="hidden" name="articulos_stockrealviejo-<?=$i?>" id="articulos_stockrealviejo-<?=$i?>" value="<?=$f->articulos_stockreal?>"/>
						<input type="hidden" name="chdirect_comment-<?=$i?>" id="chdirect_comment-<?=$i?>" value="F"/> <!-- F no hizo cambios -->
					</td>
					<td><span class="spmark">$&nbsp;</span><input type="text" name="articulos_precio1-<?=$i?>" id="articulos_precio1-<?=$i?>" value="<?=$f->articulos_precio1?>" 
						onChange="check(<?=$f->articulos_id?>); calcPriceAdvanced(<?=$i?>,'articulos_precio1','articulos_precio2','articulos_precio3','articulos_porcentaje1','articulos_porcentaje2','articulos_porcentaje3');" style="width: 45px;"/></td>
					<td><span class="spmark">$&nbsp;</span><input type="text" name="articulos_precio2-<?=$i?>" id="articulos_precio2-<?=$i?>" value="<?=$f->articulos_precio2?>" 
						onChange="check(<?=$f->articulos_id?>); calcPriceAdvanced(<?=$i?>,'articulos_precio2','articulos_precio1','articulos_precio3','articulos_porcentaje2','articulos_porcentaje1','articulos_porcentaje3');" style="width: 45px;"/></td>
					<td><span class="spmark">$&nbsp;</span><input type="text" name="articulos_precio3-<?=$i?>" id="articulos_precio3-<?=$i?>" value="<?=$f->articulos_precio3?>" 
						onChange="check(<?=$f->articulos_id?>); calcPriceAdvanced(<?=$i?>,'articulos_precio3','articulos_precio1','articulos_precio2','articulos_porcentaje3','articulos_porcentaje1','articulos_porcentaje2');" style="width: 45px;"/></td>
					<td><input type="text" name="articulos_porcentaje1-<?=$i?>" id="articulos_porcentaje1-<?=$i?>" value="<?=$f->articulos_porcentaje1?>"
						onChange="check(<?=$f->articulos_id?>); calcPrice(<?=$i?>,'articulos_porcentaje1');" style="width: 45px;"/></td>
					<td><input type="text" name="articulos_porcentaje2-<?=$i?>" id="articulos_porcentaje2-<?=$i?>" value="<?=$f->articulos_porcentaje2?>"
						onChange="check(<?=$f->articulos_id?>); calcPrice(<?=$i?>,'articulos_porcentaje2');" style="width: 45px;"/></td>
					<td><input type="text" name="articulos_porcentaje3-<?=$i?>" id="articulos_porcentaje3-<?=$i?>" value="<?=$f->articulos_porcentaje3?>"
						onChange="check(<?=$f->articulos_id?>); calcPrice(<?=$i?>,'articulos_porcentaje3');" style="width: 45px;"/></td>
					<?php if($flag['u']):?>
						<td><a href="#" onClick="loadPage('<?=base_url()?>index.php/articulos_controller/edit_c/<?=$f->articulos_id?>','right-content')" id="icon-edit">Modificar</a></td>
					<?php endif;?>
					<?php if($flag['d']):?>
						<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/articulos_controller/delete_c/<?=$f->articulos_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a></td>
					<?php endif;?>
				</tr>
			<?php $i++; endforeach; ?>
		</tbody>
	</table><br>
	<div class="footer-content">
		<?php if(isset($pagination)):?>
			<div class='pagination'>
				<?=$pagination?>
			</div>
		<?php endif; ?>
		<ul id="menu_footer_content">
			<li><a href="#" onClick="updateParcial('chkArticulos','<?=base_url()?>articulos_controller/updateparcial_c')" id="icon-update">Registrar cambios</a></li>
			<li><a href="#" id="icon-print">Imprimir</a>
				<ul>
					<li><a href="#" onClick="dialogUp('fieldstoprint_all',430,250)">Todo</a></li>
					<li><a href="#" onClick="dialogUp('fieldstoprint_filter',430,250)">Filtrado</a></li>
				</ul>
			</li>
		</ul>
		<?php else: ?>
			<p>No results!</p>
		<?php endif; ?>
	</div>
</div>

<?=$this->load->view("articulos_view/_formprintall")?>
<?=$this->load->view("articulos_view/_formprintfilter")?>
<div id="historicalChgs" title="Historial de cambios directos"></div>

<script type="text/javascript">
	$(document).ready(function(){ 
		// setTimeToRun();
		setPaginationTwo('<?=base_url()?>articulos_controller/search_c','result-list','formSearcharticulos'); 
		selectAllChks('chkAll','chkArticulos');

		var tabindex = 1;
	    $('#result-set tbody tr td input[type=text]').each(function() {
	        if (this.type != "hidden") {
	            var input = $(this);
	            input.attr("tabindex", tabindex);
	            tabindex++;
	        }
	    });

	    $('#result-set tbody tr td input[type=text]').change(function(){
	    	if(this.value == this.defaultValue) $(this).css("background-color","#FFFFFF");
	    	else $(this).css("background-color","#FFFF33");
	    	//setTimeToRun('<?=base_url()?>articulos_controller/updateparcial_c');
	    });
	});
</script>

