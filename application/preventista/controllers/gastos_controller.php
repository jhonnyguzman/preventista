<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gastos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') == true) { 
			$this->load->model('gastos_model');
			$this->config->load('gastos_settings');
			$data['flags'] = $this->basicauth->getPermissions('gastos');
			$this->flagR = $data['flags']['flag-read'];
			$this->flagI = $data['flags']['flag-insert'];
			$this->flagU = $data['flags']['flag-update'];
			$this->flagD = $data['flags']['flag-delete'];
			$this->flags = array('r'=>$this->flagR,'i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
		}
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->gastos_model->getFieldsTable_m());
			$this->load->view('gastos_view/home_gastos', $data);
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
		$this->form_validation->set_rules('gastos_id', 'gastos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('gastos_descripcion', 'gastos_descripcion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('hojaruta_id', 'hojaruta_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('gastos_monto', 'gastos_monto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('gastos_created_at', 'gastos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('gastos_updated_at', 'gastos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_gastos  = array();
			$data_gastos['gastos_descripcion'] = $this->input->post('gastos_descripcion');
			$data_gastos['hojaruta_id'] = $this->input->post('hojaruta_id');
			$data_gastos['gastos_monto'] = $this->input->post('gastos_monto');
			$data_gastos['gastos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('gastos_created_at'));
			$data_gastos['gastos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('gastos_updated_at'));

			$id_gastos = $this->gastos_model->add_m($data_gastos);
			if($id_gastos){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('gastos_flash_add_message')); 
				redirect('gastos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('gastos_flash_error_message')); 
				redirect('gastos_controller','location');
			}
		}
		$this->load->view('gastos_view/form_add_gastos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($gastos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['gastos'] = $this->gastos_model->get_m(array('gastos_id' => $gastos_id),$flag=1);
		$this->form_validation->set_rules('gastos_id', 'gastos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('gastos_descripcion', 'gastos_descripcion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('hojaruta_id', 'hojaruta_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('gastos_monto', 'gastos_monto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('gastos_created_at', 'gastos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('gastos_updated_at', 'gastos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_gastos  = array();
			$data_gastos['gastos_id'] = $this->input->post('gastos_id');
			$data_gastos['gastos_descripcion'] = $this->input->post('gastos_descripcion');
			$data_gastos['hojaruta_id'] = $this->input->post('hojaruta_id');
			$data_gastos['gastos_monto'] = $this->input->post('gastos_monto');
			$data_gastos['gastos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('gastos_created_at'));
			$data_gastos['gastos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('gastos_updated_at'));

			if($this->gastos_model->edit_m($data_gastos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('gastos_flash_edit_message')); 
				redirect('gastos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('gastos_flash_error_message')); 
				redirect('gastos_controller','location');
			}
		}
		$this->load->view('gastos_view/form_edit_gastos',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $gastos_id id of record
	 * @return void
	 */
	function delete_c($gastos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->gastos_model->delete_m($gastos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('gastos_flash_delete_message')); 
			redirect('gastos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('gastos_flash_error_delete_message')); 
			redirect('gastos_controller','location');
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
		$data_search_gastos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->gastos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_gastos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_gastos['limit'] = $this->config->item('pag_perpage');
			$data_search_gastos['offset'] = $offset;
			$data_search_gastos['sortBy'] = 'gastos_id';
			$data_search_gastos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'gastos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['gastos'] = $this->gastos_model->get_m($data_search_gastos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'gastos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['gastos'] = $this->gastos_model->get_m($data_search_gastos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->gastos_model->getFieldsTable_m());
			$this->load->view('gastos_view/record_list_gastos',$data);
		}

	}

}