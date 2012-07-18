<div id="headPagosCasuales">
	<span>Cliente:</span> 
	<input type="text" name="clientes_apellido" id="clientes_apellido"  />
	<input type="hidden" name="clientes_id" id="clientes_id"  />
	<span>Monto:</span> 
	<input type="text" name="pmonto" id="pmonto">
	<input type="button" value="Añadir" id="btnAnadirPagoCasual">
</div>
<div id="listPagosCasuales">

	<table class="result-set" id="tbPagosCasuales" >
		<thead>
			<tr>
				<th>Cliente</th>
				<th>Monto</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

</div>
<script type="text/javascript">
	var cantFilasPagosCasuales = 1;
	$(document).ready(function(){ 
		$('#clientes_apellido').focus(function(){
			autocomplete('clientes_apellido','<?=base_url()?>autocomplete_controller/getAutocompleteClientes_c','clientes_model','',new Array('clientes_id'));
		});
		
		$("#btnAnadirPagoCasual").click(function(){
			runPagosCasuales();
			calcTotalEvaluacion();
		});

		$('#pmonto').keyup(function () {
  			this.value = this.value.replace(/[^0-9.]/g,'');
		});
	});

	function runPagosCasuales(){
		var n = $("tr th",$("#tbPagosCasuales")).length;
		var capellido = $("#clientes_apellido").val();
		var cid = $("#clientes_id").val();
		var pmonto = $("#pmonto").val();
		if(capellido != '' &&  cid != '' && pmonto != '')
		{
			var tds = "<tr>";
			for(var i=0; i < n; i++){
				 if(i == 0)
				 	tds += "<td>"+capellido+"<input type='hidden' name='clientes_id[]' id='clientes_id-"+cantFilasPagosCasuales+"' value='"+cid+"'/></td>";
				 if(i == 1)
				 	tds += "<td>$<input type='text' name='pmontos[]' id='pmontos-"+cantFilasPagosCasuales+"' value='"+pmonto+"'/></td>";
				  if(i == 2)
				  	tds += "<td><a href='#' onClick=\"$(this).closest('tr').remove(); calcTotalEvaluacion();\">Eliminar</a></td>";
			}
			tds += "</tr>";
			$("#tbPagosCasuales").append(tds);
			cantFilasPagosCasuales++;
			$("#clientes_apellido").val('').focus();
			$("#clientes_id").val('');
			$("#pmonto").val('');
		}else{
			alert("Cliente o Monto no ingresado!");
		}
	}
</script>
