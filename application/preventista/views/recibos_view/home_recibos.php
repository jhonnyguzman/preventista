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
					<li><a href="#" onClick="getModalWindow('<?=base_url()?>recibos_controller/add_c/','Generar recibos',380,180)" id="icon-new" title='Generar recibos en blanco'>Generar Recibos</a></li>
				<?php endif; ?>
				<?php if($flag['u']):?>
					<li><a href="#" onClick="dialogUp('content_detail_modal',300,300,'<?=base_url()?>index.php/recibos_controller/in_c','Ingreso de recibo')" >Ingresar Recibos</a></li>
				<?php endif; ?>
			</lu>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/recibos_controller/search_c" method="post" name="formSearchrecibos" id="formSearchrecibos">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("recibos_view/_search.php")?>
	</fieldset>
	</form>
</div>

<div id="content_detail_modal"></div>
