<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagospedidos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('pagospedidos_model');
		$this->config->load('pagospedidos_settings');
		$data['flags'] = $this->basicauth->getPermissions('pagospedidos');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->pagospedidos_model->getFieldsTable_m());
			$this->load->view('pagospedidos_view/home_pagospedidos', $data);
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
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('recibos_id', 'recibos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagospedidos_montocubierto', 'pagospedidos_montocubierto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_created_at', 'pedidosremitos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_updated_at', 'pedidosremitos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_pagospedidos  = array();
			if($this->input->post('pedidos_id'))
				$data_pagospedidos['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('recibos_id'))
				$data_pagospedidos['recibos_id'] = $this->input->post('recibos_id');
			if($this->input->post('pagospedidos_montocubierto'))
				$data_pagospedidos['pagospedidos_montocubierto'] = $this->input->post('pagospedidos_montocubierto');
			if($this->input->post('pedidosremitos_created_at'))
				$data_pagospedidos['pedidosremitos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_created_at'));
			if($this->input->post('pedidosremitos_updated_at'))
				$data_pagospedidos['pedidosremitos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_updated_at'));

			$id_pagospedidos = $this->pagospedidos_model->add_m($data_pagospedidos);
			if($id_pagospedidos){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pagospedidos_flash_add_message')); 
				redirect('pagospedidos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pagospedidos_flash_error_message')); 
				redirect('pagospedidos_controller','location');
			}
		}
		$this->load->view('pagospedidos_view/form_add_pagospedidos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($pagospedidos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['pagospedidos'] = $this->pagospedidos_model->get_m(array('pagospedidos_id' => $pagospedidos_id),$flag=1);
		$this->form_validation->set_rules('pagospedidos_id', 'pagospedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('recibos_id', 'recibos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagospedidos_montocubierto', 'pagospedidos_montocubierto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_created_at', 'pedidosremitos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pedidosremitos_updated_at', 'pedidosremitos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_pagospedidos  = array();
			if($this->input->post('pagospedidos_id'))
				$data_pagospedidos['pagospedidos_id'] = $this->input->post('pagospedidos_id');
			if($this->input->post('pedidos_id'))
				$data_pagospedidos['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('recibos_id'))
				$data_pagospedidos['recibos_id'] = $this->input->post('recibos_id');
			if($this->input->post('pagospedidos_montocubierto'))
				$data_pagospedidos['pagospedidos_montocubierto'] = $this->input->post('pagospedidos_montocubierto');
			if($this->input->post('pedidosremitos_created_at'))
				$data_pagospedidos['pedidosremitos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_created_at'));
			if($this->input->post('pedidosremitos_updated_at'))
				$data_pagospedidos['pedidosremitos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pedidosremitos_updated_at'));

			if($this->pagospedidos_model->edit_m($data_pagospedidos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pagospedidos_flash_edit_message')); 
				redirect('pagospedidos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pagospedidos_flash_error_message')); 
				redirect('pagospedidos_controller','location');
			}
		}
		$this->load->view('pagospedidos_view/form_edit_pagospedidos',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $pagospedidos_id id of record
	 * @return void
	 */
	function delete_c($pagospedidos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->pagospedidos_model->delete_m($pagospedidos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('pagospedidos_flash_delete_message')); 
			redirect('pagospedidos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('pagospedidos_flash_error_delete_message')); 
			redirect('pagospedidos_controller','location');
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
		$data_search_pagospedidos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_pagospedidos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->pagospedidos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_pagospedidos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_pagospedidos['limit'] = $this->config->item('pag_perpage');
			$data_search_pagospedidos['offset'] = $offset;
			$data_search_pagospedidos['sortBy'] = 'pagospedidos_id';
			$data_search_pagospedidos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pagospedidos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['pagospedidos'] = $this->pagospedidos_model->get_m($data_search_pagospedidos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pagospedidos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['pagospedidos'] = $this->pagospedidos_model->get_m($data_search_pagospedidos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->pagospedidos_model->getFieldsTable_m());
			$this->load->view('pagospedidos_view/record_list_pagospedidos',$data);
		}

	}

}