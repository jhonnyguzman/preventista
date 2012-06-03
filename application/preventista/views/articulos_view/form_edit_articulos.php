<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>articulos_controller/edit_c/<?=$articulos->articulos_id?>" method="post" name="formEditarticulos" id="formEditarticulos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_id')?>:</label>
		<input type="text" value="<?=$articulos->articulos_id?>" name="articulos_id" id="articulos_id"  readonly="readonly"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('rubros_descripcion')?>:</label>
		<select name="rubros_id" id="rubros_id">
			<?php foreach($rubros as $f):?>
				<?php if($f->rubros_id == $articulos->rubros_id): ?>
					<option value="<?=$f->rubros_id?>" selected><?=$f->rubros_descripcion?></option>
				<?php else: ?>
					<option value="<?=$f->rubros_id?>"><?=$f->rubros_descripcion?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('marcas_descripcion')?>:</label>
		<select name="marcas_id" id="marcas_id">
			<?php foreach($marcas as $f):?>
				<?php if($f->marcas_id == $articulos->marcas_id): ?>
					<option value="<?=$f->marcas_id?>" selected><?=$f->marcas_descripcion?></option>
				<?php else: ?>
					<option value="<?=$f->marcas_id?>"><?=$f->marcas_descripcion?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_descripcion')?>:</label>
		<input type="text" value="<?=$articulos->articulos_descripcion?>" name="articulos_descripcion" id="articulos_descripcion"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_preciocompra')?>:</label>
		<input type="text" value="<?=$articulos->articulos_preciocompra?>" name="articulos_preciocompra" id="articulos_preciocompra"
		onChange="calcPriceSimple2(this.value)"/>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_stockreal')?>:</label>
		<input type="text" value="<?=$articulos->articulos_stockreal?>" name="articulos_stockreal" id="articulos_stockreal"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_stockmin')?>:</label>
		<input type="text" value="<?=$articulos->articulos_stockmin?>" name="articulos_stockmin" id="articulos_stockmin"></input>
	</p>
	<p>
		<label><?=$this->config->item('articulos_stockmax')?>:</label>
		<input type="text" value="<?=$articulos->articulos_stockmax?>" name="articulos_stockmax" id="articulos_stockmax"></input>
	</p>
	<p>
		<label><?=$this->config->item('articulos_precio1')?>:</label>
		<input type="text" value="<?=$articulos->articulos_precio1?>" name="articulos_precio1" id="articulos_precio1" readonly="true"></input>
	</p>
	<p>
		<label><?=$this->config->item('articulos_precio2')?>:</label>
		<input type="text" value="<?=$articulos->articulos_precio2?>" name="articulos_precio2" id="articulos_precio2" readonly="true"></input>
	</p>
	<p>
		<label><?=$this->config->item('articulos_precio3')?>:</label>
		<input type="text" value="<?=$articulos->articulos_precio3?>" name="articulos_precio3" id="articulos_precio3" readonly="true"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje1')?>:</label>
		<input type="text" value="<?=$articulos->articulos_porcentaje1?>" name="articulos_porcentaje1" id="articulos_porcentaje1"
		onChange="calcPriceSimple(this.value,'articulos_precio1')"/>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje2')?>:</label>
		<input type="text" value="<?=$articulos->articulos_porcentaje2?>" name="articulos_porcentaje2" id="articulos_porcentaje2" 
		onChange="calcPriceSimple(this.value,'articulos_precio2')"/>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje3')?>:</label>
		<input type="text" value="<?=$articulos->articulos_porcentaje3?>" name="articulos_porcentaje3" id="articulos_porcentaje3" 
		onChange="calcPriceSimple(this.value,'articulos_precio3')"/>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_estado_descripcion')?>:</label>
		<select name="articulos_estado" id="articulos_estado">
			<?php foreach($estados as $f):?>
				<?php if($f->tabgral_id == $articulos->articulos_estado): ?>
					<option value="<?=$f->tabgral_id?>" selected><?=$f->tabgral_descripcion?></option>
				<?php else: ?>
					<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><?=$this->config->item('articulos_observaciones')?>:</label>
		<textarea name="articulos_observaciones" id="articulos_observaciones"><?=$articulos->articulos_observaciones?></textarea>
	</p>
	<div class="botonera">
		<input type="submit" name="modificar" value="Modificar" class="crudtest-button" id="btn-save" onClick="submitData('formEditarticulos',new Array('right-content','right-content'))"></input>
		<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="loadPage('<?=base_url()?>articulos_controller/index','right-content')"></input>
	</div>
	<div class="errors" id="errors">
	<?php
		echo validation_errors();
		if(isset($error)) echo $error;
	?>
	</div>
	<div id="busy"><img src="<?=base_url()?>css/images/ajax-loader.gif" /></div></form>
</div>
