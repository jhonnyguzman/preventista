<div id="form">
	<form action="<?=base_url()?>clientes_controller/generateRecibos" method="post" name="formGenerarRecibos" id="formGenerarRecibos">
		<p>
			<label for="cantidad">Cantidad:</label>
			<input type="text" name="cantidad" />
		</p>
		<br>
		<div class="botonera">
				<input type="submit" name="generar" value="Generar" class="crudtest-button"  />
		</div>
		<div class="errors" id="errors">
			<?php
				echo validation_errors();
				if(isset($error)) echo $error;
			?>
		</div>
	</form>
</div>
