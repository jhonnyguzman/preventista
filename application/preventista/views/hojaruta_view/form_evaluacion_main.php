
<form action="<?=base_url()?>hojaruta_controller/evaluar_c" method="post" name="formEvaluacionHojaRuta" id="formEvaluacionHojaRuta">
	<div class="contentMainEvaluacion">
		<div id="tabPrincipal">
			<ul>
				<li><a href="#tabEvaluacion">Evaluaci&oacute;n</a></li>
				<li><a href="#tabGastos">Gastos</a></li>
				<li><a href="#tabPagosCasuales">Pagos Casuales</a></li>
			</ul>
			<div id="tabEvaluacion">
				<?=$this->load->view("hojaruta_view/form_evaluacion_hojaruta")?>
			</div>
			<div id="tabGastos">
				<?=$this->load->view("hojaruta_view/_form_gastos")?>
			</div>
			<div id="tabPagosCasuales">
				<?=$this->load->view("hojaruta_view/_form_pagoscasuales")?>
			</div>

		</div>
	</div>

	<div class="foodEvaluacion">
		<div class="divTotalesEvaluacion">
			<span><strong>Ingreso:$&nbsp;</strong></span><span id="spIngreso"></span>&nbsp;|&nbsp;
			<span><strong>Gastos:$&nbsp;</strong></span><span id="spGastos"></span>&nbsp;|&nbsp;
			<span><strong>Total:$&nbsp;</strong></span><span id="spTotal"></span>
		</div>
		<div class="botoneraEvaluacion">
			<input type="submit" name="Registrar" value="Registrar" class="crudtest-button" onClick="submitData3('formEvaluacionHojaRuta','content_detail_modal',500,400,'Resultado')"/>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$( "#tabPrincipal" ).tabs({
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"No se puede cargar el contenido de esta secci&oacute;n. " +
						"Intente de nuevo" );
				}
			}
		});
		calcTotalEvaluacion();
	});
</script>
