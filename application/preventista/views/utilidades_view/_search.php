<div class="searchShort">
	<p>
		<label>Fecha desde:</label>
		<input type="text" name="created_at_from" id="created_at_from" />
	</p>
	<p>
		<label>Fecha hasta:</label>
		<input type="text" name="created_at_to" id="created_at_to" />
	</p>
</div>

<script type="text/javascript">
$(document).ready(function() {
	setDatePicker(new Array('created_at_from'));
	setDatePicker(new Array('created_at_to'));
	$("#created_at_from").change(function(){
		submitData2('formSearchUtilidades',new Array('result-list-wrapper','result-list-wrapper'));
	});
	$("#created_at_to").change(function(){
		submitData2('formSearchUtilidades',new Array('result-list-wrapper','result-list-wrapper'));
	});
});
</script>