<?php if($this->session->flashdata('flashConfirm')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashConfirm')."',1)</script>";?>
<?php if($this->session->flashdata('flashError')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashError')."',2)</script>";?>
<div id="controller-panel">
	<div id="controller-panel-left">
		<div id="title-level2"><?=$subtitle?></div>
	</div>
	<div id="controller-panel-right">
		<div id="controller-botonera">
			<?=$this->load->view("articulos_view/_menu_botonera")?>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/articulos_controller/search_c" method="post" name="formSearcharticulos" id="formSearcharticulos">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?=$this->load->view("articulos_view/_search")?>
	</fieldset>
	</form>
</div>