<?php if($error_message): ?>
	<div class="error"><?=$error_message?></div>
<?php else: ?>
	<div id="title-level2"><?=$subtitle?></div>
	<div id="form-search">
		<form action="<?=base_url()?>hojaruta_controller/edit_c/<?=$hojaruta->hojaruta_id?>" method="post" name="formEdithojaruta" id="formEdithojaruta">
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
					<input type="hidden" value="<?=$hojaruta->hojaruta_estado?>" name="hojaruta_estado" id="hojaruta_estado" />
				</p>
				<p>
					<label>Fletero:</label>
					<select name="fleteros_id" id="fleteros_id">
						<?php foreach($fleteros as $f): ?>
							<?php if($f->fleteros_id == $hojaruta->fleteros_id): ?>
								<option value="<?=$f->fleteros_id?>" selected><?=$f->fleteros_apellido." ".$f->fleteros_nombre?></option>
							<?php else:?>
								<option value="<?=$f->fleteros_id?>"><?=$f->fleteros_apellido." ".$f->fleteros_nombre?></option>
							<?php endif;?>
						<?php endforeach;?>
					</select>
				</p>
				<p>
					<label><?=$this->config->item('usuarios_username')?>:</label>
					<input type="text" value="<?=$hojaruta->usuarios_username?>" name="usuarios_username" id="usuarios_username" readonly="true"></input>
					<input type="hidden" value="<?=$hojaruta->usuarios_id?>" name="usuarios_id" id="usuarios_id" ></input>
				</p>
			</fieldset>
			<?php if(count($hojarutadetalle) > 0): ?>
				<fieldset>
					<legend>Detalle</legend>
					<div id="lineascampos">
						<table id="result-set">
							<thead>
							<tr>
								<th>Pedido Id</th>
								<th>Tr&aacute;mite</th>
								<th>Cliente</th>
								<th>Direcci&oacute;n</th>
								<th>Moto total</th>
								<th>Saldo</th>
								<th></th>			
							</tr>
							</thead>
							<tbody>
							<?php foreach($hojarutadetalle as $f): ?>
							<tr>
								<td><?=$f->pedidos_id?></td>
								<td><?=$f->tramites_descripcion?></td>
								<td><?=$f->clientes_apellido." ".$f->clientes_nombre?></td>
								<td><?=$f->clientes_direccion?></td>
								<td>$&nbsp;<?=$f->peididos_montototal?></td>
								<td>$&nbsp;<?=$f->pedidos_montoadeudado?></td>
								<?php if($flag['d']):?>
									<td><a href="#" onClick="deleteData('<?=base_url()?>index.php/hojarutadetalle_controller/delete_c/<?=$f->hojarutadetalle_id?>','right-content','¿Estás seguro de eliminar este item?')" id="icon-delete">Eliminar</a><td>
								<?php endif;?>
							</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</fieldset>
			<?php endif; ?>
			<div class="botonera">
				<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEdithojaruta',new Array('right-content','right-content'))"></input>
				<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>hojaruta_controller/index','right-content')"></input>
			</div>
			<div class="errors" id="errors">
			<?php
				echo validation_errors();
				if(isset($error)) echo $error;
			?>
			</div>
			<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div>
		</form>
	</div>

<?php endif; ?>