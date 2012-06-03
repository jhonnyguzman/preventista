<?php if($error_message): ?>
	<div class="error"><?=$error_message?></div>
<?php else: ?>
	<div class="alert"><?=$this->config->item("hojaruta_flash_print_message")?></div>
	<form action="<?=base_url()?>hojaruta_controller/printSeleccion_c" method="post" name="formPrintHojaRuta" id="formPrintHojaRuta">
		<?php foreach($arrKeys as $f): ?>
			<input type="hidden" name="hojaruta_ids[]" id="hojaruta_ids" value="<?=$f?>">
		<?php endforeach; ?>
		<input type="submit" name="aceptar" value="Aceptar"/>
	</form>
<?php endif; ?>
