// Functon to Show out Busy Div and Hide Busy Div
function showBusy(p_div_show, p_div_hide)
{	
	$('#'+p_div_hide).fadeOut('fast', function(){
		$('#'+p_div_show).fadeIn('fast');
	});
}

// Functon to Hide out Busy Div and display Errors Div
function hideBusy(p_div_show, p_div_hide)
{
	$('#'+p_div_hide).fadeOut('fast',function(){
			$('#'+p_div_show).fadeIn('slow');
	});
}

// function to process form response
function processForm(data, arr_divs_loader)
{		
		window.setTimeout( function(){
			hideBusy('errors','busy');
			//si en la variable data no existe la cadena required cargamos el contenido en un div determinado
			//si existe la cadena required cargamos el cotenido en otro div
		 	if(data.indexOf('field') == -1){
		 		$('#'+ arr_divs_loader[0]).html(data);
		 	}else{
		 		$('#'+ arr_divs_loader[1]).html(data);
		 	}
	 	}, 200);	
}


// function to send form through ajax
function submitData(idform,arr_divs_loader)
{    
    $("#"+idform).submit(function() 
    {
   	 $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        beforeSend: function(){
				showBusy('busy','errors');
		  },	
        success: function(data) {
        		processForm(data,arr_divs_loader);
        }
    	})        
    return false;
    });	
}

// function to send form through ajax
function submitData2(idform,arr_divs_loader)
{    
	 $.ajax({
	     type: 'POST',
	     url: $("#"+idform).attr('action'),
	     data: $("#"+idform).serialize(),
	     beforeSend: function(){
				showBusy('busy','errors');
		  },	
	     success: function(data) {
	     		processForm(data,arr_divs_loader);
	     }
 	 })        
}


// function to send form through ajax
function submitData3(idform,modal_id,w,h,titl)
{    
    $("#"+idform).submit(function() 
    {
   	 $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),	
        success: function(dato) {
	 		$("#"+modal_id).html(dato);
		}
    })        
    return false;
    });	
}

// function to load content through ajax
function loadPage(url,div_loader)
{	
	showFlash('Cargando...',5);
	$('#'+div_loader).load(url, function(){
			$.alert.closeLoading('Listo...',1);
	}).fadeIn('slow');
}

// function to load form edit through ajax
function loadPageEdit(url,div_loader)
{	
	if($('#id123').val())
	{
		showFlash('Cargando...',5);
		url=url+$('#id123').val();
		$('#'+div_loader).load(url, function(){
				//$("#loading").css("display", "none");
				$.alert.closeLoading('Listo...',1);
		}).fadeIn('slow');
	}else{
		showAleatoryMessage('Por favor selecciona un registro!')
	}	
}

// function to delete a set of row of the table
function loadPageDelete(url, div_loader, text)
{	
	var list = new Array();
	$.each($("input[name='chkLote']:checked"), function() {
      list.push($(this).val());
   });
	if(list.length>0){
		if(!text) text = "¿Estas seguro de eliminar los items seleccionados?";
		jConfirm(text, 'Mensaje de confirmación', function(r) {
			if (r) {
				
				$.post(url,{arrkeys:list}, function(data) {
		  			$('#'+div_loader).html(data).fadeIn('slow');
				});
			}	
		});
	}else{
		showAleatoryMessage('Selecciona un registro!');
	}
}

// function to delete a set of row of the table
function loadPageChk(url, div_loader, text, nameChk)
{	
	var list = new Array();
	$.each($("input[name="+nameChk+"]:checked"), function() {
      list.push($(this).val());
   });
	if(list.length>0){				
		$.post(url,{arrkeys:list}, function(data) {
  			$('#'+div_loader).html(data).fadeIn('slow');
		});	
	}else{
		showAleatoryMessage('Selecciona al menos un registro!');
	}
}

// function to delete a row of the table
function deleteData(url, div_loader, text)
{
	jConfirm(text, 'Mensaje de confirmación', function(r) {
		if (r) {
			$.post(url, function(data) {
	  			$('#'+div_loader).html(data).fadeIn('slow');
			});
		}	
	});
}

// function to show a aleatory messege in a box
function showAleatoryMessage(text)
{	
	jAlert(text, 'Mensaje de Alerta');	
}

// function to show flash messages
function showFlash(msg,flag)
{
    switch(flag){
    	
    	case 1:	
    		$.alert(msg);
    		break;
    		
    	case 2:
    		 $.alert(msg,{
    			width:400,
    			height:30,
    			nameClass:'flash-error',
    			nameId:'flash-error',
    			time: 1500	
			  });
    		break;
    		
    	case 3:
    		$.alert(msg,{
    			width:400,
    			height:30,
    			nameClass:'flash-alert',
    			nameId:'flash-alert',
    			time: 1500	
			});
    		break;
    		
    	case 4:
    		$.alert(msg,{
    			width:400,
    			height:30,
    			nameClass:'flash-info',
    			nameId:'flash-info',
    			time: 1500	
			});
    		break;
    	
    	case 5:
    		$.alert(msg,{
    			width:400,
    			height:30,
    			nameClass:'flash-loading',
    			nameId:'flash-loading',
    			time: 1500,
    			permanent:1	
			});
    		break;	
    	
    	case 6:
    		$.alert(msg,{
    			width:400,
    			height:30,
    			nameClass:'flash-loading',
    			nameId:'flash-loading',
    			time: 1,
    			permanent:0	
			});
    		break;
    			
    	default:
    		break;
    };
}

// function to show data's pagination
function setPagination(url, div_loader)
{	 
	 $("div.pagination a").click(function(e){
    	// stop normal link click
    	e.preventDefault();
    	$('#'+div_loader).load(url+$(this).attr("href"));
  	 });
}


// function to show data's pagination
function setPaginationTwo(p_url, p_div_loader, p_form)
{	 
	 $("div.pagination a").click(function(e)
	 {
	    	// stop normal link click
	    	e.preventDefault();
	    	//$('#'+div_loader).load(url+$(this).attr("href"));
	    	$.ajax({
	        type: 'POST',
	        url: p_url+$(this).attr("href"),
	        data: $('#'+p_form).serialize(),
	        success: function(data) {
	        		$('#'+p_div_loader).html(data);
	        }
	    	})  
  	 });      	
}

function showBoxImageUser(id_a,url)
{
	$("#"+id_a).colorbox({
				href:url,
				width:"50%", 
				height:"50%", 
				iframe:true,
				transition:"none",
				opacity:0.8,
				close:"Cerrar"
	});	
}


//show the datapicker in the fields of form
function setDatePicker(arr_fields)
{
	for(var i=0; i<arr_fields.length; i++)
	{
		$( "#"+arr_fields[i]).datepicker({
			autoSize: true,
			gotoCurrent:true,
			changeYear: true,
			changeMonth: true,
			closeText: 'X'
		});	
	}
}

//show the datapicker in the fields of form and  it only allow selects present or future dates
function setDatePickerTwo(arr_fields)
{
	for(var i=0; i<arr_fields.length; i++)
	{
		$( "#"+arr_fields[i]).datepicker({
			autoSize: true,
			gotoCurrent:true,
			changeYear: true,
			changeMonth: true,
			minDate: new Date(),
			closeText: 'X'
		});	
	}
}

//show the results of the upload of files
function resultUpload(estado, url, nameFile) 
{	
	if (estado == 0)
	{
		var mensaje = "El Archivo "+ nameFile +" se ha subido correctamente al servidor";
		$("#linkContinue").attr("onClick","loadPage('"+url+"','result-list-detail')");
		$("#btnContinue").removeAttr('disabled');
	}
	if (estado == 1)
	{
		var mensaje = "Error ! - Error al cargar el archivo "+nameFile+" <br><a href='#' onClick=\"loadPage('"+url+"','right-content')\"> Intentar de nuevo</a>";
	}
	
	$("#formUpload").html(mensaje);

}

// function to add items to a select
function addItemToSelect(options2, options1)
{
	var arr_items_id = "";
	arr_items_id = $("#"+options2.idSelectNoAssing).val() || [];
	/*$("#valores").html(" <b>Seleccion actual:</b> " + 
                  arr_sismenu_id.join(", "));
   */
   if($('#'+options1.mainSelect).val() != "0"){
	   if(arr_items_id !=  "") { 
	   
		   $.post(options2.url_set,{'id':$('#'+options1.mainSelect).val(),'arr_items_id':arr_items_id}, function(data){		
				 if(data[0]['estado'] == true){
				 		getAllItems(options1);
				 }else{
				 	alert('Imposible realizar la operación');
				 }	 	  
			 },"json");
			 
		 }else{
		 	alert('Debes seleccionar alguna opción');	
		 }
	}else{
		alert("Debes seleccionar "+options2.msg);	
	}
}

// function to quit items of a select
function quitItemToSelect(options3, options1)
{	
	var arr_items_id = "";
	arr_items_id = $("#"+options3.idSelectNoAssing).val() || [];
	
	/*$("#valores").html(" <b>Multiple:</b> " + 
                  arr_sismenu_id.join(", "));
   */
   
   if($('#'+options1.mainSelect).val() != "0"){
	   if(arr_items_id !=  "") { 
	
		   $.post(options3.url_quit,{'id':$('#'+options1.mainSelect).val(),'arr_items_id':arr_items_id }, function(data){		
				 if(data[0]['estado'] == true){
				 	getAllItems(options1);			
				 }	  
			 },"json");
			 
		 }else{
		 	alert('Debes seleccionar alguna opción de menu');	
		 }
	}else{
		alert("Debes seleccionar "+options2.msg);	
	}
}

// function to get all items and put them in a select
function getAllItems(options) 
{
    $.post(options.url,{id:$('#'+options.mainSelect).val()}, function(data){
		
		  var toAppend1 = "";
		  var toAppend2 = "";
		
		  $.each(data,function(i,item){ 
		  		if(item.elemento['cod']==1){
		  			toAppend1 += '<option value = \"' + item.elemento[options.fieldId] + '\">' + item.elemento[options.fieldDescription] + '</option>';
		  		} else {
		  			toAppend2 += '<option value = \"' + item.elemento[options.fieldId] + '\">' + item.elemento[options.fieldDescription] + '</option>';
		  		}
		  });
		  		 
		  $("#"+options.idSelectAssing).empty();
		  $("#"+options.idSelectAssing).html(toAppend1);
		  $("#"+options.idSelectNoAssing).empty();
		  $("#"+options.idSelectNoAssing).html(toAppend2);
		  
	 }, "json");

}

//function to put a tab 
function getTabs(id)
{
	$( "#"+id).tabs({
			ajaxOptions: {
				cache: false,
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. ");
				}
			}
	});	
}


function getHoverTable(id,url,result)
{	
	$("#"+id+" tr").click(function()
	{
		var obj = $(this);
		$.post(url,{ param:obj.attr('id')}, function(reponse){
 			$("#"+id).find('tr').removeClass('hover');
 			obj.addClass('hover');
 			
 			$("#"+result).html(reponse);
 		});	
	});	
}

function getHoverTableTwo(p_table_id, p_num_row)
{	
	$("#"+p_table_id+" tbody tr").click(function(){
		var obj = $(this);
 		$("#"+p_table_id).find('tr').removeClass('hover');
 		obj.addClass('hover');
 		if(!p_num_row) $('#id123').val(obj.find("td").eq(1).html());
 		else $('#id123').val(obj.find("td").eq(p_num_row).html());
	});	
}

//function to get a window modal
function getModalWindow(p_url,p_title,p_width,p_height)
{
	$.modal('',{
 		width:p_width,
 		height:p_height,
 		nameClass:'modal-window',
 		nameId:'modal-window',
 		title:p_title,
 		url:p_url	
	});	
}

//function to get a window modal
function getModalWindowAdvancedOne(p_url,p_title,p_width,p_height,nameChk)
{
	var list = new Array();
	$.each($("input[name="+nameChk+"]:checked"), function() {
      list.push($(this).val());
   	});
	if(list.length>0){					
		$.modal('',{
 			width:p_width,
 			height:p_height,
 			nameClass:'modal-window',
 			nameId:'modal-window',
 			title:p_title,
 			url:p_url + list	
		});
	}else{
		showAleatoryMessage('Selecciona al menos un registro!');
	}	
}


function getModalWindowAdvancedTwo(modal_id,url,w,h,nameChk,url2)
{
	var list = new Array();
	$.each($("input[name="+nameChk+"]:checked"), function() {
      list.push($(this).val());
   	});
	if(list.length>0){					
		$("#"+modal_id).load(url + list).dialog({ 
 			width:w,
 			height:h,
 			modal:true,
 			beforeClose: function(event, ui) { 
				//loadPage(url2,'right-content');				
			}	
		});
	}else{
		showAleatoryMessage('Selecciona al menos un registro!');
	}	
}


//function to close of window modal
function closeModalWindows()
{
	$.modal.close();	
}

//function to autocomplete a field
function autocomplete(p_idfield, p_url, p_model, p_idExtraParam, p_arrFieldsToShow)
{
	$("#"+p_idfield).autocomplete(p_url, {
		width: 300,
		//multiple: true,
		matchContains: true,
		autoFill: true,
		selectFirst: true,
		delay: 0,
		extraParams: {
				valExtraParam: function(){
					 if($('#'+p_idExtraParam).val()) return $('#'+p_idExtraParam).val();
					 else return 'NO';
				},
				nameExtraParam:function(){ return $('#'+p_idExtraParam).attr('id') },
				model: p_model,
				nameFieldToSearch: function(){ return $('#'+p_idfield).attr('id') },
				arrFieldToShow: function(){ return serialize(p_arrFieldsToShow) }
		}
		/*formatItem: function(item) {
			return format(item);
		}*/
	}).result(function(e, item) {
		for(var i=0; i< p_arrFieldsToShow.length; i++)
		{
			$("#"+p_arrFieldsToShow[i]).val(item[i+1]);
		}
	});		
}


//function to autocomplete a field
function autocompleteTwo(p_idfield, p_url, p_model, p_idExtraParam, p_arrFieldsToShow, p_fieldToSearch)
{
	$("#"+p_idfield).autocomplete(p_url, {
		width: 300,
		selectFirst: true,
		delay: 0,
		extraParams: {
				valExtraParam: function(){
					 if($('#'+p_idExtraParam).val()) return $('#'+p_idExtraParam).val();
					 else return 'NO';
				},
				nameExtraParam:function(){ return $('#'+p_idExtraParam).attr('id') },
				model: p_model,
				nameFieldToSearch: p_fieldToSearch,
				arrFieldToShow: function(){ return serialize(p_arrFieldsToShow) }
		}
	}).result(function(e, item) {
		for(var i=0; i< p_arrFieldsToShow.length; i++)
		{
			$("#"+p_arrFieldsToShow[i]).val(item[i+1]);
		}
	});		
}


//function to format the returned values of the autocomplete
function format(item) 
{
		//return provincia.provincias_nombre + " &lt;" + provincia.provincias_id + "&gt";
}

//function to serialize an array of values to send by 'post' method
function serialize(arr)
{
     var res = 'a:'+arr.length+':{';
     for(i=0; i<arr.length; i++)
     {
         res += 'i:'+i+';s:'+arr[i].length+':"'+arr[i]+'";';
     }
     res += '}';
      
     return res;
}

//function to activate flash messages 
function activarFlashRegisterUser(p_div_to_active)
{
	$("#"+p_div_to_active).css('display','block');	
}

//function to select a set of checkboxs
function selectAllChks(p_chk1,p_chk2)
{
	$("input[name="+p_chk1+"]").change(function(){
		$("input[name="+p_chk2+"]").each( function() {			
			if($("input[name="+p_chk1+"]:checked").length == 1){
				this.checked = true;
			} else {
				this.checked = false;
			}
		});
	});
}

function getPrecio(cat,i){
	var cl_cat = $("#"+cat).val();
	if(cl_cat == 1) 
	{ 
		$("#articulos_precio-"+i).attr('id','articulos_precio1-'+i);
		$("#articulos_precio1-"+i).attr('name','articulos_precio1-'+i); 
		return 'articulos_precio1-'+i; }
	else if(cl_cat == 2) 
	{
	 	$("#articulos_precio-"+i).attr('id','articulos_precio2-'+i); 
	 	$("#articulos_precio2-"+i).attr('name','articulos_precio2-'+i); 
	 	return 'articulos_precio2-'+i; }
	else 
	{ 
		$("#articulos_precio-"+i).attr('id','articulos_precio3-'+i); 
		$("#articulos_precio-"+i).attr('name','articulos_precio3-'+i); 
		return 'articulos_precio3-'+i; 
	}
}

function getSubtotal(cat,i)
{
	var cl_cat = $("#"+cat).val();
	var msg = "Stock no disponible";
	var st_parcial =  $("#articulos_stockreal-"+i).val() - $("#pedidodetalle_cantidad-"+i).val();
	if(cl_cat == 1){
		if(st_parcial >= 0 ){
			if($("#pedidodetalle_montoacordado-"+i).val() != '')
				$("#pedidodetalle_subtotal-"+i).val(($("#pedidodetalle_montoacordado-"+i).val()*$("#pedidodetalle_cantidad-"+i).val()).toFixed(2));
			else $("#pedidodetalle_subtotal-"+i).val(($("#articulos_precio1-"+i).val()*$("#pedidodetalle_cantidad-"+i).val()).toFixed(2));
			getTotal();	
		}
		else{ 
			alert(msg);
			$("#pedidodetalle_cantidad-"+i).focus();
		}
	}else if(cl_cat == 2){
		if(st_parcial >= 0 ){
			if($("#pedidodetalle_montoacordado-"+i).val() != '')
				$("#pedidodetalle_subtotal-"+i).val(($("#pedidodetalle_montoacordado-"+i).val()*$("#pedidodetalle_cantidad-"+i).val()).toFixed(2));
			else $("#pedidodetalle_subtotal-"+i).val(($("#articulos_precio2-"+i).val()*$("#pedidodetalle_cantidad-"+i).val()).toFixed(2));
			getTotal()
		}else{
			alert(msg);
			$("#pedidodetalle_cantidad-"+i).focus();
		}
	}else{
		if(st_parcial >= 0 ){
			if($("#pedidodetalle_montoacordado-"+i).val() != '')
				$("#pedidodetalle_subtotal-"+i).val(($("#pedidodetalle_montoacordado-"+i).val()*$("#pedidodetalle_cantidad-"+i).val()).toFixed(2));
			else $("#pedidodetalle_subtotal-"+i).val(($("#articulos_precio3-"+i).val()*$("#pedidodetalle_cantidad-"+i).val()).toFixed(2));
			getTotal()
		}else{
			alert(msg);
			$("#pedidodetalle_cantidad-"+i).focus();
		}
	}	
}

function getSubtotal2(i)
{
	$("#comprasdetalle_subtotal-"+i).val(($("#articulos_preciocompra-"+i).val()*$("#comprasdetalle_cantidad-"+i).val()).toFixed(2));
	getTotal2();	

}

function getTotal2()
{
	var total=0;
	$("#lineascampos input[name^=comprasdetalle_subtotal-]").each(function(i,v){
		if($(v).val() != '') total = parseFloat(total) + parseFloat($(v).val());
	});
	$("#compras_montototal").val(total.toFixed(2));
}

function getTotal()
{
	var total=0;
	$("#lineascampos input[name^=pedidodetalle_subtotal-]").each(function(i,v){
		if($(v).val() != '') total = parseFloat(total) + parseFloat($(v).val());
	});
	$("#peididos_montototal").val(total.toFixed(2));
}

// function to load content through ajax
function getR(elem,url)
{	
	var flag2 = false;
	if($(elem).val() != "")
	{
		url = url + $(elem).val();
		$.get(url, function(data){
			var flag = false;
			$("select[id=marcas_id]").each(function(i,v){
				if($(elem).val() == $(v).val()){
					flag = true;
				} else if(flag) $(v).remove();
			});	
			$("select[id=marcas_id]").each(function(i,v){
				if($(elem).val() == $(v).val()){
					$(data).insertAfter(elem);
				}
			});	
		});
	}else{
		$("select[id=marcas_id]").each(function(i,v){
			if(flag2) $(v).remove();
			else if($(elem).val() == $(v).val()){
				flag2 = true;
			} 
		});	
	}
}


function checkRepeatArticle(obj,j)
{
	if($(obj).val() != '')
	{
		var k = 0;
		$("#lineascampos input[name^=articulos_descripcion-]").each(function(i,v){
			if( $("#articulos_descripcion-"+j).val() == $(v).val() ) k++;
		});
		if(k > 1){ 
			if(confirm("El articulo ya ha sido ingresado. ¿Desea eliminarlo?")) {
				$("#lineascampos table tr[id="+j+"] td input").val(''); 
				$(obj).focus();
			}
			else{
				$("#lineascampos table tr[id="+j+"] td input[name$=_cantidad-"+j+"]").focus();	
			}  
		}else{
			$("#lineascampos table tr[id="+j+"] td input[name$=_cantidad-"+j+"]").focus();	
		}
	}
}

function updateParcial(nameChk, url)
{
	var art_ids = new Array();
	var art_st = new Array();
	var art_stv = new Array();
	var comment = new Array();
	var art_pc = new Array();
	var art_pv1 = new Array(); var art_pv2 = new Array(); var art_pv3 = new Array();
	var art_p1 = new Array(); var art_p2 = new Array(); var art_p3 = new Array();
	$.each($("input[name="+nameChk+"]:checked"), function() {
      art_ids.push($(this).val());
      art_st.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_stockreal-]").val());
      art_stv.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_stockrealviejo-]").val());
      comment.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=chdirect_comment-]").val());
      art_pc.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_preciocompra-]").val());
      art_pv1.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_precio1-]").val());
      art_pv2.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_precio2-]").val());
      art_pv3.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_precio3-]").val());
      art_p1.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_porcentaje1-]").val());
      art_p2.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_porcentaje2-]").val());
      art_p3.push($("#result-set tbody tr[id="+$(this).val()+"] td input[name^=articulos_porcentaje3-]").val());
    });

    if(art_ids.length>0){
    	showFlash('Registrando...',5);				
		$.get(url,{ 'art_ids[]': art_ids, 'art_sts[]': art_st, 'art_stsv[]': art_stv, 'comments[]': comment, 'art_pcs[]': art_pc, 
			'art_pv1[]': art_pv1, 'art_pv2[]': art_pv2, 'art_pv3[]': art_pv3,
			'art_p1[]': art_p1, 'art_p2[]': art_p2, 'art_p3[]': art_p3}, function(data) {
		  $.alert.closeLoading('Listo...',1);
		  $('#right-content').html(data);
		});
		
	}
}

function calcPrice(i, chgcolor)
{	
	var pc = parseFloat($("#articulos_preciocompra-"+i).val());
	var porc1  = parseFloat($("#articulos_porcentaje1-"+i).val());
	var porc2  = parseFloat($("#articulos_porcentaje2-"+i).val());
	var porc3  = parseFloat($("#articulos_porcentaje3-"+i).val());
	$("#articulos_precio1-"+i).val((pc + (( pc * porc1 )/100)).toFixed(2));
	$("#articulos_precio2-"+i).val((pc + (( pc * porc2 )/100)).toFixed(2));
	$("#articulos_precio3-"+i).val((pc + (( pc * porc3 )/100)).toFixed(2));
	
}


function calcPriceAdvanced(i, elem_id1, elem_id2, elem_id3, porce_a, porce_b, porce_c)
{
	var pv = parseFloat($("#"+elem_id1+"-"+i).val());
	var porc_a  = parseFloat($("#"+porce_a+"-"+i).val());
	var porc_b  = parseFloat($("#"+porce_b+"-"+i).val());
	var porc_c  = parseFloat($("#"+porce_c+"-"+i).val());
	var pc = pv / (( porc_a / 100 ) + 1);
	$("#articulos_preciocompra-"+i).val(pc.toFixed(2));
	$("#"+elem_id2+"-"+i).val((pc + (( pc * porc_b )/100)).toFixed(2));
	$("#"+elem_id3+"-"+i).val((pc + (( pc * porc_c )/100)).toFixed(2));
}


function calcPriceSimple(porcent, elem_id)
{	
	if($("#articulos_preciocompra").val() != ""){
		var pc = parseFloat($("#articulos_preciocompra").val());
		var porc = parseFloat(porcent);
		$("#"+elem_id).val((pc + (( pc * porc )/100)).toFixed(2));	
	}else{
		alert("Complete PC");
		$("#articulos_preciocompra").focus();
	}
}

function calcPriceSimple2(precioc)
{	
	if(precioc != ""){
		var pc = parseFloat(precioc);
		var porc1  = parseFloat($("#articulos_porcentaje1").val());
		var porc2  = parseFloat($("#articulos_porcentaje2").val());
		var porc3  = parseFloat($("#articulos_porcentaje3").val());
		$("#articulos_precio1").val((pc + (( pc * porc1 )/100)).toFixed(2));
		$("#articulos_precio2").val((pc + (( pc * porc2 )/100)).toFixed(2));
		$("#articulos_precio3").val((pc + (( pc * porc3 )/100)).toFixed(2));
	}else{
		alert("Complete PC");
		$("#articulos_preciocompra").focus();
	}
}

function check(i)
{
	$("#result-set tbody tr[id="+i+"] td input[type=checkbox]").attr("checked","true");
}

function dialogUp(modal_id,w,h,url, titl)
{
	if(url != ''){
		$("#"+modal_id).load(url).dialog({  
	  		width: w,
	  		height: h, 
	  		modal:true,
	  		title: titl,
	  		close: function(event, ui) {  $(this).dialog('destroy'); 
	  		}
		}); 
	}else{
		$( "#"+modal_id).dialog({
			width: w,
			height: h,
			modal: true,
			close: function(event, ui) {  $(this).dialog('destroy'); 
			}
		});
	}
}

function showModalCC(modal_id,w,h,url, titl)
{
	$("#"+modal_id).load(url).dialog({  
  		width: w,
  		height: h, 
  		modal:true,
  		title: titl,
  		close: function(event, ui) { 
  			 $("#"+modal_id).dialog('destroy');
  			
  		}
	}); 
	
}

function dialogUpToComment(modal_id,w,h,i)
{
	$( "#"+modal_id).dialog({
		width: w,
		height: h,
		modal: true,
		beforeClose: function(event, ui) { 
			if($("#tcomment-"+i).val() != "")
				$("#chdirect_comment-"+i).val($("#tcomment-"+i).val());				
			else $("#chdirect_comment-"+i).val("N");
		}
	});
}

function getOneMarcaToSearch()
{
	var flag = new Array();
	var list = new Array();
	$(".searchShort  select[name^=marcas_id]").each(function(i,v){
		list.push($(v).val());
	});
	if(list.length > 0){
		for(i=0; i<list.length; i++) if(list[i] == "") flag.push(true);
		if(flag.length > 0)
			marcatosearch = list[list.length - 2];
		else marcatosearch = list[list.length - 1];
		
		return marcatosearch;
	}else return "";
}

function setTimeToRun(url)
{
	var list = new Array();
	$.each($("#result-set tbody input[type=text]"), function() {
  		if(this.value != this.defaultValue)
  			list.push($(this).val());
  	});
  	if(list.length>0){
		setTimeout( "updateParcial('chkArticulos','"+url+"')", 5000);
	}
}

function setComment(i)
{
	if($("#articulos_stockreal-"+i).attr('value') == $("#articulos_stockreal-"+i).prop("defaultValue"))
	{
		$("#chdirect_comment-"+i).val("F");
		$("#acomment-"+i).remove();
		$("#comment-"+i).remove();
	}
	else {
		$("#chdirect_comment-"+i).val("N");
		if(!$("#acomment-"+i).length){
			$("<a href='#' id='acomment-"+i+"' onclick=\"dialogUpToComment('comment-"+i+"',250,150,"+i+")\">+</a><div id='comment-"+i+"' title='Cambio directo | Comentario'><textarea name='tcomment-"+i+"' id='tcomment-"+i+"' style='width:98%; height:90%;'></textarea></div>").insertAfter($("#articulos_stockreal-"+i));
			$("#comment-"+i).css("display","none");
		}
	}
}


function getHistoricChgDirect(url)
{
	$("#historicalChgs").load(url).dialog({ 
	  modal:true, 
	  width: 400,
	  height: 500 
	}); 

}


function calcTotalEvaluacion()
{
	var list1 = new Array(); var list2 = new Array();var list3 = new Array();
	var totalIngreso = 0;var totalGastos = 0; var totalPagosCasuales = 0;
	
	/*$.each($("#chkEvaluacionHojaRuta:checked"), function() {
      list1.push($(this).next().val());
   	});*/
	
	$.each($("input[name^=monto_recibido]"), function() {
		if($(this).val() != '')
      		list1.push($(this).val());
   	});

	$.each($("input[name^=gmontos]"), function() {
      list2.push($(this).val());
   	});

	$.each($("input[name^=pmontos]"), function() {
      list3.push($(this).val());
   	});

	if(list1.length>0){
		for(var i = 0; i < list1.length; i++){
			totalIngreso+= parseFloat(list1[i]);
		}
	}
	if(list2.length>0){
		for(var i = 0; i < list2.length; i++){
			totalGastos+= parseFloat(list2[i]);
		}
	}
	if(list3.length>0){
		for(var i = 0; i < list3.length; i++){
			totalPagosCasuales+= parseFloat(list3[i]);
		}
	}

	$("#spIngreso").text(totalIngreso + totalPagosCasuales);
	$("#spGastos").text(totalGastos);
	$("#spTotal").text((totalIngreso + totalPagosCasuales) - totalGastos);

}