<div class="modal-column1">
	<input type="checkbox" name="toprint[]" value="articulos_id"><?=$this->config->item("articulos_id")?><br>
	<input type="checkbox" name="toprint[]" value="rubros_descripcion" checked><?=$this->config->item("rubros_descripcion")?><br>
	<input type="checkbox" name="toprint[]" value="marcas_descripcion" checked><?=$this->config->item("marcas_descripcion")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_descripcion" checked><?=$this->config->item("articulos_descripcion")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_preciocompra"><?=$this->config->item("articulos_preciocompra")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_stockreal"><?=$this->config->item("articulos_stockreal")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_stockmin"><?=$this->config->item("articulos_stockmin")?>
</div>
<div class="modal-column2">
	<input type="checkbox" name="toprint[]" value="articulos_precio1" checked><?=$this->config->item("articulos_precio1")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_precio2" checked><?=$this->config->item("articulos_precio2")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_precio3" checked><?=$this->config->item("articulos_precio3")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_porcentaje1"><?=$this->config->item("articulos_porcentaje1")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_porcentaje2"><?=$this->config->item("articulos_porcentaje2")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_porcentaje3"><?=$this->config->item("articulos_porcentaje3")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_estado_descripcion"><?=$this->config->item("articulos_estado_descripcion")?>
</div>
<div class="modal-column3">
	<input type="checkbox" name="toprint[]" value="articulos_stockmax"><?=$this->config->item("articulos_stockmax")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_observaciones"><?=$this->config->item("articulos_observaciones")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_created_at"><?=$this->config->item("articulos_created_at")?><br>
	<input type="checkbox" name="toprint[]" value="articulos_updated_at"><?=$this->config->item("articulos_updated_at")?>
	<hr>
	<strong>Orientaci&oacute;n:</strong><br>
	<input type="radio" name="orientacion" value="portrait" checked /> Vertical<br>
	<input type="radio" name="orientacion" value="landscape" /> Horizontal
</div>