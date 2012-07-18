<p><strong>Estado Remitos:</strong></p>
<?php foreach($remitos_status as $f): ?>
	<p>&nbsp;&nbsp;-&nbsp;<?=$f?></p>
<?php endforeach;?>
<p><strong>Estado Pedidos:</strong></p>
<?php foreach($pedidos_status as $f): ?>
	<p>&nbsp;&nbsp;-&nbsp;<?=$f?></p>
<?php endforeach;?>
<p><strong>Estado Hoja de ruta:</strong></p>
<p>&nbsp;&nbsp;-&nbsp;<?=$hojaruta_status?></p>


<input type="button" value="Cerrar" id="btnAceptar"/>


<script type="text/javascript">
	$(document).ready(function() {
		$("#btnAceptar").click(function(){
			$("#content_detail_modal").dialog("close");
			loadPage('<?=base_url()?>hojaruta_controller/index','right-content');
		});
	});
</script>