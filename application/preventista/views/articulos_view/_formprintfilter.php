<div id="fieldstoprint_filter" title="Seleccione campos a imprimir">
	<form action="<?=base_url()?>articulos_controller/printfilter_c" method="post" name="formPrintFilterArticulos" id="formPrintFilterArticulos">
		<?=$this->load->view("articulos_view/_fieldstoprint")?>
		<input type="hidden" name="articulos_descripcion_f" id="articulos_descripcion_f">
		<input type="hidden" name="rubros_id_f" id="rubros_id_f">
		<input type="hidden" name="marcas_id_f" id="marcas_id_f">
		<input type="submit" value="Imprimir" />
	</form>
</div>

<script>
	$(document).ready(function(){ 
		$("#articulos_descripcion_f").val($(".searchShort input[name=articulos_descripcion]").val());
		$("#rubros_id_f").val($(".searchShort select[name=rubros_id]").val());
		$("#marcas_id_f").val(getOneMarcaToSearch());
	});
</script>
