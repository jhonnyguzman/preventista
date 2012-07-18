<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('pedidos_model');
		$this->load->model('pedidodetalle_model');
		$this->load->model('clientes_model');
		$this->load->model('remitos_model');
		$this->load->model('articulos_model');
		$this->load->model('tabgral_model');
		$this->load->model('tramites_model');
		$this->config->load('pedidos_settings');
		$data['flags'] = $this->basicauth->getPermissions('pedidos');
		$this->flagR = $data['flags']['flag-read'];
		$this->flagI = $data['flags']['flag-insert'];
		$this->flagU = $data['flags']['flag-update'];
		$this->flagD = $data['flags']['flag-delete'];
		$this->flags = array('r'=> $this->flagR ,'i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['pedidosestado'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 3)); //estados pedidos
			$data['clientes'] = $this->clientes_model->get_m();
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->pedidos_model->getFieldsTable_m());
			$this->load->view('pedidos_view/home_pedidos', $data);
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

		$data = array(); $check_error = array(); $i = 0;
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$data['tramites'] = $this->tramites_model->get_m();

		$this->form_validation->set_rules('peididos_montototal', 'peididos_montototal', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('tramites_id', 'tramites_id', 'trim|required|integer|xss_clean');
		if($this->form_validation->run())
		{	
			$data_pedidos  = array();
			$data_pedidos['pedidos_id'] = $this->preferences->data['pedidos_next_id'];
			$data_pedidos['peididos_montototal'] = $this->input->post('peididos_montototal');
			$data_pedidos['pedidos_montoadeudado'] = $this->input->post('peididos_montototal');
			$data_pedidos['clientes_id'] = $this->input->post('clientes_id');
			$data_pedidos['pedidos_estado'] = 6;  //estado 'Solicitado'
			$data_pedidos['tramites_id'] = $this->input->post('tramites_id');
			$data_pedidos['pedidos_observaciones'] = $this->input->post('pedidos_observaciones');
			$data_pedidos['pedidos_created_at'] = $this->basicrud->formatDateToBD();
			$data_pedidos['pedidos_updated_at'] = $this->basicrud->formatDateToBD();
		
			$id_pedidos = $this->pedidos_model->add_m($data_pedidos);
			if($id_pedidos)
			{ 
				$this->preferences->editNextId('pedidos_next_id',$id_pedidos);
				$id_pd = $this->preferences->data['pedidodetalle_next_id'];
				while($this->input->post('articulos_id-'.$i))
				{
					$data_pedidodetalle['pedidodetalle_id'] = $id_pd;
					$data_pedidodetalle['pedidos_id'] = $id_pedidos;
					$data_pedidodetalle['articulos_id'] = $this->input->post('articulos_id-'.$i);
					$data_pedidodetalle['pedidodetalle_cantidad'] = $this->input->post('pedidodetalle_cantidad-'.$i);
					$data_pedidodetalle['pedidodetalle_montoacordado'] = $this->input->post('pedidodetalle_montoacordado-'.$i);
					$data_pedidodetalle['pedidodetalle_subtotal'] = $this->input->post('pedidodetalle_subtotal-'.$i);
					if($this->input->post('articulos_precio1-'.$i))
						$data_pedidodetalle['pedidodetalle_pv'] = $this->input->post('articulos_precio1-'.$i);
					if($this->input->post('articulos_precio2-'.$i))
						$data_pedidodetalle['pedidodetalle_pv'] = $this->input->post('articulos_precio2-'.$i);
					if($this->input->post('articulos_precio3-'.$i)) 
						$data_pedidodetalle['pedidodetalle_pv'] = $this->input->post('articulos_precio3-'.$i);
		
					
					$data_pedidodetalle['pedidodetalle_created_at'] = $this->basicrud->formatDateToBD();
					$data_pedidodetalle['pedidodetalle_updated_at'] = $this->basicrud->formatDateToBD();

					//guardar linea de pedidodetalle
					$id_pedidodetalle = $this->pedidodetalle_model->add_m($data_pedidodetalle);
					if($id_pedidodetalle){
						$id_pd = $id_pedidodetalle + 1;
						//actualizar el stock de los articulos 
						if(!$this->articulos_model->editstock_m(array('articulos_id' => $this->input->post('articulos_id-'.$i), 'cantidad' => $this->input->post('pedidodetalle_cantidad-'.$i), 'operacion' => '-'))) 
							$check_error[] = 1; 
					}

					$i = $i + 1;
				}
				$this->preferences->editNextId('pedidodetalle_next_id',$id_pd);
				if(count($check_error)>0){
					$this->session->set_flashdata('flashError', $this->config->item('pedidos_flash_error_message')); 
					redirect('pedidos_controller','location');
				}else{
					$this->session->set_flashdata('flashConfirm', $this->config->item('pedidos_flash_add_message')); 
					redirect('pedidos_controller','location');
				}
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pedidos_flash_error_message')); 
				redirect('pedidos_controller','location');
			}
			
		}
		else{
			$this->load->view('pedidos_view/form_add_pedidos',$data);
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
	function edit_c($pedidos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array(); $i = 0;
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['pedidos'] = $this->pedidos_model->get_m(array('pedidos_id' => $pedidos_id),$flag=1);
		$data['pedidodetalle'] = $this->pedidodetalle_model->get_m(array('pedidos_id' => $pedidos_id,'clientescategoria_id' => $data['pedidos']->clientescategoria_id));
		$data['articulos_precio'] = $this->getDescripPrecio($data['pedidos']->clientescategoria_id);
		$data['tramites'] = $this->tramites_model->get_m();

		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('peididos_montototal', 'peididos_montototal', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('tramites_id', 'tramites_id', 'trim|required|integer|xss_clean');

		if($this->form_validation->run()){
			$data_pedidos  = array();
			
			$data_pedidos['pedidos_id'] = $this->input->post('pedidos_id');
			$data_pedidos['peididos_montototal'] = $this->input->post('peididos_montototal');
			$data_pedidos['pedidos_montoadeudado'] = $this->input->post('pedidos_montoadeudado');
			$data_pedidos['clientes_id'] = $this->input->post('clientes_id');
			$data_pedidos['pedidos_estado'] = $this->input->post('pedidos_estado');
			$data_pedidos['pedidos_updated_at'] = $this->basicrud->formatDateToBD();
			$data_pedidos['tramites_id'] = $this->input->post('tramites_id');
			$data_pedidos['pedidos_observaciones'] = $this->input->post('pedidos_observaciones');

			if($this->pedidos_model->edit_m($data_pedidos)){
				
				while($this->input->post('articulos_id-'.$i))
				{
					$data_pedidodetalle['pedidodetalle_id'] =  $this->input->post('pedidodetalle_id-'.$i);
					$data_pedidodetalle['pedidos_id'] = $data_pedidos['pedidos_id'];
					$data_pedidodetalle['articulos_id'] = $this->input->post('articulos_id-'.$i);
					$data_pedidodetalle['pedidodetalle_cantidad'] = $this->input->post('pedidodetalle_cantidad-'.$i);
					$data_pedidodetalle['pedidodetalle_subtotal'] = $this->input->post('pedidodetalle_subtotal-'.$i);
					if($this->input->post('articulos_precio1-'.$i))
						$data_pedidodetalle['pedidodetalle_pv'] = $this->input->post('articulos_precio1-'.$i);
					if($this->input->post('articulos_precio2-'.$i))
						$data_pedidodetalle['pedidodetalle_pv'] = $this->input->post('articulos_precio2-'.$i);
					if($this->input->post('articulos_precio3-'.$i)) 
						$data_pedidodetalle['pedidodetalle_pv'] = $this->input->post('articulos_precio3-'.$i);
					
					$data_pedidodetalle['pedidodetalle_updated_at'] = $this->basicrud->formatDateToBD();
					$data_pedidodetalle['pedidodetalle_montoacordado'] = $this->input->post('pedidodetalle_montoacordado-'.$i);
					
					//actualizar linea de pedidodetalle
					if($this->pedidodetalle_model->edit_m($data_pedidodetalle)){ 
						//actualizar el stock de los articulos 
						if(!$this->articulos_model->editstock2_m(array('articulos_id' => $this->input->post('articulos_id-'.$i), 'cantidad' => $this->input->post('pedidodetalle_cantidad-'.$i), 'cantidad_old' => $this->input->post('pedidodetalle_cantidad_old-'.$i), 'operacion' => '-'))) 
							$check_error[] = 1; 
					}
					$i = $i + 1;
				}
				if(count($check_error)>0){
					$this->session->set_flashdata('flashError', $this->config->item('pedidos_flash_error_message')); 
					redirect('pedidos_controller','location');
				}else{	
					$this->session->set_flashdata('flashConfirm', $this->config->item('pedidos_flash_edit_message')); 
					redirect('pedidos_controller','location');
				}
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pedidos_flash_error_message')); 
				redirect('pedidos_controller','location');
			}
		}
		$this->load->view('pedidos_view/form_edit_pedidos',$data);

	}


	
	function show_c($pedidos_id)
	{
		//code here
		if(!$this->flagR){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['pedidos'] = $this->pedidos_model->get_m(array('pedidos_id' => $pedidos_id),$flag=1);
		$data['pedidodetalle'] = $this->pedidodetalle_model->get_m(array('pedidos_id' => $pedidos_id,'clientescategoria_id' => $data['pedidos']->clientescategoria_id));
		$data['articulos_precio'] = $this->getDescripPrecio($data['pedidos']->clientescategoria_id);
		$this->load->view('pedidos_view/form_show_pedidos',$data);
		
	}



	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $pedidos_id id of record
	 * @return void
	 */
	function delete_c($pedidos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		//se realiza baja logica cambiando solo el estado del pedido a  'Cancelado' y devolviendo el stock 
		//a los articulos involucrados respectivamente
		if($this->pedidos_model->edit_m(array('pedidos_id' => $pedidos_id, 'pedidos_estado' => 9)))
		{
			$pedidodetalle = $this->pedidodetalle_model->get_m(array('pedidos_id' => $pedidos_id));
			if($pedidodetalle){
				foreach ($pedidodetalle as $f) {
					if(!$this->articulos_model->editstock_m(array('articulos_id' => $f->articulos_id, 'cantidad' => $f->pedidodetalle_cantidad, 'operacion' => '+'))) 
							$check_error[] = 1; 
				}
				if(count($check_error)>0){
					$this->session->set_flashdata('flashError', $this->config->item('pedidos_flash_error_delete_message')); 
					redirect('pedidos_controller','location');
				}else{
					$this->session->set_flashdata('flashConfirm', $this->config->item('pedidos_flash_delete_message')); 
					redirect('pedidos_controller','location');
				}
			}
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('pedidos_flash_error_delete_message')); 
			redirect('pedidos_controller','location');
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
		$data_search_pedidos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_pedidos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->pedidos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_pedidos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_pedidos['limit'] = $this->config->item('pag_perpage');
			$data_search_pedidos['offset'] = $offset;
			$data_search_pedidos['sortBy'] = 'pedidos_created_at';
			$data_search_pedidos['sortDirection'] = 'desc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pedidos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['pedidos'] = $this->pedidos_model->get_m($data_search_pedidos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pedidos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['pedidos'] = $this->pedidos_model->get_m($data_search_pedidos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->pedidos_model->getFieldsTable_m());
			$this->load->view('pedidos_view/record_list_pedidos',$data);
		}

	}


	function showDetalleArt_c()
	{
		$data['fechaActual'] = $this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime());
		$this->load->view("pedidos_view/form_detalle_articulos",$data);
	}

	function searchDetalleArt_c()
	{
		$data['detallearticulos']= $this->pedidodetalle_model->getPedidoDetalle_m($this->input->post("fechaDetalleArticulo"));
		$this->load->view("pedidodetalle_view/record_list_detalle_articulos",$data);
	}


	/**
	* Esta función permite descargar en pdf con el detalle de articulos para una 
	* determinada  
	*/
	function printDetalleArt_c($dia,$mes,$anio)
	{
		$this->load->helper(array('dompdf', 'file'));
		$fecha = $dia."/".$mes."/".$anio;

		if($fecha){
			$data["title"] = "Detalle de mercader&iacute;a para el dia ".$fecha;
			$data['detallearticulos']= $this->pedidodetalle_model->getPedidoDetalle_m($fecha);
			$html = $this->load->view('pedidodetalle_view/record_list_detalle_articulos_to_print', $data, true);
			pdf_create($html,$this->basicrud->setFileName('DetalleArticulos'),'a5');
		}
	}


	function printDetalleArt2_c($dia,$mes,$anio)
	{
		$this->load->helper('download');
		$fecha = $dia."/".$mes."/".$anio;

		if($fecha){
			$data["title"] = "Detalle de mercadería para el día ".$fecha;
			$data['detallearticulos']= $this->pedidodetalle_model->getPedidoDetalle_m($fecha);
			$html = $this->load->view('pedidodetalle_view/record_list_detalle_articulos_to_print2', $data, true);

			$data = $html;
			$name = $this->basicrud->setFileName('DetalleArticulos').".txt";
			force_download($name, $data);
		}
	}


	function printDetalleArt3_c($dia,$mes,$anio)
	{
	
		$fecha = $dia."/".$mes."/".$anio;

		if($fecha){
			$data["title"] = "Detalle de mercadería para el día ".$fecha;
			$data['detallearticulos']= $this->pedidodetalle_model->getPedidoDetalle_m($fecha);
			$this->load->view('pedidodetalle_view/record_list_detalle_articulos_to_print3', $data);
		}
	}


	private function getDescripPrecio($clientes_categoria){
		if($clientes_categoria == 1) return 'articulos_precio1';
		elseif($clientes_categoria == 2) return 'articulos_precio2';
		else return 'articulos_precio3';
	}


}