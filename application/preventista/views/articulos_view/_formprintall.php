<div id="fieldstoprint_all" title="Seleccione campos a imprimir">
	<form action="<?=base_url()?>articulos_controller/printall_c" method="post" name="formPrintAllArticulos" id="formPrintAllArticulos">
		<?=$this->load->view("articulos_view/_fieldstoprint")?>
		<input type="submit" value="Imprimir" />
	</form>
</div>