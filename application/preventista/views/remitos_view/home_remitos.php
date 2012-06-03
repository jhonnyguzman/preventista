<?php if($this->session->flashdata('flashConfirm')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashConfirm')."',1)</script>";?>
<?php if($this->session->flashdata('flashError')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashError')."',2)</script>";?>
<div id="controller-panel">
	<div id="controller-panel-left">
		<div id="title-level2"><?=$subtitle?></div>
	</div>
	<div id="controller-panel-right">
		<div id="controller-botonera">
			<ul id="menu_sist">
				<?php if($flag['i']):?>
					<li><a href="#" onClick="getModalWindowAdvancedOne('<?=base_url()?>remitos_controller/showPrintComprobanteSeleccion_c/','Imprimir comprobantes',380,180,'chkRemitos')"  title='Imprimir Comprobantes'>Imprimir comprobantes</a></li>
					<li><a href="#" onClick="loadPage('<?=base_url()?>index.php/remitos_controller/add_c','right-content')" id="icon-new" title='Nuevo'>Nuevo</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/remitos_controller/search_c" method="post" name="formSearchremitos" id="formSearchremitos">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("remitos_view/_search")?>
	</fieldset>
	</form>
</div>
