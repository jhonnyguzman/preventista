<?php if($error_message): ?>
	<div class="error"><?=$error_message?></div>
<?php else: ?>
	<div id="form-small">
		<form action="<?=base_url()?>hojaruta_controller/add_c" method="post" name="formAddhojaruta" id="formAddhojaruta">
			<p>
				<label>Fletero:</label>
				<select name="fleteros_id" id="fleteros_id">
					<?php foreach($fleteros as $f): ?>
						<option value="<?=$f->fleteros_id?>"><?=$f->fleteros_apellido." ".$f->fleteros_nombre?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<?=$this->load->view('hojaruta_view/_hojarutadetalle')?>
			<div class="botonera">
				<input type="submit" name="guardar" value="Guardar" class="crudtest-button" id="btn-save" onClick="submitData('formAddhojaruta',new Array('right-content','right-content'))"></input>
				<input type="button" name="cancelar" value="Cancelar" class="crudtest-button" id="btn-cancel" onClick="closeModalWindows()"></input>
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
	<script> 
		$(document).ready(function(){ });
	</script>

<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-save").click(function(){
		closeModalWindows();
	})
});	

</script>