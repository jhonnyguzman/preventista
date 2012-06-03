<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidodetalle_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('pedidodetalle_model');
		$this->config->load('pedidodetalle_settings');
		$data['flags'] = $this->basicauth->getPermissions('pedidodetalle');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->pedidodetalle_model->getFieldsTable_m());
			$this->load->view('pedidodetalle_view/home_pedidodetalle', $data);
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
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$this->form_validation->set_rules('pedidodetalle_id', 'pedidodetalle_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_cantidad', 'pedidodetalle_cantidad', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_montoacordado', 'pedidodetalle_montoacordado', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_created_at', 'pedidodetalle_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_updated_at', 'pedidodetalle_updated_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_subtotal', 'pedidodetalle_subtotal', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_pedidodetalle  = array();
			if($this->input->post('pedidos_id'))
				$data_pedidodetalle['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('articulos_id'))
				$data_pedidodetalle['articulos_id'] = $this->input->post('articulos_id');
			if($this->input->post('pedidodetalle_cantidad'))
				$data_pedidodetalle['pedidodetalle_cantidad'] = $this->input->post('pedidodetalle_cantidad');
			if($this->input->post('pedidodetalle_montoacordado'))
				$data_pedidodetalle['pedidodetalle_montoacordado'] = $this->input->post('pedidodetalle_montoacordado');
			if($this->input->post('pedidodetalle_created_at'))
				$data_pedidodetalle['pedidodetalle_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidodetalle_created_at'));
			if($this->input->post('pedidodetalle_updated_at'))
				$data_pedidodetalle['pedidodetalle_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidodetalle_updated_at'));
			if($this->input->post('pedidodetalle_subtotal'))
				$data_pedidodetalle['pedidodetalle_subtotal'] = $this->input->post('pedidodetalle_subtotal');

			$id_pedidodetalle = $this->pedidodetalle_model->add_m($data_pedidodetalle);
			if($id_pedidodetalle){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pedidodetalle_flash_add_message')); 
				redirect('pedidodetalle_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pedidodetalle_flash_error_message')); 
				redirect('pedidodetalle_controller','location');
			}
		}
		$this->load->view('pedidodetalle_view/form_add_pedidodetalle',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($pedidodetalle_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['pedidodetalle'] = $this->pedidodetalle_model->get_m(array('pedidodetalle_id' => $pedidodetalle_id),$flag=1);
		$this->form_validation->set_rules('pedidodetalle_id', 'pedidodetalle_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_cantidad', 'pedidodetalle_cantidad', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_montoacordado', 'pedidodetalle_montoacordado', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_created_at', 'pedidodetalle_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_updated_at', 'pedidodetalle_updated_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidodetalle_subtotal', 'pedidodetalle_subtotal', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_pedidodetalle  = array();
			if($this->input->post('pedidodetalle_id'))
				$data_pedidodetalle['pedidodetalle_id'] = $this->input->post('pedidodetalle_id');
			if($this->input->post('pedidos_id'))
				$data_pedidodetalle['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('articulos_id'))
				$data_pedidodetalle['articulos_id'] = $this->input->post('articulos_id');
			if($this->input->post('pedidodetalle_cantidad'))
				$data_pedidodetalle['pedidodetalle_cantidad'] = $this->input->post('pedidodetalle_cantidad');
			if($this->input->post('pedidodetalle_montoacordado'))
				$data_pedidodetalle['pedidodetalle_montoacordado'] = $this->input->post('pedidodetalle_montoacordado');
			if($this->input->post('pedidodetalle_created_at'))
				$data_pedidodetalle['pedidodetalle_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidodetalle_created_at'));
			if($this->input->post('pedidodetalle_updated_at'))
				$data_pedidodetalle['pedidodetalle_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidodetalle_updated_at'));
			if($this->input->post('pedidodetalle_subtotal'))
				$data_pedidodetalle['pedidodetalle_subtotal'] = $this->input->post('pedidodetalle_subtotal');

			if($this->pedidodetalle_model->edit_m($data_pedidodetalle)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pedidodetalle_flash_edit_message')); 
				redirect('pedidodetalle_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pedidodetalle_flash_error_message')); 
				redirect('pedidodetalle_controller','location');
			}
		}
		$this->load->view('pedidodetalle_view/form_edit_pedidodetalle',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $pedidodetalle_id id of record
	 * @return void
	 */
	function delete_c($pedidodetalle_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->pedidodetalle_model->delete_m($pedidodetalle_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('pedidodetalle_flash_delete_message')); 
			redirect('pedidodetalle_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('pedidodetalle_flash_error_delete_message')); 
			redirect('pedidodetalle_controller','location');
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
		$data_search_pedidodetalle = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_pedidodetalle  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->pedidodetalle_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_pedidodetalle[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_pedidodetalle['limit'] = $this->config->item('pag_perpage');
			$data_search_pedidodetalle['offset'] = $offset;
			$data_search_pedidodetalle['sortBy'] = 'pedidodetalle_id';
			$data_search_pedidodetalle['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pedidodetalle_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['pedidodetalle'] = $this->pedidodetalle_model->get_m($data_search_pedidodetalle);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pedidodetalle_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['pedidodetalle'] = $this->pedidodetalle_model->get_m($data_search_pedidodetalle);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->pedidodetalle_model->getFieldsTable_m());
			$this->load->view('pedidodetalle_view/record_list_pedidodetalle',$data);
		}

	}

}