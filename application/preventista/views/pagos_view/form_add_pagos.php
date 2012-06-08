<div id="form">
	<form action="<?=base_url()?>pagos_controller/add_c" method="post" name="formAddpagos" id="formAddpagos">
		<p>
			<label><span class='required'>*</span>Cantidad:</label>
			<input type="text" name="pagos_cantidad" id="pagos_cantidad"></input>
		</p>
		<p>
			<input type="radio" name="pagos_flag" id="pagos_flag" value="sologenerar" checked/> S&oacute;lo generar
			<input type="radio" name="pagos_flag" id="pagos_flag" value="generarimprimir"/> Generar e imprimir
		</p>
		<div class="botonera">
			<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddpagos',new Array('right-content','modal-content-main'))"></input>
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
