<div id="form-small">
	<form action="" method="post" name="formShowCompras" id="formShowCompras">
		<fieldset>
			<legend>Compra</legend>
			<p>
				<label><?=$this->config->item('compras_id')?>:</label>
				<input type="text" value="<?=$compras->compras_id?>" name="compras_id" id="compras_id"  readonly="true"></input>
			</p>
			<p>
				<label><?=$this->config->item('proveedores_id')?>:</label>
				<input type="text" value="<?=$compras->proveedores_apellido." ".$compras->proveedores_nombre?>" 
				name="proveedores_apellido" id="proveedores_apellido" readonly="true"></input>
				<input type="hidden" value="<?=$compras->proveedores_id?>" name="proveedores_id" id="proveedores_id"></input>
			</p>
			<p>
				<label><?=$this->config->item('compras_montototal')?>:</label>
				<input type="text" value="<?=$compras->compras_montototal?>" name="compras_montototal" id="compras_montototal" readonly="true"></input>
			</p>
			<p>
				<label><?=$this->config->item('usuarios_id')?>:</label>
				<input type="text" value="<?=$compras->usuarios_username?>" name="usuarios_username" id="usuarios_username" readonly="true"></input>
				<input type="hidden" value="<?=$compras->usuarios_id?>" name="usuarios_id" id="usuarios_id"></input>
			</p>
			<p>
				<label><?=$this->config->item('compras_created_at')?>:</label>
				<input type="text" value="<?=$compras->compras_created_at?>" name="compras_created_at" id="compras_created_at" readonly="true"></input>
			</p>
		</fieldset>
		<fieldset>
			<legend>Detalle</legend>
			<?=$this->load->view("compras_view/_form_show_comprasdetalle")?>
		</fieldset>
	</form>
</div>