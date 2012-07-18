<script type="text/javascript">
	$(document).ready(function() {
		getTabs("tabCC");
	});
</script>
<div id="tabCC">
	<ul>
		<li><a href="<?=base_url()?>cuentacorriente_controller/show_c/<?=$clientes_id?>">General</a></li>
		<li><a href="<?=base_url()?>cuentacorriente_controller/showPedidosPagados_c/<?=$clientes_id?>">Pedidos Pagados</a></li>
		<li><a href="<?=base_url()?>cuentacorriente_controller/showPedidosAdeudados_c/<?=$clientes_id?>">Pedidos Adeudados</a></li>
		<li><a href="<?=base_url()?>pagos_controller/showPagosRealizados_c/<?=$clientes_id?>">Pagos realizados</a></li>
	</ul>
</div>
