<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hojaruta_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('hojaruta_model');
		$this->load->model('hojarutadetalle_model');
		$this->load->model('pedidos_model');
		$this->load->model('deudas_model');
		$this->load->model('pedidodetalle_model');
		$this->load->model('remitos_model');
		$this->load->model('fleteros_model');
		$this->load->model('tabgral_model');
		$this->load->model('clientes_model');  
		$this->load->model('pagos_model');
		$this->load->model('gastos_model');
		$this->config->load('hojaruta_settings');
		$data['flags'] = $this->basicauth->getPermissions('hojaruta');
		$this->flagR = $data['flags']['flag-read'];
		$this->flagI = $data['flags']['flag-insert'];
		$this->flagU = $data['flags']['flag-update'];
		$this->flagD = $data['flags']['flag-delete'];
		$this->flags = array('r'=>$this->flagR, 'i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['hojarutaestados'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 4)); //estados hojas de ruta
			$data['fleteros'] = $this->fleteros_model->get_m();
			//$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->hojaruta_model->getFieldsTable_m());
			$this->load->view('hojaruta_view/home_hojaruta', $data);
			$this->search_c();
		}

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for saving 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function add_c()
	{
		//code here
		if(!$this->flagI){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		
		if($this->uri->segment(3)) {
			$data['arrKeys'] = explode(",", $this->uri->segment(3)); //ids de pedidos
			if($this->checkEstado($data['arrKeys']))
				$data['error_message'] = $this->config->item("hojaruta_flash_errorX2_message");
		}else $data['arrKeys'] =$this->input->post('pedidos_id');

		$this->form_validation->set_rules('fleteros_id', 'fleteros_id', 'trim|required|integer|xss_clean');
		if($this->form_validation->run())
		{	
			$data_hojaruta  = array();
			
			$data_hojaruta['fleteros_id'] = $this->input->post('fleteros_id');
			$data_hojaruta['usuarios_id'] = $this->session->userdata('usuarios_id');
			$data_hojaruta['hojaruta_estado'] = 10; //estado igual a Planteada
			$data_hojaruta['hojaruta_created_at'] = $this->basicrud->formatDateToBD();
			$data_hojaruta['hojaruta_updated_at'] = $this->basicrud->formatDateToBD();
			$data['arrKeys'] =$this->input->post('pedidos_id');

			$id_hojaruta = $this->hojaruta_model->add_m($data_hojaruta);
			if($id_hojaruta)
			{ 
				$pedidos_ids = $this->input->post('pedidos_id');
				for($i=0; $i<count($pedidos_ids); $i++)
				{
					$data_hojarutadetalle = array('hojaruta_id' => $id_hojaruta, 'pedidos_id' => $pedidos_ids[$i], 'hojarutadetalle_updated_at' => $this->basicrud->formatDateToBD());
					$id_hojarutadetalle = $this->hojarutadetalle_model->add_m($data_hojarutadetalle);
					if($id_hojarutadetalle) 
						if(!$this->pedidos_model->edit_m(array('pedidos_id' => $pedidos_ids[$i],'pedidos_estado' => 7))) //estado de pedido 'Asignado'
							$checkError[] = 1;
				}
				
				if(count($checkError) > 0 ){
					$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_message')); 
					redirect('pedidos_controller','location');
				}else{
					$this->session->set_flashdata('flashConfirm', $this->config->item('hojaruta_flash_add_message')); 
					redirect('hojaruta_controller','location');	
				}
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_message')); 
				redirect('pedidos_controller','location');
			}
		}else{
			$data['fleteros'] = $this->fleteros_model->get_m();
			$this->load->view('hojaruta_view/form_add_hojaruta',$data);
		}

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($hojaruta_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['hojaruta'] = $this->hojaruta_model->get_m(array('hojaruta_id' => $hojaruta_id),$flag=1);
		if($data['hojaruta']->hojaruta_estado <> 10)
			$data["error_message"] = $this->config->item("hojaruta_flash_errorX3_message");
		else {
			$data['flag'] = $this->flags;
			$data['fleteros'] = $this->fleteros_model->get_m();
			$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array('hojaruta_id' => $hojaruta_id));
		}

		$this->form_validation->set_rules('hojaruta_id', 'hojaruta_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('fleteros_id', 'fleteros_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('usuarios_id', 'usuarios_id', 'trim|integer|xss_clean');
		if($this->form_validation->run())
		{
			$data_hojaruta  = array();
			$data_hojaruta['hojaruta_id'] = $this->input->post('hojaruta_id');
			$data_hojaruta['fleteros_id'] = $this->input->post('fleteros_id');
			$data_hojaruta['usuarios_id'] = $this->input->post('usuarios_id');
			$data_hojaruta['hojaruta_estado'] = $this->input->post('hojaruta_estado');
			$data_hojaruta['hojaruta_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->hojaruta_model->edit_m($data_hojaruta)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('hojaruta_flash_edit_message')); 
				redirect('hojaruta_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_message')); 
				redirect('hojaruta_controller','location');
			}
		}else{
			$this->load->view('hojaruta_view/form_edit_hojaruta',$data);
		}
	}


	/**
	 * This function show a record and send the data ti the view
	 *
	 * @access public
	 * @param integer $hojaruta_id
	 * @return void
	 */
	function show_c($hojaruta_id)
	{
		//code here
		if(!$this->flagR){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($hojaruta_id){
			$data = array();
			$data['subtitle'] = $this->config->item('recordShowTitle');
			$data['flag'] = $this->flags;
			$data['hojaruta'] = $this->hojaruta_model->get_m(array('hojaruta_id' => $hojaruta_id),$flag=1);
			$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array('hojaruta_id' => $hojaruta_id));
			$data['gastos'] = $this->gastos_model->get_m(array('hojaruta_id' => $hojaruta_id));
			$this->load->view('hojaruta_view/form_show_hojaruta',$data);
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_message')); 
			redirect('hojaruta_controller','location');
		}
	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $hojaruta_id id of record
	 * @return void
	 */
	function delete_c($hojaruta_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		$hojaruta = $this->hojaruta_model->get_m(array('hojaruta_id' => $hojaruta_id));
		
		//verificamos que el estado de la hoja de ruta sea 'planteada'
		if($hojaruta[0]->hojaruta_estado == 10)
		{

			$hojarutadetalle = $this->hojarutadetalle_model->get_m(array('hojaruta_id' => $hojaruta_id));
			//verificamos que haya lineas de la hoja de ruta seleccionada
			if(count($hojarutadetalle) > 0)
			{
				foreach ($hojarutadetalle as $f) {
					//cambiamos estado de pedido a 'Solicitado'
					$state = $this->pedidos_model->edit_m(array('pedidos_id' => $f->pedidos_id, 'pedidos_estado' => 6));
				}
				if($this->hojaruta_model->delete_m($hojaruta_id)){ 
					$this->session->set_flashdata('flashConfirm', $this->config->item('hojaruta_flash_delete_message')); 
					redirect('hojaruta_controller','location');
				}else{
					$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_delete_message')); 
					redirect('hojaruta_controller','location');
				}
			}else{
				if($this->hojaruta_model->delete_m($hojaruta_id)){ 
					$this->session->set_flashdata('flashConfirm', $this->config->item('hojaruta_flash_delete_message')); 
					redirect('hojaruta_controller','location');
				}else{
					$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_delete_message')); 
					redirect('hojaruta_controller','location');
				}
			}
		
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_delete_message')); 
			redirect('hojaruta_controller','location');
		}

	}


	/**
	 * This function filter and sends the data to the view
	 * to shows the found result
	 *
	 * @access public
	 * @return void
	 */
	function search_c($offset = 0)
	{
		//code here
		$data = array(); 
		$fieldSearch = array(); 
		$data_search_hojaruta = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_hojaruta  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->hojaruta_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_hojaruta[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_hojaruta['limit'] = $this->config->item('pag_perpage');
			$data_search_hojaruta['offset'] = $offset;
			$data_search_hojaruta['sortBy'] = 'hojaruta_created_at';
			$data_search_hojaruta['sortDirection'] = 'desc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'hojaruta_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['hojaruta'] = $this->hojaruta_model->get_m($data_search_hojaruta);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'hojaruta_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['hojaruta'] = $this->hojaruta_model->get_m($data_search_hojaruta);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->hojaruta_model->getFieldsTable_m());
			$this->load->view('hojaruta_view/record_list_hojaruta',$data);
		}

	}


	function checkEstado($estados = array())
	{
		$checkResult = array();
		foreach ($estados as $f) {
			$pedido = $this->pedidos_model->get_m(array('pedidos_id' => $f));
			if($pedido[0]->pedidos_estado <> 6) $checkResult[] = 1;	//estado 6 igual a Solicitado
		}
		if(count($checkResult) > 0) return true;
		else false; 
	}

	function checkEstadoHojaRuta($estados = array())
	{
		$checkResult = array();
		foreach ($estados as $f) {
			$hojaruta = $this->hojaruta_model->get_m(array('hojaruta_id' => $f));
			if($hojaruta[0]->hojaruta_estado <> 10) $checkResult[] = 1;	//estado 10 igual a Planteada
		}
		if(count($checkResult) > 0) return true;
		else false; 
	}

	function showPrintSeleccion_c()
	{
		if($this->uri->segment(3)) {
			$data['arrKeys'] = explode(",", $this->uri->segment(3)); //ids de pedidos
			if($this->checkEstadoHojaRuta($data['arrKeys']))
				$data['error_message'] = $this->config->item("hojaruta_flash_errorX4_message");
		}
		$this->load->view('hojaruta_view/form_print_hojaruta',$data);
	}


	function printSeleccion_c()
	{
		$checkResult1 = array(); $checkResult2 = array();

		$hojaruta_ids =$this->input->post('hojaruta_ids');

		foreach ($hojaruta_ids as $f) 
		{
			$hojarutadetalle = $this->hojarutadetalle_model->get_m(array("hojaruta_id" => $f));
			if($hojarutadetalle)
			{
				foreach ($hojarutadetalle as $g) 
				{
					$remito_id = $this->remitos_model->add_m(array("hojarutadetalle_id" => $g->hojarutadetalle_id, "remitos_estado" =>12)); // estado 12 igual a 'En curso'
					if(!$remito_id) $checkResult[] = 1;
				}

				$stateHojaRuta = $this->hojaruta_model->edit_m(array('hojaruta_id' => $f, 'hojaruta_estado' => 11)); //estado 11 igual a 'Ejecutada'
				if(count($checkResult1) > 0 || !$stateHojaRuta) $checkResult2[] = 1;
			}	
		}

		if(count($checkResult2) > 0){
			$this->session->set_flashdata('flashError', $this->config->item('hojaruta_flash_error_print_message')); 
			redirect('hojaruta_controller','location');
		}else{
			$this->setPrintSeleccion2_c($hojaruta_ids);
		}
		
	}


	/**
	* Esta función me permite generar un pdf de una o varias hojas de rutas. 
	* Por cada hoja de ruta se genera los remitos correspondientes de 
	* cada pedido tambien en formato pdf. Todo estos documentos impresos
	* son encapsulados dentro de un archivo .zip que es finalmente el que 
	* se descarga.
	*/ 
	function setPrintSeleccion_c($hojaruta_ids = array())
	{
		$this->load->library('zip');
		$this->load->helper(array('dompdf', 'file'));
		$data2 =  array();
		$data["todayDate"] = $this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime());
		$cant = count($hojaruta_ids);
		
		foreach ($hojaruta_ids as $f) 
		{
			$data['hojaruta'] = $this->hojaruta_model->get_m(array("hojaruta_id" => $f), $flag = 1);
			$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array("hojaruta_id" => $f));
			if($data['hojarutadetalle'])
			{
				//page info here, db calls, etc.     
    			$html = $this->load->view('hojaruta_view/record_list_to_print', $data, true);
    			$pdf = pdf_create($html,'hojaruta_'.$f,'a5','','./pdfs/',false);
    			$data2['hojaruta_'.$f.".pdf"] = $pdf;

    			foreach($data['hojarutadetalle'] as $g)
    			{
    				$data['pedido'] = $this->pedidos_model->get_m(array("pedidos_id" => $g->pedidos_id));
    				$data['cliente'] = $this->clientes_model->get_m(array("clientes_id" => $data['pedido'][0]->clientes_id));
					$data['remito'] = $this->remitos_model->get_m(array("hojarutadetalle_id" => $g->hojarutadetalle_id));
					$data['pedidodetalle'] = $this->pedidodetalle_model->get_m(array("pedidos_id" => $g->pedidos_id, 'clientescategoria_id' => $data['cliente'][0]->clientescategoria_id));
					$data["pedidosadeudados"] = $this->pedidos_model->getPedidosAdeudados2_m(array(
						"clientes_id" => $data['pedido'][0]->clientes_id,
						'remitos_created_at' => $data['remito'][0]->remitos_created_at_without_format));
					$data["saldocliente"] = $this->getSaldoCliente(
						$data['pedido'][0]->clientes_id, 
						$data['pedido'][0]->pedidos_created_at_without_format);

					$html = $this->load->view('remitos_view/record_list_to_print', $data, true);
    				$pdf = pdf_create($html,'remito_'.$data['remito'][0]->remitos_id,'a5','','./pdfs/',false);
    				$data2['remitos_'.$data['remito'][0]->remitos_id.".pdf"] = $pdf;
    			}
	    	}	
		}
			
		$this->zip->add_data($data2);
		$this->zip->download($this->basicrud->setFileName('HojaRutas').".zip");

	}


	/**
	* Esta función me permite generar un txt de una o varias hojas de rutas. 
	* Por cada hoja de ruta se genera los remitos correspondientes de 
	* cada pedido. Todo esto se coloca en un solo archivo txt para su descarga
	*/ 
	function setPrintSeleccion2_c($hojaruta_ids = array())
	{
		$this->load->helper('download');
		$html = '';
		$data["todayDate"] = $this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime());
		$cant = count($hojaruta_ids);
		
		foreach ($hojaruta_ids as $f) 
		{
			$data['hojaruta'] = $this->hojaruta_model->get_m(array("hojaruta_id" => $f), $flag = 1);
			$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array("hojaruta_id" => $f));
			if($data['hojarutadetalle'])
			{
				//page info here, db calls, etc.     
    			$html.= $this->load->view('hojaruta_view/record_list_to_print_txt', $data, true);

    			foreach($data['hojarutadetalle'] as $g)
    			{
    				$data['pedido'] = $this->pedidos_model->get_m(array("pedidos_id" => $g->pedidos_id));
    				$data['cliente'] = $this->clientes_model->get_m(array("clientes_id" => $data['pedido'][0]->clientes_id));
					$data['remito'] = $this->remitos_model->get_m(array("hojarutadetalle_id" => $g->hojarutadetalle_id));
					$data['pedidodetalle'] = $this->pedidodetalle_model->get_m(array("pedidos_id" => $g->pedidos_id, 'clientescategoria_id' => $data['cliente'][0]->clientescategoria_id));
					$data["pedidosadeudados"] = $this->pedidos_model->getPedidosAdeudados2_m(array(
						"clientes_id" => $data['pedido'][0]->clientes_id,
						'remitos_created_at' => $data['remito'][0]->remitos_created_at_without_format));
					$data["saldocliente"] = $this->getSaldoCliente(
						$data['pedido'][0]->clientes_id, 
						$data['pedido'][0]->pedidos_created_at_without_format);

					$html.= $this->load->view('remitos_view/record_list_to_print_txt', $data, true);
    			}
	    	}	
		}

		$data = $html;
		$name = $this->basicrud->setFileName('HojaRutas').".txt";
		force_download($name, $data);
	}


	function showFormEvaluarMain_c($hojaruta_id)
	{
		$data["hojaruta_id"] = $hojaruta_id;
		$this->load->view('hojaruta_view/form_evaluacion_main',$data);
	}

	function showFormEvaluar_c($hojaruta_id)
	{
		$data['hojaruta_id'] = $hojaruta_id;
		$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array('hojaruta_id' => $hojaruta_id));
		$this->load->view('hojaruta_view/form_evaluacion_main',$data);
	}

	
	/**
	* Esta función me permite evaluar cada uno de los items de una 
	* hoja de ruta. Ademas cambias los estado de cada pedido, remitos
	* y la misma hoja de ruta. Si existen montos recibimos, aqui se 
	* actualiza la cuenta corriente de cada cliente asociada a cada pedido.
	*/
	function evaluar_c()
	{
		$this->load->model('cuentacorriente_model'); 
		$this->load->model('pagospedidos_model');
		$this->load->model('pagosdeudas_model');

		$flag = false; $i = 0; $data = array();
		$hojaruta_id = $this->input->post('hojaruta_id');
		$pedidos_id = $this->input->post('pedidos_id');
		$hojarutadetalle_id = $this->input->post('hojarutadetalle_id');
		$chkEvaluacionHojaRuta = $this->input->post('chkEvaluacionHojaRuta');
		$monto_recibido = $this->input->post('monto_recibido');
		
		//datos de gastos
		$gdescrip = $this->input->post("gdescrip");
		$gmontos = $this->input->post("gmontos");
		
		//datos de pagos casuales
		$pclientes_id = $this->input->post("pclientes_id");
		$pmontos = $this->input->post("pmontos");
		
		
		foreach ($pedidos_id as $f) 
		{
			$remitos_id = $this->remitos_model->get_m(array('hojarutadetalle_id' => $hojarutadetalle_id[$i]));
			if(isset($chkEvaluacionHojaRuta) && is_array($chkEvaluacionHojaRuta) && count($chkEvaluacionHojaRuta) > 0)
			{
				foreach ($chkEvaluacionHojaRuta as $g) {
					if($f == $g) $flag = true;
				}
			}
			if($flag){
				$remito = $this->remitos_model->edit_m(array('remitos_id' => $remitos_id[0]->remitos_id, 'remitos_estado' => 13)); // estado de remito = entregado
				$data['remitos_status'][] = "Se actualiz&oacute; el estado del remito: ". $remitos_id[0]->remitos_id." a <strong>'Entregado'</strong>";
				$pedido = $this->pedidos_model->edit_m(array('pedidos_id' => $f, 'pedidos_estado' => 8)); //estado de pedido = entregado
				$data['pedidos_status'][] = "Se actualiz&oacute; el estado del pedido: ".$f." a <strong>'Entregado'</strong>";
				$this->inPago($monto_recibido[$i], $f);
			}
			else {
				$remito = $this->remitos_model->edit_m(array('remitos_id' => $remitos_id[0]->remitos_id, 'remitos_estado' => 14)); // estado de remito = cancelado
				$data['remitos_status'][] = "Se actualiz&oacute; el estado del remito: ".$remitos_id[0]->remitos_id." a <strong>'Cancelado'</strong>";
				$pedido = $this->pedidos_model->edit_m(array('pedidos_id' => $f, 'pedidos_estado' => 6)); //estado de pedido = solicitado
				$data['pedidos_status'][] = "Se actualiz&oacute; el estado del pedido: ".$f." a <strong>'Solicitado'</strong>";
			}
			
			$flag = false;
			$i++;
		}

		$hojaruta = $this->hojaruta_model->edit_m(array('hojaruta_id' => $hojaruta_id, 'hojaruta_estado' => 25)); //estado de hoja de ruta = finalizada
		$data['hojaruta_status'] = "Se actualiz&oacute; el estado de la Hoja de ruta: ".$hojaruta_id." a <strong>'Finalizada'</strong>";

		//cargamos los gastos ingresados
		$this->cargarGastos($gdescrip, $gmontos, $hojaruta_id);
		//cargamos los pagos casuales ingresados
		$this->cargarPagosCasuales($pclientes_id, $pmontos);
		
		$this->load->view('hojaruta_view/result_evaluacion', $data);

		/*echo "<pre>";
		print_r($monto_recibido);
		echo "</pre>";
		echo "<pre>";
		print_r($pclientes_id);
		echo "</pre>";
		echo "<pre>";
		print_r($pmontos);
		echo "</pre>";
		echo "<pre>";
		print_r($gmontos);
		echo "</pre>";
		echo "<pre>";
		print_r($gdescrip);
		echo "</pre>";*/


	}


	/**
	 * Esta función permite cargar los pagos segun los montos ingresados de cada pedido
	 * @param float $monto 	monto recibido de un pedido en especial
	 * @param integer $pedidos_id 	pedido del cual se ingreso un monto recibido
	 * @access public
	 * @return void
	 */
	function inPago($monto, $pedidos_id)
	{
		$pedido = $this->pedidos_model->get_m(array('pedidos_id' => $pedidos_id));

		if(count($pedido) > 0){
			if($monto != ''){
				$data_pagos['pagos_id'] = $this->preferences->getNextId('pagos_next_id');
				$data_pagos['pagos_monto'] = $monto;
				$data_pagos['clientes_id'] = $pedido[0]->clientes_id;
				$data_pagos['usuarios_id'] = $this->session->userdata("usuarios_id");
				$data_pagos['pagos_fechaingreso'] = $this->basicrud->formatDateToBD();
				$data_pagos['pagos_updated_at'] = $this->basicrud->formatDateToBD();

				if($id_pagos = $this->pagos_model->add_m($data_pagos)){
					$data_pagos['pagos_id'] = $id_pagos;
					$this->preferences->editNextId('pagos_next_id',$id_pagos);
					$estado = $this->basicrud->calcDeudaCliente($data_pagos);
				}
			}else{
				$cc = $this->cuentacorriente_model->get_m(array('clientes_id' => $pedido[0]->clientes_id));
				$haber = $this->pedidos_model->getSumPedidos1($pedido[0]->clientes_id) + $this->deudas_model->getSumDeudas1($pedido[0]->clientes_id);
				$debe = $this->pedidos_model->getSumPedidos2($pedido[0]->clientes_id) + $this->deudas_model->getSumDeudas2($pedido[0]->clientes_id);
				$this->basicrud->updateEstadoContable($pedido[0]->clientes_id, $haber, $debe);
			}

		}
	}


	/**
	 * Esta función permite cargar los gastos ingresados en la interfaz
	 * @param array $gdescrip 	un array con las descripciones de los gastos
	 * @param array $gmontos 	un array con los montos ingresados de cada gasto
	 * @param integer $hojaruta_id 	cada gasto tiene asociado una hoja de ruta 
	 * @access public
	 * @return void
	 */
	function cargarGastos($gdescrip, $gmontos, $hojaruta_id)
	{
		for($i=0; $i<count($gmontos); $i++){
			$data_gastos['gastos_descripcion'] = $gdescrip[$i];
			$data_gastos['hojaruta_id'] = $hojaruta_id;
			$data_gastos['gastos_monto'] = $gmontos[$i];
			$data_gastos['gastos_updated_at'] = $this->basicrud->formatDateToBD();
			$id_gastos = $this->gastos_model->add_m($data_gastos);
		}
	}


	/**
	 * Esta función permite ingresar todos los pagos casuales ingresados
	 * y calcular la deudo correspondiente de cada cliente
	 * @param array $clientes_id 	un array con los id de los clientes
	 * @param array $pmontos 	un array con los montos ingresados
	 * @access public
	 * @return void
	 */
	function cargarPagosCasuales($pclientes_id = array(), $pmontos = array())
	{
		if($pclientes_id)
		{
			for($i=0; $i<count($pclientes_id); $i++)
			{
				$data_pagos  = array();
				$data_pagos['pagos_id'] = $this->preferences->getNextId('pagos_next_id');
				$data_pagos['pagos_monto'] = $pmontos[$i];
				$data_pagos['clientes_id'] = $pclientes_id[$i];
				$data_pagos['usuarios_id'] = $this->session->userdata("usuarios_id");
				$data_pagos['pagos_updated_at'] = $this->basicrud->formatDateToBD();

				if($id_pagos = $this->pagos_model->add_m($data_pagos)){
					$data_pagos['pagos_id'] = $id_pagos;
					$this->preferences->editNextId('pagos_next_id',$id_pagos);				
					if($this->basicrud->calcDeudaCliente($data_pagos)){
						$data['pago'] = $data_pagos;
					}
				}
			}
			echo "<pre>";
			print_r($pclientes_id);
			echo "</pre>";
		}
	}


	/**
	* Esta función permite descargar en pdf una hoja de ruta 
	*/
	function printOnlyHojaRuta($hojaruta_id)
	{
		$this->load->helper(array('dompdf', 'file'));
		
		if($hojaruta_id){
			$data['hojaruta'] = $this->hojaruta_model->get_m(array("hojaruta_id" => $hojaruta_id), $flag = 1);
			if($data['hojaruta']){
				$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array("hojaruta_id" => $hojaruta_id));

				$html = $this->load->view('hojaruta_view/record_list_to_print', $data, true);
				pdf_create($html,'HojaRuta_'.$hojaruta_id,'a5');
			}
		}
	}


	/**
	* Esta función permite descargar un txt de una hoja de ruta 
	*/
	function printOnlyHojaRuta2($hojaruta_id)
	{
		$this->load->helper('download');
		
		if($hojaruta_id){
			$data['hojaruta'] = $this->hojaruta_model->get_m(array("hojaruta_id" => $hojaruta_id), $flag = 1);
			if($data['hojaruta']){
				$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array("hojaruta_id" => $hojaruta_id));

				$html = $this->load->view('hojaruta_view/record_list_to_print_txt', $data, true);
				$data = $html;
				$name = 'HojaRuta_'.$hojaruta_id.".txt";
				force_download($name, $data);
			}
		}
	}


	/**
	* Esta función permite descargar en pdf los remitos  
	* de las lineas de una hoja de ruta seleccionadas
	*/
	function printRemitos($hojaruta_id,$list)
	{
		$this->load->library('zip');
		$this->load->helper(array('dompdf', 'file'));
		$data2 = array();

		//lista de todas las lineas de hojas de rutas seleccionadas para 
		//imprimir su remito
		$list = explode(",",urldecode($list));

		
		if(count($list)>0)
		{
			$data['hojaruta'] = $this->hojaruta_model->get_m(array('hojaruta_id' => $hojaruta_id),$flag = 1);
			for ($i=0; $i < count($list); $i++) 
			{ 
				$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array("hojarutadetalle_id" => $list[$i]));
				foreach($data['hojarutadetalle'] as $g)
				{
					$data['pedido'] = $this->pedidos_model->get_m(array("pedidos_id" => $g->pedidos_id));
					$data['cliente'] = $this->clientes_model->get_m(array("clientes_id" => $data['pedido'][0]->clientes_id));
					$data['remito'] = $this->remitos_model->get_m(array("hojarutadetalle_id" => $g->hojarutadetalle_id));
					$data['pedidodetalle'] = $this->pedidodetalle_model->get_m(array("pedidos_id" => $g->pedidos_id, 'clientescategoria_id' => $data['cliente'][0]->clientescategoria_id));
					$data["pedidosadeudados"] = $this->pedidos_model->getPedidosAdeudados2_m(array(
						"clientes_id" => $data['pedido'][0]->clientes_id,
						'remitos_created_at' => $data['remito'][0]->remitos_created_at_without_format));
					$data["saldocliente"] = $this->getSaldoCliente(
						$data['pedido'][0]->clientes_id, 
						$data['pedido'][0]->pedidos_created_at_without_format);

					$html = $this->load->view('remitos_view/record_list_to_print', $data, true);
					$pdf = pdf_create($html,'remito_'.$data['remito'][0]->remitos_id,'a5','','./pdfs/',false);
					$data2['remitos_'.$data['remito'][0]->remitos_id.".pdf"] = $pdf;
				}

			}

			$this->zip->add_data($data2);
			$this->zip->download($this->basicrud->setFileName('Remitos').".zip");
			
		}
    	
	}



	/**
	* Esta función permite generar un txt con todos los remitos  
	* de las lineas de una hoja de ruta seleccionadas
	*/
	function printRemitos2($hojaruta_id,$list)
	{
		$this->load->helper('download');
		$html = '';

		//lista de todas las lineas de hojas de rutas seleccionadas para 
		//imprimir su remito
		$list = explode(",",urldecode($list));

		
		if(count($list)>0)
		{
			$data['hojaruta'] = $this->hojaruta_model->get_m(array('hojaruta_id' => $hojaruta_id),$flag = 1);
			for ($i=0; $i < count($list); $i++) 
			{ 
				$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array("hojarutadetalle_id" => $list[$i]));
				foreach($data['hojarutadetalle'] as $g)
				{
					$data['pedido'] = $this->pedidos_model->get_m(array("pedidos_id" => $g->pedidos_id));
					$data['cliente'] = $this->clientes_model->get_m(array("clientes_id" => $data['pedido'][0]->clientes_id));
					$data['remito'] = $this->remitos_model->get_m(array("hojarutadetalle_id" => $g->hojarutadetalle_id));
					$data['pedidodetalle'] = $this->pedidodetalle_model->get_m(array("pedidos_id" => $g->pedidos_id, 'clientescategoria_id' => $data['cliente'][0]->clientescategoria_id));
					$data["pedidosadeudados"] = $this->pedidos_model->getPedidosAdeudados2_m(array(
						"clientes_id" => $data['pedido'][0]->clientes_id,
						'remitos_created_at' => $data['remito'][0]->remitos_created_at_without_format));
					$data["saldocliente"] = $this->getSaldoCliente(
						$data['pedido'][0]->clientes_id, 
						$data['pedido'][0]->pedidos_created_at_without_format);

					$html.= $this->load->view('remitos_view/record_list_to_print_txt', $data, true);
				}

			}

			$data = $html;
			$name = $this->basicrud->setFileName('Remitos').".txt";
			force_download($name, $data);


			
		}
    	
	}


	function getSaldoCliente($clientes_id, $pedido_createt_at)
	{
		$pedidosadeudados = $this->pedidos_model->getSumPedidos3($clientes_id, $pedido_createt_at);

		$deudassinpagar = $this->deudas_model->getSumDeudas3($clientes_id, $pedido_createt_at);

		return $saldo_cliente = $pedidosadeudados +  $deudassinpagar;
	}


	/*function setDownload($hojaruta_ids = array())
	{
		$this->load->library('zip');
		$data = array();
		foreach ($hojaruta_ids as $f) 
		{
			$data['hojaruta_'.$f] = file_get_contents("./pdfs/hojaruta_".$f.".pdf");
		}

		$this->zip->add_data($data);
		$this->zip->download('my_backup.zip');
	}*/
}
