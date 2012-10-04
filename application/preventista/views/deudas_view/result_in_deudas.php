<?php if($status): ?>
	<div class="success_modal">
		<p>El deuda ha sido cargada correctamente!</p>
	</div>
<?php else: ?>
	<div class="error_modal">
		<p>Hubo un error al cargar la deuda! Vuelva a intentar.</p>
	</div>
<?php endif; ?>

<input type="button" value="Aceptar" id="btnAceptar"/>


<script type="text/javascript">
	$(document).ready(function() {
		$("#btnAceptar").click(function(){
			$("#content_detail_modal").dialog("close");
			loadPage('<?=base_url()?>deudas_controller/index','right-content');
		});
	});
</script>