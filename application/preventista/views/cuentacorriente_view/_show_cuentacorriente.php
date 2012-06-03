<script type="text/javascript">
	$(document).ready(function() {
		$( "#tabs" ).tabs({
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"No se puede cargar el contenido de esta secci&oacute;n. " +
						"Intente de nuevo" );
				}
			}
		});
	});
</script>
<div id="tabs">
	<ul>
		<li><a href="<?=base_url()?>index.php/cuentacorriente_controller/show_c/<?=$clientes_id?>">General</a></li>
		<li><a href="<?=base_url()?>index.php/cuentacorriente_controller/showPedidosPagados_c/<?=$clientes_id?>">Pedidos Pagados</a></li>
		<li><a href="<?=base_url()?>index.php/cuentacorriente_controller/showPedidosAdeudados_c/<?=$clientes_id?>">Pedidos Adeudados</a></li>
	</ul>
</div>
