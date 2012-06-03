<?php if($this->session->flashdata('flashConfirm')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashConfirm')."',1)</script>";?>
<?php if($this->session->flashdata('flashError')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashError')."',2)</script>";?>
<div id="controller-panel">
	<div id="controller-panel-left">
		<div id="title-level2"><?=$subtitle?></div>
	</div>
	<div id="controller-panel-right">
		<div id="controller-botonera">
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/utilidades_controller/search_c" method="post" name="formSearchUtilidades" id="formSearchUtilidades">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("utilidades_view/_search")?>
	</fieldset>
	</form>
</div>