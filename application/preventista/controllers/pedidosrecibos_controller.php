<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidosrecibos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('pedidosrecibos_model');
		$this->config->load('pedidosrecibos_settings');
		$data['flags'] = $this->basicauth->getPermissions('pedidosrecibos');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->pedidosrecibos_model->getFieldsTable_m());
			$this->load->view('pedidosrecibos_view/home_pedidosrecibos', $data);
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
		$this->form_validation->set_rules('pedidosrecibos_id', 'pedidosrecibos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('recibos_id', 'recibos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidosrecibos_montocubierto', 'pedidosrecibos_montocubierto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_created_at', 'pedidosremitos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_updated_at', 'pedidosremitos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_pedidosrecibos  = array();
			if($this->input->post('pedidos_id'))
				$data_pedidosrecibos['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('recibos_id'))
				$data_pedidosrecibos['recibos_id'] = $this->input->post('recibos_id');
			if($this->input->post('pedidosrecibos_montocubierto'))
				$data_pedidosrecibos['pedidosrecibos_montocubierto'] = $this->input->post('pedidosrecibos_montocubierto');
			if($this->input->post('pedidosremitos_created_at'))
				$data_pedidosrecibos['pedidosremitos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_created_at'));
			if($this->input->post('pedidosremitos_updated_at'))
				$data_pedidosrecibos['pedidosremitos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_updated_at'));

			$id_pedidosrecibos = $this->pedidosrecibos_model->add_m($data_pedidosrecibos);
			if($id_pedidosrecibos){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pedidosrecibos_flash_add_message')); 
				redirect('pedidosrecibos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pedidosrecibos_flash_error_message')); 
				redirect('pedidosrecibos_controller','location');
			}
		}
		$this->load->view('pedidosrecibos_view/form_add_pedidosrecibos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($pedidosrecibos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['pedidosrecibos'] = $this->pedidosrecibos_model->get_m(array('pedidosrecibos_id' => $pedidosrecibos_id),$flag=1);
		$this->form_validation->set_rules('pedidosrecibos_id', 'pedidosrecibos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('recibos_id', 'recibos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidosrecibos_montocubierto', 'pedidosrecibos_montocubierto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_created_at', 'pedidosremitos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_updated_at', 'pedidosremitos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_pedidosrecibos  = array();
			if($this->input->post('pedidosrecibos_id'))
				$data_pedidosrecibos['pedidosrecibos_id'] = $this->input->post('pedidosrecibos_id');
			if($this->input->post('pedidos_id'))
				$data_pedidosrecibos['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('recibos_id'))
				$data_pedidosrecibos['recibos_id'] = $this->input->post('recibos_id');
			if($this->input->post('pedidosrecibos_montocubierto'))
				$data_pedidosrecibos['pedidosrecibos_montocubierto'] = $this->input->post('pedidosrecibos_montocubierto');
			if($this->input->post('pedidosremitos_created_at'))
				$data_pedidosrecibos['pedidosremitos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_created_at'));
			if($this->input->post('pedidosremitos_updated_at'))
				$data_pedidosrecibos['pedidosremitos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_updated_at'));

			if($this->pedidosrecibos_model->edit_m($data_pedidosrecibos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pedidosrecibos_flash_edit_message')); 
				redirect('pedidosrecibos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pedidosrecibos_flash_error_message')); 
				redirect('pedidosrecibos_controller','location');
			}
		}
		$this->load->view('pedidosrecibos_view/form_edit_pedidosrecibos',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $pedidosrecibos_id id of record
	 * @return void
	 */
	function delete_c($pedidosrecibos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->pedidosrecibos_model->delete_m($pedidosrecibos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('pedidosrecibos_flash_delete_message')); 
			redirect('pedidosrecibos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('pedidosrecibos_flash_error_delete_message')); 
			redirect('pedidosrecibos_controller','location');
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
		$data_search_pedidosrecibos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_pedidosrecibos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->pedidosrecibos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_pedidosrecibos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_pedidosrecibos['limit'] = $this->config->item('pag_perpage');
			$data_search_pedidosrecibos['offset'] = $offset;
			$data_search_pedidosrecibos['sortBy'] = 'pedidosrecibos_id';
			$data_search_pedidosrecibos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pedidosrecibos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['pedidosrecibos'] = $this->pedidosrecibos_model->get_m($data_search_pedidosrecibos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pedidosrecibos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['pedidosrecibos'] = $this->pedidosrecibos_model->get_m($data_search_pedidosrecibos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->pedidosrecibos_model->getFieldsTable_m());
			$this->load->view('pedidosrecibos_view/record_list_pedidosrecibos',$data);
		}

	}

}