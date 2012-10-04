<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagosdeudas_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') == true) { 
			$this->load->model('pagosdeudas_model');
			$this->config->load('pagosdeudas_settings');
			$data['flags'] = $this->basicauth->getPermissions('pagosdeudas');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->pagosdeudas_model->getFieldsTable_m());
			$this->load->view('pagosdeudas_view/home_pagosdeudas', $data);
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
		$this->form_validation->set_rules('pagosdeudas_id', 'pagosdeudas_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('deudas_id', 'deudas_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagos_id', 'pagos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagosdeudas_montocubierto', 'pagosdeudas_montocubierto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pagosdeudas_created_at', 'pagosdeudas_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pagosdeudas_updated_at', 'pagosdeudas_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_pagosdeudas  = array();
			$data_pagosdeudas['deudas_id'] = $this->input->post('deudas_id');
			$data_pagosdeudas['pagos_id'] = $this->input->post('pagos_id');
			$data_pagosdeudas['pagosdeudas_montocubierto'] = $this->input->post('pagosdeudas_montocubierto');
			$data_pagosdeudas['pagosdeudas_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pagosdeudas_created_at'));
			$data_pagosdeudas['pagosdeudas_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pagosdeudas_updated_at'));

			$id_pagosdeudas = $this->pagosdeudas_model->add_m($data_pagosdeudas);
			if($id_pagosdeudas){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pagosdeudas_flash_add_message')); 
				redirect('pagosdeudas_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pagosdeudas_flash_error_message')); 
				redirect('pagosdeudas_controller','location');
			}
		}
		$this->load->view('pagosdeudas_view/form_add_pagosdeudas',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($pagosdeudas_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['pagosdeudas'] = $this->pagosdeudas_model->get_m(array('pagosdeudas_id' => $pagosdeudas_id),$flag=1);
		$this->form_validation->set_rules('pagosdeudas_id', 'pagosdeudas_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('deudas_id', 'deudas_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagos_id', 'pagos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagosdeudas_montocubierto', 'pagosdeudas_montocubierto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pagosdeudas_created_at', 'pagosdeudas_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pagosdeudas_updated_at', 'pagosdeudas_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_pagosdeudas  = array();
			$data_pagosdeudas['pagosdeudas_id'] = $this->input->post('pagosdeudas_id');
			$data_pagosdeudas['deudas_id'] = $this->input->post('deudas_id');
			$data_pagosdeudas['pagos_id'] = $this->input->post('pagos_id');
			$data_pagosdeudas['pagosdeudas_montocubierto'] = $this->input->post('pagosdeudas_montocubierto');
			$data_pagosdeudas['pagosdeudas_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pagosdeudas_created_at'));
			$data_pagosdeudas['pagosdeudas_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pagosdeudas_updated_at'));

			if($this->pagosdeudas_model->edit_m($data_pagosdeudas)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pagosdeudas_flash_edit_message')); 
				redirect('pagosdeudas_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pagosdeudas_flash_error_message')); 
				redirect('pagosdeudas_controller','location');
			}
		}
		$this->load->view('pagosdeudas_view/form_edit_pagosdeudas',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $pagosdeudas_id id of record
	 * @return void
	 */
	function delete_c($pagosdeudas_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->pagosdeudas_model->delete_m($pagosdeudas_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('pagosdeudas_flash_delete_message')); 
			redirect('pagosdeudas_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('pagosdeudas_flash_error_delete_message')); 
			redirect('pagosdeudas_controller','location');
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
		$data_search_pagosdeudas = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->pagosdeudas_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_pagosdeudas[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_pagosdeudas['limit'] = $this->config->item('pag_perpage');
			$data_search_pagosdeudas['offset'] = $offset;
			$data_search_pagosdeudas['sortBy'] = 'pagosdeudas_id';
			$data_search_pagosdeudas['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pagosdeudas_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['pagosdeudas'] = $this->pagosdeudas_model->get_m($data_search_pagosdeudas);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pagosdeudas_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['pagosdeudas'] = $this->pagosdeudas_model->get_m($data_search_pagosdeudas);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->pagosdeudas_model->getFieldsTable_m());
			$this->load->view('pagosdeudas_view/record_list_pagosdeudas',$data);
		}

	}

}