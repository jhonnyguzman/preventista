<form action="<?=base_url()?>hojaruta_controller/searchDetalleArt_c/" method="post" name="formSearchDetalleArt" id="formSearchDetalleArt">
	<span><strong>Fecha:</strong></span>
	<input type="text" name="fechaDetalleArticulo" id="fechaDetalleArticulo" value="<?=$fechaActual?>">
	<?php foreach($arrKeys as $f): ?>
		<input type="hidden" name="hojaruta_ids[]" id="hojaruta_ids" value="<?=$f?>" class="hojaruta_ids">
	<?php endforeach; ?>
	<input type="submit" value="Ver" onClick="submitData('formSearchDetalleArt',new Array('resultDetalleArt','resultDetalleArt'))">
	<input type="button" value="Imprimir" id="btnImprimirDetalleArticulos">
</form>
<div id="resultDetalleArt"></div>

<script type="text/javascript">
	$(document).ready(function() {
		submitData2('formSearchDetalleArt',new Array('resultDetalleArt','resultDetalleArt'));
		setDatePicker(new Array('fechaDetalleArticulo'));
		$("#fechaDetalleArticulo").change(function(){
			submitData2('formSearchDetalleArt',new Array('resultDetalleArt','resultDetalleArt'));
		});

		$("#btnImprimirDetalleArticulos").click(function(){
			if ($('#tbDetalleArticulos >tbody >tr').length > 0){
				var list = new Array();
				$.each($(".hojaruta_ids"), function() {
			      list.push($(this).val());
			   	});
			    window.open("<?=base_url()?>hojaruta_controller/printDetalleArt2_c/" + $("#fechaDetalleArticulo").val() + "/" + list,'_blank');
			}else{
				alert("No hay articulos!");
			}
			 return false;
		});
	});
</script>