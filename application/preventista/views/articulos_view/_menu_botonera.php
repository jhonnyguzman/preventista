<ul id="menu_sist">
	<?php if($flag['u']):?>
		<li>
			<a href="#" onClick="getModalWindowAdvancedOne('<?=base_url()?>articulos_controller/showFormEditGeneral_c/','Actualizar Precios',380,200,'chkArticulos')" id="icon-edit">Editar selecci&oacute;n</a>
		</li>
	<?php endif; ?>
	<?php if($flag['i']):?>
			<li>
				<a href="#" onClick="loadPage('<?=base_url()?>index.php/articulos_controller/add_c','right-content')" id="icon-new" title='Nuevo'>Nuevo</a>
			</li>
	<?php endif; ?>

	<li><a href="#" onClick="dialogUp('content_detail_modal',300,300,'<?=base_url()?>articulos_controller/showStockDinero_c','Stock en Dinero')" id="icon-stock_dinero">Ver stock en Dinero</a></li>
</ul>