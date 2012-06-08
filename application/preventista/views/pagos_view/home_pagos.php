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
					<li><a href="#" onClick="getModalWindow('<?=base_url()?>pagos_controller/add_c/','Generar pagos',380,180)" id="icon-new" title='Generar pagos en blanco'>Generar pagos</a></li>
				<?php endif; ?>
				<?php if($flag['u']):?>
					<li><a href="#" onClick="dialogUp('content_detail_modal',300,300,'<?=base_url()?>index.php/pagos_controller/in_c','Ingreso de pago')" >Ingresar pagos</a></li>
				<?php endif; ?>
			</lu>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/pagos_controller/search_c" method="post" name="formSearchpagos" id="formSearchpagos">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("pagos_view/_search.php")?>
	</fieldset>
	</form>
</div>

<div id="content_detail_modal"></div>
