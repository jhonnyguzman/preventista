<?php if($status): ?>
	<div class="success_modal">
		<p>El recibo <strong><?=$recibo['pagos_id']?></strong> se ha cargado correctamente!</p>
		<p>Se actualiz&oacute; el estado de la cuenta corriente del cliente</p>
	</div>
<?php else: ?>
	<div class="error_modal">
		<p>El recibo <strong><?=$recibo['pagos_id']?></strong> no se ha cargado! Vuelva a intentar.</p>
		<p>Nose pudo actualizar el estado de la cuenta corriente del cliente</p>
	</div>
<?php endif; ?>

<input type="button" value="Aceptar" id="btnAceptar"/>


<script type="text/javascript">
	$(document).ready(function() {
		$("#btnAceptar").click(function(){
			$("#content_detail_modal").dialog("close");
			loadPage('<?=base_url()?>index.php/pagos_controller/index','right-content');
		});
	});
</script>