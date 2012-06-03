<div id="title-level2"><?=$subtitle?></div>
<div id="form">
<div class="fields-required">Campos obligatorios (*)</div>
<form action="<?=base_url()?>articulos_controller/add_c" method="post" name="formAddarticulos" id="formAddarticulos">
	<p>
		<label><span class='required'>*</span><?=$this->config->item('rubros_descripcion')?>:</label>
		<select name="rubros_id" id="rubros_id">
			<option value="" <?=set_select('rubros_id','')?> >Seleccione</option>
			<?php foreach($rubros as $f):?>
				<option value="<?=$f->rubros_id?>" <?=set_select('rubros_id',$f->rubros_id)?> ><?=$f->rubros_descripcion?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('marcas_descripcion')?>:</label>
		<select name="marcas_id[]" id="marcas_id"  onClick="getR(this,'<?=base_url()?>marcas_controller/get_c/')">
			<?php foreach($marcas as $f):?>
				<option value="<?=$f->marcas_id?>"><?=$f->marcas_descripcion?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_descripcion')?>:</label>
		<input type="text" name="articulos_descripcion" id="articulos_descripcion" value="<?=set_value('articulos_descripcion')?>" ></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_preciocompra')?>:</label>
		<input type="text" name="articulos_preciocompra" id="articulos_preciocompra" value="<?=set_value('articulos_preciocompra')?>"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_stockreal')?>:</label>
		<input type="text" name="articulos_stockreal" id="articulos_stockreal" value="<?=set_value('articulos_stockreal')?>"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_stockmin')?>:</label>
		<input type="text" name="articulos_stockmin" id="articulos_stockmin" value="<?=set_value('articulos_stockmin')?>"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_precio1')?>:</label>
		<input type="text" name="articulos_precio1" id="articulos_precio1" readonly="true" value="<?=set_value('articulos_precio1')?>"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_precio2')?>:</label>
		<input type="text" name="articulos_precio2" id="articulos_precio2" readonly="true" value="<?=set_value('articulos_precio2')?>"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_precio3')?>:</label>
		<input type="text" name="articulos_precio3" id="articulos_precio3" readonly="true" value="<?=set_value('articulos_precio3')?>"></input>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje1')?>:</label>
		<input type="text" name="articulos_porcentaje1" id="articulos_porcentaje1" value="<?=set_value('articulos_porcentaje1','0')?>" 
		onChange="calcPriceSimple(this.value,'articulos_precio1')"/>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje2')?>:</label>
		<input type="text" name="articulos_porcentaje2" id="articulos_porcentaje2" value="<?=set_value('articulos_porcentaje2','0')?>" 
		onChange="calcPriceSimple(this.value,'articulos_precio2')"/>
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_porcentaje3')?>:</label>
		<input type="text" name="articulos_porcentaje3" id="articulos_porcentaje3" value="<?=set_value('articulos_porcentaje3','0')?>" 
		onChange="calcPriceSimple(this.value,'articulos_precio3')" />
	</p>
	<p>
		<label><span class='required'>*</span><?=$this->config->item('articulos_estado_descripcion')?>:</label>
		<select name="articulos_estado" id="articulos_estado">
				<?php foreach($estados as $f):?>
					<option value="<?=$f->tabgral_id?>"><?=$f->tabgral_descripcion?></option>
				<?php endforeach; ?>
		</select>
	</p>
	<div class="botonera">
		<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddarticulos',new Array('right-content','right-content'))"></input>
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
