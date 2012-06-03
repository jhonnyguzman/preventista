<div id="form">
	<form action="<?=base_url()?>recibos_controller/add_c" method="post" name="formAddrecibos" id="formAddrecibos">
		<p>
			<label><span class='required'>*</span>Cantidad:</label>
			<input type="text" name="recibos_cantidad" id="recibos_cantidad"></input>
		</p>
		<p>
			<input type="radio" name="recibos_flag" id="recibos_flag" value="sologenerar" checked/> S&oacute;lo generar
			<input type="radio" name="recibos_flag" id="recibos_flag" value="generarimprimir"/> Generar e imprimir
		</p>
		<div class="botonera">
			<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddrecibos',new Array('right-content','modal-content-main'))"></input>
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
