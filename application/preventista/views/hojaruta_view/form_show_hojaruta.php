<div id="tabPrincipal">
	<ul>
		<li><a href="#tabGeneralHojaRuta">General</a></li>
		<li><a href="#tabGastosHojaRuta">Gastos</a></li>
	</ul>
	<div id="tabGeneralHojaRuta">
		<div class="linksTabGeneralHojaRuta">
			<?php if($flag['i']):?>
				<a href="<?=base_url()?>hojaruta_controller/printOnlyHojaRuta2/<?=$hojaruta->hojaruta_id?>" title='Imprimir Hoja de Ruta' id="icon-print">Imprimir Hoja de Ruta</a>&nbsp;|&nbsp;
				<a href="#" onClick="loadPagePrint('<?=base_url()?>hojaruta_controller/printRemitos2/<?=$hojaruta->hojaruta_id?>/','chkHojaRutaDetalle')"  title='Imprimir Remitos' id="icon-print">Imprimir Remitos</a>
			<?php endif; ?>
		</div>
		<div id="form-small">
			<form action="" method="post" name="formShowHojaRuta" id="formShowHojaRuta">
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
					</p>
					<p>
						<label>Fletero:</label>
						<input type="text" value="<?=$hojaruta->fleteros_apellido." ".$hojaruta->fleteros_nombre?>" name="fleteros_apellido" id="fleteros_apellido" readonly="true"></input>
					</p>
					<p>
						<label><?=$this->config->item('usuarios_username')?>:</label>
						<input type="text" value="<?=$hojaruta->usuarios_username?>" name="usuarios_username" id="usuarios_username" readonly="true"></input>
					</p>
				</fieldset>
				<?php if(count($hojarutadetalle) > 0): ?>
					<fieldset>
						<legend>Detalle</legend>
						<div id="lineascampos-modal">
							<table id="result-set">
								<thead>
								<tr>
									<th><input type="checkbox" name="chkAll" class="chkAll"></th>
									<th>Pedido Id</th>
									<th>Tr&aacute;mite</th>
									<th>Cliente</th>
									<th>Direcci&oacute;n</th>
									<th>Moto Total</th>
									<th>Monto Adeud.</th>			
								</tr>
								</thead>
								<tbody>
								<?php foreach($hojarutadetalle as $f): ?>
								<tr>
									<td><input type="checkbox" name="chkHojaRutaDetalle" class="chkLote" value="<?=$f->hojarutadetalle_id?>"></td>
									<td><?=$f->pedidos_id?></td>
									<td><?=$f->tramites_descripcion?></td>
									<td><?=$f->clientes_apellido." ".$f->clientes_nombre?></td>
									<td><?=$f->clientes_direccion?></td>
									<td>$&nbsp;<?=$f->peididos_montototal?></td>
									<td>$&nbsp;<?=$f->pedidos_montoadeudado?></td>
								</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</fieldset>
				<?php endif; ?>
			</form>
		</div>
	</div>
	<div id="tabGastosHojaRuta">
		<?php if(count($gastos) > 0): ?>
			<div id="lineascampos-modal">
				<table id="result-set">
					<thead>
					<tr>
						<th>Descripci&oacute;n</th>
						<th>Monto</th>
						<th>Fecha de alta</th>			
					</tr>
					</thead>
					<tbody>
					<?php foreach($gastos as $f): ?>
						<tr>
							<td><?=$f->gastos_descripcion?></td>
							<td>$&nbsp;<?=$f->gastos_monto?></td>
							<td><?=$f->gastos_created_at?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>

<div class="botonera">
	<input type="button" name="btnCerrar" id="btnCerrar" value="Cerrar" />
</div>
	
<script type="text/javascript"> 

	$(document).ready(function(){ 
		$( "#tabPrincipal" ).tabs({
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"No se puede cargar el contenido de esta secci&oacute;n. " +
						"Intente de nuevo" );
				}
			}
		});
		selectAllChks('chkAll','chkHojaRutaDetalle');
		$("#btnCerrar").click(function(){
			$("#content_detail_modal").dialog("close");	
		});
	});


	function loadPagePrint(p_url,nameChk)
	{
		var list = new Array();
		$.each($("input[name="+nameChk+"]:checked"), function() {
	      list.push($(this).val());
	   	});
		if(list.length>0){					
			 window.open(p_url + encodeURIComponent(list),'_blank');
		}else{
			showAleatoryMessage('Selecciona al menos un registro!');
		}	
	}

</script>
<style type="text/css">
#form-small{
	font-size: 0.9em;
}
.linksTabGeneralHojaRuta{
	text-align:right;
}
.linksTabGeneralHojaRuta a{
	color: #2287E6;
}
.linksTabGeneralHojaRuta a:hover{
	text-decoration: underline;
}
</style>