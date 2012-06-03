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
			<a href="#" onClick="loadPage('<?=base_url()?>index.php/fleteros_controller/add_c','right-content')" id="icon-new" title='Nuevo'>Nuevo</a>
		<?php endif; ?>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="<?=base_url()?>index.php/fleteros_controller/search_c" method="post" name="formSearchfleteros" id="formSearchfleteros">
	<fieldset>
		<legend>Filtrar por:</legend>
		<?php foreach($fieldSearch as $field):?>
		<p>
			<label><?=$this->config->item($field)?>:</label>
			<input type="text" name="<?=$field?>" id="<?=$field?>"></input>
		</p>
		<?php endforeach; ?>
		<p>
		<input type="submit" name="btn-search" id="btn-search" value="Buscar" onClick="submitData('formSearchfleteros',new Array('result-list','result-list'))"></input>
		</p>
	</fieldset>
	</form>
</div>
