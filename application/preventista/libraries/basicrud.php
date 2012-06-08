<?php 

/**
 * Clase BasiCrud 
 * 
 * Esta clase contiene funciones de uso general de la aplicacion. 
 * Por ejemplos funciones de formateo de fechas, funciones de 
 * paginación de resultados, funciones de de configuración de campos a mostrar 
 * en las vistas, funciones de configuración de campos por los cuales filtrar 
 * en las vistas. 
 * Esta configurada para que se autocargue cada ves que se inicie la aplicación,
 * por los que los metodos de la misma pueden ser llamados desde cualquier controlador, 
 * vista o modelo.
 * 
 * @package libraries
 * @author applicacion
 * @version  1.0  
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BasiCrud {
	
	
	function __construct() 
	{
		$CI = & get_instance();			
	}
	
	/**
	 * Método para formatear una fecha legible para seres humanos
	 * Este  método recibe una fecha y realiza el formatéo al formato dd/mm/aaaa
	 *
	 * @param date $date		aaaa-mm-dd H:i:s	 
	 * @return date $d			dd/mm/aaaa
	 */
	function formatDateToHuman($date = '') 
	{	
		//$datestring = "%d/%m/%Y - %h:%i %a";
		$datestring = "%d/%m/%Y";
		if($date != '') return mdate($datestring,strtotime($date));
		else return '';
	}
	
	/**
	 * Método para formatear una fecha y hora legible para seres humanos 
	 * Este  método recibe unq fecha  y realiza el formatéo  al formato dd/mm/aaaa H:i:s
	 *
	 * @param date $date 		aaaa-mm-dd H:i:s
	 * @return date $d 			dd/mm/aaaa H:i:s
	 */
	function formatDateToHumanWithTime($date = '') 
	{
		$datestring = "%d/%m/%Y - %h:%i:%s";
		if($date != '') return mdate($datestring,strtotime($date));			
		else return '';
	}
	
	/**
	 * Método para formatear fecha
	 * Este método genera la fecha actual en formato aaaa-mm-dd hh:mm:ss y retorna la misma
	 *
	 * @return string $date
	 */
	function formatDateToBD() 
	{	
		$datestring = "%Y-%m-%d %H:%i:%s";
		$time = time();
	  return mdate($datestring, $time);
	}
	

	/**
	 * Método para formatear fecha
	 * Este método genera la fecha actual en formato aaaa-mm-dd hh:mm:ss y retorna la misma
	 *
	 * @return string $date
	 */
	function formatDateToBD2() 
	{	
		$datestring = "%Y%m%d_%H%i%s";
		$time = time();
	  	return mdate($datestring, $time);
	}


	/**
	 * Metodo para formatear un fecha
	 * Este metodo genera la fecha actual en formato aaaa-mm-dd  y retorna la misma
	 *
	 * @return string $date
	 */
	function getDateToBDWithOutTime() 
	{	
		$datestring = "%Y-%m-%d";
		$time = time();
	  return mdate($datestring, $time);
	}
	
	

	/**
	 * Este metodo toma un fecha con formato 00/00/0000 
	 * y lo transforma a 0000-00-00 antes de guardar en 
	 *	la bd
	 *
	 * @param string $date
	 * @return string $date
	 */
	 function getFormatDateToBD($date) {
	 	 	 	
	 	//elimina los espacios en blanco de la fecha ingresada
		$date = str_replace(" ","",$date);  
	
		$parte1=substr($date, 0, 2);
		$parte2=substr($date, 3, 2);
		$parte3=substr($date, 6, 4);
		$new_date = ($parte3."/".$parte2."/".$parte1);
		$new_date{4} = '-';
		$new_date{7} = '-';
	
		return $new_date;
	 }
	 
	/**
	 * This function getting all the fields for search of 
	 * setting file
	 *
	 * @access public
	 * @param  array		$fields       		all the fields of the table
	 * @param  string		$nameConfig       name of file config. No is required
	 * @return array 		      				fields for search
	 */
	function getFieldSearch($fields = array(),$nameConfig = '')
	{
		//code here
		$CI = & get_instance();
			
		$fieldSearch = array(); 
		foreach($fields as $field){ 
			if($CI->config->item("search_by_".$field."",$nameConfig)==1){ 
				$fieldSearch[]=$field; 
			} 
		}
		return $fieldSearch;
	}
	
	
	/**
	 * This function getting all the fields to show in the result list 
	 * of setting file 
	 *
	 * @param  array		$fields       		all the fields of the table
	 * @param  string		$nameConfig       name of file config. No is required
	 * @return array 		      				fields for search
	 */
	function getFieldToShow($fields = array(), $nameConfig = '')
	{
		//code here
		$CI = & get_instance();	
		
		$fieldShow = array(); 
		foreach($fields as $field){ 
			if($CI->config->item("show_".$field."",$nameConfig)==1){ 
				$fieldShow[]=$field; 
			} 
		}
		return $fieldShow;
	}


	/**
	 * This function get the paged data of table
	 *
	 * @param  array	$options       name of model, amount result per page
	 * @param  array	$fieldSearch   filters: fields
	 * @return string 		      	paged data 
	 */
	function getPagination($options = array(),$fieldSearch = array())
	{
		//code here
		$CI = & get_instance();	
		
		$config['base_url'] = '';
		
		if(isset($fieldSearch) && count($fieldSearch)>0){
			if($options['nameMethod'])
				$config['total_rows'] = $CI->$options['nameModel']->$options['nameMethod']($fieldSearch);
			else 
				$config['total_rows'] = $CI->$options['nameModel']->get_m($fieldSearch);
		}else {
			if(!$fieldSearch['count']) $fieldSearch['count'] = true; 
			if($options['nameMethod'])
				$config['total_rows'] = $CI->$options['nameModel']->$options['nameMethod']($fieldSearch);	
			else
				$config['total_rows'] = $CI->$options['nameModel']->get_m($fieldSearch);	
		}
   
	   	(empty($options['uri_seg'])) ? $config['uri_segment'] = 3 : $config['uri_segment'] = $options['uri_seg'];
	   
	   	$config['per_page'] = $options['perpage'];
	   
			//firt page	   	
	   	$config['first_link'] = 'Primero';
	   	$config['first_tag_open'] = '<span>';
	   	$config['first_tag_close'] = '</span>';
			//next page	   	
	   	$config['next_link'] = 'Siguiente';
	   	$config['next_tag_open'] = '<span>';
	   	$config['next_tag_close'] = '</span>';
	   	//previous page
	   	$config['prev_link'] = 'Atr&aacute;s';
	   	$config['prev_tag_open'] = '<span>';
			$config['prev_tag_close'] = '</span>';
			//last page	   	
	   	$config['last_link'] = '&Uacute;ltimo';
	   	$config['last_tag_open'] = '<span>';
	   	$config['last_tag_close'] = '</span>';
	   	
	   	$config['full_tag_open'] = "<span class=\"pag\">";
	   	$config['full_tag_close'] = "</span>";
	    	
	   	$CI->pagination->initialize($config);
	   	$links = $CI->pagination->create_links();
	   	$num_pages = $CI->pagination->num_pages;
	   
	   	if($links) $data= "Registros encontrados:&nbsp;".$config['total_rows']."&nbsp;|&nbsp;P&aacute;gina ".$CI->pagination->cur_page."&nbsp;de&nbsp;".$num_pages."&nbsp;|&nbsp;".$links;  
	   	return $data; 

	}
	
	
	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 512 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */
	function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) 
	{
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}
	
	
	/**
	 * This function generate a random string
	 *
	 * @param  integer	$lenght       lenght of string to generate
	 * @return string 		      	  string generated 
	 */
	function _random_string($lenght)
	{
		//code here
		$len = $lenght;
		$base = "ABCDEFGHYJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwz123456789";
		$max = strlen($base)-1;
		$activatecode = '';
		mt_srand((double)microtime()*1000000);
		while (strlen($activatecode)<$len+1){
			$activatecode.= $base{mt_rand(0, $max)}; 
		}
		return $activatecode;
		
	}
	
	
	/**
	 * This function send a mail 
	 *
	 * @param  string	$p_from        email from 
	 * @param  string	$p_from_name   who send the mail 
	 * @param  string	$p_to       	email to
	 * @param  string	$p_subject     email subject 
	 * @param  string	$p_message     email message
	 * @return booleam 		      	True, if mail is sent successfully
	 */
	function sendmail($p_from="turnvy@gmail.com", $p_from_name="Admin", $p_to, $p_subject="Confirmaci&oacute;n de registro", $p_message ) 
	{
		//code here
		$CI = & get_instance();	
		
		//config email parameters
		$CI->email->from($p_from, $p_from_name);
		$CI->email->to($p_to);
		$CI->email->subject($p_subject);
		$CI->email->message($p_message);
				
		if(!$CI->email->send())
		{
			return $CI->email->print_debugger(); 
		}
		else 
		{
			return "";
		}
		
	}
	
	
	/**
	 * This function make a captcha 
	 *
	 * @return image 		  A image generated
	 */
	function _make_captcha()
   {
   	//code here
		$CI = & get_instance();			
	   $CI->load->helper('captcha');

	   $vals = array(
	      'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
	      'img_url' => base_url().'captcha/', // URL for captcha img
	      'img_width' => 200, // width
	      'img_height' => 60, // height
	      // 'font_path'     => '../system/fonts/2.ttf',
	      // 'expiration' => 7200 ,
	   );

	   // Create captcha
	   $cap = create_captcha($vals);
	    
	   // Write to DB
	   if ($cap) 
	   {
	     $data = array(
	        'captcha_id' => '',
	        'captcha_time' => $cap['time'],
	        'ip_address' => $CI->input->ip_address(),
	        'word' => $cap['word'] ,
	        );
	     $query = $CI->db->insert_string( 'captcha', $data );
	     $CI->db->query( $query );
	   }
	   else
	   {
	     return "Captcha not work" ;
	   }
	   
	   return $cap['image'] ;
  }
  
  
  /**
	* This function check if captcha is correct
	*
	* @param  string	$p_captcha        Captcha entede for user 
	* @param  string	$p_ip_address     Ip address of user 
	* @return true 	if captcha is correct
	*/
  function _check_captcha($p_captcha,$p_ip_address)
  {
  	  //code here
	  $CI = & get_instance();	
		
     //Delete old data ( 2hours)
     $expiration = time()-7200 ;
     $sql = "DELETE FROM captcha WHERE captcha_time < ? ";
     $binds = array($expiration);
     $query = $CI->db->query($sql, $binds);
 
     //checking input
     $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
     $binds = array($p_captcha, $p_ip_address, $expiration);
     $query = $CI->db->query($sql, $binds);
     $row = $query->row();
 
     if ($row->count > 0)
     {
        return true;
     }
     
     return false;
 
  }
  
  
  	/**
	 * This function format the time between two date
	 *
	 * @param  integer	$time       time en minutes
	 * @return string 		      	string generated 
	 */
	function _format_time($time)
	{
		//code here
		if($time >=1440){
					
		}elseif($time >=60){
			$tmp_time = $time / 60;
			$arr_time = explode('.', $tmp_time);
			$real_time = $arr_time[0];			 
			$real_min = $time % 60;
		}else{
			$real_min = $time;
		}
  
		if($real_min == 0){				
			$real_min = '';
		}elseif($real_min == 1) {
			$real_min.= ' minuto';
		}else{
			$real_min.= ' minutos';
		}
		
		if(isset($real_time)){
			if($real_time == 1){
				$real_time.=' hora';	
			}else {
				$real_time.=' horas';
			}	
		}
		
		if(isset($real_time)) return $real_time.' '.$real_min;
		else return $real_min;
	}
	
	
	/**
	 * This function add minutes to a particular date
	 * format:  dd/mm/yyyy hh-nn-ss
	 *
	 * @param  string		$dateStr    format dd/mm/yyyy hh-nn-ss
	 * @param  string		$minToSum   eg. 10,20,30, etc.
	 * @return string 		      	new date 
	 */
	function _addMinToDate($dateStr, $minToAdd)
	{
	  $dateStr = str_replace("/", " ", $dateStr);
	  $dateStr = str_replace(":", " ", $dateStr);
		
	  $dateSource = explode(" ", $dateStr);
		
	  $day = $dateSource[0];
	  $month = $dateSource[1];
	  $year = $dateSource[2];
		
	  $hours = $dateSource[3];
	  $minutes = $dateSource[4];
	  $seconds = $dateSource[5];
		
	  // Add the minutes
	  $minutes = ((int)$minutes) + ((int)$minToAdd); 
		
	  // Assingn the modified date to a new variable
	  $newDate = date("Y-m-d H:i:s",mktime($hours,$minutes,$seconds,$month,$day,$year));
		
	  return $newDate;
	}
	
	
	/* Agregar a una fecha dias, meses o años */
	function date_add($givendate,$day=0,$mth=0,$yr=0)
	{
	  $cd = strtotime($givendate);
	  return date('Y-m-d', mktime(date('h',$cd), date('i',$cd), date('s',$cd), date('m',$cd)+$mth,  date('d',$cd)+$day, date('Y',$cd)+$yr));
	}
	 
	 
	/* calcular la diferencia entre dos fechas */
	function date_diff($start_date,$end_date,$format = 'd')
	{
	  $start_date = strtotime($start_date);
	  $end_date = strtotime($end_date);
 
	  switch ($format)
	  {
	     //seconds
	     case "s":
	         return floor(($end_date-$start_date));
	     //minutes
	     case "i":
	          return floor(($end_date-$start_date)/60);
	     //hours
	     case "h":
	          return floor(($end_date-$start_date)/3600);
	     //days
	     case "d":
	          return floor(($end_date-$start_date)/86400);
	     //months
	     case "m":
	          return floor(($end_date-$start_date)/2628000);
	     //years
	     case "y":
	          return floor(($end_date-$start_date)/31536000);
	     //days
	     default:
	          return floor(($end_date-$start_date)/86400);
	     }
	}
	 
	/* conocer la hora exacta de un determinado timezone */
	function get_date($timezone = 'America/New_York', $full_date_time = false)
	{
	    date_default_timezone_set($timezone);
	    $date = ($full_date_time) ? date('D,F j, Y, h:i:s A') : date('Y-m-d');
	    date_default_timezone_set('UTC');
	    return $date;
	}
	
	
	function array_remove_keys($array, $keys = array()) 
	{ 
  
    // If array is empty or not an array at all, don't bother 
    // doing anything else. 
    if(empty($array) || (! is_array($array))) { 
        return $array; 
    } 
  
    // If $keys is a comma-separated list, convert to an array. 
    if(is_string($keys)) { 
        $keys = explode(',', $keys); 
    } 
  
    // At this point if $keys is not an array, we can't do anything with it. 
    if(! is_array($keys)) { 
        return $array; 
    } 
  
    // array_diff_key() expected an associative array. 
    $assocKeys = array(); 
    foreach($keys as $key) { 
        $assocKeys[$key] = true; 
    } 
  
    return array_diff_key($array, $assocKeys); 
	} 


	/**
	 * Funcion para calcular precios de venta si un porcentaje fue modificado
	 *
	 * @param float $precio_compra
	 * @param integer $porcent_real
	 * @param integer $porcent_aumento
	 * @param string $operacion 
	 * @return float data
	 */
	function getPrecio1($precio_compra, $porcent_real, $porcent_aumento, $operacion)
	{
		if($operacion == 'sumar')
			$precio = $precio_compra + ($precio_compra * ($porcent_real + $porcent_aumento)) / 100;
		elseif($operacion == 'restar') $precio = $precio_compra + ($precio_compra * ($porcent_real - $porcent_aumento)) / 100;

		return $this->formatNumber($precio);
	}
	

	/**
	 * Funcion para calcular nuevo porcentaje de precios
	 * Si el usuario a ingresado un aumento del porcentaje de un precio de venta;
	 * esta funcion devuelve el nuevo valor del porcentaje que puede ser
	 * una cantidd mayor o menos al valor del porcentaje original
	 * 
	 * @param integer $porcent_real
	 * @param integer $porcent_aumento
	 * @param string $operacion
	 * @return float data
	 */
	function getPorcentaje1($porcent_real, $porcent_aumento, $operacion)
	{
		if($operacion == 'sumar')
			$nuevo_porcentaje = $porcent_real + $porcent_aumento;
		elseif($operacion == 'restar') $nuevo_porcentaje = $porcent_real - $porcent_aumento;

		return $this->formatNumber($nuevo_porcentaje);
	}
	

	/**
	 * Funcion para calcular nuevo porcentaje de un precio
	 * Si el usuario ha modificado un precio de venta y desea 
	 * actualizar solo el porcentaje de ese precio, se usa esta 
	 * funcion para realizar dicho calculo
	 *
	 * @param float $articulos_preciocompra
	 * @param float $articulos_precio        nuevo precio venta
	 * @return float data
	 */
	function getPorcentaje2($articulos_preciocompra, $articulos_precio)
	{
		return $this->formatNumber((($articulos_precio / $articulos_preciocompra) - 1) * 100);
	}


	function getPrecioCompra($precioventa, $porcentaje)
	{
		return $this->formatNumber($precioventa / (($porcentaje / 100) + 1));
	}

	function getPrecio2($preciocompra, $porcentaje)
	{
		return $this->formatNumber($preciocompra + (($preciocompra * $porcentaje)/100));
	}

	function formatNumber($num)
	{	
		return number_format($num,2);
	}

	function calcPrecioCompra($porcentaje,$articulos_preciocompra, $operacion)
	{
		if($operacion == '+')
			$nuevo_precio = $articulos_preciocompra + (($articulos_preciocompra * $porcentaje)/100);
		else
			$nuevo_precio = $articulos_preciocompra - (($articulos_preciocompra * $porcentaje)/100);
		return $nuevo_precio;
	}

	function getOneMarcaToSearch($marcas = array())
	{
		$flag = array();
		if(count($marcas) > 0){
			foreach ($marcas as $f ) {
				if($f == "") $flag[] = true;
			}
			if(count($flag)>0)
				$marcatosearch = $marcas[count($marcas)-2];
			else $marcatosearch = $marcas[count($marcas)-1];
			
			return $marcatosearch;
		}
		return "";
	}


	function getMarca($parent=0, $d = array())
	{
		$CI = & get_instance();	
		$query_str = "select * from marcas as m 
		where m.marcas_parent =$parent and m.marcas_estado=1";
		
		$query_a = $CI->db->query($query_str);
		
		if($query_a->num_rows()>0)
		{		
			foreach($query_a->result() as $field)
			{
				$data[] = $field->marcas_descripcion;		
				$this->getMarca($field->marcas_id); 	
			}
		} else echo $data;
	}


	function setFileName($string) 
	{ 
	    /*if( ! isset($length) or ! is_numeric($length) ) $length=6; 
	     
	    $str  = "0123456789abcdefghijklmnopqrstuvwxyz"; 
	    $path = ''; 
	     
	    for($i=1 ; $i<$length ; $i++) 
	      $path .= $str{rand(0,strlen($str)-1)}; 
		*/
	    return $string.'_'.date("d-m-Y_H-i-s");     
	}


	function updateEstadoContable($clientes_id, $haber, $debe)
	{
		$CI = & get_instance();
		$cuentacorriente = $CI->cuentacorriente_model->edit_m(
						array('clientes_id' => $clientes_id, 'cuentacorriente_haber' => $haber, 
							'cuentacorriente_debe' => $debe, 'cuentacorriente_updated_at' => $this->formatDateToBD()));
	}


	function calcDeudaCliente($recibo = array())
	{
		$CI = & get_instance();
		//consultar todos los pedidos del cliente con estado entregado o parcialmente pagado
		$pedidos = $CI->pedidos_model->get2_m(array('clientes_id' => $recibo['clientes_id'], 'pedidos_estado1' => 8,'pedidos_estado2' => 15));
		$cc = $CI->cuentacorriente_model->get_m(array('clientes_id' => $recibo['clientes_id']));
		if($cc)
		{
			$saldo = $recibo['recibos_monto'];
			$flag = true;

			if(isset($pedidos) && is_array($pedidos) && count($pedidos) > 0 )
			{
				//comprobamos si existe saldo negativo en la cuenta corriente del cliente
				// si existe lo sumamos al monto del recibo ingresado
				if($cc[0]->cuentacorriente_debe < 0)
					$saldo = $saldo + ($cc[0]->cuentacorriente_debe * (-1));

				foreach ($pedidos as $f) 
				{
					if($flag)
					{
						//verifico si existe montoadeudado
						if($f->pedidos_montoadeudado > 0) $saldo = $saldo - $f->pedidos_montoadeudado;
						else $saldo = $saldo - $f->peididos_montototal;

						if($saldo >= 0){
							$pr['pedidos_id'] = $f->pedidos_id;
							$pr['recibos_id'] = $recibo['recibos_id'];
							$pr['pedidosrecibos_montocubierto'] =$f->peididos_montototal;
							$pedidosrecibos = $CI->pedidosrecibos_model->add_m($pr);
							$pedido = $CI->pedidos_model->edit_m(array('pedidos_id' => $f->pedidos_id, 'pedidos_estado' => 16, 'pedidos_montoadeudado' => 0)); // estado de pedido = pagado y entregado
							if($saldo == 0) $flag = false;
						}else{	
							$porcobrar = $saldo * (-1);
							$pagoparcial = $f->peididos_montototal - $porcobrar;
							$pr['pedidos_id'] = $f->pedidos_id;
							$pr['recibos_id'] = $recibo['recibos_id'];
							$pr['pedidosrecibos_montocubierto'] = $pagoparcial;
							$pedidosrecibos = $CI->pedidosrecibos_model->add_m($pr);
							if($porcobrar != $f->peididos_montototal )
								$pedido = $CI->pedidos_model->edit_m(array('pedidos_id' => $f->pedidos_id, 'pedidos_estado' => 15, 'pedidos_montoadeudado' => $porcobrar)); // estado de pedido = entregado y parcialmente pagado
							$flag = false;
						}
					}	
				}
				if($saldo > 0){
					$haber = $CI->pedidos_model->getSumPedidos1($recibo['clientes_id']);
					$debe = $CI->pedidos_model->getSumPedidos2($recibo['clientes_id']) - $saldo;
					$this->updateEstadoContable($recibo['clientes_id'], $haber, $debe);
				}else{
					$haber = $CI->pedidos_model->getSumPedidos1($recibo['clientes_id']);
					$debe = $CI->pedidos_model->getSumPedidos2($recibo['clientes_id']);
					$this->updateEstadoContable($recibo['clientes_id'], $haber, $debe);
				}
			}else{
				$haber = $CI->pedidos_model->getSumPedidos1($recibo['clientes_id']);
				if($cc[0]->cuentacorriente_debe < 0) $debe = $cc[0]->cuentacorriente_debe - $saldo;
				else $debe = $CI->pedidos_model->getSumPedidos2($recibo['clientes_id']) - $saldo;
				$this->updateEstadoContable($recibo['clientes_id'], $haber, $debe);
			}
			return true;
		}

		return true;
	}


	/**
	 * Función para formatear un sentencia INSERT correctamente
	 * @return query insert 
	 */
	function writeAddSqlToLog($options = array())
	{ 
		$new_string1 = str_replace("`", '',$options['string']);
		$new_string2 = str_replace($options['search']."id", '_id',$new_string1);
		return str_replace($options['search'], '', $new_string2);
		
	}


	/**
	 * Función para formatear un sentencia INSERT correctamente
	 * @return query insert 
	 */
	function writeAddSqlToLogWithoutId($options = array())
	{
		$table = substr($options['search'],0,-1);   

		$new_string1 = str_replace("`$table` (", "$table (_id, ", $options['string']);
		$new_string2 = str_replace("`", '',$new_string1);
		$new_string3 = str_replace("VALUES (", "VALUES ('".$options['new_id']."', ", $new_string2);
		
		return str_replace($options['search'], '', $new_string3);
		
	}

	/**
	 * Función para formatear un sentencia UPDATE correctamente
	 * @return query update 
	 */
	function writeEditSqlToLog($options = array())
	{
		$new_string1 = str_replace($options['search']."id", '_id', $options['string']);
		$new_string2 = str_replace("`", '', $new_string1);
		return $new_string3 = str_replace($options['search'], '', $new_string2);
		
	}


	/**
	 * Función para formatear un sentencia DEÑETE correctamente
	 * @return query delete 
	 */
	function writeDeleteSqlToLog($options = array())
	{
		$new_string1 = str_replace($options['search']."id", '_id', $options['string']);
		$new_string2 = str_replace("`", '', $new_string1);
		$new_string3 = str_replace($options['search'], '', $new_string2);
		return preg_replace('/\n+/', ' ', $new_string2);
	}


	/**
	 * Función para para escribir la sentencia sql pasada como parámetro a un archivo de log
	 * @param string row query (INSERT, UPDATE, DELETE) 
	 */
	function writeFileLog($row)
	{
		if ( ! write_file('./logsql/log_sql_cloud.txt', $row."\n", FOPEN_READ_WRITE_CREATE))
		{
		    log_message("error","Unable to write the Sql Log cloud file");
		}
		else
		{
			log_message("info","Sql Log cloud file written!");
		}
	}	
}
