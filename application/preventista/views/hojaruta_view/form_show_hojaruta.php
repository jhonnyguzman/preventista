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
					<li><a href="#" onClick="getModalWindowAdvancedOne('<?=base_url()?>remitos_controller/showPrintSeleccion_c/','Imprimir Remitos',380,180,'chkHojaRutaDetalle')"  title='Imprimir Remitos'>Imprimir Remitos</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
<div id="form-search">
	<form action="" method="post" name="formShowHojaRuta" id="formShowHojaRuta">
		<fieldset>
			<legend>Hoja de ruta</legend>
			<p>
				<label><?=$this->config->item('hojaruta_id')?>:</label>
				<input type="text" value="<?=$hojaruta->hojaruta_id?>" name="hojaruta_id" id="hojaruta_id"  readonly="readonly"></input>
			</p>
			<p>
				<label><?=$this->config->item('hojaruta_created_at')?>:</label>
				<input type="text" value="<?=$hojaruta->hojaruta_created_at?>" name="hojaruta_created_at" id="hojaruta_created_at" readonly="true"></input>
			</p>
			<p>
				<label><?=$this->config->item('hojaruta_estado_descripcion')?>:</label>
				<input type="text" value="<?=$hojaruta->hojaruta_estado_descripcion?>" name="hojaruta_estado_descripcion" id="hojaruta_estado_descripcion" readonly="true"></input>
			</p>
			<p>
				<label>Fletero:</label>
				<input type="text" value="<?=$hojaruta->fleteros_apellido." ".$hojaruta->fleteros_nombre?>" name="fleteros_apellido" id="fleteros_apellido" readonly="true"></input>
			</p>
			<p>
				<label><?=$this->config->item('usuarios_username')?>:</label>
				<input type="text" value="<?=$hojaruta->usuarios_username?>" name="usuarios_username" id="usuarios_username" readonly="true"></input>
			</p>
		</fieldset>
		<?php if(count($hojarutadetalle) > 0): ?>
			<fieldset>
				<legend>Detalle</legend>
				<div id="lineascampos">
					<table id="result-set">
						<thead>
						<tr>
							<th><input type="checkbox" name="chkAll" class="chkAll"></th>
							<th>Pedido Id</th>
							<th>Tr&aacute;mite</th>
							<th>Cliente</th>
							<th>Direcci&oacute;n</th>
							<th>Moto total</th>
							<th>Saldo</th>			
						</tr>
						</thead>
						<tbody>
						<?php foreach($hojarutadetalle as $f): ?>
						<tr>
							<td><input type="checkbox" name="chkHojaRutaDetalle" class="chkLote" value="<?=$f->hojarutadetalle_id?>"></td>
							<td><?=$f->pedidos_id?></td>
							<td><?=$f->tramites_descripcion?></td>
							<td><?=$f->clientes_apellido." ".$f->clientes_nombre?></td>
							<td><?=$f->clientes_direccion?></td>
							<td><?=$f->peididos_montototal?></td>
							<td><?=$f->pedidos_montoadeudado?></td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</fieldset>
		<?php endif; ?>
		<div class="botonera">
			<input type="button" name="Volver" value="Volver" class="crudtest-button" id="btn" onClick="loadPage('<?=base_url()?>hojaruta_controller/index','right-content')"></input>
			<input type="button" name="Imprimir" value="Imprimir" class="crudtest-button" id="btn" onClick="loadPage('<?=base_url()?>hojaruta_controller/index','right-content')"></input>
		</div>
	</form>
</div>
<script type="text/javascript"> 
$(document).ready(function(){ 
	selectAllChks('chkAll','chkHojaRutaDetalle');
});
</script>