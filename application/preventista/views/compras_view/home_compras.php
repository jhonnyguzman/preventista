<?php if($this->session->flashdata('flashConfirm')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashConfirm')."',1)</script>";?>
<?php if($this->session->flashdata('flashError')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashError')."',2)</script>";?>
<div id="controller-panel">
	<div id="controller-panel-left">
		<div id="title-level2"><?=$subtitle?></div>
	</div>
	<div id="controller-panel-right">
		<div id="controller-botonera">
		<?php if(!$flag['i']):?>
			<div class='block-item2'><a href="#" id="icon-new" title='Nuevo'>Nuevo</a><div class='mask-item2'></div></div>
		<?php else: ?>
			<a href="#" onClick="loadPage('<?=base_url()?>index.php/compras_controller/add_c','right-content')" id="icon-new" title='Nuevo'>Nuevo</a>
		<?php endif; ?>
		</div>
	</div>
</div>
<div id="form-search">
	<div class="form-search-left">
		<form action="<?=base_url()?>index.php/compras_controller/search_c" method="post" name="formSearchcompras" id="formSearchcompras">
		<fieldset>
			<legend>Filtrar por compras:</legend>
			<?=$this->load->view("compras_view/_search")?>
		</fieldset>
		</form>
	</div>
	<div class="form-search-right">
		<form action="<?=base_url()?>index.php/comprasdetalle_controller/searchByArticulo_c" method="post" name="formSearchByArticulo" id="formSearchByArticulo">
		<fieldset>
			<legend>Filtrar por articulos:</legend>
			<?=$this->load->view("compras_view/_search_by_articulo")?>
		</fieldset>
		</form>
	</div>
</div>
