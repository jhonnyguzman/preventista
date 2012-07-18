<div id="headGastos">
	<span>Descripci&oacute;n:</span> 
	<input type="text" name="gdescripcion" id="gdescripcion"  />
	<span>Monto:</span> 
	<input type="text" name="gmonto" id="gmonto">
	<input type="button" value="Añadir" id="btnAnadirGasto">
</div>
<div id="listGastos">

	<table class="result-set" id="tbGastos" >
		<thead>
			<tr>
				<th>Descripci&oacute;n</th>
				<th>Monto</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

</div>
<script type="text/javascript">
	var cantFilasGastos = 1;
	$(document).ready(function() {
		$("#btnAnadirGasto").click(function(){
			runGasto();
			calcTotalEvaluacion();
		});

		$('#gmonto').keyup(function () {
  			this.value = this.value.replace(/[^0-9.]/g,'');
		});
	});

	function runGasto(){
		var n = $("tr th",$("#tbGastos")).length;
			var gdescrip = $("#gdescripcion").val();
			var gmonto = $("#gmonto").val();
			if(gdescrip != '' && gmonto != '')
			{
				var tds = "<tr>";
				for(var i=0; i < n; i++){
					 if(i == 0)
					 	tds += "<td><input type='text' name='gdescrip[]' id='gdescrip-"+cantFilasGastos+"' value='"+gdescrip+"'/></td>";
					 if(i == 1)
					 	tds += "<td>$<input type='text' name='gmontos[]' id='gmontos-"+cantFilasGastos+"' value='"+gmonto+"'/></td>";
					  if(i == 2)
					  	tds += "<td><a href='#' onClick=\"$(this).closest('tr').remove(); calcTotalEvaluacion();\">Eliminar</a></td>";
				}
				tds += "</tr>";
				$("#tbGastos").append(tds);
				cantFilasGastos++;
				$("#gdescripcion").val('').focus();
				$("#gmonto").val('');
			}else{
				alert("Descripción o Monto no ingreado!");
			}
	}
</script>