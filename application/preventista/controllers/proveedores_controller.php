<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('proveedores_model');
		$this->config->load('proveedores_settings');
		$data['flags'] = $this->basicauth->getPermissions('proveedores');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->proveedores_model->getFieldsTable_m());
			$this->load->view('proveedores_view/home_proveedores', $data);
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
		$this->form_validation->set_rules('proveedores_id', 'proveedores_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('proveedores_nombre', 'proveedores_nombre', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_apellido', 'proveedores_apellido', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_direccion', 'proveedores_direccion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_telefono', 'proveedores_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_created_at', 'proveedores_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_updated_at', 'proveedores_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_proveedores  = array();
			if($this->input->post('proveedores_nombre'))
				$data_proveedores['proveedores_nombre'] = $this->input->post('proveedores_nombre');
			if($this->input->post('proveedores_apellido'))
				$data_proveedores['proveedores_apellido'] = $this->input->post('proveedores_apellido');
			if($this->input->post('proveedores_direccion'))
				$data_proveedores['proveedores_direccion'] = $this->input->post('proveedores_direccion');
			if($this->input->post('proveedores_telefono'))
				$data_proveedores['proveedores_telefono'] = $this->input->post('proveedores_telefono');
			if($this->input->post('proveedores_created_at'))
				$data_proveedores['proveedores_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('proveedores_created_at'));
			if($this->input->post('proveedores_updated_at'))
				$data_proveedores['proveedores_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('proveedores_updated_at'));

			$id_proveedores = $this->proveedores_model->add_m($data_proveedores);
			if($id_proveedores){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('proveedores_flash_add_message')); 
				redirect('proveedores_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('proveedores_flash_error_message')); 
				redirect('proveedores_controller','location');
			}
		}
		$this->load->view('proveedores_view/form_add_proveedores',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($proveedores_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['proveedores'] = $this->proveedores_model->get_m(array('proveedores_id' => $proveedores_id),$flag=1);
		$this->form_validation->set_rules('proveedores_id', 'proveedores_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('proveedores_nombre', 'proveedores_nombre', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_apellido', 'proveedores_apellido', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_direccion', 'proveedores_direccion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_telefono', 'proveedores_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_created_at', 'proveedores_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('proveedores_updated_at', 'proveedores_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_proveedores  = array();
			if($this->input->post('proveedores_id'))
				$data_proveedores['proveedores_id'] = $this->input->post('proveedores_id');
			if($this->input->post('proveedores_nombre'))
				$data_proveedores['proveedores_nombre'] = $this->input->post('proveedores_nombre');
			if($this->input->post('proveedores_apellido'))
				$data_proveedores['proveedores_apellido'] = $this->input->post('proveedores_apellido');
			if($this->input->post('proveedores_direccion'))
				$data_proveedores['proveedores_direccion'] = $this->input->post('proveedores_direccion');
			if($this->input->post('proveedores_telefono'))
				$data_proveedores['proveedores_telefono'] = $this->input->post('proveedores_telefono');
			if($this->input->post('proveedores_created_at'))
				$data_proveedores['proveedores_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('proveedores_created_at'));
			if($this->input->post('proveedores_updated_at'))
				$data_proveedores['proveedores_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('proveedores_updated_at'));

			if($this->proveedores_model->edit_m($data_proveedores)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('proveedores_flash_edit_message')); 
				redirect('proveedores_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('proveedores_flash_error_message')); 
				redirect('proveedores_controller','location');
			}
		}
		$this->load->view('proveedores_view/form_edit_proveedores',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $proveedores_id id of record
	 * @return void
	 */
	function delete_c($proveedores_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->proveedores_model->delete_m($proveedores_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('proveedores_flash_delete_message')); 
			redirect('proveedores_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('proveedores_flash_error_delete_message')); 
			redirect('proveedores_controller','location');
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
		$data_search_proveedores = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_proveedores  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->proveedores_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_proveedores[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_proveedores['limit'] = $this->config->item('pag_perpage');
			$data_search_proveedores['offset'] = $offset;
			$data_search_proveedores['sortBy'] = 'proveedores_id';
			$data_search_proveedores['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'proveedores_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['proveedores'] = $this->proveedores_model->get_m($data_search_proveedores);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'proveedores_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['proveedores'] = $this->proveedores_model->get_m($data_search_proveedores);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->proveedores_model->getFieldsTable_m());
			$this->load->view('proveedores_view/record_list_proveedores',$data);
		}

	}

}