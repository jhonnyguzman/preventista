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
					<li><a href="#" onClick="getModalWindowAdvancedTwo('content_detail_modal','<?=base_url()?>hojaruta_controller/showPrintSeleccion_c/',380,180,'chkHojaRuta','<?=base_url()?>remitos_controller/index')">Imprimir</a></li>
					<li><a href="#" onClick="loadPage('<?=base_url()?>index.php/hojaruta_controller/add_c','right-content')" id="icon-new" title='Nuevo'>Nuevo</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/hojaruta_controller/search_c" method="post" name="formSearchhojaruta" id="formSearchhojaruta">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("hojaruta_view/_search")?>
	</fieldset>
	</form>
</div>
<div id="content_detail_modal" title='Imprimir Hojas de Ruta'></div>