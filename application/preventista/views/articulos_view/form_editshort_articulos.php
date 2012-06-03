<div class="modal-header-left">
	<a href="#" id="formpercent">Porcentajes</a>
</div>
<div class="modal-header-right">
	<a href="#" id="formprice">Precios</a>
</div>
<div id="edit-general1">
	<?=$this->load->view("articulos_view/form_editshortpercent_articulos")?>
</div>
<div id="edit-general2">
	<?=$this->load->view("articulos_view/form_editshortprice_articulos")?>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#formpercent").click(function(){
		$("#edit-general1").css("display","block");
		$("#edit-general2").css("display","none");
	});
	$("#formprice").click(function(){
		$("#edit-general2").css("display","block");
		$("#edit-general1").css("display","none");
	});
});
</script>