<?php if($this->session->flashdata('flashConfirm')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashConfirm')."',1)</script>";?>
<?php if($this->session->flashdata('flashError')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashError')."',2)</script>";?>
<div id="controller-panel">
	<div id="controller-panel-left">
		<div id="title-level2"><?=$subtitle?></div>
	</div>
	<div id="controller-panel-right">
		<div id="controller-botonera">
			<a href="#" onClick="dialogUp('content_detail_modal',500,600,'<?=base_url()?>pedidos_controller/showDetalleArt_c','Detalle de Articulos')" >Detalle de Articulos</a>&nbsp;|&nbsp;
			<a href="#" onClick="getModalWindowAdvancedOne('<?=base_url()?>hojaruta_controller/add_c/','Nueva Hoja de Ruta',400,400,'chkPedidos')" >Nueva Hoja de Ruta</a>&nbsp;|&nbsp;
			<?php if($flag['i']):?>
				<a href="#" onClick="loadPage('<?=base_url()?>index.php/pedidos_controller/add_c','right-content')" id="icon-new" title='Nuevo'>Nuevo</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/pedidos_controller/search_c" method="post" name="formSearchpedidos" id="formSearchpedidos">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("pedidos_view/_search")?>
	</fieldset>
	</form>
</div>
