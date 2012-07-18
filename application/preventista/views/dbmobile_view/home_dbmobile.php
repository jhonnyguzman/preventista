<?php if($this->session->flashdata('flashConfirm')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashConfirm')."',1)</script>";?>
<?php if($this->session->flashdata('flashError')) echo "<script type='text/javascript'>showFlash('".$this->session->flashdata('flashError')."',2)</script>";?>
<div id="controller-panel">
	<div id="controller-panel-left">
		<div id="title-level2"><?=$subtitle?></div>
	</div>
	<div id="controller-panel-right">
		<div id="controller-botonera">
			<a href="#" onClick="loadPage('<?=base_url()?>dbmobile_controller/cargarDatosIniciales','right-content')" id="icon-newdb" title='Nueva Base de Datos Movil'>Crear Base de Datos M&oacute;vil</a>
		</div>
	</div>
</div>

