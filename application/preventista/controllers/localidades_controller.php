<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Localidades_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('localidades_model');
		$this->config->load('localidades_settings');
		$data['flags'] = $this->basicauth->getPermissions('localidades');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->localidades_model->getFieldsTable_m());
			$this->load->view('localidades_view/home_localidades', $data);
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
		$this->form_validation->set_rules('localidades_id', 'localidades_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('localidades_nombre', 'localidades_nombre', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('localidades_codpostal', 'localidades_codpostal', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('provincias_id', 'provincias_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('localidades_created_at', 'localidades_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('localidades_updated_at', 'localidades_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_localidades  = array();
			if($this->input->post('localidades_nombre'))
				$data_localidades['localidades_nombre'] = $this->input->post('localidades_nombre');
			if($this->input->post('localidades_codpostal'))
				$data_localidades['localidades_codpostal'] = $this->input->post('localidades_codpostal');
			if($this->input->post('provincias_id'))
				$data_localidades['provincias_id'] = $this->input->post('provincias_id');
			if($this->input->post('localidades_created_at'))
				$data_localidades['localidades_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('localidades_created_at'));
			if($this->input->post('localidades_updated_at'))
				$data_localidades['localidades_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('localidades_updated_at'));

			$id_localidades = $this->localidades_model->add_m($data_localidades);
			if($id_localidades){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('localidades_flash_add_message')); 
				redirect('localidades_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('localidades_flash_error_message')); 
				redirect('localidades_controller','location');
			}
		}
		$this->load->view('localidades_view/form_add_localidades',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($localidades_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['localidades'] = $this->localidades_model->get_m(array('localidades_id' => $localidades_id),$flag=1);
		$this->form_validation->set_rules('localidades_id', 'localidades_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('localidades_nombre', 'localidades_nombre', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('localidades_codpostal', 'localidades_codpostal', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('provincias_id', 'provincias_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('localidades_created_at', 'localidades_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('localidades_updated_at', 'localidades_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_localidades  = array();
			if($this->input->post('localidades_id'))
				$data_localidades['localidades_id'] = $this->input->post('localidades_id');
			if($this->input->post('localidades_nombre'))
				$data_localidades['localidades_nombre'] = $this->input->post('localidades_nombre');
			if($this->input->post('localidades_codpostal'))
				$data_localidades['localidades_codpostal'] = $this->input->post('localidades_codpostal');
			if($this->input->post('provincias_id'))
				$data_localidades['provincias_id'] = $this->input->post('provincias_id');
			if($this->input->post('localidades_created_at'))
				$data_localidades['localidades_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('localidades_created_at'));
			if($this->input->post('localidades_updated_at'))
				$data_localidades['localidades_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('localidades_updated_at'));

			if($this->localidades_model->edit_m($data_localidades)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('localidades_flash_edit_message')); 
				redirect('localidades_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('localidades_flash_error_message')); 
				redirect('localidades_controller','location');
			}
		}
		$this->load->view('localidades_view/form_edit_localidades',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $localidades_id id of record
	 * @return void
	 */
	function delete_c($localidades_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->localidades_model->delete_m($localidades_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('localidades_flash_delete_message')); 
			redirect('localidades_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('localidades_flash_error_delete_message')); 
			redirect('localidades_controller','location');
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
		$data_search_localidades = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_localidades  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->localidades_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_localidades[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_localidades['limit'] = $this->config->item('pag_perpage');
			$data_search_localidades['offset'] = $offset;
			$data_search_localidades['sortBy'] = 'localidades_id';
			$data_search_localidades['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'localidades_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['localidades'] = $this->localidades_model->get_m($data_search_localidades);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'localidades_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['localidades'] = $this->localidades_model->get_m($data_search_localidades);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->localidades_model->getFieldsTable_m());
			$this->load->view('localidades_view/record_list_localidades',$data);
		}

	}

}