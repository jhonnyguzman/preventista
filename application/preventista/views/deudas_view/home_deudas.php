<?php if($this->session->flashdata('flashConfirm')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashConfirm')."',1)</script>";?>
<?php if($this->session->flashdata('flashError')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashError')."',2)</script>";?>
<div id="controller-panel">
	<div id="controller-panel-left">
		<div id="title-level2"><?=$subtitle?></div>
	</div>
	<div id="controller-panel-right">
		<div id="controller-botonera">
			<ul id="menu_sist">
				<?php if($flag['u']):?>
					<li><a href="#" onClick="dialogUp('content_detail_modal',300,300,'<?=base_url()?>deudas_controller/add_c','Ingreso de Deuda')" id="icon-deudas">Ingresar Deuda</a></li>
				<?php endif; ?>
			</lu>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>deudas_controller/search_c" method="post" name="formSearchdeudas" id="formSearchdeudas">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("deudas_view/_search.php")?>
	</fieldset>
	</form>
</div>

