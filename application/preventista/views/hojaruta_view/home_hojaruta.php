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
					<li><a href="#" onClick="getModalWindowAdvancedTwo('content_detail_modal5','<?=base_url()?>hojaruta_controller/showPrintSeleccion_c/',380,180,'chkHojaRuta','<?=base_url()?>hojaruta_controller/index')"  id="icon-print">Imprimir</a></li>
					<li><a href="#" onClick="getModalWindowAdvancedTwo('content_detail_modal','<?=base_url()?>hojaruta_controller/showDetalleArt_c/',500,600,'chkHojaRuta','','Detalle de Articulos')" >&nbsp;|&nbsp; Detalle de Articulos</a></li>

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
<div id="content_detail_modal5" title='Imprimir Hojas de Ruta'></div>
