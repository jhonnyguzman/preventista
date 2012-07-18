<form action="<?=base_url()?>pedidos_controller/searchDetalleArt_c" method="post" name="formSearchDetalleArt" id="formSearchDetalleArt">
	<span><strong>Fecha:</strong></span>
	<input type="text" name="fechaDetalleArticulo" id="fechaDetalleArticulo" value="<?=$fechaActual?>">
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
			   window.open("<?=base_url()?>pedidos_controller/printDetalleArt2_c/" + $("#fechaDetalleArticulo").val(),'_blank');
			}else{
				alert("No hay articulos!");
			}
			 return false;
		});
	});
</script>