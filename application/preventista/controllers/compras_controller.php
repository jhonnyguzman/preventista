<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compras_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('compras_model');
		$this->load->model('comprasdetalle_model');
		$this->load->model('proveedores_model');
		$this->load->model('articulos_model');
		$this->config->load('compras_settings');
		$data['flags'] = $this->basicauth->getPermissions('compras');
		$this->flagR = $data['flags']['flag-read'];
		$this->flagI = $data['flags']['flag-insert'];
		$this->flagU = $data['flags']['flag-update'];
		$this->flagD = $data['flags']['flag-delete'];
		$this->flags = array('i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['proveedores'] = $this->proveedores_model->get_m();
			$this->load->view('compras_view/home_compras', $data);
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
		$this->form_validation->set_rules('proveedores_id', 'proveedores_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('compras_montototal', 'compras_montototal', 'trim|required|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_compras  = array();
			$data_compras['proveedores_id'] = $this->input->post('proveedores_id');
			$data_compras['compras_montototal'] = $this->input->post('compras_montototal');
			$data_compras['usuarios_id'] = $this->session->userdata("usuarios_id");
			$data_compras['compras_created_at'] = $this->basicrud->formatDateToBD();
			$data_compras['compras_updated_at'] = $this->basicrud->formatDateToBD();

			$id_compras = $this->compras_model->add_m($data_compras);
			if($id_compras)
			{ 
				while($this->input->post('articulos_id-'.$i))
				{
					$data_comprasdetalle['compras_id'] =$id_compras;
					$data_comprasdetalle['articulos_id'] = $this->input->post('articulos_id-'.$i);
					$data_comprasdetalle['comprasdetalle_cantidad'] = $this->input->post('comprasdetalle_cantidad-'.$i);
					$data_comprasdetalle['comprasdetalle_costo'] = $this->input->post('articulos_preciocompra-'.$i);
					$data_comprasdetalle['comprasdetalle_subtotal'] = $this->input->post('comprasdetalle_subtotal-'.$i);
					$data_comprasdetalle['comprasdetalle_created_at'] = $this->basicrud->formatDateToBD();
					$data_comprasdetalle['comprasdetalle_updated_at'] = $this->basicrud->formatDateToBD();
			
					//guardar linea de comprasdetalle
					$id_comprasdetalle = $this->comprasdetalle_model->add_m($data_comprasdetalle);
					if($id_comprasdetalle){
						//actualizar el stock de los articulos 
						if(!$this->actualizarStock($this->input->post('articulos_id-'.$i),$this->input->post('comprasdetalle_cantidad-'.$i), '', $data_comprasdetalle['comprasdetalle_costo'],'+')) 
							$check_error[] = 1; 
					}
					$i = $i + 1;
				}
				if(count($check_error)>0){
					$this->session->set_flashdata('flashError', $this->config->item('compras_flash_error_message')); 
					redirect('compras_controller','location');
				}else{
					$this->session->set_flashdata('flashConfirm', $this->config->item('compras_flash_add_message')); 
					redirect('compras_controller','location');
				}
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('compras_flash_error_message')); 
				redirect('compras_controller','location');
			}
		}else{
			$this->load->view('compras_view/form_add_compras',$data);
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
	function edit_c($compras_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array(); $i = 0;
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['compras'] = $this->compras_model->get_m(array('compras_id' => $compras_id),$flag=1);
		$data['compradetalle'] = $this->comprasdetalle_model->get_m(array('compras_id' => $compras_id));

		$this->form_validation->set_rules('compras_id', 'compras_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('proveedores_id', 'proveedores_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('compras_montototal', 'compras_montototal', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_id', 'usuarios_id', 'trim|integer|xss_clean');
		if($this->form_validation->run()){
			$data_compras  = array();
		
			$data_compras['compras_id'] = $this->input->post('compras_id');
			$data_compras['proveedores_id'] = $this->input->post('proveedores_id');
			$data_compras['compras_montototal'] = $this->input->post('compras_montototal');
			$data_compras['usuarios_id'] = $this->input->post('usuarios_id');
			$data_compras['compras_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->compras_model->edit_m($data_compras))
			{ 
				while($this->input->post('articulos_id-'.$i))
				{
					$data_comprasdetalle['comprasdetalle_id'] =  $this->input->post('comprasdetalle_id-'.$i);
					$data_comprasdetalle['compras_id'] = $data_pedidos['compras_id'];
					$data_comprasdetalle['articulos_id'] = $this->input->post('articulos_id-'.$i);
					$data_comprasdetalle['comprasdetalle_cantidad'] = $this->input->post('comprasdetalle_cantidad-'.$i);
					$data_comprasdetalle['comprasdetalle_subtotal'] = $this->input->post('comprasdetalle_subtotal-'.$i);
					$data_comprasdetalle['comprasdetalle_updated_at'] = $this->basicrud->formatDateToBD();
					$data_comprasdetalle['comprasdetalle_costo'] = $this->input->post('articulos_preciocompra-'.$i);
					//actualizar linea de comprasdetalle
					if($this->comprasdetalle_model->edit_m($data_comprasdetalle)){ 
						//actualizar el stock de los articulos 
						if(!$this->actualizarStock($this->input->post('articulos_id-'.$i), $this->input->post('comprasdetalle_cantidad-'.$i), $this->input->post('comprasdetalle_cantidad_old-'.$i), $data_comprasdetalle['comprasdetalle_costo'],'+')) 
							$check_error[] = 1; 
					}
					$i = $i + 1;
				}
				if(count($check_error)>0){
					$this->session->set_flashdata('flashError', $this->config->item('compras_flash_error_message')); 
					redirect('compras_controller','location');
				}else{	
					$this->session->set_flashdata('flashConfirm', $this->config->item('compras_flash_edit_message')); 
					redirect('compras_controller','location');
				}
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('compras_flash_error_message')); 
				redirect('compras_controller','location');
			}
		}
		$this->load->view('compras_view/form_edit_compras',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function show_c($compras_id)
	{
		//code here
		if(!$this->flagR){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array(); $i = 0;
		$data['subtitle'] = $this->config->item('recordShowTitle');
		$data['compras'] = $this->compras_model->get_m(array('compras_id' => $compras_id),$flag=1);
		$data['compradetalle'] = $this->comprasdetalle_model->get_m(array('compras_id' => $compras_id));
		$this->load->view('compras_view/form_show_compras',$data);

	}



	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $compras_id id of record
	 * @return void
	 */
	function delete_c($compras_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->compras_model->delete_m($compras_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('compras_flash_delete_message')); 
			redirect('compras_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('compras_flash_error_delete_message')); 
			redirect('compras_controller','location');
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
		$data_search_compras = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 

		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->compras_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_compras[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_compras['limit'] = $this->config->item('pag_perpage');
			$data_search_compras['offset'] = $offset;
			$data_search_compras['sortBy'] = 'compras_id';
			$data_search_compras['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'compras_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['compras'] = $this->compras_model->get_m($data_search_compras);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'compras_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['compras'] = $this->compras_model->get_m($data_search_compras);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->compras_model->getFieldsTable_m());
			$data['flag'] = $this->flags;
			$this->load->view('compras_view/record_list_compras',$data);
		}

	}


	function actualizarStock($articulos_id, $cantidad, $cantidad_old="", $costo, $operacion)
	{
		$state = false;
		if($cantidad_old == "")
		{
			if($this->articulos_model->editstock_m(array('articulos_id' => $articulos_id, 'cantidad' => $cantidad, 'operacion' => $operacion)))
			{
				if($this->actualizarPrecio($articulos_id, $costo)) $state = true; 
				else return $state = false;
			}
		}
		else
		{
			if($this->articulos_model->editstock2_m(array('articulos_id' => $articulos_id, 'cantidad' => $cantidad, 'cantidad_old' => $cantidad_old, 'operacion' => $operacion)))
			{
				if($this->actualizarPrecio($articulos_id, $costo)) $state = true;
				else return $state = false;
			}	
		}

		return $state;
	}


	function actualizarPrecio($articulos_id, $costo)
	{
		$articulo = $this->articulos_model->get_m(array('articulos_id' => $articulos_id));
		if($articulo){
			$data_articulos['articulos_id'] = $articulos_id;
			$data_articulos['articulos_preciocompra'] = $costo;
			$data_articulos['articulos_precio1'] = $this->basicrud->getPrecio2($costo, $articulo[0]->articulos_porcentaje1);
			$data_articulos['articulos_precio2'] = $this->basicrud->getPrecio2($costo, $articulo[0]->articulos_porcentaje2);
			$data_articulos['articulos_precio3'] = $this->basicrud->getPrecio2($costo, $articulo[0]->articulos_porcentaje3);
			if($this->articulos_model->edit_m($data_articulos)) return true; 
			else return false;
		}
	}

}