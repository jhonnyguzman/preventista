/*
* Alert and windows modal for jQuery
* 
*/
(function($) {	  

		 //function by alert messages 
       $.alert = function(msg, opciones_user){
	 	
       var settings = $.extend({}, $.alert.defaults, opciones_user );
       		 
		 $('#'+settings.nameId).remove(); 
		 
		 var contenidoHTML = '<span>'+msg+'</span>';
       
       // obtenemos ancho y alto de la ventana del explorer
       var wscr = $(window).width();
       var hscr = $(window).height();
       
       // ventana modal
       // creamos otro div para la ventana modal y dos atributos
       var moddiv = $('<div>').attr({
                               className: settings.nameClass,
                               id: settings.nameId
                               });     
       
       // agregamos div a la pagina
       $('body').append(moddiv);

       // agregamos contenido HTML a la ventana modal
       $('#'+settings.nameId).append(contenidoHTML);
      		    
       
       $(window).resize(function(){
	       // redimensionamos para que se ajuste al centro y mas
	       // dimensiones de la ventana del explorer 
	       var wscr = $(window).width();
	       var hscr = $(window).height();
	       
	       // estableciendo tamaño de la ventana modal
	       $('#'+settings.nameId).css("width", settings.width+'px');
	       $('#'+settings.nameId).css("height", settings.height+'px');
	       
	       // obtiendo tamaño de la ventana modal
	       var wcnt = $('#'+settings.nameId).width();
	       var hcnt = $('#'+settings.nameId).height();

	       // obtener posicion central
	       var mleft = ( wscr - wcnt ) / 2;
	       //var mtop = ( hscr - hcnt ) / 2;
	       
	       var mtop = 0;
	       // estableciendo ventana modal en el centro
	       $('#'+settings.nameId).css("left", mleft+'px');
	       $('#'+settings.nameId).css("top", mtop+'px');
        }); 
       
       // redimensionamos para que se ajuste al centro y mas  
       $(window).resize();
       
       if(settings.permanent)
       {
       	 $("#"+settings.nameId).slideDown('fast');
       }
       else
       {
	       $('#'+settings.nameId).slideDown('fast');
	       setTimeout(function(){
		  	 $("#"+settings.nameId).fadeOut(1000);
	       }, settings.time);
       }    
    };

    $.alert.defaults = {
    		width:400,
    		height:30,
    		nameClass:'flash-success',
    		nameId:'flash-success',
    		time: 1500,
    		permanent:0
     };
    
    $.alert.closeLoading  = function(msg,time){
    		setTimeout(function(){
    		 $('#flash-loading').text(msg);
		  	 $("#flash-loading").fadeOut(1000);
	      },time);
    };
    
    
    //function by modal window
    $.modal = function(msg, opciones_user){
	 	
       var settings = $.extend({}, $.modal.defaults, opciones_user );
       var contenidoHTML; 
        	 
       $('#'+settings.nameId).remove(); 
	
       var titleModal = "<div id='title-modal'><div id='title-modal-left'>"+settings.title+"</div><div id='title-modal-right'><a href='#' id='btnClose' title='Cerrar'></a></div></div>";	 
       
       
       // fondo transparente
       // creamos un div nuevo, con dos atributos
       var bgdiv = $('<div>').attr({       	                                 
       		className: 'mask',
                id: 'mask'
       });
       
                                       
       // agregamos nuevo div a la pagina
       $('body').append(bgdiv);
                
       // obtenemos ancho y alto de la ventana del explorer
       var wscr = $(window).width();
       var hscr = $(window).height();
       
        //establecemos las dimensiones del fondo
        $('#mask').css("width", wscr);
        $('#mask').css("height", hscr);
                
       // ventana modal
       // creamos otro div para la ventana modal y dos atributos
       var moddiv = $('<div>').attr({
                               className: settings.nameClass,
                               id: settings.nameId
                               });     
       
       var divcontent = $('<div>').attr({
                               className: 'modal-content-main',
                               id: 'modal-content-main'
                               });  
                               
       // agregamos div a la pagina
       $('body').append(moddiv);
       
       $('#'+settings.nameId).append(titleModal);
       $('#'+settings.nameId).append(divcontent);
        
       if(settings.url !=''){
       	$.post(settings.url,function(response){
      		 //contenidoHTML = response; 		
      		  $('#modal-content-main').append(response);
       	});
       }else{
       		$('#'+settings.nameId).append('No result');
       }
       
         
       // agregamos contenido HTML a la ventana modal
       //$('#'+settings.nameId).append(contenidoHTML);
       
       $(window).resize(function(){
       		 // redimensionamos para que se ajuste al centro y mas
        	// dimensiones de la ventana del explorer 
	       var wscr = $(window).width();
	       var hscr = $(window).height();
	       
	       // estableciendo dimensiones de fondo
	       $('#mask').css("width", wscr);
	       $('#mask').css("height", hscr);
		        
	       // estableciendo tamaño de la ventana modal
	       $('#'+settings.nameId).css("width", settings.width+'px');
	       $('#'+settings.nameId).css("height", settings.height+'px');
	       
	       // obtiendo tamaño de la ventana modal
	       var wcnt = $('#'+settings.nameId).width();
	       var hcnt = $('#'+settings.nameId).height();

	       // obtener posicion central
	       var mleft = ( wscr - wcnt ) / 2;
	       var mtop = ( hscr - hcnt ) / 2;
	       
	       // estableciendo ventana modal en el centro
	       $('#'+settings.nameId).css("left", mleft+'px');
	       $('#'+settings.nameId).css("top", mtop+'px');
         });
        
       // redimensionamos para que se ajuste al centro y mas  
       $(window).resize();
       
       $("#btnClose").click(function(){
    		// removemos divs creados
        	$('#mask').remove();
        	$('#modal-window').remove();
       });
       
      
       
    };

    $.modal.defaults = {
    		width:400,
    		height:400,
    		nameClass:'modal-window',
    		nameId:'modal-window',
    		title:'Titulo',
    		url:''
     };
    
    $.modal.close  = function(){
    		// removemos divs creados
    		$('#modal-window').fadeOut('fast');
        	$('#mask').remove();
        	//$('#modal-window').remove();
    };
    
})(jQuery);